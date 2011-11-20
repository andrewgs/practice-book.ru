<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pricingmodel extends CI_Model {
	
	var $prn_id	 	= 0;
	var $prn_mraid 	= 0;
	var $prn_title 	= "";
	var $prn_percent= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('prn_mraid',$mraid);
		$query = $this->db->get('tbl_pricing');
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('prn_mraid',$mraid);
		$query = $this->db->get('tbl_pricing');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_record_byid($pid){
		$this->db->where('prn_id',$pid);
		$query = $this->db->get('tbl_pricing',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($mraid,$data){
		
		$this->prn_mraid	= $mraid;
		$this->prn_title	= htmlspecialchars($data['title']);
		$this->prn_percent	= htmlspecialchars($data['percent']);
		$this->db->insert('tbl_pricing',$this);
		return $this->db->insert_id();
	}
	
	function group_insert($mraid,$data){
		$query = '';
		for($i=0;$i<count($data);$i++):
			$query .= '('.$mraid.',"'.htmlspecialchars($data[$i]['title']).'","'.htmlspecialchars($data[$i]['percent']).'") ';
			if($i+1<count($data)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_pricing (prn_mraid,prn_title,prn_percent) VALUES ".$query);
	}
	
	function update_record($id,$data){
		
		$this->db->set('prn_title',htmlspecialchars($data['title']));
		$this->db->set('prn_title',htmlspecialchars($data['percent']));
		$this->db->where('prn_id',$id);
		$this->db->update('tbl_pricing');
	}
	
	function insert_empty($mraid){
		
		$this->prn_mraid	= $mraid;
		$this->prn_title	= "";
		$this->prn_percent	= "100";
		$this->db->insert('tbl_pricing',$this);
	}

	function delete_record($mraid){
		$this->db->where('prn_mraid',$mraid);
		$this->db->delete('tbl_pricing');
	}
}