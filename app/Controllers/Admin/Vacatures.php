<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Vacatures extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}
		
		
		function vacatures_manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				{
				// $order  = 'id asc';
				// $this->outputData['vacatures'] = $this->general_model->fetch_data('vacatures',NULL,$order);	

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['vacatures'] = $this->general_model->fetch_data('vacatures',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'title' => '%' . $search . '%',
							'short_description' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$vacatures = $this->outputData['vacatures'] = $this->general_model->fetch_limited('vacatures',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($vacatures as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($vacatures);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($vacatures);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				
				$this->admin_template('beheerpaneel/vacatures/vacatures_manage',$this->outputData);
			}
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/vacatures/vacatures_edit/'.$data->id);
			$name = "<a  href='$url'>".strip_tags($data->title)."</a>";
			
			$description = substr($data->short_description,0,50);
			if($data->status == '1'){$status = getlang("inactive");}else{$status = getlang("active");}
			$edit_url =base_url(ADMIN_URL.'/vacatures/vacatures_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/vacatures/vacatures_delete/'.$data->id);
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
			$description,
			$status,
			$last_r,
			);
		
			
			return $row_data;
		}


		function vacatures_add(){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
 			
				if(!empty($this->request->getVar())){
					

					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'title' => [
							'label' => getlang("title"),
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

						return redirect()->to(ADMIN_URL.'/vacatures/vacatures_add');
						exit;
					}

					$insert_values = array(
						'title' => $this->request->getVar('title'),
						'short_description' => $this->request->getVar('short_description'),
						'description' => $this->request->getVar('description'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id')
					);
					
					
				
					$this->general_model->insert_data('vacatures',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang("vacatures succesvol aangemaakt"));
					return redirect()->to(base_url(ADMIN_URL.'/vacatures/vacatures_manage') );
				}
				
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/vacatures/vacatures_add',$this->outputData);
		}
		
		
		function vacatures_edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$category_data = $this->general_model->fetch_data('vacatures',array('id'=>$id));

				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'title' => [
							'label' => getlang("title"),
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

						return redirect()->to(ADMIN_URL.'/vacatures/vacatures_edit/'.$id);
						exit;
					}

				 	$update_values = array(
						'title' => $this->request->getVar('title'),
						'short_description' => $this->request->getVar('short_description'),
						'description' => $this->request->getVar('description'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id')
					);
					
				
					$this->general_model->update_data('vacatures',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang("vacatures succesvol bijgewerkt"));
					return redirect()->to(base_url('beheerpaneel/vacatures/vacatures_manage') );
				}
				
 				$this->outputData['vacatures_data'] = $this->general_model->fetch_data('vacatures',array('id'=>$id));
				$this->admin_template('beheerpaneel/vacatures/vacatures_edit',$this->outputData);

		}


		function vacatures_delete(){
			
			$id=$this->request->uri->getSegment(4);
 			$this->general_model->delete_condition('vacatures',array('id'=>$id));
			$vacature_submitted_data = $this->general_model->fetch_data('vacature',array('vacature'=>$id));

			if(!empty($vacature_submitted_data)){
				foreach($vacature_submitted_data as $vacature)
				{
					if(!empty($vacature->cv_file))
					{
						unlink('./uploads/cv_file/'.$vacature->cv_file);
					}
				}
				
			}
			return redirect()->to(base_url(ADMIN_URL.'/vacatures/vacatures_manage'));
		}

		function vacatures_record_delete($id)
		{
			
 			
			$vacature_data = $this->general_model->fetch_data('vacature',array('id'=>$id));

			if(!empty($vacature_data)){
				if(!empty($vacature_data[0]->cv_file))
				{
					unlink('./uploads/cv_file/'.$vacature_data[0]->cv_file);
				}
			}
			$this->general_model->delete_condition('vacature',array('id'=>$id));
			return redirect()->to(base_url(ADMIN_URL.'/vacatures/vacatures_manage'));
		}


		function vacatures_records($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

			$get_submitted_vacatures_records = $this->general_model->fetch_data('vacature',array('vacature'=>$id));
			$this->outputData['vacatures_submitted_records_data'] = $get_submitted_vacatures_records;
			$this->admin_template('beheerpaneel/vacatures/vacatures_submit_records',$this->outputData);

		}

		 

	}