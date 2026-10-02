<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Orderstatuses extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		
		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['orderstatuses'] = $this->general_model->fetch_data('orderstatuses');
			
				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['orderstatuses'] = $this->general_model->fetch_data('orderstatuses',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'name' => '%' . $search . '%',
							'subject' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$orderstatuses = $this->outputData['orderstatuses'] = $this->general_model->fetch_limited('orderstatuses',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($orderstatuses as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($orderstatuses);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($orderstatuses);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				$this->admin_template('beheerpaneel/orderstatuses/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			// $url = base_url(ADMIN_URL.'/orderstatuses/edit/'.$data->id);
			// $name = "<a  href='$url'>".strip_tags($data->name)."</a>";

			$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/orderstatuses/edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if($data->status == 1)
			{
				$status = getlang('active');
			}else
			{
				$status = getlang('inactive');
			}
			$edit_url =base_url(ADMIN_URL.'/orderstatuses/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/orderstatuses/delete/'.$data->id);
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
			// $data->id,
			$name,
			$data->subject,
			$status,
			$last_r,
			);
		
			
			return $row_data;
		}

		function add(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getVar())){

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
						'name' => [
							'label' => getlang("naam"),
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
 
						return redirect()->to(ADMIN_URL.'/orderstatuses/add');
						exit;
					}

					$insert_values = array(
						'key' => $this->request->getVar('key'),
						'name' => $this->request->getVar('name'),
						'subject' => $this->request->getVar('subject'),
						'message' => $this->request->getVar('message'),
						'from_mail' => $this->request->getVar('from_mail'),
						'cc_mail' => $this->request->getVar('cc_mail'),
						'auser_id' => $this->session->get('admin_id'),
						'status' => $this->request->getVar('status'),
                        'color' => $this->request->getVar('color'),

					);
				
					$this->general_model->insert_data('orderstatuses',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang("E-mailmelding is succesvol aangemaakt"));
					return redirect()->to(base_url('beheerpaneel/orderstatuses/manage') );
				}

			
				$this->admin_template('beheerpaneel/orderstatuses/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$orderstatuses_data = $this->general_model->fetch_data('orderstatuses',array('id'=>$id));
				if(empty($orderstatuses_data))
				{
					return redirect()->to(ADMIN_URL.'/orderstatuses/manage');
				}
				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'key' => [
							'label' => getlang("key"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'name' => [
							'label' => getlang("naam"),
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
 
						return redirect()->to(ADMIN_URL.'/email/email_add');
						exit;
					}

					$update_values = array(
						'key' => $this->request->getVar('key'),
						'name' => $this->request->getVar('name'),
						'subject' => $this->request->getVar('subject'),
						'message' => $this->request->getVar('message'),
						'from_mail' => $this->request->getVar('from_mail'),
						'cc_mail' => $this->request->getVar('cc_mail'),
						'auser_id' => $this->session->get('admin_id'),
						'status' => $this->request->getVar('status'),
                        'color' => $this->request->getVar('color'),
					);
				
					$this->general_model->update_data('orderstatuses',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang("E-mailmelding succesvol bijgewerkt"));
					return redirect()->to(base_url('beheerpaneel/orderstatuses/manage') );
				}
				
				$this->outputData['orderstatuses'] = $orderstatuses_data;
				$this->admin_template('beheerpaneel/orderstatuses/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('orderstatuses',$id);
			return redirect()->to(base_url('beheerpaneel/orderstatuses/manage'));
		}


	}