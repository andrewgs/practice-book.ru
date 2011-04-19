<?php

class Admin_interface extends CI_Controller {

	var $user = array('uid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'');
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля",
						"05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа",
						"09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	
	function __construct(){
	
		parent::__construct();
		
		$this->load->model('regionmodel');
		$this->load->model('cmpsharesmodel');
		$this->load->model('companymodel');
		$this->load->model('activitymodel');
		$this->load->model('cmpsrvmodel');
		$this->load->model('usersmodel');
		$this->load->model('unionmodel');
		$this->load->model('cmpnewsmodel');
		$this->load->model('manregactmodel');
		$this->load->model('productsmodel');
		$this->load->model('activitynewsmodel');
		$this->load->model('mraquestionsmodel');
		$this->load->model('pitfallsmodel');
		$this->load->model('tipsmodel');
		$this->load->model('personamodel');
		$this->load->model('documentsmodel');
		$this->load->model('specialsmodel');
		$this->load->model('othertextmodel');
		$this->load->model('supportmodel');
		$this->load->model('productgroupmodel');
		
		$cookieaid = $this->session->userdata('cookieaid');
		if(isset($cookieaid) and !empty($cookieaid)):
			$this->user['uid'] = $this->session->userdata('adminid');
			if($this->user['uid']):
				$userinfo = $this->usersmodel->read_info($this->user['uid']);
				if($userinfo):
					$this->user['ufullname']		= $userinfo['uname'].' '.$userinfo['usubname'].' '.$userinfo['uthname'];
					$this->user['ulogin'] 			= $userinfo['uemail'];
					$this->user['uconfirmation'] 	= $userinfo['uconfirmation'];
				endif;
			endif;
			if($this->user['uconfirmation'] != $this->uri->segment(3)) show_404();
			if($this->session->userdata('cookieaid') != md5($this->user['ulogin'].$this->user['uconfirmation'])):
				$this->user = array();
				redirect('admin');
			endif;
		else:
			redirect('admin');
		endif;
	}

	function cpanel(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'list'			=> $this->supportmodel->read_records()
			);
		$this->load->view("admin_interface/cpanel",$pagevar);
	}
	
	function page_content(){
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'text'			=> ""
			);
		$record_id = NULL;
		$case = $this->uri->segment(4);
		switch ($case):
			case 'main'						: $record_id = 50; break;
			case 'ideas'					: $record_id = 51; break;
			case 'jobs'						: $record_id = 52; break;
			case 'about'					: $record_id = 53; break;
			case 'conditions-cooperation'	: $record_id = 54; break;
			default : show_404();
		endswitch;
		if($this->input->post('submit')):
			$this->othertextmodel->writetext($record_id,$_POST['note']);
			redirect('admin/control-panel/'.$this->user['uconfirmation']);
		endif;
		if($record_id):
			$pagevar['text'] = $this->othertextmodel->read_text($record_id);
		else:
			show_error("Отсутствует запись в БД!<br/>Сообщите о возникшей ошибке разработчикам.");
		endif;
		$this->load->view("admin_interface/page-content",$pagevar);
	}
	
	function activity_content(){
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'text'			=> array()
			);
		$case = $this->uri->segment(4);
		switch ($case):
			case 'product'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(1,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(1,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(1,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(1,'otxt_help');
											 	break;
			case 'pitfalls'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(2,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(2,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(2,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(2,'otxt_help');
											 	break;
			case 'questions'				: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(3,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(3,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(3,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(3,'otxt_help');
											 	break;
			case 'price'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(4,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(4,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(4,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(4,'otxt_help');
											 	break;
			case 'tender'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(5,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(5,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(5,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(5,'otxt_help');
											 	break;
			case 'company'					:	if($this->input->post('submit')):
													$this->othertextmodel->write_field(7,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(8,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(9,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(6,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(7,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(6,'otxt_help');
											 	break;
			case 'news'						: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(11,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(12,$_POST['ext_note'],'otxt_content');
													$this->othertextmodel->write_field(10,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(11,'otxt_content');
												$pagevar['text']['ext_note'] = $this->othertextmodel->read_field(12,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(10,'otxt_help');
											 	break;
			case 'manager'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(13,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(13,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(13,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(13,'otxt_help');
											 	break;
			case 'persona'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(14,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(14,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(14,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(14,'otxt_help');
											 	break;
			case 'documents'				: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(15,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(15,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(15,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(15,'otxt_help');
											 	break;
			case 'specials'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(17,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(18,$_POST['ext_note'],'otxt_content');
													$this->othertextmodel->write_field(16,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(17,'otxt_content');
												$pagevar['text']['ext_note'] = $this->othertextmodel->read_field(18,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(16,'otxt_help');
											 	break;
			case 'tips'						: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(19,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(19,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(19,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(19,'otxt_help');
											 	break;
			case 'whomain'					: 	if($this->input->post('submit')):
													$this->othertextmodel->write_field(20,$_POST['note'],'otxt_content');
													$this->othertextmodel->write_field(20,$_POST['help'],'otxt_help');
													redirect('admin/control-panel/'.$this->user['uconfirmation']);
												endif;
												$pagevar['text']['note'] = $this->othertextmodel->read_field(20,'otxt_content');
												$pagevar['text']['help'] = $this->othertextmodel->read_field(20,'otxt_help');
											 	break;
			default : show_404();
		endswitch;
		$this->load->view("admin_interface/activity-content",$pagevar);
	}
	
	function information_list(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'list'			=> array()
			);
		$record_id = NULL;
		$case = $this->uri->segment(4);
		switch ($case):
			case 'regions'	: 	if($this->input->post('submit')):
									$this->form_validation->set_rules('name',' "город" ','required|trim');
									$this->form_validation->set_rules('area',' "область" ','required|trim');
									$this->form_validation->set_rules('district',' "регион" ','required|trim');
									$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
									if(!$this->form_validation->run()):
										$_POST['submit'] = NULL;
										$this->information_list();
										return FALSE;
									else:
										$this->regionmodel->insert_record($_POST);
										redirect('admin/information-list/'.$this->user['uconfirmation'].'/regions');
									endif;
								endif;
								$pagevar['list'] = $this->regionmodel->read_records();
								$this->load->view("admin_interface/region-list",$pagevar);
								break;
			case 'activity'		: 	if($this->input->post('submit')):
										$this->form_validation->set_rules('title',' "название" ','required|trim');
										$this->form_validation->set_rules('parentid',' "id гл.отросли" ','required|integer|trim');
										$this->form_validation->set_rules('full',' "полное название" ','required|trim');
										$this->form_validation->set_rules('final',' "признак конца" ','required|integer|trim');
										$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
										if(!$this->form_validation->run()):
											$_POST['submit'] = NULL;
											$this->information_list();
											return FALSE;
										else:
											$newactivity = $this->activitymodel->insert_record($_POST);
											$this->productgroupmodel->insert_empty($newactivity);
											redirect('admin/information-list/'.$this->user['uconfirmation'].'/activity');
										endif;
									endif;
									$pagevar['list'] = $this->activitymodel->read_records_order_by_pid();
									$this->load->view("admin_interface/activity-list",$pagevar);
									break;
			case 'users'		: 	$pagevar['list'][0] = $this->usersmodel->read_records(0);
									$pagevar['list'][0]['caption'] = "Администраторы";
									$pagevar['list'][1] = $this->usersmodel->read_records(1);
									$pagevar['list'][1]['caption'] = "Федеральные менеджеры";
									$pagevar['list'][2] = $this->usersmodel->read_records(2);
									$pagevar['list'][2]['caption'] = "Региональные менеджеры";
									$pagevar['list'][3] = $this->usersmodel->read_records(3);
									$pagevar['list'][3]['caption'] = "Представители компаний";
									$this->load->view("admin_interface/users-list",$pagevar);
								break;
			case 'company'		: 	$pagevar['list'] = $this->companymodel->read_records();
									$this->load->view("admin_interface/company-list",$pagevar);
									break;
			default : show_404();
		endswitch;
	}
	
	function registration_users(){
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'activity'		=> array()
			);
		$record_id = NULL;
		$case = $this->uri->segment(4);
		switch ($case):
			case 'manager'			: 
				if($this->input->post('submit')):
					$this->form_validation->set_rules('login','логин','required|valid_email|callback_login_check|trim');
					$this->form_validation->set_message('valid_email','Укажите правильный адрес');
					$this->form_validation->set_rules('fname','фамилия','required|trim');
					$this->form_validation->set_rules('sname','имя','required|trim');
					$this->form_validation->set_rules('tname','отчество','required|trim');
					$this->form_validation->set_rules('phones','телефон','required|min_length[6]|integer|trim');
					$this->form_validation->set_rules('activity','отросли','required|callback_activity_chack');
					$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
					if(!$this->form_validation->run()):
						$_POST['submit'] = NULL;
						$this->registration_users();
						return FALSE;
					else:
						$_POST['submit'] = NULL;
						$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.png');
						$_POST['cmpid'] = 0;
						$_POST['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime());
						$_POST['priority'] = $_POST['manager'] = 1;
						$_POST['position'] = $_POST['icq'] = $_POST['skype'] = '';$_POST['birthday'] = "0000-00-00";
						$newmanager = $this->usersmodel->insert_record($_POST);
						$message = 'Логин - '.$_POST['login']."\n".'Пароль - federal'."\n".'Не забудьте сменить пароль'."\n".'Для активации аккаунта пройдите по следующей ссылке'."\n".'<a href="'.base_url().'activation/'.$_POST['confirm'].'" target="_blank">'.base_url().'activation/'.$_POST['confirm'].'</a>'."\n или скопируйте ссылку в окно ввода адреса браузера и нажмите enter";
						if($this->sendmail($_POST['login'],$message,"Подтверждение регистрации на сайте practice-book.ru","admin@practice-book.ru")):
							redirect('admin/control-panel/'.$this->user['uconfirmation']);
						else:
							$this->email->print_debugger();
							exit;
						endif;
					endif;
				endif;
				$pagevar['activity'] = $this->activitymodel->read_records_by_pid(0);
				$this->load->view("admin_interface/registration-federal",$pagevar);
				break;
			case 'administrator'	: 	
				if($this->input->post('submit')):
					$this->form_validation->set_rules('login','логин','required|valid_email|callback_login_check|trim');
					$this->form_validation->set_message('valid_email','Укажите правильный адрес');
					$this->form_validation->set_rules('fname','фамилия','required|trim');
					$this->form_validation->set_rules('sname','имя','required|trim');
					$this->form_validation->set_rules('tname','отчество','required|trim');
					$this->form_validation->set_rules('phones','телефон','required|min_length[6]|integer|trim');
					$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
					if(!$this->form_validation->run()):
						$_POST['submit'] = NULL;
						$this->registration_users();
						return FALSE;
					else:
						$_POST['submit'] = NULL;
						$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.png');
						$_POST['cmpid'] = $_POST['priority'] = $_POST['manager'] = $_POST['activity'] = 0;
						$_POST['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime());
						$_POST['position'] = '';$_POST['birthday'] = "0000-00-00";
						$newmanager = $this->usersmodel->insert_record($_POST);
						$message = 'Для допуска с панели администрирования необходимо авторизироваться.'."\n".'Ссылка для авторизации http://practice-book.ru/admin'."\n".'Логин - '.$_POST['login']."\n".'Пароль - administrator'."\n".'Не забудьте сменить пароль'."\n".'Для активации аккаунта пройдите по следующей ссылке'."\n".'<a href="'.base_url().'activation/'.$_POST['confirm'].'" target="_blank">'.base_url().'activation/'.$_POST['confirm'].'</a>'."\n или скопируйте ссылку в окно ввода адреса браузера и нажмите enter";
						if($this->sendmail($_POST['login'],$message,"Подтверждение регистрации на сайте practice-book.ru","admin@practice-book.ru")):
							redirect('admin/control-panel/'.$this->user['uconfirmation']);
						else:
							$this->email->print_debugger();
							exit;
						endif;
					endif;
				endif;
				$this->load->view("admin_interface/registration-admin",$pagevar);
				break;
			default : show_404();
		endswitch;
	}
	
	function cabinet(){
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Личный кабинет менеджера',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'manager' 		=> array(),
			);
		$pagevar['manager'] = $this->usersmodel->read_record($this->user['uid']);
		$this->load->view('admin_interface/cabinet',$pagevar);
	}

	function save_profile(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при сохранении','retvalue'=>'');
		$fname = trim($this->input->post('id'));
		$fdata = trim($this->input->post('value'));
		if(!isset($fname) or empty($fname)) show_404();
		if(!isset($fdata) or empty($fdata)) show_404();
		switch ($fname):
			case 'vlogin': 	if(preg_match("/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i",$fdata)):
								if($this->usersmodel->user_exist('uemail',$fdata)):
									$statusval['status'] 	= FALSE;
									$statusval['message'] 	= 'Логин уже занят';
									break;
								endif;
								$res = $this->usersmodel->save_single_data($this->user['uid'],'uemail',$fdata);
								if($res):
									$this->session->set_userdata('cookieaid',md5($fdata.$this->user['uconfirmation']));
									$this->session->set_userdata('adminid',$this->user['uid']);
								endif;
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный формат E-mail';
							endif;
							break;
							
			case 'vpass': 	if(mb_strlen($fdata,'UTF-8') >= 6):
								$this->usersmodel->save_single_data($this->user['uid'],'upassword',md5($fdata));
								$this->usersmodel->save_single_data($this->user['uid'],'ucryptpassword',$this->encrypt->encode($fdata));
								$statusval['status'] = TRUE;
								$statusval['retvalue'] 	= 'Пароль изменен';
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Короткий пароль';
							endif;
							break;
							
			case 'vphones': if(preg_match("/^[0-9 ]{6,}$/i",$fdata)):
								$this->usersmodel->save_single_data($this->user['uid'],'uphone',$fdata);
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный номер телефона';
							endif;
							break;
							
			case 'vicq': 	if(preg_match("/^[0-9 ]{4,12}$/i",$fdata)):
								$this->usersmodel->save_single_data($this->user['uid'],'uicq',$fdata);
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный номер ICQ';
							endif;
							break;
			case 'vskype': 	$this->usersmodel->save_single_data($this->user['uid'],'uskype',strip_tags($fdata));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= strip_tags($fdata);
							break;
		endswitch;
		echo json_encode($statusval);
	}
	
	function save_region(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','name'=>'','area'=>'','distr'=>'');
		$rid = $this->input->post('id');
		$name = trim($this->input->post('name'));
		$area = trim($this->input->post('area'));
		$distr = trim($this->input->post('distr'));
		if(!isset($rid) or empty($rid)) show_404();
		if(!isset($name) or empty($name)) show_404();
		if(!isset($area) or empty($area)) show_404();
		if(!isset($distr) or empty($distr)) show_404();
		$success = $this->regionmodel->save_region($rid,$name,$area,$distr);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['name'] = $name;
			$statusval['area'] = $area;
			$statusval['distr'] = $distr;
		}
		echo json_encode($statusval);
	}
	
	function save_activity(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','parent'=>'','full'=>'','final'=>'');
		$rid = $this->input->post('id');
		$title = trim($this->input->post('title'));
		$parent = trim($this->input->post('parent'));
		$full = trim($this->input->post('full'));
		$final = trim($this->input->post('final'));
		if(!isset($rid) or empty($rid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($parent) or empty($parent)) $parent = 0;
		if(!isset($full) or empty($full)) show_404();
		if(!isset($final) or empty($final)) $final = 0;
		$success = $this->activitymodel->save_activity($rid,$title,$parent,$full,$final);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = $title;
			$statusval['parent'] = $parent;
			$statusval['full'] = $full;
			$statusval['final'] = $final;
		}
		echo json_encode($statusval);
	}
	
	function save_user(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','date'=>'','priority'=>'','activity'=>'');
		$uid = $this->input->post('id');
		$date = trim($this->input->post('date'));
		$priority = trim($this->input->post('priority'));
		$activity = trim($this->input->post('activity'));
		if(!isset($uid) or empty($uid)) show_404();
		if(!isset($date) or empty($date)) show_404();
		if(!isset($priority) or empty($priority)) $priority = 0;
		if(!isset($activity) or empty($activity)) $activity = 0;
		$success = $this->usersmodel->save_user($uid,$date,$priority,$activity);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['date'] = $date;
			$statusval['priority'] = $priority;
			$statusval['activity'] = $activity;
		}
		echo json_encode($statusval);
	}
	
	function activity_select($cats,$parent_id,&$mas){
		
		if(isset($cats[$parent_id])):
			foreach($cats[$parent_id] as $cat):
				$single_activity = $this->activitymodel->read_activity($cat['act_id']);
				if($single_activity):
					foreach($single_activity as $sact):
				 		$mas[] = $sact;
					endforeach;
				endif;
				$this->activity_select($cats,$cat['act_id'],$mas);
			endforeach;
		endif;
		return $mas;
	}

	function dalete_user(){
		
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$uid = trim($this->input->post('id'));
		if(!isset($uid) or empty($uid)) show_404();
		$success = $this->usersmodel->delete_record($uid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_company(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','rating'=>'');
		$uid = $this->input->post('id');
		$rating = trim($this->input->post('rating'));
		if(!isset($uid) or empty($uid)) show_404();
		if(!isset($rating) or empty($rating)) $rating = 0;
		$success = $this->companymodel->save_company_rating($uid,$rating);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['rating'] = $rating;
		}
		echo json_encode($statusval);
	}

	function login_check($login){
		
		if($this->usersmodel->user_exist('uemail',$login)):
			$this->form_validation->set_message('login_check','Логин уже занят');
			return FALSE;
		endif;
		return TRUE;
	}

	function activity_chack($activity){
		if($this->usersmodel->user_exist('uactivity',$activity)):
			$this->form_validation->set_message('activity_chack','Менеджер уже назначен');
			return FALSE;
		endif;
		return TRUE;
	}

	function sendmail($email,$msg,$subject,$from){
		
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($from,'Администрация сайта');
		$this->email->to($email);
		$this->email->bcc('');
		$this->email->subject($subject);
		$this->email->message(strip_tags($msg));
		if (!$this->email->send()):
			return FALSE;
		endif;
		return TRUE;
	}
	
	function shutdown(){
		
		$aid = $this->session->userdata('adminid');
		if($aid):
			$this->usersmodel->deactive_user($aid);
			$this->session->sess_destroy();
			redirect('');
		else:
			show_404();
		endif;
	}
	
	function delete_message(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$uid = trim($this->input->post('id'));
		if(!isset($uid) or empty($uid)) show_404();
		$success = $this->supportmodel->delete_record($uid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}
}
?>