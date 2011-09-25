<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cmpsharesmodel extends CI_Model {
	
	var $sh_id 			= 0;
	var $sh_cmpid		= 0;
	var $sh_title		= "";
	var $sh_note 		= "";
	var $sh_logo 		= "";
	var $sh_pdatebegin 	= "";
	var $sh_pdateend	= "";
	var $sh_activity 	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($sid,$insertdata){
			
		$this->sh_cmpid			= $sid;
		$this->sh_title			= strip_tags($insertdata['title']);
		$this->sh_note			= strip_tags($insertdata['description'],'<br>');
		$this->sh_logo			= $insertdata['photo'];
		$this->sh_pdatebegin	= $insertdata['pdatebegin'];
		$this->sh_pdateend		= $insertdata['pdateend'];
		$this->sh_activity		= $insertdata['activity'];
		
		$this->db->insert('tbl_cmpshares',$this);
		return $this->db->insert_id();
	}
	
	function read_record($sid,$cid){
		
		$this->db->select('sh_id,sh_cmpid,sh_title,sh_note,sh_pdatebegin,sh_pdateend');
		$this->db->where('sh_id',$sid);
		$this->db->where('sh_cmpid',$cid);
		$this->db->where('sh_pdatebegin>=',date("Y-m-d"));
		$this->db->where('sh_pdateend',"3000-01-01");
		$query = $this->db->get('tbl_cmpshares',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($sid){
		
		$this->db->select('sh_id,sh_cmpid,sh_title,sh_note,sh_pdatebegin,sh_pdateend');
		$this->db->where('sh_cmpid',$sid);
		$this->db->where('sh_pdatebegin >=',date("Y-m-d"));
		$this->db->where('sh_pdateend',"3000-01-01");
		$this->db->order_by('sh_pdatebegin','DESC');
		$query = $this->db->get('tbl_cmpshares');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}

	function read_allrecords($cid){
		
		$this->db->select('sh_id,sh_cmpid,sh_title,sh_note,sh_pdatebegin,sh_pdateend');
		$this->db->where('sh_cmpid',$cid);
		$this->db->order_by('sh_pdatebegin','DESC');
		$this->db->order_by('sh_id','DESC');
		$query = $this->db->get('tbl_cmpshares');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}

	function read_limit_records($cid,$limit){
		
		$this->db->select('sh_id,sh_cmpid,sh_title,sh_note,sh_pdatebegin,sh_pdateend');
		$this->db->where('sh_cmpid',$cid);
		$this->db->where('sh_pdatebegin <=',date("Y-m-d"));
		$this->db->where('sh_pdateend >=',date("Y-m-d"));
		$this->db->order_by('sh_id desc, sh_pdatebegin desc');
		$query = $this->db->get('tbl_cmpshares',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('sh_id',$id);
		$this->db->select('sh_logo');
		$query = $this->db->get('tbl_cmpshares');
		$data = $query->result_array();
		return $data[0]['sh_logo'];
	}

	function save_single_data($id,$cid,$field,$data){
		
		$this->db->where('sh_id',$id);
		$this->db->where('sh_cmpid',$cid);
		$this->db->set($field,$data);
		$this->db->update('tbl_cmpshares');
		return $this->db->affected_rows();
	}

	function save_news($sid,$cid,$title,$note){
	
		$this->db->where('sh_id',$sid);
		$this->db->where('sh_cmpid',$cid);
		$this->db->set('sh_title',$title);
		$this->db->set('sh_note',$note);
		$this->db->update('tbl_cmpshares');
		return $this->db->affected_rows();
	}
	
	function delete_record($sid,$cid){
	
		$this->db->where('sh_id',$sid);
		$this->db->where('sh_cmpid',$cid);
		$this->db->delete('tbl_cmpshares');
		return $this->db->affected_rows();
	}

	function read_field($sid,$cid,$field){
			
		$this->db->where('sh_id',$sid);
		$this->db->where('sh_cmpid',$cid);
		$query = $this->db->get('tbl_cmpshares',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function extend_day($sid,$cid,$day){
	
		$this->db->set('sh_pdateend','sh_pdateend+INTERVAL '.$day.' DAY',FALSE);
		$this->db->where('sh_id',$sid);
		$this->db->where('sh_cmpid',$cid);
		$this->db->update('tbl_cmpshares');
		return $this->db->affected_rows();
	}
}
?>