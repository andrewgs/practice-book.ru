<?php
class Usersmodel extends CI_Model{

	var $uid 			= 0;	/* идентификатор пользователя*/
	var $ucompany		= 1;	/* идентификатор компании*/
	var $udepartment	= 0;	/* идентификатор отдела*/
	var $uemail 		= '';	/* логин пользователя*/
	var $upassword 		= '';	/* пароль пользователя*/
	var $uname 			= '';	/* имя пользователя*/
	var $usubname 		= '';	/* фамилия пользователя*/
	var $uthname 		= '';	/* отчество пользователя*/
	var $uphoto 		= '';	/* фото пользователя*/
	var $uicq 			= '';	/* ICQ пользователя*/
	var $uphone 		= '';	/* телефон пользователя*/
	var $ustatus 		= '';	/* статус пользователя (активирован /не активирован) */
	var $uactive 		= '';	/* статус активности пользователя */
	var $udestroy		= '';	/* дата запланированого удаления пользователя */
	var $uconfirmation	= '';	/* идентификатор подтверждения регистрации */
	var $usignupdate 	= '';	/* дата регистрации пользователя*/
	var $ulastlogindate = '';	/* дата последней авторизации пользователя*/
	var $ucryptpassword = '';	/* зашифорованый пароль пользователя*/
	var $ubirthday		= '';	/* День рождения пользователя*/
	var $uskype			= '';	/* Skype пользователя*/
	var $uposition		= '';	/* Должность пользователя*/
	var $upriority		= 1;	/* Приоритет пользователя*/
	var $umanager		= 1;	/* Статус пользователя*/
	var $uactivity		= 1;	/* Отрасль пользователя*/
	var $uachievement	= "";	/* Достижения пользователя*/
	var $ucloseconsult	= 0;	/* Закрыто консультирование*/
	var $urating		= 0;	/* Авторитет*/
	
	function __construct(){
        
			parent::__construct();
    	}

	function insert_record($insertdata){
			
		$this->ucompany 		= $insertdata['cmpid'];
		$this->udepartment		= $insertdata['department'];
		$this->uemail 			= $insertdata['login'];
		$this->upassword 		= md5($insertdata['password']);
		$this->uname 			= $insertdata['fname'];
		$this->usubname 		= $insertdata['sname'];
		$this->uthname 			= $insertdata['tname'];
		$this->uphoto 			= $insertdata['photo'];
		$this->uicq 			= $insertdata['icq'];
		$this->uphone 			= $insertdata['phones'];
		$this->ustatus 			= 'disabled';
		$this->uactive 			= FALSE;
		$this->udestroy 		= '3000-01-01';
		$this->uconfirmation	= $insertdata['confirm'];
		$this->usignupdate 		= date("Y-m-d");
		$this->ulastlogindate 	= '2000-01-01';
		$this->ucryptpassword 	= $this->encrypt->encode($insertdata['password']);
		$this->ubirthday 		= $insertdata['birthday'];
		$this->uskype 			= $insertdata['skype'];
		$this->uposition 		= $insertdata['position'];
		$this->umanager 		= $insertdata['manager'];
		$this->upriority 		= $insertdata['priority'];
		$this->uactivity 		= $insertdata['activity'];
		$this->uachievement 	= "";
		$this->ucloseconsult 	= 0;
		$this->urating 			= 0;
		
		$this->db->insert('tbl_user',$this);
		return $this->db->insert_id();
	}
	
	function get_position($activity){
	
		$this->db->select_max('upriority');
		$this->db->where('uactivity',$activity);
		$query = $this->db->get('tbl_user');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['upriority'];
		return 0;
	}
	
	function read_record($id){
		
		$this->db->where('uid',$id);
		$this->db->where('udestroy','3000-01-01');
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_manager($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,uachievement FROM tbl_user WHERE umanager=1 AND upriority=0 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = (select act_parentid from tbl_activity where act_id = ?)";
		$query = $this->db->query($sql, array($activity));
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_federal($activity){
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,uachievement FROM tbl_user WHERE umanager=1 AND upriority=1 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = (select act_parentid from tbl_activity where act_id = ?)";
		$query = $this->db->query($sql, array($activity));
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_records($type){
		switch ($type):
			// администраторы
			case '0' : 	$sql = "SELECT uid,uname,usubname,uthname,uemail,ustatus,uactive,usignupdate,udestroy,umanager,upriority,ucompany,uactivity FROM tbl_user WHERE umanager=0 AND upriority=0 AND ucompany=0";
						break;
			//федеральные менеджеры
			case '1' : 	$sql = "SELECT uid,uname,usubname,uthname,uemail,ustatus,uactive,usignupdate,udestroy,umanager,upriority,ucompany,uactivity FROM tbl_user WHERE umanager=1 AND upriority=1 AND ucompany=0";
						$this->db->where('ucompany',0);
						$this->db->where('umanager',1);
						$this->db->where('upriority',1);
						break;
			//региональные менеджеры
			case '2' :	$sql = "SELECT uid,uname,usubname,uthname,uemail,ustatus,uactive,usignupdate,udestroy,umanager,upriority,ucompany,uactivity FROM tbl_user WHERE umanager=1 AND upriority=0 AND ucompany=0";
						break;
			//представители компании
			case '3' :	$sql = "SELECT uid,uname,usubname,uthname,uemail,ustatus,uactive,usignupdate,udestroy,umanager,upriority,ucompany,udepartment,uactivity FROM tbl_user WHERE umanager=0 AND ucompany>0";
						break;
		endswitch;
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_managers($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus FROM tbl_user WHERE umanager=1 AND upriority=0 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = (select act_parentid from tbl_activity where act_id = ?)";
		$query = $this->db->query($sql, array($activity));
		return $query->result_array();
	}
	
	function read_single_managers($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus,uachievement FROM tbl_user WHERE umanager=1 AND upriority=0 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = ? ORDER BY uid";
		$query = $this->db->query($sql,array($activity));
		return $query->result_array();
	}
	
	function read_single_manager($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus,uachievement,ucloseconsult FROM tbl_user WHERE umanager=1 AND upriority=0 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = ? ORDER BY uid LIMIT 1";
		$query = $this->db->query($sql,array($activity));
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_single_federal($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus,uachievement,ucloseconsult FROM tbl_user WHERE umanager=1 AND upriority=1 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = ? ORDER BY uid LIMIT 1";
		$query = $this->db->query($sql,array($activity));
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function read_single_federals($activity){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus,uachievement,ucloseconsult FROM tbl_user WHERE umanager=1 AND upriority=1 AND ustatus='enabled' AND udestroy = '3000-01-01' AND uactivity = ? ORDER BY uid";
		$query = $this->db->query($sql,array($activity));
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_single_manager_byid($uid,$text){
			
		$sql = "SELECT uid,uemail,uname,usubname,uthname,uphone,uskype,uicq,uactive,ustatus,udestroy,uachievement,ucloseconsult FROM tbl_user WHERE umanager=1 $text AND ustatus='enabled' AND uid = $uid ORDER BY uid";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function read_representatives($cid){
	
		$this->db->select('uid,uemail,uname,usubname,uthname,uposition,uphone,uactive,ustatus,udepartment,upriority,uskype,uicq,urating');
		$this->db->where('ucompany',$cid);
		$this->db->where('udestroy','3000-01-01');
		$this->db->order_by('upriority','DESC');
		$query = $this->db->get('tbl_user');
		$data = $query->result_array();
		if(isset($data)) return $data;
		return null;
	}
	
	function read_representative($cid){
	
		$this->db->select('uid,uemail,uname,usubname,uthname,uposition,uphone,uactive,ustatus,udepartment,upriority,uskype,uicq,urating');
		$this->db->where('ucompany',$cid);
		$this->db->where('udestroy','3000-01-01');
		$this->db->where('upriority',1);
		$query = $this->db->get('tbl_user');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return null;
	}
	
	function read_info($id){
		
	$this->db->select('uid,ucompany,udepartment,uemail,uname,usubname,uthname,uconfirmation,umanager,upriority,uactivity,uskype,uicq,urating');
		$this->db->where('uid',$id);
		$this->db->where('udestroy','3000-01-01');
		$query = $this->db->get('tbl_user');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
	function save_single_data($uid,$field,$data){
		
		$this->db->where('uid',$uid);
		$this->db->where('ustatus','enabled');
		$this->db->where('udestroy','3000-01-01');
		$this->db->set($field,$data);
		$this->db->update('tbl_user');
		return $this->db->affected_rows();
	}
	
	function active_user($id){
		
		$this->db->set('ulastlogindate',date("Y-m-d"));
		$this->db->set('uactive',TRUE);
		$this->db->where('uid',$id);
		$this->db->update('tbl_user');
	}
	
	function deactive_user($id){
		
		$this->db->set('ulastlogindate',date("Y-m-d"));
		$this->db->set('uactive',FALSE);
		$this->db->where('uid',$id);
		$this->db->update('tbl_user');
	}
	
	function auth_user($login,$password){
		
		$this->db->where('uemail',$login);
		$this->db->where('upassword',md5($password));
		$this->db->where('udestroy','3000-01-01');
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function auth_admin($login,$password){
	
		$this->db->where('uemail',$login);
		$this->db->where('upassword',md5($password));
		$this->db->where('udestroy','3000-01-01');
		$this->db->where('uactivity',0);
		$this->db->where('ucompany',0);
		$this->db->where('umanager',0);
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}
	
	function update_status($code){
			
		$this->db->set('ustatus','enabled');
		$this->db->where('uconfirmation',$code);
		$this->db->where('ustatus','disabled');
		$this->db->update('tbl_user');
		$res = $this->db->affected_rows();
		if($res == 0) return FALSE;
		return TRUE;
	}
	
	function update_password($password,$email){
			
		$this->db->set('upassword',md5($password));
		$this->db->set('ucryptpassword',$this->encrypt->encode($password));
		$this->db->where('ustatus','enabled');
		$this->db->where('uemail',$email);
		$this->db->update('tbl_user');
		$res = $this->db->affected_rows();
		if($res == 0) return FALSE;
		return TRUE;
	}
	
	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(count($data) > 0) return $data[0]['uid'];
		return FALSE;
	}
	
	function user_id($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(count($data)>0) return $data[0]['uid'];
		return FALSE;
	}
	
	function read_field($uid,$field){
			
		$this->db->where('uid',$uid);
		$query = $this->db->get('tbl_user',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0][$field];
		return FALSE;
	}
	
	function close_user($uid){
		
		$this->db->set('ulastlogindate',date("Y-m-d"));
		$this->db->set('udestroy','DATE_ADD(CURDATE(),INTERVAL 30 DAY)',FALSE);
		$this->db->where('uid',$uid);
		$this->db->update('tbl_user');
	}
	
	function close_representatives($cid){
		
		$this->db->set('udestroy',date("Y-m-d"));
		$this->db->where('udestroy',"3000-01-01");
		$this->db->where('ucompany',$cid);
		$this->db->update('tbl_user');
		return $this->db->affected_rows();
	}

	function get_image($id){
	
		$this->db->where('uid',$id);
		$this->db->select('uphoto');
		$query = $this->db->get('tbl_user');
		$data = $query->result_array();
		return $data[0]['uphoto'];
	}

	function save_user($uid,$data,$priority,$activity){
		
		$this->db->set('udestroy',$data);
		$this->db->set('upriority',$priority);
		$this->db->set('uactivity',$activity);
		$this->db->where('uid',$uid);
		$this->db->update('tbl_user');
		return $this->db->affected_rows();
	}

	function delete_record($uid){
	
		$this->db->where('uid',$uid);
//		$this->db->where('ustatus','disabled');
		$this->db->delete('tbl_user');
		return $this->db->affected_rows();
	}
	
	function delete_representatives($cid){
	
		$this->db->where('ucompany',$cid);
		$this->db->delete('tbl_user');
		return $this->db->affected_rows();
	}
	
	function close_consult($uid,$check){
	
		$this->db->set('ucloseconsult',$check);
		$this->db->where('uid',$uid);
		$this->db->update('tbl_user');
		return $this->db->affected_rows();
	}

	function clear_data_user($uid){
		
		$this->db->set('uname','');
		$this->db->set('usubname','');
		$this->db->set('uthname','');
		$this->db->set('uphoto',file_get_contents(base_url().'images/userclose.jpg'));
		$this->db->set('uicq','');
		$this->db->set('uphone','');
		$this->db->set('uactive',0);
		$this->db->set('ubirthday','');
		$this->db->set('uskype','');
		$this->db->set('uposition','');
		$this->db->set('uachievement','');
		$this->db->set('ucloseconsult',0);
		$this->db->where('uid',$uid);
		$this->db->update('tbl_user');
		return $this->db->affected_rows();
	}
}
?>