<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Faq extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}
		
		
		function faq_manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				{
				// $this->outputData['faq'] = $this->general_model->fetch_data('faq');	

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['faq'] = $this->general_model->fetch_data('faq',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'title' => '%' . $search . '%',
							'description' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					if(!empty($searchCondition)){
						$faq = $this->outputData['faq'] = $this->general_model->fetch_without_limited('faq',$condition,$order_by,NULL,$searchCondition);
					}else{
						$faq = $this->outputData['faq'] = $this->general_model->fetch_limited('faq',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					}

					$faq1 = $this->outputData['faq'] = $this->general_model->fetch_limited('faq',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($faq1 as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($faq);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($faq);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				//$this->admin_template('beheerpaneel/faq/faq_manage',$this->outputData);
				$this->admin_template('beheerpaneel/faq/faq_manage',$this->outputData);
			}
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/faq/faq_edit/'.$data->id);
			$name = "<a  href='$url'>".strip_tags($data->title)."</a>";
			
			$description = $data->description;
			$category_name =get_faq_category_name($data->faq_cat_id);
			if($data->status == '1'){$status = getlang("inactive");}else{$status = getlang("active");}
			$edit_url =base_url(ADMIN_URL.'/faq/faq_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/faq/faq_delete/'.$data->id);
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
			$category_name,
			$status,
			$last_r,
			);
		
			
			return $row_data;
		}


		function faq_add(){
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
						'title' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'faq_cat_id' => [
							'label' => getlang("category"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'description' => [
							'label' => getlang("description"),
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

						return redirect()->to(ADMIN_URL.'/faq/faq_add');
						exit;
					}

					$insert_values = array(
						'title' => $this->request->getVar('title'),
						'faq_cat_id' =>  $this->request->getVar('faq_cat_id'),
						'description' => $this->request->getVar('description'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id')
					);
					
				
				
					$this->general_model->insert_data('faq',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang("FAQ succesvol aangemaakt"));
					return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage') );
				}
				
				$this->outputData['faq_category_detail'] = $this->general_model->fetch_data('faq_category');	

				//$this->admin_template('beheerpaneel/faq/faq_add',$this->outputData);
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/faq/faq_add',$this->outputData);
		}
		
		
		function faq_edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$category_data = $this->general_model->fetch_data('faq_category',array('id'=>$id));

				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'title' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'faq_cat_id' => [
							'label' => getlang("category"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'description' => [
							'label' => getlang("description"),
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

						return redirect()->to(ADMIN_URL.'/faq/faq_edit/'.$id);
						exit;
					}
				 	$update_values = array(
						'title' => $this->request->getVar('title'),
						'faq_cat_id' =>  $this->request->getVar('faq_cat_id'),
						'description' => $this->request->getVar('description'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id')
					);
					
				
					$this->general_model->update_data('faq',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang("FAQ succesvol geupdatet"));
					return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage') );
				}
				
				$this->outputData['faq_category_detail'] = $this->general_model->fetch_data('faq_category');	
				$this->outputData['faq_data'] = $this->general_model->fetch_data('faq',array('id'=>$id));
				//$this->admin_template('beheerpaneel/faq/faq_edit',$this->outputData);
				$this->admin_template('beheerpaneel/faq/faq_edit',$this->outputData);

		}


		function faq_delete(){
			
			$id=$this->request->uri->getSegment(4);
			$category_data = $this->general_model->fetch_data('faq_category',array('id'=>$id));
			$products      = $this->general_model->fetch_data('faq', array('faq_cat_id'=>$id));

			$this->general_model->delete_condition('faq',array('id'=>$id));
			return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage'));
		}


		function faq_manage_cat(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				{
				
					$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['faq_category_detail'] = $this->general_model->fetch_data('faq_category',NULL,$order_by);
					$condition = array('id!='=>'','status'=>0);
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
					$faq_category_detail = $this->outputData['faq_category_detail'] = $this->general_model->fetch_limited('faq_category',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($faq_category_detail as $data) {
						$result[] = $this->_make_rowcat($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($faq_category_detail);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($faq_category_detail);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}

				// $this->outputData['faq_category_detail'] = $this->general_model->fetch_data('faq_category', array('status'=>0));	
				$this->admin_template('beheerpaneel/faq/faq_manage_cat',$this->outputData);
			}
		}

		private function _make_rowcat($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

			$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if($data->status == '1'){$status = getlang("inactive");}else{$status = getlang("active");}
			$edit_url =base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/faq/faq_cat_delete/'.$data->id);
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
			$status,
			$last_r,
			);
		
			
			return $row_data;
		}

		function faq_cat_add(){
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

						return redirect()->to(ADMIN_URL.'/faq/faq_cat_add');
						exit;
					}

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id')
					);
					
					
				
					$this->general_model->insert_data('faq_category',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang("Categorie is succesvol aangemaakt"));
					return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage_cat') );
				}
                
				//$this->admin_template('beheerpaneel/faq/faq_cat_add');
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/faq/faq_cat_add',$this->outputData);
		}

		function faq_cat_edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$category_data = $this->general_model->fetch_data('faq_category',array('id'=>$id));

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

						return redirect()->to(ADMIN_URL.'/faq/faq_cat_edit/'.$id);
						exit;
					}
					$update_values = array(
						'name' => $this->request->getVar('name'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id'),
						'mod_date' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('faq_category',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang("Categorie is succesvol bijgewerkt"));
					return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage_cat') );
				}
				$this->outputData['category_data'] = $this->general_model->fetch_data('faq_category',array('id'=>$id));
				//$this->admin_template('beheerpaneel/faq/faq_cat_edit',$this->outputData);
				$this->admin_template('beheerpaneel/faq/faq_cat_edit',$this->outputData);


		}

		function faq_cat_delete(){
			
			$id=$this->request->uri->getSegment(4);
			$category_data = $this->general_model->fetch_data('faq_category',array('id'=>$id));
			$products      = $this->general_model->fetch_data('faq', array('faq_cat_id'=>$id));

			$this->general_model->delete_condition('faq',array('faq_cat_id'=>$id));
			$this->general_model->delete_data('faq_category',$id);
			return redirect()->to(base_url(ADMIN_URL.'/faq/faq_manage_cat'));
		}

		function changeEntry()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				if($this->request->getVar('selected'))
				{
					$selected = $this->request->getVar('selec	ted');
					$this->session->set('cat_entries', $selected);
					return true;
				}
				else
				{
					return false;
				}
			}
		}

		


	}