<?php

class Activitymodel extends CI_Model{
	
	var $act_id 		= 0;
	var $act_title 		= "";
	var $act_parentid 	= 0;
	var $act_fulltitle 	= "";
	var $act_final		= 0;
	var $act_environment= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($ParentID){
		
		$this->db->where('act_parentid',$ParentID);
		$this->db->order_by('act_title');
		$query = $this->db->get('tbl_activity',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function insert_record($insertdata){
			
		$this->act_title 		= $insertdata['title'];
		$this->act_parentid		= $insertdata['parentid'];
		$this->act_fulltitle	= $insertdata['full'];
		$this->act_final 		= $insertdata['final'];	
		$this->act_environment	= $insertdata['environment'];	
		
		$this->db->insert('tbl_activity',$this);
		return $this->db->insert_id();
	}
	
	function read_records_by_pid($ParentID){
		
		$this->db->where('act_parentid',$ParentID);
		$this->db->order_by('act_title');
		$query = $this->db->get('tbl_activity');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function search_activity($search){
	
		$this->db->select('act_id AS id,act_title AS title');
		$this->db->like('act_title',$search);
		$this->db->where('act_final',1);
		$this->db->order_by('act_title');
		$query = $this->db->get('tbl_activity');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_activity($aid){
		
		$this->db->where('act_id',$aid);
		$this->db->order_by('act_parentid');
		$query = $this->db->get('tbl_activity');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_records(){
		
		$this->db->order_by('act_id');
		$query = $this->db->get('tbl_activity');
		return $query->result_array();
	}
	
	function read_activity_final(){
	
		$this->db->select('act_id,act_title');
		$this->db->order_by('act_title');
		$this->db->where('act_final',1);
		$query = $this->db->get('tbl_activity');
		return $query->result_array();
	}
	
	function read_records_order_by_pid(){
		
		$this->db->order_by('act_parentid ASC,act_id ASC');
		$query = $this->db->get('tbl_activity');
		return $query->result_array();
	}
	
	function read_field($aid,$field){
			
		$this->db->where('act_id',$aid);
		$query = $this->db->get('tbl_activity',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}

	function get_activity_path($id){
		
		$tmpid = $id; $i = 0;
		$path = array();
		while($tmpid != 0):
			$this->db->select('act_parentid AS pid,act_title AS title');
			$this->db->where('act_id',$tmpid);
			$query = $this->db->get('tbl_activity',1);
			$data = $query->result_array();
			if(isset($data[0])):
				$tmpid = $data[0]['pid'];
				$path[$i] = $data[0]['title'];
			endif;
			$i++;
		endwhile;
		$path = array_reverse($path);
		$strpath = '';
		for($i = 0; $i <count($path); $i++):
			if($i != count($path)-1):
				$strpath .= $path[$i].'&nbsp;&rarr;&nbsp;';
			else:
				$strpath .= $path[$i];
			endif;
		endfor;
		return $strpath;
	}

	function slevel_activity($id){
		
		$this->db->where('act_id',$id);
		$query = $this->db->get('tbl_activity',1);
		$data = $query->result_array();
		if($data[0]['act_parentid'] === 0):
			return FALSE;
		else:
			$pid = $data[0]['act_parentid'];
		endif;
	}
	
	function top_level_activity($id){
		$sql = "SELECT * FROM tbl_activity where act_parentid = (select act_parentid from tbl_activity where act_id = ?)"; 
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	function level_activity($pid){
	
		$this->db->order_by('act_title');
		$this->db->where('act_parentid',$pid);
		$query = $this->db->get('tbl_activity');
		return $query->result_array();
	}

	function save_activity($id,$title,$parent,$full,$final,$environment){
	
		$this->db->set('act_title',$title);
		$this->db->set('act_parentid',$parent);
		$this->db->set('act_fulltitle',$full);
		$this->db->set('act_final',$final);
		$this->db->set('act_environment',$environment);
		$this->db->where('act_id',$id);
		$this->db->update('tbl_activity');
		return $this->db->affected_rows();
	}

	function activity_exist($id){
			
		$this->db->where('act_id',$id);
		$this->db->where('act_final',1);
		$query = $this->db->get('tbl_activity',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}
}
?>