<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Shippingmethods extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function index()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				return redirect()->to(base_url(ADMIN_URL.'/shippingmethods/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $order_by='`id` DESC';
				// $this->outputData['shippingmethods'] = $this->general_model->fetch_data('shippingmethods',null,$order_by);

				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['shippingmethods'] = $this->general_model->fetch_data('shippingmethods',NULL,$order_by);
					$condition = array('id!='=>'');
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
					$shippingmethods = $this->outputData['shippingmethods'] = $this->general_model->fetch_limited('shippingmethods',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($shippingmethods as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($shippingmethods);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($shippingmethods);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/shippingmethods/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/shippingmethods/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";
			
			$edit_url =base_url(ADMIN_URL.'/shippingmethods/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/shippingmethods/delete/'.$data->id);
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
			$data->status,
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
						'name' => [
							'label' => getlang("Shippingmethod_Name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'status' => [
							'label' => getlang("Shippingmethod_Status"),
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

						return redirect()->to('beheerpaneel/shippingmethods/add');
						exit;
					}

					

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'status' => $this->request->getVar('status'),
						'auser_id' => $this->session->get('admin_id'),
						
					);
				
					$this->general_model->insert_data('shippingmethods', $insert_values);
					
					$this->session->setFlashdata('adminsuccess',getlang('verzendmethoden zijn succesvol aangemaakt'));
					return redirect()->to(base_url(ADMIN_URL.'/shippingmethods/manage') );
				}
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/shippingmethods/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

				$shippingmethods = $this->general_model->fetch_data('shippingmethods',array('id'=>$id));
				if(empty($shippingmethods))
				{
					return redirect()->to(base_url(ADMIN_URL.'/shippingmethods/manage') );
				}
				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("Shippingmethod_Name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'status' => [
							'label' => getlang("Shippingmethod_Status"),
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

						return redirect()->to(ADMIN_URL.'/shippingmethods/edit/'.$id);
						exit;
					}

					$update_values = array(
						'name' => $this->request->getVar('name'),
						'status' => $this->request->getVar('status'),
						'auser_id' => $this->session->get('admin_id'),
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('shippingmethods', $update_values,$id);
					
					$this->session->setFlashdata('adminsuccess',getlang('verzendmethoden zijn succesvol bijgewerkt'));
					return redirect()->to(base_url(ADMIN_URL.'/shippingmethods/manage') );
				}
				
				$this->outputData['shippingmethods'] = $this->general_model->fetch_data('shippingmethods',array('id'=>$id));
				
				$this->admin_template('beheerpaneel/shippingmethods/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$this->general_model->delete_data('shippingmethods',$id);
			return redirect()->to(base_url(ADMIN_URL.'/shippingmethods/manage'));
		}


		


	}