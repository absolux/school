
<div class="-page-header">
  <h3>Classes <small><i class="glyphicon glyphicon-chevron-right"></i> Détail</small></h3>
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
      <div class="col-md-7">
        <div class="panel panel-default">
          <!--<div class="panel-heading">Détail</div>-->
          <div class="panel-body">
            
            <?php $this->load->view('groupes/groupes_form') ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-5">
        
        <?php $this->load->view('groupes/groupes_etudiants') ?>
        
    </div>
    
  </div>
</div>
