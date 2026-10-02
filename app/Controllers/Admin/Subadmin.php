<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\Auth_model;

	class Subadmin extends BaseController 
	{
        public function __construct() 
		{
			$this->auth_model = new Auth_model();
			$this->session = \Config\Services::session();	
		}

        public function index()
        {
            if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
                return redirect()->to(base_url(ADMIN_URL.'/subadmin/manage_sub_admin') );
            }

        }

        function manage_sub_admin()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				// $this->outputData['subAdmins'] = $this->auth_model->getMemberByCondition(array('user_type' => 'S'));

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['subAdmins'] = $this->general_model->fetch_data('users',array('user_type' => 'S'),$order_by);
					$condition = array('id!='=>'','user_type' => 'S');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'name' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$subAdmins = $this->outputData['subAdmins'] = $this->general_model->fetch_limited('users',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($subAdmins as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($subAdmins);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($subAdmins);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				$this->admin_template('beheerpaneel/auth/manage_sub_admin', $this->outputData);
			}
		}


		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			// $url = base_url(ADMIN_URL.'/subadmin/edit_sub_admin/'.$data->id);
			// $name = "<a  href='$url'>".strip_tags($data->name)."</a>";

			$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/subadmin/edit_sub_admin/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if (!empty($data->image) && file_exists(FCPATH . 'uploads/user/' . $data->image)) {
				$image_url = image_url('uploads/user/' . $data->image);
				$image_src = "<img src='$image_url' alt='$data->name' class='thumb' width='36' height='36'>";
			}
			else
			{
				$image_url = image_url('uploads/noimage.jpg');
				$image_src = "<img src='$image_url' alt='$data->name' class='thumb' width='36' height='36'>";
			}
			$edit_url =base_url(ADMIN_URL.'/subadmin/edit_sub_admin/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/subadmin/delete_sub_admin/'.$data->id);
			$remove_lang = getlang('remove');
			$edit_lang = getlang('edit');
			$last_r = "<ul class='nk-tb-actions gx-1'>
				<li>
					<div class='drodown'>
						<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
						<div class='dropdown-menu dropdown-menu-end'>
							<ul class='link-list-opt no-bdr'>
								<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
								<li><a href='$remove_url' data-url='$remove_url' class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>";
			$row_data = array(
				$first_,
			$data->id,
			$name,
			$data->email,
			$image_src,
			$last_r,
			);
		
			
			return $row_data;
		}

        function add_sub_admin()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				if($this->request->getVar())
				{
					$name     = $this->request->getVar('name');	
					$email    = $this->request->getVar('email');	
					$password = $this->request->getVar('password');
					
                    $check_email = $this->check_email_exist($email);
					if($check_email)
					{
						$this->session->setFlashdata('error', getlang('e-mail bestaat al'));
						return redirect()->to(ADMIN_URL.'/subadmin/add_sub_admin');
						exit;
					}

					$uploadPath = 'uploads/user'; 
					$file = $this->request->getFile('image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/user',$imagename);
					 	
					 	
				 	// }
					$options = $this->request->getVar('options');
					$opt_ = array();
					if(!empty($options)){
						foreach($options as $op){
							$options_data = $this->general_model->fetch_data('admin_menu',array('parent_id'=> $op),null,'id,parent_id');
							if(!empty($options_data)){
								foreach($options_data as $data){
									$opt_[] = $data->id;
								}
								
							}
						}
						foreach($options as $op){
							$opt_[] = $op;
						}
					}
					$options  = $opt_;
                    $dashboardoptions = $this->request->getVar('dashboardoptions');

					$subAdmin = array(
						'name' 		=> !empty($name) ? $name : 'sub-admin', 
						'email' 	=> !empty($email) ? $email : '', 
						'image' => !empty($imagename) ? $imagename : '',
						'password' 	=> !empty($password)? hash('sha512',$password) : '',
						'user_type' => 'S', 
                        'enable_2fa' => !empty($this->request->getPost('enable_2fa'))?$this->request->getPost('enable_2fa'):0,
						'enabled_options'=>!empty($options)?serialize($options):'',
                        'dashboardoptions'=>!empty($dashboardoptions)?serialize($dashboardoptions):'',
					);


					$id = $this->auth_model->addMember($subAdmin);
					$this->session->setFlashdata('Success_message',getlang("Subbeheerder succesvol toegevoegd"));
					return redirect()->to(base_url(ADMIN_URL.'/subadmin/manage_sub_admin') );
				}
				$this->admin_template('beheerpaneel/auth/add_sub_admin',$this->outputData);
			}
		}

		function edit_sub_admin($id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				$sadmin = $this->auth_model->getMemberByCondition(array('id'=>$id));

				if($this->request->getVar())
				{
					$name     = $this->request->getVar('name');	
					$email    = $this->request->getVar('email');	
					$password = $this->request->getVar('oldpassword');
					$enc_pass =  !empty($password)? hash('sha512',$password) : $sadmin[0]->password;

					$email_check = $this->general_model->fetch_row('users' , array('id' => $id,'email' => $email));
					if(empty($email_check)){
						$check_email = $this->check_email_exist($email);
						if($check_email)
						{
							$this->session->setFlashdata('error', getlang('e-mail bestaat al'));
							return redirect()->to(ADMIN_URL.'/subadmin/edit_sub_admin/'.$id);
							exit;
						}
					}

					$uploadPath = 'uploads/user'; 
					$file = $this->request->getFile('image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $sadmin[0]->image;
					}

					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/user',$imagename);
					 	
					 	
				 	// }else{
				 	// 	$imagename = $sadmin[0]->image;
				 	// }
					$options = $this->request->getVar('options');
					$opt_ = array();
					if(!empty($options)){
						foreach($options as $op){
							$options_data = $this->general_model->fetch_data('admin_menu',array('parent_id'=> $op),null,'id,parent_id');
							if(!empty($options_data)){
								foreach($options_data as $data){
									$opt_[] = $data->id;
								}
								
							}
						}
						foreach($options as $op){
							$opt_[] = $op;
						}
					}
					$options  = $opt_;
                    $dashboardoptions = $this->request->getVar('dashboardoptions');
					$subAdmin = array(
						'name' 		=> !empty($name) ? $name : 'sub-admin', 
						'email' 	=> !empty($email) ? $email : '', 
						'image' => !empty($imagename) ? $imagename : '',
						'user_type' => 'S', 
                        'enable_2fa' => !empty($this->request->getPost('enable_2fa'))?$this->request->getPost('enable_2fa'):0,
						'enabled_options'=>!empty($options)?serialize($options):'',
                        'dashboardoptions'=>!empty($dashboardoptions)?serialize($dashboardoptions):'',
					);

					$pass_check = $this->general_model->fetch_row('users' , array('id' => $id,'password' => $password));
					if(empty($pass_check)){
						$subAdmin['password'] = $enc_pass;
					}

					$this->auth_model->updateMember($subAdmin, array('id'=>$id));
					$this->session->setFlashdata('Success_message',getlang("Subbeheerdersgegevens zijn succesvol bijgewerkt"));
					return redirect()->to(base_url(ADMIN_URL.'/subadmin/manage_sub_admin'));
				}
				$this->outputData['admin_details'] 	= $sadmin;
				$this->outputData['access'] 	= !empty($sadmin) && !empty($sadmin[0]->enabled_options)? unserialize($sadmin[0]->enabled_options) : '';
                $this->outputData['dashboardaccess'] 	= !empty($sadmin) && !empty($sadmin[0]->dashboardoptions)? unserialize($sadmin[0]->dashboardoptions) : '';
				$this->admin_template('beheerpaneel/auth/edit_sub_admin', $this->outputData);
			}
		}

		function delete_sub_admin($id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				$this->db->table('users')->where(array('id'=>$id))->delete();
				$this->session->setFlashdata('Success_message',getlang("De gegevens van de subbeheerder zijn succesvol verwijderd"));
				return redirect()->to(base_url(ADMIN_URL.'/subadmin/manage_sub_admin'));
			}
		}

        public function check_email_exist($email)
		{
			$check_data = $this->general_model->fetch_data('users',array('email' => $email));
			if(empty($check_data))
			{
				
				return false;
			}
			else
			{
				return true;

			}//If end
		}

		function email_exist()
		{
			if($this->request->getVar())
			{
				$email   = $this->request->getVar('email');
				$exemail = $this->request->getVar('exemail');

				if(!empty($exemail) && ($exemail == $email))
				{
					echo 'true';
				}
				else
				{
					$admin = $this->auth_model->getMemberByCondition(array('email' => $email));
					echo !empty($admin) ? 'false' : 'true';
				}
			}
			else
			{
				echo 'false';
			}
		}

    }
?>