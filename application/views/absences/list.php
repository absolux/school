
<div class="-page-header">
  <h3>Absences</h3>
</div>

<div class="row">
  <div class="col-md-3">
    
    <div class="panel panel-default">
      <div class="panel-body">
        
        <?php echo form_open('absences/create', 'method=GET"') ?>
          <div class="form-group">
            <?php echo form_dropdown("id_group", ['' => "Sélectionnez une classe"] + $groupes, NULL, 'class="form-control" required') ?>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Ajouter</button>
        <?php echo form_close() ?>
        
      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-body">
        
        <?php $this->load->view('absences/search_form') ?>
        
      </div>
    </div>
    
  </div>
  <div class="col-md-9">
    <?php $this->load->view('common/alerts') ?>
    
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table -table-bordered table-condensed table-striped table-hover" style="margin-bottom: 10px">
            <thead>
              <tr>
                <th>Etudiant</th>
                <th>Séance</th>
                <th>Matière</th>
                <th>Date</th>
                <th>Période</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if (! count($records) ): ?>
              <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
              <?php else: ?>
              <?php foreach ($records as $item) : ?>
              <tr>
                <td><?php echo "{$item->code} {$item->prenom} {$item->nom}" ?></td>
                <td><?php echo anchor("absences/update/{$item->id_seance}", $item->seance_title) ?></td>
                <td><?php echo $item->matiere ?></td>
                <td><?php echo date('Y-m-d', strtotime($item->date_debut)) ?></td>
                <td><?php echo $item->semestre ?></td>
                <td class="text-right" width="30">
                  <?php echo anchor('matieres/delete/'.$item->id, '&times;', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="close"'); ?>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        
        <?php if ( count($records) ): ?>
        <div class="row">
            <div class="col-md-6">Total : <?php echo $total_rows ?></div>
            <div class="col-md-6 text-right"><?php echo $pagination ?></div>
        </div>
        <?php endif; ?>
        
      </div>
    </div>
    
  </div>
</div>
