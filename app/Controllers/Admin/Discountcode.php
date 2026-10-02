<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class discountcode extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/discountcode/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $order_by='`id` DESC';
				// $this->outputData['discountcodes'] = $this->general_model->fetch_data('discountcode',null,$order_by);

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['discountcodes'] = $this->general_model->fetch_data('discountcode',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'code' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$discountcodes = $this->outputData['discountcodes'] = $this->general_model->fetch_limited('discountcode',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($discountcodes as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($discountcodes);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($discountcodes);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/discount_code/manage',$this->outputData);
		}


		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/discountcode/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->code."</a>";
			
			$used_counts = get_discount_code_used_counts($data->code);
			$date = strtotime($data->valid_date);
				$dis_date=  date('d-m-Y',$date);
			$edit_url =base_url(ADMIN_URL.'/discountcode/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/discountcode/delete/'.$data->id);
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
			$data->type,
			$data->amount,
			$data->count,
			$used_counts,
			$dis_date,
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
						'code' => [
							'label' => getlang("code"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'type' => [
							'label' => getlang("type"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'valid_date' => [
							'label' => getlang("Discountcode_Valid_Date"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'amount' => [
							'label' => getlang("Discount_Amount"),
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

						return redirect()->to(ADMIN_URL.'/discountcode/add');
						exit;
					}

					$check_keyword = $this->check_discountcode($this->request->getVar('code'));
					// echo $check_keyword;
					if($check_keyword)
					{
						$this->session->setFlashdata('error',getlang('kortingscode bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/discountcode/add') );
					}
					
					// exit;

					$insert_values = array(
						'code' => $this->request->getVar('code'),
						'type' => $this->request->getVar('type'),
						'amount' => $this->request->getVar('amount'),
						'count' => !empty($this->request->getVar('count'))?$this->request->getVar('count'):0,
						'auser_id' => $this->session->get('admin_id'),
						'valid_date' => $this->request->getVar('valid_date'),
					);
				
					$this->general_model->insert_data('discountcode', $insert_values);
					
					$this->session->setFlashdata('adminsuccess',getlang('kortingscode succesvol aangemaakt'));
					return redirect()->to(base_url(ADMIN_URL.'/discountcode/manage') );
				}
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/discount_code/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

				$discountcode = $this->general_model->fetch_data('discountcode',array('id'=>$id));
				if(empty($discountcode))
				{
					return redirect()->to(base_url(ADMIN_URL.'/discountcode/manage') );
				}
				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'code' => [
							'label' => getlang("code"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'type' => [
							'label' => getlang("type"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'valid_date' => [
							'label' => getlang("Discountcode_Valid_Date"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'amount' => [
							'label' => getlang("Discount_Amount"),
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

						return redirect()->to(ADMIN_URL.'/discountcode/edit/'.$id);
						exit;
					}

					$update_values = array(
						'code' => $this->request->getVar('code'),
						'type' => $this->request->getVar('type'),
						'amount' => $this->request->getVar('amount'),
						'count' => !empty($this->request->getVar('count'))?$this->request->getVar('count'):0,
						'valid_date' => $this->request->getVar('valid_date'),
						'auser_id' => $this->session->get('admin_id'),
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('discountcode', $update_values,$id);
					
					$this->session->setFlashdata('adminsuccess',getlang('kortingscode succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/discountcode/manage') );
				}
				
				$this->outputData['discountcode'] = $this->general_model->fetch_data('discountcode',array('id'=>$id));
				
				$this->admin_template('beheerpaneel/discount_code/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$this->general_model->delete_data('discountcode',$id);
			return redirect()->to(base_url(ADMIN_URL.'/discountcode/manage'));
		}


		function check_discountcode($keyword)
		{
			$check_discountcode = $this->general_model->fetch_data('discountcode',array('code'=>$keyword));
			if(!empty($check_discountcode))
			{
				return true;
			}else
			{
				return false;
			}
		}


	}