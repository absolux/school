<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Authentification</title>
  
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-paper.min.css') ?>" />
  
  <style>
    body {
      padding-top: 15em;
      background-color: #009688;
      background: url('<?php  echo base_url('assets/images/school.jpg')  ?>') no-repeat;
      /*background: url('http://percolatestudio.com/img/how-ipadair-600x450@2x.jpg') no-repeat;*/
      background-position: center;
      background-size: cover;
      min-height: 100vh;
    }

    .login-form {
      background-color: #fff;
      display: block;
      margin: auto;
      width: 80%;
      padding: 35px 50px;
      max-width: 38em;
      border-radius: 4px;
      position: relative;
    }

    h1 {
      margin-top: 0;
      margin-bottom: 20px;
    }

    .shadow {
      box-shadow: 0px 0px 12px #353535;
    }
    
    .login-content {
      text-align: center;
    }
    
    .form-group {
      margin-bottom: 30px;
      margin-right: 0 !important;
    }
  </style>
</head>

<body>
	<div class="container login-content">
				<div class="login-form shadow">
					<?php echo form_open("auth/do_login", 'class="form-horizontal"') ?>
						<!--<h1 class="text-center">Login</h1>-->

						<?php if ( $msg = $this->session->flashdata('logout-success') ): ?>
							<div class="alert alert-success text-center" role="alert">
                Vous vous êtes déconnecté.
              </div>
						<?php endif ?>
            
            <?php if ( $msg = $this->session->flashdata('login-error') ): ?>
							<div class="alert alert-warning text-center" role="alert"><?php echo $msg ?></div>
						<?php endif ?>
            
            <div class="form-group">
              <label class="sr-only" for="email">Adresse E-mail</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" />
              </div>
            </div>
            
            <div class="form-group">
              <label class="sr-only" for="password">Mot de passe</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" />
              </div>
            </div>
					
            <div class="text-right">
						<button type="submit" class="btn btn-info">
              Login &nbsp;
              <i class="glyphicon glyphicon-log-in"></i>
            </button>
            </div>
            
					</form>
				</div>
		</div>
</body>

</html>