<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Email extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		
		function email_manage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				// $this->outputData['email_informations'] = $this->general_model->fetch_data('email_template');

			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['email_informations'] = $this->general_model->fetch_data('email_template',NULL,$order_by);
				$condition = array('id!='=>'');
				$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
				$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
				$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

				$searchCondition = array();
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'key' => '%' . $search . '%',
						'subject' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				if(!empty($searchCondition)){
					$email_informations = $this->outputData['email_informations'] = $this->general_model->fetch_without_limited('email_template',$condition,$order_by,NULL,$searchCondition);

				}else{
					$email_informations = $this->outputData['email_informations'] = $this->general_model->fetch_limited('email_template',$condition,$limit,$offset,$order_by,NULL,$searchCondition);

				}
				$email_informations1 = $this->outputData['email_informations'] = $this->general_model->fetch_limited('email_template',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($email_informations1 as $data) {
					$result[] = $this->_make_row($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($email_informations);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($email_informations);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/email/email_manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

			$first_letter = getFirstLetters($data->key,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->key<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/email/email_edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if($data->status == 1){$status = getlang("active");}else{$status = getlang("inactive");}
			$edit_url =base_url(ADMIN_URL.'/email/email_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/email/email_delete/'.$data->id);
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
			$data->subject,
			$status,
			$last_r,
			);
		
			
			return $row_data;
		}

		function email_add(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if($this->request->getPost()){
					// print_r('hh');exit;
					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'key' => [
							'label' => getlang("key"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'subject' => [
							'label' => getlang("subject"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'message' => [
							'label' => getlang("message"),
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
 
						return redirect()->to('beheerpaneel/email/email_add');
						exit;
					}

					$insert_values = array(
						'key' => $this->request->getVar('key'),
						'subject' => $this->request->getVar('subject'),
						'message' => $this->request->getVar('message'),
						'from_mail' => $this->request->getVar('from_mail'),
						'cc_mail' => $this->request->getVar('cc_mail'),
						'auser_id' => $this->session->get('admin_id'),
						'status' => $this->request->getVar('status'),

					);
				
					$this->general_model->insert_data('email_template',$insert_values);
					
					$this->session->setFlashdata('Success_message',"E-mailmelding is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/email/email_manage') );
				}

			
				$this->admin_template('beheerpaneel/email/email_add',$this->outputData);
		}

		function email_edit($id){



			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$email_data = $this->general_model->fetch_data('email_template',array('id'=>$id));

				if(!empty($this->request->getPost())){

					// echo "yes";
					// exit;

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'key' => [
							'label' => getlang("key"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'subject' => [
							'label' => getlang("subject"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'message' => [
							'label' => getlang("message"),
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
 
						return redirect()->to('beheerpaneel/email/email_add');
						exit;
					}

					$update_values = array(
						'key' => $this->request->getVar('key'),
						'subject' => $this->request->getVar('subject'),
						'message' => $this->request->getVar('message'),
						'from_mail' => $this->request->getVar('from_mail'),
						'cc_mail' => $this->request->getVar('cc_mail'),
						'auser_id' => $this->session->get('admin_id'),
						'status' => $this->request->getVar('status'),
					);
				
					$this->general_model->update_data('email_template',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',"E-mailmelding succesvol bijgewerkt");
					return redirect()->to(base_url('beheerpaneel/email/email_manage') );
				}
				
				$this->outputData['email_information'] = $email_data;
				$this->admin_template('beheerpaneel/email/email_edit',$this->outputData);

		}

		function email_delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('email_template',$id);
			return redirect()->to(base_url('beheerpaneel/email/email_manage'));
		}


	}