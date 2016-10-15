
<div class="-page-header">
  <h3>Absences <small><i class="glyphicon glyphicon-chevron-right"></i> Récapitulatif</small></h3>
</div>

<div class="row">
  <div class="col-md-3">
    
    <div class="panel panel-default">
      <div class="panel-body">
        
        <?php echo form_open('absences/recap', 'method=GET"') ?>
          <div class="form-group">
            <label class="form-label" for="id_annee">Année scolaire</label>
            <?php echo form_dropdown("id_annee", $annees, $id_annee, 'class="form-control" id=id_annee') ?>
          </div>
          
          <div class="form-group">
            <label class="form-label" for="id_group">Classes</label>
            <?php echo form_dropdown("id_group", ['' => "Sélectionnez une classe"] + $classes, $id_group, 'class="form-control" id=id_group') ?>
          </div>
          
          <button type="submit" class="btn btn-block btn-info">Filtrer</button>
          
          <?php if ( $id_group ): ?>
          <a href="<?php echo site_url(uri_string()) . '?' . $_SERVER['QUERY_STRING'] . '&export=xls' ?>"
             class="btn btn-block btn-success" target="_blank">Exporter à Excel</a>
          <?php endif; ?>
        <?php echo form_close() ?>
        
      </div>
    </div>
    
  </div>
  <div class="col-md-9">
    
    <?php if ( empty($id_group) ): ?>
    <div class="alert alert-warning">
      <p>Sélectionnez une classe pour afficher les absences</p>
    </div>
    <?php else: ?>
    <div class="panel panel-default">
      <div class="panel-body">
        
        <table class="table -table-bordered table-condensed table-striped table-hover" style="margin-bottom: 10px">
          <thead>
            <tr>
              <th>Etudiant</th>
              <th class="hidden-xs text-center">Semestre 1</th>
              <th class="hidden-xs text-center">Semestre 2</th>
              <th class="text-center">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if (! count($records) ): ?>
            <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
            <?php else: ?>
            <?php foreach ($records as $item) : ?>
            <tr>
              <td><?php echo anchor("absences?e={$item->id}&s=all&a={$id_annee}", "{$item->code} {$item->prenom} {$item->nom}") ?></td>
              <td class="hidden-xs text-center"><?php echo $s1 = (int) $item->s1 ?></td>
              <td class="hidden-xs text-center"><?php echo $s2 = (int) $item->s2 ?></td>
              <td class="text-center <?php echo ($s1 > 0 OR $s2 > 0) ? 'text-danger' : '' ?>">
                <b><?php echo $s1 + $s2 ?></b>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        
      </div>
    </div>
    <?php endif; ?>
    
  </div>
</div>

<script type="text/javascript">
  $('#id_annee').change(function (e) {
    location.href = "<?php echo base_url('absences/recap?id_annee=') ?>" + $(this).val()
  })
</script>
