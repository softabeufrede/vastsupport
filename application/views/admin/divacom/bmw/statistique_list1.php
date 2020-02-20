<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->

 <div class="container">
  <br />
  <h3 align="center">Dynamic Column Chart in Codeigniter using Ajax</h3>
  <br />
  <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="panel-title">Month Wise Profit Data</h3>
                    </div>
                    <div class="col-md-3">
                        <select name="datestat" id="datestat" class="form-control">
                            <option value="">Selectionner l'ann�e</option>
                        <?php
                        foreach($year_list->result_array() as $row)
                        {
                            echo '<option value="'.$row["datestat"].'">'.$row["datestat"].'</option>';
                        }
                        ?>

                        </select>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="chart_area" style="width: 800px; height: 420px;"></div>
            </div>
        </div>
 </div>

 <!-- Jquery DataTable Plugin Js -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

google.charts.load('current', {packages:['corechart', 'bar']});
google.charts.setOnLoadCallback();

function load_monthwise_data(year, title)
{
    var temp_title = title + ' ' + year;
    $.ajax({
        url:"<?php echo base_url(); ?>astucesfitness/fetch_data",
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
        if(datestat!= '')
        {
            load_monthwise_data(year, 'Month Wise Profit Data For');
        }
    });
});

</script>  

  

