<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Bmw extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/divacom/bmw_model', 'bmw_model');
			$this->load->helper('graph_helper');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		
			date_default_timezone_set('Africa/Abidjan');
		}
		//-----------------------------------------------------------------------
		
		public function index(){

			$data['view'] = 'admin/divacom/bmw/message_list';
			$this->load->view('layout', $data);
		}



		public function message(){
			$data['view'] = 'admin/divacom/bmw/message_list';
			$this->load->view('layout', $data);
		}

		
		public function statistique(){




    /* $dateJour= date("Y-m-d");
	$data['user'] = $this->bmw_model->get_all_users_stat();


if(isset($_POST['offre']) && strlen($_POST['offre'])>0){
    $sql.=" AND idoffre='".$_POST['offre']."'";
}

if(isset($_POST['du']) && strlen($_POST['du'])>0) {
    $date = new DateTime($_POST['du']);
    $date = $date->format('Y-m-d');
    $sql .= " AND datestat >= '". htmlspecialchars($date)."'";
}

if(isset($_POST['au']) && strlen($_POST['au'])>0) {
    $d = new DateTime($_POST['au']);
    $dat = $d->format('Y-m-d');
    $sql .= " AND datestat <= '". htmlspecialchars($dat)."'";   
}


$query=mysql_query($sql) or die(mysql_error());
 */


    
 /**Nb d'abonné */ 
 /* $data['souscription'] = $this->bmw_model->get_all_users_stat();
 $datesouscri=$data['souscription'][0]['datedebut'];
$numero=$data['souscription'][0]['numero'];
$idoffre=$data['souscription'][0]['idoffre']; 

$data['offre'] = $this->bmw_model->get_offre();
$montantoffre=$data['offre'][0]['montant'];
$duree=$data['offre'][0]['duree'];

$data['nbsouscription'] = $this->bmw_model->count_souscription();



/**Nb de souscription par jour
$nbsousj= mysql_query("SELECT count(*) as nbsj FROM statsouscription WHERE datestat='$dateJour'") or die(mysql_error());
$nj=mysql_fetch_array($nbsousj);
$nbj=$nj['nbsj'];*/ 


/**Nb de alertes par jour 
$alerte= mysql_query("SELECT count(*) as alerte FROM alertes WHERE datejour='$dateJour'") or die(mysql_error());
$nbal=mysql_fetch_array($alerte);
$nbalerte=$nbal['alerte'];*/

/**Nb de alertes par jour
$total= mysql_query("SELECT sum(montantoffre) as total FROM statsouscription WHERE datestat='$dateJour'") or die(mysql_error());
$som=mysql_fetch_array($total);
$somTotal=$som['total'];

if($somTotal==0){
    $somTotal=0;
}
*/ 
/**Nb de desouscription
$desouscription= mysql_query("SELECT count(*) as total FROM desouscription") or die(mysql_error());
$nbdesc=mysql_fetch_array($desouscription);
$totaldesc=$nbdesc['total'];
if($totaldesc==0){
    $totaldesc=0;
}

*/ 



        
$data['nbsouscription'] = $this->bmw_model->count_souscription();


   
			$data['view'] = 'admin/divacom/bmw/statistique_list';
			$this->load->view('layout', $data);

			//$data['view'] = 'admin/Dynamic_chart';
			//$this->load->view('layout', $data);

 			//$data['year_list'] = $this->bmw_model->fetch_year();
  			//$this->load->view('admin/astucesfitness/statistique_list', $data);

		}

		





		public function visuel(){
			$data['view'] = 'admin/divacom/bmw/visuel_list';
			$this->load->view('layout', $data);
		}


		
		public function alerte(){
			$data['view'] = 'admin/divacom/bmw/alerte_list';
			$this->load->view('layout', $data);
		}




		//--------------------------------MESSAGE---------------------------------

		public function datatable_json1(){				   					   
			$records = $this->bmw_model->get_all_users();
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

					'<a title="Modifier" class="update btn btn-sm btn-primary '.$nonenvoye.' href="'.base_url('admin/divacom/bmw/edit/'.$row['idalertes']).'"> <i class="material-icons">edit</i></a>
					<a title="Supprimer" class="delete btn btn-sm btn-danger '.$envoye.' href="'.base_url('admin/divacom/bmw/del/'.$row['idalertes']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',

					
					'<a title="Supprimer" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/divacom/bmw/del/'.$row['idalertes']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}

		//--------------------------------MESSAGE---------------------------------
		public function datatable_json2(){				   					   
			$records = $this->bmw_model->get_all_users_alerte();
			$data = array();
			$i = 0;
			foreach ($records['data']  as $row) 
			{  
				$disabled = ($row['is_admin'] == 1)? 'disabled': ''.'<span>';
					//<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/astucesfitness/edit2/'.$row['idinfo']).'"> <i class="material-icons">visibility</i></a>
				$data[]= array(
					++$i,
					$row['dateheure'],
					$row['messages'],

					'<a title="Modifier" class="update btn btn-sm btn-primary" href="'.base_url('admin/divacom/bmw/edit2/'.$row['idinfo']).'"> <i class="material-icons">edit</i></a>',
					'<a title="Supprimer" class="delete btn btn-sm btn-danger '.$disabled.'" data-href="'.base_url('admin/divacom/bmw/del2/'.$row['idinfo']).'" data-toggle="modal" data-target="#confirm-delete"> <i class="material-icons">delete</i></a>
					',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}
		
//--------------------------------SOUSCRIPTION---------------------------------
public function datatable_json5(){				   					   
	$records = $this->bmw_model->get_all_souscription();
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
					$data['view'] = 'admin/divacom/bmw/message_add';
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
					$result = $this->bmw_model->add_message($data);
					if($result){

						$this->session->set_flashdata('msg', 'Message ajouté avec succ�s !');

						redirect(base_url('admin/divacom/bmw'));
					}
				}
			}
			else{
				$data['view'] = 'admin/divacom/bmw/message_add';
				$this->load->view('layout', $data);
			}
			
		}
		//-----------------------------------------------------------------------

		public function add2(){

			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheure','Dateheure', 'trim|required');
				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'admin/divacom/bmw/alerte_add';
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
					$result = $this->bmw_model->add_alerte($data);
					if($result){

						$this->session->set_flashdata('msg', 'Alerte ajouté avec succ�s !');
						redirect(base_url('admin/divacom/bmw/alerte'));
					}
				}
			}
			else{
				$data['view'] = 'admin/divacom/bmw/alerte_add';
				$this->load->view('layout', $data);
			}
			
		}
		//-----------------------------------------------------------------------


		public function edit($idalertes = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheureenvoi','Dateheureenvoi', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->bmw_model->get_user_by_id($idalertes);
					//$data['user_groups'] = $this->bmw_model->get_user_groups();
					$data['view'] = 'admin/divacom/bmw/message_edit';
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
					$result = $this->bmw_model->edit_user($data,$idalertes);
					if($result){

						// Add User Activity
						//$this->activity_model->add(2);

						$this->session->set_flashdata('msg', 'Message modifié avec succ�s !');
						redirect(base_url('admin/divacom/bmw'));
					}
				}
			}
			else{
				$data['user'] = $this->bmw_model->get_user_by_id($idalertes);
				//$data['user_groups'] = $this->bmw_model->get_user_groups();
				$data['view'] = 'admin/divacom/bmw/message_edit';
				$this->load->view('layout', $data);
			}
		}

		//-----------------------------------------------------------------------


		public function edit2($idinfo = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('messages', 'Messages', 'trim|required');
				$this->form_validation->set_rules('dateheure','Dateheure', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->bmw_model->get_user_by_idi($idinfo);
					//$data['user_groups'] = $this->bmw_model->get_user_groups();
					$data['view'] = 'admin/divacom/bmw/alertes_edit';
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
					$result = $this->bmw_model->edit_user_info($data, $idinfo);
					if($result){

						// Add User Activity
						//$this->activity_model->add(2);

						$this->session->set_flashdata('msg', 'Alerte modifié avec succ�s !');
						redirect(base_url('admin/divacom/bmw/alerte'));
					}
				}
			}
			else{
				$data['user'] = $this->bmw_model->get_user_by_idi($idinfo);
				//$data['user_groups'] = $this->bmw_model->get_user_groups();
				$data['view'] = 'admin/divacom/bmw/alerte_edit';
				$this->load->view('layout', $data);
			}
		}



		//-----------------------------------------------------------------------
		public function del($idalertes = 0){
			$this->db->delete('alertes', array('idalertes' => $idalertes));

			// Add User Activity
			//$this->activity_model->add(3);

			$this->session->set_flashdata('msg', 'Message suprimé avec succ�s!');
			redirect(base_url('admin/divacom/bmw'));
		}

		//-----------------------------------------------------------------------
		public function del2($idinfo = 0){
			$this->db->delete('informations', array('idinfo' => $idinfo));

			// Add User Activity
			//$this->activity_model->add(3);

			$this->session->set_flashdata('msg', 'Alerte suprimé avec succ�s!');
			redirect(base_url('admin/divacom/bmw/alerte'));
		}


		//--------------------------------MESSAGE---------------------------------
		public function datatable_json3(){				   					   
			$records = $this->bmw_model->get_all_users_stat();
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
                        $chart_data = $this->bmw_model->fetch_chart_data($this->input->post('datestat'));
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
			$output = $this->bmw_model->fetch_chart_data($this->input->post('datestat'));
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