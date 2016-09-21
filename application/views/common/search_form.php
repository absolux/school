<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<form action="<?php echo site_url(uri_string()); ?>" class="form-inline" method="GET">
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Rechercher">
      <span class="input-group-btn">
        <?php echo (isset($q) AND $q <> '') ? anchor(uri_string(), '<i class="glyphicon glyphicon-remove"></i>', 'class="btn btn-default" title="Annuler le filtre"') : '' ?>
        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </span>
    </div>
  </div>
</form>