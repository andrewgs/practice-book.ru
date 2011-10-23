<?php

class Dlrregionmodel extends CI_Model {
	
	var $drg_id 	= 0;
	var $drg_dlrid 	= 0;
	var $drg_regid 	= 0;
	var $drg_date 	= "";
	
	function __construct(){
        
		parent::__construct();
    }
	
	function insert_record($dlrid,$region){
			
		$this->drg_dlrid = $dlrid;
		$this->drg_regid = $region;
		$this->drg_date = date("Y-m-d");
		
		$this->db->insert('tbl_dealer_region',$this);
		return $this->db->insert_id();
	}

	function group_insert($dlrid,$regions){
		$query = '';
		for($i=0;$i<count($regions);$i++):
			$query .= '('.$dlrid.','.$regions[$i].',"'.date("Y-m-d").'") ';
			if($i+1<count($regions)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_dealer_region (drg_dlrid,drg_regid,drg_date) VALUES ".$query);
	}
	
	function read_records($dlrid){
		
		$this->db->where('drg_dlrid',$dlrid);
		$query = $this->db->get('tbl_dealer_region');
		return $query->result_array();
	}
	
	function delete_record($id){
	
		$this->db->where('drg_id',$id);
		$this->db->delete('tbl_dealer_region');
	}
	
	function delete_records($dlrid){
	
		$this->db->where('drg_dlrid',$dlrid);
		$this->db->delete('tbl_dealer_region');
	}
}
?>