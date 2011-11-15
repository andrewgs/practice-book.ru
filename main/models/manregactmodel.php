<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Manregactmodel extends CI_Model {
	
	var $mra_id	 = 0;
	var $mra_uid = 0;
	var $mra_rid = "";
	var $mra_aid = "";
	var $mra_banner = "";
	var $mra_pricing = "";
	var $mra_season = "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($rid,$aid){
		
		$this->db->where('mra_rid',$rid);
		$this->db->where('mra_aid',$aid);
		$query = $this->db->get('tbl_mra',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['mra_id'];
		return FALSE;
	}

	function insert_record($uid,$rid,$aid){
		
		$this->mra_uid 		= $uid;
		$this->mra_rid 		= $rid;
		$this->mra_aid 		= $aid;
		$this->mra_banner 	= "";
		$this->mra_pricing 	= "";
		$this->mra_season 	= "";
		$this->db->insert('tbl_mra',$this);
		return $this->db->insert_id();
	}

	function read_field($mra_id,$field){
	
		$this->db->where('mra_id',$mra_id);
		$query = $this->db->get('tbl_mra',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function set_manager_on_region($mra_id,$uid){
	
		$this->db->set('mra_uid', $uid);
		$this->db->where('mra_id',$mra_id);
		$this->db->update('tbl_mra');
	}
	
	function save_banner($mra_id,$banner){
		
		$this->db->set('mra_banner',$banner);
		$this->db->where('mra_id',$mra_id);
		$this->db->update('tbl_mra');
	}
	
	function save_pricing($mra_id,$pricing){
		
		$this->db->set('mra_pricing',$pricing);
		$this->db->where('mra_id',$mra_id);
		$this->db->update('tbl_mra');
	}
	
	function save_actpricing($activity,$pricing){
		
		$this->db->set('mra_pricing',$pricing);
		$this->db->where('mra_aid',$activity);
		$this->db->update('tbl_mra');
	}
	
	function save_season($mra_id,$season){
		
		$this->db->set('mra_season',$season);
		$this->db->where('mra_id',$mra_id);
		$this->db->update('tbl_mra');
	}
	
	function save_actseason($activity,$season){
		
		$this->db->set('mra_season',$season);
		$this->db->where('mra_aid',$activity);
		$this->db->update('tbl_mra');
	}
	
	function update_managers($uid,$rid,$aid){
		
		$this->db->set('mra_uid',$uid);
		$this->db->where('mra_aid',$aid);
		$this->db->where('mra_rid',$rid);
		$this->db->update('tbl_mra');
	}

	function mra_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_mra');
		$data = $query->result_array();
		if(count($data) > 0) return TRUE;
		return FALSE;
	}
}