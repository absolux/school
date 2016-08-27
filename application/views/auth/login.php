<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-paper.min.css') ?>" />
</head>
<style>
	body {
		background-color: darkgray;
		font-family: verdana;
		font-size: 12px;
		font-weight: normal;
		padding-top: 14em;
		background: url('<?php  echo base_url('assets/images/school.jpg')  ?>') no-repeat;
		background-position: center;
		background-size: cover;
	}

	.login-form {
		background-color: #fff;
		display: block;
		margin: auto;
		padding: 50px 10px 50px 10px;
		width: 48em;
		border-radius: 4px;
	}

	h1 {
		text-align: center;
		font-size: 24px;
		margin-bottom: 10px;
	}

	.shadow {
		box-shadow: 0px 0px 12px #353535;
	}
</style>

<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="login-form shadow">
					<?php echo form_open("auth/do_login", 'class="form-horizontal"') ?>
						<h1>Login</h1>

						<?php if ( $msg = $this->session->flashdata('msg') ): ?>
							


							<div class="alert alert-warning" role="alert">
								<i class="glyphicon glyphicon-ban-circle"></i> <?php echo $msg ?>
							</div>
						<?php endif ?>

						<div class="form-group">
							<label for="inputEmail" class="col-sm-2 control-label">E-mail</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputEmail" name="email">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-2 control-label">Mot de passe</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="inputPassword" name="password">
							</div>
						</div>
					
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-primary">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>




</body>
</html>