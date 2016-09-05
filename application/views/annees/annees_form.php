
<h3><?php echo $button ?> une année scolaire</h3>

<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>
  
  <div class="form-group">
    <label for="label" class="col-sm-2 control-label">Nom</label>
    <div class="col-sm-6 <?php echo form_error("label") ? 'has-error' : '' ?>">
      <?php echo form_input("label", $label, 'class="form-control" id="label" required') ?>
      <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_debut" class="col-sm-2 control-label">Date début</label>
    <div class="col-sm-3 <?php echo form_error("date_debut") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" class="form-control datepicker" id="date_debut" name="date_debut" value="<?php echo $date_debut; ?>" />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_debut", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_fin" class="col-sm-2 control-label">Date fin</label>
    <div class="col-sm-3 <?php echo form_error("date_fin") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" class="form-control datepicker" id="date_fin" name="date_fin" value="<?php echo $date_fin; ?>" />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_fin", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="active" class="col-sm-2 control-label"></label>
    <div class="col-sm-3">
      <?php echo form_hidden("active", '0') ?>
      <label>
        <?php echo form_checkbox("active", '1', $active == 1, 'id=active') ?>
        Active ?
      </label>
      <?php echo form_error("active", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <?php echo anchor('annees-scolaires', 'Annuler', 'class="btn btn-default"') ?>
    </div>
  </div>

<?php echo form_close() ?>

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1
  })
</script>