
<div class="-page-header">
  <h3>Liste des groupes</h3>
</div>

<?php if ( $this->session->message ) : ?>
  <div id="message" class="alert alert-success text-center"><?php echo $this->session->message ?></div>
<?php endif; ?>

<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('groupes/create'),'Créer un groupe', 'class="btn btn-warning"'); ?>
    </div>
    
    <div class="col-md-4 text-center"></div>
    
    <div class="col-md-4 text-right">
      <form action="<?php echo site_url('groupes/index'); ?>" class="form-inline" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Rechercher">
        </div>
        <span class="form-group-btn">
            <?php echo ($q <> '') ? anchor('groupes', '<i class="glyphicon glyphicon-remove"></i>', 'class="btn btn-default" title="Annuler le filtre"') : '' ?>
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
        </span>
      </form>
    </div>
</div>

<table class="table -table-bordered table-condensed table-striped table-hover" style="margin-bottom: 10px">
    <tr>
        <th>Nom du groupe</th>
        <th>Année scolaire</th>
        <th>Niveau</th>
        <th>Filière</th>
        <th></th>
    </tr>
    <?php if (! count($records) ): ?>
    <tr class="warning text-center"><td colspan="7">Aucun résultat trouvé</td></tr>
    <?php else: ?>
    <?php foreach ($records as $item) : ?>
        <tr>
         <td><?php echo $item->label ?></td>
         <td><?php echo $item->annee ?></td>
         <td><?php echo $item->niveau ?></td>
         <td><?php echo $item->filiere ?></td>
         <td style="text-align:center" width="100px">
            <?php echo anchor('groupes/read/'.$item->id,'<i class="glyphicon glyphicon-eye-open"></i>', 'class="btn btn-xs btn-info"'); ?>
            <?php echo anchor('groupes/update/'.$item->id, '<i class="glyphicon glyphicon-pencil"></i>', 'title="Editer" class="btn btn-xs btn-primary"'); ?> 
            <?php echo anchor('groupes/delete/'.$item->id, '<i class="glyphicon glyphicon-trash"></i>', 'onclick="javasciprt: return confirm(\'Etes vous sûr ?\')" title="Supprimer" class="btn btn-xs btn-danger"'); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php if ( count($records) ): ?>
<div class="row">
    <div class="col-md-6">Total : <?php echo $total_rows ?></div>
    <div class="col-md-6 text-right"><?php echo $pagination ?></div>
</div>
<?php endif; ?>