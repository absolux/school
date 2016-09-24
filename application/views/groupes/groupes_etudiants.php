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

<script type="text/template" id="js-student-item-tpl">
  <p>
    <a href="<?php echo site_url("etudiants/read/{{id}}") ?>" class="text-success">{{name}}</a> 
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
      var tpl = jQuery('#js-student-item-tpl').html()
      
      tpl = tpl.replace('{{id}}', suggestion.id).replace('{{name}}', suggestion.name)
      
      attachStudent(suggestion.id, tpl)
      
      jQuery(this).typeahead('val', "")
    })
  })
</script>