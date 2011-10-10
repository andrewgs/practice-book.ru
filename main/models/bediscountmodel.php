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
	
	function insert_record($data,$activity,$environment,$department,$userid,$group){
		
		if(!$environment) $department = 0;
		$this->bed_title		= htmlspecialchars($data['title']);
		$this->bed_note			= strip_tags($data['description'],'<br>');
		$this->bed_photo		= $data['dimage'];
		$this->bed_date			= date("Y-m-d");
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
	
	function update_record($id,$data,$user){
		
		$this->db->set('bed_title',htmlspecialchars($data['title']));
		$this->db->set('bed_note',strip_tags($data['note'],'<br>'));
		if($data['photo']):
			$this->db->set('bed_photo',$data['photo']);
		endif;
		$this->db->where('bed_id',$id);
		$this->db->where('bed_userid',$user);
		$this->db->update('tbl_be_discount');
		return $this->db->affected_rows();
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
	
	function insert_comment($id){
		$this->db->set('bed_comments','bed_comments+1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function delete_comment($id){
	
		$this->db->set('bed_comments','bed_comments-1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}

	function insert_view($id){
		$this->db->set('bed_views','bed_views+1',FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function clear_view($id){
	
		$this->db->set('bed_comments',0,FALSE);
		$this->db->where('bed_id',$id);
		$this->db->update('tbl_be_discount');
	}
	
	function delete_record($id,$user){
	
		$this->db->where('bed_id',$id);
		$this->db->where('bed_userid',$user);
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

	function topic_owner($id,$environment,$department,$activity,$group,$userid){
		
		if(!$environment) $department = 0;
		$this->db->where('bed_id',$id);
		$this->db->where('bed_environment',$environment);
		$this->db->where('bed_department',$department);
		$this->db->where('bed_activity',$activity);
		$this->db->where('bed_group',$group);
		$this->db->where('bed_userid',$userid);
		$query = $this->db->get('tbl_be_discount',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>