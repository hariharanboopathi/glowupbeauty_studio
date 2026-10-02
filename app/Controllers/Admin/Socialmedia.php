<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Socialmedia extends BaseController 
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
				// $this->outputData['socialmedias'] = $this->general_model->fetch_data('socialmedia');

				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['socialmedias'] = $this->general_model->fetch_data('socialmedia',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'name' => '%' . $search . '%',
							'lang_code' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$socialmedias = $this->outputData['socialmedias'] = $this->general_model->fetch_limited('socialmedia',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($socialmedias as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($socialmedias);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($socialmedias);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/socialmedia/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/socialmedia/edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if (!empty($data->icon) && file_exists(FCPATH . 'uploads/socialmedia/' . $data->icon)) {
				$image_url = image_url('uploads/socialmedia/' . $data->icon);
				$image_src = "<img src='$image_url' alt='$data->name' style='background-color:#000'>";
			}
			else
			{
				$image_url = image_url('uploads/noimage.jpg');
				$image_src = "<img src='$image_url' alt='$data->name'>";
			}
			$edit_url =base_url(ADMIN_URL.'/socialmedia/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/socialmedia/delete/'.$data->id);
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
			$data->link,
			$image_src,
			$last_r,
			);
		
			
			return $row_data;
		}

		function add(){
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
						'link' => [
							'label' => getlang("link"),
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

						return redirect()->to(ADMIN_URL.'/socialmedia/add');
						exit;
					}

					$file = $this->request->getFile('icon');
					
					if(!empty($file->getName()))
         			{   
         				$imagename = $file->getRandomName();
					 	$file->move('uploads/socialmedia',$imagename);
					 	
					 	
				 	}

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'link' => $this->request->getVar('link'),
						'active' => ($this->request->getVar('active')) ? $this->request->getVar('active') : 0,
						'icon' => ($imagename) ? $imagename : '',
						'auser_id' => $this->session->get('admin_id'),
					);
				
					$this->general_model->insert_data('socialmedia',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol toegevoegd'));
					return redirect()->to(base_url(ADMIN_URL.'/socialmedia/manage') );
				}
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');

				$this->admin_template('beheerpaneel/socialmedia/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$socialmedia_data = $this->general_model->fetch_data('socialmedia',array('id'=>$id));

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
						'link' => [
							'label' => getlang("link"),
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

						return redirect()->to(ADMIN_URL.'/socialmedia/manage');
						exit;
					}

					$file = $this->request->getFile('icon');

					if(!empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/socialmedia',$imagename);
					 	
					 	
				 	}else{
				 		$imagename = $socialmedia_data[0]->icon;
				 	}

					$update_values = array(
						'name' => $this->request->getVar('name'),
						'link' => $this->request->getVar('link'),
						'active' => ($this->request->getVar('active')) ? $this->request->getVar('active') : 0,
						'icon' => ($imagename) ? $imagename : '',
						'auser_id' => $this->session->get('admin_id'),
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('socialmedia',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/socialmedia/manage') );
				}
				
				$this->outputData['socialmedia_data'] = $this->general_model->fetch_data('socialmedia',array('id'=>$id));
				$this->admin_template('beheerpaneel/socialmedia/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('socialmedia',$id);
			return redirect()->to(base_url(ADMIN_URL.'/socialmedia/manage'));
		}


	}