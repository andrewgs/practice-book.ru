<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Specialsmodel extends CI_Model{
	
	var $spc_id 		= 0;
	var $spc_activity	= 0;
	var $spc_title		= "";
	var $spc_note 		= "";
	var $spc_image 		= "";
	var $spc_date	 	= "";
	var $spc_source		= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($activity,$insertdata){
			
		$this->spc_activity	= $activity;
		$this->spc_title	= htmlspecialchars($insertdata['title']);
		$this->spc_note		= strip_tags($insertdata['note'],'<br>');
		$this->spc_image	= $insertdata['image'];
		$this->spc_date		= $insertdata['date'];
		$this->spc_source	= htmlspecialchars($insertdata['source']);
		$this->db->insert('tbl_specials',$this);
		return $this->db->insert_id();
	}
	
	function read_record($nid,$activity){
		
		$this->db->where('spc_id',$nid);
		$this->db->where('spc_activity',$activity);
		$query = $this->db->get('tbl_specials',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($activity){
		
		$this->db->select('spc_id,spc_activity,spc_title,spc_note,spc_date,spc_source');
		$this->db->where('spc_activity',$activity);
		$this->db->order_by('spc_date','DESC');
		$query = $this->db->get('tbl_specials');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($activity,$limit){
	
		$this->db->select('spc_id,spc_activity,spc_title,spc_note,spc_date');
		$this->db->where('spc_activity',$activity);
		$this->db->where('spc_date <=',date("Y-m-d"));
		$this->db->order_by('spc_id desc, spc_date desc');
		$query = $this->db->get('tbl_specials',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('spc_id',$id);
		$this->db->select('spc_image');
		$query = $this->db->get('tbl_specials');
		$data = $query->result_array();
		return $data[0]['spc_image'];
	}

	function save_single_data($nid,$activity,$field,$data){
		
		$this->db->where('spc_id',$nid);
		$this->db->where('spc_activity',$activity);
		$this->db->set($field,$data);
		$this->db->update('tbl_specials');
		return $this->db->affected_rows();
	}

	function save_news($nid,$title,$note){
	
		$this->db->where('spc_id',$nid);
		$this->db->set('spc_title',$title);
		$this->db->set('spc_note',$note);
		$this->db->update('tbl_specials');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('spc_id',$id);
		$this->db->delete('tbl_specials');
		return $this->db->affected_rows();
	}

	function read_field($nid,$activity,$field){
			
		$this->db->where('spc_id',$nid);
		$this->db->where('spc_activity',$activity);
		$query = $this->db->get('tbl_specials',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
}
?>