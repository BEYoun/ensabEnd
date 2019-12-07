<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Commandes

      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Liste des commandes</h3>


          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?= $this->Paginator->sort('id') ?></th>
              <th><?= $this->Paginator->sort('delai_limite') ?></th>
              <th><?= $this->Paginator->sort('nom') ?></th>
              <th><?= $this->Paginator->sort('stock categorie') ?></th>
              <th><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>

                <?php for($i=0;$i<count($commande);$i++): ?>
              <tr>
                <td><?= h($commande[$i]['id']) ?></td>
                <td><?= h($commande[$i]['delai_limite']) ?></td>
                <td><?= h($commande[$i]['nom']) ?></td>
                <td><?= h($commande[$i]['label_cat']) ?></td>
                <td class="actions" style="white-space:nowrap">
                  <?= $this->Html->link(__('détails'), ['action' => 'viewCommandes', $commande[$i]['id']], ['class'=>'btn btn-info btn-xs']) ?>
                </td>
              </tr>
            <?php endfor; ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
  ],
  ['block' => 'css']);

$this->Html->script([
  'AdminLTE./plugins/datatables/jquery.dataTables.min',
  'AdminLTE./plugins/datatables/dataTables.bootstrap.min',
],
['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php $this->end(); ?>
<!-- /.content -->
<div class="modal modal-info fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Modal</h4>
            </div>
            <div class="modal-body">
                <div>
                    <video width="570" height="450" controls="controls" poster="image" preload="true">

                        <source src="/ensab/video/administrateur/classes.webm" type="video/webm">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
