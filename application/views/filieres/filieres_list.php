
<div class="-page-header">
  <h3>Filières</h3>
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
          Créer une nouvelle filière
        </p>
        
        <?php echo form_open('filieres/create_action', 'class="-form-horizontal"') ?>
          <div class="form-group <?php if ( form_error("label") ) echo 'has-error' ?>">
            <?php echo form_input("label", NULL, 'class="form-control" required placeholder="Libellé"') ?>
            <?php echo form_error("label", '<span class="help-block">', '</span>') ?>
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
        
        <table class="table table-condensed table-striped table-hover" style="margin-bottom: 10px">
          <thead>
            <tr>
              <th>Nom de filière</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (! count($records) ): ?>
            <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
            <?php else: ?>
            <?php foreach ($records as $item) : ?>
            <tr>
              <td><?php echo anchor("filieres/read/{$item->id}", $item->label) ?></td>
              <td><?php echo substr($item->description, 0, 65) . '...' ?></td>
              <td class="text-right" width="100px">
                <?php echo anchor('filieres/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="btn btn-xs btn-danger"'); ?>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>

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
