<?php

class Dealer_interface extends CI_Controller{

	var $user = array('uid'=>0,'ufullname'=>'','ulogin'=>'','uconfirmation'=>'','priority'=>TRUE);
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
		$this->load->model('dealersmodel');
		$this->load->model('unionmodel');
		$this->load->model('supportmodel');
		
		$cookieaid = $this->session->userdata('cookieaid');
		if(isset($cookieaid) and !empty($cookieaid)):
			$this->user['uid'] = $this->session->userdata('dealerid');
			if($this->user['uid']):
				$userinfo = $this->dealersmodel->read_record($this->user['uid']);
				if($userinfo):
					$this->user['ufullname']		= $userinfo['dlr_name'].' '.$userinfo['dlr_subname'].' '.$userinfo['dlr_thname'];
					$this->user['ulogin'] 			= $userinfo['dlr_email'];
					$this->user['uconfirmation'] 	= $userinfo['dlr_confirmation'];
				endif;
			endif;
			if($this->user['uconfirmation'] != $this->uri->segment(3)) show_404();
			if($this->session->userdata('cookieaid') != md5($this->user['ulogin'].$this->user['uconfirmation'])):
				$this->user = array();
				redirect('dealers');
			endif;
		else:
			redirect('dealers');
		endif;
	}

	function cpanel(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Диллеры | Панель управления',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'list'			=> $this->companymodel->dealer_company($this->user['uid'])
			);
		$this->load->view("dealer_interface/cpanel",$pagevar);
	}
	
	function shutdown(){
		
		$did = $this->session->userdata('dealerid');
		if($did):
			$this->dealersmodel->deactive_user($did);
			$this->session->sess_destroy();
			redirect('');
		else:
			show_404();
		endif;
	}

	function cabinet(){
	
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Личный кабинет дилера',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'dealer' 		=> array(),
			);
		
		if($this->input->post('fileupload')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			if(!$this->form_validation->run()):
				$_POST['fileupload'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$photo = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				$this->dealersmodel->save_single_data($this->user['uid'],'dlr_photo',$photo);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['dealer'] = $this->dealersmodel->read_record($this->user['uid']);
		$this->load->view('dealer_interface/cabinet',$pagevar);
	}

	function save_profile(){
	
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при сохранении','retvalue'=>'');
		$fname = trim($this->input->post('id'));
		$fdata = trim($this->input->post('value'));
		if(!$fname || !$fdata) show_404();
		switch ($fname):
			case 'vlogin': 	if(preg_match("/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i",$fdata)):
								if($this->dealersmodel->user_exist('dlr_email',$fdata)):
									$statusval['status'] 	= FALSE;
									$statusval['message'] 	= 'Логин уже занят';
									break;
								endif;
								$res = $this->dealersmodel->save_single_data($this->user['uid'],'dlr_email',$fdata);
								if($res):
									$this->session->set_userdata('cookieaid',md5($fdata.$this->user['uconfirmation']));
									$this->session->set_userdata('dealerid',$this->user['uid']);
								endif;
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный формат E-mail';
							endif;
							break;
							
			case 'vpass': 	if(mb_strlen($fdata,'UTF-8') >= 6):
								$this->dealersmodel->save_single_data($this->user['uid'],'dlr_password',md5($fdata));
								$this->dealersmodel->save_single_data($this->user['uid'],'dlr_cryptpassword',$this->encrypt->encode($fdata));
								$statusval['status'] = TRUE;
								$statusval['retvalue'] 	= 'Пароль изменен';
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Короткий пароль';
							endif;
							break;
							
			case 'vphones': if(preg_match("/^[0-9 ]{6,}$/i",$fdata)):
								$this->dealersmodel->save_single_data($this->user['uid'],'dlr_phone',$fdata);
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный номер телефона';
							endif;
							break;
							
			case 'vicq': 	if(preg_match("/^[0-9 ]{4,12}$/i",$fdata)):
								$this->dealersmodel->save_single_data($this->user['uid'],'dlr_icq',$fdata);
								$statusval['status'] 	= TRUE;
								$statusval['retvalue'] 	= $fdata;
							else:
								$statusval['status'] 	= FALSE;
								$statusval['message'] 	= 'Не верный номер ICQ';
							endif;
							break;
			case 'vskype': 	$this->dealersmodel->save_single_data($this->user['uid'],'dlr_skype',strip_tags($fdata));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= strip_tags($fdata);
							break;
			case 'vposition': 	$this->dealersmodel->save_single_data($this->user['uid'],'dlr_position',strip_tags($fdata));
							$statusval['status'] 	= TRUE;
							$statusval['retvalue'] 	= strip_tags($fdata);
							break;
		endswitch;
		echo json_encode($statusval);
	}
	
	function get_code(){
		
		$pagevar = array(
					'description'	=> '',
					'keywords'		=> '',
					'author'		=> '',
					'title'			=> 'Practice-Book - Получить код для регистрации компании',
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user
			);
		
		if($this->input->post('fileupload')):
			$this->form_validation->set_rules('userfile','','callback_userfile_check');
			if(!$this->form_validation->run()):
				$_POST['fileupload'] = NULL;
				$this->profile();
				return FALSE;
			else:
				$photo = $this->resize_img($_FILES['userfile']['tmp_name'],96,120);
				$this->dealersmodel->save_single_data($this->user['uid'],'dlr_photo',$photo);
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view('dealer_interface/get-code',$pagevar);
	}
	
	function generate_code(){
		
		$statusval = array('status'=>FALSE,'message'=>'Ошибка при сохранении','retvalue'=>'');
		$email = trim($this->input->post('email'));
		if($email):
			if(!preg_match("/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i",$email)):
				$statusval['status'] 	= FALSE;
				$statusval['message'] 	= 'Не верный формат E-mail';
			endif;
		else:
			$email = FALSE;
		endif;
		$data['confirm'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].mktime().$this->user['uconfirmation']);
		$newcmp = $this->companymodel->insert_empty($this->user['uid'],$data);
		if($newcmp):
			if($email):
				$message = 'Здравствуйте. Предлагаем зарегистрировать Вашу компанию у нас на сайте.'."\n\n".'Для этого введите в интернет браузере адрес: <a href="http://practice-book.ru/" target="_blank">http://practice-book.ru/</a> и нажмите кнопку "Добавить свою компанию в наш каталог"'."\n\n".'В появившемся окне введите код: '.$data['confirm']."\n\n".'Далее следует стандартная форма регистрации.'."\n\n\n".'Спасибо что пользуетесь нашим проектом. С уважением администрации сайта';
				if(!$this->sendmail($email,$message,"Код регистрации на сайте practice-book.ru","admin@practice-book.ru")):
					$statusval['status'] 	= FALSE;
					$statusval['message'] 	= 'Произошла ошибка при отправке письма';
				endif;
			endif;
			$statusval['status'] 	= TRUE;
			$statusval['retvalue'] 	= $data['confirm'];
		endif;
		echo json_encode($statusval);
	}
	
	function register_company(){
		
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
		
		if($this->dealersmodel->user_exist('uemail',$login)):
			$this->form_validation->set_message('login_check','Логин уже занят');
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