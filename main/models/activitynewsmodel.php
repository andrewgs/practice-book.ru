<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Activitynewsmodel extends CI_Model {
	
	var $an_id 			= 0;
	var $an_mraid		= 0;
	var $an_title		= "";
	var $an_note 		= "";
	var $an_image 		= "";
	var $an_date	 	= "";
	var $an_source		= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($mraid,$insertdata){
			
		$this->an_mraid		= $mraid;
		$this->an_title		= htmlspecialchars($insertdata['title']);
		$this->an_note		= strip_tags($insertdata['note'],'<br>');
		$this->an_image		= $insertdata['image'];
		$this->an_date		= $insertdata['date'];
		$this->an_source	= htmlspecialchars($insertdata['source']);
		
		$this->db->insert('tbl_activity_news',$this);
		return $this->db->insert_id();
	}
	
	function read_record($nid,$mraid){
		
		$this->db->where('an_id',$nid);
		$this->db->where('an_mraid',$mraid);
		$query = $this->db->get('tbl_activity_news',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($mraid){
		
		$this->db->select('an_id,an_mraid,an_title,an_note,an_date,an_source');
		$this->db->where('an_mraid',$mraid);
		$this->db->order_by('an_date','DESC');
		$query = $this->db->get('tbl_activity_news');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_limit_records($mraid,$limit){
	
		$this->db->select('an_id,an_mraid,an_title,an_note,an_date,an_source');
		$this->db->where('an_mraid',$mraid);
		$this->db->where('an_date <=',date("Y-m-d"));
		$this->db->order_by('an_id desc, an_date desc');
		$query = $this->db->get('tbl_activity_news',$limit);
		$data = $query->result_array();
		if(isset($data)) return $data;
		return NULL;
	}
	
	function get_image($id){
		
		$this->db->where('an_id',$id);
		$this->db->select('an_image');
		$query = $this->db->get('tbl_activity_news');
		$data = $query->result_array();
		return $data[0]['an_image'];
	}

	function save_single_data($nid,$mraid,$field,$data){
		
		$this->db->where('an_id',$nid);
		$this->db->where('an_cmpid',$mraid);
		$this->db->set($field,$data);
		$this->db->update('tbl_activity_news');
		return $this->db->affected_rows();
	}

	function save_news($nid,$title,$note){
	
		$this->db->where('an_id',$nid);
		$this->db->set('an_title',$title);
		$this->db->set('an_note',$note);
		$this->db->update('tbl_activity_news');
		return $this->db->affected_rows();
	}
	
	function delete_record($aid){
	
		$this->db->where('an_id',$aid);
		$this->db->delete('tbl_activity_news');
		return $this->db->affected_rows();
	}

	function read_field($nid,$mraid,$field){
			
		$this->db->where('an_id',$nid);
		$this->db->where('an_mraid',$mraid);
		$query = $this->db->get('tbl_activity_news',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
}
?>