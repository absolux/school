
<h3><?php echo $button ?> un niveau</h3>

<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>
  
  <div class="form-group">
    <label for="label" class="col-sm-2 control-label">Nom</label>
    <div class="col-sm-6 <?php echo form_error("label") ? 'has-error' : '' ?>">
      <?php echo form_input("label", $label, 'class="form-control" id="label" required') ?>
      <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <!--<div class="form-group">
    <label for="description" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-6 <?php //echo form_error("description") ? 'has-error' : '' ?>">
      <?php //echo form_textarea("description", $description, 'class="form-control" id="description"') ?>
      <?php //echo form_error("description", '<span class="help-block">', '</span>') ?>
    </div>
  </div>-->

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <?php echo anchor('niveaux', 'Annuler', 'class="btn btn-default"') ?>
    </div>
  </div>

<?php echo form_close() ?>