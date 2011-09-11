<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_interface extends CI_Controller {

	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'','region'=>1,'priority'=>0);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля",
						"05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа",
						"09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
						
	function __construct(){
	
		parent::__construct();
		
		$this->load->model('companymodel');
		$this->load->model('activitymodel');
		$this->load->model('cmpsrvmodel');
		$this->load->model('usersmodel');
		$this->load->model('regionmodel');
		$this->load->model('othertextmodel');
		$this->load->model('unionmodel');
		$this->load->model('cmpnewsmodel');
		$this->load->model('cmpsharesmodel');
		$this->load->model('productgroupmodel');
		$this->load->model('cmpunitsmodel');
		$this->load->model('departmentsmodel');
		
		$cookieuid = $this->session->userdata('login_id');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$userinfo = $this->usersmodel->read_info($this->user['uid']);
				if($userinfo):
					if($userinfo['umanager'] == 1):
						show_404();
					endif;
					$this->user['ufullname']		= $userinfo['uname'].' '.$userinfo['usubname'].' '.$userinfo['uthname'];
					$this->user['ulogin'] 			= $userinfo['uemail'];
					$this->user['uconfirmation'] 	= $userinfo['uconfirmation'];
					$this->user['priority'] 		= $userinfo['upriority'];
					$this->user['cid'] 				= $userinfo['ucompany'];
					$this->user['region'] 			= $this->companymodel->read_field($this->user['cid'],'cmp_region');
				endif;
			endif;
			if($this->user['uconfirmation'] != $this->uri->segment(3)) show_404();
			if($this->session->userdata('login_id') != md5($this->user['ulogin'].$this->user['uconfirmation'])):
				$this->user = array();
				redirect("");
			endif;
		else:
			redirect("");
		endif;
	}
	
	function cpanel(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Панель управления компанией',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'regions'		=> array(),
					'representative' => $this->usersmodel->read_representatives($this->user['cid']),
					'news'			=> $this->cmpnewsmodel->read_limit_records($this->user['cid'],3),
					'shares'		=> $this->cmpsharesmodel->read_limit_records($this->user['cid'],3),
					'unitgroups'	=> array(),
					'units'			=> array(),
					'association'	=> array(),
					'group'			=> 0
					
			);
		for($i = 0;$i < count($pagevar['news']); $i++):
			$pagevar['news'][$i]['cn_pdatebegin'] = $this->operation_date($pagevar['news'][$i]['cn_pdatebegin']);
			if(mb_strlen($pagevar['news'][$i]['cn_note'],'UTF-8') > 325):									
				$pagevar['news'][$i]['cn_note'] = mb_substr($pagevar['news'][$i]['cn_note'],0,325,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['cn_note'],'.',0,'UTF-8');
				$pagevar['news'][$i]['cn_note'] = mb_substr($pagevar['news'][$i]['cn_note'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['cn_note'] .= '. ... ';
			endif;
		endfor;
		for($i = 0;$i < count($pagevar['shares']); $i++):
			$pagevar['shares'][$i]['sh_pdatebegin'] = $this->operation_date($pagevar['shares'][$i]['sh_pdatebegin']);
			if(mb_strlen($pagevar['shares'][$i]['sh_note'],'UTF-8') > 325):									
				$pagevar['shares'][$i]['sh_note'] = mb_substr($pagevar['shares'][$i]['sh_note'],0,325,'UTF-8');	
				$pos = mb_strrpos($pagevar['shares'][$i]['sh_note'],'.',0,'UTF-8');
				$pagevar['shares'][$i]['sh_note'] = mb_substr($pagevar['shares'][$i]['sh_note'],0,$pos,'UTF-8');
				$pagevar['shares'][$i]['sh_note'] .= '. ... ';
			endif;
		endfor;
		$pagevar['company']['cmp_graph'] = $pagevar['company']['cmp_rating'];
		if($pagevar['company']['cmp_rating'] > 175):
			$pagevar['company']['cmp_graph'] = 175;
		endif;
		
		$pagevar['unitgroups'] = $this->unionmodel->read_cmpproduct_group($this->user['cid']);
		if($pagevar['unitgroups']):
			$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
			$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
//			$pagevar['units'] = $this->cmpunitsmodel->read_units($pagevar['unitgroups'][0]['prg_id'],$this->user['cid']);
			$pagevar['units'] = $this->cmpunitsmodel->read_all_units($this->user['cid']);
			if($pagevar['units']):
				for($i=0;$i<count($pagevar['units']);$i++):
					$pagevar['units'][$i]['cu_priceunit'] = $monetary[$pagevar['units'][$i]['cu_priceunit']];
					$pagevar['units'][$i]['cu_unitscode'] = $unitsof[$pagevar['units'][$i]['cu_unitscode']];
				endfor;
				if(count($pagevar['unitgroups']) == 1):
					$pagevar['group'] = $pagevar['unitgroups'][0]['prg_id'];
					$pagevar['unitgroups'] = NULL;
				endif;
			endif;
		endif;
		$pagevar['title'] = $pagevar['company']['cmp_name']	.' - Practice-Book';
		$this->session->set_userdata('region',$this->user['region']);
		$pagevar['regions'] = $this->regionmodel->read_records();
		$this->load->view('company_interface/cpanel',$pagevar);
	}

	function representative_cabinet(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Панель управления компанией',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'representative'=> $this->usersmodel->read_representative($this->user['cid']),
			);
		if($this->input->post('fileupload')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			if(!$this->form_validation->run()):
				$_POST['fileupload'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$photo = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				$this->usersmodel->save_single_data($this->user['uid'],'uphoto',$photo);
				redirect('representative/cabinet/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['representative'] = $this->usersmodel->read_record($this->user['uid']);
		$pagevar['representative']['fullname'] = $pagevar['representative']['uname'].' '.$pagevar['representative']['usubname'].' '.$pagevar['representative']['uthname'];
		$pagevar['representative']['activitypath'] = 'Личный кабинет';
		$this->load->view('company_interface/representative-cabinet',$pagevar);
	}

	function representative_save_profile(){
	
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
									$this->session->set_userdata('login_id',md5($fdata.$this->user['uconfirmation']));
									$this->session->set_userdata('userid',$this->user['uid']);
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
							
			case 'vphones': if(preg_match("/^[0-9\- +\(\),]{6,}$/i",$fdata)):
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
		case 'vposition': 	$this->usersmodel->save_single_data($this->user['uid'],'uposition',strip_tags($fdata));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= strip_tags($fdata);
							break;
		endswitch;
		echo json_encode($statusval);
	}
	
	function profile(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Личный кабинет компании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'cmpregion'		=> $this->regionmodel->read_record($this->user['region']),
					'activity'		=> $this->unionmodel->company_activity($this->user['cid'])
			);
		if($this->input->post('fileupload')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			if(!$this->form_validation->run()):
				$_POST['fileupload'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$photo = $this->resize_img($_FILES['userfile']['tmp_name'],128,128);
				$this->companymodel->save_single_data($this->user['cid'],'cmp_logo',$photo);
				$thumb = $this->resize_img($_FILES['userfile']['tmp_name'],74,74);
				$this->companymodel->save_single_data($this->user['cid'],'cmp_thumb',$thumb);
			endif;
		endif;
		$pagevar['regions'] = $this->regionmodel->read_records();
		$this->load->view('company_interface/cabinet',$pagevar);
	}

	function management(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Управление представителями',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'representative' => $this->usersmodel->read_representatives($this->user['cid']),
					'departments'	=> array()
			);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login','','required|valid_email|callback_login_check|trim');
			$this->form_validation->set_rules('password','','required|min_length[6]|trim');
			$this->form_validation->set_rules('confirmpass','','required|min_length[6]|matches[password]|trim');
			$this->form_validation->set_message('matches','Пароли не совпадают');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('fname','','required|trim');
			$this->form_validation->set_rules('sname','','required|trim');
			$this->form_validation->set_rules('tname','','required|trim');
			$this->form_validation->set_rules('department',' ','required');
			$this->form_validation->set_rules('position','','required|trim');
			$this->form_validation->set_rules('phones','','required|min_length[6]|integer|trim');
			$this->form_validation->set_message('min_length','Меньше 6 символов');
			$this->form_validation->set_message('integer','Только целые числа');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->management();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['photo'] = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				else:
					$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.png');
				endif;
				$_POST['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime());
				$_POST['cmpid'] = $this->user['cid'];
				$_POST['icq'] = $_POST['skype'] = ''; $_POST['priority'] = $_POST['activity'] = 0;
				$_POST['birthday'] = "0000-00-00"; $_POST['manager'] = 0;
				$this->usersmodel->insert_record($_POST);
				$message = 'Для активации аккаунта пройдите по следующей ссылке'.
				"\n".'<a href="'.base_url().'activation/'.$_POST['confirm'].'" target="_blank">'.
				base_url().'activation/'.$_POST['confirm'].'</a>'.
				"\nили скопируйте ссылку в окно ввода адреса браузера и нажмите enter.\n";
				$subject = "Подтверждение регистрации на сайте http://practice-book.ru/";
				if(!$this->sendmail($_POST['login'],$message,$subject,"admin@practice-book.ru")):
					$this->email->print_debugger();
				endif;
				redirect('company/representatives/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['departments'] = $this->departmentsmodel->read_records();
		$this->load->view('company_interface/representatives',$pagevar);
	}
	
	function save_profile(){
		
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при сохранении','retvalue'=>'');
		$fname = trim($this->input->post('id'));
		$fdata = trim($this->input->post('value'));
		if(!isset($fname) or empty($fname)) show_404();
		if($fname == 'vcname' || $fname == 'vemail') if(!isset($fdata) or empty($fdata)) show_404();
		switch ($fname):
			case 'vcname'	: 	$this->companymodel->save_single_data($this->user['cid'],'cmp_name',strip_tags($fdata));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= strip_tags($fdata);
								break;
			case 'producer'	:	$this->companymodel->save_single_data($this->user['cid'],'cmp_producer',$fdata);
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= '';
								break;
			case 'vurface' 	:	$this->companymodel->save_single_data($this->user['cid'],'cmp_urface',strip_tags($fdata));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= strip_tags($fdata);
								break;
			case 'vdescription':$fdata = preg_replace('/\n/','<br>',$fdata);
								$this->companymodel->save_single_data($this->user['cid'],'cmp_description',strip_tags($fdata,'<br>'));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= preg_replace('/<br>/',"\n",strip_tags($fdata,'<br>'));
								break;
			case 'vdetails'	:	$fdata = preg_replace('/\n/','<br>',$fdata);
								$this->companymodel->save_single_data($this->user['cid'],'cmp_details',strip_tags($fdata,'<br>'));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= preg_replace('/<br>/',"\n",strip_tags($fdata,'<br>'));
								break;
			case 'vsite'	:	$this->companymodel->save_single_data($this->user['cid'],'cmp_site',prep_url($fdata));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= prep_url($fdata);
								break;
			case 'vemail'	: 	if(preg_match("/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i",$fdata)):
									if($this->companymodel->company_exist('cmp_email',$fdata)):
										$statusval['status'] 	= FALSE;
										$statusval['message'] 	= 'E-mail уже занят';
										break;
									endif;
									$this->companymodel->save_single_data($this->user['cid'],'cmp_email',$fdata);
									$statusval['status'] 	= TRUE;
									$statusval['retvalue'] 	= $fdata;
								else:
									$statusval['status'] 	= FALSE;
									$statusval['message'] 	= 'Не верный формат E-mail';
								endif;
								break;
							
			case 'vtel'		: 	if(preg_match("/^[0-9\- +\(\),]{6,}$/i",$fdata)):
									$this->companymodel->save_single_data($this->user['cid'],'cmp_phone',strip_tags($fdata));
									$statusval['status'] 	= TRUE;
									$statusval['retvalue'] 	= strip_tags($fdata);
								elseif(empty($fdata)):
									$this->companymodel->save_single_data($this->user['cid'],'cmp_phone','');
									$statusval['status'] 	= TRUE;
									$statusval['retvalue'] 	= '';
								else:
									$statusval['status'] 	= FALSE;
									$statusval['message'] 	= 'Не верный номер телефона';
								endif;
								break;
							
			case 'vtelfax': 	if(preg_match("/^[0-9\- +\(\),]{6,}$/i",$fdata)):
									$this->companymodel->save_single_data($this->user['cid'],'cmp_telfax',strip_tags($fdata));
									$statusval['status'] 	= TRUE;
									$statusval['retvalue'] 	= strip_tags($fdata);
								elseif(empty($fdata)):
									$this->companymodel->save_single_data($this->user['cid'],'cmp_telfax','');
									$statusval['status'] 	= TRUE;
									$statusval['retvalue'] 	= '';
								else:
									$statusval['status'] 	= FALSE;
									$statusval['message'] 	= 'Не верный номер факса';
								endif;
								break;
							
			case 'vadres'	: 	$this->companymodel->save_single_data($this->user['cid'],'cmp_uraddress',strip_tags($fdata));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= strip_tags($fdata);
								break;
			case 'vradres'	: 	$this->companymodel->save_single_data($this->user['cid'],'cmp_realaddress',strip_tags($fdata));
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= strip_tags($fdata);
								break;
		endswitch;
		echo json_encode($statusval);
		
		
	}

	function delele_representatives(){
	
		$statusval = array('status'=>TRUE,'message'=>'Ошибка при удалении');
		$repid = trim($this->input->post('id'));
		if(!$repid) show_404();
		$this->usersmodel->close_user($repid);
		echo json_encode($statusval);
	}

	function news_management(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Управление новостями компании',
					'news'			=> array(),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'name'			=> 'Новости компании',
					'typeavatar'	=> 'cnavatar',
					'cmpactivity'	=> $this->unionmodel->company_activity($this->user['cid'])
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "Оглавление" ','required|trim');
			$this->form_validation->set_rules('description',' "Содержание" ','required|trim');
			$this->form_validation->set_rules('pdatebegin',' "Начальная дата" ','required');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->news_management();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['photo'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],64,48,TRUE);
				else:
					$_POST['photo'] = file_get_contents(base_url().'images/no_photo.jpg');
				endif;
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['pdatebegin'] = preg_replace($pattern,$replacement,$_POST['pdatebegin']);
				if($_POST['pdateend']):
					$_POST['pdateend'] = preg_replace($pattern,$replacement,$_POST['pdateend']);
				else:
					$_POST['pdateend'] = "3000-01-01";
				endif;
				$this->cmpnewsmodel->insert_record($this->user['cid'],$_POST);
				redirect('company/news-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['news'] = $this->cmpnewsmodel->read_allrecords($this->user['cid']);
		for($i = 0;$i < count($pagevar['news']); $i++):
			$pagevar['news'][$i]['id'] = $pagevar['news'][$i]['cn_id'];
			$pagevar['news'][$i]['title'] = $pagevar['news'][$i]['cn_title'];
			$pagevar['news'][$i]['note'] = $pagevar['news'][$i]['cn_note'];
			$pagevar['news'][$i]['pdatebegin'] = $this->operation_date_minus($pagevar['news'][$i]['cn_pdatebegin']);
			$pagevar['news'][$i]['dend'] = $pagevar['news'][$i]['cn_pdateend'];
			$pagevar['news'][$i]['pdateend'] = $this->operation_date_minus($pagevar['news'][$i]['cn_pdateend']);
		endfor;
		$this->load->view('company_interface/news-management',$pagevar);
	}

	function news_save(){
		
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->cmpnewsmodel->save_news($nid,$this->user['cid'],htmlspecialchars($title),strip_tags($note,'<br>'));
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}
	
	function news_delete(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->cmpnewsmodel->delete_record($nid,$this->user['cid']);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function news_extend_day(){
		$statusval = array('status'=>FALSE,'message'=>'Добавить дни не удалось','date'=>'');
		$nid = $this->input->post('id');
		$day = $this->input->post('day');
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($day) or empty($day)) show_404();
		if(!is_numeric($day)) show_404();
		$success = $this->cmpnewsmodel->extend_day($nid,$this->user['cid'],$day);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['date'] = $this->cmpnewsmodel->read_field($nid,$this->user['cid'],'cn_pdateend');
			$statusval['date'] = $this->operation_date_minus($statusval['date']);
		}
		echo json_encode($statusval);
	}

	function shares_management(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Управление новостями компании',
					'news'			=> array(),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'name'			=> 'Акции компании',
					'typeavatar'	=> 'cshavatar',
					'cmpactivity'	=> $this->unionmodel->company_activity($this->user['cid'])
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "Оглавление" ','required|trim');
			$this->form_validation->set_rules('description',' "Содержание" ','required|trim');
			$this->form_validation->set_rules('pdatebegin',' "Начальная дата" ','required');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->news_management();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['photo'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],64,48,TRUE);
				else:
					$_POST['photo'] = file_get_contents(base_url().'images/no_photo.jpg');;
				endif;
				$pattern = "/(\d+)\/(\w+)\/(\d+)/i";
				$replacement = "\$3-\$2-\$1";
				$_POST['pdatebegin'] = preg_replace($pattern,$replacement,$_POST['pdatebegin']);
				if($_POST['pdateend']):
					$_POST['pdateend'] = preg_replace($pattern,$replacement,$_POST['pdateend']);
				else:
					$_POST['pdateend'] = "3000-01-01";
				endif;
				$this->cmpsharesmodel->insert_record($this->user['cid'],$_POST);
				redirect('company/shares-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['news'] = $this->cmpsharesmodel->read_allrecords($this->user['cid']);
		for($i = 0;$i < count($pagevar['news']); $i++):
			$pagevar['news'][$i]['id'] = $pagevar['news'][$i]['sh_id'];
			$pagevar['news'][$i]['title'] = $pagevar['news'][$i]['sh_title'];
			$pagevar['news'][$i]['note'] = $pagevar['news'][$i]['sh_note'];
			$pagevar['news'][$i]['pdatebegin'] = $this->operation_date_minus($pagevar['news'][$i]['sh_pdatebegin']);
			$pagevar['news'][$i]['dend'] = $pagevar['news'][$i]['sh_pdateend'];
			$pagevar['news'][$i]['pdateend'] = $this->operation_date_minus($pagevar['news'][$i]['sh_pdateend']);
			
		endfor;
		$this->load->view('company_interface/shares-management',$pagevar);
	}

	function price_management(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Управление новостями компании',
					'news'			=> array(),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'cmpactivity'	=> $this->unionmodel->company_activity($this->user['cid'])
			);
			
		if($this->input->post('sbmpg')):
			if($_POST['title']):
				$pg = $this->productgroupmodel->group_exist('prg_title',$_POST['title'],$_POST['activityvalue']);
				if(!$pg):
					$this->productgroupmodel->insert_record($_POST['title'],$_POST['activityvalue']);
				endif;
				redirect('company/price-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		if($this->input->post('subsavene')):
			$this->form_validation->set_rules('activity','','required|trim');
			$this->form_validation->set_rules('groupslist','','required|trim');
			$this->form_validation->set_rules('productlist','','required|trim');
			$this->form_validation->set_rules('price','','trim');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['subsave'] = NULL;
				$this->price_management();
				return FALSE;
			else:
				$_POST['subsave'] = NULL;
				$this->cmpunitsmodel->update_noedit_record($_POST['productlist'],$this->user['cid'],$_POST,$_POST['groupslist']);
				redirect('company/price-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		if($this->input->post('subsave')):
			$this->form_validation->set_rules('activity','','required|trim');
			$this->form_validation->set_rules('groupslist','','required|trim');
			$this->form_validation->set_rules('productlist','','required|trim');
			$this->form_validation->set_rules('title','название','required|trim');
			$this->form_validation->set_rules('note','','trim');
			$this->form_validation->set_rules('price','','trim');
			$this->form_validation->set_rules('pricecode','','trim');
			$this->form_validation->set_rules('unitscode','','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['subsave'] = NULL;
				$this->price_management();
				return FALSE;
			else:
				$_POST['subsave'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],90,90,TRUE);
				else:
					$_POST['image'] = "";
				endif;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				
				$this->cmpunitsmodel->update_record($_POST['productlist'],$this->user['cid'],$_POST,$_POST['groupslist']);
				redirect('company/price-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		if($this->input->post('sbmpu')):
			$this->form_validation->set_rules('groupvalue','','required|trim');
			$this->form_validation->set_rules('activityvalue','','required|trim');
			$this->form_validation->set_rules('title','название','required|trim');
			$this->form_validation->set_rules('note','','trim');
			$this->form_validation->set_rules('price','','trim');
			$this->form_validation->set_rules('pricecode','','trim');
			$this->form_validation->set_rules('unitscode','','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['sbmpu'] = NULL;
				$this->price_management();
				return FALSE;
			else:
				if(!$_POST['groupvalue'] || !$_POST['activityvalue']):
					show_error("Отсутствует код гпуппы или код отрасли<br/>Сообщите о возникшей ошибке разработчикам.");
				endif;
				$_POST['sbmpu'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],90,90,TRUE);
				else:
					$_POST['image'] = file_get_contents(base_url().'images/no_photo.jpg');
				endif;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				
				$this->cmpunitsmodel->insert_record($this->user['cid'],$_POST,$_POST['groupvalue']);
				redirect('company/price-management/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['group'] = $this->unionmodel->read_cmpproduct_group($this->user['cid']);
		$this->load->view('company_interface/price-management',$pagevar);
	}

	function products_unit_info(){
	
		$pagevar = array('baseurl'=>base_url(),'units'=> array());
		$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
		$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
		$group = $this->input->post('group');
		if(!$group) show_404();
		$pagevar['units'] = $this->cmpunitsmodel->read_units($group,$this->user['cid']);
		
		for($i=0;$i<count($pagevar['units']);$i++):
			$pagevar['units'][$i]['cu_priceunit'] = $monetary[$pagevar['units'][$i]['cu_priceunit']];
			$pagevar['units'][$i]['cu_unitscode'] = $unitsof[$pagevar['units'][$i]['cu_unitscode']];
			if($pagevar['units'][$i]['cu_unitscode']):
				$pagevar['units'][$i]['cu_priceunit'] .= '/'.$pagevar['units'][$i]['cu_unitscode'];
			endif;
		endfor;
		$this->load->view("company_interface/products-table",$pagevar);
	}

	function shares_save(){
		
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->cmpsharesmodel->save_news($nid,$this->user['cid'],htmlspecialchars($title),strip_tags($note,'<br>'));
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}
	
	function shares_delete(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->cmpsharesmodel->delete_record($nid,$this->user['cid']);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function shares_extend_day(){
	
		$statusval = array('status'=>FALSE,'message'=>'Добавить дни не удалось','date'=>'');
		$sid = $this->input->post('id');
		$day = $this->input->post('day');
		if(!isset($sid) or empty($sid)) show_404();
		if(!isset($day) or empty($day)) show_404();
		if(!is_numeric($day)) show_404();
		$success = $this->cmpsharesmodel->extend_day($sid,$this->user['cid'],$day);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['date'] = $this->cmpsharesmodel->read_field($sid,$this->user['cid'],'sh_pdateend');
			$statusval['date'] = $this->operation_date_minus($statusval['date']);
		}
		echo json_encode($statusval);
	}

	function group_unit_load(){
	
		$activity = $this->input->post('activity');
		if(!isset($activity) or empty($activity)) show_404();
		
		$pagevar = array('groups'=>$this->productgroupmodel->read_records($activity));
		$this->load->view('company_interface/select-group-unit',$pagevar);
	}
	
	function group_cmpunit_load(){
		
		$group = $this->input->post('group');
		if(!isset($group) or empty($group)) show_404();
		$pagevar = array('products'=>$this->cmpunitsmodel->read_units($group,$this->user['cid']));
		$this->load->view('company_interface/select-product-unit',$pagevar);
	}

	function product_cmpunit_form(){
	
		$group = $this->input->post('group');
		$unit = $this->input->post('unit');
		if(!isset($group) or empty($group)) show_404();
		if(!isset($unit) or empty($unit)) show_404();
		$pagevar = array('baseurl'=>base_url(),'unit'=>array());
		$pagevar['unit'] = $this->cmpunitsmodel->read_record($unit,$group);
		if($pagevar['unit']['cu_edit']):
			$this->load->view('company_interface/select-product-form',$pagevar);
		else:
			$this->load->view('company_interface/select-product-noedit',$pagevar);
		endif;
	}

	function product_unit_dalete(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$pgid = trim($this->input->post('group'));
		$puid = trim($this->input->post('unit'));
		if(!isset($pgid) or empty($pgid)) show_404();
		if(!isset($puid) or empty($puid)) show_404();
		$success = $this->cmpunitsmodel->delete_record($puid,$pgid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}
	
	/* --------------------------------------------- business environment ------------------------------------------------------*/
	
	function business(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'activity'		=> $this->unionmodel->company_activity($this->user['cid'])
			);
		
		if($this->input->post('activity')):
			$this->session->set_userdata('activity',$this->input->post('activity'));
			redirect($this->uri->uri_string());
		endif;
		$segm = $this->uri->segment(2);
		$activity = $this->session->userdata('activity');
		if(!$activity && count($pagevar['activity']) > 0):
			$this->session->set_userdata('activity',$pagevar['activity'][0]['act_id']);
			$activity = $pagevar['activity'][0]['act_id'];
		endif;
		if($segm == 'full-business-environment'):
			$pagevar['title'] .= 'Общая бизнес среда';
			$this->session->set_userdata('envirenment','full');
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда';
			$this->session->set_userdata('envirenment','overall');
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/index',$pagevar);
	}
	
	function discussions(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/discussions-index',$pagevar);
	}

	function question_answer(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/question-answer-index',$pagevar);
	}
	
	function rating(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Рейтинг';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Рейтинг';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/rating-index',$pagevar);
	}
	
	function articles(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Статьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Статьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/articles-index',$pagevar);
	}
	
	function documentation(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/documentation-index',$pagevar);
	}
	
	function survey(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Опрос';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Опрос';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/survey-index',$pagevar);
	}
	
	function association(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Объединения для закупок';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Объединения для закупок';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/association-index',$pagevar);
	}
	
	function offers(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/offers-index',$pagevar);
	}
	
	function news(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/news-index',$pagevar);
	}
	
	function discounts(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Новинки и скидки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Новинки и скидки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/discounts-index',$pagevar);
	}
	
	function who_main(){
		
		$envirenment = $this->session->userdata('envirenment');
		if(!$envirenment) $envirenment = 'full';
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'envirenment'	=> $envirenment
			);
		if($envirenment == 'full'):
			$pagevar['title'] .= 'Общая бизнес среда | Кто главный?';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Кто главный?';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/who-main-index',$pagevar);
	}
	
	/* ------------------------------------------ end business environment -----------------------------------------------------*/
	
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

	function userfile_check($file){
		
		$tmpName = $_FILES['userfile']['tmp_name'];
		
		if($_FILES['userfile']['error'] != 4):
			if(!$this->case_image($tmpName)):
				$this->form_validation->set_message('userfile_check','Формат не поддерживается');
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
	
	function resize_avatar($tmpName,$wgt,$hgt,$ratio){
		
		chmod($tmpName,0777);
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$config['image_library'] 	= 'gd2';
		$config['source_image']		= $tmpName; 
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio'] 	= $ratio;
		$config['width'] 			= $wgt;
		$config['height'] 			= $hgt;
				
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		
		return file_get_contents($tmpName);
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

	function login_check($login){
		
		if($this->usersmodel->user_exist('uemail',$login)):
			$this->form_validation->set_message('login_check','Логин уже занят');
			return FALSE;
		endif;
		return TRUE;
	}

	function operation_date($field){
			
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5 $nmonth \$1 г."; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_date_slash($field){
		
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5/\$3/\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}

	function operation_date_minus($field){
		
		$list = preg_split("/-/",$field);
		$nmonth = $this->months[$list[1]];
		$pattern = "/(\d+)(-)(\w+)(-)(\d+)/i";
		$replacement = "\$5-\$3-\$1"; 
		return preg_replace($pattern, $replacement,$field);
	}
}
?>