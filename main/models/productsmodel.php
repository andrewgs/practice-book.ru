<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Productsmodel extends CI_Model {
	
	var $pr_id	 	= 0;
	var $pr_mraid 	= 0;
	var $pr_title 	= "";
	var $pr_note 	= "";
	var $pr_image 	= "";
	var $pr_date 	= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('pr_mraid',$mraid);
		$query = $this->db->get('tbl_products');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['pr_id'];
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('pr_mraid',$mraid);
		$query = $this->db->get('tbl_products',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_record_byid($pid){
		$this->db->where('pr_id',$pid);
		$query = $this->db->get('tbl_products',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($mraid,$insertdata){
		
		$this->pr_mraid	= $mraid;
		$this->pr_title	= strip_tags($insertdata['title']);
		$this->pr_note	= strip_tags($insertdata['note']);
		$this->pr_image	= $insertdata['image'];
		$this->pr_date	= date("Y-m-d");
		
		$this->db->insert('tbl_products',$this);
	}

	function update_record($mraid,$updatedata){
		
		$this->db->set('pr_title',htmlspecialchars($updatedata['title']));
		$this->db->set('pr_note',strip_tags($updatedata['note'],'<br>'));
		if($updatedata['image']):
			$this->db->set('pr_image',$updatedata['image']);
		endif;
		$this->db->set('pr_date',date("Y-m-d"));
		$this->db->where('pr_mraid',$mraid);
		$this->db->update('tbl_products');
	}

	function insert_empty($mraid){
		
		$this->pr_mraid	= $mraid;
		$this->pr_date	= date("Y-m-d");
		$this->pr_image	= file_get_contents(base_url().'images/no_photo.jpg');
		
		
		$this->db->insert('tbl_products',$this);
		return $this->db->insert_id();
	}

	function get_image($pid){
	
		$this->db->where('pr_id',$pid);
		$this->db->select('pr_image');
		$query = $this->db->get('tbl_products');
		$data = $query->result_array();
		return $data[0]['pr_image'];
	}

	function product_empty($mraid){
	
		$this->db->select('TRIM(pr_title) AS title');
		$this->db->where('pr_mraid',$mraid);
		$query = $this->db->get('tbl_products',1);
		$data = $query->result_array();
		if($data[0]['title']) return TRUE;
		return FALSE;
	}
}