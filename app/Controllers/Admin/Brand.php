<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Brand extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function index()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
				return redirect()->to(base_url(ADMIN_URL.'/brand/manage'));
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['brands'] = $this->general_model->fetch_data('brand');
			
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['brandss'] = $this->general_model->fetch_data('brand',NULL,$order_by);
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
					$brands = $this->outputData['brandss'] = $this->general_model->fetch_limited('brand',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($brands as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($brands);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($brands);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				$this->admin_template('beheerpaneel/brand/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/brand/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";
			
			if(!empty($data->brand_image) && file_exists(FCPATH . 'uploads/brand/' . $data->brand_image))
			{
				$image_src = image_url('uploads/brand/'.$data->brand_image);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->name' class='thumb' width='150px'>";
				}
					
			}else {
				$imgsrc = "-";
			}

			if(!empty($data->b_url)){ $brand_url = $data->b_url;}else { $brand_url ="-";};
			$edit_url =base_url(ADMIN_URL.'/brand/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/brand/delete/'.$data->id);
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
			$brand_url,
			$imgsrc,
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
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						]


						
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/brand/add');
						exit;
					}

					$check_brand = $this->check_brand($this->request->getVar('name'));
					// echo $check_keyword;
					if($check_brand)
					{
						$this->session->setFlashdata('error',getlang('merknaam bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/brand/add') );
					}
					
					$uploadPath = 'uploads/brand'; 
					$file = $this->request->getFile('brand_image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/brand',$imagename);
					 	
					 	
				 	// }
					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'brand_image' => !empty($imagename) ? $imagename : '',
						'b_url' => ($this->request->getVar('b_url')) ? $this->request->getVar('b_url') : "",
					);
				
					$this->general_model->insert_data('brand',$insert_values);
					
                    $this->session->setFlashdata('adminsuccess',getlang('merk succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/brand/manage') );
				}
                $this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/brand/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
                $brand_data = $this->general_model->fetch_data('brand',array('id'=>$id));
				if(!empty($this->request->getVar())){

                    $validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						]
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/brand/add');
						exit;
					}

					$check_brand = $this->check_brand($this->request->getVar('name'),$id);
					// echo $check_keyword;
					if($check_brand)
					{
						$this->session->setFlashdata('error',getlang('merknaam bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/brand/add') );
					}
					$uploadPath = 'uploads/brand'; 
					$file = $this->request->getFile('brand_image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $brand_data[0]->brand_image;
					}
					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/brand',$imagename);
					 	
					 	
				 	// }else{
				 	// 	$imagename = $brand_data[0]->brand_image;
				 	// }
					
				 	$update_values = array(
						'name' => $this->request->getVar('name'),
						'brand_image' => !empty($imagename) ? $imagename : '',
						'b_url' => ($this->request->getVar('b_url')) ? $this->request->getVar('b_url') : "",
					);
					
				
					$this->general_model->update_data('brand',$update_values,$id);
					
                    $this->session->setFlashdata('adminsuccess',getlang('merk succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/brand/manage') );
				}
				
				$this->outputData['brands'] = $this->general_model->fetch_data('brand',array('id'=>$id));
				$this->admin_template('beheerpaneel/brand/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$brand_data = $this->general_model->fetch_data('brand',array('id'=>$id));
			
			if(!empty($brand_data[0]->image)){
				unlink('./uploads/brand/'.$brand_data[0]->image);	
			}
			$this->general_model->delete_data('brand',$id);
			return redirect()->to(base_url(ADMIN_URL.'/brand/manage'));
		}


        function check_brand($name,$bid = null)
		{
			if($bid){
				$check_data = $this->general_model->fetch_data('brand',array('name'=>$name,'id !='=>$bid));
				
			} else {
				$check_data = $this->general_model->fetch_data('brand',array('name'=>$name));

			}


			if(empty($check_data))
			{
				return false;
			}
			else
			{
				return true;

			}
		}


	}