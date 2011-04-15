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
		
	}
	
	function information_list(){
		
	}
	
	function registration_users(){
		
	}
	
	function cabinet(){
		
	}
}
?>