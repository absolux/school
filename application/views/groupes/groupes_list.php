
<div class="-page-header">
  <h3>Classes</h3>
</div>

<div class="row">
  <div class="col-md-3">
    
    <div class="panel panel-default">
      <div class="panel-body">
        
        <?php $this->load->view('common/search_form') ?>
        
      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-body">
        <p class="-lead">
          Créer une nouvelle classe
        </p>
        
        <?php echo form_open('classes/create_action', 'class="-form-horizontal"') ?>
          <div class="form-group <?php if ( form_error("label") ) echo 'has-error' ?>">
            <?php echo form_input("label", $label, 'class="form-control" required placeholder="Libellé"') ?>
            <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
          </div>
          <div class="form-group <?php echo form_error("id_annee") ? 'has-error' : '' ?>">
            <?php echo form_dropdown("id_annee", ['' => "Sélectionnez l'année scolaire"] + $annees, $id_annee, 'id=id_annee class="form-control" required') ?>
            <?php echo form_error("id_annee", '<span class="help-block">', '</span>') ?>
          </div>
          <div class="form-group <?php echo form_error("id_filiere") ? 'has-error' : '' ?>">
            <?php echo form_dropdown("id_filiere", ['' => "Sélectionnez la filière"] + $filieres, $id_filiere, 'id=id_filiere class="form-control" required') ?>
            <?php echo form_error("id_filiere", '<span class="help-block">', '</span>') ?>
          </div>
          <button type="submit" class="btn btn-block btn-primary">Créer</button>
        <?php echo form_close() ?>
        
      </div>
    </div>
    
  </div>
  <div class="col-md-9">
    <?php $this->load->view('common/alerts') ?>
    
    <div class="panel panel-default">
      <div class="panel-body">
        
        <table class="table table-condensed table-striped table-hover" style="margin-bottom: 10px;">
          <thead>
            <tr>
              <th>Libellé</th>
              <th class="hidden-xs">Filière</th>
              <th class="hidden-sm hidden-xs">Année scolaire</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (! count($records) ): ?>
            <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
            <?php else: ?>
            <?php foreach ($records as $item) : ?>
            <tr>
              <td><?php echo anchor("classes/read/{$item->id}", $item->label) ?></td>
              <td class="hidden-xs"><?php echo $item->filiere ?></td>
              <td class="hidden-sm hidden-xs"><?php echo $item->annee ?></td>
              <td class="text-right" width="100px">
                <?php echo anchor("classes/delete/{$item->id}", '&times;', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="close"'); ?>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
        
        <?php if ( count($records) ): ?>
        <div class="row">
          <div class="col-md-6 hidden-xs">Total : <?php echo $total_rows ?></div>
          <div class="col-md-6 text-right"><?php echo $pagination ?></div>
        </div>
        <?php endif; ?>
        
      </div>
    </div>
    
  </div>
</div>
