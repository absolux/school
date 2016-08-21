<h3><?php echo $record->prenom.' '.$record->nom ?></h3>
<table class="table table-condensed table-striped table-bordered">
  <tr><th>Adresse E-mail</th><td><?php echo $record->email; ?></td></tr>
	<tr><th>Télephone</th><td><?php echo $record->tel; ?></td></tr>
	<tr><th>CIN</th><td><?php echo $record->cin; ?></td></tr>
	<tr><th>Sexe</th><td><?php echo $record->sexe == 'F'?'Féminin':'Masculin'; ?></td></tr>
</table>
<div class="">
  <?php echo anchor('professeurs/update/' . $record->id, 'Modifier', 'class="btn btn-primary"') ?>
  <?php echo anchor('professeurs/delete/' . $record->id, 'Supprimer', 
    'class="btn btn-danger" onclick="javascrip:return confirm(\'Etes vous sûr ?\')"') ?>
 	<?php echo anchor('professeurs','Retour', 'class="btn btn-default "'); ?>
</div>