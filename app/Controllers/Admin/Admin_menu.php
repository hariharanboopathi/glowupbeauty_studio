<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Admin_menu extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
$this->cache = \Config\Services::cache();
			
		}

        function add(){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getVar())){

                    // Get user-entered data
					$previousInput = $this->request->getPost();
					// print_r($previousInput);
					// exit;
					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        // 'url' => [
						// 	'label' => getlang("url"),
						// 	'rules' => 'trim|required',
						// 	'errors' => [
						// 		'required' => '{field} '.getlang('field_is_required').'.',
						// 	],
						// ]


						
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/admin_menu/add');
						exit;
					}
                    if(!empty($this->request->getVar('url')))
                    {
                        $check_url = $this->check_url($this->request->getVar('url'));
                        // echo $check_keyword;
                        if($check_url)
                        {
                            $this->session->setFlashdata('error',getlang('url bestaat'));
                            return redirect()->to(base_url(ADMIN_URL.'/admin_menu/add') );
                        }
                    }
					
					

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'meta_title' => $this->request->getVar('meta_title'),
						'url' => $this->request->getVar('url'),
						'icon' => ($this->request->getVar('icon')) ? $this->request->getVar('icon') : "ni-files",
					);
				
					$this->general_model->insert_data('admin_menu',$insert_values);
					
                    $this->session->setFlashdata('adminsuccess',getlang('succesvol toegevoegd'));
					return redirect()->to(base_url(ADMIN_URL.'/admin_menu/menu_settings') );
				}
                $this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/admin_menu/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
                

				if(!empty($this->request->getVar())){

                    $validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/admin_menu/edit/'.$id);
						exit;
					}
                    // if(!empty($this->request->getVar('url')))
                    // {
                    //     $check_url = $this->check_url($this->request->getVar('url'));
                    //     // echo $check_keyword;
                    //     if($check_url)
                    //     {
                    //         $this->session->setFlashdata('error',getlang('url_exists'));
                    //         return redirect()->to(base_url(ADMIN_URL.'/admin_menu/edit/'.$id) );
                    //     }
                    // }
					
					

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'meta_title' => $this->request->getVar('meta_title'),
						'url' => $this->request->getVar('url'),
						'icon' => ($this->request->getVar('icon')) ? $this->request->getVar('icon') : "ni-files",
					);
				
					$this->general_model->update_data('admin_menu',$insert_values,$id);

				// echo "<pre>";
				// print_r($this->db->getLastquery());
				// exit; 
					
                    $this->session->setFlashdata('adminsuccess',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/admin_menu/menu_settings') );
				}
				
				$this->outputData['adminmenu'] = $this->general_model->fetch_row('admin_menu',array('id'=>$id));
				if(empty($this->outputData['adminmenu']))
				{
					return redirect()->to(base_url(ADMIN_URL.'/admin_menu/menu_settings') );
				}
				$this->admin_template('beheerpaneel/admin_menu/edit',$this->outputData);

		}
		

		function menu_settings(){


			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			
			else

				if(!empty($this->request->getVar())){

					$menu = $this->request->getVar('menu');
					$array_menu = json_decode($menu, true);

					adminupdateMenu($array_menu,null,null);

					$this->session->setFlashdata('Success_message',"Met succes opgeslagen");
					return redirect()->to(base_url(ADMIN_URL.'/admin_menu/menu_settings'));
				
				}
				
			$this->admin_template('beheerpaneel/admin_menu/menu_settings',$this->outputData);

		}



		function clean_cache(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );

			$this->cache->clean();
			$this->session->setFlashdata('Success_message',"Cache succesvol gewist");
			// return redirect()->to(base_url(ADMIN_URL.'/admin_menu/menu_settings'));
			return redirect()->to($this->request->getUserAgent()->getReferrer());
		}

        function check_url($name)
		{
			$check_url = $this->general_model->fetch_data('admin_menu',array('url'=>$name));
			if(!empty($check_url))
			{
				return true;
			}else
			{
				return false;
			}
		}


		

		


	}