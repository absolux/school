
<div class="-page-header">
  <h3>Classes <small>Détail</small></h3>
</div>

<div class="row">
  <div class="col-md-3">
    <?php echo anchor('classes', 'Retour à la liste', 'class="btn btn-block btn-default"') ?>
    <br />
    
    <?php echo anchor("classes/delete/{$id}", 'Supprimer', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" class="btn btn-block btn-danger"'); ?>
    <br />
    
  </div>
  <div class="col-md-9">
    <?php $this->load->view('common/alerts') ?>
    
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <!--<div class="panel-heading">Détail</div>-->
          <div class="panel-body">
            
            <?php $this->load->view('groupes/groupes_form') ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Etudiants</div>
          <div class="panel-body">
            
            <div id="js-student-list">
              <?php foreach ($etudiants as $item) : ?>
              <p>
                <?php echo anchor("etudiants/read/{$item->id}", "{$item->code} - {$item->prenom} {$item->nom}") ?>
                <button class="close" onclick="detachStudent('<?php echo $item->id ?>', this)">&times;</button>
              </p>
              <?php endforeach; ?>
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
              <input class="form-control js-typeahead" placeholder="Rechercher un étudiant" />
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

<script type="text/template" id="js-item-tpl">
  <p>
    <a href="<?php echo site_url("etudiants/read/{{id}}") ?>">{{name}}</a> 
    <button class="close" onclick="detachStudent('{{id}}', this)">&times;</button>
  </p>
</script>

<script type="text/javascript">
  function errorHandler () {
    alert("Une erreur s'est produite, merci de réessayer")
  }
  
  function attachStudent(id, el) {
    jQuery.ajax({
      url: '<?php echo base_url("groupes/attach/{$id}") ?>',
      method: 'POST',
      data: { 'etudiant': id },
      error: errorHandler,
      success: function (data) {
        jQuery(el).appendTo('#js-student-list')
      }
    })
  }
  
  function detachStudent(id, el) {
    confirm("Etes vous sûr ?") && jQuery.ajax({
      url: '<?php echo base_url("groupes/detach/{$id}") ?>',
      method: 'POST',
      data: { 'etudiant': id },
      error: errorHandler,
      success: function (data) {
        jQuery(el).parent().remove()
      }
    })
  }
  
  jQuery(function () {
    var students = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      identify: function (obj) { return obj.id },
      prefetch: {
        cache: Boolean(<?php echo (int) (ENVIRONMENT == 'production') ?>),
        url: "<?php echo base_url('etudiants/json_list') ?>"
      }
    })
    
    var $target = jQuery('.js-typeahead')
    
    $target.typeahead(null, {
      name: 'students',
      source: students,
      display: 'name',
    })
    
    $target.bind('typeahead:select', function (e, suggestion) {
      var tpl = jQuery('#js-item-tpl').html().replace('{{id}}', suggestion.id).replace('{{name}}', suggestion.name)
      
      attachStudent(suggestion.id, tpl)
      
      jQuery(this).typeahead('val', "")
    })
  })
</script>