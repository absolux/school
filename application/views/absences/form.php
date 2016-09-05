
<h3>Saisir la présence</h3>

<?php echo form_open($action, 'class="form-horizontal"', ['id_group' => $id_group]) ?>
  
  <div class="form-group">
    <label for="id_matiere" class="col-sm-2 control-label">Matière</label>
    <div class="col-sm-6 has-warning <?php //echo form_error("id_matiere") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_matiere", ['' => "Sélectionnez"] + $matieres, $id_matiere, 'id=id_matiere class="form-control" required') ?>
      <?php echo form_error("id_matiere", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_debut" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-3 has-warning <?php //echo form_error("date_debut") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" id="date_debut" name="date_debut" class="form-control datepicker" value="<?php echo $date_debut ?>" required />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_debut", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <!--<div class="form-group">
    <label for="date_fin" class="col-sm-2 control-label">Date fin</label>
    <div class="col-sm-3 <?php //echo form_error("date_fin") ? 'has-error' : '' ?>">
      <input type="date" id="date_fin" name="date_fin" class="form-control" value="<?php //echo $date_fin ?>" />
      <?php //echo form_error("date_fin", '<span class="help-block">', '</span>') ?>
    </div>
  </div>-->
  
  <br />
  <div class="col-md-offset-2 col-md-6" style="padding-left: 0;">
  <table class="table table-condensed">
    <tbody>
      <?php $i = 0; foreach ($etudiants as $item): ?>
      <tr>
        <td>
          <?php echo "{$item->code} {$item->prenom} {$item->nom}" ?>
          <?php echo form_hidden("presence[{$i}][id_etudiant]", $item->id) ?>
        </td>
        <td style="width: 80px;">
          <label class="radio-inline">
            <input type="radio" name="presence[<?php echo $i ?>][statut]" value="1" checked />
            Présent
          </label>
        </td>
        <td style="width: 80px;">
          <label class="radio-inline">
            <input type="radio" name="presence[<?php echo $i ?>][statut]" value="0" />
            Absent
          </label>
        </td>
      </tr>
      <?php $i++; endforeach; ?>
    </tbody>
  </table>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Enregistrer</button>
      <?php echo anchor('absences', 'Annuler', 'class="btn btn-default"') ?>
    </div>
  </div>

<?php echo form_close() ?>

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1
  })
</script>