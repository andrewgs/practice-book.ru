<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Seasonalpricesmodel extends CI_Model {
	
	var $snp_id	 	= 0;
	var $snp_mraid 	= 0;
	var $snp_title 	= "";
	var $snp_percent= "";
	
	function __construct(){

		parent::__construct();
	}
	
	function record_exist($mraid){
		
		$this->db->where('snp_mraid',$mraid);
		$query = $this->db->get('tbl_seasonal_prices');
		$data = $query->result_array();
		if(isset($data[0])) return TRUE;
		return FALSE;
	}
	
	function read_record($mraid){
		$this->db->where('snp_mraid',$mraid);
		$query = $this->db->get('tbl_seasonal_prices');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_percentmax($mraid){
		$this->db->select_max('snp_percent','max');
		$this->db->where('snp_mraid',$mraid);
		$query = $this->db->get('tbl_seasonal_prices',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['max'];
		return NULL;
	}
	
	function read_record_byid($pid){
		$this->db->where('snp_id',$pid);
		$query = $this->db->get('tbl_seasonal_prices',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($mraid,$data){
		
		$this->snp_mraid	= $mraid;
		$this->snp_title	= htmlspecialchars($data['title']);
		$this->snp_percent	= htmlspecialchars($data['percent']);
		$this->db->insert('tbl_seasonal_prices',$this);
		return $this->db->insert_id();
	}
	
	function group_insert($mraid,$data){
		$query = '';
		for($i=0;$i<count($data);$i++):
			$month = $i+1;
			$query .= '('.$mraid.',"'.htmlspecialchars($data[$i]['title']).'","'.htmlspecialchars($data[$i]['percent']).'",'.$month.') ';
			if($i+1<count($data)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_seasonal_prices (snp_mraid,snp_title,snp_percent,snp_month) VALUES ".$query);
	}
	
	function update_record($id,$data){
		
		$this->db->set('snp_title',htmlspecialchars($data['title']));
		$this->db->set('snp_title',htmlspecialchars($data['percent']));
		$this->db->where('snp_id',$id);
		$this->db->update('tbl_seasonal_prices');
	}
	
	function insert_empty($mraid){
		
		$query = '';
		for($i=0;$i<12;$i++):
			$month = $i+1;
			$query .= '('.$mraid.',"","",'.$month.')';
			if($i+1<12) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_seasonal_prices (snp_mraid,snp_title,snp_percent,snp_month) VALUES ".$query);
	}

	function delete_record($mraid){
		$this->db->where('snp_mraid',$mraid);
		$this->db->delete('tbl_seasonal_prices');
	}
}