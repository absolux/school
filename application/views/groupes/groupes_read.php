
<div class="row">
  <div class="col-sm-6"><h3><?php echo $record->label ?></h3>
    <table class="table table-condensed table-striped -table-bordered">
      <tr><th>Année scolaire</th><td><?php echo $record->annee; ?></td></tr>
      <!--<tr><th>Niveau</th><td><?php //echo $record->niveau; ?></td></tr>-->
      <tr><th>Filière</th><td><?php echo $record->filiere; ?></td></tr>
    </table>
    <div class="">
      <?php echo anchor('classes/update/' . $record->id, 'Modifier', 'class="btn btn-primary"') ?>
      <?php echo anchor('classes/delete/' . $record->id, 'Supprimer', 
        'class="btn btn-danger" onclick="javascrip:return confirm(\'Etes vous sûr ?\')"') ?>
      <?php echo anchor('classes','Retour', 'class="btn btn-default "'); ?>
    </div>
  </div>
  
  <div class="col-sm-6">
    <h3>Etudiants</h3>
    <table class="table table-condensed table-striped">
      <!--<thead>
        <tr>
          <th>Code</th>
          <th>Prénom</th>
          <th>Nom</th>
        </tr>
      </thead>-->
      <tbody>
        <?php if (! count($etudiants) ): ?>
          <tr class="warning text-center"><td colspan="3">Aucun étudiant trouvé</td></tr>
        <?php else: ?>
        <?php foreach ($etudiants as $item) : ?>
            <tr>
            <td><?php echo anchor('etudiants/read/' . $item->id, $item->code) ?></td>
            <td><?php echo $item->prenom . ' ' . $item->nom ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>