<?php echo form_open('absences', 'method=GET"') ?>
  <div class="form-group">
    <?php echo form_input("q", $q, 'class="form-control" placeholder="Entrez un étudiant"') ?>
  </div>
  <div class="form-group">
    <?php echo form_input('d', $d, 'class="form-control datepicker" placeholder="Sélectionner une date"') ?>
  </div>
  <div class="form-group">
    <?php echo form_dropdown("m", ['' => "Sélectionnez une matière"] + $matieres, $m, 'class="form-control"') ?>
  </div>
  <div class="form-group">
    <?php echo form_dropdown("s", ['' => "Sélectionnez un semestre"] + $semestres, $s, 'class="form-control"') ?>
  </div>
  
  <button type="submit" class="btn btn-block btn-default">Rechercher</button>
  
  <?php if ( $q != "" OR $d != "" OR $m != "" OR $s != "" ): ?>
  <?php echo anchor('absences', 'Effacer le filtre', 'class="btn btn-block btn-info"') ?>
  <?php endif; ?>
<?php echo form_close() ?>
  
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1
  })
</script>