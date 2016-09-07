
<h3><?php echo $button ?> une classe</h3>

<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>
  
  <div class="form-group">
    <label for="label" class="col-sm-2 control-label">Nom</label>
    <div class="col-sm-6 <?php echo form_error("label") ? 'has-error' : '' ?>">
      <?php echo form_input("label", $label, 'class="form-control" id="label" required') ?>
      <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <div class="form-group">
    <label for="id_annee" class="col-sm-2 control-label">Année scolaire</label>
    <div class="col-sm-6 <?php echo form_error("id_annee") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_annee", ['' => "Sélectionnez"] + $annees, $id_annee, 'id=id_annee class="form-control" required') ?>
      <?php echo form_error("id_annee", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <!--<div class="form-group">
    <label for="id_niveau" class="col-sm-2 control-label">Niveau</label>
    <div class="col-sm-6 <?php //echo form_error("id_niveau") ? 'has-error' : '' ?>">
      <?php //echo form_dropdown("id_niveau", ['' => "Sélectionnez"] + $niveaux, $id_niveau, 'id=id_niveau class="form-control" required') ?>
      <?php //echo form_error("id_niveau", '<span class="help-block">', '</span>') ?>
    </div>
  </div>-->

  <div class="form-group">
    <label for="id_filiere" class="col-sm-2 control-label">Filière</label>
    <div class="col-sm-6 <?php echo form_error("id_filiere") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("id_filiere", ['' => "Sélectionnez"] + $filieres, $id_filiere, 'id=id_filiere class="form-control" required') ?>
      <?php echo form_error("id_filiere", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="etudiants" class="col-sm-2 control-label">Etudiants</label>
    <div class="col-sm-6 <?php echo form_error("etudiants[]") ? 'has-error' : '' ?>">
      <?php echo form_dropdown("etudiants[]", $list_etudiants, $etudiants, 'id=etudiants class="form-control" required multiple') ?>
      <?php echo form_error("etudiants[]", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <?php echo anchor('classes', 'Annuler', 'class="btn btn-default"') ?>
    </div>
  </div>

<?php echo form_close() ?>

<script type="text/javascript">
  var $select = $('#etudiants')
  
  $select.select2({
    // theme: 'paper',
    multiple: true,
    language: 'fr',
    placeholder: "Sélectionnez",
  })
</script>
