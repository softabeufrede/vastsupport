<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccueilMotivPlus extends CI_Controller {


	public function index($option="")
	{
    if(isset($_POST['option'])){
		 $option=$_POST['option'];
	 }

 		$data['option']=$this->input->get('option');
		$this->load->view('view_accueilMotivPlus',$data);
	}

	public function optionMP($option="")
	{
    if(isset($_POST['option'])){
		 $option=$_POST['option'];
	 }

 		$data['option']=$this->input->get('option');
		$this->load->view('view_souscrire',$data);
	}
	
}
