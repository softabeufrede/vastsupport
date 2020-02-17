<?php
	class Astucesfitness_model extends CI_Model{
		public function add_alertes($data){
			$this->db->insert('alertes', $data);
			return true;
		}
		//---------------------------------------------------
		// liste complete des alertes ----- get all users for server-side datatable processing (ajax based)
		public function get_all_alertes(){
			$wh =array();
			$SQL ='SELECT * FROM alertes';
			$wh[] = " is_admin = 0";
			if(count($wh)>0)
			{
				$WHERE = implode(' and ',$wh);
				return $this->datatable->LoadJson($SQL,$WHERE);
			}
			else
			{
				return $this->datatable->LoadJson($SQL);
			}
		}

		//---------------------------------------------------
		// get all user records
		//public function get_all_simple_users(){
		//	$this->db->where('is_admin', 0);
		//	$this->db->order_by('created_at', 'desc');
		//	$query = $this->db->get('ci_users');
		//	return $result = $query->result_array();
		//}

		//---------------------------------------------------
		// compte le nombre d'utilisateur par page ---- Count total user for pagination
		public function count_all_alertes(){
			return $this->db->count_all('alertes');
		}

		//---------------------------------------------------
		// ordonner les alertes par page ---- Get all users for pagination
		public function get_all_alertes_for_pagination($limit, $offset){
			$wh =array();	
			$this->db->order_by('idalertes', 'desc');
			$this->db->limit($limit, $offset);

			if(count($wh)>0){
				$WHERE = implode(' and ',$wh);
				$query = $this->db->get_where('alertes', $WHERE);
			}
			else{
				$query = $this->db->get('alertes');
			}
			return $query->result_array();
			//echo $this->db->last_query();
		}


		//---------------------------------------------------
		// get all users for server-side datatable with advanced search
		



		//---------------------------------------------------
		// Get user detial by ID
		public function get_alertes_by_id($id){
			$query = $this->db->get_where('alertes', array('idalertes' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_alertes($data, $id){
			$this->db->where('idalertes', $id);
			$this->db->update('alertes', $data);
			return true;
		}

		//---------------------------------------------------
		// Get User Role/Group
		

	}

?>