
<div class="-page-header">
  <h3>Etudiants</h3>
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
          Créer un nouvel étudiant
        </p>
        
        <?php echo form_open('etudiants/create_action', 'class="-form-horizontal"') ?>
          <div class="form-group <?php if ( form_error("code") ) echo 'has-error' ?>">
            <?php echo form_input("code", NULL, 'class="form-control" required placeholder="Code"') ?>
            <?php echo form_error("code", '<span class="help-block">', '</span>') ?>
          </div>
          <div class="form-group <?php if ( form_error("prenom") ) echo 'has-error' ?>">
            <?php echo form_input("prenom", NULL, 'class="form-control" required placeholder="Prénom"') ?>
            <?php echo form_error("prenom", '<span class="help-block">', '</span>') ?>
          </div>
          <div class="form-group <?php if ( form_error("nom") ) echo 'has-error' ?>">
            <?php echo form_input("nom", NULL, 'class="form-control" required placeholder="Nom"') ?>
            <?php echo form_error("nom", '<span class="help-block">', '</span>') ?>
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
              <th>Code</th>
              <th>Nom complet</th>
              <th class="hidden-xs hidden-sm">E-mail</th>
              <th class="hidden-xs">Téléphone</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (! count($records) ): ?>
            <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
            <?php else: ?>
            <?php foreach ($records as $item) : ?>
            <tr>
              <td><?php echo $item->code ?></td>
              <td><?php echo anchor("etudiants/read/{$item->id}", $item->prenom . ' ' . $item->nom) ?></td>
              <td class="hidden-xs hidden-sm"><?php echo $item->email ?></td>
              <td class="hidden-xs"><?php echo $item->tel ?></td>
              <td class="text-right" width="100px">
                <?php echo anchor('etudiants/delete/'.$item->id, '<i class="glyphicon glyphicon-remove"></i>', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="btn btn-xs btn-danger"'); ?>
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
