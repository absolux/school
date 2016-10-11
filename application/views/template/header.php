<nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php echo anchor('/', 'School', 'class="navbar-brand"') ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php if ( strpos(uri_string(), 'professeurs') === 0 ) echo 'active' ?>">
          <?php echo anchor("professeurs", "Professeurs") ?>
        </li>
        <li class="<?php if ( strpos(uri_string(), 'etudiants') === 0 ) echo 'active' ?>">
          <?php echo anchor("etudiants", "Etudiants") ?>
        </li>
        <li class="<?php if ( strpos(uri_string(), 'classes') === 0 ) echo 'active' ?>">
          <?php echo anchor("classes", "Classes") ?>
        </li>
        <li class="dropdown <?php if ( strpos(uri_string(), 'absences') === 0 ) echo 'active' ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
            Absences
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li class="<?php if ( strpos(uri_string(), 'absences') === 0 AND strtolower(uri_string()) !== 'absences/recap' ) echo 'active' ?>">
              <?php echo anchor("absences", "Saisie") ?>
            </li>
            <li class="<?php if ( strpos(uri_string(), 'absences/recap') === 0 ) echo 'active' ?>">
              <?php echo anchor("absences/recap", "Consultation") ?>
            </li>
          </ul>
        </li>
        <li class="<?php if ( strpos(uri_string(), 'annees-scolaires') === 0 ) echo 'active' ?>">
          <?php echo anchor("annees-scolaires", "Années scolaires") ?>
        </li>
        <!--<li class="<?php //if ( strpos(uri_string(), 'niveaux') === 0 ) echo 'active' ?>">
          <?php //echo anchor("niveaux", "Niveaux") ?>
        </li>-->
        <li class="<?php if ( strpos(uri_string(), 'filieres') === 0 ) echo 'active' ?>">
          <?php echo anchor("filieres", "Filières") ?>
        </li>
        <li class="<?php if ( strpos(uri_string(), 'matieres') === 0 ) echo 'active' ?>">
          <?php echo anchor("matieres", "Matières") ?>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="<?php echo site_url('auth/logout') ?>">
            Quitter
            <i class="glyphicon glyphicon-log-out"></i>
          </a>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>