
<div class="-page-header">
  <h3>Années scolaires <small><i class="glyphicon glyphicon-chevron-right"></i> Détail</small></h3>
</div>

<div class="row">
  <div class="col-md-3">
    <?php //$this->load->view('annees/create_form') ?>
    
    <?php echo anchor('annees-scolaires', 'Retour à la liste', 'class="btn btn-block btn-default"') ?>
    <br />
    
    <?php if (! $active ): ?>
    <?php echo anchor("annees-scolaires/activate/{$id}?back-to-detail=true", 'Activer', 'class="btn btn-block btn-success"'); ?>
    <br />
    <?php endif; ?>
    
    <?php echo anchor("annees-scolaires/delete/{$id}", 'Supprimer', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" class="btn btn-block btn-danger"'); ?>
    <br />
    
  </div>
  <div class="col-md-9">
    <?php $this->load->view('common/alerts') ?>
    
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            
            <?php $this->load->view('annees/annees_form') ?>
            
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-body">
            
            <table class="table -table-bordered table-condensed table-striped table-hover" style="margin-bottom: 10px">
              <thead>
                <tr>
                  <th>Période</th>
                  <th>Active</th>
                </tr>
              </thead>
              <tbody>
                <?php if (! count($semestres) ): ?>
                <tr class="warning text-center"><td colspan="7">Aucun semestre trouvé</td></tr>
                <?php else: ?>
                <?php foreach ($semestres as $item) : ?>
                <tr>
                  <td><?php echo $item->label ?></td>
                  <td style="padding-left: 15px">
                    <?php if ( $item->active ): ?>
                    <i class="text-success glyphicon glyphicon-ok"></i>
                    <?php else: ?>
                    <a href="<?php echo base_url("semestres/activate/{$item->id}") ?>"><i class="text-muted glyphicon glyphicon-ok"></i></a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>