
<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>
  
  <div class="form-group">
    <label for="label" class="col-sm-3 control-label">Libellé</label>
    <div class="col-sm-8 <?php echo form_error("label") ? 'has-error' : '' ?>">
      <?php echo form_input("label", $label, 'class="form-control" id="label" required') ?>
      <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="id_filiere" class="col-sm-3 control-label">Filière</label>
    <div class="col-sm-8 <?php echo form_error("id_filiere") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_filiere", ['' => "Sélectionnez"] + $filieres, $id_filiere, 'id=id_filiere class="form-control" required') ?>
      <?php echo form_error("id_filiere", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <div class="form-group">
    <label for="id_annee" class="col-sm-3 control-label">Année scolaire</label>
    <div class="col-sm-8 <?php echo form_error("id_annee") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_annee", ['' => "Sélectionnez"] + $annees, $id_annee, 'id=id_annee class="form-control" required') ?>
      <?php echo form_error("id_annee", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">
        <i class="glyphicon glyphicon-save"></i>
        Modifier
      </button>
    </div>
  </div>

<?php echo form_close() ?>
