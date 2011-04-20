<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Productionunitmodel extends CI_Model {
	
	var $pri_id	 				= 0;
	var $pri_mraid	 			= 0;
	var $pri_title 				= "";
	var $pri_note 				= "";
	var $pri_lowprice			= "";
	var $pri_lowpricecode 		= 1;
	var $pri_optimumprice 		= "";
	var $pri_optimumpricecode 	= 1;
	var $pri_topprice		 	= "";
	var $pri_toppricecode	 	= 1;
	var $pri_unitscode		 	= 1;
	var $pri_riskslowprice	 	= "";
	var $pri_advantages		 	= "";
	var $pri_image			 	= "";
	var $pri_groupcode			= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id,$group){
	
		$this->db->where('pri_id',$id);
		$this->db->where('pri_groupcode',$group);
		$query = $this->db->get('tbl_productionunit',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_unit($id,$group){
		$this->db->select('pri_id,pri_title,pri_note,pri_lowprice,pri_lowpricecode,pri_optimumprice,pri_optimumpricecode,pri_topprice,pri_toppricecode,pri_unitscode,pri_riskslowprice,pri_advantages');
		$this->db->where('pri_id',$id);
		$this->db->where('pri_groupcode',$group);
		$query = $this->db->get('tbl_productionunit',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_units($group,$mraid){
		$this->db->select('pri_id,pri_title,pri_note,pri_lowprice,pri_lowpricecode,pri_optimumprice,pri_optimumpricecode,pri_topprice,pri_toppricecode,pri_unitscode,pri_riskslowprice,pri_advantages');
		$this->db->where('pri_groupcode',$group);
		$this->db->where('pri_mraid',$mraid);
		$query = $this->db->get('tbl_productionunit');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_records_title($groupcode,$mraid){
	
		$this->db->select('pri_id');
		$this->db->select('pri_title');
		$this->db->where('pri_groupcode',$groupcode);
		$this->db->where('pri_mraid',$mraid);
		$query = $this->db->get('tbl_productionunit');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($mraid,$insertdata,$groupe){
		
		$this->pri_mraid	 		= $mraid;
		$this->pri_title 			= htmlspecialchars(trim($insertdata['title']));
		$this->pri_note 			= strip_tags($insertdata['note'],'<br>');
		$this->pri_lowprice			= trim($insertdata['lowprice']);
		$this->pri_lowpricecode 	= $insertdata['lowpricecode'];
		$this->pri_optimumprice 	= trim($insertdata['optimumprice']);
		$this->pri_optimumpricecode = $insertdata['optimumpricecode'];
		$this->pri_topprice		 	= trim($insertdata['topprice']);
		$this->pri_toppricecode	 	= $insertdata['toppricecode'];
		$this->pri_unitscode		= $insertdata['unitscode'];
		$this->pri_riskslowprice	= strip_tags($insertdata['riskslowprice'],'<br>');
		$this->pri_advantages		= strip_tags($insertdata['advantages'],'<br>');
		$this->pri_image			= $insertdata['image'];
		$this->pri_groupcode		= $groupe;

		$this->db->insert('tbl_productionunit',$this);
		return $this->db->insert_id();
	}

	function update_record($id,$mraid,$updatedata,$groupe){
		
		$this->db->set('pri_title',htmlspecialchars(trim($updatedata['title'])));
		$this->db->set('pri_note',strip_tags($updatedata['note'],'<br>'));
		$this->db->set('pri_lowprice',trim($updatedata['lowprice']));
		$this->db->set('pri_lowpricecode',$updatedata['lowpricecode']);
		$this->db->set('pri_optimumprice',trim($updatedata['optimumprice']));
		$this->db->set('pri_optimumpricecode',$updatedata['optimumpricecode']);
		$this->db->set('pri_topprice',trim($updatedata['topprice']));
		$this->db->set('pri_toppricecode',$updatedata['toppricecode']);
		$this->db->set('pri_unitscode',trim($updatedata['unitscode']));
		$this->db->set('pri_riskslowprice',strip_tags($updatedata['riskslowprice'],'<br>'));
		$this->db->set('pri_advantages',strip_tags($updatedata['advantages'],'<br>'));
		if($updatedata['image']):
			$this->db->set('pri_image',$updatedata['image']);
		endif;
		$this->db->where('pri_id',$id);
		$this->db->where('pri_mraid',$mraid);
		$this->db->where('pri_groupcode',$groupe);
		$this->db->update('tbl_productionunit');
	}

	function delete_record($id,$groupe){
	
		$this->db->where('pri_id',$id);
		$this->db->where('pri_groupcode',$groupe);
		$this->db->delete('tbl_productionunit');
		return $this->db->affected_rows();
	}
	
	function get_image($id){
	
		$this->db->where('pri_id',$id);
		$this->db->select('pri_image');
		$query = $this->db->get('tbl_productionunit');
		$data = $query->result_array();
		return $data[0]['pri_image'];
	}
}