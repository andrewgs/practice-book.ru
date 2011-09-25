<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Benewsmodel extends CI_Model {
	
	var $ben_id 		= 0;
	var $ben_title		= "";
	var $ben_note 		= "";
	var $ben_photo 		= "";
	var $ben_date	 	= "";
	var $ben_source		= "";
	var $ben_activity	= 0;
	var $ben_environment= 0;
	var $ben_department	= 0;
	var $ben_userid		= 0;
	var $ben_views		= 0;
	var $ben_comments	= 0;
	var $ben_group		= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($insertdata,$activity,$environment,$department,$userid,$group){
			
		$this->ben_title		= htmlspecialchars($insertdata['title']);
		$this->ben_note			= strip_tags($insertdata['description'],'<br>');
		$this->ben_photo		= $insertdata['photo'];
		$this->ben_date			= $insertdata['pdatebegin'];
		$this->ben_source		= htmlspecialchars($insertdata['source']);
		$this->ben_activity		= $activity;
		$this->ben_environment	= $environment;
		$this->ben_department	= $department;
		$this->ben_userid		= $userid;
		$this->ben_views		= 0;
		$this->ben_comments		= 0;
		$this->ben_group		= $group;
		
		$this->db->insert('tbl_be_news',$this);
		return $this->db->insert_id();
	}
	
	function read_record($nid,$mraid){
		
		$this->db->where('ben_id',$nid);
		$this->db->where('ben_mraid',$mraid);
		$query = $this->db->get('tbl_be_news',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($mraid){
		
		$this->db->select('ben_id,ben_mraid,ben_title,ben_note,ben_date,ben_source');
		$this->db->where('ben_mraid',$mraid);
		$this->db->order_by('ben_date','DESC');
		$query = $this->db->get('tbl_be_news');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($mraid,$limit){
	
		$this->db->select('ben_id,ben_mraid,ben_title,ben_note,ben_date,ben_source');
		$this->db->where('ben_mraid',$mraid);
		$this->db->where('ben_date <=',date("Y-m-d"));
		$this->db->order_by('ben_id desc, ben_date desc');
		$query = $this->db->get('tbl_be_news',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('ben_id',$id);
		$this->db->select('ben_photo');
		$query = $this->db->get('tbl_be_news');
		$data = $query->result_array();
		return $data[0]['ben_photo'];
	}
	
	function count_records($activity,$environment,$department,$group){
		
		if(!$environment) $department = 0;
		$this->db->select('count(*) as cnt');
		$this->db->where('ben_activity',$activity);
		$this->db->where('ben_environment',$environment);
		$this->db->where('ben_department',$department);
		$this->db->where('ben_group',$group);
		$query = $this->db->get('tbl_be_news');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function insert_comments($id){
		$this->db->set('ben_comments','ben_comments+1',FALSE);
		$this->db->where('ben_id',$id);
		$this->db->update('tbl_be_news');
	}
	
	function delete_comments($id){
	
		$this->db->set('ben_comments','ben_comments-1',FALSE);
		$this->db->where('ben_id',$id);
		$this->db->update('tbl_be_news');
	}

	function insert_views($id){
		$this->db->set('ben_views','ben_views+1',FALSE);
		$this->db->where('ben_id',$id);
		$this->db->update('tbl_be_news');
	}
	
	function clear_views($id){
	
		$this->db->set('ben_comments',0,FALSE);
		$this->db->where('ben_id',$id);
		$this->db->update('tbl_be_news');
	}
	
	function delete_record($aid){
	
		$this->db->where('ben_id',$aid);
		$this->db->delete('tbl_be_news');
		return $this->db->affected_rows();
	}

	function read_field($nid,$mraid,$field){
			
		$this->db->where('ben_id',$nid);
		$this->db->where('ben_mraid',$mraid);
		$query = $this->db->get('tbl_be_news',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function topic_exist($id,$environment,$department,$activity,$group){
		
		if(!$environment) $department = 0;
		$this->db->where('ben_id',$id);
		$this->db->where('ben_environment',$environment);
		$this->db->where('ben_department',$department);
		$this->db->where('ben_activity',$activity);
		$this->db->where('ben_group',$group);
		$query = $this->db->get('tbl_be_news',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>