<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recapnew_model extends CI_Model {

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get() {

        $this->db->select('*');
        $this->db->from('souscription');
        $this->db->where('numero', $numero);
        $this->db->where('statutsous=true');
       /// $this->db->where('etatsous='s'');
        $query = $this->db->get();

    }
        /*if ($id != null) {
            $this->db->where('accountants.id', $id);
        } else {
            $this->db->order_by('accountants.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }*/



   
}
