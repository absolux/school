<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>School Management System A-A</title>
	
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-paper.min.css') ?>"/>
  
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view('template/header'); ?>
		</div>

		<div class="row">

			<div class="col-md-2">
			<?php $this->load->view('template/side_bar'); ?>

			</div>
			<div class="col-md-10">
				<?php $this->load->view($content_view); ?>
			</div>
		</div>

		<div class="row">
					<?php $this->load->view('template/footer'); ?>
		</div>

	</div>

	<script src="<?php echo base_url("assets/js/jquery-1.11.2.min.js") ?>"></script>
	<script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>

</body>
</html>
