<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Documentsmodel extends CI_Model {
	
	var $doc_id	 	= 0;
	var $doc_mraid 	= 0;
	var $doc_title 	= "";
	var $doc_note 	= "";
	var $doc_image 	= "";
	var $doc_date 	= "";
	var $doc_link 	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('doc_mraid',$mraid);
		$query = $this->db->get('tbl_documents');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['doc_id'];
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('doc_mraid',$mraid);
		$query = $this->db->get('tbl_documents',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_records($mraid){
		
		$this->db->where('doc_mraid',$mraid);
		$query = $this->db->get('tbl_documents');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_record_byid($pid){
		$this->db->where('doc_id',$pid);
		$query = $this->db->get('tbl_documents',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($mraid,$insertdata){
		
		$this->doc_mraid	= $mraid;
		$this->doc_title	= htmlspecialchars($insertdata['title']);
		$this->doc_note		= strip_tags($insertdata['note']);
		$this->doc_image	= $insertdata['image'];
		$this->doc_date		= date("Y-m-d");
		$this->doc_link		= $insertdata['link'];
		
		$this->db->insert('tbl_documents',$this);
	}

	function update_record($mraid,$updatedata){
		
		$this->db->set('doc_title',htmlspecialchars($updatedata['title']));
		$this->db->set('doc_note',strip_tags($updatedata['note'],'<br>'));
		$this->db->set('doc_date',date("Y-m-d"));
		$this->db->where('doc_mraid',$mraid);
		$this->db->update('tbl_documents');
	}

	function insert_empty($mraid){
		
		$this->doc_mraid = $mraid;
		$this->doc_date	 = date("Y-m-d");
		$this->doc_image = file_get_contents(base_url().'images/no_photo.jpg');
		
		$this->db->insert('tbl_documents',$this);
		return $this->db->insert_id();
	}

	function get_image($pid){
	
		$this->db->where('doc_id',$pid);
		$this->db->select('doc_image');
		$query = $this->db->get('tbl_documents');
		$data = $query->result_array();
		return $data[0]['doc_image'];
	}

	function delete_record($pfid){
		$this->db->where('doc_id',$pfid);
		$this->db->delete('tbl_documents');
		return $this->db->affected_rows();
	}

	function save_document($id,$title,$note){
	
		$this->db->where('doc_id',$id);
		$this->db->set('doc_title',htmlspecialchars($title));
		$this->db->set('doc_note',strip_tags($note,'<br>'));
		$this->db->set('doc_date',date("Y-m-d"));
		$this->db->update('tbl_documents');
		return $this->db->affected_rows();
	}

	function read_field($id,$field){
	
		$this->db->where('doc_id',$id);
		$query = $this->db->get('tbl_documents',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
}