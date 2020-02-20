<?php defined('BASEPATH') OR exit('No direct script access allowed');
class evf extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/divacom/evf_model', 'evf_model');
			$this->load->helper('graph_helper');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		
			date_default_timezone_set('Africa/Abidjan');
		}
		//-----------------------------------------------------------------------
		
		public function index(){

			$data['view'] = 'admin/divacom/evf/message_list';
			$this->load->view('layout', $data);
		}



		public function message(){
			$data['view'] = 'admin/divacom/evf/message_list';
			$this->load->view('layout', $data);
		}

		
		public function statistique(){

        
		$data['nbsouscription'] = $this->evf_model->count_souscription();


   
			$data['view'] = 'admin/divacom/evf/statistique_list';
			$this->load->view('layout', $data);

			//$data['view'] = 'admin/Dynamic_chart';
			//$this->load->view('layout', $data);

 			//$data['year_list'] = $this->evf_model->fetch_year();
  			//$this->load->view('admin/astucesfitness/statistique_list', $data);

		}

		





		public function visuel(){
			$data['view'] = 'admin/divacom/evf/visuel_list';
			$this->load->view('layout', $data);
		}


		
		public function alerte(){
			$data['view'] = 'admin/divacom/evf/alerte_list';
			$this->load->view('layout', $data);
		}




		//--------------------------------MESSAGE---------------------------------

		public function datatable_json(){				   					   
			$records = $this->evf_model->get_all_alertes();
			$data = array();
			$i = 0;
			foreach ($records['data']  as $row) 
			{  
				$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
				$nonenvoye = ($row['statutalerte'] == 1)? 'hidden': ''.'<span>';
				$envoye = ($row['statutalerte'] == 0)? 'hidden': ''.'<span>';

					//<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/astucesfitness/edit/'.$row['idalertes']).'"> <i class="material-icons">visibility</i></a>
				$data[]= array(
					++$i,
					$row['dateheureenvoi'],
					$row['messages'],

					'<a title="Modifier" class="update btn btn-sm btn-primary '.$nonenvoye.' href="'.base_url('admin/divacom/evf/edit/'.$row['idalertes']).'"> <i class="material-icons">edit</i></a>
					<a title="Supprimer" class="delete btn btn-sm btn-danger '.$envoye.' href="'.base_url('admin/divacom/evf/del/'.$row['idalertes']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',

					
					'<a title="Supprimer" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/divacom/evf/del/'.$row['idalertes']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}

		//--------------------------------MESSAGE---------------------------------
		public function datatable_json2(){				   					   
			$records = $this->evf_model->get_all_informations();
			$data = array();
			$i = 0;
			foreach ($records['data']  as $row) 
			{  
				$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
				$nmc = strlen($row['messages']);
					//<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/astucesfitness/edit2/'.$row['idinfo']).'"> <i class="material-icons">visibility</i></a>
				$data[]= array(
					++$i,
					$row['dateheure'],
					$row['messages'],
					$nmc." ".'<a title="Programmer ce message" class="update btn btn-sm btn-danger" href="'.base_url('admin/divacom/evf/edit3/'.$row['idinfo']).'"> <i class="material-icons">send</i></a>',

					'<a title="Modifier" class="update btn btn-sm btn-primary" href="'.base_url('admin/divacom/evf/edit2/'.$row['idinfo']).'"> <i class="material-icons">edit</i></a>
					<a title="Supprimer" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/divacom/evf/del2/'.$row['idinfo']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}
		
//--------------------------------SOUSCRIPTION---------------------------------
public function datatable_json5(){				   					   
	$records = $this->evf_model->get_all_souscription();
	$data = array();
	$i = 0;
	foreach ($records['data']  as $row) 
	{  
		$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
			//<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/astucesfitness/edit2/'.$row['idinfo']).'"> <i class="material-icons">visibility</i></a>
		$data[]= array(
			++$i,
			$row['datedebut'],
			$row['numero'],
			$row['idoffre'],
			$row['montant'],
		);
	}
	$records['data']=$data;
	echo json_encode($records);						   
}


		//-----------------------------------------------------------------------
		public function add(){
			//$data['user_groups'] = $this->user_model->get_user_groups();
			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheureenvoi','Dateheureenvoi', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/divacom/evf/message_add';
					$this->load->view('layout', $data);
				}
				else{


					$date2 = $dateen=(string)$this->input->post('dateheureenvoi');
					$date1 = $this->input->post('dateheureenvoih');
					$date = $date2."".$date1;
					$time = strtotime($date);
					$newformat_date = date('Y-m-d H:i:s',$time);


					$data = array(
						'messages' => $this->input->post('messages'),
						'dateheureenvoi' => $newformat_date,
						'etatalerte' => 'En attente',
						'statutalerte' => 0,
						'datenreg' => date('Y-m-d  H:i:s'),
						'datejour' => date('Y-m-d'),
						'is_admin' => 0,
					);
					$data = $this->security->xss_clean($data);
					$result = $this->evf_model->add_message($data);
					if($result){

						$this->session->set_flashdata('msg', 'Message ajouté avec succ�s !');

						redirect(base_url('admin/divacom/evf'));
					}
				}
			}
			else{
				$data['view'] = 'admin/divacom/evf/message_add';
				$this->load->view('layout', $data);
			}
			
		}
		//-----------------------------------------------------------------------

		public function add2(){

			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheure','Dateheure', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/divacom/evf/alerte_add';
					$this->load->view('layout', $data);
				}
				else{


					$date2 = $dateen=(string)$this->input->post('dateheure');
					$date1 = $this->input->post('dateheureh');
					$date = $date2."".$date1;
					$time = strtotime($date);
					$newformat_date = date('Y-m-d H:i:s',$time);


					$data = array(
						'messages' => $this->input->post('messages'),
						'dateheure' => $newformat_date,
						'statut' => 0,
						'is_admin' => 0,
					);
					$data = $this->security->xss_clean($data);
					$result = $this->evf_model->add_alerte($data);
					if($result){

						$this->session->set_flashdata('msg', 'Alerte ajouté avec succ�s !');
						redirect(base_url('admin/divacom/evf/alerte'));
					}
				}
			}
			else{
				$data['view'] = 'admin/divacom/evf/alerte_add';
				$this->load->view('layout', $data);
			}
			
		}
		//-----------------------------------------------------------------------


		public function edit($idalertes = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheureenvoi','Dateheureenvoi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->evf_model->get_user_by_id($idalertes);
					//$data['user_groups'] = $this->evf_model->get_user_groups();
					$data['view'] = 'admin/divacom/evf/message_edit';
					$this->load->view('layout', $data);
				}
				else{
					$date2 = $dateen=(string)$this->input->post('dateheureenvoi');

					$time = strtotime($date2);
					$newformat_date = date('Y-m-d H:i:s',$time);

					$data = array(
						'messages' => $this->input->post('messages'),
						'dateheureenvoi' => $newformat_date ,
						'etatalerte' => 'En attente',
						'statutalerte' => 0,
						'datenreg' => date('Y-m-d  H:i:s'),
						'datejour' => date('Y-m-d'),
						'is_admin' => 0,

					);
					$data = $this->security->xss_clean($data);
					$result = $this->evf_model->edit_user($data,$idalertes);
					if($result){

						// Add User Activity
						//$this->activity_model->add(2);

						$this->session->set_flashdata('msg', 'Message modifié avec succ�s !');
						redirect(base_url('admin/divacom/evf'));
					}
				}
			}
			else{
				$data['user'] = $this->evf_model->get_user_by_id($idalertes);
				//$data['user_groups'] = $this->evf_model->get_user_groups();
				$data['view'] = 'admin/divacom/evf/message_edit';
				$this->load->view('layout', $data);
			}
		}

		//-----------------------------------------------------------------------


		public function edit2($idinfo = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheure','Dateheure', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->evf_model->get_user_by_idi($idinfo);
					//$data['user_groups'] = $this->evf_model->get_user_groups();
					$data['view'] = 'admin/divacom/evf/alertes_edit';
					$this->load->view('layout', $data);
				}
				else{

					$date2 = $dateen=(string)$this->input->post('dateheure');

					$time = strtotime($date2);
					$newformat_date = date('Y-m-d H:i:s',$time);

					$data = array(
						'messages' => $this->input->post('messages'),
						'dateheure' => $newformat_date,
						'statut' => 0,
						'is_admin' => 0,

					);
					$data = $this->security->xss_clean($data);
					$result = $this->evf_model->edit_user_info($data, $idinfo);
					if($result){

						// Add User Activity
						//$this->activity_model->add(2);

						$this->session->set_flashdata('msg', 'Alerte modifié avec succ�s !');
						redirect(base_url('admin/divacom/evf/alerte'));
					}
				}
			}
			else{
				$data['user'] = $this->evf_model->get_user_by_idi($idinfo);
				//$data['user_groups'] = $this->evf_model->get_user_groups();
				$data['view'] = 'admin/divacom/evf/alerte_edit';
				$this->load->view('layout', $data);
			}
		}




			//--------------------PROGRAMMER MESSAGE DANS ------------------------------------


			public function edit3($idinfo = 0){
				if($this->input->get('idinfo')){
	
						$date2 = $dateen=(string)$this->input->post('dateheure');
	
						$time = strtotime($date2);
						$newformat_date = date('Y-m-d H:i:s',$time);
	
						$data = array(
							'messages' => $this->input->post('messages'),
							'dateheure' => $newformat_date,
							'statut' => 0,
							'is_admin' => 0,
	
						);
						$data = $this->security->xss_clean($data);
						$result = $this->evf_model->edit_user_info($data, $idinfo);
						if($result){
	
	
							$this->session->set_flashdata('msg', 'Alerte modifié avec succ�s !');
							redirect(base_url('admin/divacom/evf/alerte'));
						}
				}
				else{
					$data['user'] = $this->evf_model->get_user_by_idi($idinfo);
					//$data['user_groups'] = $this->evf_model->get_user_groups();
					$data['view'] = 'admin/divacom/evf/alerte_edit';
					$this->load->view('layout', $data);
				}
			}



		//-----------------------------------------------------------------------
		public function del($idalertes = 0){
			$this->db->delete('alertes', array('idalertes' => $idalertes));

			// Add User Activity
			//$this->activity_model->add(3);

			$this->session->set_flashdata('msg', 'Message suprimé avec succ�s!');
			redirect(base_url('admin/divacom/evf'));
		}

		//-----------------------------------------------------------------------
		public function del2($idinfo = 0){
			$this->db->delete('informations', array('idinfo' => $idinfo));

			// Add User Activity
			//$this->activity_model->add(3);

			$this->session->set_flashdata('msg', 'Alerte suprimé avec succ�s!');
			redirect(base_url('admin/divacom/evf/alerte'));
		}


		//--------------------------------MESSAGE---------------------------------
		public function datatable_json3(){				   					   
			$records = $this->evf_model->get_all_users_stat();
			$data = array();
			$i = 0;
			foreach ($records['data']  as $row) 
			{  

				$data[]= array(
					++$i,
					$row['datestat'],
					$row['numero'],

				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}






                function fetch_data1()
                {

			//var_dump($this->input->post());
                    if($this->input->post('datestat'))
                    {
                        $chart_data = $this->evf_model->fetch_chart_data($this->input->post('datestat'));
			//var_dump($chart_data);
                    
                        foreach($chart_data->result_array() as $row)
                        {
				$moi = date('F', strtotime($row['datestat']));

   			 	$output[] = array(
     				'month'  => $moi,
    				'profit' => floatval($row["profit"])
    				);
                        }
                        echo json_encode($output);
                    }
                }




		//--------------------------------MESSAGE---------------------------------

		public function datatable_json4($datestat){				   					   
			$output = $this->evf_model->fetch_chart_data($this->input->post('datestat'));
var_dump($output);
			$data = array();
			$i = 0;
			foreach ($output['data']  as $row) 
			{  
				$moi = date('F', strtotime($row['datestat']));

   			 	$output[] = array(
     				'month'  => $moi,
    				'profit' => floatval($row["profit"])
    				);
			}
			$output['data']=$data;
			echo json_encode($output);						   
		}









	}
?>