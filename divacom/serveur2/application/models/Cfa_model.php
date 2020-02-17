<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cfa_Model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

		date_default_timezone_set('UTC');
		
    }


  public function get_offre()
    {
		$q=$this->db->select('*')->from('offre')->where('idoffre',3);
		$response = $q->get()->result_array();

   	    return $response;

	}


	
	public function souscription_user($numero)
	{
		$q=$this->db->select('*')->from('souscription')->where('numero',$numero);;
		$response = $q->get()->result_array();

   	    return $response;

	}


	public function offre_montant()
	{
		$q=$this->db->select('montant')->from('offre')->where('idoffre',3);;
		$response = $q->get()->result();

   	    return $response[0]->montant;

	}
	
	



	public function update_souscription($dateJour,$dateFin,$idoffre,$token,$idsous){
				$data=array(
				'datedebut'=>$dateJour,
				'datefin'=>$dateFin,
				'datefinsous'=>$dateFin,
				'datesouscription'=>$dateJour,
				'statutsous'=>true	,
				'etatsous'=>'S',
				'relance'=>false,
				'idoffre'=>$idoffre,
				'token'=>$token );
			$this->db->where('idsous',$idsous)->update('souscription',$data);
			return true ;
	}


	public function update_souscription_prolabon($dateJour,$dateF,$idoffre,$token,$idsous){
				$data=array(
				'datedebut'=>$dateJour,
				'datefin'=>$dateF,
				'datefinsous'=>$dateF,
				'datesouscription'=>$dateJour,
				'statutsous'=>true	,
				'etatsous'=>'S',
				'relance'=>false,
				'idoffre'=>$idoffre,
				'token'=>$token );
		$this->db->where('idsous',$idsous)->update('souscription',$data);
		return true ;
		}

		public function	insert_stat_souscription ($param){

			$this->db->insert('statsouscription',$param);
			return true ;

		}

		public function	insert_souscription ($param_sous){

			$this->db->insert('souscription',$param_sous);
			$insert_id = $this->db->insert_id();

			return  $insert_id;
			

		}
		public function insert_desouscription ($param_desous){

			$this->db->insert('desouscription',$param_desous);
			$insert_id = $this->db->insert_id();
	
			return  $insert_id;
			
	
		}
		public function update_souscription_desabon($idsous){
			$data=array(
	//'datedebut'=>$dateJour,
	//		'datefin'=>$dateFin,
	//		'datefinsous'=>$dateFin,
			//'datesouscription'=>$dateJour,
			'statutsous'=>false,
			'etatsous'=>'D',
			'relance'=>false
			//'idoffre'=>$idoffre,
		//	'token'=>$token
		 );
		$this->db->where('idsous',$idsous)->update('souscription',$data);
		return true ;
	}
	public function search_souscription_user($numero)
	{
		
        $this->db->select('*');
        $this->db->from('souscription');
        $this->db->where('numero', $numero);
        $this->db->where('etatsous="s"');
        $query = $this->db->get();
        return $query->row_array();

	}

}