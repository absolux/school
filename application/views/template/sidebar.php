
<ul class="nav nav-pills nav-stacked">
	<li class="<?php if ( strpos(uri_string(), 'etudiants') === 0 ) echo 'active' ?>">
    <?php echo anchor("etudiants", "Etudiants") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'professeurs') === 0 ) echo 'active' ?>">
    <?php echo anchor("professeurs", "Professeurs") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'groupes') === 0 ) echo 'active' ?>">
    <?php echo anchor("groupes", "Groupes") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'filieres') === 0 ) echo 'active' ?>">
    <?php echo anchor("filieres", "Filières") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'annees-scolaires') === 0 ) echo 'active' ?>">
    <?php echo anchor("annees-scolaires", "Années scolaires") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'semestres') === 0 ) echo 'active' ?>">
    <?php echo anchor("semestres", "Semestres") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'matieres') === 0 ) echo 'active' ?>">
    <?php echo anchor("matieres", "Matières") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'niveaux') === 0 ) echo 'active' ?>">
    <?php echo anchor("niveaux", "Niveaux") ?>
  </li>
	<li class="<?php if ( strpos(uri_string(), 'absences') === 0 ) echo 'active' ?>">
    <?php echo anchor("absences", "Absences") ?>
  </li>
</ul>
