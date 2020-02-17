<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="card">
  <div class="header">
    <h2>
      AJOUTER UNE ALERTE
    </h2>
    <a href="<?= base_url('admin/astucesfitness/alerte'); ?>" class="btn bg-deep-orange waves-effect pull-right">Liste des messages</a>
  </div>
  <div class="body">
    <div class="row clearfix">
     
       
      <?php echo form_open(base_url('admin/astucesfitness/add2'), 'class="form-horizontal"');  ?> 
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="messages">Message</label>
            </div>
            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7"  style="background-color:#E2F7F4">
                <div class="form-group">
                    <div class="form-line">
                        <textarea rows="10" cols="8" style="margin:5px" type="text" id="messages" name="messages" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
 	<div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="nbrcaract">Nombre de caractere</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <div class="form-line">
                        <input type="test" id="nbrcaract"  disabled name="nbrcaract" class="form-control"> / 160
                    </div>
                </div>
            </div>
        </div>
 	<div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="nbrsms">Nombre de message</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <div class="form-line">
                        <input type="test" id="nbrsms"  disabled name="nbrsms" class="form-control">
                    </div>
                </div>
            </div>
        </div>
 	<div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="dateheureenvoi">Date d'envoi</label>
            </div>
            <div class="col-lg-4 col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <div class="form-line">
                        <input type="date" id="dateheure" name="dateheure" class="form-control">
                    </div>
                </div>
            </div>
        </div>

 	<div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                <label for="dateheureh">Heure d'envoi</label>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="form-group">
                    <div class="form-line">
                        <input type="time" id="dateheureh" name="dateheureh" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                <input type="submit" name="submit" value="ENREGISTRER" class="btn btn-primary m-t-15 waves-effect">
            </div>
        </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>
</div>
</div>

