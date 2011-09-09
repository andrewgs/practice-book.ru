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
		$this->load->model('cmpunitsmodel');
		$this->load->model('jobsmodel');
		$this->load->model('consultationmodel');
		$this->load->model('departmentsmodel');
		
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
		
		$services = $this->activitymodel->read_records();
		if(count($services)>0):
			for($i=0;$i<count($services);$i++):
				$pagevar['activitylist'][$services[$i]['act_parentid']][] = $services[$i];
			endfor;
		endif;
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

	/* --------------------------------------------- started work ---------------------------------------------*/
	
	function select_settings(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Опыт профессионалов из первых рук',
					'baseurl' 		=> base_url(),
					'regions'		=> array(),
					'activity'		=> array(),
					'region'		=> array(),
					'boxtitle'		=> 'Регион/Округ',
					'activitypath'	=> FALSE
			);
		$pagevar['region'] = $this->regionmodel->read_districts();
		$pagevar['activity'] = $this->activitymodel->level_activity(0);
		$this->load->view('users_interface/select-settings',$pagevar);
	}
	
	function create_select_region(){
	
		$lselect = $this->input->post('lselect');
		$reg_title = $this->input->post('rtitle');
		if(!$lselect || !$reg_title) show_404();
		$pagevar = array('baseurl'=>base_url(),'region'=>array(),'boxtitle'=>'','lselect'=>$lselect);
		switch ($lselect):
			case '1': 	$pagevar['boxtitle'] = 'Область/Край';
						$pagevar['region'] = $this->regionmodel->read_area($reg_title);
						break;
			case '2': 	$pagevar['boxtitle'] = 'Город';
						$pagevar['region'] = $this->regionmodel->read_cities($reg_title);
						break;
			default : show_404();
		endswitch;
		$this->load->view('users_interface/region-box-select',$pagevar);
	}

	function create_select_activity(){
	
		$act_id = $this->input->post('aid');
		$final = $this->input->post('final');
		if(!$act_id) show_404();
		if(!$final) $final = 0;
		$pagevar = array('baseurl'=>base_url(),'activity'=>array());
		if(!$final):
			$pagevar['activity'] = $this->activitymodel->level_activity($act_id);
		endif;
		$this->load->view('users_interface/activity-box-select',$pagevar);
	}
	
	function activity_information(){
		
		$region = $this->uri->segment(3);
		$activity = $this->uri->segment(5);
		
		if($this->uri->total_segments() == 7):
			$spid = $this->uri->segment(7);
		endif;
		
		if(!$this->regionmodel->region_exist($region)) show_404();
		if(!$this->activitymodel->activity_exist($activity)) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> $this->activitymodel->read_field($activity,'act_title').' - Practice-Book',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'curactivity'	=> $activity,
					'curregion'		=> $region,
					'activitypath'	=> "",
					'othertext'		=> array(),
					'activity'		=> array(),
					'region'		=> array(),
					'pitfalls'		=> array(),
					'questions'		=> array(),
					'product'		=> array(),
					'regions'		=> array(),
					'manager' 		=> array(),
					'activitynews'	=> array(),
					'company'		=> array(),
					'news'			=> array(),
					'companynews'	=> array(),
					'persona'		=> array(),
					'documents'		=> array(),
					'specials'		=> array(),
					'tips'			=> array(),
					'unitgroups'	=> array(),
					'units'			=> array(),
					'shares'		=> array(),
					'consultlist'	=> array(),
					'consult'		=> FALSE,
					'group'			=> 0,
					'groupname'		=> '',
					'banner'		=> "",
					'top_rating'	=> 50,
					'low_rating'	=> 20,
					'long_note'		=>FALSE
			);
		$pagevar['manager']['jobs'] = array();
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		
		if(!$mraid):
			$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Работа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(55),
					'activitypath'	=> ''
			);
			$this->load->view('users_interface/no-activity-record',$pagevar);
			return FALSE;
		else:
			$product = $this->productsmodel->product_empty($mraid);
			if(!$product):
				$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Работа',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'regions'		=> array(),
					'text'			=> $this->othertextmodel->read_text(55),
					'activitypath'	=> ''
				);
				$this->load->view('users_interface/no-activity-record',$pagevar);
				return FALSE;
			endif;
		endif;
		$pagevar['userinfo']['status'] = $this->loginstatus['status'];
		$pagevar['manager']['jobs'] = array();
		$pagevar['othertext'] = $this->othertextmodel->read_group(1,21);
		$uid = $this->manregactmodel->read_field($mraid,'mra_uid');
		$pagevar['manager'] = $this->usersmodel->read_single_manager_byid($uid,'AND TRUE');
		$pagevar['consultlist'] = $this->consultationmodel->read_records($uid);
		if(count($pagevar['consultlist'])):
			$pagevar['consult'] = TRUE;
		endif;
		$clconsult = $this->usersmodel->read_field($uid,'ucloseconsult');
		if($clconsult):
			$pagevar['consult'] = FALSE;
		endif;
		$pagevar['product'] = $this->productsmodel->read_record($mraid);
		$pagevar['product']['full_note'] = $pagevar['product']['pr_note'];
		if(mb_strlen($pagevar['product']['pr_note'],'UTF-8') > 790):									
			$pagevar['product']['pr_note'] = mb_substr($pagevar['product']['pr_note'],0,790,'UTF-8');	
			$pos = mb_strrpos($pagevar['product']['pr_note'],' ',0,'UTF-8');
			$pagevar['product']['pr_note'] = mb_substr($pagevar['product']['pr_note'],0,$pos,'UTF-8');
			$pagevar['product']['pr_note'] .= '. ... ';
		endif;
		$pagevar['persona'] = $this->personamodel->read_record($mraid);
		$pagevar['persona']['full_note'] = $pagevar['persona']['prs_note'];
		if(mb_strlen($pagevar['persona']['prs_note'],'UTF-8') > 350):									
			$pagevar['persona']['prs_note'] = mb_substr($pagevar['persona']['prs_note'],0,350,'UTF-8');	
			$pos = mb_strrpos($pagevar['persona']['prs_note'],' ',0,'UTF-8');
			$pagevar['persona']['prs_note'] = mb_substr($pagevar['persona']['prs_note'],0,$pos,'UTF-8');
			$pagevar['persona']['prs_note'] .= '. ... ';
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
//		$pagevar['activitynews'] = $this->activitynewsmodel->read_limit_records($mraid,25);
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
			if(isset($spid) && !empty($spid)):
				$pagevar['units'] = $this->productionunitmodel->search_single_units($spid);
			else:
				$pagevar['units'] = $this->productionunitmodel->read_units($pagevar['unitgroups'][0]['prg_id'],$mraid);
			endif;
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
				$pagevar['companynews'][$i]['an_note'] = mb_substr($pagevar['companynews'][$i]['cn_note'],0,250,'UTF-8');	
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
		$pagevar['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['manager']['uid'],$activity,$region);
		$this->load->view('users_interface/activity-info',$pagevar);
	}
	
	function manager_list(){
	
		$region = $this->uri->segment(3);
		$activity = $this->uri->segment(5);
		
		if(!$this->regionmodel->region_exist($region)) show_404();
		if(!$this->activitymodel->activity_exist($activity)) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Cписок менеджеров - '.$this->activitymodel->read_field($activity,'act_title').' - Practice-Book',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'curactivity'	=> $activity,
					'curregion'		=> $region,
					'activity'		=> array(),
					'regions'		=> array(),
					'manager' 		=> array(),
					'managers' 		=> array(),
					'federal'		=> array()
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
			$pagevar['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['manager']['uid'],$activity,$region);
		elseif($pagevar['federal']):
			$pagevar['activitypath'] = $this->unionmodel->mra_activity_region($pagevar['federal']['uid'],$activity,$region);
		else:
			$pagevar['activitypath'] = "Отсутствуют менеджеры";
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
		$this->load->view('users_interface/manager-list',$pagevar);
		
	}

	function product_unit_load(){
	
		$region = $this->uri->segment(3);
		$activity = $this->uri->segment(5);
		if(!$this->regionmodel->region_exist($region)) show_404();
		if(!$this->activitymodel->activity_exist($activity)) show_404();
		
		$group = $this->input->post('group');
		if(!isset($group) or empty($group)) show_404();
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$pagevar = array('products'=>$this->productionunitmodel->read_records_title($group,$mraid));
		$this->load->view('manager_interface/price-coordinator/select-product-unit',$pagevar);
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
		$region = $this->uri->segment(3);
		if(!$this->regionmodel->region_exist($region)) show_404();
		
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
		$this->load->view('users_interface/offer-list',$pagevar);
	}

	function consultation_list(){
	
		$manager = $this->uri->segment(3);
		if(!$this->usersmodel->user_exist('uid',$manager)):
			show_404();
		else:
			$consult = $this->consultationmodel->read_records($manager);
			if(!count($consult)):
				show_404();
			endif;
		endif;
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Консультирование',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'consult'		=> $consult,
					'activitypath'	=> "Консультирование",
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> 5000,
					'cmpid' 		=> 1,
					'cmpname'		=> '',
					'uri'			=> ''
			);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('name','','required|strip_tags|trim');
			$this->form_validation->set_rules('email','','required|strip_tags|valid_email|trim');
			$this->form_validation->set_rules('phone','','required|strip_tags|trim');
			$this->form_validation->set_rules('message','','required|strip_tags|trim');
			$this->form_validation->set_rules('price','','required|htmlspecialchars|trim');
			$this->form_validation->set_rules('period','','required|trim');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->consultation_list();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$managerinfo = $this->usersmodel->read_single_manager_byid($manager,'AND TRUE');
				$message = 'Контактное лицо - '.$_POST['name'].' хочет получить консультацию:'."\n";
				$message .= 'Номер телефона - '.$_POST['phone']."\n";
				$message .= 'Описание:'."\n\n".$_POST['message']."\n\n\n";
				$message .= 'Стоимость консультации (руб.) - '.$_POST['price']."\n\n";
				$message .= 'Порядковый номер периода - '.$_POST['period']."\n\n";
				$message .= 'Форма оплаты - НЕИЗВЕСТНО'."\n\n";
				if(!$this->sendmail($managerinfo['uemail'],strip_tags($message,'<br>'),'Консультация',$_POST['email'])):
					$this->email->print_debugger();
					exit;
				endif;
				$pagevar['uri'] = $_POST['uri'];
				$pagevar['text'] = 'Извещение отослано менеджеру.<br/>Ожидайте с Вами свяжуться';
				$this->load->view('users_interface/message',$pagevar);
				return TRUE;
			endif;
		endif;
		$this->load->view('users_interface/consultation',$pagevar);
	}

	function create_search_activity(){
	
		$search = $this->input->post('search');
		if(!$search) show_404();
		$pagevar = array('baseurl'=>base_url(),'result'=>array());
		$units = $this->unionmodel->search_unit($search);
		$activity = $this->activitymodel->search_activity($search);
		for($i=0;$i<count($units);$i++):
			$pagevar['result'][$i]['id'] = $units[$i]['id'];
			$pagevar['result'][$i]['title'] = $units[$i]['title'];
			$pagevar['result'][$i]['product'] = $units[$i]['pid'];
		endfor;
		for($i=0,$j=count($units);$i<count($activity);$i++,$j++):
			$pagevar['result'][$j]['id'] = $activity[$i]['id'];
			$pagevar['result'][$j]['title'] = $activity[$i]['title'];
			$pagevar['result'][$j]['product'] = 0;
		endfor;
		if(count($pagevar['result'])):
			$this->load->view('users_interface/search-result-select',$pagevar);
		endif;
	}
	
	function create_search_region(){
	
		$search = $this->input->post('search');
		if(!$search) show_404();
		$pagevar = array('baseurl'=>base_url(),'result'=>array());
		$pagevar['result'] = $this->regionmodel->search_region($search);
		if(count($pagevar['result'])):
			$this->load->view('users_interface/search-region-select',$pagevar);
		endif;
	}

	/* ------------------------------------------------	company -------------------------------------------*/
	
	function company_info(){
		
		$company = $this->uri->segment(2);
		if(!$this->companymodel->company_exist_byid($company)) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Панель управления компанией',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'company'		=> $this->companymodel->read_record($company),
					'regions'		=> array(),
					'representative'=> $this->usersmodel->read_representative($company),
					'news'			=> $this->cmpnewsmodel->read_limit_records($company,3),
					'shares'		=> $this->cmpsharesmodel->read_limit_records($company,3),
					'unitgroups'	=> array(),
					'units'			=> array(),
					'association'	=> array(),
					'group'			=> 0,
					'activitypath'	=> ''
					
			);
		$pagevar['activitypath'] = $pagevar['company']['cmp_name'];
		for($i = 0;$i < count($pagevar['news']); $i++):
			$pagevar['news'][$i]['cn_pdatebegin'] = $this->operation_date($pagevar['news'][$i]['cn_pdatebegin']);
			$pagevar['news'][$i]['full_note'] = $pagevar['news'][$i]['cn_note'];
			if(mb_strlen($pagevar['news'][$i]['cn_note'],'UTF-8') > 325):									
				$pagevar['news'][$i]['cn_note'] = mb_substr($pagevar['news'][$i]['cn_note'],0,325,'UTF-8');	
				$pos = mb_strrpos($pagevar['news'][$i]['cn_note'],'.',0,'UTF-8');
				$pagevar['news'][$i]['cn_note'] = mb_substr($pagevar['news'][$i]['cn_note'],0,$pos,'UTF-8');
				$pagevar['news'][$i]['cn_note'] .= '. ... ';
			endif;
		endfor;
		for($i = 0;$i < count($pagevar['shares']); $i++):
			$pagevar['shares'][$i]['sh_pdatebegin'] = $this->operation_date($pagevar['shares'][$i]['sh_pdatebegin']);
			$pagevar['shares'][$i]['full_note'] = $pagevar['shares'][$i]['sh_note'];
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
		
		$pagevar['unitgroups'] = $this->unionmodel->read_cmpproduct_group($company);
		if($pagevar['unitgroups']):
			$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
			$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
			$pagevar['units'] = $this->cmpunitsmodel->read_units($pagevar['unitgroups'][0]['prg_id'],$company);
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
		$this->load->view('users_interface/company-info',$pagevar);
	}
	
	function representatives_list(){
	
		$company = $this->uri->segment(3);
		if(!$this->companymodel->company_exist_byid($company)) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Управление представителями',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'activitypath'	=> '',
					'company'		=> $this->companymodel->read_record($company),
					'representative' => $this->usersmodel->read_representatives($company)
			);
		$pagevar['activitypath'] = $pagevar['company']['cmp_name'];
		$this->load->view('users_interface/representatives',$pagevar);
	}
	
	function products_unit_info(){
	
		$pagevar = array('baseurl'=>base_url(),'units'=> array());
		$monetary = array('','руб.','тыс.руб.','млн.руб.','%');
		$unitsof = array('','','шт.','тыс.шт.','гр.','кг.','т.','м.','пог.м.','см.','кв.м.','кв.см.','куб.м.','куб.см.','л.','час.','ед.мес.','ед.год.');
		$group = $this->input->post('group');
		$company = $this->input->post('company');
		if(!$group || !$company) show_404();
		$pagevar['units'] = $this->cmpunitsmodel->read_units($group,$company);
		
		for($i=0;$i<count($pagevar['units']);$i++):
			$pagevar['units'][$i]['cu_priceunit'] = $monetary[$pagevar['units'][$i]['cu_priceunit']];
			$pagevar['units'][$i]['cu_unitscode'] = $unitsof[$pagevar['units'][$i]['cu_unitscode']];
			if($pagevar['units'][$i]['cu_unitscode']):
				$pagevar['units'][$i]['cu_priceunit'] .= '/'.$pagevar['units'][$i]['cu_unitscode'];
			endif;
		endfor;
		$this->load->view("company_interface/products-table",$pagevar);
	}

	function announce_tender(){
		
		if(!$this->user['cid'])	show_404();
		$region = $this->uri->segment(3);
		$activity = $this->uri->segment(5);
		if(!$this->regionmodel->region_exist($region)) show_404();
		if(!$this->activitymodel->activity_exist($activity)) show_404();
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Объявление тендера',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'activitypath'	=> 'Объявление тендера',
					'company'		=> array(),
					'top_rating'	=> 50,
					'low_rating'	=> 20,
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> 5000,
					'cmpid' 		=> 1,
					'cmpname'		=> '',
					'uri'			=> 'activity-information/region/'.$this->uri->segment(3).'/activity/'.$this->uri->segment(5) 
			);
		if($this->input->post('submit')):
			
			$this->form_validation->set_rules('theme','','required|htmlspecialchars|trim');
			$this->form_validation->set_rules('note','','required|strip_tags|trim');
			$this->form_validation->set_rules('summa','','required|htmlspecialchars|trim');
			$this->form_validation->set_rules('dateover','','required|trim');
			$this->form_validation->set_rules('payment','','required|htmlspecialchars|trim');
			$this->form_validation->set_rules('time','','trim|htmlspecialchars');
			$this->form_validation->set_rules('info','','trim|strip_tags');
			$this->form_validation->set_rules('cmp[]','','required');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->announce_tender();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				$cmpinfo = $this->companymodel->read_record($this->user['cid']);
				
				$from = $cmpinfo['cmp_email'];
				$message = 'Организация '.$cmpinfo['cmp_name'].', '.$cmpinfo['cmp_uraddress'].' объявляет тендер: '."\n";
				$message .= 'Контактное лицо - '.$this->user['ufullname']."\n";
				$message .= 'Контактный телефон - '.$cmpinfo['cmp_phone']."\n";
				$message .= 'Факс - '.$cmpinfo['cmp_telfax']."\n";
				$message .= 'E-Mail - '.$cmpinfo['cmp_email']."\n\n\n";
				$message .= 'Тема тендера - '.$_POST['theme']."\n\n\n";
				$message .= 'Описание:'."\n\n".$_POST['note']."\n\n\n";
				$message .= 'Сумма контракта (тыс.руб.) - '.$_POST['summa']."\n\n";
				$message .= 'Дата окончания тендера - '.$_POST['dateover']."\n\n";
				$message .= 'Форма оплаты - '.$_POST['payment']."\n\n";
				if($_POST['time'] !=''):
					$message .= 'Срок выполнения работ - '.$_POST['time']."\n\n";
				endif;
				if($_POST['info'] != ''):
					$message .= 'Дополнительная информация:'."\n\n".$_POST['info']."\n\n";
				endif;
				$theme = 'Объявление тендера';
				for($i=0;$i<count($_POST['cmp']);$i++):
					$email = $this->companymodel->read_field($_POST['cmp'][$i],'cmp_email');
					if(!$this->sendmail($email,strip_tags($message,'<br>'),$theme,$from)):
						$this->email->print_debugger();
						exit;
					endif;
				endfor;
				$pagevar['text'] = 'Извещение разослано по выбранным огранизациям';
				$this->load->view('users_interface/message',$pagevar);
				return TRUE;
			endif;
		endif;
		$pagevar['company'] = $this->unionmodel->select_company_by_region($activity,$region);
		for($i=0;$i<count($pagevar['company']);$i++):
			$pagevar['company'][$i]['cmp_graph'] = $pagevar['company'][$i]['cmp_rating'];
			if($pagevar['company'][$i]['cmp_rating'] > 75):
				$pagevar['company'][$i]['cmp_graph'] = 75;
			endif;
			$pagevar['company'][$i]['full_description'] = $pagevar['company'][$i]['cmp_description'];
			if(mb_strlen($pagevar['company'][$i]['cmp_description'],'UTF-8') > 250):
				$pagevar['company'][$i]['cmp_description'] = mb_substr($pagevar['company'][$i]['cmp_description'],0,250,'UTF-8');
				$pos = mb_strrpos($pagevar['company'][$i]['cmp_description'],'.',0,'UTF-8');
				$pagevar['company'][$i]['cmp_description'] =mb_substr($pagevar['company'][$i]['cmp_description'],0,$pos,'UTF-8');
				$pagevar['company'][$i]['cmp_description'] .= '. ... ';
			endif;
		endfor;
		$this->load->view('users_interface/announce-tender',$pagevar);
		
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
				$units = $this->unionmodel->units_by_activity($_POST['servname']);
				if(count($units)):
					for($i=0;$i<count($units);$i++):
						$this->cmpunitsmodel->insert_empty($cmpid,$units[$i],$units[$i]['groupe']);
					endfor;
				endif;
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
					'regions'		=> array(),
					'departments'	=> array()
			);
		$pagevar['regions'] = $this->regionmodel->read_records();
		$pagevar['departments'] = $this->departmentsmodel->read_records();
		$this->session->set_userdata('regstatus',3);
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login',' ','required|valid_email|callback_login_check|trim');
			$this->form_validation->set_message('valid_email','Укажите правильный адрес.');
			$this->form_validation->set_rules('password',' ','required|min_length[6]|trim');
			$this->form_validation->set_rules('confirmpass',' ','required|min_length[6]|matches[password]|trim');
			$this->form_validation->set_message('matches','Пароли не совпадают');
			$this->form_validation->set_rules('userfile',' ','callback_userfile_check');
			$this->form_validation->set_rules('fname',' ','required|trim');
			$this->form_validation->set_rules('sname',' ','required|trim');
			$this->form_validation->set_rules('tname',' ','required|trim');
			$this->form_validation->set_rules('department',' ','required');
			$this->form_validation->set_rules('position',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','required|min_length[6]|integer|trim');
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
					$_POST['photo'] = file_get_contents(base_url().'images/no_avatar.png');
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
					'cmpname'		=> '',
					'uri'			=> ''
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
			if($user['umanager'] || $user['ucompany']):
				if($user['ustatus'] == 'enabled'):
					$this->session->set_userdata('login_id',md5($user['uemail'].$user['uconfirmation']));
					$this->session->set_userdata('userid',$user['uid']);
					$this->usersmodel->active_user($user['uid']);
					$statusval['status'] = TRUE;
				else:
					$statusval['message'] = 'Учетная запись не активирована';
				endif;
			else:
				$statusval['message'] = 'Для администратора данная авторизация не допустима';
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
			case 'curavatar'	: 	$image = $this->cmpunitsmodel->get_image($id); break;
			case 'shares'		: 	$image = $this->cmpsharesmodel->get_image($id); break;
		}
		header('Content-type: image/gif');
		echo $image;
	}
	
	function show_contact(){
	
		$activity = $this->input->post('activity');
		if(!$activity) show_404();
		$pagevar = array('baseurl'=>base_url(),'contact'=>array());
		$pid = $this->activitymodel->read_field($activity,'act_parentid');
		if($pid):
			$pagevar['contact'] = $this->usersmodel->read_single_managers($activity);
		else:
			$pagevar['contact'] = $this->usersmodel->read_single_federals($activity);
		endif;
		$this->load->view('users_interface/single-contact',$pagevar);
	}
	/* -----------------------------------------	other function -------------------------------------------*/
	
	function ajax_add_pitfall(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при добавлении');
		$title = trim($this->input->post('title'));
		$note = trim($this->input->post('note'));
		$activity = trim($this->input->post('activity'));
		$region = trim($this->input->post('region'));
		
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		if(!isset($activity) or empty($activity)) show_404();
		if(!isset($region) or empty($region)) show_404();
		
		$note = preg_replace('/\n{2}/','<br>',$note);
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$success = $this->pitfallsmodel->user_insert_record($mraid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['message'] = "Отправлено на проверку";
		}
		echo json_encode($statusval);
	}

	function ajax_add_tips(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при добавлении');
		$title = trim($this->input->post('title'));
		$note = trim($this->input->post('note'));
		$activity = trim($this->input->post('activity'));
		$region = trim($this->input->post('region'));
		
		if(!isset($title) or empty($title)) show_404();
		if(!isset($note) or empty($note)) show_404();
		if(!isset($activity) or empty($activity)) show_404();
		if(!isset($region) or empty($region)) show_404();
		
		$note = preg_replace('/\n{2}/','<br>',$note);
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$success = $this->tipsmodel->user_insert_record($mraid,$title,$note);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['message'] = "Отправлено на проверку";
		}
		echo json_encode($statusval);
	}
	
	function ajax_add_question(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при добавлении');
		$title = trim($this->input->post('title'));
		$activity = trim($this->input->post('activity'));
		$region = trim($this->input->post('region'));
		
		if(!isset($title) or empty($title)) show_404();
		if(!isset($activity) or empty($activity)) show_404();
		if(!isset($region) or empty($region)) show_404();
		
		$mraid = $this->manregactmodel->record_exist($region,$activity);
		$success = $this->mraquestionsmodel->insert_record($mraid,$title);
		if($success){
			$statusval['status'] = TRUE;
			$statusval['message'] = "Отправлено на проверку";
		}
		echo json_encode($statusval);
	}
	
	function registration_request(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Опыт профессионалов из первых рук',
					'baseurl' 		=> base_url(),
					'activitypath'	=> FALSE,
					'activity'		=> array(),
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> 5000,
					'cmpid' 		=> 1,
					'cmpname'		=> '',
					'uri'			=> ''
			);
		
		$manager = $this->uri->segment(2);
		
		if($this->input->post('submit')):
			$this->form_validation->set_rules('login','','required|valid_email|callback_login_check|trim');
			$this->form_validation->set_message('valid_email','Укажите правильный адрес');
			$this->form_validation->set_rules('fname','','required|trim');
			$this->form_validation->set_rules('sname','','required|trim');
			$this->form_validation->set_rules('tname','','required|trim');
			$this->form_validation->set_rules('phones','','required|min_length[6]|integer|trim');
			$this->form_validation->set_rules('status','','required|trim');
			$this->form_validation->set_rules('education','','required|trim');
			$this->form_validation->set_rules('birthday','','required|trim');
			$this->form_validation->set_rules('region','','required|trim');
			$this->form_validation->set_rules('experience','','required|trim');
			$this->form_validation->set_rules('activity','','');
			$this->form_validation->set_rules('newactivity','','');
			$this->form_validation->set_rules('newactivity','','');
			$this->form_validation->set_rules('actValue','','');
			$this->form_validation->set_error_delimiters('<div class="fvalid_error">','</div>');
			if(!$this->form_validation->run()):
				$_POST['submit'] = NULL;
				$this->registration_request();
				return FALSE;
			else:
				$_POST['submit'] = NULL;
				if(!$_POST['activity'] && !$_POST['newactivity']):
					show_error("Отсутствуют данные<br/>Обратитесь в техподдержку");
				else:
					$_POST['experience'] = preg_replace('/\n{2}/','<br>',$_POST['experience']);
					$email = 'admin@practice-book.ru';
					$message = "Анкета на регистрацию менеджера \n";
					$message .= 'ФИО - '.$_POST['fname'].' '.$_POST['sname'].' '.$_POST['tname']."\n";
					$message .= 'E-Mail - '.$_POST['login']."\n";
					$message .= 'Телефон - '.$_POST['phones']."\n";
					$message .= 'Симейное положение - '.$_POST['status']."\n";
					$message .= 'Образование - '.$_POST['education']."\n";
					$message .= 'День рождения - '.$_POST['birthday']."\n";
					$message .= 'Место проживания - '.$_POST['region']."\n";
					$message .= 'Опыт работы - '.$_POST['experience']."\n";
					switch ($manager):
						case 'federal-manager' : 	if(!$_POST['activity']):
														$message .= 'Моя сфера деятельности - '.$_POST['newactivity']."\n";
													else:
														$message .= 'Выбрана сфера деятельности - '.$_POST['actValue']."\n";
													endif;
													$theme = 'Анкета на регистрацию федерального менеджера';
													break;
													
						case 'regional-manager' : 	$message .= 'Моя сфера деятельности - '.$_POST['newactivity']."\n";
													if($_POST['actValue']):
														$manemail = $this->usersmodel->read_single_federal($_POST['actValue']);
														if(!$manemail):
															$manemail = $this->usersmodel->read_federal($_POST['actValue']);
															if($manemail):
																$email = $manemail['uemail'];
															endif;
														endif;
													endif;
													$theme = 'Анкета на регистрацию регионального менеджера';
													break;
					endswitch;
					if($this->sendmail($email,strip_tags($message,'<br>'),$theme,$_POST['login'])):
						$pagevar['text'] = 'Сообщение отправлено';
						$this->load->view('users_interface/message',$pagevar);
						return TRUE;
					else:
						$this->email->print_debugger();
					endif;
				endif;
			endif;
		endif;
		
		switch ($manager):
			case 'federal-manager' : 	$pagevar['activitypath'] = 'Анкета на регистрацию федерального менеджера';
										$pagevar['activity'] = $this->activitymodel->level_activity(0);
										$this->load->view('users_interface/registration-request-federal',$pagevar);
										break;
			case 'regional-manager' : 	$pagevar['activitypath'] = 'Анкета на регистрацию регионального менеджера';
										$pagevar['activity'] = $this->activitymodel->level_activity(0);
										$this->load->view('users_interface/registration-request-regional',$pagevar);
										break;
			default					:	show_404();
		endswitch;
	}
	
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
	
	function send_manager_mail(){
			
			$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book',
					'baseurl' 		=> base_url(),
					'text' 			=> '',
					'logo' 			=> 'default',
					'timer' 		=> 5000,
					'cmpid' 		=> 1,
					'cmpname'		=> '',
					'uri'			=> ''
			);
		if($this->input->post('submit')):
			if(!$_POST['manmail']) show_error("Не верный или отсутствует адрес получателя<br/>Обратитесь в техподдержку");
			$_POST['message'] = preg_replace('/\n{2}/','<br>',$_POST['message']);
			if($this->sendmail($_POST['manmail'],strip_tags($_POST['message'],'<br>'),htmlspecialchars($_POST['name'].' - '.$_POST['theme']),$_POST['email'])):
				$pagevar['text'] = 'Сообщение отправлено';
				$pagevar['uri'] = $_POST['uri'];
				$this->load->view('users_interface/message',$pagevar);
				return TRUE;
//				redirect($_POST['uri']);
			else:
				$this->email->print_debugger();
			endif;
		endif;
	}
	
	function sendmail($email,$msg,$subject,$from){
		
		$this->email->clear(TRUE);
		$config['smtp_host'] = 'localhost';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($from,'Practice-book.ru');
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