<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_chart extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('admin/dynamic_chart_model');
 }

 function index()
 {
  $data['year_list'] = $this->dynamic_chart_model->fetch_year();
  $this->load->view('admin/dynamic_chart', $data);
 }

 function fetch_data()
 {
	//var_dump($this->input->get('year'));
  if($this->input->post('year'))
  {
   $data2 = $this->input->post('year');
   $chart_data = $this->dynamic_chart_model->fetch_chart_data($data2);


   //var_dump($chart_data);

   foreach($chart_data->result_array() as $row)
   {
    $output[] = array(
     'month'  => $row["month"],
     'profit' => floatval($row["profit"])
    );
   }
   echo json_encode($output);
  }
 }
 
}


?>