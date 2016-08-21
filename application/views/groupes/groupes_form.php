
<h3><?php echo $button ?> un groupe</h3>

<div class="alert alert-info">
  <b>Info</b> La fonctionnalité d'ajout des étudiants dans un groupe est en cours de développement
</div>

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
      <select class="form-control" id="id_annee" name="id_annee" required>
        <option></option>
        <?php foreach ( $annees as $a ): ?>
        <option value="<?php echo $a->id ?>" <?php echo ($id_annee == $a->id) ? 'selected' : '' ?>><?php echo $a->label ?></option>
        <?php endforeach; ?>
      </select>
      <?php echo form_error("id_annee", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="id_niveau" class="col-sm-2 control-label">Niveau</label>
    <div class="col-sm-6 <?php echo form_error("id_niveau") ? 'has-error' : '' ?>">
      <select class="form-control" id="id_niveau" name="id_niveau" required>
        <option></option>
        <?php foreach ( $niveaux as $n ): ?>
        <option value="<?php echo $n->id ?>" <?php echo ($id_niveau == $n->id) ? 'selected' : '' ?>><?php echo $n->label ?></option>
        <?php endforeach; ?>
      </select>
      <?php echo form_error("id_niveau", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="id_filiere" class="col-sm-2 control-label">Année scolaire</label>
    <div class="col-sm-6 <?php echo form_error("id_filiere") ? 'has-error' : '' ?>">
      <select class="form-control" id="id_filiere" name="id_filiere" required>
        <option></option>
        <?php foreach ( $filieres as $f ): ?>
        <option value="<?php echo $f->id ?>" <?php echo ($id_filiere == $f->id) ? 'selected' : '' ?>><?php echo $f->label ?></option>
        <?php endforeach; ?>
      </select>
      <?php echo form_error("id_filiere", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
      <?php echo anchor('groupes', 'Annuler', 'class="btn btn-default"') ?>
    </div>
  </div>

<?php echo form_close() ?>