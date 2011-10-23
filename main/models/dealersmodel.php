<?php
class Dealersmodel extends CI_Model{

	var $dlr_id				= 0;	/* идентификатор пользователя*/
	var $dlr_email 			= '';	/* логин пользователя*/
	var $dlr_password 		= '';	/* пароль пользователя*/
	var $dlr_name 			= '';	/* имя пользователя*/
	var $dlr_subname 		= '';	/* фамилия пользователя*/
	var $dlr_thname 		= '';	/* отчество пользователя*/
	var $dlr_photo 			= '';	/* фото пользователя*/
	var $dlr_icq 			= '';	/* ICQ пользователя*/
	var $dlr_phone 			= '';	/* телефон пользователя*/
	var $dlr_status 		= '';	/* статус пользователя (активирован /не активирован) */
	var $dlr_active 		= 0;	/* статус активности пользователя */
	var $dlr_destroy		= '';	/* дата запланированого удаления пользователя */
	var $dlr_confirmation	= '';	/* идентификатор подтверждения регистрации */
	var $dlr_signupdate 	= '';	/* дата регистрации пользователя*/
	var $dlr_lastlogindate 	= '';	/* дата последней авторизации пользователя*/
	var $dlr_cryptpassword 	= '';	/* зашифорованый пароль пользователя*/
	var $dlr_skype			= '';	/* Skype пользователя*/
	var $dlr_position		= '';	/* Должность пользователя*/
	var $dlr_company		= 0;	/* Количество компаний */
	
	function __construct(){
        
			parent::__construct();
    	}

	function insert_record($data){
			
		$this->dlr_email 			= $data['login'];
		$this->dlr_password 		= md5($data['password']);
		$this->dlr_name 			= $data['fname'];
		$this->dlr_subname 			= $data['sname'];
		$this->dlr_thname 			= $data['tname'];
		$this->dlr_photo 			= $data['photo'];
		$this->dlr_icq 				= $data['icq'];
		$this->dlr_phone 			= $data['phones'];
		$this->dlr_status 			= 'disabled';
		$this->dlr_active 			= FALSE;
		$this->dlr_destroy 			= '3000-01-01';
		$this->dlr_confirmation		= $data['confirm'];
		$this->dlr_signupdate 		= date("Y-m-d");
		$this->dlr_lastlogindate 	= '2000-01-01';
		$this->dlr_cryptpassword 	= $this->encrypt->encode($data['password']);
		$this->dlr_skype 			= $data['skype'];
		$this->dlr_position 		= $data['position'];
		
		$this->db->insert('tbl_dealers',$this);
		return $this->db->insert_id();
	}
	
	function read_record($id){
		
		$this->db->select('dlr_id,dlr_email,dlr_name,dlr_subname,dlr_thname,dlr_phone,dlr_confirmation,dlr_skype,dlr_icq,dlr_position,dlr_status,dlr_active,dlr_company');
		$this->db->where('dlr_id',$id);
		$this->db->where('dlr_destroy','3000-01-01');
		$query = $this->db->get('tbl_dealers');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function read_records(){
		
		$this->db->select('dlr_id,dlr_email,dlr_name,dlr_subname,dlr_thname,dlr_confirmation,dlr_skype,dlr_icq,dlr_position,dlr_status,dlr_active,dlr_signupdate,dlr_lastlogindate,dlr_company,dlr_destroy');
		$query = $this->db->get('tbl_dealers');
		$data = $query->result_array();
		if(count($data)) return $data;
		return FALSE;
	}
	
	function insert_company($id){
	
		$this->db->set('dlr_company','dlr_company+1',FALSE);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
	}
	
	function delete_company($id){
	
		$this->db->set('dlr_company','dlr_company-1',FALSE);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
	}
	
	function save_single_data($id,$field,$data){
		
		$this->db->where('dlr_id',$id);
		$this->db->where('dlr_status','enabled');
		$this->db->where('dlr_destroy','3000-01-01');
		$this->db->set($field,$data);
		$this->db->update('tbl_dealers');
		return $this->db->affected_rows();
	}
	
	function active_user($id){
		
		$this->db->set('dlr_lastlogindate',date("Y-m-d"));
		$this->db->set('dlr_active',TRUE);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
	}
	
	function deactive_user($id){
		
		$this->db->set('dlr_lastlogindate',date("Y-m-d"));
		$this->db->set('dlr_active',FALSE);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
	}
	
	function auth_user($login,$password){
		
		$this->db->where('dlr_email',$login);
		$this->db->where('dlr_password',md5($password));
		$this->db->where('dlr_destroy','3000-01-01');
		$query = $this->db->get('tbl_dealers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function auth_dealer($login,$password){
	
		$this->db->where('dlr_email',$login);
		$this->db->where('dlr_password',md5($password));
		$this->db->where('dlr_destroy','3000-01-01');
		$query = $this->db->get('tbl_dealers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_status($code){
			
		$this->db->set('dlr_status','enabled');
		$this->db->where('dlr_confirmation',$code);
		$this->db->where('dlr_status','disabled');
		$this->db->update('tbl_dealers');
		$res = $this->db->affected_rows();
		if($res == 0) return FALSE;
		return TRUE;
	}
	
	function update_password($password,$email){
			
		$this->db->set('dlr_password',md5($password));
		$this->db->set('dlr_cryptpassword',$this->encrypt->encode($password));
		$this->db->where('dlr_status','enabled');
		$this->db->where('dlr_email',$email);
		$this->db->update('tbl_dealers');
		$res = $this->db->affected_rows();
		if($res == 0) return FALSE;
		return TRUE;
	}
	
	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_dealers',1);
		$data = $query->result_array();
		if(count($data) > 0) return $data[0]['dlr_id'];
		return FALSE;
	}
	
	function user_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_dealers',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['dlr_id'];
		return FALSE;
	}
	
	function read_field($id,$field){
			
		$this->db->where('dlr_id',$id);
		$query = $this->db->get('tbl_dealers',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function close_user($id){
		
		$this->db->set('dlr_lastlogindate',date("Y-m-d"));
		$this->db->set('dlr_destroy','DATE_ADD(CURDATE(),INTERVAL 30 DAY)',FALSE);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
	}

	function get_image($id){
	
		$this->db->where('dlr_id',$id);
		$this->db->select('dlr_photo');
		$query = $this->db->get('tbl_dealers');
		$data = $query->result_array();
		return $data[0]['dlr_photo'];
	}

	function save_user($id,$data){
		
		$this->db->set('dlr_destroy',$data);
		$this->db->where('dlr_id',$id);
		$this->db->update('tbl_dealers');
		return $this->db->affected_rows();
	}

	function delete_record($id){
	
		$this->db->where('dlr_id',$id);
		$this->db->delete('tbl_dealers');
		return $this->db->affected_rows();
	}
}
?>