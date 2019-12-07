<section class="content">
<?php
  if($_SESSION['iss']=='yes')
  { ?>
  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i>L'action a été effectuée avec succès</h4>

                  </div>
 <?php }
?>
	<div class="box box-primary">
                <div class="box-header with-border center-block">

                </div>
                <div class="box-body">
                   <div class="row">
                   <div class="col-md-4"></div>
                     <div class="col-md-4"><?php
echo $this->form->create('');?>
<div class="form-group">
              <label>Choisir classe:</label>
              <select name="classe"  class="form-control">
              <option value="0" selected="true">Toutes les classes</option>
              <?php
                foreach ($_SESSION['classes'] as $classe)
                {
                  echo '<option value='.$classe['id'].'>'.$classe['n'].' '.$classe['f'].'</option>';
                }
              ?>
              </select>
              </div>
              <button class="btn btn-block btn-primary" name="choix"><i class="fa fa-fw fa-gg"></i>Choisir</button>
<?php
echo $this->form->end();
?></div>
                   </div>

                </div>
                </div>

</section>
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

                        <source src="/ensab/video/administrateur/autorisation d'acces.webm" type="video/webm">
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
