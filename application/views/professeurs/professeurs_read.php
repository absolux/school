
<div class="-page-header">
  <h3>Professeurs <small><i class="glyphicon glyphicon-chevron-right"></i> Détail</small></h3>
</div>

<div class="row">
  <div class="col-md-3">
    <?php echo anchor('professeurs', 'Retour à la liste', 'class="btn btn-block btn-default"') ?>
    <br />
    
    <?php echo anchor("professeurs/delete/{$id}", 'Supprimer', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" class="btn btn-block btn-danger"'); ?>
    <br />
    
  </div>
  <div class="col-md-9">
    <?php $this->load->view('common/alerts') ?>
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            
            <?php $this->load->view('professeurs/professeurs_form') ?>
            
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</div>
