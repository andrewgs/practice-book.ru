<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Doclistmodel extends CI_Model {
	
	var $dls_id	 	= 0;
	var $dls_title 	= "";
	var $dls_note 	= "";
	var $dls_image 	= "";
	var $dls_date 	= "";
	var $dls_link 	= "";
	var $dls_dtnid	= 0;
	var $dls_usrid	= 0;
	var $dls_comments	= 0;
	
	function __construct(){

		parent::__construct();
	}
	
	function read_records($dtnid){
	
		$this->db->select('dls_id,dls_title,dls_note,dls_date,dls_usrid,dls_date,dls_link,dls_comments');
		$this->db->where('dtt_dtnid',$dtnid);
		$this->db->order_by('dtt_date DESC');
		return $this->db->get('tbl_doclist');
	}

	function read_record($id){
	
		$this->db->select('dls_id,dls_title,dls_note,dls_date,dls_usrid,dls_date,dls_link,dls_comments');
		$this->db->where('dls_id',$id);
		$query = $this->db->get('tbl_doclist',1);
		$data = $query->result_array();
		if(count($data)) return $data[0];
		return NULL;
	}
	
	function insert_record($data,$dtn,$usr){
		
		$this->dls_title = $data['title'];
		$this->dls_note	 = strip_tags($data['note']);
		$this->dls_link	= $data['link'];
		$this->dls_image = $data['image'];
		$this->dls_date = date("Y-m-d");
		$this->dls_dtnid = $dtn;
		$this->dls_usrid = $usr;
		$this->dls_comments = 0;
		$this->db->insert('tbl_doclist',$this);
		return $this->db->insert_id();
	}

	function update_record($id,$data,$dtn,$user){
		
		$this->db->set('dls_title',htmlspecialchars($data['title']));
		$this->db->set('dls_note',strip_tags($data['note'],'<br>'));
		if($data['link']):
			$this->db->set('dls_link',$data['link']);
			$this->db->set('dls_image',$data['image']);
		endif;
		$this->db->where('dls_id',$id);
		$this->db->where('dls_dtnid',$dtn);
		$this->db->where('dls_usrid',$user);
		$this->db->update('tbl_doclist');
		return $this->db->affected_rows();
	}

	function get_image($id){
	
		$this->db->where('dls_id',$id);
		$this->db->select('dls_image');
		$query = $this->db->get('tbl_doclist');
		$data = $query->result_array();
		return $data[0]['dls_image'];
	}

	function delete_record($id,$userid){
		$this->db->where('dls_id',$id);
		$this->db->where('dls_usrid',$userid);
		$this->db->delete('tbl_doclist');
		return $this->db->affected_rows();
	}
	
	function count_records($dls){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('dls_id',$dls);
		$query = $this->db->get('tbl_doclist');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function delete_comment($id){
	
		$this->db->set('dls_comments','dls_comments-1',FALSE);
		$this->db->where('dls_id',$id);
		$this->db->update('tbl_doclist');
	}
	
	function insert_comment($id){
		$this->db->set('dls_comments','dls_comments+1',FALSE);
		$this->db->where('dls_id',$id);
		$this->db->update('tbl_doclist');
	}
	
	function read_field($id,$field){
	
		$this->db->where('dls_id',$id);
		$query = $this->db->get('tbl_doclist',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function document_owner($id,$dtn,$user){
		
		$this->db->where('dls_id',$id);
		$this->db->where('dls_dtnid',$dtn);
		$this->db->where('dls_usrid',$user);
		$query = $this->db->get('tbl_doclist',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
	
	function doc_exist($id,$dtn){
	
		$this->db->where('dls_id',$id);
		$this->db->where('dls_dtnid',$dtn);
		$query = $this->db->get('tbl_doclist',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}