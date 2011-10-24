<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Companymodel extends CI_Model{
	
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
	var $cmp_destroy	= '3000-01-01';	/* дата запланированого удаления */
	var $cmp_date 		= '';	/* дата регистрации */
	var $cmp_rating 	= 0;
	var $cmp_offers 	= 0;
	var $cmp_confirmation 	= '';
	var $cmp_dealer 	= 0;
	var $cmp_status 	= 0;
	
	
	function __construct(){

		parent::__construct();
	}
	
	function insert_empty($dealer,$data){
			
		$this->cmp_region		= 0;
		$this->cmp_date 		= date("Y-m-d");
		$this->cmp_confirmation	= $data['confirm'];
		$this->cmp_dealer		= $dealer;
		
		$this->db->insert('tbl_company',$this);
		return $this->db->insert_id();
	}
	
	function insert_record($data){
			
		$this->cmp_name 		= strip_tags($data['title']);
		$this->cmp_region		= $data['region'];
		$this->cmp_producer		= $data['maker'];
		$this->cmp_urface		= strip_tags($data['ur_face']);
		$this->cmp_logo			= $data['logo'];
		$this->cmp_thumb		= $data['thumb'];
		$this->cmp_description	= strip_tags($data['comment']);
		$this->cmp_details		= strip_tags($data['recvizit']);
		$this->cmp_site			= strtolower($data['site']);
		$this->cmp_email		= strtolower($data['email']);
		$this->cmp_phone		= strip_tags($data['tel']);
		$this->cmp_telfax		= strip_tags($data['telfax']);
		$this->cmp_uraddress	= strip_tags($data['uradres']);
		$this->cmp_realaddress	= strip_tags($data['realadres']);
		$this->cmp_destroy		= '3000-01-01';
		$this->cmp_date 		= date("Y-m-d");
		$this->cmp_rating 		= 0;
		
		$this->db->insert('tbl_company',$this);
		return $this->db->insert_id();
	}
	
	function update_record($cid,$data){
			
		$this->db->set('cmp_name',strip_tags($data['title']));
		$this->db->set('cmp_region',$data['region']);
		$this->db->set('cmp_producer',$data['maker']);
		$this->db->set('cmp_urface',strip_tags($data['ur_face']));
		$this->db->set('cmp_logo',$data['logo']);
		$this->db->set('cmp_thumb',$data['thumb']);
		$this->db->set('cmp_description',strip_tags($data['comment']));
		$this->db->set('cmp_details',strip_tags($data['recvizit']));
		$this->db->set('cmp_site',strtolower($data['site']));
		$this->db->set('cmp_email',strtolower($data['email']));
		$this->db->set('cmp_phone',strip_tags($data['tel']));
		$this->db->set('cmp_telfax',strip_tags($data['telfax']));
		$this->db->set('cmp_uraddress',strip_tags($data['uradres']));
		$this->db->set('cmp_realaddress',strip_tags($data['realadres']));
		$this->db->set('cmp_destroy','3000-01-01');
		$this->db->set('cmp_date',date("Y-m-d"));
		$this->db->set('cmp_rating',0);
		$this->db->where('cmp_id',$cid);
		
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
	
	function read_field($cmpid,$field){
			
		$this->db->where('cmp_id',$cmpid);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function read_record($id){
		
		$this->db->select('cmp_id,cmp_name,cmp_region,cmp_producer,cmp_urface,cmp_description,cmp_details,cmp_site,cmp_email,cmp_phone,cmp_telfax,cmp_uraddress,cmp_realaddress,cmp_date,cmp_rating,cmp_offers,cmp_confirmation,cmp_dealer,cmp_status');
		$this->db->where('cmp_id',$id);
		$this->db->where('cmp_destroy',"3000-01-01");
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function company_exist($field,$parameter){
		
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['cmp_id'];
		return FALSE;
	}
	
	function company_exist_byid($id){
		
		$this->db->where('cmp_id',$id);
		$query = $this->db->get('tbl_company',1);
		$data = $query->result_array();
		if($data) return TRUE;
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

	function read_records(){
	
		$sql = "SELECT cmp_id,cmp_name,cmp_email,cmp_phone,cmp_date,cmp_rating,cmp_offers,cmp_status,cmp_destroy FROM tbl_company ORDER BY cmp_date DESC,cmp_rating DESC,cmp_name";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function close_company($id){
	
		$this->db->where('cmp_id',$id);
		$this->db->set('cmp_destroy',date("Y-m-d"));
		$this->db->set('cmp_status',0);
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
	
	function delete_record($id){
	
		$this->db->where('cmp_id',$id);
		$this->db->delete('tbl_company');
		return $this->db->affected_rows();
	}
	
	function open_company($id){
	
		$this->db->where('cmp_id',$id);
		$this->db->set('cmp_destroy',"3000-01-01");
		$this->db->set('cmp_status',0);
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
	
	function save_rating_offers($cid,$rating,$offers,$status){
		
		$this->db->set('cmp_rating',$rating);
		$this->db->set('cmp_offers',$offers);
		$this->db->set('cmp_status',$status);
		$this->db->where('cmp_id',$cid);
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
	
	function dealer_company($dlrid){
		
		$query = "SELECT cmp_id,cmp_name,cmp_email,cmp_phone,cmp_rating,cmp_date FROM tbl_company WHERE cmp_dealer = $dlrid ORDER BY cmp_date DESC, cmp_rating DESC,cmp_name";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function dealers_zero($dlrid){
		
		$this->db->set('cmp_dealer',0);
		$this->db->where('cmp_dealer',$dlrid);
		$this->db->update('tbl_company');
		return $this->db->affected_rows();
	}
}
?>