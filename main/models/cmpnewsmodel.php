<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cmpnewsmodel extends CI_Model {
	
	var $cn_id 			= 0;
	var $cn_cmpid		= 0;
	var $cn_title		= "";
	var $cn_note 		= "";
	var $cn_logo 		= "";
	var $cn_pdatebegin 	= "";
	var $cn_pdateend	= "";
	var $cn_activity 	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($cid,$insertdata){
			
		$this->cn_cmpid			= $cid;
		$this->cn_title			= htmlspecialchars($insertdata['title']);
		$this->cn_note			= strip_tags($insertdata['description']);
		$this->cn_logo			= $insertdata['photo'];
		$this->cn_pdatebegin	= $insertdata['pdatebegin'];
		$this->cn_pdateend		= $insertdata['pdateend'];
		$this->cn_activity		= $insertdata['activity'];
		
		$this->db->insert('tbl_cmpnews',$this);
		return $this->db->insert_id();
	}
	
	function read_record($nid,$cid){
		
		$this->db->where('cn_id',$nid);
		$this->db->where('cn_cmpid',$cid);
		$this->db->where('cn_pdatebegin>=',date("Y-m-d"));
		$this->db->where('cn_pdateend',"3000-01-01");
		$query = $this->db->get('tbl_cmpnews',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($cid){
		
		$this->db->select('cn_id,cn_cmpid,cn_title,cn_note,cn_pdatebegin,cn_pdateend');
		$this->db->where('cn_cmpid',$cid);
		$this->db->where('cn_pdatebegin >=',date("Y-m-d"));
		$this->db->where('cn_pdateend',"3000-01-01");
		$this->db->order_by('cn_pdatebegin','DESC');
		$query = $this->db->get('tbl_cmpnews');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function read_allrecords($cid){
		
		$this->db->select('cn_id,cn_cmpid,cn_title,cn_note,cn_pdatebegin,cn_pdateend');
		$this->db->where('cn_cmpid',$cid);
		$this->db->order_by('cn_pdatebegin','DESC');
		$this->db->order_by('cn_id','DESC');
		$query = $this->db->get('tbl_cmpnews');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($cid,$limit){
	
		$this->db->select('cn_id,cn_cmpid,cn_title,cn_note,cn_pdatebegin,cn_pdateend');
		$this->db->where('cn_cmpid',$cid);
		$this->db->where('cn_pdatebegin <=',date("Y-m-d"));
		$this->db->where('cn_pdateend >=',date("Y-m-d"));
		$this->db->order_by('cn_id desc, cn_pdatebegin desc');
		$query = $this->db->get('tbl_cmpnews',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('cn_id',$id);
		$this->db->select('cn_logo');
		$query = $this->db->get('tbl_cmpnews');
		$data = $query->result_array();
		return $data[0]['cn_logo'];
	}

	function save_single_data($id,$cid,$field,$data){
		
		$this->db->where('cn_id',$id);
		$this->db->where('cn_cmpid',$cid);
		$this->db->set($field,$data);
		$this->db->update('tbl_cmpnews');
		return $this->db->affected_rows();
	}

	function save_news($id,$cid,$title,$note){
	
		$this->db->where('cn_id',$id);
		$this->db->where('cn_cmpid',$cid);
		$this->db->set('cn_title',$title);
		$this->db->set('cn_note',$note);
		$this->db->update('tbl_cmpnews');
		return $this->db->affected_rows();
	}
	
	function delete_record($nid,$cid){
	
		$this->db->where('cn_id',$nid);
		$this->db->where('cn_cmpid',$cid);
		$this->db->delete('tbl_cmpnews');
		return $this->db->affected_rows();
	}

	function read_field($nid,$cid,$field){
			
		$this->db->where('cn_id',$nid);
		$this->db->where('cn_cmpid',$cid);
		$query = $this->db->get('tbl_cmpnews',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function extend_day($nid,$cid,$day){
	
		$this->db->set('cn_pdateend','cn_pdateend+INTERVAL '.$day.' DAY',FALSE);
		$this->db->where('cn_id',$nid);
		$this->db->where('cn_cmpid',$cid);
		$this->db->update('tbl_cmpnews');
		return $this->db->affected_rows();
	}
}
?>