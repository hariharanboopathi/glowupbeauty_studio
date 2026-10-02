<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Languages extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/languages/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['languages'] = $this->general_model->fetch_data('languages');
				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['languages'] = $this->general_model->fetch_data('languages',NULL,$order_by);
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
					$languages = $this->outputData['languages'] = $this->general_model->fetch_limited('languages',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($languages as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($languages);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($languages);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/languages/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			// $url = base_url(ADMIN_URL.'/languages/edit/'.$data->id);
			// $name = "<a  href='$url'>".strip_tags($data->name)."</a>";

			$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/languages/edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if (!empty($data->image) && file_exists(FCPATH . 'uploads/languages/' . $data->image)) {
				$image_url = base_url('uploads/languages/' . $data->image);
				$image_src = "<img src='$image_url' alt='$data->name' width='60' height='50'>";
			}
			else
			{
				$image_url = base_url('uploads/noimage.jpg');
				$image_src = "<img src='$image_url' alt='$data->name' width='60' height='50'>";
			}
			$edit_url =base_url(ADMIN_URL.'/languages/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/languages/delete/'.$data->id);
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
			$data->lang_code,
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

					$file = $this->request->getFile('image');
					
					if(!empty($file->getName()))
         			{   
         				$imagename = $file->getRandomName();
					 	$file->move('uploads/languages',$imagename);
					 	
					 	
				 	}
					$insert_values = array(
						'lang_code' => $this->request->getVar('lang_code'),
						'name' => $this->request->getVar('name'),
						'image' => !empty($imagename) ? $imagename : '',
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
					);
				
					$this->general_model->insert_data('languages',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol toegevoegd'));
					return redirect()->to(base_url(ADMIN_URL.'/languages/manage') );
				}

				$this->admin_template('beheerpaneel/languages/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

				$languages_data = $this->general_model->fetch_data('languages',array('id'=>$id));
				if(!empty($this->request->getVar())){

					$file = $this->request->getFile('image');
					
					if(!empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/languages',$imagename);
					 	
					 	
				 	}else{
				 		$imagename = $languages_data[0]->image;
				 	}
					
				 	$update_values = array(
						'lang_code' => $this->request->getVar('lang_code'),
						'name' => $this->request->getVar('name'),
						'image' => ($imagename) ? $imagename : '',
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('languages',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/languages/manage') );
				}
				
				$this->outputData['languages'] = $this->general_model->fetch_data('languages',array('id'=>$id));
				$this->admin_template('beheerpaneel/languages/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$languages_data = $this->general_model->fetch_data('languages',array('id'=>$id));
			
			if(!empty($languages_data[0]->image)){
				unlink('./uploads/languages/'.$languages_data[0]->image);	
			}
			$this->general_model->delete_data('languages',$id);
			return redirect()->to(base_url(ADMIN_URL.'/languages/manage'));
		}


	}