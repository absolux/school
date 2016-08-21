<h3><?php echo $record->prenom.' '.$record->nom ?>  </h3>
<table class="table table-condensed table-striped table-bordered">
  <tr><th>Code</th><td><?php echo $record->code; ?></td></tr>
  <tr><th>Adresse E-mail</th><td><?php echo $record->email; ?></td></tr>
	<tr><th>Adresse</th><td><?php echo $record->adresse .' '.$record->zipcode.', '.$record->ville; ?></td></tr>
	<tr><th>Télephone</th><td><?php echo $record->tel; ?></td></tr>
	<tr><th>CIN</th><td><?php echo $record->cin; ?></td></tr>
	<tr><th>Date de naissance</th><td><?php echo $record->date_naiss; ?></td></tr>
	<tr><th>Lieu de naissance</th><td><?php echo $record->lieu_naiss; ?></td></tr>
	<tr><th>Sexe</th><td><?php echo $record->sexe == 'F'?'Féminin':'Masculin'; ?></td></tr>
	<tr><th>Enregistré le </th><td><?php echo $record->created; ?></td></tr>
</table>
<div class="">
  <?php echo anchor('etudiants/update/' . $record->id, 'Modifier', 'class="btn btn-primary"') ?>
  <?php echo anchor('etudiants/delete/' . $record->id, 'Supprimer', 
    'class="btn btn-danger" onclick="javascrip:return confirm(\'Etes vous sûr ?\')"') ?>
  <?php echo anchor('etudiants','Retour', 'class="btn btn-default "'); ?>
</div>