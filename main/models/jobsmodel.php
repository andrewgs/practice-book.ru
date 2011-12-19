<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Jobsmodel extends CI_Model {
	
	var $job_id 		= 0;
	var $job_uid 		= 1;
	var $job_cname 		= 1;
	var $job_position 	= '';
	var $job_dbegin 	= '';
	var $job_dend 		= '';
	
	function __construct(){
	
		parent::__construct();
	}
	
	function insert_record($uid,$insertdata){
			
		$this->job_uid 		= $uid;
		$this->job_cname 	= htmlspecialchars($insertdata['jcname']);
		$this->job_position = htmlspecialchars($insertdata['jposition']);
		$this->job_dbegin 	= $insertdata['jdbegin']."-01-01";
		$this->job_dend 	= $insertdata['jdend']."-01-01";
		
		$this->db->insert('tbl_jobs',$this);
		return $this->db->insert_id();
	}

	function group_insert($uid,$insertdata){
		$query = '';
		for($i = 0;$i < count($insertdata);$i++):
			$query .= '('.$uid.',"'.htmlspecialchars($insertdata[$i]['jcname']).'","'.htmlspecialchars($insertdata[$i]['jposition']).'","'.$insertdata[$i]['jdbegin'].'","'.$insertdata[$i]['jdend'].'") ';
			if($i + 1 < count($insertdata)) $query.=',';
		endfor;
		$this->db->query("INSERT INTO tbl_jobs (job_uid,job_cname,job_position,job_dbegin,job_dend) VALUES ".$query);
	}
	
	function read_records($uid,$limit){
		
		$this->db->order_by('job_dbegin','DESC');
		$this->db->where('job_uid',$uid);
		if(!$limit): $query = $this->db->get('tbl_jobs');
		else: $query = $this->db->get('tbl_jobs',$limit);
		endif;
		return $query->result_array();

	}
	
	function read_records_year($uid,$limit){
		
		$this->db->select('job_id,job_cname,job_position,YEAR(job_dbegin) AS job_dbegin,YEAR(job_dend) AS job_dend');
		$this->db->where('job_uid',$uid);
		$this->db->order_by('job_dbegin','DESC');
		$this->db->order_by('job_dend','DESC');
		if($limit == 0):
			$query = $this->db->get('tbl_jobs');
		else:
			$query = $this->db->get('tbl_jobs',$limit);
		endif;
		return $query->result_array();
	}

	function delete_record($id){
	
		$this->db->where('job_id',$id);
		$this->db->delete('tbl_jobs');
	}

	function delete_records($uid){
	
		$this->db->where('job_uid',$uid);
		$this->db->delete('tbl_jobs');
		return $this->db->affected_rows();
	}
}
?>