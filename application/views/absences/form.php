
<style>
  .form-horizontal .radio-inline {
    padding-top: 0;
  }
</style>

<?php echo form_open($action, 'class="form-horizontal"', ['id_group' => $id_group, 'id' => $id]) ?>
  
  <div class="form-group">
    <label for="title" class="col-sm-3 control-label">Libellé</label>
    <div class="col-sm-7 <?php echo form_error("title") ? 'has-error' : '' ?>">
      <?php echo form_input("title", $title, 'class="form-control" id="title" required') ?>
      <?php echo form_error("title", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="id_matiere" class="col-sm-3 control-label">Matière</label>
    <div class="col-sm-7 -has-warning <?php echo form_error("id_matiere") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_matiere", ['' => "Sélectionnez"] + $matieres, $id_matiere, 'id=id_matiere class="form-control" required') ?>
      <?php echo form_error("id_matiere", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <?php if ( $create ): ?>
  <?php echo form_hidden('id_semestre', $id_semestre) ?>
  <?php else: ?>
  <div class="form-group">
    <label for="id_semestre" class="col-sm-3 control-label">Semestre</label>
    <div class="col-sm-7 -has-warning <?php echo form_error("id_semestre") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_semestre", ['' => "Sélectionnez"] + $semestres, $id_semestre, 'id=id_semestre class="form-control" required') ?>
      <?php echo form_error("id_semestre", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="form-group">
    <label for="date_debut" class="col-sm-3 control-label">Date</label>
    <div class="col-sm-4 <?php echo form_error("date_debut") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" id="date_debut" name="date_debut" class="form-control datepicker" value="<?php echo $date_debut ?>" required />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_debut", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <br />
  <div class="col-md-offset-3 col-md-7" style="padding-left: 0;">
  <table class="table table-condensed">
    <tbody>
      <?php $i = 0; foreach ($etudiants as $item): ?>
      <?php $is_present = isset($presence[$item->id]) ? (bool) $presence[$item->id] : TRUE ?>
      <tr>
        <td>
          <?php echo "{$item->code} {$item->prenom} {$item->nom}" ?>
          <?php echo form_hidden("presence[{$i}][id_etudiant]", $item->id) ?>
        </td>
        <td style="width: 80px;">
          <label class="radio-inline">
            <?php echo form_radio("presence[{$i}][statut]", 1, $is_present) ?>
            Présent
          </label>
        </td>
        <td style="width: 80px;">
          <label class="radio-inline">
            <?php echo form_radio("presence[{$i}][statut]", 0, !$is_present) ?>  
            Absent
          </label>
        </td>
      </tr>
      <?php $i++; endforeach; ?>
    </tbody>
  </table>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
      <button type="submit" class="btn btn-success">
        <i class="glyphicon glyphicon-save"></i>
        Enregistrer
      </button>
    </div>
  </div>

<?php echo form_close() ?>

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1
  })
</script>