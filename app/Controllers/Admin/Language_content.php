<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Language_content extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/language_content/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $order_by='`id` DESC';
				// $this->outputData['language_content'] = $this->general_model->get_multi_lng('language_content',$order_by);

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['language_content'] = $this->general_model->get_multi_lng('language_content',$order_by);
					$condition = array('id!='=>'','lang_code'=>$this->session->get('lang'));
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'keyword' => '%' . $search . '%',
							'content' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					// $language_content = $this->outputData['language_content'] = $this->general_model->get_multi_languaguefetch_limited('language_content',$condition,$limit,$offset,$order_by,NULL,$searchCondition);

					$language_content = $this->outputData['language_content'] = $this->general_model->fetch_limited('language_content',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					// echo "<pre>";
					// print_r($this->db->getLastquery());
					// exit;
					
					$result = array();
					foreach ($language_content as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($language_content);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($language_content);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/language_content/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			// $url = base_url(ADMIN_URL.'/language_content/edit/'.$data->id);
			// $name = "<a  href='$url'>".$data->keyword."</a>";
			$first_letter = getFirstLetters($data->keyword,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->keyword<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/language_content/edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			$edit_url =base_url(ADMIN_URL.'/language_content/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/language_content/delete/'.$data->id);
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
			$data->content,
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
						'keyword' => [
							'label' => getlang("keyword"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'content' => [
							'label' => getlang("content"),
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

						return redirect()->to(ADMIN_URL.'/language_content/add');
						exit;
					}

					$check_keyword = $this->check_language_keyword($this->request->getVar('keyword'));
					// echo $check_keyword;
					if($check_keyword)
					{
						$this->session->setFlashdata('error',getlang('taal trefwoord bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/language_content/add') );
					}
					
					// exit;

					$insert_values = array(
						'lang_code' => $this->request->getVar('lang_code'),
						'keyword' => $this->request->getVar('keyword'),
						'content' => $this->request->getVar('content'),
					);
				
					$this->general_model->ins_multi_lang('language_content', $insert_values, 'language_id');
					
					$this->session->setFlashdata('adminsuccess',getlang('taalinhoud is met succes gemaakt'));
					return redirect()->to(base_url(ADMIN_URL.'/language_content/manage') );
				}
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/language_content/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

				$Language_content = $this->general_model->get_multi_languague_cond('language_content',array('id'=>$id));
				if(empty($Language_content))
				{
					return redirect()->to(base_url(ADMIN_URL.'/language_content/manage') );
				}
				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'keyword' => [
							'label' => getlang("keyword"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'content' => [
							'label' => getlang("content"),
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

						return redirect()->to(ADMIN_URL.'/language_content/edit/'.$id);
						exit;
					}

					$update_values = array(
						'lang_code' => $this->request->getVar('lang_code'),
						'keyword' => $this->request->getVar('keyword'),
						'content' => $this->request->getVar('content'),
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->up_multi_lang('language_content', $update_values, array("id" => $id));
					
					$this->session->setFlashdata('adminsuccess',getlang('taalinhoud succesvol bijgewerkt'));
					return redirect()->to(base_url(ADMIN_URL.'/language_content/manage') );
				}
				
				$this->outputData['language_content'] = $this->general_model->get_multi_languague_cond('language_content',array('id'=>$id));
				
				$this->admin_template('beheerpaneel/language_content/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$this->general_model->delete_data('language_content',$id);
			return redirect()->to(base_url(ADMIN_URL.'/language_content/manage'));
		}


		function check_language_keyword($keyword)
		{
			$check_language_keyword = $this->general_model->fetch_data('language_content',array('keyword'=>$keyword));
			if(!empty($check_language_keyword))
			{
				return true;
			}else
			{
				return false;
			}
		}


	}