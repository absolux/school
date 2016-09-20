
<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>
  
  <div class="form-group">
    <label class="col-sm-3 control-label">Statut</label>
    <div class="col-sm-9">
      <p class="form-control-static">
        <span class="label label-<?php echo ($active) ? 'success' : 'default' ?>"><?php echo ($active) ? 'Active' : 'Inactive' ?><span>
      </p>
    </div>
  </div>

  <div class="form-group">
    <label for="label" class="col-sm-3 control-label">Libellé</label>
    <div class="col-sm-9 <?php echo form_error("label") ? 'has-error' : '' ?>">
      <?php echo form_input("label", $label, 'class="form-control" id="label" required') ?>
      <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_debut" class="col-sm-3 control-label">Date début</label>
    <div class="col-sm-9 <?php echo form_error("date_debut") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" class="form-control datepicker" id="date_debut" name="date_debut" value="<?php echo $date_debut; ?>" />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_debut", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_fin" class="col-sm-3 control-label">Date fin</label>
    <div class="col-sm-9 <?php echo form_error("date_fin") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" class="form-control datepicker" id="date_fin" name="date_fin" value="<?php echo $date_fin; ?>" />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_fin", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <br />
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">
        <i class="glyphicon glyphicon-save"></i>
        Modifier
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