<?php

class Users_interface extends CI_Controller {

	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'','manager'=>FALSE,'priority'=>0,'activity'=>0);
	var $loginstatus = array('company'=>FALSE,'status'=>FALSE);
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
		$this->load->model('productgroupmodel');
		$this->load->model('productionunitmodel');
		
		$cookieuid = $this->session->userdata('login_id');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$userinfo = $this->usersmodel->read_info($this->user['uid']);
				if($userinfo):
					$this->user['ufullname']		= $userinfo['uname'].' '.$userinfo['usubname'].' '.$userinfo['uthname'];
					$this->user['ulogin'] 			= $userinfo['uemail'];
					$this->user['uconfirmation'] 	= $userinfo['uconfirmation'];
					$this->user['manager'] 			= $userinfo['umanager'];
					$this->user['priority'] 		= $userinfo['upriority'];
					$this->user['activity'] 		= $userinfo['uactivity'];
					$this->loginstatus['status'] 	= TRUE;
					if(!$this->user['manager']):
						$this->user['cid']				= $userinfo['ucompany'];
						$this->loginstatus['company'] 	= TRUE;
					endif;
				endif;
			endif;
			
			if($this->session->userdata('login_id') != md5($this->user['ulogin'].$this->user['uconfirmation'])):
				$this->loginstatus['status'] = FALSE;
				$this->user = array();
			endif;
		endif;
	}
	
	/* ----------------------------------------	users menu ---------------------------------------------------*/
	
	function index(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Опыт профессионалов из первых рук',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'activity'		=> array(),
					'text'			=> $this->othertextmodel->read_text(50)
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/index',$pagevar);
	}

	function ideas(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Наши идеи',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(51)
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;	
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/ideas',$pagevar);
	}

	function job(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Работа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(52)
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/job',$pagevar);
	}
	
	function about_project(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Реклама',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(53)
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/advertising',$pagevar);
	}
	
	function contacts(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Контакты',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'activitylist'	=> array()
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/contacts',$pagevar);
	}

	function cooperation(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Работа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(54)
			);
		if($this->user['manager']):
			$this->session->unset_userdata('activity');
			$this->session->unset_userdata('region');
			$this->session->unset_userdata('parent_act');
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		if($this->user['manager']):
			if($this->user['priority']):
				$pagevar['regions'] = $this->regionmodel->read_records();
			else:
				$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
			endif;
			$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
			if(!$final):
				$activity = $this->activitymodel->read_records();
				if(count($activity) > 0):
					for($i = 0; $i < count($activity); $i++):
						$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
					endfor;
				endif;
				$mas = array();
				$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
				$pagevar['activity'] = $mas;
			else:
				$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
			endif;
		else:
			$pagevar['regions'] = $this->regionmodel->read_records();
		endif;
		$this->session->unset_userdata('regstatus');
		$this->load->view('users_interface/cooperation',$pagevar);
	}

	/* ----------------------------------------	registering company -------------------------------------------*/
	
	function newcompany1(){
		$regstatus = $this->session->userdata('regstatus');
		if($regstatus == 2):
			redirect('registering/step-2');
		elseif($regstatus == 3):
			redirect('registering/step-3');
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Регистрация новой компании | Шаг №1',
					'baseurl' 		=> base_url(),
					'formaction' 	=> 'registering/step-1',
					'regions'		=> array()
			);
		
		$pagevar['regions'] = $this->regionmodel->read_records();
		$this->session->set_userdata('regstatus',1);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','','required|callback_company_check|trim');
			$this->form_validation->set_rules('city','','required|is_natural_no_zero');
			$this->form_validation->set_message('is_natural_no_zero','Укажите город основной деятельности');
			$this->form_validation->set_rules('maker','','');
			$this->form_validation->set_rules('ur_face','','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('comment','','required|xss_clean|encode_php_tags|trim');
			$this->form_validation->set_rules('recvizit','','required|xss_clean|encode_php_tags|trim');
			$this->form_validation->set_rules('site','','prep_url|trim');
			$this->form_validation->set_rules('email','','valid_email|callback_cmp_email_check|trim');
			$this->form_validation->set_message('valid_email','Укажите правильный адрес.');
			$this->form_validation->set_rules('tel','','required|min_length[6]|integer|trim');
			$this->form_validation->set_rules('telfax','','min_length[6]|integer|trim');
			$this->form_validation->set_message('min_length','Не верный номер');
			$this->form_validation->set_message('integer','Только целые числа');
			$this->form_validation->set_rules('uradres','','required|trim');
			$this->form_validation->set_rules('realadres','','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->newcompany1();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$cookieuid = $this->session->userdata('login_id');
				if($cookieuid):
show_error("Внимание!<br/>Вы авторизированы как ".$this->user['ufullname']."<br/>Авторизированным пользователям запрещено дабавлять компании.");
				endif;
				if(!$_POST['city__sexyComboHidden']):
					$this->session->set_userdata('errstatus',TRUE);
					redirect('script_error');
				endif;
				if($_FILES['userfile']['error'] != 4):
					$_POST['logo'] = $this->resize_img($_FILES['userfile']['tmp_name'],128,128);
					$_POST['thumb'] = $this->resize_img($_FILES['userfile']['tmp_name'],74,74);
				else:
					$_POST['logo'] = file_get_contents(base_url().'images/no_photo.jpg');;
					$_POST['thumb'] = file_get_contents(base_url().'images/no_photo.jpg');;
				endif;
				$company_id = $this->companymodel->insert_record($_POST);
				$this->session->set_userdata('companyid',$company_id);
				$this->session->set_userdata('regstatus',2);
				redirect('registering/step-2');
			endif;
		endif;
		$this->load->view('users_interface/registration/newcompany1',$pagevar);
	}

	function newcompany2(){
		
		$regstatus = $this->session->userdata('regstatus');
		if(!$regstatus):
			show_404();
		elseif($regstatus == 1):
			redirect('registering/step-1');
		elseif($regstatus == 3):
			redirect('registering/step-3');
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Регистрация новой компании | Шаг №2',
					'baseurl' 		=> base_url(),
					'formaction'	=>'registering/step-2',
					'list' 			=> array()
			);
		$this->session->set_userdata('regstatus',2);
		if($this->input->post('submit')):
			if($this->input->post('servname')):
				$_POST['submit'] = NULL;
				$cmpid = $this->session->userdata('companyid');
				if(!$cmpid):
					$this->session->set_userdata('errstatus',TRUE);
					redirect('script_error');
				endif;
				$this->cmpsrvmodel->multi_insert($_POST['servname'],$cmpid);
				$this->session->set_userdata('regstatus',3);
				redirect('registering/step-3');
			else:
				$_POST['submit'] = NULL;
				$this->newcompany2();
				return FALSE;
			endif;
		endif;
		$services = $this->activitymodel->read_records();
		if(count($services) > 0):
			for($i = 0; $i < count($services); $i++):
				$pagevar['list'][$services[$i]['act_parentid']][] = $services[$i];
			endfor;
		endif;
		$this->load->view('users_interface/registration/newcompany2',$pagevar);
	}
	
	function newcompany3(){
	
		$regstatus = $this->session->userdata('regstatus');
		if(!$regstatus):
			show_404();
		elseif($regstatus == 1):
			redirect('registering/step-1');
		elseif($regstatus == 2):
			redirect('registering/step-2');
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Регистрация новой компании | Шаг №3',
					'baseurl' 		=> base_url(),
					'formaction' 	=> 'registering/step-3',
					'regions'		=> array()
			);
		$pagevar['regions'] = $this->regionmodel->read_records();
		$this->session->set_userdata('regstatus',3);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login','','required|valid_email|callback_login_check|trim');
			$this->form_validation->set_message('valid_email','Укажите правильный адрес.');
			$this->form_validation->set_rules('password','','required|min_length[6]|trim');
			$this->form_validation->set_rules('confirmpass','','required|min_length[6]|matches[password]|trim');
			$this->form_validation->set_message('matches','Пароли не совпадают');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('fname','','required|trim');
			$this->form_validation->set_rules('sname','','required|trim');
			$this->form_validation->set_rules('tname','','required|trim');
			$this->form_validation->set_rules('position','','required|trim');
			$this->form_validation->set_rules('phones','','required|min_length[6]|integer|trim');
			$this->form_validation->set_message('min_length','Меньше 6 символов');
			$this->form_validation->set_message('integer','Только целые числа');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->newcompany3();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['photo'] = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				else:
					$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.jpg');
				endif;
				$_POST['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime());
				$_POST['cmpid'] = $this->session->userdata('companyid');
				if(!$_POST['cmpid']):
					$this->session->set_userdata('errstatus',TRUE);
					redirect('script_error');
				endif;
				$_POST['icq'] = $_POST['skype'] = ''; $_POST['priority'] = 1;
				$_POST['birthday'] = "0000-00-00"; $_POST['manager'] =  $_POST['activity']= 0;
				$user_id = $this->usersmodel->insert_record($_POST);
				$this->session->set_userdata('userid',$user_id);
				$this->session->set_userdata('regstatus',4);
				redirect('registering/step-4');
			endif;
		endif;
		$this->load->view('users_interface/registration/newcompany3',$pagevar);
	}

	function newcompany4(){
	
		$regstatus = $this->session->userdata('regstatus');
		if(!$regstatus):
			show_404();
		elseif($regstatus == 1):
			redirect('registering/step-1');
		elseif($regstatus == 2):
			redirect('registering/step-2');
		elseif($regstatus == 3):
			redirect('registering/step-3');
		endif;
		$this->session->unset_userdata('regstatus');
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Регистрация новой компании | Завершение регистрации',
					'baseurl' 		=> base_url(),
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> FALSE,
					'cmpid' 		=> 1,
					'cmpname'		 => ''
			);
		$cmpid = $this->session->userdata('companyid');
		$userid = $this->session->userdata('userid');
		$confirm = $this->usersmodel->read_field($userid,'uconfirmation');
		$email = $this->usersmodel->read_field($userid,'uemail');
		$message = 'Для активации аккаунта пройдите по следующей ссылке'."\n".'<a href="'.base_url().'activation/'.$confirm.'" target="_blank">'.base_url().'activation/'.$confirm.'</a>'."\nИли скопируйте ссылку в окно ввода адреса браузера и нажмите enter.\n";
		if($this->sendmail($email,$message,"Подтверждение регистрации на сайте practice-book.ru","admin@practice-book.ru")):
			$pagevar['text'] = '<br><br><b>Учетная запись создана.</b><p><b>На адрес "'.$email.'" выслано письмо.</b></p><p><b>Для активации учетной записи перейдите по ссылке указанной в письме</b></p>';
			$this->load->view('users_interface/message',$pagevar);
			return TRUE;
		else:
			$this->email->print_debugger();
		endif;
	}

	/* ------------------------------------------	activation -----------------------------------------------*/
	function activation(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Активация',
					'baseurl' 		=> base_url(),
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> FALSE,
					'cmpid'			=> 1,
					'cmpname'		=> ''
			);
		$code = $this->uri->segment(2);
		if(!isset($code) or !empty($code)):
			$userid = $this->usersmodel->user_id('uconfirmation',$code);
			if($userid == FALSE):
				$this->session->sess_destroy();
				$pagevar['text'] = '<b>Активация невозможна: <br> ссылка устарела или не верна!</b>';
				$this->load->view('users_interface/message',$pagevar);
				return FALSE;
			endif;
			if($this->usersmodel->update_status($code)):
				$this->session->sess_destroy();
				$this->load->view('users_interface/registration/activation',$pagevar);
			else:
				$pagevar['text'] = '<b>Активация невозможна: профиль уже активирован</b>';
				$this->load->view('users_interface/message',$pagevar);
				return FALSE;
			endif;
		else:
			show_404();
		endif;
	}

	/* ----------------------------------- authorization/shutdown ----------------------------------------------*/
	function authorization(){
		
		$statusval = array('status'=>FALSE,'message'=>'Неверный логин или пароль');
		$login = trim($this->input->post('login'));
		$password = trim($this->input->post('password'));
		if(!isset($login) or empty($login)) show_404();
		if(!isset($password) or empty($password)) show_404();
		$user = $this->usersmodel->auth_user($login,$password);
		if($user):
			if($user['ustatus'] == 'enabled'):
				$this->session->set_userdata('login_id',md5($user['uemail'].$user['uconfirmation']));
				$this->session->set_userdata('userid',$user['uid']);
				$this->usersmodel->active_user($user['uid']);
				$statusval['status'] = TRUE;
			else:
				$statusval['message'] = 'Учетная запись не активирована';
			endif;
		endif; 
		echo json_encode($statusval);
	}
	
	function shutdown(){
		
		$uid = $this->session->userdata('userid');
		if($uid):
			$this->usersmodel->deactive_user($uid);
			$this->session->sess_destroy();
		else:
			show_404();
		endif;
	}
	
	function admin_login(){
		
		if($this->session->userdata('adminid')):
			redirect('admin/control-panel/'.$this->session->userdata('adminconfirm'));
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Администрирование | Авторизация',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login-name','','required|trim');
			$this->form_validation->set_rules('login-pass','','required');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				redirect("admin");
			else:
				$user = $this->usersmodel->auth_admin($_POST['login-name'],$_POST['login-pass']);
				if($user):
					if($user['ustatus'] == 'disabled'):
						redirect("admin");
					endif;
					$this->session->sess_destroy();
					$this->session->sess_create();
					$this->session->set_userdata('cookieaid',md5($user['uemail'].$user['uconfirmation']));
					$this->session->set_userdata('adminid',$user['uid']);
					$this->session->set_userdata('adminconfirm',$user['uconfirmation']);
					$this->usersmodel->active_user($user['uid']);
					redirect('admin/control-panel/'.$user['uconfirmation']);exit;
				endif;
				redirect("admin");
			endif;
		endif;
		$this->load->view('users_interface/admin-login',$pagevar);
	}
	/* ------------------------------------------ views -------------------------------------------------------*/
	function views(){
	
		$type = $this->uri->segment(2);
		switch ($type):
			case 'login'		:	$pagevar = array('regions'=>array(),'activity'=>array(),'userinfo'=> $this->user,'baseurl'=>base_url());
									if($this->user['manager']):
										if($this->user['priority']):
											$pagevar['regions'] = $this->regionmodel->read_records();
										else:
											$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
										endif;
										$final = $this->activitymodel->read_field($this->user['activity'],'act_final');
										if(!$final):
											$activity = $this->activitymodel->read_records();
											if(count($activity) > 0):
												for($i = 0; $i < count($activity); $i++):
													$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
												endfor;
											endif;
											$mas = array();
											$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
											$pagevar['activity'] = $mas;
										else:
											$pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
										endif;
									else:
										$pagevar['regions'] = $this->regionmodel->read_records();
									endif;
									$this->load->view('users_interface/header/userinfo',$pagevar);
									break;
			case 'logout'		:	$this->load->view('forms/frmlogin');
			 						break;
			case 'representative': 	$pagevar = array('userinfo'=> $this->user,'baseurl'=>base_url());
									$this->load->view('forms/frmregrepsentative',$pagevar);
									break;
			default 			: 	$this->load->view('users_interface/header-logo');
		endswitch;
	}

	function viewimage(){
		
		$section = $this->uri->segment(1);
		$id = $this->uri->segment(3);
		switch ($section){
			case 'companylogo' 	:	$image = $this->companymodel->get_image($id); break;
			case 'companythumb'	:	$image = $this->companymodel->get_thumb($id); break;
			case 'mavatar' 		:	$image = $this->usersmodel->get_image($id);	break;
			case 'cravatar'		: 	$image = $this->usersmodel->get_image($id); break;
			case 'cnavatar'		: 	$image = $this->cmpnewsmodel->get_image($id); break;
			case 'cshavatar'	: 	$image = $this->cmpsharesmodel->get_image($id); break;
			case 'mpavatar'		: 	$image = $this->productsmodel->get_image($id); break;
			case 'anavatar'		: 	$image = $this->activitynewsmodel->get_image($id); break;
			case 'pravatar'		: 	$image = $this->productsmodel->get_image($id); break;
			case 'activitynews'	: 	$image = $this->activitynewsmodel->get_image($id); break;
			case 'companynews'	: 	$image = $this->cmpnewsmodel->get_image($id); break;
			case 'prsavatar'	: 	$image = $this->personamodel->get_image($id); break;
			case 'docavatar'	: 	$image = $this->documentsmodel->get_image($id); break;
			case 'specials'		: 	$image = $this->specialsmodel->get_image($id); break;
			case 'puravatar'	: 	$image = $this->productionunitmodel->get_image($id); break;
		}
		header('Content-type: image/gif');
		echo $image;
	}

	/* -----------------------------------------	other function -------------------------------------------*/

	function support(){
		if($this->input->post('submit')):
			$this->form_validation->set_rules('name','','required|strip_tags|trim');
			$this->form_validation->set_rules('email','','required|strip_tags|valid_email|trim');
			$this->form_validation->set_rules('theme','','required|strip_tags|trim');
			$this->form_validation->set_rules('message','','required|strip_tags|trim');
			if(!$this->form_validation->run()):
				redirect($_POST['uri']);
			else:
				$this->load->model('supportmodel');
				$success = $this->supportmodel->insert_record($_POST);
				redirect($_POST['uri']);
			endif;
		else:
			show_404();
		endif;
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

	function login_check($login){
		
		if($this->usersmodel->user_exist('uemail',$login)):
			$this->form_validation->set_message('login_check','Логин уже занят');
			return FALSE;
		endif;
		return TRUE;
	}

	function company_check($title){
		
		if($this->companymodel->company_exist('cmp_name',$title)):
			$this->form_validation->set_message('company_check','Компания уже зарегистрирована');
			return FALSE;
		endif;
		return TRUE;
	}
	
	function cmp_email_check($email){
		if($this->companymodel->company_exist('cmp_email',$email)):
			$this->form_validation->set_message('cmp_email_check','E-mail уже зарегистрирован');
			return FALSE;
		endif;
		return TRUE;
	}

	function email_check($email){
		
		if($this->usersmodel->user_exist('uemail',$email)):
			$this->form_validation->set_message('email_check','E-mail уже зарегистрирован');
			return FALSE;
		endif;
		return TRUE;
	}

	function userfile_check($file){
		
		$tmpName = $_FILES['userfile']['tmp_name'];
		if($_FILES['userfile']['error'] != 4):
			if(!$this->case_image($tmpName)):
				$this->form_validation->set_message('userfile_check','Формат не поддерживается!');
				return FALSE;
			endif;
		endif;
		if($_FILES['userfile']['error'] == 1):
			$this->form_validation->set_message('userfile_check','Размер более 5 Мб!');
			return FALSE;
		endif;
		return TRUE;
	}

	function resize_img($tmpName,$wgt,$hgt){
			
		chmod($tmpName,0777);
		$img = getimagesize($tmpName);		
		$size_x = $img[0];
		$size_y = $img[1];
		$wight = $wgt;
		$height = $hgt; 
		if(($size_x < $wgt) or ($size_y < $hgt)):
			$this->resize_image($tmpName,$wgt,$hgt,FALSE);
			$image = file_get_contents($tmpName);
			return $image;
		endif;
		if($size_x > $size_y):
			$this->resize_image($tmpName,$size_x,$hgt,TRUE);
		else:
			$this->resize_image($tmpName,$wgt,$size_y,TRUE);
		endif;
		$img = getimagesize($tmpName);		
		$size_x = $img[0];
		$size_y = $img[1];
		switch ($img[2]){
			case 1: $image_src = imagecreatefromgif($tmpName); break;
			case 2: $image_src = imagecreatefromjpeg($tmpName); break;
			case 3:	$image_src = imagecreatefrompng($tmpName); break;
		}
		$x = round(($size_x/2)-($wgt/2));
		$y = round(($size_y/2)-($hgt/2));
		if($x < 0):
			$x = 0;	$wight = $size_x;
		endif;
		if($y < 0):
			$y = 0; $height = $size_y;
		endif;
		$image_dst = ImageCreateTrueColor($wight,$height);
		imageCopy($image_dst,$image_src,0,0,$x,$y,$wight,$height);
		imagePNG($image_dst,$tmpName);
		imagedestroy($image_dst);
		imagedestroy($image_src);
		$image = file_get_contents($tmpName);
		/*$file = fopen($tmpName,'rb');
		$image = fread($file,filesize($tmpName));
		fclose($file);
		header('Content-Type: image/jpeg' );
		echo $image;
		exit();*/
		return $image;
	}

	function resize_image($image,$wgt,$hgt,$ratio){
	
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $image; 
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= $ratio;
		$config['width'] 			= $wgt;
		$config['height'] 			= $hgt;
				
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	function case_image($file){
			
		$info = getimagesize($file);
		switch ($info[2]):
			case 1	: return TRUE;
			case 2	: return TRUE;
			case 3	: return TRUE;
			default	: return FALSE;	
		endswitch;
	}
	
	function showerror(){
	
		if(!$this->session->userdata('errstatus')):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Критическая ошибка',
					'baseurl' 		=> base_url()
			);
		$this->load->view('users_interface/error',$pagevar);
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
}