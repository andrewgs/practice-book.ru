<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Companymodel extends CI_Model {
	
	var $cmp_id 		= 0;	/* идентификатор компании*/
	var $cmp_name 		= "";	/* название компании*/
	var $cmp_region 	= 1;	/* город компании*/
	var $cmp_producer	= 0;	/* Компания - производитель*/
	var $cmp_urface 	= '';	
	var $cmp_logo 		= '';
	var $cmp_thumb 		= '';
	var $cmp_description = '';
	var $cmp_details 	= '';
	var $cmp_site 		= '';
	var $cmp_email 		= '';
	var $cmp_phone 		= '';
	var $cmp_telfax 	= '';
	var $cmp_uraddress 	= '';
	var $cmp_realaddress = '';
	var $cmp_destroy	= '';	/* дата запланированого удаления */
	var $cmp_date 		= '';	/* дата регистрации */
	var $cmp_rating 	= 0;
	
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_record($insertdata){
			
		$this->cmp_name 		= strip_tags($insertdata['title']);
		$this->cmp_region		= $insertdata['city__sexyComboHidden'];
		$this->cmp_producer		= $insertdata['maker'];
		$this->cmp_urface		= strip_tags($insertdata['ur_face']);
		$this->cmp_logo			= $insertdata['logo'];
		$this->cmp_thumb		= $insertdata['thumb'];
		$this->cmp_description	= strip_tags($insertdata['comment']);
		$this->cmp_details		= strip_tags($insertdata['recvizit']);
		$this->cmp_site			= strtolower($insertdata['site']);
		$this->cmp_email		= strtolower($insertdata['email']);
		$this->cmp_phone		= strip_tags($insertdata['tel']);
		$this->cmp_telfax		= strip_tags($insertdata['telfax']);
		$this->cmp_uraddress	= strip_tags($insertdata['uradres']);
		$this->cmp_realaddress	= strip_tags($insertdata['realadres']);
		$this->cmp_destroy		= '3000-01-01';
		$this->cmp_date 		= date("Y-m-d");
		$this->cmp_rating 		= 0;
		
		$this->db->insert('tbl_company',$this);
		return $this->db->insert_id();
	}
	
	function read_field($cmpid,$field){
			
		$this->db->where('cmp_id',$cmpid);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function read_record($id){
		
		$this->db->where('cmp_id',$id);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function company_exist($field,$parameter){
		
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cmp_id'];
		return FALSE;
	}

	function company_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['cmp_id'];
		return FALSE;
	}

	function get_image($id){
		
		$this->db->where('cmp_id',$id);
		$this->db->select('cmp_logo');
		$query = $this->db->get('tbl_company');
		$data = $query->result_array();
		return $data[0]['cmp_logo'];
	}

	function get_thumb($id){
		$this->db->where('cmp_id',$id);
		$this->db->select('cmp_thumb');
		$query = $this->db->get('tbl_company');
		$data = $query->result_array();
		return $data[0]['cmp_thumb'];
	}

	function save_single_data($cid,$field,$data){
		
		$this->db->where('cmp_id',$cid);
		$this->db->set($field,$data);
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
}
?>