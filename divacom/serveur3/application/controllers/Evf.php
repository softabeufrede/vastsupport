<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH.'/libraries/REST_Controller.php';
//$base_url=$this->config['base_url'];

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

class Evf extends CI_Controller
 {

		public function __construct(){

			parent::__construct();
			$this->load->model('Evf_model');
		}
		public function index()
		{
			/* API URL */
			$raw_post = json_decode(file_get_contents('php://input'), TRUE);
			if(!empty($raw_post)){
				$_REQUEST = $raw_post;
			}


			$numero=$msisdn=$_SERVER['HTTP_USER_MSISDN'];
		//	$offre=$msisdn=$_SERVER['HTTP_USER_MSISDN'];
		//$numero=substr($msisdn, 3);
			//echo $numero;


			$data['num_abonne']=$numero;


			$this->load->view('view_accueilEVF',$data);
			
		
		}


		public function souscrire() 
		{
			$this->Evf_model->get_offre();

			$data['offre_montant']=$this->Evf_model->offre_montant();
			$data['offre_m']=$this->Evf_model->offre_montant();
			$this->load->view('view_souscrire',$data);
		}	
		public function souscrire_confirm() {

				$sendername="MP";
				$numero=$msisdn=$_SERVER['HTTP_USER_MSISDN'];
				$token=$_SERVER['HTTP_USER_TOKEN'];
				$ACCESS_TOKEN="0251f9b4-80fe-3005-96b6-edb5f805d8a0";
				$referenceCode=uniqid();
				$clientCorrelator=uniqid();

				$testfacture=false;
  /*
 * Récuperation des données de l'offre
 */
			if(isset($_SERVER['HTTP_USER_OFFRE'])){
				$offre=$_SERVER['HTTP_USER_OFFRE'];
			}
 			if (isset($offre)) {

	   			$data['offre']= $this->Evf_model->get_offre();

				$idoffre=$data['offre'][0]['idoffre'];
				$liboffre=$data['offre'][0]['libelle'];
				$montantoffre=$data['offre'][0]['montant'];
				$duree=$data['offre'][0]['duree'];
			}
		
				$montant=$montantoffre.".00";
				$dateJour = date("Y-m-d H:i:s");
				$date = strtotime($dateJour);
				$date = strtotime("+" . $data['offre'][0]['duree'] . " day", $date);
				
				$dateFin = date('Y-m-d H:i:s', $date);
//Verification du solde via l'api IN de l'operateur 
//* Si le solde est bon 
				$testfacture= true;
			
			if($testfacture){

				
/*
 * On va chercher en base le msisdn si il s'agit d'une nouvelle souscription ou un réabonnement
*/
				$data= $this->Evf_model->souscription_user($numero);
 //echo $numero;
		//var_dump($data);

							if(!empty($data)){
					/*
					*Le client existe déjà en base de données - Réabonnement   
					*/    		$dateJourCompare = date("Y-m-d");
								$row = $data[0];
								//echo $row['datefinsous']."<br>";
								//echo $row['idsous']."<br>";
								$idsous=$row['idsous'];
											if ($dateJourCompare > $row['datefinsous']) {
													$update_souscription_reabon=$this->Evf_model->update_souscription($dateJour,$dateFin,$idoffre,$token,$idsous);
								
								//On va prolonger la date de fin dans la table souscriptions
							//	$test="[".$dateJour."] Reabonnement :".$numero."".PHP_EOL;
								//fputs($files,$test);				
								
													}
													
													else{
											//On va prolonger la date de fin dans la table souscriptions
											$data['offre']= $this->Evf_model->get_offre();
											$dateN = strtotime($row['datefin']);
											$dateN = strtotime("+" .$data['offre'][0]['duree']. " day", $dateN);
											$dateF = date('Y-m-d H:i:s', $dateN);
											$update_souscription_prolabon=$this->Evf_model->update_souscription_prolabon($dateJour,$dateF,$idoffre,$token,$idsous);
	
														 }
	
				//Insertion dans la table statsouscription 
				$param['datedebut']=$dateJour;
				$param['datefin']=$dateFin;
				$param['dateheure']=$dateJour;
				$param['datestat']=$dateJour;
				$param['etatstat']='S';
				$param['idoffre']=$idoffre;
				$param['numero']=$numero;
				$param['statutstat']=true;
				$param['libelleoffre']=$liboffre;
				$param['montantoffre']=$montantoffre;
				$param['idsous']=$idsous;
				$insert_stat=$this->Evf_model->insert_stat_souscription($param);
			//$test="[".$dateJour."] Reabonnement :".$numero."".PHP_EOL;
			//fputs($files,$test);
				$sms=1; 
	
				if($row["etatsous"]=="D"){
			  		$sms=3; 
				}
					 else{
			  		$sms=1; 
					 }      
			
	
	
        }
        else{        
			/*
			*Nous sommes dans le cas d'une nouvelle souscription   
			*/
	
			//Insertion dans la table souscription

			$param_sous['datedebut']=$dateJour;
            $param_sous['datefin']=$dateFin;
			$param_sous['datefinsous']=$dateFin;
			$param_sous['datesouscription']=$dateJour;
            $param_sous['numero']=$numero;
            $param_sous['statutsous']=true;
            $param_sous['etatsous']='S';
			$param_sous['relance']=false;
			$param_sous['idoffre']=$idoffre;
            $param_sous['token']=$token;
           // $param['idsous']=$idsous;


			$insert_souscript=$this->Evf_model->insert_souscription($param_sous);
			
			$idsous_n=$insert_souscript;   
			$param_stat['datedebut']=$dateJour;
            $param_stat['datefin']=$dateFin;
			$param_stat['dateheure']=$dateJour;
			$param_stat['datestat']=$dateJour;
            $param_stat['etatstat']='S';
            $param_stat['idoffre']=$idoffre;
            $param_stat['numero']=$numero;
			$param_stat['statutstat']=true;
			$param_stat['libelleoffre']=$liboffre;
            $param_stat['montantoffre']=$montantoffre;
            $param_stat['idsous']=$idsous_n;
	
			//Insertion dans la table statsouscription   
			//$sqlstat="INSERT INTO statsouscription VALUES(NULL,'$dateJour','$dateFin','$dateJour','$dateJour','S',$idoffre,'$numero',true,'$liboffre',$montantoffre,$idsous)";
			//mysql_query($sqlstat); 
			$insert_stat=$this->Evf_model->insert_stat_souscription($param_stat);
	
			//$test="[".$dateJour."] Nouvelle incription :".$numero."".PHP_EOL;
			//fputs($files,$test);
	
		$sms=2;
	
		}
	 //fclose($files);
	
		if($sms==1){


			$message=utf8_encode("Votre abonnement au service vie Enfant et Famille a été prolongé".$duree." jr".$montantoffre."F. Pour vous débonner, composez #303*2389#");
	
		}else{
		 $message=utf8_encode("Vous êtes abonné au service Agenda Event à".$montantoffre." FCFA/".$liboffre.". Pour vous débonner, composez #303*2389#");
	
			}
					
					$data1="{\r\n
								\"outboundSMSMessageRequest\": {\r\n      
								\"address\": [\"acr:X-Orange-ISE2\"],\r\n      
								\"senderAddress\": \"tel:+2250000\",\r\n     
								\"outboundSMSTextMessage\": {\r\n          
								\"message\": \"".$message."\"\r\n },\r\n      
								\"clientCorrelator\": \"".$clientCorrelator."\",\r\n      
								\"receiptRequest\": {\r\n          
								\"notifyURL\": \"http://application.example.com/notifications/DeliveryInfoNotification\",\r\n          
								\"callbackData\": \"some-data-useful-to-the-requester\"\r\n },\r\n      
								\"senderName\": \"".$sendername."\"\r\n  }\r\n
								}\r\n  ";
			 
		  
		  
						$curl = curl_init();
						
						curl_setopt_array($curl, array(
							CURLOPT_URL => "https://api.bizao.com/smsmessaging/v1/outbound/tel:+2250000/requests",
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_ENCODING => "",
							CURLOPT_MAXREDIRS => 10,
							CURLOPT_TIMEOUT => 30,
							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							CURLOPT_CUSTOMREQUEST => "POST",
							CURLOPT_POSTFIELDS => $data1,
							CURLOPT_HTTPHEADER => array(
							"authorization: Bearer $ACCESS_TOKEN",
							"bizao-alias: $numero",
							"bizao-token: $token",
							"cache-control: no-cache",
							"content-type: application/json",
							"x-oapi-application-id: BIZAO",
							"x-oapi-contact-id: b2b-bizao-97b5878",
							"x-oapi-resource-type: SMS_OSM",
							"x-orange-mco: OCI"
							),
						));
		  
						$response1 = curl_exec($curl);
						$err1 = curl_error($curl);
						
						curl_close($curl);
						
						if ($err1) {
							echo "cURL Error #:" . $err1;
						} else {
							echo $response1;
						}
	
	
	 
		
						if($sms==1){
							$this->load->view('view_souscrire_confirm_prolonge');
						
						}else{
						
						
						} 
			}


		
	
			else{  

				$this->load->view('view_souscrire_confirm_nocredit');
				
				
				}
	
		}

		public function info()
		{
		 $this->load->view('view_info');
		}
		public function desabonner()
		{
	   /*  if(isset($_POST['option'])){
			 $option=$_POST['option'];
		 }
	
			 $data['option']=$this->input->get('option'); */
			$this->load->view('view_desabonner');
		}
		public function desabonner_confirm()
		{
			
			$sendername="MP";
			$numero=$msisdn=$_SERVER['HTTP_USER_MSISDN'];
			$token=$_SERVER['HTTP_USER_TOKEN'];
			$ACCESS_TOKEN="0251f9b4-80fe-3005-96b6-edb5f805d8a0";
			$referenceCode=uniqid();
			$clientCorrelator=uniqid();
			if(isset($_SERVER['HTTP_USER_OFFRE'])){
				$offre=$_SERVER['HTTP_USER_OFFRE'];
			}
 			if (isset($offre)) {

	   			$data['offre']= $this->Evf_model->get_offre();

				$idoffre=$data['offre'][0]['idoffre'];
				$liboffre=$data['offre'][0]['libelle'];
				$montantoffre=$data['offre'][0]['montant'];
				$duree=$data['offre'][0]['duree'];
			}
		   
			$dateJour = date("Y-m-d H:i:s");
			$date = strtotime($dateJour);
			$dateFin = date('Y-m-d H:i:s', $date);

		   
			   //Recherche de la souscription du client;
			   $search=$this->Evf_model->search_souscription_user($numero);
		   
			   if(!empty($search)){
				$data['souscription']= $this->Evf_model->souscription_user($numero);

				$idsous=$data['souscription'][0]['idsous'];
				   //Modification de l'etat dans la table souscription
				   $update=$this->Evf_model->update_souscription_desabon($idsous);

				   //Insertion d'une ligne dans la table desouscription
				  
 				   $param_desous['dateheure']=$dateJour;
				   $param_desous['datestat']=$dateJour;
				   $param_desous['idoffre']=$idoffre;
				   $param_desous['idsous']=$idsous;

				   $insert_desous=$this->Evf_model->insert_desouscription($param_desous);
		   
		   
		    //$test="[".$dateJour."] Desabonnement :".$numero."".PHP_EOL;
			//	   fputs($files,$test);
			  // fclose($files);
		   
			   $message=utf8_encode("Votre désabonnement au service Agenda Event a été effectué avec succes. Pour vous réabonner, composez #303*2389#");
			   $token=$souscription["token"];
		   
			$data1="------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			name=\"sendername\"\r\n\r\n".$sendername."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			name=\"message\"\r\n\r\n".$message." \r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
			name=\"numero\"\r\n\r\n".$numero."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			name=\"token\"\r\n\r\n".$token."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
		   
		   
		   
		   $curl = curl_init();
		   
		   curl_setopt_array($curl, array(
		   CURLOPT_URL => "http://appvas.net/ussdalertesante/agendaevents/sendsms.php",
		   CURLOPT_RETURNTRANSFER => true,
		   CURLOPT_ENCODING => "",
		   CURLOPT_MAXREDIRS => 10,
		   CURLOPT_TIMEOUT => 30,
		   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		   CURLOPT_CUSTOMREQUEST => "POST",
		   CURLOPT_POSTFIELDS => $data1,
		   CURLOPT_HTTPHEADER => array(
		   "cache-control: no-cache",
		   "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
		   "postman-token: b41fe8cc-03d0-f78a-fac4-cdb8cf03f536"
		   ),
		   ));
		   
		   $response = curl_exec($curl);
		   $err = curl_error($curl);
		   
		   curl_close($curl);
		   
		   if ($err) {
		   echo "cURL Error #:" . $err;
		   } else {
		   
		   echo $response;
		   
		   }
		    $this->load->view('view_desabonner_confirm');

		   
			   }else{
				$this->load->view('view_nosouscription');

			 } 

		}
		
}