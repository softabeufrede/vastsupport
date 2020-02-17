<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />



   
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
-->




<!-- Exportable Table -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">    
      <div class="body">
<br />
  <h3 align="center">Graphique a colonnes dynamique dans Codeigniter a l'aide d'Ajax</h3>
  <br />
  <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">Données mensuelles sur les bénéfices</h3>
                    </div>
                    <div class="col-md-3">
                        <select name="datestat" id="datestat" class="form-control">
                            <option value="">Selectionner l'année</option>
				<?php graph();?>
			</select>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart_area" style="width: 800px; height: 520px;"></div>
            </div>
        </div>
 </div>

      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages:['corechart', 'bar']});
google.charts.setOnLoadCallback();

function load_monthwise_data(datestat, title)
{
    var temp_title = title + ' ' + datestat;
    $.ajax({
        url:"<?php echo base_url('admin/astucesfitness/datatable_json4'); ?>",
        method:"POST",
        data:{datestat:datestat},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    })
}

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Profit');

    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var profit = parseFloat($.trim(jsonData.profit));
        data.addRows([[month, profit]]);
    });

    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Months"
        },
        vAxis: {
            title: 'Profit'
        },
        chartArea:{width:'80%',height:'85%'}
    }

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));

    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){
    $('#datestat').change(function(){
        var datestat = $(this).val();
        if(datestat != '')
        {
            load_monthwise_data(datestat, 'Mois de données sur les bénéfices pour');
        }
    });
});

</script>  

  

