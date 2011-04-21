<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cmpunitsmodel extends CI_Model {
	
	var $cu_id	 		= 0;
	var $cu_cmpid	 	= 0;
	var $cu_title 		= "";
	var $cu_note 		= "";
	var $cu_price		= "";
	var $cu_priceunit 	= 1;
	var $cu_image 		= "";
	var $cu_groupcode	= 0;
	var $cu_unitscode	= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function read_record($id,$group){
	
		$this->db->where('cu_id',$id);
		$this->db->where('cu_groupcode',$group);
		$query = $this->db->get('tbl_companyunits',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_unit($id,$group){
	
		$this->db->select('cu_id,cu_title,cu_note,cu_price,cu_priceunit,cu_unitscode');
		$this->db->where('cu_id',$id);
		$this->db->where('cu_groupcode',$group);
		$query = $this->db->get('tbl_companyunits',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_units($group,$cmpid){
	
		$this->db->select('cu_id,cu_title,cu_note,cu_price,cu_priceunit,cu_unitscode');
		$this->db->where('cu_groupcode',$group);
		$this->db->where('cu_cmpid',$cmpid);
		$query = $this->db->get('tbl_companyunits');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_records_title($groupcode,$cmpid){
	
		$this->db->select('cu_id');
		$this->db->select('cu_title');
		$this->db->where('cu_groupcode',$groupcode);
		$this->db->where('cu_cmpid',$cmpid);
		$query = $this->db->get('tbl_companyunits');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function insert_record($cmpid,$insertdata,$groupe){
		
		$this->cu_cmpid	 		= $cmpid;
		$this->cu_title 		= htmlspecialchars(trim($insertdata['title']));
		$this->cu_note 			= strip_tags($insertdata['note'],'<br>');
		$this->cu_price			= trim($insertdata['price']);
		$this->cu_priceunit 	= $insertdata['pricecode'];
		$this->cu_image			= $insertdata['image'];
		$this->cu_groupcode		= $groupe;
		$this->cu_unitscode		= $insertdata['unitscode'];
		
		$this->db->insert('tbl_companyunits',$this);
		return $this->db->insert_id();
	}

	function insert_empty($cmpid,$insertdata,$groupe){
		
		$this->cu_cmpid 		= $cmpid;
		$this->cu_title 		= htmlspecialchars(trim($insertdata['title']));
		$this->cu_note 			= strip_tags($insertdata['note'],'<br>');
		$this->cu_price			= "0.00";
		$this->cu_priceunit 	= "руб.";
		$this->cu_image			= $insertdata['image'];
		$this->cu_groupcode		= $groupe;
		$this->cu_unitscode		= 0;
		
		$this->db->insert('tbl_companyunits',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$cmpid,$updatedata,$groupe){
		
		$this->db->set('cu_title',htmlspecialchars(trim($updatedata['title'])));
		$this->db->set('cu_note',strip_tags($updatedata['note'],'<br>'));
		$this->db->set('cu_price',trim($updatedata['price']));
		$this->db->set('cu_priceunit',$updatedata['pricecode']);
		$this->db->set('cu_unitscode',$updatedata['unitscode']);
		if($updatedata['image']):
			$this->db->set('cu_image',$updatedata['image']);
		endif;
		$this->db->where('cu_id',$id);
		$this->db->where('cu_cmpid',$cmpid);
		$this->db->where('cu_groupcode',$groupe);
		$this->db->update('tbl_companyunits');
	}

	function delete_record($id,$groupe){
	
		$this->db->where('cu_id',$id);
		$this->db->where('cu_groupcode',$groupe);
		$this->db->delete('tbl_companyunits');
		return $this->db->affected_rows();
	}
	
	function unit_exist($cmpid,$groupe,$title){
	
		$this->db->where('cu_cmpid',$cmpid);
		$this->db->where('cu_groupcode',$groupe);
		$this->db->where('cu_title',$title);
		$query = $this->db->get('tbl_companyunits',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cu_id'];
		return FALSE;
	}
	
	function get_image($id){
	
		$this->db->where('cu_id',$id);
		$this->db->select('cu_image');
		$query = $this->db->get('tbl_companyunits');
		$data = $query->result_array();
		return $data[0]['cu_image'];
	}
}