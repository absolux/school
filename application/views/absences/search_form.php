<?php echo form_open('absences', 'method=GET"') ?>
  <div class="form-group">
  <div class="form-group">
    <?php echo form_input('d', $d, 'class="form-control datepicker" placeholder="Sélectionnez une date"') ?>
  </div>
    <?php echo form_dropdown('e', ['' => ""] + $etudiants, $e, 'class="form-control select2"') ?>
  </div>
  <div class="form-group">
    <?php echo form_dropdown("m", ['' => "Toutes les matières"] + $matieres, $m, 'class="form-control"') ?>
  </div>
  <div class="form-group">
    <?php echo form_dropdown("s", ['all' => "Tous les semestres"] + $semestres, $s, 'class="form-control"') ?>
  </div>
  
  <button type="submit" class="btn btn-block btn-default">Rechercher</button>
  
  <?php if ( $e != "" OR $d != "" OR $m != "" OR $s != $active_semestre ): ?>
  <?php echo anchor('absences', 'Effacer le filtre', 'class="btn btn-block btn-info"') ?>
  <?php endif; ?>
<?php echo form_close() ?>
  
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    weekStart: 1
  })
  
  $('.select2').select2({
    placeholder: 'Sélectionnez un étudiant',
    allowClear: true,
  })
</script>
<style>
  .select2 {
    width: 100% !important;
  }
  
  .select2 .select2-selection__placeholder {
    
  }
  
  .select2 .select2-selection {
    border: 0;
    border-radius: 0;
    box-shadow: inset 0 -1px 0 #ddd;
  }
  
  /*.select2 .select2-selection:focus {
    -webkit-box-shadow: inset 0 -2px 0 #2196f3;
    box-shadow: inset 0 -2px 0 #2196f3;
  }*/
  
  .select2 .select2-selection .select2-selection__rendered {
    padding-left: 3px;
    padding-right: 13px;
    font-size: 16px;
    line-height: 1.5;
    color: #666666;
  }
  
  .select2 .select2-selection .select2-selection__arrow {
    width: 13px;
    top: 0;
  }
</style>