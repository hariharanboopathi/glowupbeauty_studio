<?php
namespace App\Controllers\Beheerpaneel;
use App\Controllers\BaseController;
use App\Models\Auth_model;
use App\Models\Email_model;

class Login extends BaseController
{
	public function __construct()
	{
		$this->Email_model = new Email_model();
	}

	public function index()
	{
		if(isAdmin())
			return redirect()->to(base_url('beheerpaneel/dashboard') );
			// $session = \Config\Services::session();

		

		if($this->request->getVar())
		{
			if(get_settings('CAPTCHA'))
			{
				$con = empty($this->request->getVar('honeypot')) && ($this->session->get('admin_login') == $this->request->getVar('captcha'));
 

			}
			else
			{
				$con = empty($this->request->getVar('honeypot'));
			}
			if($con)
            {
			
		

				$username = $this->request->getVar('login');
				$password = $this->request->getVar('pass');
				$passwords = $this->request->getVar('pass');

				$conditions = array('email'=>$username);

				$get_user = $this->auth_model->loginadmin($conditions);

			
			
			
				if($get_user)
				{
					$check_password = $get_user[0]->password;	
					
				

					// if($this->session->getTempdata('penalty'))
					// {
					// 	//Shows code that user is on a penalty
					// 	$this->session->setFlashdata('error', "You've tried to login too many times. Please try again in 15 minutes.");
					// }
					// else
					// {
						// if(true)
				
						$builder = $this->db->table('user_login_activity');
						$builder->where('email', $this->request->getPost('login'));
						$builder->orderBy("id", "DESC");
						$check_act_user = $builder->get()->getRow();
						
						$builder = $this->db->table('users');
						$builder->where('email', $this->request->getPost('login'));
						$check_user_att = $builder->get()->getRow();
						
						$lock_count = 3;
						$get_lock_count = get_settings('admin_login_lock_count');
						if(!empty($get_lock_count))
						{
							$lock_count = $get_lock_count;
						}

						$lock_duration_days = 1;

						$get_lock_duration_days = get_settings('admin_login_lock_duration');

						if(!empty($get_lock_duration_days))
						{
							$lock_duration_days = $get_lock_duration_days;
						}

						if(!empty($check_act_user) && !empty($check_user_att)) {
							$datetime1 = new \DateTime($check_act_user->login_data_time);
							$datetime2 = new \DateTime(date("Y-m-d H:i:s"));
							$interval = $datetime1->diff($datetime2);

							// print_r($interval);
							// exit();
							
							if($check_user_att->login_attempt >= $lock_count){
								
								
								if($interval->days < $lock_duration_days)
								{
									$this->session->setflashdata('error',getlang('Uw account is tijdelijk vergrendeld. probeer het daarna').' '.$lock_duration_days.' '.getlang('days'));
									return redirect()->to(base_url('beheerpaneel/login') );
								} else {
									$insert_atmpt['login_attempt'] = '0';
									$this->general_model->update_data("users",$insert_atmpt,array('id'=>$check_user_att->id));
								}
							}
						}
						
						if(!empty($check_act_user) && empty($check_user_att)) {
							
							$builder = $this->db->table('user_login_activity');
							$builder->where('email', $this->request->getPost('login'));
							$builder->where('DATE(login_data_time)', date('Y-m-d'));
							$builder->orderBy("id", "DESC");
							$total_cnt = $builder->countAllResults();
							
							$datetime1 = new \DateTime($check_act_user->login_data_time);
							$datetime2 = new \DateTime(date("Y-m-d H:i:s"));
							$interval = $datetime1->diff($datetime2);

							if($total_cnt > $lock_count){
								if($interval->days < $lock_duration_days)
								{
									$this->session->setflashdata('error',getlang('Uw account is tijdelijk vergrendeld. probeer het daarna').' '.$lock_duration_days.' '.getlang('days'));
									return redirect()->to(base_url('beheerpaneel/login') );
								} 
							}
						}
						
						$password=hash("sha512",$password);
						if (password_verifys($password, $check_password)) 
						{
							// echo "yes";
							// exit;
							if($get_user[0]->enable_2fa == 1)
							{
								$this->session = \Config\Services::session();
								$random_code = random_code();
								$email_values = array(
									'name'=>$get_user[0]->name.' '.$get_user[0]->last_name,
									'code'=>$random_code,
									'site_name'=>get_settings('site_name'),
								);
								$email_template = M('TWOFACTOR', $email_values);

								if ($email_template[0]->status == '1') {
									$this->Email_model->sendHtmlMail($username,$email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message);
								}
								$insert_values = array('code'=>$random_code,'email'=>$username,'expirytime'=>time() + (60 * 60));
								$this->general_model->insert_data('twofactorscode',$insert_values);
								$values = array ('2fa'=>1,'email'=>$username);
								$this->session->set($values);
								return redirect()->to(base_url(ADMIN_URL.'/2fa') );
							}
							$this->auth_model->setAdminSession($conditions);

							$datetimeupdate = date('Y-m-d H:i:s');
							if(!empty($get_user[0]->last_login)){ 
								$insert['last_login'] = $get_user[0]->last_login.','.$datetimeupdate; 
							} else {
								$insert['last_login'] = $datetimeupdate;
							}
							$response = $this->general_model->update_data("users",$insert,array('id'=>$get_user[0]->id));
							
							$ip = getIPAddress();
							$insert_log_act = array("email" => $get_user[0]->email,"login_status" => 'Success',"reason" => 'Successfully logged',"login_data_time" => date('Y-m-d H:i:s'),'ip_address'=>$ip);
							$this->general_model->insert_data("user_login_activity",$insert_log_act);
					
		
							
							$this->session->setFlashdata('Success_message',getlang('beheerder inloggen succesvol'));
							return redirect()->to(base_url('beheerpaneel/dashboard') );
						}
						else
						{

							// echo "no";
							// exit;
							$builder = $this->db->table('users');
							$builder->where('email', $this->request->getPost('login'));
							$check_user = $builder->get()->getRow();
							$ip = getIPAddress();
							if(!empty($check_user)){
								$insert_log_act = array("email" => $check_user->email,"login_status" => 'Failed',"reason" => 'Login incorrect',"login_data_time" => date('Y-m-d H:i:s'),'ip_address'=>$ip);
								$this->general_model->insert_data("user_login_activity",$insert_log_act);
							} else {
								$insert_log_act = array("email" => $this->request->getPost('login'),"login_status" => 'Failed',"reason" => 'Invalid user account',"login_data_time" => date('Y-m-d H:i:s'),'ip_address'=>$ip);
								$this->general_model->insert_data("user_login_activity",$insert_log_act);
							}
							
							if(!empty($check_act_user) && !empty($check_user)) {
								$datetime1 = new \DateTime($check_act_user->login_data_time);
								$datetime2 = new \DateTime(date("Y-m-d H:i:s"));
								$interval = $datetime1->diff($datetime2);

								if(!empty($interval)){
									if($interval->days < $lock_duration_days)
									{
										$attempt_count = $check_user->login_attempt + 1;
									} else {
										$attempt_count = 1;
									}
									$insert_atmpt['login_attempt'] = $attempt_count;
									$this->general_model->update_data("users",$insert_atmpt,array('id' => $check_user->id));
								}
							}
							
							$this->session->setFlashdata('error', getlang('E-mailadres en wachtwoord komen niet overeen'));
							// return redirect()->to($_SERVER['HTTP_REFERER']);
							// echo csrf_hash();
							// exit;


							// $attempt = $this->session->get('attempt');
							// $attempt++;
							// $this->session->set('attempt', $attempt);



							// if ($attempt == 3) 
							// {
							// 	//echo json_encode("Je hebt te vaak geprobeerd in te loggen. Probeer het over 15 minuten nogmaals.");
							// 	$this->session->setFlashdata('error', "You have tried to login too many times. Please try again in 15 minutes.");
							// 	$attempt = 0;
							// 	$this->session->setTempdata('penalty', true, 900);
							// 	$this->session->set('attempt', $attempt);
							// } 
							// else 
							// {
							// 	$this->session->setFlashdata('error', "Email and password not matches.");
							// }
						// }
					}
				}
				else
				{
					$this->session->setFlashdata('error', getlang('Inloggen mislukt. Controleer uw gegevens en probeer het opnieuw.'));
					return redirect()->to(base_url('beheerpaneel/login') );
				}
		    }
			else 
            {
                $this->session->setFlashdata('error',getlang('Onjuiste captcha'));
                return redirect()->to(base_url('beheerpaneel/login'));
            }

		}
// 		$datetime2 = new \DateTime();  // No need to pass date("Y-m-d H:i:s") as a parameter
// echo $datetime2->format("Y-m-d H:i:s");
		//return view('beheerpaneel/auth/login');
		$this->outputData = [
            'request' => $this->request
        ];
		return view('beheerpaneel/auth/login',$this->outputData);
	}


	public function twofa()
	{
		if(!empty($this->session->get('2fa')) && !empty($this->session->get('email')) )
		{
			$get_user_code = $this->general_model->fetch_data('twofactorscode',array('email'=>$this->session->get('email')));
			if(!empty($get_user_code))
			{
				if($this->request->getPost())
				{
					$code = $this->request->getPost('code');
					
					if($get_user_code[0]->expirytime < time())
					{
						$this->session->remove('2fa');
						$this->general_model->delete_condition('twofactorscode',array('email'=>$this->session->get('email')));
						$this->session->setFlashdata('error',getlang('code verlopen!'));
						return redirect()->to(base_url(ADMIN_URL.'/login'));
					}
					if($code == $get_user_code[0]->code)
					{
						$conditions = array('email'=>$this->session->get('email'));
						$get_user = $this->auth_model->loginadmin($conditions);
						$this->auth_model->setAdminSession($conditions);
						$datetimeupdate = date('Y-m-d H:i:s');
						if(!empty($get_user[0]->last_login)){ 
							$insert['last_login'] = $get_user[0]->last_login.','.$datetimeupdate; 
						} else {
							$insert['last_login'] = $datetimeupdate;
						}
						$response = $this->general_model->update_data("users",$insert,array('id'=>$get_user[0]->id));
						$ip = getIPAddress();
						$insert_log_act = array("email" => $get_user[0]->email,"login_status" => 'Success',"reason" => 'Successfully logged',"login_data_time" => date('Y-m-d H:i:s'),'ip_address'=>$ip);
						$this->general_model->insert_data("user_login_activity",$insert_log_act);
						
						$this->general_model->delete_condition('twofactorscode',array('code'=>$code,'email'=>$this->session->get('email')));

						$this->session->remove('2fa');
                		
						$this->session->setFlashdata('Success_message',getlang('beheerder inloggen succesvol'));
						return redirect()->to(base_url(ADMIN_URL.'/dashboard') );
					}
					else 
					{
						$this->session->setFlashdata('error',getlang('Ongeldige code'));
						return redirect()->to(base_url(ADMIN_URL.'/2fa'));
					}
				}
				$this->outputData = [
					'request' => $this->request
				];
				return view('beheerpaneel/auth/2fa',$this->outputData);
			}
			else
			{
				$this->session->remove('2fa');
				$this->general_model->delete_condition('twofactorscode',array('email'=>$this->session->get('email')));
				$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			}
			
		}	
		else
		{
			$this->session->remove('2fa');
			
			$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
			return redirect()->to(base_url(ADMIN_URL.'/login'));
		}
		
	}
	

	function regenerate_twofa_code()
	{
		if(!empty($this->session->get('2fa')) && !empty($this->session->get('email')))
		{
			$this->session = \Config\Services::session();
			$this->general_model->delete_condition('twofactorscode',array('email'=>$this->session->get('email')));
			$random_code = random_code();
			$get_user = $this->general_model->fetch_data('users',array('email'=>$this->session->get('email')));
			$email_values = array(
				'name'=>$get_user[0]->name.' '.$get_user[0]->last_name,
				'code'=>$random_code,
				'site_name'=>get_settings('site_name'),
			);
			$email_template = M('TWOFACTOR', $email_values);

			if ($email_template[0]->status == '1') {
				$this->Email_model->sendHtmlMail($this->session->get('email'), $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message);
			}
			$insert_values = array('code'=>$random_code,'email'=>$this->session->get('email'),'expirytime'=>time() + (60 * 60));
			$this->general_model->insert_data('twofactorscode',$insert_values);
			$this->session->setFlashdata('Success_message',getlang('code opnieuw verzonden!'));
			return redirect()->to(base_url(ADMIN_URL.'/2fa') );
		}
		else
		{
			$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
			return redirect()->to(base_url(ADMIN_URL.'/login'));
		}

		
	}
	
	public function forgot_password(){
	
	
		if($this->request->getVar())
		{
			$username = $this->request->getVar('login');
			$conditions = array('email'=>$username);
			$get_user = $this->auth_model->loginadmin($conditions);
			
			
			if($get_user)
			{
			
				$random_verification_code = random_string('alnum', 6);
				$verification_data = array(
					"type" => "reset_password",
					"code" => $random_verification_code,
					"params" => serialize(array(
						"email" => $get_user[0]->email,
						"expire_time" => time() + (24 * 60 * 60)
					))
				);
				$email_values = array(
					'name'=>$get_user[0]->name.' '.$get_user[0]->last_name,
					'code'=>$random_verification_code,
					'site_name'=>get_settings('site_name'),
					'resetpassword_url'=>base_url('beheerpaneel/login/reset_password'),
				);
				$email_template = M('ADMINFORGETPASSWORD', $email_values);
	
				if ($email_template[0]->status == '1') {
					$this->Email_model->sendHtmlMail($get_user[0]->email, $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message);
				}
				
				$this->general_model->insert_data('reset_verification',$verification_data);
				
			
				// return redirect()->to(base_url('beheerpaneel/login/reset_password/'.$random_verification_code) );
				return redirect()->to(base_url('beheerpaneel/login/authentication') );

			
			} else {
			
					$this->session->setFlashdata('adminerror', getlang('Sorry,_er_is_geen_account_met_dit_e-mailadres.'));
					return redirect()->to(base_url('beheerpaneel/login/forgot_password') );
			}
			
		}
		
		// return view('beheerpaneel/auth/forget_password');
		return view('beheerpaneel/auth/forget_password');
	
	}
	
	
	
	public function reset_password($key){
	
		$valid_key = $this->is_valid_reset_password_key($key);
		
        if ($valid_key) {
		
			
			if ($this->request->getMethod() == "post") {
				$rules = [
					'pass' => 'required|min_length[8]|max_length[20]',
					'reset_pass' => 'matches[pass]'
				];
				  
				if($this->validate($rules)){
			
					$email = get_array_value($valid_key, "email");
					$update_values = array();
					$update_values['password'] = hash('sha512',$this->request->getVar('reset_pass'));
					$this->general_model->update_condition('users',$update_values,array('email'=>$email));
					$this->session->setFlashdata('adminsuccess', "Wachtwoord succesvol veranderd!!. U kunt nu inloggen met uw nieuwe wachtwoord");
					return redirect()->to(base_url('beheerpaneel/login') );
					
				} else {

			// echo "<pre>";print_r($valid_key);exit;

					
					 $data['validation'] = $this->validator;
           			 echo view('beheerpaneel/auth/reset_password', $data);
			
			
				}
			}
			
		
		} else {
		
			$this->session->setFlashdata('adminerror', "Sorry, code is verlopen!! ");
			return redirect()->to(base_url('beheerpaneel/login/forgot_password') );
		}
		
		
		return view('beheerpaneel/auth/reset_password');
	
	}
	public function resetpassword(){
	
		if(isAdmin())
		{
			return redirect()->to(base_url('beheerpaneel/dashboard') );
		}
		
		
			
		if ($this->request->getPost()) {
				// $rules = [
				// 	'pass' => 'required|min_length[8]|max_length[20]',
				// 	'reset_pass' => 'matches[pass]'
				// ];
				  
				// if($this->validate($rules)){
			
					$email = $this->request->getPost('email');
					$update_values = array();
					$update_values['password'] = hash('sha512',$this->request->getVar('reset_pass'));
					$this->general_model->update_condition('users',$update_values,array('email'=>$email));
					$this->session->remove('resetcode');
					$this->session->remove('resetemail');
					$this->session->setFlashdata('adminsuccess', "Password changed successfully!!. you can now signin with your new password ");
					return redirect()->to(base_url('beheerpaneel/login') );
					
				
				// }
			
			
		
		} 
		

		// if($this->request->getPost())
		// {

		// }
		// echo "<pre>";
		// print_r($this->session->get('resetcode'));
		// print_r($this->session->get('resetemail'));
		// exit;
		
		if(!empty($this->session->get('resetcode')) && !empty($this->session->get('resetemail')))
		{
			$this->outputData['resetcode'] = $this->session->get('resetcode');
			$this->outputData['resetemail'] = $this->session->get('resetemail');
			return view('beheerpaneel/auth/resetpassword',$this->outputData);
		}
		else
		{
			$this->session->setFlashdata('adminerror', get_lang('something_went_wrong!'));
			return redirect()->to(base_url('beheerpaneel/login/forgot_password') );
		}

		
		 
		// return view('beheerpaneel/auth/authentication',$this->outputData);
	
	}


	public function authentication()
	{
		if(isAdmin())
		{
			return redirect()->to(base_url('beheerpaneel/dashboard') );
		}
		if($this->request->getPost())
		{
			$key = $this->request->getPost('code');
			$valid_key = $this->is_valid_reset_password_key($key);

			if ($valid_key) {
				$email = get_array_value($valid_key, "email");
				$sess_array = array('resetcode'=>$key,'resetemail'=>$email);
				$this->session->set($sess_array);
				$this->session->setFlashdata('adminsuccess', "Code is correct");
				return redirect()->to(base_url('beheerpaneel/login/resetpassword') );
			}
			else {
		
				$this->session->setFlashdata('adminerror', "Sorry, Code is expired!! ");
				return redirect()->to(base_url('beheerpaneel/login/forgot_password') );
			}
		}

		return view('beheerpaneel/auth/authentication',$this->outputData);
		
	}
	
	
	
	
	 //check valid key
    private function is_valid_reset_password_key($verification_code = "") {

        if ($verification_code) {
            $options = array("code" => $verification_code, "type" => "reset_password");
            $verification_info = $this->general_model->fetch_data('reset_verification',$options);
			
            if ($verification_info) {
                $reset_password_info = unserialize($verification_info[0]->params);

                $email = get_array_value($reset_password_info, "email");
                $expire_time = get_array_value($reset_password_info, "expire_time");

                if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $expire_time && $expire_time > time()) {
                    return array("email" => $email);
                }
            }
        }
    }





}

