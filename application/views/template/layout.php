<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>School Management System A-A</title>
	
  <!-- Styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-paper.min.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2.min.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/select2/css/select2-bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/datepicker/css/datepicker.css') ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/typeahead/style.css') ?>" />

  <style>
  	body {
  		background-color: #eee;
  	}
    
    h3, .h3 {
      margin-bottom: 34px;
    }
    
    #page-content {
      padding-top: 75px;
    }
    
    .navbar-brand {
      min-width: 150px;
    }
    
    .navbar-default .dropdown-menu>.active>a,
    .navbar-default .dropdown-menu>.active>a:hover,
    .navbar-default .dropdown-menu>.active>a:focus {
      text-decoration: none;
      color: #141414;
      background-color: #eeeeee;
    }
  </style>
  
  <!-- Scripts -->
	<script src="<?php echo base_url("assets/jquery/jquery-1.11.2.min.js") ?>"></script>
	<script src="<?php echo base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/select2/js/select2.min.js") ?>"></script>
  <script src="<?php echo base_url("assets/select2/js/i18n/fr.js") ?>"></script>
  <script src="<?php echo base_url("assets/datepicker/js/bootstrap-datepicker.js") ?>"></script>
  <script src="<?php echo base_url("assets/typeahead/typeahead.bundle.min.js") ?>"></script>
  
</head>
<body>
  
  <?php $this->load->view('template/header'); ?>
	
  <div class="container" id="page-content">
		<?php $this->load->view($content_view); ?>
	</div>

</body>
</html>
