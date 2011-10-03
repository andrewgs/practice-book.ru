<?php
class Asptopicsmodel extends CI_Model {
	
	var $ast_id 		= 0;
	var $ast_title 		= "";
	var $ast_photo		= "";
	var $ast_date 		= "";
	var $ast_note 		= "";
	var $ast_price 		= "";
	var $ast_collected	= "";
	var $ast_must1		= "";
	var $ast_must2		= "";
	var $ast_must3		= "";
	var $ast_aspid		= 0;
	var $ast_usrid		= 0;
	var $ast_comments	= 0;
	var $ast_apply		= 0;
	
	function __construct(){
        
		parent::__construct();
    }
	
	function read_record($id){
		
		$this->db->where('ast_id',$id);
		$query = $this->db->get('tbl_asptopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($aspid){
	
		$this->db->select('ast_id,ast_title,ast_note,ast_date,ast_usrid,ast_comments,ast_price,ast_collected,ast_must1,ast_must2,ast_must3');
		$this->db->where('ast_aspid',$aspid);
		$this->db->order_by('ast_date DESC');
		return $this->db->get('tbl_asptopics');
	}
	
	function insert_record($data,$asp,$user){
	
		$this->ast_title = htmlspecialchars($data['title']);
		$this->ast_photo = $data['photo'];
		$this->ast_date = date("Y-m-d");
		$this->ast_note = strip_tags($data['note'],'<br>');
		$this->ast_price = htmlspecialchars($data['price']);
		$this->ast_collected = 0;
		$this->ast_must1 = htmlspecialchars($data['must1']);
		$this->ast_must2 = htmlspecialchars($data['must2']);
		$this->ast_must3 = htmlspecialchars($data['must3']);
		$this->ast_aspid = $asp;
		$this->ast_usrid = $user;
		$this->ast_comments = 0;
		$this->ast_apply = 0;
		$this->db->insert('tbl_asptopics',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data,$user){
	
		$this->db->set('ast_title',htmlspecialchars($data['title']));
		$this->db->set('ast_note',strip_tags($data['note'],'<br>'));
		$this->db->set('ast_price',htmlspecialchars($data['price']));
		$this->db->set('ast_must1',htmlspecialchars($data['must1']));
		$this->db->set('ast_must2',htmlspecialchars($data['must2']));
		$this->db->set('ast_must3',htmlspecialchars($data['must3']));
		if($data['photo']):
			$this->db->set('ast_photo',$data['photo']);
		endif;
		$this->db->where('ast_id',$id);
		$this->db->where('ast_usrid',$user);
		$this->db->where('ast_collected',0);
		$this->db->update('tbl_asptopics');
		return $this->db->affected_rows();
	}
	
	function delete_record($id,$userid){
	
		$this->db->where('ast_id',$id);
		$this->db->where('ast_usrid',$userid);
		$this->db->where('ast_collected',0);
		$this->db->delete('tbl_asptopics');
		return $this->db->affected_rows();
	}
	
	function insert_comment($id){
		$this->db->set('ast_comments','ast_comments+1',FALSE);
		$this->db->where('ast_id',$id);
		$this->db->update('tbl_asptopics');
	}
	
	function delete_comment($id){
	
		$this->db->set('ast_comments','ast_comments-1',FALSE);
		$this->db->where('ast_id',$id);
		$this->db->update('tbl_asptopics');
	}
	
	function insert_collected($id,$count){
	
		$this->db->set('ast_collected','ast_collected+1',FALSE);
		$this->db->set('ast_apply','ast_apply+'.$count,FALSE);
		$this->db->where('ast_id',$id);
		$this->db->update('tbl_asptopics');
	}
	
	function delete_collected($id,$count){
	
		$this->db->set('ast_collected','ast_collected-1',FALSE);
		$this->db->set('ast_apply','ast_apply-'.$count,FALSE);
		$this->db->where('ast_id',$id);
		$this->db->update('tbl_asptopics');
	}

	function count_records($asp){
	
		$this->db->select('count(*) as cnt');
		$this->db->where('ast_aspid',$asp);
		$query = $this->db->get('tbl_asptopics');
		$data = $query->result_array();
		return $data[0]['cnt'];
	}
	
	function read_limit_records($count,$from,$dsc){
		
		$this->db->where('ast_surid',$dsc);
		$this->db->limit($count,$from);
		$this->db->order_by('ast_id DESC');
		$query = $this->db->get('tbl_asptopics');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}

	function topic_owner($id,$section,$usr){
		
		$this->db->where('ast_id',$id);
		$this->db->where('ast_aspid',$section);
		$this->db->where('ast_usrid',$usr);
		$query = $this->db->get('tbl_asptopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function topic_exist($id,$section){
		
		$this->db->where('ast_id',$id);
		$this->db->where('ast_aspid',$section);
		$query = $this->db->get('tbl_asptopics',1);
		$data = $query->result_array();
		if(count($data)) return TRUE;
		return FALSE;
	}

	function read_field($topic,$field){
			
		$this->db->where('ast_id',$topic);
		$query = $this->db->get('tbl_asptopics',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return NULL;
	}
	
	function get_image($id){
	
		$this->db->where('ast_id',$id);
		$this->db->select('ast_photo');
		$query = $this->db->get('tbl_asptopics');
		$data = $query->result_array();
		return $data[0]['ast_photo'];
	}
}
?>