    
 
<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->

<!-- Widgets-->

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <!-- <div class="icon">
                    <i class="material-icons">face</i>
                </div> -->
                <div class="content">
                    <div class="text">Total Abonnés</div>
                    <div class="number count-to" data-from="0" data-to="<?= $nbsouscription;?>"> </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <!-- <div class="icon">
                    <i class="material-icons">people</i>
                </div> -->
                <div class="content">
                    <div class="text">Désouscription</div>
                    <div class="number count-to" data-from="0" data-to="<?= $active_users; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <!-- <div class="icon">
                    <i class="material-icons">block</i>
                </div> -->
                <div class="content">
                    <div class="text">Souscription du jour</div>
                    <div class="number count-to" data-from="0" data-to="<?= $deactive_users; ?>" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <!-- <div class="icon">
                    <i class="material-icons">equalizer</i>
                </div> -->
                <div class="content">
                    <div class="text">Alertes du jour</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-purple hover-expand-effect">
               <!--  <div class="icon">
                    <i class="material-icons">equalizer</i>
                </div> -->
                <div class="content">
                    <div class="text">Montant total du jour</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
 <!-- #END# essai -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 style="display: inline-block;">
          LISTE DES souscriptions
        </h2>
      </div>
      
      <div class="body">
        <div class="table-responsive">
          <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>N </th>
                <th>Date de souscription</th>
                <th>Numéro</th>
                <th>Offre</th>
                <th>Montant</th>
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
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
 #END# Exportable Table -->

<!-- Modal 
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content
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
	<!--<a href="dfdfd">Supprimer</a>
        <a class="btn btn-danger btn-ok">Supprimer</a>
      </div>
    </div>
  </div>
</div>
-->
 <!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
      "processing": true,
      "serverSide": true,
      "ajax": "<?=base_url('admin/divacom/bmw/datatable_json5')?>",
      "type": "POST",
      "order": [[0,'desc']],
      "columnDefs": [
        { "targets": 0, "name": "idsous", 'searchable':true, 'orderable':true},
        { "targets": 1, "name": "datedebut", 'searchable':true, 'orderable':true},
        { "targets": 2, "name": "numero", 'searchable':true, 'orderable':true},
        { "targets": 3, "name": "idoffre", 'searchable':true, 'orderable':true},
        { "targets": 4, "name": "Montant", 'searchable':false, 'orderable':false,'width':'100px'}
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
  
<!-- ======================= Scripts for this page ============================== -->
<!-- Jquery CountTo Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
<script src="<?= base_url()?>public/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url()?>public/plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="<?= base_url()?>public/plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Custom Js -->
<script src="<?= base_url()?>public/js/pages/index.js"></script>
  

