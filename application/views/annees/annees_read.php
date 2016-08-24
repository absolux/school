<h3><?php echo $record->label ?></h3>
<table class="table table-condensed table-striped table-bordered">
  <tr><th>Statut</th><td><span class="label label-<?php echo ($record->active) ? 'success' : 'default' ?>"><?php echo ($record->active) ? 'Active' : 'Inactive' ?></td></tr>
	<tr><th>Date début</th><td><?php echo $record->date_debut; ?></td></tr>
	<tr><th>Date fin</th><td><?php echo $record->date_fin; ?></td></tr>
</table>
<div class="">
  <?php echo anchor('annees-scolaires/update/' . $record->id, 'Modifier', 'class="btn btn-primary"') ?>
  <?php echo anchor('annees-scolaires/delete/' . $record->id, 'Supprimer', 
    'class="btn btn-danger" onclick="javascrip:return confirm(\'Etes vous sûr ?\')"') ?>
 	<?php echo anchor('annees-scolaires','Retour', 'class="btn btn-default "'); ?>
</div>