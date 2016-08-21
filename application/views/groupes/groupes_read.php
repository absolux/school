<h3><?php echo $record->label ?></h3>
<table class="table table-condensed table-striped table-bordered">
  <tr><th>Année scolaire</th><td><?php echo $record->annee; ?></td></tr>
	<tr><th>Niveau</th><td><?php echo $record->niveau; ?></td></tr>
	<tr><th>Filière</th><td><?php echo $record->filiere; ?></td></tr>
</table>
<div class="">
 	<?php echo anchor('groupes','Retour', 'class="btn btn-default "'); ?>
</div>