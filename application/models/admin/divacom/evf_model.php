<?php
	class Evf_model extends CI_Model{

		public function add_message($data){
			$this->db->insert('alertes', $data);
			return true;
		}
		//---------------------------------------------------

		public function add_alerte($data){
			$this->db->insert('informations', $data);
			return true;
		}


		//---------------------------------------------------

		// get all users for server-side datatable processing (ajax based)
		public function get_all_users(){
			$wh =array();
			$SQL ='SELECT * FROM alertes';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode('and',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}



		//---------------------------------------------------
		public function get_all_users_alerte(){
			$wh =array();
			$SQL ='SELECT * FROM informations';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode('and',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}

		
		//---------------------------------------------------
		// Get user detial by ID
		public function get_user_by_idi($idinfo){
			$query = $this->db->get_where('informations', array('idinfo' => $idinfo));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		public function get_user_by_id($idalertes){
			$query = $this->db->get_where('alertes', array('idalertes' => $idalertes));
			return $result = $query->row_array();
		}

		//---------------------------------------------------



		// Edit user Record
		public function edit_user($data, $idalertes){
			$this->db->where('idalertes', $idalertes);
			$this->db->update('alertes', $data);
			return true;
		}

		//---------------------------------------------------
		public function edit_user_info($data, $idinfo){
			$this->db->where('idinfo', $idinfo);
			$this->db->update('informations', $data);
			return true;
		}



		//-----------------DIAGRAMME A BANDE--------SELECT datestat FROM `statsouscription` WHERE datestat LIKE '2019-07-%'---------



		public function add_stat($data){
			$this->db->insert('statsouscription', $data);
			return true;
		}


		//---------------------------------------------------
		public function get_user_by_idstat($idstatsous){
			$query = $this->db->get_where('statsouscription', array('idstatsous' => $idstatsous));
			return $result = $query->row_array();
		}


		//---------------------------------------------------
		public function edit_user_stat($data, $idstatsous){
			$this->db->where('idstatsous', $idstatsous);
			$this->db->update('statsouscription', $data);
			return true;
		}


		//---------------------------------------------------
		public function get_all_users_stat(){
			$wh =array();
			$SQL ='SELECT * FROM statsouscription';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode('and',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}





		 function fetch_year()
                {

			//$query = $this->db->get_where('statsouscription', array('datestat' => $datestat));
			//return $result = $query->row_array();

                //$this->db->select('SUBSTRING(datestat, 1, 4)');
                $this->db->from('statsouscription'); 
                $this->db->like('datestat', '2019', 'after');
                $this->db->order_by('datestat', 'DESC');
                return $this->db->get()->result();
                }

                function fetch_chart_data($datestat)
                {

		$this->db->from('statsouscription'); 
                $this->db->where('datestat', $datestat);
                return $this->db->get()->result();

		//$this->db->select('SUBSTRING(datestat, 1, 4)', FALSE)
                //$this->db->where('datestat', $datestat);
                //$this->db->order_by('datestat', 'ASC');
                //return $this->db->get('statsouscription');
                }
 
//.............................bmw.....................
function get_all_souscription(){
	$wh =array();
			$SQL ='SELECT * FROM souscription';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode('and',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
}

public function get_offre()
    {
		$q=$this->bmwdb->select('*')->from('offre')->where('idoffre',3);
		$response = $q->get()->result_array();

   	    return $response;

	}

public function count_souscription(){
	$this->db->select('count(*)');
$query = $this->db->get('souscription');
$cnt = $query->row_array();
return $cnt['count(*)'];

}
	}

?>