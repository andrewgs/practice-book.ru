<?php
class Aspregionsmodel extends CI_Model {
	
	var $asr_id 		= 0;
	var $asr_astid 		= "";
	var $asr_regid		= "";
	
	function __construct(){
        
		parent::__construct();
    }
	
	function insert_record($astid,$astid){
	
		$this->asr_astid = $astid;
		$this->asr_regid = $astid;
		$this->db->insert('tbl_aspregions',$this);
		return $this->db->insert_id();
	}
	
	function group_insert($astid,$data){
		$query = '';
		for($i=0;$i<count($data);$i++):
			$query .= '('.$astid.','.$data[$i].') ';
			if($i+1<count($data)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_aspregions (asr_astid,asr_regid) VALUES ".$query);
	}
	
	function delete_records($asrid){
	
		$this->db->where('asr_astid',$asrid);
		$this->db->delete('tbl_aspregions');
		return $this->db->affected_rows();
	}
}
?>