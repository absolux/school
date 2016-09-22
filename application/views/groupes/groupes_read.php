
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
            
            <!--<table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Prénom</th>
                  <th>Nom</th>
                </tr>
              </thead>
              <tbody>-->
                <?php foreach ($etudiants as $item) : ?>
                  <p>
                    <?php echo $item->code ?> -
                    <?php echo anchor("etudiants/read/{$item->id}", "{$item->prenom} {$item->nom}") ?>
                    <button class="close">&times;</button>
                  </p>
                <?php endforeach; ?>
              <!--</tbody>
            </table>-->
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>