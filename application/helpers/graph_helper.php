<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');


    if (!function_exists('graph'))
    {
        function graph()
        {
		//echo "helper";
$CI= &get_instance ();
$CI->load->model('astucesfitness_model');



 			$data['year_list'] = $CI->astucesfitness_model->fetch_year();
//var_dump($data['year_list']);
		
	
  			 foreach($data['year_list'] as $row)
                        {
                            echo '<option value="'.$row->datestat.'">'.$row->datestat.'</option>';
                        }   
        }
    }
?>    