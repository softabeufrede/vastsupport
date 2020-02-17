<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 style="display: inline-block;">
          LISTE DES MESSAGES
        </h2>
        <a href="<?= base_url('admin/astucesfitness/add');?>" class="btn bg-deep-orange waves-effect pull-right"><i class="material-icons">person_add</i> AJOUTER UN MESSAGE</a>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>N </th>
                <th>Date d'envoi</th>
                <th>Messages</th>
                <th>Statuts</th>
                <th width="200" class="text-right">Action</th>
              </tr>
            </thead>
           <!-- <tfoot>
              <tr>
                <th>N </th>
                <th>Date d'envoi</th>
                <th>Messages</th>
                <th>Statuts</th>
                <th style="width: 150px;" class="text-right">Action</th>
              </tr>
            </tfoot>--!>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- #END# Exportable Table -->

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Supprimer</h4>
      </div>
      <div class="modal-body">
        <p>Voulez vous supprimer cet element ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	<!--<a href="dfdfd">Supprimer</a>-->
        <a class="btn btn-danger btn-ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>

 <!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
      "processing": true,
      "serverSide": true,
      "ajax": "<?=base_url('admin/astucesfitness/datatable_json1')?>",
      "order": [[0,'desc']],
      "columnDefs": [
        { "targets": 0, "name": "idalertes", 'searchable':true, 'orderable':true},
        { "targets": 1, "name": "dateheureenvoi", 'searchable':true, 'orderable':true},
        { "targets": 2, "name": "messages", 'searchable':true, 'orderable':true},
        { "targets": 3, "name": "etatalerte", 'searchable':true, 'orderable':true},
        { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
      ]
    });
  </script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script> 
<!-- Custom Js -->
 <script src="<?= base_url()?>public/js/pages/tables/jquery-datatable.js"></script>
 <script>
    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    //$("#user_list").addClass('active');
 </script>
  

  

