
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
            <?php echo form_dropdown("id_group", ['' => "Toutes les classes"] + $classes, $id_group, 'class="form-control" id=id_group') ?>
          </div>
          
          <button type="submit" class="btn btn-block btn-info">Filtrer</button>
        <?php echo form_close() ?>
        
      </div>
    </div>
    
  </div>
  <div class="col-md-9">
    
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
              <td><?php echo anchor("absences?e={$item->id}", "{$item->code} {$item->prenom} {$item->nom}") ?></td>
              <td class="hidden-xs text-center"><?php echo $s1 = (int) $item->s1 ?></td>
              <td class="hidden-xs text-center"><?php echo $s2 = (int) $item->s2 ?></td>
              <td class="text-center"><?php echo $s1 + $s2 ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        
      </div>
    </div>
    
  </div>
</div>
