<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bediscountmodel extends CI_Model {
	
	var $bed_id 		= 0;
	var $bed_title		= "";
	var $bed_note 		= "";
	var $bed_photo 		= "";
	var $bed_date	 	= "";
	var $bed_activity	= 0;
	var $bed_environment= 0;
	var $bed_department	= 0;
	var $bed_userid		= 0;
	var $bed_views		= 0;
	var $bed_comments	= 0;
	var $bed_group		= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($insertdata,$activity,$environment,$department,$userid,$group){
			
		$this->bed_title		= htmlspecialchars($insertdata['title']);
		$this->bed_note			= strip_tags($insertdata['description'],'<br>');
		$this->bed_photo		= $insertdata['photo'];
		$this->bed_date			= $insertdata['pdatebegin'];
		$this->bed_activity		= $activity;
		$this->bed_environment	= $environment;
		$this->bed_department	= $department;
		$this->bed_userid		= $userid;
		$this->bed_views		= 0;
		$this->bed_comments		= 0;
		$this->bed_group		= $group;
		
		$this->db->insert('tbl_be_discount',$this);
		return $this->db->insert_id();
	}
	
	function read_record($nid,$mraid){
		
		$this->db->where('bed_id',$nid);
		$this->db->where('bed_mraid',$mraid);
		$query = $this->db->get('tbl_be_discount',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($mraid){
		
		$this->db->select('bed_id,bed_mraid,bed_title,bed_note,bed_date,bed_source');
		$this->db->where('bed_mraid',$mraid);
		$this->db->order_by('bed_date','DESC');
		$query = $this->db->get('tbl_be_discount');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($mraid,$limit){
	
		$this->db->select('bed_id,bed_mraid,bed_title,bed_note,bed_date,bed_source');
		$this->db->where('bed_mraid',$mraid);
		$this->db->where('bed_date <=',date("Y-m-d"));
		$this->db->order_by('bed_id desc, bed_date desc');
		$query = $this->db->get('tbl_be_discount',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('bed_id',$id);
		$this->db->select('bed_photo');
		$query = $this->db->get('tbl_be_discount');
		$data = $query->result_array();
		return $data[0]['bed_photo'];
	}
	
	function count_records($activity,$environment,$department,$group){
		
		if(!$environment) $department = 0;
		$this->db->select('count(*) as cnt');
		$this->db->where('bed_activity',$activity);
		$this->db->where('bed_environment',$environment);
		$this->db->where('bed_department',$department);
		$this->db->where('bed_group',$group);
		$query = $this->db->get('tbl_be_discount');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function insert_comments($id){
		$this->db->set('bed_comments','bed_comments+1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function delete_comments($id){
	
		$this->db->set('bed_comments','bed_comments-1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}

	function insert_views($id){
		$this->db->set('bed_views','bed_views+1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function clear_views($id){
	
		$this->db->set('bed_comments',0,FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function delete_record($aid){
	
		$this->db->where('bed_id',$aid);
		$this->db->delete('tbl_be_discount');
		return $this->db->affected_rows();
	}

	function read_field($nid,$mraid,$field){
			
		$this->db->where('bed_id',$nid);
		$this->db->where('bed_mraid',$mraid);
		$query = $this->db->get('tbl_be_discount',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function topic_exist($id,$environment,$department,$activity,$group){
		
		if(!$environment) $department = 0;
		$this->db->where('bed_id',$id);
		$this->db->where('bed_environment',$environment);
		$this->db->where('bed_department',$department);
		$this->db->where('bed_activity',$activity);
		$this->db->where('bed_group',$group);
		$query = $this->db->get('tbl_be_discount',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>