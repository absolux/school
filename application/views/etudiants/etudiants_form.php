
<?php echo form_open($action, 'class="form-horizontal"', ['id' => $id]) ?>

  <div class="form-group">
    <label for="sexe" class="col-sm-4 control-label">Sexe</label>
    <div class="-col-sm-offset-2 col-sm-8">
      <div class="radio-inline" style="padding-left: 0">
        <label>
          <?php echo form_radio("sexe", 'M', ($sexe == 'M'), 'id="sexe"') ?>
          Masculin
        </label>
      </div>
      <div class="radio-inline">
        <label>
          <?php echo form_radio("sexe", 'F', ($sexe == 'F'), 'id="sexe"') ?>
          Féminin
        </label>
      </div>
      <?php echo form_error("sexe", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <div class="form-group">
    <label for="code" class="col-sm-4 control-label">Code</label>
    <div class="col-sm-3 <?php echo form_error("code") ? 'has-error' : '' ?>">
      <?php echo form_input("code", $code, 'class="form-control" id="code" required') ?>
      <?php echo form_error("code", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="prenom" class="col-sm-4 control-label">Prénom</label>
    <div class="col-sm-6 <?php echo form_error("prenom") ? 'has-error' : '' ?>">
      <?php echo form_input("prenom", $prenom, 'class="form-control" id="prenom" required') ?>
      <?php echo form_error("prenom", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="nom" class="col-sm-4 control-label">Nom</label>
    <div class="col-sm-6 <?php echo form_error("nom") ? 'has-error' : '' ?>">
      <?php echo form_input("nom", $nom, 'class="form-control" id="nom" required') ?>
      <?php echo form_error("nom", '<span class="help-block">', '</span>') ?>
    </div>
  </div>
  
  <div class="form-group">
    <label for="email" class="col-sm-4 control-label">Adresse E-mail</label>
    <div class="col-sm-6 <?php echo form_error("email") ? 'has-error' : '' ?>">
      <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" />
      <?php echo form_error("email", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="tel" class="col-sm-4 control-label">Téléphone</label>
    <div class="col-sm-3 <?php echo form_error("tel") ? 'has-error' : '' ?>">
      <?php echo form_input("tel", $tel, 'class="form-control" id="tel"') ?>
      <?php echo form_error("tel", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="cin" class="col-sm-4 control-label">CIN</label>
    <div class="col-sm-3 <?php echo form_error("cin") ? 'has-error' : '' ?>">
      <?php echo form_input("cin", $cin, 'class="form-control" id="cin"') ?>
      <?php echo form_error("cin", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="date_naiss" class="col-sm-4 control-label">Date de naissance</label>
    <div class="col-sm-3 <?php echo form_error("date_naiss") ? 'has-error' : '' ?>">
      <div class="input-group">
        <input type="text" class="form-control datepicker" id="date_naiss" name="date_naiss" value="<?php echo $date_naiss; ?>" />
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      <?php echo form_error("date_naiss", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="lieu_naiss" class="col-sm-4 control-label">Lieu de naissance</label>
    <div class="col-sm-3 <?php echo form_error("lieu_naiss") ? 'has-error' : '' ?>">
      <input type="text" class="form-control" id="lieu_naiss" name="lieu_naiss" value="<?php echo $lieu_naiss; ?>" />
      <?php echo form_error("lieu_naiss", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="adresse" class="col-sm-4 control-label">Adresse</label>
    <div class="col-sm-6 <?php echo form_error("adresse") ? 'has-error' : '' ?>">
      <?php echo form_input("adresse", $adresse, 'class="form-control" id="adresse"') ?>
      <?php echo form_error("adresse", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="zipcode" class="col-sm-4 control-label">Code postale</label>
    <div class="col-sm-3 <?php echo form_error("zipcode") ? 'has-error' : '' ?>">
      <?php echo form_input("zipcode", $zipcode, 'class="form-control" id="zipcode"') ?>
      <?php echo form_error("zipcode", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <label for="ville" class="col-sm-4 control-label">Ville</label>
    <div class="col-sm-3 <?php echo form_error("ville") ? 'has-error' : '' ?>">
      <?php echo form_input("ville", $ville, 'class="form-control" id="ville"') ?>
      <?php echo form_error("ville", '<span class="help-block">', '</span>') ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
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