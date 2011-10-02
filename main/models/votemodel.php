<?php
class Votemodel extends CI_Model {
	
	var $vt_id 		= 0;
	var $vt_title 	= "";
	var $vt_stpid	= 0;
	var $vt_count	= 0;
	var $vt_percent	= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('vt_id',$id);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($stpid){
	
		$this->db->select('vt_id,vt_title,vt_count,vt_percent');
		$this->db->where('vt_stpid',$stpid);
		$query = $this->db->get('tbl_vote');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function group_insert($stpid,$data){
		$query = '';
		for($i=0;$i<count($data);$i++):
			$query .= '("'.htmlspecialchars($data[$i]['sname']).'",'.$stpid.',0,0)';
			if($i+1<count($data)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_vote (vt_title,vt_stpid,vt_count,vt_percent) VALUES ".$query);
	}
	
	function save_vote($id,$stpid,$data){
	
		$this->db->set('vt_title',htmlspecialchars($data));
		$this->db->where('vt_id',$id);
		$this->db->where('vt_stpid',$stpid);
		$this->db->update('tbl_vote');
		return $this->db->affected_rows();
	}
	
	function insert_records($data,$sur,$usr){
	
		$this->vt_title = $data['title'];
		$this->vt_note = $data['note'];
		$this->vt_date = date("Y-m-d");
		$this->vt_surid = $sur;
		$this->vt_usrid = $usr;
		$this->vt_comments = 0;
		$this->db->insert('tbl_vote',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){
	
		$this->db->set('vt_title',$data['title']);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
		return $this->db->affected_rows();
	}
	
	function delete_records($stp){
	
		$this->db->where('vt_stpid',$stp);
		$this->db->delete('tbl_vote');
		return $this->db->affected_rows();
	}
	
	function count_records($sur){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('vt_surid',$sur);
		$query = $this->db->get('tbl_vote');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_field($topic,$field){
			
		$this->db->where('vt_id',$topic);
		$query = $this->db->get('tbl_vote',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}

	function insert_click($id){
		$this->db->set('vt_count','vt_count+1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	
	function delete_click($id){
	
		$this->db->set('vt_count','vt_count-1',FALSE);
		$this->db->where('vt_id',$id);
		$this->db->update('tbl_vote');
	}
	
	function update_percents($stpid,$percent){
		
		$this->db->set('vt_percent',"ROUND((vt_count/$percent)*100)",FALSE);
		$this->db->where('vt_stpid',$stpid);
		$this->db->update('tbl_vote');
		return $this->db->affected_rows();
	}
}
?>