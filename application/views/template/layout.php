<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>School Management System A-A</title>
	
  <!-- Styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-paper.min.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2.min.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2-bootstrap.min.css') ?>" />

  <style>
  	body {
  		/* font-family: verdana; */
  		/*background-color:#F5F5F5*/
  	}
    
    optgroup {
      background: #ddd;
    }
  </style>
  
  <!-- Scripts -->
	<script src="<?php echo base_url("assets/jquery/jquery-1.11.2.min.js") ?>"></script>
	<script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/select2/js/select2.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/select2/js/i18n/fr.js") ?>"></script>
  
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view('template/header'); ?>
		</div>

		<div class="row">

			<div class="col-md-2" >
			<?php $this->load->view('template/sidebar'); ?>

			</div>
			<div class="col-md-10">
				<?php $this->load->view($content_view); ?>
			</div>
		</div>

		<div class="row">
					<?php $this->load->view('template/footer'); ?>
		</div>

	</div>

</body>
</html>
