<?php

class manager_interface extends CI_Controller{

	var $user = array('uid'=>0,'cid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'','status'=>TRUE,'activity'=>0,'priority'=>0);
	var $months = array("01"=>"января","02"=>"февраля","03"=>"марта","04"=>"апреля",
						"05"=>"мая","06"=>"июня","07"=>"июля","08"=>"августа",
						"09"=>"сентября","10"=>"октября","11"=>"ноября","12"=>"декабря");
	
	function __construct(){
	
		parent::__construct();
	
		$this->load->model('companymodel');
		$this->load->model('activitymodel');
		$this->load->model('usersmodel');
		$this->load->model('regionmodel');
		$this->load->model('othertextmodel');
		$this->load->model('unionmodel');
		$this->load->model('jobsmodel');
		$this->load->model('manregactmodel');
		$this->load->model('productsmodel');
		$this->load->model('pitfallsmodel');
		$this->load->model('tipsmodel');
		$this->load->model('mraquestionsmodel');
		$this->load->model('activitynewsmodel');
		$this->load->model('personamodel');
		$this->load->model('documentsmodel');
		$this->load->model('specialsmodel');
		$this->load->model('productgroupmodel');
		$this->load->model('productionunitmodel');
		$this->load->model('cmpunitsmodel');
		$this->load->model('consultationmodel');
		$this->load->model('benewsmodel');
		$this->load->model('bediscountmodel');
		
		$cookieuid = $this->session->userdata('login_id');
		if(isset($cookieuid) and !empty($cookieuid)):
			$this->user['uid'] = $this->session->userdata('userid');
			if($this->user['uid']):
				$userinfo = $this->usersmodel->read_info($this->user['uid']);
				if($userinfo):
					$this->user['ufullname']		= $userinfo['uname'].' '.$userinfo['usubname'].' '.$userinfo['uthname'];
					$this->user['ulogin'] 			= $userinfo['uemail'];
					$this->user['uconfirmation'] 	= $userinfo['uconfirmation'];
					$this->user['activity'] 		= $userinfo['uactivity'];
					$this->user['priority'] 		= $userinfo['upriority'];
					if($userinfo['umanager'] == 0):
						redirect("");
					endif;
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

	function register(){
	
		if(!$this->user['priority']) show_404();
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Регистрация менеджера',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'manager' 		=> array()
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login','логин','required|valid_email|callback_login_check|trim');
			$this->form_validation->set_message('valid_email','Укажите правильный адрес');
			$this->form_validation->set_rules('password','пароль','required|min_length[6]|trim');
			$this->form_validation->set_rules('confirmpass','пароль','required|min_length[6]|matches[password]|trim');
			$this->form_validation->set_message('matches','Пароли не совпадают');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('fname','фамилия','required|trim');
			$this->form_validation->set_rules('sname','имя','required|trim');
			$this->form_validation->set_rules('tname','отчество','required|trim');
			$this->form_validation->set_rules('phones','телефон','required|min_length[6]|integer|trim');
			$this->form_validation->set_rules('icq','ICQ','min_length[4]|integer|trim');
			$this->form_validation->set_rules('activity','отрасли','required');
			$this->form_validation->set_rules('region[]','регионы','required');
			$this->form_validation->set_message('integer','Только целые числа');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->register();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['photo'] = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				else:
					$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.png');
				endif;
				$_POST['cmpid'] = $_POST['department'] = 0;
				$_POST['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime());
				$_POST['priority'] = 0;
				$_POST['position'] = '';$_POST['birthday'] = "0000-00-00"; $_POST['manager'] = 1;
				$countnewjob = count($_POST['exp']);
				$joblist = array();
				if($countnewjob > 0):
					for($i = 0,$j = 0; $i < $countnewjob; $i+=4,$j++):
						if(empty($_POST['exp'][$i])) continue;
						$joblist[$j]['jcname'] = $_POST['exp'][$i];
						$joblist[$j]['jposition'] = $_POST['exp'][$i+1];
						$joblist[$j]['jdbegin'] = $_POST['exp'][$i+2].'-01-01';
						$joblist[$j]['jdend'] = ($_POST['exp'][$i+3] === 'н/в') ? '0000-00-00' : $_POST['exp'][$i+3].'-01-01';
					endfor;
				endif;
				$newmanager = $this->usersmodel->insert_record($_POST);
				if(count($joblist)):
					$this->jobsmodel->group_insert($newmanager,$joblist);
				endif;
				for($i = 0;$i < count($_POST['region']);$i++):
					$mraid = $this->manregactmodel->record_exist($_POST['region'][$i],$_POST['activity']);
					if(!$mraid):
						$mraid = $this->manregactmodel->insert_record($newmanager,$_POST['region'][$i],$_POST['activity']);
						$this->productsmodel->insert_empty($mraid);
						$this->personamodel->insert_empty($mraid,$_POST['activity']);
					else:
						$this->manregactmodel->update_managers($newmanager,$_POST['region'][$i],$_POST['activity']);
					endif;
				endfor;
				$this->session->set_userdata('newman_id',$newmanager);
				
				$message = 'Логин - '.$_POST['login']."\n".'Пароль - '.$_POST['password']."\n".'Не забудьте сменить пароль'."\n".'Для активации аккаунта пройдите по следующей ссылке'."\n".'<a href="'.base_url().'activation/'.$_POST['confirm'].'" target="_blank">'.base_url().'activation/'.$_POST['confirm'].'</a>'."\n или скопируйте ссылку в окно ввода адреса браузера и нажмите enter";
				
				if($this->sendmail($_POST['login'],$message,"Подтверждение регистрации на сайте practice-book.ru","admin@practice-book.ru")):
					redirect('managers/cabinet/'.$this->user['uconfirmation']);
				else:
					$this->email->print_debugger();
					exit;
				endif;
			endif;
		endif;
		$pagevar['activity'] = $this->activitymodel->read_records_by_pid($this->user['activity']);
		$pagevar['manager']['activitypath'] = 'Регистрация менеджера';
		$pagevar['regions'] = $this->regionmodel->read_records_by_district();
		$this->load->view('manager_interface/registering',$pagevar);
	}
	
	function set_cpanel(){
	
		$activity = $this->input->post('activity');
		$region = $this->input->post('region');
		$parent_act = $this->activitymodel->read_field($activity,'act_parentid');
		
		if(!isset($activity) or empty($activity)) show_404();
		if(!isset($region) or empty($region)) show_404();
		
		$this->session->set_userdata('activity',$activity);
		$this->session->set_userdata('region',$region);
		$this->session->set_userdata('parent_act',$parent_act);
		redirect('managers/control-panel/'.$this->user['uconfirmation']);
	}
	
	function cpanel(){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> $this->activitymodel->read_field($activity,'act_title').' - Practice-Book',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'othertext'		=> array(),
					'activity'		=> array(),
					'region'		=> array(),
					'pitfalls'		=> array(),
					'questions'		=> array(),
					'product'		=> array(),
					'regions'		=> array(),
					'manager' 		=> array(),
					'othertext'		=> array(),
					'activitynews'	=> array(),
					'company'		=> array(),
					'news'			=> array(),
					'companynews'	=> array(),
					'persona'		=> array(),
					'documents'		=> array(),
					'specials'		=> array(),
					'shares'		=> array(),
					'tips'			=> array(),
					'unitgroups'	=> array(),
					'units'			=> array(),
					'consultlist'	=> array(),
					'group'			=> 0,
					'groupname'		=> '',
					'banner'		=> "",
					'top_rating'	=> 50,
					'low_rating'	=> 20,
					'long_note'		=>FALSE
			);
		$pagevar['manager']['jobs'] = array();
		$pagevar['othertext'] = $this->othertextmodel->read_group(1,21);
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		if(!$mraid):
			$pagevar['manager'] = $this->usersmodel->read_federal($activity);
			if(!$pagevar['manager']):
				$pagevar['manager'] = $this->usersmodel->read_federal($parent);
				if(!$pagevar['manager']):
					$pagevar['manager'] = $this->usersmodel->read_single_federal($activity);
				endif;
			endif;
			$mraid = $this->manregactmodel->insert_record($pagevar['manager']['uid'],$region,$activity);
			$this->productsmodel->insert_empty($mraid);
			$this->personamodel->insert_empty($mraid,$activity);
			$pagevar['pitfalls'] = NULL;
			$pagevar['questions'] = NULL;
			$pagevar['activitynews'] = NULL;
		else:
			$uid = $this->manregactmodel->read_field($mraid,'mra_uid');
			$pagevar['manager'] = $this->usersmodel->read_single_manager_byid($uid,'AND TRUE');
			$pagevar['consultlist'] = $this->consultationmodel->read_records($uid);
			$pagevar['product'] = $this->productsmodel->read_record($mraid);
			$pagevar['product']['full_note'] = $pagevar['product']['pr_note'];
			if(mb_strlen($pagevar['product']['pr_note'],'UTF-8') > 790):									
				$pagevar['product']['pr_note'] = mb_substr($pagevar['product']['pr_note'],0,790,'UTF-8');	
				$pos = mb_strrpos($pagevar['product']['pr_note'],' ',0,'UTF-8');
				$pagevar['product']['pr_note'] = mb_substr($pagevar['product']['pr_note'],0,$pos,'UTF-8');
				$pagevar['product']['pr_note'] .= ' ... ';
			endif;
			$pagevar['persona'] = $this->personamodel->read_record($mraid);
			$pagevar['persona']['full_note'] = $pagevar['persona']['prs_note'];
			if(mb_strlen($pagevar['persona']['prs_note'],'UTF-8') > 350):									
				$pagevar['persona']['prs_note'] = mb_substr($pagevar['persona']['prs_note'],0,350,'UTF-8');	
				$pos = mb_strrpos($pagevar['persona']['prs_note'],' ',0,'UTF-8');
				$pagevar['persona']['prs_note'] = mb_substr($pagevar['persona']['prs_note'],0,$pos,'UTF-8');
				$pagevar['persona']['prs_note'] .= ' ... ';
			endif;
			
//			$pagevar['activitynews'] = $this->activitynewsmodel->read_limit_records($mraid,25);
			$pagevar['activitynews'] = $this->unionmodel->read_activity_news($activity,25);
			for($i = 0;$i < count($pagevar['activitynews']); $i++):
				$pagevar['activitynews'][$i]['full_note'] = $pagevar['activitynews'][$i]['an_note'];
				$pagevar['activitynews'][$i]['an_date'] = $this->operation_date($pagevar['activitynews'][$i]['an_date']);
				if(mb_strlen($pagevar['activitynews'][$i]['an_note'],'UTF-8') > 250):									
					$pagevar['activitynews'][$i]['an_note'] = mb_substr($pagevar['activitynews'][$i]['an_note'],0,250,'UTF-8');	
					$pos = mb_strrpos($pagevar['activitynews'][$i]['an_note'],' ',0,'UTF-8');
					$pagevar['activitynews'][$i]['an_note'] = mb_substr($pagevar['activitynews'][$i]['an_note'],0,$pos,'UTF-8');
					$pagevar['activitynews'][$i]['an_note'] .= ' ... ';
				endif;
			endfor;
			$pagevar['specials'] = $this->specialsmodel->read_limit_records($mraid,25);
			for($i = 0;$i < count($pagevar['specials']); $i++):
				$pagevar['specials'][$i]['full_note'] = $pagevar['specials'][$i]['spc_note'];
				$pagevar['specials'][$i]['spc_date'] = $this->operation_date($pagevar['specials'][$i]['spc_date']);
				if(mb_strlen($pagevar['specials'][$i]['spc_note'],'UTF-8') > 150):									
					$pagevar['specials'][$i]['spc_note'] = mb_substr($pagevar['specials'][$i]['spc_note'],0,150,'UTF-8');	
					$pos = mb_strrpos($pagevar['specials'][$i]['spc_note'],' ',0,'UTF-8');
					$pagevar['specials'][$i]['spc_note'] = mb_substr($pagevar['specials'][$i]['spc_note'],0,$pos,'UTF-8');
					$pagevar['specials'][$i]['spc_note'] .= ' ... ';
				endif;
			endfor;
			$pagevar['banner'] = $this->manregactmodel->read_field($mraid,'mra_banner');
			$pagevar['unitgroups'] = $this->unionmodel->read_product_group($activity,$mraid);
			if($pagevar['unitgroups']):
				$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
				$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
				$pagevar['units'] = $this->productionunitmodel->read_units($pagevar['unitgroups'][0]['prg_id'],$mraid);
				if($pagevar['units']):
					$pagevar['units'][0]['full_note'] = $pagevar['units'][0]['pri_note'];
					if(mb_strlen($pagevar['units'][0]['pri_note'],'UTF-8') > 500):									
						$pagevar['units'][0]['pri_note'] = mb_substr($pagevar['units'][0]['pri_note'],0,500,'UTF-8');	
						$pos = mb_strrpos($pagevar['units'][0]['pri_note'],' ',0,'UTF-8');
						$pagevar['units'][0]['pri_note'] = mb_substr($pagevar['units'][0]['pri_note'],0,$pos,'UTF-8');
						$pagevar['units'][0]['pri_note'] .= ' ... ';
						$pagevar['long_note'] = TRUE;
					endif;
					$pagevar['units'][0]['pri_lowpricecode'] = $monetary[$pagevar['units'][0]['pri_lowpricecode']];
					$pagevar['units'][0]['pri_optimumpricecode'] = $monetary[$pagevar['units'][0]['pri_optimumpricecode']];
					$pagevar['units'][0]['pri_toppricecode'] = $monetary[$pagevar['units'][0]['pri_toppricecode']];
					$pagevar['units'][0]['pri_unitscode'] = $unitsof[$pagevar['units'][0]['pri_unitscode']];
					if(count($pagevar['unitgroups']) == 1):
						$pagevar['group'] = $pagevar['unitgroups'][0]['prg_id'];
						$pagevar['groupname'] = $pagevar['unitgroups'][0]['prg_title'];
						$pagevar['unitgroups'] = NULL;
					endif;
				endif;
			endif;
		endif;
		$pagevar['pitfalls'] = $this->unionmodel->read_pitfalls_limit($activity,25);
		for($i = 0;$i < count($pagevar['pitfalls']); $i++):
			$pagevar['pitfalls'][$i]['full_note'] = $pagevar['pitfalls'][$i]['pf_note'];
			$pagevar['pitfalls'][$i]['pf_date'] = $this->operation_date($pagevar['pitfalls'][$i]['pf_date']);
			if(mb_strlen($pagevar['pitfalls'][$i]['pf_note'],'UTF-8') > 270):									
				$pagevar['pitfalls'][$i]['pf_note'] = mb_substr($pagevar['pitfalls'][$i]['pf_note'],0,270,'UTF-8');	
				$pos = mb_strrpos($pagevar['pitfalls'][$i]['pf_note'],' ',0,'UTF-8');
				$pagevar['pitfalls'][$i]['pf_note'] = mb_substr($pagevar['pitfalls'][$i]['pf_note'],0,$pos,'UTF-8');
				$pagevar['pitfalls'][$i]['pf_note'] .= ' ... ';
			endif;
		endfor;
		$pagevar['tips'] = $this->unionmodel->read_tips_limit($activity,25);
		for($i = 0;$i < count($pagevar['tips']); $i++):
			$pagevar['tips'][$i]['full_note'] = $pagevar['tips'][$i]['tps_note'];
			$pagevar['tips'][$i]['tps_date'] = $this->operation_date($pagevar['tips'][$i]['tps_date']);
			if(mb_strlen($pagevar['tips'][$i]['tps_note'],'UTF-8') > 270):									
				$pagevar['tips'][$i]['tps_note'] = mb_substr($pagevar['tips'][$i]['tps_note'],0,270,'UTF-8');	
				$pos = mb_strrpos($pagevar['tips'][$i]['tps_note'],' ',0,'UTF-8');
				$pagevar['tips'][$i]['tps_note'] = mb_substr($pagevar['tips'][$i]['tps_note'],0,$pos,'UTF-8');
				$pagevar['tips'][$i]['tps_note'] .= ' ... ';
			endif;
		endfor;
		$pagevar['questions'] = $this->unionmodel->read_questions($activity);
		for($i = 0;$i < count($pagevar['questions']); $i++):
			$pagevar['questions'][$i]['full_note'] = $pagevar['questions'][$i]['mraq_note'];
			$pagevar['questions'][$i]['mraq_date'] = $this->operation_date($pagevar['questions'][$i]['mraq_date']);
			if(mb_strlen($pagevar['questions'][$i]['mraq_note'],'UTF-8') > 300):									
				$pagevar['questions'][$i]['mraq_note'] = mb_substr($pagevar['questions'][$i]['mraq_note'],0,300,'UTF-8');	
				$pos = mb_strrpos($pagevar['questions'][$i]['mraq_note'],' ',0,'UTF-8');
				$pagevar['questions'][$i]['mraq_note'] = mb_substr($pagevar['questions'][$i]['mraq_note'],0,$pos,'UTF-8');
				$pagevar['questions'][$i]['mraq_note'] .= ' ... ';
			endif;
		endfor;
		$pagevar['company']['all'] = $this->unionmodel->select_company_by_region($activity,$region);
		for($i=0;$i<count($pagevar['company']['all']);$i++):
			$pagevar['company']['all'][$i]['cmp_graph'] = $pagevar['company']['all'][$i]['cmp_rating'];
			if($pagevar['company']['all'][$i]['cmp_rating'] > 75):
				$pagevar['company']['all'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['company']['all'][$i]['full_description'] = $pagevar['company']['all'][$i]['cmp_description'];
			if(mb_strlen($pagevar['company']['all'][$i]['cmp_description'],'UTF-8') > 180):
				$pagevar['company']['all'][$i]['cmp_description'] = mb_substr($pagevar['company']['all'][$i]['cmp_description'],0,180,'UTF-8');
				$pos = mb_strrpos($pagevar['company']['all'][$i]['cmp_description'],' ',0,'UTF-8');
				$pagevar['company']['all'][$i]['cmp_description'] =mb_substr($pagevar['company']['all'][$i]['cmp_description'],0,$pos,'UTF-8');
				$pagevar['company']['all'][$i]['cmp_description'] .= ' ... ';
			endif;
		endfor;
		$pagevar['company']['trustee'] = $this->unionmodel->select_company_by_rating($activity,$region,'>=',$pagevar['top_rating'],0);
		for($i=0;$i<count($pagevar['company']['trustee']);$i++):
			$pagevar['company']['trustee'][$i]['cmp_graph'] = $pagevar['company']['trustee'][$i]['cmp_rating'];
			if($pagevar['company']['trustee'][$i]['cmp_rating'] > 75):
				$pagevar['company']['trustee'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['company']['trustee'][$i]['full_description'] = $pagevar['company']['trustee'][$i]['cmp_description'];
			if(mb_strlen($pagevar['company']['trustee'][$i]['cmp_description'],'UTF-8') > 180):
		$pagevar['company']['trustee'][$i]['cmp_description'] = mb_substr($pagevar['company']['trustee'][$i]['cmp_description'],0,180,'UTF-8');
				$pos = mb_strrpos($pagevar['company']['all'][$i]['cmp_description'],' ',0,'UTF-8');
		$pagevar['company']['trustee'][$i]['cmp_description'] =mb_substr($pagevar['company']['trustee'][$i]['cmp_description'],0,$pos,'UTF-8');
				$pagevar['company']['trustee'][$i]['cmp_description'] .= ' ... ';
			endif;
		endfor;
		$pagevar['company']['blacklist'] = $this->unionmodel->select_company_by_rating($activity,$region,'<=',$pagevar['low_rating'],180);
		for($i=0;$i<count($pagevar['company']['blacklist']);$i++):
			$pagevar['company']['blacklist'][$i]['cmp_graph'] = $pagevar['company']['blacklist'][$i]['cmp_rating'];
			if($pagevar['company']['blacklist'][$i]['cmp_rating'] > 75):
				$pagevar['company']['blacklist'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['company']['blacklist'][$i]['full_description'] = $pagevar['company']['blacklist'][$i]['cmp_description'];
			if(mb_strlen($pagevar['company']['blacklist'][$i]['cmp_description'],'UTF-8') > 180):
	$pagevar['company']['blacklist'][$i]['cmp_description'] = mb_substr($pagevar['company']['blacklist'][$i]['cmp_description'],0,180,'UTF-8');
				$pos = mb_strrpos($pagevar['company']['all'][$i]['cmp_description'],' ',0,'UTF-8');
	$pagevar['company']['blacklist'][$i]['cmp_description'] =mb_substr($pagevar['company']['blacklist'][$i]['cmp_description'],0,$pos,'UTF-8');
				$pagevar['company']['blacklist'][$i]['cmp_description'] .= ' ... ';
			endif;
		endfor;
		$pagevar['companynews'] = $this->unionmodel->read_cmpnews_by_activity($activity,$region);
		for($i = 0;$i<count($pagevar['companynews']); $i++):
			$pagevar['companynews'][$i]['cmp_graph'] = $pagevar['companynews'][$i]['cmp_rating'];
			if($pagevar['companynews'][$i]['cmp_rating'] > 75):
				$pagevar['companynews'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['companynews'][$i]['full_note'] = $pagevar['companynews'][$i]['cn_note'];
			$pagevar['companynews'][$i]['cn_pdatebegin'] = $this->operation_date($pagevar['companynews'][$i]['cn_pdatebegin']);
			if(mb_strlen($pagevar['companynews'][$i]['cn_note'],'UTF-8') > 250):									
				$pagevar['companynews'][$i]['cn_note'] = mb_substr($pagevar['companynews'][$i]['cn_note'],0,250,'UTF-8');	
				$pos = mb_strrpos($pagevar['companynews'][$i]['cn_note'],' ',0,'UTF-8');
				$pagevar['companynews'][$i]['cn_note'] = mb_substr($pagevar['companynews'][$i]['cn_note'],0,$pos,'UTF-8');
				$pagevar['companynews'][$i]['cn_note'] .= ' ... ';
			endif;
		endfor;
		
		$pagevar['shares'] = $this->unionmodel->read_cmpshares_by_activity($activity,$region);
		for($i = 0;$i<count($pagevar['shares']); $i++):
			$pagevar['shares'][$i]['cmp_graph'] = $pagevar['shares'][$i]['cmp_rating'];
			if($pagevar['shares'][$i]['cmp_rating'] > 75):
				$pagevar['shares'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['shares'][$i]['full_note'] = $pagevar['shares'][$i]['sh_note'];
			$pagevar['shares'][$i]['sh_pdatebegin'] = $this->operation_date($pagevar['shares'][$i]['sh_pdatebegin']);
			if(mb_strlen($pagevar['shares'][$i]['sh_note'],'UTF-8') > 150):									
				$pagevar['shares'][$i]['sh_note'] = mb_substr($pagevar['shares'][$i]['sh_note'],0,150,'UTF-8');	
				$pos = mb_strrpos($pagevar['shares'][$i]['sh_note'],' ',0,'UTF-8');
				$pagevar['shares'][$i]['sh_note'] = mb_substr($pagevar['shares'][$i]['sh_note'],0,$pos,'UTF-8');
				$pagevar['shares'][$i]['sh_note'] .= ' ... ';
			endif;
		endfor;
		$pagevar['documents'] = $this->unionmodel->read_documents($activity);
		$pagevar['manager']['jobs'] = $this->jobsmodel->read_records_year($pagevar['manager']['uid'],2);
		$pagevar['manager']['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['manager']['uid'],$activity,$region);
		if($this->user['priority']):
			$pagevar['regions'] = $this->regionmodel->read_records();
		else:
			$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
		endif;
		$activity = $this->activitymodel->read_records();
		if(count($activity) > 0):
			for($i = 0; $i < count($activity); $i++):
				$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
			endfor;
		endif;
		$mas = array();
		$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
		$pagevar['activity'] = $mas;
		if(!$pagevar['activity']) $pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
		$this->load->view('manager_interface/cpanel',$pagevar);
	}
	
	function profile(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Личный кабинет менеджера',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'manager' 		=> array(),
					'regstatus'		=> FALSE
			);
		$pagevar['manager']['jobs'] = array();
		if($this->input->post('fileupload')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			if(!$this->form_validation->run()):
				$_POST['fileupload'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$photo = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				$this->usersmodel->save_single_data($this->user['uid'],'uphoto',$photo);
				redirect($this->uri->uri_string());
			endif;
		endif;
		$pagevar['manager'] = $this->usersmodel->read_record($this->user['uid']);
		$pagevar['manager']['fullname'] = $pagevar['manager']['uname'].' '.$pagevar['manager']['usubname'].' '.$pagevar['manager']['uthname'];
		$pagevar['manager']['jobs'] = $this->jobsmodel->read_records_year($this->user['uid'],0);
		$pagevar['manager']['activitypath'] = 'Личный кабинет';
		if($this->user['priority']):
			$pagevar['regions'] = $this->regionmodel->read_records();
		else:
			$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
		endif;
		$activity = $this->activitymodel->read_records();
		if(count($activity) > 0):
			for($i = 0; $i < count($activity); $i++):
				$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
			endfor;
		endif;
		$mas = array();
		$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
		$pagevar['activity'] = $mas;
		if(!$pagevar['activity']) $pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
		$pagevar['manager']['activity'] = $this->activitymodel->read_field($this->user['activity'],'act_fulltitle');
		$newmanager = $this->session->userdata('newman_id');
		if($newmanager):
			$pagevar['regstatus'] = TRUE;
			$newmaninfo = $this->usersmodel->read_info($newmanager);
			$pagevar['managerFullName'] = $newmaninfo['uname'].' '.$newmaninfo['usubname'].' '.$newmaninfo['uthname'];
			$pagevar['email'] = $newmaninfo['uemail'];
			$this->session->unset_userdata('newman_id');
		endif;
		$this->load->view('manager_interface/cabinet',$pagevar);
	}

	function region_info(){
		$statusval = array('retvalue'=>'Ошибка. Не возможно получить данные');
		$rid = $this->input->post('rid');
		if(!isset($rid) or empty($rid)) show_404();
		$rinfo = $this->regionmodel->full_name($rid);
		if($rinfo):
			$statusval['retvalue'] = $rinfo['reg_area']." (".$rinfo['reg_district'].")";
		endif;
		echo json_encode($statusval);
	}

	/* ======================================== EDIT CONTROL PANEL =============================================*/
	
	function edit_product($error = FALSE){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'product'		=> array(),
					'manager'		=> array(),
					'valid'			=> $error,
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','названия','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('note','описания','required|trim');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_product(TRUE);
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],90,90,TRUE);
				else:
					$_POST['image'] = '';
				endif;
//				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				if($this->user['priority'] && isset($_POST['all'])):
					if(!$_POST['image']):
						$mraid = $this->manregactmodel->record_exist($region,$activity);
						$product = $this->productsmodel->record_exist($mraid);
						$_POST['image'] = $this->productsmodel->get_image($product);
					endif;
					$this->unionmodel->update_product($activity,$_POST);
					redirect($pagevar['backpath']);
				endif;
				$mraid = $this->manregactmodel->record_exist($region,$activity);
				if($mraid):
					$this->productsmodel->update_record($mraid,$_POST);
					redirect($pagevar['backpath']);
				else:
		show_error("Отсутствует запись в БД!<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
				endif;
			endif;
		endif;
		$pagevar['manager']['activitypath'] = "Редактирование продукта";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$product = $this->productsmodel->record_exist($mraid);
		if(!$product):
			$product = $this->productsmodel->insert_empty($mraid);
		endif;
		$pagevar['product'] = $this->productsmodel->read_record_byid($product);
//		$pagevar['product']['pr_note'] = strip_tags($pagevar['product']['pr_note']);
		$this->load->view('manager_interface/product-edit',$pagevar);
	}
	
	function edit_pitfalls(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'pitfalls'		=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['manager']['activitypath'] = "Подводные камни";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar['pitfalls'] = $this->pitfallsmodel->read_records($mraid);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "оглавление" ','required|trim');
			$this->form_validation->set_rules('note',' "содержание" ','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_pitfalls();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->pitfallsmodel->insert_record($mraid,$_POST);
				redirect('managers/edit-pitfalls/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		$this->load->view('manager_interface/pitfalls-edit',$pagevar);
	}

	function delete_pitfalls(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->pitfallsmodel->delete_record($nid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_pitfalls(){
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->pitfallsmodel->save_pitfalls($nid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_questions(){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'questions'		=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['manager']['activitypath'] = "Вопросы по отрасли";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar['questions'] = $this->mraquestionsmodel->read_records($mraid);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "вопрос" ','required|trim');
			$this->form_validation->set_rules('note',' "ответ" ','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_questions();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->mraquestionsmodel->insert_answer($mraid,$_POST);
				redirect('managers/edit-questions/'.$this->user['uconfirmation']);
			endif;
		endif;
		$this->load->view('manager_interface/questions-edit',$pagevar);
	}

	function delete_question(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->mraquestionsmodel->delete_record($nid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_question(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		$priority = $this->input->post('priority');
		if(!isset($priority)) $priority = 0;
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->mraquestionsmodel->save_question($nid,$title,$note,$priority);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_tips(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'tips'			=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['manager']['activitypath'] = "Советы";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar['tips'] = $this->tipsmodel->read_records($mraid);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "оглавление" ','required|trim');
			$this->form_validation->set_rules('note',' "содержание" ','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_tips();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->tipsmodel->insert_record($mraid,$_POST);
				redirect('managers/edit-tips/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		$this->load->view('manager_interface/tips-edit',$pagevar);
	}

	function delete_tips(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->tipsmodel->delete_record($nid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_tips(){
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->tipsmodel->save_tips($nid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_news(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'news'			=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		$pagevar['manager']['activitypath'] = "Новости отрасли";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar['news'] = $this->activitynewsmodel->read_records($mraid);
		for($i = 0;$i < count($pagevar['news']); $i++):
			$pagevar['news'][$i]['an_date'] = $this->operation_date($pagevar['news'][$i]['an_date']);
		endfor;
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "название" ','required|trim');
			$this->form_validation->set_rules('source',' "источник" ','prep_url|trim');
			$this->form_validation->set_rules('note',' "описание" ','required|trim');
			$this->form_validation->set_rules('date',' "дата" ','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_news();
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
				$_POST['date'] = preg_replace($pattern,$replacement,$_POST['date']);
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->activitynewsmodel->insert_record($mraid,$_POST);
				$this->benewsmodel->insert_record($_POST,$activity,0,0,0,1);
				redirect('managers/edit-news/'.$this->user['uconfirmation']);
			endif;
		endif;
		$this->load->view('manager_interface/news-edit',$pagevar);
	}

	function delete_news(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->activitynewsmodel->delete_record($nid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_news(){
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->activitynewsmodel->save_news($nid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_persona($error = FALSE){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'persona'		=> array(),
					'manager'		=> array(),
					'valid'			=> $error,
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','заголовок','required|trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_rules('note','описания','required|trim');
			$this->form_validation->set_rules('source','источник','prep_url|trim');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_persona(TRUE);
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],64,64,TRUE);
				else:
					$_POST['image'] = '';
				endif;
//				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				if($this->user['priority'] && isset($_POST['all'])):
					if(!$_POST['image']):
						$mraid = $this->manregactmodel->record_exist($region,$activity);
						$pid = $this->personamodel->record_exist($mraid);
						$_POST['image'] = $this->personamodel->get_image($pid);
					endif;
					$this->personamodel->save_persons($activity,$_POST);
					redirect('managers/control-panel/'.$this->user['uconfirmation']);
				endif;
				$mraid = $this->manregactmodel->record_exist($region,$activity);
				if($mraid):
					$this->personamodel->update_record($mraid,$activity,$_POST);
					redirect('managers/control-panel/'.$this->user['uconfirmation']);
				else:
		show_error("Отсутствует запись в БД!<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
				endif;
			endif;
		endif;
		$pagevar['manager']['activitypath'] = "Редактирование персоны";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$persona = $this->personamodel->record_exist($mraid);
		if(!$persona):
			$product = $this->personamodel->insert_empty($mraid);
		endif;
		$pagevar['persona'] = $this->personamodel->read_record_byid($persona);
//		$pagevar['persona']['prs_note'] = strip_tags($pagevar['persona']['prs_note']);
		$this->load->view('manager_interface/persona-edit',$pagevar);
		
	}

	function edit_documents(){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'documents'		=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['manager']['activitypath'] = "Документооборот";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
//		$pagevar['documents'] = $this->documentsmodel->read_records($mraid);
		$pagevar['documents'] = $this->unionmodel->read_documents($activity);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' название ','required|trim');
			$this->form_validation->set_rules('note',' описание ','required|trim');
			$this->form_validation->set_rules('userfile',' документ ','callback_document_type_check');
			$this->form_validation->set_rules('doctype','','');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_documents();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_FILES['userfile']['name'] = preg_replace('/.+(.)(\.)+/',date("Ymdhis")."\$2", $_FILES['userfile']['name']);
				$_POST['link'] = 'documents/'.$_FILES['userfile']['name'];
				if(!$this->fileupload('userfile',FALSE)):
					redirect('managers/edit-documents/'.$this->user['uconfirmation']);
				endif;
				switch ($_POST['doctype']):
					case '1' : $_POST['image'] = file_get_contents(base_url().'images/documents/msword.png'); break;
					case '2' : $_POST['image'] = file_get_contents(base_url().'images/documents/msexcel.png'); break;
					case '3' : $_POST['image'] = file_get_contents(base_url().'images/documents/notepad.png'); break;
					case '4' : $_POST['image'] = file_get_contents(base_url().'images/documents/pdf.png'); break;
				endswitch;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->documentsmodel->insert_record($mraid,$_POST);
				redirect('managers/edit-documents/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		$this->load->view('manager_interface/documents-edit',$pagevar);
	}

	function delete_document(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$docid = trim($this->input->post('id'));
		if(!isset($docid) or empty($docid)) show_404();
		$filepath = getcwd().'/'.$this->documentsmodel->read_field($docid,'doc_link');
		if(!$this->filedelete($filepath)):
			$statusval['status'] = FALSE;
			$statusval['message'] .= ". Отсутствует файл";
			echo json_encode($statusval);
			return FALSE;
		endif;
		$success = $this->documentsmodel->delete_record($docid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_document(){
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$docid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($docid) or empty($docid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->documentsmodel->save_document($docid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_specials(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'specials'		=> array(),
					'manager'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		$pagevar['manager']['activitypath'] = "Новинки отрасли";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar['specials'] = $this->specialsmodel->read_records($mraid);
		for($i = 0;$i < count($pagevar['specials']); $i++):
			$pagevar['specials'][$i]['spc_date'] = $this->operation_date($pagevar['specials'][$i]['spc_date']);
		endfor;

		if($this->input->post('submit')):
			$this->form_validation->set_rules('title',' "название" ','required|trim');
			$this->form_validation->set_rules('source',' "источник" ','prep_url|trim');
			$this->form_validation->set_rules('note',' "описание" ','required|trim');
			$this->form_validation->set_rules('date',' "дата" ','required|trim');
			$this->form_validation->set_error_delimiters('<div class="flvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->edit_specials();
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
				$_POST['date'] = preg_replace($pattern,$replacement,$_POST['date']);
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->specialsmodel->insert_record($mraid,$_POST);
				$this->bediscountmodel->insert_record($_POST,$activity,0,0,0,1);
				redirect('managers/edit-specials/'.$this->user['uconfirmation']);
			endif;
		endif;
		$this->load->view('manager_interface/specials-edit',$pagevar);
	}
	
	function delete_specials(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$nid = trim($this->input->post('id'));
		if(!isset($nid) or empty($nid)) show_404();
		$success = $this->specialsmodel->delete_record($nid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}
	
	function save_specials(){
	
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','desc'=>'');
		$nid = $this->input->post('id');
		$title = nl2br(trim($this->input->post('title')));
		$note = nl2br(trim($this->input->post('desc')));
		if(!isset($nid) or empty($nid)) show_404();
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		$success = $this->specialsmodel->save_news($nid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}

	function edit_whomain(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'banner'		=> "",
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['manager']['activitypath'] = "Кто-главный";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		if($this->input->post('submit')):
			if($this->user['priority'] && isset($_POST['all'])):
				$this->manregactmodel->save_banners($activity,$_POST['banner']);
				redirect('managers/control-panel/'.$this->user['uconfirmation']);
			endif;
			$this->manregactmodel->save_banner($mraid,$_POST['banner']);
			redirect('managers/control-panel/'.$this->user['uconfirmation']);
		endif;
		$pagevar['banner'] = $this->manregactmodel->read_field($mraid,'mra_banner');
		$this->load->view('manager_interface/edit-banner',$pagevar);
	}

	function edit_coordinator(){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Редактирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'group'			=> array(),
					'products'		=> array()
			);
		
		$pagevar['manager']['activitypath'] = "Прайс-координатор";
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		if($this->input->post('sbmpg')):
			if($_POST['title']):
				$pg = $this->productgroupmodel->group_exist('prg_title',$_POST['title'],$activity);
				if(!$pg):
					$this->productgroupmodel->insert_record($_POST['title'],$activity);
				endif;
				redirect('managers/edit-coordinator/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		if($this->input->post('subsave')):
			$this->form_validation->set_rules('grouplist','','required|trim');
			$this->form_validation->set_rules('productlist','','required|trim');
			$this->form_validation->set_rules('title','название','required|trim');
			$this->form_validation->set_rules('note','','trim');
			$this->form_validation->set_rules('lowprice','','trim');
			$this->form_validation->set_rules('lowpricecode','','trim');
			$this->form_validation->set_rules('optimumprice','','trim');
			$this->form_validation->set_rules('optimumpricecode','','trim');
			$this->form_validation->set_rules('topprice','','trim');
			$this->form_validation->set_rules('toppricecode','','trim');
			$this->form_validation->set_rules('unitscode','','trim');
			$this->form_validation->set_rules('riskslowprice','','trim');
			$this->form_validation->set_rules('advantages','','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['subsave'] = NULL;
				$this->edit_coordinator();
				return FALSE;
			else:
				$_POST['subsave'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],90,90,TRUE);
				else:
					$_POST['image'] = "";
				endif;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$_POST['riskslowprice'] = preg_replace('/\n{2}/','<br>',$_POST['riskslowprice']);
				$_POST['advantages'] = preg_replace('/\n{2}/','<br>',$_POST['advantages']);
				
				$this->productionunitmodel->update_record($_POST['productlist'],$mraid,$_POST,$_POST['grouplist']);
				redirect('managers/edit-coordinator/'.$this->user['uconfirmation']);
			endif;
		endif;
		
		if($this->input->post('sbmpu')):
			$this->form_validation->set_rules('groupvalue','','required|trim');
			$this->form_validation->set_rules('title','название','required|trim');
			$this->form_validation->set_rules('note','','trim');
			$this->form_validation->set_rules('lowprice','','trim');
			$this->form_validation->set_rules('lowpricecode','','trim');
			$this->form_validation->set_rules('optimumprice','','trim');
			$this->form_validation->set_rules('optimumpricecode','','trim');
			$this->form_validation->set_rules('topprice','','trim');
			$this->form_validation->set_rules('toppricecode','','trim');
			$this->form_validation->set_rules('unitscode','','trim');
			$this->form_validation->set_rules('riskslowprice','','trim');
			$this->form_validation->set_rules('advantages','','trim');
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['sbmpu'] = NULL;
				$this->edit_coordinator();
				return FALSE;
			else:
				if(!$_POST['groupvalue']):
		show_error("Отсутствует код гпуппы<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
				endif;
				$_POST['sbmpu'] = NULL;
				if($_FILES['userfile']['error'] != 4):
					$_POST['image'] = $this->resize_avatar($_FILES['userfile']['tmp_name'],90,90,TRUE);
				else:
					$_POST['image'] = file_get_contents(base_url().'images/no_photo.jpg');
				endif;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$_POST['riskslowprice'] = preg_replace('/\n{2}/','<br>',$_POST['riskslowprice']);
				$_POST['advantages'] = preg_replace('/\n{2}/','<br>',$_POST['advantages']);
				
				$cmplist = $this->unionmodel->select_company_by_region($activity,$region);
				for($i=0;$i<count($cmplist);$i++):
					$cmpunit = $this->cmpunitsmodel->unit_exist($cmplist[$i]['cmp_id'],$_POST['groupvalue'],$_POST['title']);
					if(!$cmpunit):
						$this->cmpunitsmodel->insert_empty($cmplist[$i]['cmp_id'],$_POST,$_POST['groupvalue']);
					endif;
				endfor;
				$this->productionunitmodel->insert_record($mraid,$_POST,$_POST['groupvalue']);
				redirect('managers/edit-coordinator/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['group'] = $this->productgroupmodel->read_records($activity);
		$this->load->view('manager_interface/price-coordinator/edit-coordinator',$pagevar);
	}
	
	function product_unit_dalete(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$pgid = trim($this->input->post('group'));
		$puid = trim($this->input->post('unit'));
		if(!isset($pgid) or empty($pgid)) show_404();
		if(!isset($puid) or empty($puid)) show_404();
		$success = $this->productionunitmodel->delete_record($puid,$pgid);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}
	
	function consultation(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Консультирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'consult'		=> array(),
					'close_consult'	=> 0
			);
		$pagevar['manager']['activitypath'] = "Консультирование";
		if($this->input->post('submit')):
			$this->form_validation->set_rules('title','','required|trim');
			$this->form_validation->set_rules('note','','trim|strip_tags');
			$this->form_validation->set_rules('price','','trim');
			$this->form_validation->set_rules('period','','trim');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->consultation();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$_POST['note'] = preg_replace('/\n{2}/','<br>',$_POST['note']);
				$this->consultationmodel->insert_record($this->user['uid'],$_POST);
				redirect('managers/consultation/'.$this->user['uconfirmation']);
			endif;
		endif;
		$pagevar['consult'] = $this->consultationmodel->read_records($this->user['uid']);
		$pagevar['close_consult'] = $this->usersmodel->read_field($this->user['uid'],'ucloseconsult');
		$this->load->view('manager_interface/consultation',$pagevar);
	}
	
	function delete_consultation(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при удалении');
		$cid = trim($this->input->post('id'));
		if(!isset($cid) or empty($cid)) show_404();
		$success = $this->consultationmodel->delete_record($cid,$this->user['uid']);
		if($success) $statusval['status'] = TRUE;
		echo json_encode($statusval);
	}

	function save_consultation(){
		
		$statusval = array('status'=>FALSE,'message'=>'Данные не изменились','title'=>'','price'=>'','desc'=>'');
		$cid = $this->input->post('id');
		$title = htmlspecialchars(trim($this->input->post('title')));
		$price = htmlspecialchars(trim($this->input->post('price')));
		$period = trim($this->input->post('period'));
		$note = strip_tags(trim($this->input->post('desc')));
//		$note = preg_replace('/\n{2}/','<br>',$note);
		if(!$cid) show_404();if(!$title) show_404();if(!$price) show_404();if(!$period) show_404();if(!$note) show_404();
		$success = $this->consultationmodel->save_record($cid,$this->user['uid'],$title,$note,$period,$price,1);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['title'] = htmlspecialchars($title);
			$statusval['price'] = htmlspecialchars($price);
			$statusval['desc'] = strip_tags($note,'<br>');
		}
		echo json_encode($statusval);
	}
	
	function close_consultation(){
		
		$statusval = array('status'=>FALSE,'message'=>'Консультирование приостановлено');
		$check = $this->input->post('check');
		if(!isset($check)) show_404();
		$success = $this->usersmodel->close_consult($this->user['uid'],$check);
		if($success){
			$statusval['status'] = TRUE;
			if($check == 0):
				$statusval['message'] = 'Консультирование возобновлено';
			endif;
		}
		echo json_encode($statusval);
	}
	
	/* ====================================== END EDIT CONTROL PANEL ===========================================*/
	
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
		$config['upload_path'] 		= getcwd().'/documents/';
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
	
		$tmpName = $_FILES['userfile']['tmp_name'];
		
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

	function userfile_check($file){
		
		$tmpName = $_FILES['userfile']['tmp_name'];
		
		/*if($_FILES['userfile']['error'] == 4):
			$this->form_validation->set_message('userfile_check','Не указан файл');
			return FALSE;
		endif;*/
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
			case 'vachi': 	$fdata = preg_replace('/\n{2}/','<br>',trim($fdata));
							$this->usersmodel->save_single_data($this->user['uid'],'uachievement',strip_tags($fdata,'<br>'));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= 'Сохранено';
							break;
		endswitch;
		echo json_encode($statusval);
	}

	function delete_job(){
		$statusval = array('status'=>TRUE,'message'=>'Ошибка при удалении');
		$jid = trim($this->input->post('id'));
		if(!isset($jid) or empty($jid)) show_404();
		$this->jobsmodel->delete_record($jid);
		echo json_encode($statusval);
	}
	
	function insert_job(){
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при добавлении','retvalue'=>'');
		$job = array();
		$job['jcname'] 		= trim($this->input->post('cmp'));
		$job['jposition'] 	= trim($this->input->post('pos'));
		$job['jdbegin'] 	= trim($this->input->post('beg'));
		$job['jdend'] 		= trim($this->input->post('end'));
		if(!isset($job['jcname']) or empty($job['jcname'])) show_404();
		if(!isset($job['jposition']) or empty($job['jposition'])) show_404();
		if(!isset($job['jdbegin']) or empty($job['jdbegin'])) show_404();
		if(!isset($job['jdend']) or empty($job['jdend'])) show_404();
		$res = $this->jobsmodel->insert_record($this->user['uid'],$job);
		if($res):
			$statusval['status'] = TRUE;
		endif;
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
	
	function activity_list(){
	
		$act_id = $this->input->post('aid');
		$pagevar = array('baseurl'=>base_url(),'activity'=>array());
		if(!isset($act_id) or empty($act_id)) show_404();
		$pagevar['activity'] = $this->activitymodel->level_activity($act_id);
		$this->load->view('manager_interface/activityselect',$pagevar);
	}
	
	function views(){
		$type = $this->uri->segment(2);
		switch ($type):
			case 'job-list'	:	$pagevar = array('magager'=>array('jobs'=>array()),'userinfo'=> $this->user,'baseurl'=>base_url());
								$pagevar['manager']['jobs'] = $this->jobsmodel->read_records_year($this->user['uid'],0);
								$this->load->view('manager_interface/joblist',$pagevar);
								break;
			case 'form-job'	:	$this->load->view('forms/frmnewjob');
								break;
			case 'manager-list':$pagevar = array('magager'=>array(),'userinfo'=>$this->user);
								$activity = $this->session->userdata('activity');
								$parent = $this->session->userdata('parent_act');
								if(!$activity) exit;
								$pagevar['managers'] = $this->usersmodel->read_single_managers($activity);
								if(!$pagevar['managers']):
									$pagevar['managers'] = $this->usersmodel->read_managers($activity);
								endif;
								$pagevar['federal'] = $this->usersmodel->read_federal($activity);
								if(!$pagevar['federal']):
									$pagevar['federal'] = $this->usersmodel->read_federal($parent);
									if(!$pagevar['federal']):
										$pagevar['federal'] = $this->usersmodel->read_single_federal($activity);
									endif;
								endif;
								$pagevar['managers'][count($pagevar['managers'])] = $pagevar['federal'];
								$this->load->view('forms/frmmanlist',$pagevar);
								break;
					default :	show_404();
		endswitch;
	}

	function product_unit_load(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$group = $this->input->post('group');
		if(!isset($group) or empty($group)) show_404();
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar = array('products'=>$this->productionunitmodel->read_records_title($group,$mraid));
		$this->load->view('manager_interface/price-coordinator/select-product-unit',$pagevar);
	}

	function product_form_load(){
	
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		$group = $this->input->post('group');
		$unit = $this->input->post('unit');
		if(!isset($group) or empty($group)) show_404();
		if(!isset($unit) or empty($unit)) show_404();
		
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar = array('baseurl'=>base_url(),'unit'=>array());
		$pagevar['unit'] = $this->productionunitmodel->read_unit($unit,$group);
		$this->load->view('manager_interface/price-coordinator/select-product-form',$pagevar);
	}
	
	function product_unit_info(){
	
		$unit = array();
		$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
		$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
		$group = $this->input->post('group');
		$unit = $this->input->post('unit');
		if(!$group || !$unit) show_404();
		$unitinfo = $this->productionunitmodel->read_unit($unit,$group);
		$punit['longnote'] = FALSE;
		$punit['note'] = $unitinfo['pri_note'];
		$punit['full'] = $unitinfo['pri_note'];
		if(mb_strlen($punit['note'],'UTF-8') > 500):									
			$punit['note'] = mb_substr($punit['note'],0,500,'UTF-8');	
			$pos = mb_strrpos($punit['note'],' ',0,'UTF-8');
			$punit['note'] = mb_substr($punit['note'],0,$pos,'UTF-8');
			$punit['note'] .= ' ... ';
			$punit['longnote'] = TRUE;
		endif;
		$punit['title'] = $unitinfo['pri_title'];
		$punit['image'] = '<img src="'.base_url().'puravatar/viewimage/'.$unitinfo['pri_id'].'"class="floated" alt=""/>';
		$punit['lowprice'] = $unitinfo['pri_lowprice'];
		$punit['optimumprice'] = $unitinfo['pri_optimumprice'];
		$punit['topprice'] = $unitinfo['pri_topprice'];
		$punit['risks'] = $unitinfo['pri_riskslowprice'];
		$punit['advantage'] = $unitinfo['pri_advantages'];
		
		$punit['lowpricecode'] = $monetary[$unitinfo['pri_lowpricecode']];
		$punit['optimumpricecode'] = $monetary[$unitinfo['pri_optimumpricecode']];
		$punit['toppricecode'] = $monetary[$unitinfo['pri_toppricecode']];
		$punit['unitscode'] = $unitsof[$unitinfo['pri_unitscode']];
		if($punit['unitscode']):
			$punit['lowpricecode'] .= '/'.$punit['unitscode'];
			$punit['optimumpricecode'] .= '/'.$punit['unitscode'];
			$punit['toppricecode'] .= '/'.$punit['unitscode'];
		endif;
		echo json_encode($punit);
	}

	function offer_list(){
	
		$pagevar = array('baseurl'=>base_url(),'products'=>array());
		$region = $this->session->userdata('region');
		if(!$region) show_404();
		
		$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
		$product = trim($this->input->post('product'));
		$bprice = trim($this->input->post('bprice'));
		$eprice = trim($this->input->post('eprice'));
		if(!$product) show_404();
		if(!$bprice) $bprice = 0;
		if(!$eprice) $eprice = FALSE;
		if($eprice):
			$pagevar['products'] = $this->unionmodel->offer_list($product,$bprice,$eprice,$region);
		else:
			$pagevar['products'] = $this->unionmodel->offer_list_top($product,$bprice,$region);
		endif;
		if($pagevar['products']):
			for($i=0;$i<count($pagevar['products']);$i++):
				$pagevar['products'][$i]['cu_priceunit'] = $monetary[$pagevar['products'][$i]['cu_priceunit']];
				if(mb_strlen($pagevar['products'][$i]['cu_note'],'UTF-8') > 150):									
					$pagevar['products'][$i]['cu_note'] = mb_substr($pagevar['products'][$i]['cu_note'],0,150,'UTF-8');	
					$pos = mb_strrpos($pagevar['products'][$i]['cu_note'],' ',0,'UTF-8');
					$pagevar['products'][$i]['cu_note'] = mb_substr($pagevar['products'][$i]['cu_note'],0,$pos,'UTF-8');
					$pagevar['products'][$i]['cu_note'] .= ' ... ';
				endif;
			endfor;
		endif;
		$this->load->view('manager_interface/price-coordinator/offer-list',$pagevar);
	}
	
	function set_manager_on_region(){
	
		if($this->input->post('manager')):
			$activity = $this->session->userdata('activity');
			$parent = $this->session->userdata('parent_act');
			$region = $this->session->userdata('region');
			
			if(!$activity || !$region) show_404();
			$mraid = $this->manregactmodel->record_exist($region,$activity);
			if($mraid):
				$this->manregactmodel->set_manager_on_region($mraid,$_POST['manager']);
				redirect('managers/manager-list/'.$this->user['uconfirmation']);
			else:
		show_error("Отсутствует запись в БД!<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
			endif;
		else:
			show_error("Отсутствует ID менеджера!<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
		endif;
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
	
	function viewimage(){
		
		$section = $this->uri->segment(1);
		$id = $this->uri->segment(3);
		switch ($section){
			case 'companylogo' 	:	$image = $this->companymodel->get_image($id);	break;
			case 'mavatar' 		:	$image = $this->usersmodel->get_image($id);	break;
		}
		header('Content-type: image/gif');
		echo $image;
	}
						   
	function manager_list(){
		
		$activity = $this->session->userdata('activity');
		$parent = $this->session->userdata('parent_act');
		$region = $this->session->userdata('region');
		if(!$activity || !$region) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Cписок менеджеров - '.$this->activitymodel->read_field($activity,'act_title').' - Practice-Book',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'activity'		=> array(),
					'regions'		=> array(),
					'manager' 		=> array(),
					'managers' 		=> array(),
					'federal'		=> array(),
					'backpath'		=> 'managers/control-panel/'.$this->user['uconfirmation']
			);
		
		$pagevar['federal'] = $this->usersmodel->read_federal($activity);
		if(!$pagevar['federal']):
			$pagevar['federal'] = $this->usersmodel->read_federal($parent);
		endif;
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		if(!$mraid):
		show_error("Отсутствует запись в БД!<br/>Регион ID = $region, Отрасль ID = $activity<br/>Сообщите о возникшей ошибке разработчикам.");
		endif;
		$uid = $this->manregactmodel->read_field($mraid,'mra_uid');
		$pagevar['manager'] = $this->usersmodel->read_single_manager_byid($uid,'AND upriority=0');
		if($pagevar['manager']):
			$pagevar['manager']['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['manager']['uid'],$activity,$region);
		elseif($pagevar['federal']):
			$pagevar['manager']['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['federal']['uid'],$activity,$region);
		else:
			$pagevar['manager']['activitypath'] = "Отсутствуют менеджеры";
		endif;
		if($this->user['priority']):
			$pagevar['regions'] = $this->regionmodel->read_records();
		else:
			$pagevar['regions'] = $this->unionmodel->mra_region($this->user['uid']);	
		endif;
		$activity = $this->activitymodel->read_records();
		if(count($activity) > 0):
			for($i = 0; $i < count($activity); $i++):
				$activitylist[$activity[$i]['act_parentid']][] = $activity[$i];
			endfor;
		endif;
		$mas = array();
		$mas = $this->activity_select($activitylist,$this->user['activity'],$mas);
		$pagevar['activity'] = $mas;
		if(!$pagevar['activity']) $pagevar['activity'] = $this->activitymodel->read_activity($this->user['activity']);
		$this->load->view('manager_interface/manager-list',$pagevar);
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