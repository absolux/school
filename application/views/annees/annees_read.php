
<div class="-page-header">
  <h3>Années scolaires <small>Détail</small></h3>
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
                  <th></th>
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
                    <i class="text-<?php echo ($item->active) ? 'success' : 'muted' ?> glyphicon glyphicon-ok"></i>
                  </td>
                  <td class="text-right" width="100px">
                    <?php if (! $item->active ) echo anchor("semestres/activate/{$item->id}",'<i class="glyphicon glyphicon-ok"></i>', 'class="btn btn-xs btn-success" title=Activer'); ?>
                    <?php //echo anchor('semestres/update/'.$item->id, '<i class="glyphicon glyphicon-pencil"></i>', 'title="Editer" class="btn btn-xs btn-primary"'); ?> 
                    <?php //echo anchor('semestres/delete/'.$item->id, '<i class="glyphicon glyphicon-remove"></i>', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="btn btn-xs btn-danger"'); ?>
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