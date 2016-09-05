
<div class="-page-header">
  <h3>Liste des absences</h3>
</div>

<?php if ( $this->session->message ) : ?>
  <div id="message" class="alert alert-success text-center"><?php echo $this->session->message ?></div>
<?php endif; ?>

<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
      <button data-toggle="modal" data-target="#create-seance-modal" class="btn btn-warning">Créer</button>
    </div>
    
    <div class="col-md-4 text-center"></div>
    
    <div class="col-md-4 text-right">
      <form action="<?php echo site_url('absences/index'); ?>" class="form-inline" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Rechercher">
        </div>
        <span class="form-group-btn">
            <?php echo ($q <> '') ? anchor('absences', '<i class="glyphicon glyphicon-remove"></i>', 'class="btn btn-default" title="Annuler le filtre"') : '' ?>
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </form>
    </div>
</div>

<table class="table -table-bordered table-condensed table-striped table-hover" style="margin-bottom: 10px">
  <thead>
    <tr>
        <th>Code Etudiant</th>
        <th>Nom Etudiant</th>
        <th>Matière</th>
        <th>Date</th>
        <!--<th>Date fin</th>-->
    </tr>
  </thead>
  <tbody>
    <?php if (! count($records) ): ?>
    <tr class="warning text-center"><td colspan="4">Aucun résultat trouvé</td></tr>
    <?php else: ?>
    <?php foreach ($records as $item) : ?>
        <tr>
          <td><?php echo $item->code ?></td>
          <td><?php echo "{$item->prenom} {$item->nom}" ?></td>
          <td><?php echo $item->matiere ?></td>
          <td><?php echo date('Y-m-d', strtotime($item->date_debut)) ?></td>
          <!--<td><?php //echo $item->date_fin ?></td>-->
          <!--<td class="text-right" width="100px">
              <?php //echo anchor('absences/read/'.$item->id,'<i class="glyphicon glyphicon-eye-open"></i>', 'class="btn btn-xs btn-info"'); ?>
              <?php //echo anchor('absences/update/'.$item->id, '<i class="glyphicon glyphicon-pencil"></i>', 'title="Editer" class="btn btn-xs btn-primary"'); ?> 
              <?php //echo anchor('absences/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="btn btn-xs btn-danger"'); ?>
          </td>-->
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

<?php if ( count($records) ): ?>
<div class="row">
    <div class="col-md-6">Total : <?php echo $total_rows ?></div>
    <div class="col-md-6 text-right"><?php echo $pagination ?></div>
</div>
<?php endif; ?>

<div class="modal fade" tabindex="-1" role="dialog" id="create-seance-modal">
  <div class="modal-dialog" role="course-schedule">
    <form action="<?php echo base_url('absences/create') ?>" class="form-horizontal" method="GET">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!--<h4 class="modal-title">Sélectionnez</h4>-->
      </div>
      
      <div class="modal-body">
        
        <!--<div class="form-group">
          <label for="id_matiere" class="col-sm-4 control-label">Matière</label>
          <div class="col-sm-7">
            <?php //echo form_dropdown("id_matiere", ['' => "Sélectionnez"] + $matieres, NULL, 'id=id_matiere class="form-control" required') ?>
          </div>
        </div>-->
        
        <div class="form-group">
          <!--<label for="id_group" class="col-sm-4 control-label">Groupe</label>-->
          <div class="col-sm-offset-2 col-sm-8">
            <?php echo form_dropdown("id_group", ['' => "Sélectionnez le groupe d'étudiant"] + $groupes, NULL, 'id=id_group class="form-control" required') ?>
          </div>
        </div>
        
        <!--<div class="form-group">
          <label for="date_debut" class="col-sm-4 control-label">Date</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" id="date_debut" name="date_debut" />
          </div>
        </div>-->
        
        <!--<div class="form-group">
          <label for="date_fin" class="col-sm-4 control-label">Date fin</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" id="date_fin" name="date_fin" />
          </div>
        </div>-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Suivant</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </form>
</div><!-- /.modal -->