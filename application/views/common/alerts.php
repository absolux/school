<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php if ( $this->session->success ) : ?>
  <div id="message" class="alert alert-success alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->success ?>
  </div>
<?php endif; ?>

<?php if ( $this->session->info ) : ?>
  <div id="message" class="alert alert-info alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->info ?>
  </div>
<?php endif; ?>

<?php if ( $this->session->error ) : ?>
  <div id="message" class="alert alert-danger alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->error ?>
  </div>
<?php endif; ?>

<?php if ( $this->session->warning ) : ?>
  <div id="message" class="alert alert-warning alert-dismissible text-center">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->warning ?>
  </div>
<?php endif; ?>