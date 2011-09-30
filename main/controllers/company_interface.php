<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Company_interface extends CI_Controller{

	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'','region'=>1,'priority'=>0,'department'=>0);
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
		$this->load->model('discussionsmodel');
		$this->load->model('dsctopicsmodel');
		$this->load->model('commentsmodel');
		$this->load->model('questionanswermodel');
		$this->load->model('qatopicsmodel');
		$this->load->model('articlesmodel');
		$this->load->model('arttopicsmodel');
		$this->load->model('interactionmodel');
		$this->load->model('inttopicsmodel');
		$this->load->model('documentationmodel');
		$this->load->model('dtntopicsmodel');
		$this->load->model('doclistmodel');
		$this->load->model('surveymodel');
		$this->load->model('surtopicsmodel');
		$this->load->model('votemodel');
		$this->load->model('assprocmodel');
		$this->load->model('asptopicsmodel');
		$this->load->model('collectedmodel');
		$this->load->model('offerstopicmodel');
		$this->load->model('benewsmodel');
		$this->load->model('bediscountmodel');
		
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
					$this->user['department'] 		= $userinfo['udepartment'];
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
		case 'vachi'	: 	$fdata = preg_replace('/\n{2}/','<br>',trim($fdata));
							$this->usersmodel->save_single_data($this->user['uid'],'uachievement',strip_tags($fdata,'<br>'));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= 'Сохранено';
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
					$_POST['photo'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],74,74,TRUE);
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],64,48,TRUE);
				else:
					$_POST['image'] = file_get_contents(base_url().'images/no_photo.jpg');
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
				$_POST['source'] = '';
//				$_POST['description'] = preg_replace('/\n{2}/','<br>',$_POST['description']);
				$_POST['description'] = nl2br($_POST['description']);
				$this->cmpnewsmodel->insert_record($this->user['cid'],$_POST);
				$this->benewsmodel->insert_record($_POST,$_POST['activity'],0,0,$this->user['uid'],2);
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
			$this->form_validation->set_rules('activity',' "Отрасль" ','required');
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
//				$_POST['description'] = preg_replace('/\n{2}/','<br>',$_POST['description']);
				$_POST['description'] = nl2br($_POST['description']);
				$this->cmpsharesmodel->insert_record($this->user['cid'],$_POST);
				$this->bediscountmodel->insert_record($_POST,$_POST['activity'],0,0,$this->user['uid'],2);
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
					'activity'		=> $this->unionmodel->company_activity($this->user['cid']),
					'actenvironment'=> 0,
					'environment'	=> 0
			);
		
		if($this->input->post('activity')):
			$pagevar['actenvironment'] = $this->activitymodel->read_field($this->input->post('activity'),'act_environment');
			$this->session->set_userdata('activity',$this->input->post('activity'));
			if($this->activitymodel->read_field($this->input->post('activity'),'act_environment')):
				redirect($this->uri->uri_string());
			else:
				redirect('company/full-business-environment/'.$this->user['uconfirmation']);
			endif;
		endif;
		$activity = $this->session->userdata('activity');
		$pagevar['actenvironment'] = $this->activitymodel->read_field($activity,'act_environment');
		if(!$activity && count($pagevar['activity']) > 0):
			$this->session->set_userdata('activity',$pagevar['activity'][0]['act_id']);
			$activity = $pagevar['activity'][0]['act_id'];
			$pagevar['actenvironment'] = $this->activitymodel->read_field($activity,'act_environment');
		endif;
		if($this->uri->segment(2) == 'full-business-environment'):
			$pagevar['title'] .= 'Общая бизнес среда';
			$this->session->set_userdata('environment',0);
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда';
			$this->session->set_userdata('environment',1);
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$pagevar['environment'] = $this->session->userdata('environment');
		$this->load->view('company_interface/business/index',$pagevar);
	}
	
	function create_section(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$segment = $this->uri->segment(2);
		switch ($segment):
			case 'discussions':		$model = 'discussionsmodel';
									$field = 'dsc_';
									$name  = 'Обсуждения';
 									break;
			case 'question-answer': $model = 'questionanswermodel';
									$field = 'qa_';
									$name  = 'Вопрос-ответ';
									break;
			case 'interactions': 	$model = 'interactionmodel';
									$field = 'int_';
									$name  = 'Взаимодействие с Госструктурами';
									break;
			case 'documentation': 	$model = 'documentationmodel';
									$field = 'dtn_';
									$name  = 'Обмен документами';
									break;
			case 'surveys': 		$model = 'surveymodel';
									$field = 'sur_';
									$name  = 'Опрос';
									break;
			case 'articles': 		$model = 'articlesmodel';
									$field = 'art_';
									$name  = 'Cтатьи';
									break;
			case 'associations': 	$model = 'assprocmodel';
									$field = 'asp_';
									$name  = 'Объединения для закупок';
									break;
			default:	redirect($this->session->userdata('backpath'));
		endswitch;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->$model->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> 'Создание темы',
					'backpath'		=> $this->session->userdata('backpath'),
					'type'			=> $segment,
					'field'			=> $field,
					'envname'		=> $name
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название темы','required|trim|max_length[50]|htmlspecialchars|callback_section_check');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_section();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$this->$model->insert_records($_POST['title'],$activity,$environment,$this->user['department']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Создание темы';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Создание темы';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-section',$pagevar);
	}
	
	function section_check($title){
		
		$segment = $this->uri->segment(2);
		switch ($segment):
			case 'discussions': 	$model = 'discussionsmodel';
									break;
			case 'question-answer': $model = 'questionanswermodel';
									break;
			case 'interactions': 	$model = 'interactionmodel';
									break;
			case 'documentation': 	$model = 'documentationmodel'; 
									break;
			case 'surveys': 		$model = 'surveymodel';
									break;
			case 'articles': 		$model = 'articlesmodel';
									break;
			case 'associations': 	$model = 'assprocmodel';
									break;
			default:	redirect($this->session->userdata('backpath'));
		endswitch;
if($this->$model->title_exist($title,$this->session->userdata('activity'),$this->session->userdata('environment'),$this->user['department'])):
			$this->form_validation->set_message('section_check','Тема уже существует!');
			return FALSE;
		endif;
		return TRUE;
	}
	
	function delete_comment(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$topic = $this->uri->segment(5);
		$segment = $this->uri->segment(2);
		switch ($segment):
			case 'discussions':		$link = 'discussions/'.$this->user['uconfirmation'].'/discussion/'.$topic;
									$table = 'dsctopicsmodel';
 									break;
			case 'question-answer': $link = 'question-answer/'.$this->user['uconfirmation'].'/question/'.$topic.'/answers';
									$table = 'qatopicsmodel';
									break;
			case 'interactions': 	$link = 'interactions/'.$this->user['uconfirmation'].'/interaction/'.$topic;
									$table = 'inttopicsmodel';
									break;
			case 'articles': 		$link = 'articles/'.$this->user['uconfirmation'].'/article/'.$topic;
									$table = 'arttopicsmodel';
									break;
			case 'documentation': 	$link = 'documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/comments';
									$table = 'dtntopicsmodel';
									break;
			
			default:	redirect($this->session->userdata('backpath'));
		endswitch;
		$comment = $this->uri->segment(7);
		$this->commentsmodel->delete_record($comment,$this->user['uid']);
		$this->$table->delete_comment($topic);
		redirect('business-environment/'.$link);
	}

		/*============================================= discussion-full ============================================*/
	
	function discussions(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$discussion = $this->discussionsmodel->read_record($activity,$environment,$this->user['department']);
			if(count($discussion)):
				redirect('business-environment/discussions/'.$this->user['uconfirmation'].'/section/'.$discussion['dsc_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->discussionsmodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->discussionsmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->discussionsmodel->read_field($section,'dsc_title'),
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
					
			);
		
		$pagevar['count'] = $this->dsctopicsmodel->count_records($section);

		$config['base_url'] = $pagevar['baseurl'].'business-environment/discussions/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['topics'] = $this->unionmodel->dsc_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['top_date'] = $this->operation_date($pagevar['topics'][$i]['top_date']);
			if(mb_strlen($pagevar['topics'][$i]['top_note'],'UTF-8') > 750):									
				$pagevar['topics'][$i]['top_note'] = mb_substr($pagevar['topics'][$i]['top_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['top_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['top_note'] = mb_substr($pagevar['topics'][$i]['top_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['top_note'] .= '.';
			endif;
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->load->view('company_interface/business/discussions-index',$pagevar);
	}

	function create_discussion(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->discussionsmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->discussionsmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->discussionsmodel->read_field($section,'dsc_title').' - Создание обсуждения',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_section();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->dsctopicsmodel->insert_record($_POST,$section,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-discussion',$pagevar);
	}

	function read_discussion(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->discussionsmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dsctopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'discussion'	=> $this->discussionsmodel->read_records($activity,$environment,$this->user['department']),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'section_name'	=> $this->discussionsmodel->read_field($section,'dsc_title'),
					'topic'			=> $this->unionmodel->dsc_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['top_date'] = $this->operation_date($pagevar['topic']['top_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_discussion();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'discussions',$topic);
				$this->dsctopicsmodel->insert_comment($topic);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_discussion();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'discussions');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/discussions/'.$this->user['uconfirmation'].'/discussion/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"discussions"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-discussion',$pagevar);
	}
	
	function edit_discussion(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->discussionsmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dsctopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->discussionsmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->discussionsmodel->read_field($section,'dsc_title').' - Редактирование обсуждения',
					'backpath'		=> $this->session->userdata('backpath'),
					'topic'			=> $this->unionmodel->dsc_topic_records($topic),
			);
		$pagevar['topic']['top_note'] = preg_replace('/<br>/','',$pagevar['topic']['top_note']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_section();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->dsctopicsmodel->update_record($topic,$_POST,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обсуждения';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-discussion',$pagevar);
	}

	function share_discussion(){
		
	}
	
	function delete_discussion(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->discussionsmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dsctopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		
		$this->commentsmodel->delete_records('discussions',$topic);
		$this->dsctopicsmodel->delete_record($topic,$this->user['uid']);
		redirect($this->session->userdata('backpath'));
	}
	
		/*============================================= question_answer-full ============================================*/
	
	function question_answer(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$questions = $this->questionanswermodel->read_record($activity,$environment,$this->user['department']);
			if(count($questions)):
				redirect('business-environment/question-answer/'.$this->user['uconfirmation'].'/section/'.$questions['qa_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->questionanswermodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->questionanswermodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->questionanswermodel->read_field($section,'qa_title'),
					'question'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
			
		$pagevar['count'] = $this->qatopicsmodel->count_records($section);

	$config['base_url'] = $pagevar['baseurl'].'business-environment/question-answer/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['question'] = $this->unionmodel->qa_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['question']);$i++):
			$pagevar['question'][$i]['qat_date'] = $this->operation_date($pagevar['question'][$i]['qat_date']);
		endfor;
			
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->load->view('company_interface/business/question-answer-index',$pagevar);
	}
	
	function create_question(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->questionanswermodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->questionanswermodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->questionanswermodel->read_field($section,'qa_title').' - Создание вопроса',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_question();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['title'] = preg_replace('/\n{2}/','<br>',$_POST['title']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->qatopicsmodel->insert_records($_POST['title'],$section,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-question',$pagevar);
	}
	
	function read_question(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->questionanswermodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->qatopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->questionanswermodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->questionanswermodel->read_field($section,'qa_title'),
					'question'		=> $this->unionmodel->qa_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['question']['qat_date'] = $this->operation_date($pagevar['question']['qat_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_question();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'question',$topic);
				$this->qatopicsmodel->insert_comment($topic);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_question();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'question');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/question-answer/'.$this->user['uconfirmation'].'/question/'.$topic.'/answers/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"question"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-question',$pagevar);
	}
	
	function edit_question(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->questionanswermodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->qatopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->questionanswermodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->questionanswermodel->read_field($section,'qa_title').' - Редактирование вопроса',
					'backpath'		=> $this->session->userdata('backpath'),
					'topic'			=> $this->unionmodel->qa_topic_records($topic),
			);
		$pagevar['topic']['qat_title'] = preg_replace('/<br>/','',$pagevar['topic']['qat_title']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_section();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['title'] = preg_replace('/\n{2}/','<br>',$_POST['title']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->qatopicsmodel->update_record($topic,$_POST['title'],$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Вопрос-ответ';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-question',$pagevar);
	}

	function share_question(){
		
	}
	
	function delete_question(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->questionanswermodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->qatopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		
		$this->commentsmodel->delete_records('question',$topic);
		$this->qatopicsmodel->delete_record($topic,$this->user['uid']);
		redirect($this->session->userdata('backpath'));
	}
	
	/*================================================ interactions ================================================*/
	
	function interactions(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$discussion = $this->interactionmodel->read_record($activity,$environment,$this->user['department']);
			if(count($discussion)):
				redirect('business-environment/interactions/'.$this->user['uconfirmation'].'/section/'.$discussion['int_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->interactionmodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->interactionmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->interactionmodel->read_field($section,'int_title'),
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
					
			);
		
		$pagevar['count'] = $this->inttopicsmodel->count_records($section);

		$config['base_url'] = $pagevar['baseurl'].'business-environment/interactions/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['topics'] = $this->unionmodel->int_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['itp_date'] = $this->operation_date($pagevar['topics'][$i]['itp_date']);
			if(mb_strlen($pagevar['topics'][$i]['itp_note'],'UTF-8') > 750):									
				$pagevar['topics'][$i]['itp_note'] = mb_substr($pagevar['topics'][$i]['itp_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['itp_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['itp_note'] = mb_substr($pagevar['topics'][$i]['itp_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['itp_note'] .= '.';
			endif;
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->load->view('company_interface/business/interaction-index',$pagevar);
	}
	
	function create_interaction(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->interactionmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->interactionmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->interactionmodel->read_field($section,'int_title').' - Создание взаимодействия',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_interaction();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->inttopicsmodel->insert_record($_POST,$section,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-interaction',$pagevar);
	}

	function read_interaction(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->interactionmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->inttopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->interactionmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->interactionmodel->read_field($section,'int_title'),
					'topic'			=> $this->unionmodel->int_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['itp_date'] = $this->operation_date($pagevar['topic']['itp_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_interaction();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'interactions',$topic);
				$this->inttopicsmodel->insert_comment($topic);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_interaction();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'interactions');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/interactions/'.$this->user['uconfirmation'].'/interaction/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"interactions"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-interaction',$pagevar);
	}
	
	function edit_interaction(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->interactionmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->inttopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->interactionmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->interactionmodel->read_field($section,'int_title').' - Редактирование взаимодействия',
					'backpath'		=> $this->session->userdata('backpath'),
					'topic'			=> $this->unionmodel->int_topic_records($topic),
			);
		$pagevar['topic']['itp_note'] = preg_replace('/<br>/','',$pagevar['topic']['itp_note']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_interaction();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->inttopicsmodel->update_record($topic,$_POST,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Взаимодействие с Госструктурами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-interaction',$pagevar);
	}

	function share_interaction(){
		
	}
	
	function delete_interaction(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->interactionmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->inttopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		
		$this->commentsmodel->delete_records('interactions',$topic);
		$this->inttopicsmodel->delete_record($topic,$this->user['uid']);
		redirect($this->session->userdata('backpath'));
	}
	
	/*============================================= articles ============================================*/
	
	function articles(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$article = $this->articlesmodel->read_record($activity,$environment,$this->user['department']);
			if(count($article)):
				redirect('business-environment/articles/'.$this->user['uconfirmation'].'/section/'.$article['art_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->articlesmodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->articlesmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->articlesmodel->read_field($section,'art_title'),
					'articles'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'bysort'		=> ''
					
			);

		$pagevar['count'] = $this->arttopicsmodel->count_records($section);
		
		if($this->uri->segment(6) == 'sort-views'): 
			$this->session->set_userdata('articles_sort','atp_views');
		elseif($this->uri->segment(6) == 'sort-date'):
			$this->session->set_userdata('articles_sort','atp_date');
		endif;
		$pagevar['bysort'] = $this->session->userdata('articles_sort');
		if(!$pagevar['bysort']) $pagevar['bysort'] = 'atp_date';
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/articles/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['articles'] = $this->unionmodel->articles_limit_records(5,$from,$section,$pagevar['bysort']);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['articles']);$i++):
			$pagevar['articles'][$i]['atp_date'] = $this->operation_date($pagevar['articles'][$i]['atp_date']);
			if(mb_strlen($pagevar['articles'][$i]['atp_note'],'UTF-8') > 750):									
				$pagevar['articles'][$i]['atp_note'] = mb_substr($pagevar['articles'][$i]['atp_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['articles'][$i]['atp_note'],'.',0,'UTF-8');
				$pagevar['articles'][$i]['atp_note'] = mb_substr($pagevar['articles'][$i]['atp_note'],0,$pos,'UTF-8');
				$pagevar['articles'][$i]['atp_note'] .= '.';
			endif;
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->load->view('company_interface/business/articles-index',$pagevar);
	}
	
	function create_article(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->articlesmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->articlesmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->articlesmodel->read_field($section,'art_title').' - Создание статьи',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_article();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->arttopicsmodel->insert_record($_POST,$section,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-article',$pagevar);
	}

	function read_article(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->articlesmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->arttopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->articlesmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->articlesmodel->read_field($section,'art_title'),
					'article'		=> $this->unionmodel->article_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['article']['atp_date'] = $this->operation_date($pagevar['article']['atp_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_article();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'articles',$topic);
				$this->arttopicsmodel->insert_comment($topic);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_article();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'articles');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/articles/'.$this->user['uconfirmation'].'/article/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"articles"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		if($pagevar['article']['atp_usrid'] != $this->user['uid']):
			$this->arttopicsmodel->insert_view($topic);
		endif;
		$this->load->view('company_interface/business/read-article',$pagevar);
	}
	
	function edit_article(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->articlesmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->arttopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->articlesmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->articlesmodel->read_field($section,'art_title').' - Редактирование статьи',
					'backpath'		=> $this->session->userdata('backpath'),
					'topic'			=> $this->unionmodel->article_topic_records($topic),
			);
		$pagevar['topic']['atp_note'] = preg_replace('/<br>/','',$pagevar['topic']['atp_note']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Содержание','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_article();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->arttopicsmodel->update_record($topic,$_POST,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Cтатьи';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-article',$pagevar);
	}

	function share_article(){
		
	}
	
	function delete_article(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->articlesmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->arttopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		
		$this->commentsmodel->delete_records('articles',$topic);
		$this->arttopicsmodel->delete_record($topic,$this->user['uid']);
		redirect($this->session->userdata('backpath'));
	}
	
		/*============================================= documentation ============================================*/
	
	function documentation(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$documentation = $this->documentationmodel->read_record($activity,$environment,$this->user['department']);
			if(count($documentation)):
				redirect('business-environment/documentation/'.$this->user['uconfirmation'].'/section/'.$documentation['dtn_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title'),
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
					
			);
		
		$pagevar['count'] = $this->dtntopicsmodel->count_records($section);

		$config['base_url'] = $pagevar['baseurl'].'business-environment/documentation/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['topics'] = $this->unionmodel->dtn_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['dtt_date'] = $this->operation_date($pagevar['topics'][$i]['dtt_date']);
		endfor;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/documentation-index',$pagevar);
	}

	function create_docquery(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title').' - Создание запроса',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->create_docquery();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['title'] = preg_replace('/\n{2}/','<br>',$_POST['title']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->dtntopicsmodel->insert_record($_POST['title'],$section,$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/create-docquery',$pagevar);
	}
	
	function read_query(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title'),
					'topic'			=> $this->unionmodel->dtn_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['dtt_date'] = $this->operation_date($pagevar['topic']['dtt_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_query();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'documentation',$topic);
				$this->dtntopicsmodel->insert_comment($topic);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_query();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'documentation');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"documentation"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-doc-query',$pagevar);
	}
	
	function edit_query(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title').' - Редактирование запроса',
					'backpath'		=> $this->session->userdata('backpath'),
					'topic'			=> $this->unionmodel->dtn_topic_records($topic),
			);
		$pagevar['topic']['dtt_title'] = preg_replace('/<br>/','',$pagevar['topic']['dtt_title']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_query();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['title'] = preg_replace('/\n{2}/','<br>',$_POST['title']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->dtntopicsmodel->update_record($topic,$_POST['title'],$this->user['uid']);
				redirect($pagevar['backpath']);
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-docquery',$pagevar);
	}
	
	function delete_query(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		
		$this->commentsmodel->delete_records('documentation',$topic);
		$this->dtntopicsmodel->delete_record($topic,$this->user['uid']);
		redirect($this->session->userdata('backpath'));
	}
	
	function upload_document(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title').' - Загрузка документа',
					'backpath'		=> $this->session->userdata('backpath')
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Название','required|trim');
			$this->form_validation->set_rules('userfile','Документ','callback_document_type_check');
			$this->form_validation->set_rules('doctype','','');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->upload_document();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_FILES['userfile']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['userfile']['name']);
				$_POST['link'] = 'documents/business-environment/'.$_FILES['userfile']['name'];
				if(!$this->fileupload('userfile',FALSE)):
					redirect($this->uri->uri_string());
				endif;
				switch ($_POST['doctype']):
					case '1' : $_POST['image'] = file_get_contents(base_url().'images/documents/msword.png'); break;
					case '2' : $_POST['image'] = file_get_contents(base_url().'images/documents/msexcel.png'); break;
					case '3' : $_POST['image'] = file_get_contents(base_url().'images/documents/notepad.png'); break;
					case '4' : $_POST['image'] = file_get_contents(base_url().'images/documents/pdf.png'); break;
				endswitch;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->doclistmodel->insert_record($_POST,$topic,$this->user['uid']);
				$this->dtntopicsmodel->insert_document($topic);
				redirect('business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/documents-list');
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/upload-document',$pagevar);
	}
	
	function read_documents_list(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title'),
					'topic'			=> $this->unionmodel->dtn_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'documents'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['dtt_date'] = $this->operation_date($pagevar['topic']['dtt_date']);
		
		$pagevar['count'] = $this->doclistmodel->count_records($topic);
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/documents-list/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['documents'] = $this->unionmodel->documents_limit_records(5,$from,$topic);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['documents']);$i++):
			$pagevar['documents'][$i]['dls_date'] = $this->operation_date($pagevar['documents'][$i]['dls_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Список документов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Список документов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->session->set_userdata('backpathdoc',$this->uri->uri_string());
		$this->load->view('company_interface/business/read-doc-list',$pagevar);
	}
	
	function edit_doc_info(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$document = $this->uri->segment(7);
		if(!$this->doclistmodel->document_owner($document,$topic,$this->user['uid'])):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title').' - Редактирование документа',
					'backpath'		=> $this->session->userdata('backpathdoc'),
					'document'		=> $this->doclistmodel->read_record($document),
			);
		$pagevar['document']['dls_note'] = preg_replace('/<br>/','',$pagevar['document']['dls_note']);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','Название','required|trim|htmlspecialchars');
			$this->form_validation->set_rules('note','Название','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_doc_info();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_FILES['userfile']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['userfile']['name']);
					$_POST['link'] = 'documents/business-environment/'.$_FILES['userfile']['name'];
					if(!$this->fileupload('userfile',FALSE)):
						redirect($this->uri->uri_string());
					else:
						$filepath = getcwd().'/'.$pagevar['document']['dls_link'];
						$this->filedelete($filepath);
					endif;
					switch ($_POST['doctype']):
						case '1' : $_POST['image'] = file_get_contents(base_url().'images/documents/msword.png'); break;
						case '2' : $_POST['image'] = file_get_contents(base_url().'images/documents/msexcel.png'); break;
						case '3' : $_POST['image'] = file_get_contents(base_url().'images/documents/notepad.png'); break;
						case '4' : $_POST['image'] = file_get_contents(base_url().'images/documents/pdf.png'); break;
					endswitch;
				else:
					$_POST['link'] = NULL;
					$_POST['doctype'] = NULL;
				endif;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
//				$_POST['note'] = nl2br($_POST['note']);
				$this->doclistmodel->update_record($document,$_POST,$topic,$this->user['uid']);
				redirect('business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/documents-list');
			endif;
		endif;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Обмен документами';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/manage/edit-docinfo',$pagevar);
	}
	
	function delete_doc_info(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$document = $this->uri->segment(7);
		if(!$this->doclistmodel->document_owner($document,$topic,$this->user['uid'])):
			show_404();
		endif;
		$this->commentsmodel->delete_records('documentlist',$document);
		$filepath = getcwd().'/'.$this->doclistmodel->read_field($document,'dls_link');
		$this->filedelete($filepath);
		$this->doclistmodel->delete_record($document,$this->user['uid']);
		$this->dtntopicsmodel->delete_document($topic);
		redirect($this->session->userdata('backpathdoc'));
	}
	
	function read_doc_comments(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$docid = $this->uri->segment(7);
		if(!$this->doclistmodel->doc_exist($docid,$topic)):
			show_404();
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'sections'		=> $this->documentationmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->documentationmodel->read_field($section,'dtn_title'),
					'document'		=> $this->unionmodel->dls_document_record($docid),
					'backpath'		=> $this->session->userdata('backpathdoc'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['document']['dls_date'] = $this->operation_date($pagevar['document']['dls_date']);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_doc_comments();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->insert_record($_POST['note'],$this->user['uid'],'documentlist',$docid);
				$this->doclistmodel->insert_comment($docid);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		if($this->input->post('ssubmit')):
			$this->form_validation->set_rules('note','Текст','required|trim');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->read_doc_comments();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->commentsmodel->update_record($_POST['comments'],$_POST['note']);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['count'] = $this->commentsmodel->count_records($docid,'documentlist');
		$config['base_url'] = $pagevar['baseurl'].'business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/document/'.$docid.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 10;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(10));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$docid,'"documentlist"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Список документов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Список документов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-doc-comments-list',$pagevar);
	}
	
	function doc_del_comments(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->documentationmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->dtntopicsmodel->topic_owner($topic,$section,$this->user['uid'])):
			show_404();
		endif;
		$docid = $this->uri->segment(7);
		if(!$this->doclistmodel->doc_exist($docid,$topic)):
			show_404();
		endif;
		$comment = $this->uri->segment(9);
		$this->commentsmodel->delete_record($comment,$this->user['uid']);
		$this->doclistmodel->delete_comment($docid);
		redirect('business-environment/documentation/'.$this->user['uconfirmation'].'/document-query/'.$topic.'/document/'.$docid.'/comments');
	}
	
	function track_query(){
		
	}
	
	function share_query(){
		
	}
	
	function query_add_comment(){
		
	}
	
	function query_edit_comment(){
		
	}
	
	function query_delete_comment(){
		
	}
	
		/*================================================ survey ================================================*/
	
	function surveys(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$surveys = $this->surveymodel->read_record($activity,$environment,$this->user['department']);
			if(count($surveys)):
				redirect('business-environment/surveys/'.$this->user['uconfirmation'].'/section/'.$surveys['sur_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->surveymodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->surveymodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->surveymodel->read_field($section,'sur_title'),
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
					
			);
		
		$pagevar['count'] = $this->surtopicsmodel->count_records($section);

		$config['base_url'] = $pagevar['baseurl'].'business-environment/surveys/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['topics'] = $this->unionmodel->sur_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['stp_date'] = $this->operation_date($pagevar['topics'][$i]['stp_date']);
			$pagevar['topics'][$i]['vote'] = $this->votemodel->read_records($pagevar['topics'][$i]['stp_id']);
		endfor;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Опрос';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Опрос';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/surveys-index',$pagevar);
	}
	
	function vote(){
		
	}
	
	function surveys_create_section(){
		
	}

	function surveys_create_survey(){
		
	}

	function read_survey(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0;
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->surveymodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->surtopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'sections'		=> $this->surveymodel->read_records($activity,$environment,$this->user['department']),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'section_name'	=> $this->surveymodel->read_field($section,'sur_title'),
					'topic'			=> $this->unionmodel->sur_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['stp_date'] = $this->operation_date($pagevar['topic']['stp_date']);
		$pagevar['topic']['vote'] = $this->votemodel->read_records($pagevar['topic']['stp_id']);
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'surveys');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/surveys/'.$this->user['uconfirmation'].'/survey/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"surveys"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Комментарии к опросу';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Комментарии к опросу';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-survey',$pagevar);
	}
	
	function edit_survey(){
		
	}

	function track_survey(){
		
	}
	
	function share_survey(){
		
	}
	
	function delete_survey(){
		
	}
	
	function survey_add_comment(){
		
	}
	
	function survey_edit_comment(){
		
	}
	
	function survey_delete_comment(){
		
	}

		/*================================================ association-full ================================================*/
	
	function association(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->total_segments() == 3):
			$unions = $this->assprocmodel->read_record($activity,$environment,$this->user['department']);
			if(count($unions)):
				redirect('business-environment/associations/'.$this->user['uconfirmation'].'/section/'.$unions['asp_id']);
			endif;
			$section = 0;
		else:
			$section = $this->uri->segment(5);
			if($this->assprocmodel->owner($section,$activity,$environment,$this->user['department'])):
				$this->session->set_userdata('section',$section);
			else:
				show_404();
			endif;
		endif;
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'sections'		=> $this->assprocmodel->read_records($activity,$environment,$this->user['department']),
					'section_name'	=> $this->assprocmodel->read_field($section,'asp_title'),
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
					
			);
		
		$pagevar['count'] = $this->asptopicsmodel->count_records($section);

		$config['base_url'] = $pagevar['baseurl'].'business-environment/associations/'.$this->user['uconfirmation'].'/section/'.$section.'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 7;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(7));
		$pagevar['topics'] = $this->unionmodel->asp_topics_limit_records(5,$from,$section);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['ast_date'] = $this->operation_date($pagevar['topics'][$i]['ast_date']);
			if(mb_strlen($pagevar['topics'][$i]['ast_note'],'UTF-8') > 500):									
				$pagevar['topics'][$i]['ast_note'] = mb_substr($pagevar['topics'][$i]['ast_note'],0,500,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['ast_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['ast_note'] = mb_substr($pagevar['topics'][$i]['ast_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['ast_note'] .= '.';
			endif;
		endfor;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Объединения для закупок';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Объединения для закупок';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/association-index',$pagevar);
	}
	
	function associations_create_section(){
		
	}

	function associations_create_association(){
		
	}

	function read_association(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->assprocmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->asptopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'sections'		=> $this->assprocmodel->read_records($activity,$environment,$this->user['department']),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'section_name'	=> $this->assprocmodel->read_field($section,'asp_title'),
					'topic'			=> $this->unionmodel->asp_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['ast_date'] = $this->operation_date($pagevar['topic']['ast_date']);
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'association');
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/associations/'.$this->user['uconfirmation'].'/association/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"association"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Чтение запроса на закупку';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Чтение запроса на закупку';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-association',$pagevar);
	}
	
	function collected_company(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$section = $this->session->userdata('section');
		if(!$this->assprocmodel->owner($section,$activity,$environment,$this->user['department'])):
			show_404();
		endif;
		$topic = $this->uri->segment(5);
		if(!$this->asptopicsmodel->topic_exist($topic,$section)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'sections'		=> $this->assprocmodel->read_records($activity,$environment,$this->user['department']),
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'section_name'	=> $this->assprocmodel->read_field($section,'asp_title'),
					'topic'			=> $this->unionmodel->asp_topic_records($topic),
					'backpath'		=> $this->session->userdata('backpath'),
					'companylist'	=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['ast_date'] = $this->operation_date($pagevar['topic']['ast_date']);
		
		$pagevar['count'] = $this->collectedmodel->count_records($topic);
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/associations/'.$this->user['uconfirmation'].'/association/'.$topic.'/company/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 10;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['companylist'] = $this->collectedmodel->read_limit_records(10,$from,$topic);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['companylist']);$i++):
			$pagevar['companylist'][$i]['cll_date'] = $this->operation_date($pagevar['companylist'][$i]['cll_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Список участников закупки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Список участников закупки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/collected-company',$pagevar);
	}
	
	function collected_delete_company(){
		
	}
	
	function edit_association(){
		
	}

	function track_association(){
		
	}
	
	function share_association(){
		
	}
	
	function delete_association(){
		
	}
	
	function association_add_comment(){
		
	}
	
	function association_edit_comment(){
		
	}
	
	function association_delete_comment(){
		
	}

		/*================================================ offers-full ================================================*/
		
	function offers(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
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
					'environment'	=> $environment,
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'bysort'		=> ''
					
			);
		
		if($this->uri->segment(4) == 'sort-date'): 
			$this->session->set_userdata('offers_sort','oft_date DESC');
		elseif($this->uri->segment(4) == 'sort-company'):
			$this->session->set_userdata('offers_sort','oft_cmpname ASC');
		endif;
		$pagevar['bysort'] = $this->session->userdata('offers_sort');
		if(!$pagevar['bysort']) $pagevar['bysort'] = 'oft_date DESC';
		
		$pagevar['count'] = $this->offerstopicmodel->count_records($activity,$environment,$this->user['department']);

		$config['base_url'] 		= $pagevar['baseurl'].'business-environment/offers/'.$this->user['uconfirmation'].'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 5;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(5));
$pagevar['topics'] = $this->unionmodel->ofr_topics_limit_records(5,$from,$environment,$this->user['department'],$activity,$pagevar['bysort']);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();

		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['oft_date'] = $this->operation_date($pagevar['topics'][$i]['oft_date']);
			if(mb_strlen($pagevar['topics'][$i]['oft_note'],'UTF-8') > 750):									
				$pagevar['topics'][$i]['oft_note'] = mb_substr($pagevar['topics'][$i]['oft_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['oft_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['oft_note'] = mb_substr($pagevar['topics'][$i]['oft_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['oft_note'] .= '.';
			endif;
		endfor;
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/offers-index',$pagevar);
	}
	
	function read_offer(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		$topic = $this->uri->segment(5);
		if(!$this->offerstopicmodel->topic_exist($topic,$environment,$this->user['department'],$activity)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'topic'			=> $this->unionmodel->oft_topic_record($topic,$environment,$this->user['department'],$activity),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> ''
			);
		$pagevar['topic']['oft_date'] = $this->operation_date($pagevar['topic']['oft_date']);
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,'offers');
		
	$config['base_url'] = $pagevar['baseurl'].'business-environment/offers/'.$this->user['uconfirmation'].'/offer/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"offers"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Чтение предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Чтение предложения контрагентов';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-offer',$pagevar);
	}
	
	function offer_add_comment(){
		
	}
	
	function offer_edit_comment(){
		
	}
	
	function offer_delete_comment(){
		
	}
	
	function create_offer(){
		
	}
	
	function edit_offer(){
		
	}

	function track_offer(){
		
	}
	
	function share_offer(){
		
	}
	
	function delete_offer(){
		
	}

		/*================================================ news-full ================================================*/
	
	function news(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->segment(2) == 'news'):
			redirect('business-environment/activity-news/'.$this->user['uconfirmation']);
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Новости отрасли',
					'type_news'		=> $this->uri->segment(2),
					'bysort'		=> ''
			);
			
		switch ($pagevar['type_news']):
			case 'activity-news': $group = 1; break;
			case 'company-news': $group = 2; $pagevar['section_name'] = 'Новости компании'; break;
		endswitch;
		
		if($this->uri->segment(4) == 'sort-views'): 
			$this->session->set_userdata('news_sort','ben_views');
		elseif($this->uri->segment(4) == 'sort-date'):
			$this->session->set_userdata('news_sort','ben_date');
		endif;
		$pagevar['bysort'] = $this->session->userdata('news_sort');
		if(!$pagevar['bysort']) $pagevar['bysort'] = 'ben_date';
		
		$pagevar['count'] = $this->benewsmodel->count_records($activity,$environment,$this->user['department'],$group);
		
		$config['base_url'] 	= $pagevar['baseurl'].'business-environment/'.$pagevar['type_news'].'/'.$this->user['uconfirmation'].'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 5;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(5));
		$pagevar['topics'] = $this->unionmodel->ben_topics_limit_records(5,$from,$environment,$this->user['department'],$activity,$group,$pagevar['bysort']);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['ben_date'] = $this->operation_date($pagevar['topics'][$i]['ben_date']);
			if(mb_strlen($pagevar['topics'][$i]['ben_note'],'UTF-8') > 750):									
				$pagevar['topics'][$i]['ben_note'] = mb_substr($pagevar['topics'][$i]['ben_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['ben_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['ben_note'] = mb_substr($pagevar['topics'][$i]['ben_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['ben_note'] .= '.';
			endif;
		endfor;
	
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/news-index',$pagevar);
	}
	
	function add_news(){
		
	}

	function read_news(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		switch ($this->uri->segment(2)):
			case 'activity-news': $group = 1; $type = 'activitynews'; break;
			case 'company-news': $group = 2; $type = 'companynews'; break;
		endswitch;
		$topic = $this->uri->segment(5);
		if(!$this->benewsmodel->topic_exist($topic,$environment,$this->user['department'],$activity,$group)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'topic'			=> $this->unionmodel->ben_topic_record($topic,$environment,$this->user['department'],$activity,$group),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Новости отрасли',
					'type_news'		=> $this->uri->segment(2),
			);
		$pagevar['topic']['ben_date'] = $this->operation_date($pagevar['topic']['ben_date']);
		
		if($group == 2) $pagevar['section_name'] = 'Новости компании';
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,$type);
		
	$config['base_url'] = $pagevar['baseurl'].'business-environment/'.$pagevar['type_news'].'/'.$this->user['uconfirmation'].'/news/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"'.$type.'"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Чтение новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Чтение новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-news',$pagevar);
	}
	
	function activity_news_add_comment(){
		
	}
	
	function company_news_add_comment(){
		
	}

	function edit_news(){
		
	}

	function track_news(){
		
	}
	
	function share_news(){
		
	}
	
	function delete_news(){
		
	}
	
	function news_add_comment(){
		
	}
	
	function news_edit_comment(){
		echo 'news_edit_comment';
	}
	
	function news_delete_comment(){
		echo 'news_delete_comment';
	}
	
		/*================================================ discounts-full ================================================*/
	
	function discounts(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->segment(2) == 'discounts'):
			redirect('business-environment/activity-discounts/'.$this->user['uconfirmation']);
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Новинки отрасли',
					'type_discounts'=> $this->uri->segment(2),
					'bysort'		=> ''
			);
			
		switch ($pagevar['type_discounts']):
			case 'activity-discounts': $group = 1; break;
			case 'company-discounts': $group = 2; $pagevar['section_name'] = 'Скидки компаний'; break;
		endswitch;
		
		if($this->uri->segment(4) == 'sort-views'): 
			$this->session->set_userdata('discounts_sort','bed_views');
		elseif($this->uri->segment(4) == 'sort-date'):
			$this->session->set_userdata('discounts_sort','bed_date');
		endif;
		$pagevar['bysort'] = $this->session->userdata('discounts_sort');
		if(!$pagevar['bysort']) $pagevar['bysort'] = 'bed_date';
		
		$pagevar['count'] = $this->bediscountmodel->count_records($activity,$environment,$this->user['department'],$group);
		
		$config['base_url'] 	= $pagevar['baseurl'].'business-environment/'.$pagevar['type_discounts'].'/'.$this->user['uconfirmation'].'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 5;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(5));
		$pagevar['topics'] = $this->unionmodel->bed_topics_limit_records(5,$from,$environment,$this->user['department'],$activity,$group,$pagevar['bysort']);
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['topics']);$i++):
			$pagevar['topics'][$i]['bed_date'] = $this->operation_date($pagevar['topics'][$i]['bed_date']);
			if(mb_strlen($pagevar['topics'][$i]['bed_note'],'UTF-8') > 750):									
				$pagevar['topics'][$i]['bed_note'] = mb_substr($pagevar['topics'][$i]['bed_note'],0,750,'UTF-8');	
				$pos = mb_strrpos($pagevar['topics'][$i]['bed_note'],'.',0,'UTF-8');
				$pagevar['topics'][$i]['bed_note'] = mb_substr($pagevar['topics'][$i]['bed_note'],0,$pos,'UTF-8');
				$pagevar['topics'][$i]['bed_note'] .= '.';
			endif;
		endfor;
	
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Новости';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->set_userdata('backpath',$this->uri->uri_string());
		$this->session->unset_userdata('backpathdoc');
		$this->load->view('company_interface/business/discounts-index',$pagevar);
	}
	
	function add_discount(){
		
	}

	function read_discount(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		switch ($this->uri->segment(2)):
			case 'activity-discounts': $group = 1; $type = 'activitydiscount'; break;
			case 'company-discounts': $group = 2; $type = 'companydiscount'; break;
		endswitch;
		$topic = $this->uri->segment(5);
		if(!$this->bediscountmodel->topic_exist($topic,$environment,$this->user['department'],$activity,$group)):
			show_404();
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'environment'	=> $environment,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'topic'			=> $this->unionmodel->bed_topic_record($topic,$environment,$this->user['department'],$activity,$group),
					'backpath'		=> $this->session->userdata('backpath'),
					'comments'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Новинки отрасли',
					'type_discounts'=> $this->uri->segment(2),
			);
		$pagevar['topic']['bed_date'] = $this->operation_date($pagevar['topic']['bed_date']);
		
		if($group == 2) $pagevar['section_name'] = 'Скидки компаний';
		
		$pagevar['count'] = $this->commentsmodel->count_records($topic,$type);
		
	$config['base_url'] = $pagevar['baseurl'].'business-environment/'.$pagevar['type_discounts'].'/'.$this->user['uconfirmation'].'/discount/'.$topic.'/comments/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 8;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$from = intval($this->uri->segment(8));
		$pagevar['comments'] = $this->unionmodel->topic_comments_limit_records(5,$from,$topic,'"'.$type.'"');
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		for($i=0;$i<count($pagevar['comments']);$i++):
			$pagevar['comments'][$i]['cmn_date'] = $this->operation_date($pagevar['comments'][$i]['cmn_date']);
		endfor;
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Чтение новинки/скидки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Чтение новинки/скидки';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/read-discount',$pagevar);
	}
	
	function activity_discount_add_comment(){
		
	}
	
	function company_discount_add_comment(){
		
	}

	function edit_discount(){
		
	}

	function track_discount(){
		
	}
	
	function share_discount(){
		
	}
	
	function delete_discount(){
		
	}
	
	function discount_add_comment(){
		
	}
	
	function discount_edit_comment(){
		
	}
	
	function discount_delete_comment(){
		
	}
	
		/*================================================ who_main-full ================================================*/
	
	function who_main(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
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
					'environment'	=> $environment,
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Кто главный?',
					'type_rating'	=> $this->uri->segment(2),
					'bysort'		=> ''
			);
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Кто главный?';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Полноценная бизнес среда | Кто главный?';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Полноценная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		$this->load->view('company_interface/business/who-main-index',$pagevar);
	}
	
		/*================================================= rating-full ================================================*/
	
	function rating(){
		
		$environment = $this->session->userdata('environment');
		if(!$environment) $environment = 0; else show_404();
		$activity = $this->session->userdata('activity');
		if(!$activity) show_404();
		if($this->uri->segment(2) == 'rating'):
			redirect('business-environment/rating-representatives/'.$this->user['uconfirmation']);
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - ',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($this->user['cid']),
					'environment'	=> $environment,
					'topics'		=> array(),
					'count'			=> 0,
					'pages'			=> '',
					'section_name'	=> 'Сотрудники',
					'type_rating'	=> $this->uri->segment(2),
					'bysort'		=> ''
			);
		
		if($this->uri->segment(4) == 'sort-rating'): 
			$this->session->set_userdata('rating_sort','rating');
		elseif($this->uri->segment(4) == 'sort-cmpname'):
			$this->session->set_userdata('rating_sort','cmp_name');
		endif;
		$pagevar['bysort'] = $this->session->userdata('rating_sort');
		if(!$pagevar['bysort']) $pagevar['bysort'] = 'rating';
		
		$from = intval($this->uri->segment(5));
		switch ($pagevar['type_rating']):
			case 'rating-representatives':
							if($pagevar['bysort'] == 'rating') $bysort = 'urating';
							else $bysort = 'cmp_name';
							$pagevar['count'] = $this->unionmodel->count_repsentatives($activity);
							$pagevar['topics'] = $this->unionmodel->rating_repsentatives(5,$from,$activity,$bysort);
							break;
			case 'rating-company':
							if($pagevar['bysort'] == 'rating') $bysort = 'cmp_rating';
							else $bysort = 'cmp_name';
							$pagevar['count'] = $this->unionmodel->count_company($activity);
							$pagevar['topics'] = $this->unionmodel->rating_company(5,$from,$activity,$bysort);
							$pagevar['section_name'] = 'Компании';
							break;
		endswitch;
		
		$config['base_url'] = $pagevar['baseurl'].'business-environment/'.$pagevar['type_rating'].'/'.$this->user['uconfirmation'].'/count/';
        $config['total_rows'] 		= $pagevar['count']; 
        $config['per_page'] 		= 5;
        $config['num_links'] 		= 4;
        $config['uri_segment'] 		= 5;
		$config['first_link']		= 'В начало';
		$config['last_link'] 		= 'В конец';
		$config['next_link'] 		= 'Далее &raquo;';
		$config['prev_link'] 		= '&laquo; Назад';
		$config['cur_tag_open']		= '<b>';
		$config['cur_tag_close'] 	= '</b>';
		$this->pagination->initialize($config);
		$pagevar['pages'] = $this->pagination->create_links();
		
		if(!$environment):
			$pagevar['title'] .= 'Общая бизнес среда | Рейтинг';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Общая бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		else:
			$pagevar['title'] .= 'Частная бизнес среда | Рейтинг';
			$pagevar['company']['cmp_name'] = $pagevar['company']['cmp_name'].'<br/>Частная бизнес среда: '.$this->activitymodel->read_field($activity,'act_title');
		endif;
		
		$this->session->unset_userdata('backpathdoc');
		switch ($pagevar['type_rating']):
			case 'rating-representatives':
							$this->load->view('company_interface/business/rating-representatives',$pagevar);
							break;
			case 'rating-company':
							$this->load->view('company_interface/business/rating-company',$pagevar);
							break;
		endswitch;
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
	
	function filedelete($file){
		
		if(is_file($file)):
			@unlink($file);
			return TRUE;
		else:
			return FALSE;
		endif;
	}
	
	function fileupload($userfile,$overwrite){
		
		$this->load->library('upload');
		$config['upload_path'] 		= getcwd().'/documents/business-environment/';
		$config['allowed_types'] 	= 'doc|docx|xls|xlsx|txt|pdf';
		$config['remove_spaces'] 	= TRUE;
		$config['overwrite'] 		= $overwrite;
		$this->upload->initialize($config);
		if(!$this->upload->do_upload($userfile)):
			return FALSE;
		endif;
		return TRUE;
	}
	
	function document_type_check($file){
	
		if($_FILES['userfile']['error'] == 4):
			$this->form_validation->set_message('document_type_check','Не указан файл');
			return FALSE;
		endif;
		/*if($_FILES['userfile']['error'] != 4):
			if(!$this->case_image($tmpName)):
				$this->form_validation->set_message('document_type_check','Формат не поддерживается');
				return FALSE;
			endif;
		endif;*/
		if($_FILES['userfile']['error'] == 1):
			$this->form_validation->set_message('document_type_check','Размер более 5 Мб!');
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