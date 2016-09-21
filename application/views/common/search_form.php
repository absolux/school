<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<form action="<?php echo site_url(uri_string()); ?>" class="form-inline" method="GET">
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Rechercher">
      <span class="input-group-addon" style="padding-right: 0;"><i class="glyphicon glyphicon-search"></i></span>
    </div>
  </div>
</form>

<?php if ( isset($q) AND $q != "" ): ?>
<br />
<a href="<?php echo uri_string() ?>" class="btn btn-block btn-default">Annuler le filtre</a>
<?php endif; ?>