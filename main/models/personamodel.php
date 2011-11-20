<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Personamodel extends CI_Model {
	
	var $prs_id	 	= 0;
	var $prs_mraid 	= 0;
	var $prs_aid	= 0;
	var $prs_title 	= "";
	var $prs_note 	= "";
	var $prs_image 	= "";
	var $prs_date 	= "";
	var $prs_source	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('prs_mraid',$mraid);
		$query = $this->db->get('tbl_persona');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['prs_id'];
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('prs_mraid',$mraid);
		$query = $this->db->get('tbl_persona',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_record_byid($pid){
		$this->db->where('prs_id',$pid);
		$query = $this->db->get('tbl_persona',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($mraid,$activity,$insertdata){
		
		$this->prs_mraid	= $mraid;
		$this->prs_aid		= $activity;
		$this->prs_title	= htmlspecialchars($insertdata['title']);
//		$this->prs_note		= strip_tags($insertdata['note']);
		$this->prs_note		= $insertdata['note'];
		$this->prs_image	= $insertdata['image'];
		$this->prs_date		= date("Y-m-d");
		$this->prs_source 	= htmlspecialchars($insertdata['source']);
		$this->db->insert('tbl_persona',$this);
		return $this->db->insert_id();
	}

	function update_record($mraid,$activity,$updatedata){
		
		$this->db->set('prs_title',htmlspecialchars($updatedata['title']));
//		$this->db->set('prs_note',strip_tags($updatedata['note'],'<br>'));
		$this->db->set('prs_note',$updatedata['note']);
		if($updatedata['image']):
			$this->db->set('prs_image',$updatedata['image']);
		endif;
		$this->db->set('prs_date',date("Y-m-d"));
		$this->db->set('prs_aid',$activity);
		$this->db->set('prs_source',htmlspecialchars($updatedata['source']));
		$this->db->where('prs_mraid',$mraid);
		$this->db->update('tbl_persona');
	}

	function insert_empty($mraid,$activity){
		
		$this->prs_mraid	= $mraid;
		$this->prs_aid		= $activity;
		$this->prs_date		= date("Y-m-d");
		$this->prs_image	= file_get_contents(base_url().'images/no_photo.jpg');
		
		$this->db->insert('tbl_persona',$this);
		return $this->db->insert_id();
	}

	function get_image($pid){
	
		$this->db->where('prs_id',$pid);
		$this->db->select('prs_image');
		$query = $this->db->get('tbl_persona');
		$data = $query->result_array();
		return $data[0]['prs_image'];
	}

	function save_persons($activity,$updatedata){
	
		$this->db->set('prs_title',htmlspecialchars($updatedata['title']));
//		$this->db->set('prs_note',strip_tags($updatedata['note'],'<br>'));
		$this->db->set('prs_note',$updatedata['note']);
		$this->db->set('prs_image',$updatedata['image']);
		$this->db->set('prs_date',date("Y-m-d"));
		$this->db->set('prs_source',htmlspecialchars($updatedata['source']));
		$this->db->where('prs_aid',$activity);
		$this->db->update('tbl_persona');
	}
}