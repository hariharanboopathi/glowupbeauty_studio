<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Ordertrackingstatus extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/manage'));
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['brands'] = $this->general_model->fetch_data('brand');
			
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['order_tracking_status'] = $this->general_model->fetch_data('order_tracking_status',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'content' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$order_tracking_status = $this->outputData['order_tracking_status'] = $this->general_model->fetch_limited('order_tracking_status',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($order_tracking_status as $data) {
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
				$this->admin_template('beheerpaneel/order_tracking_status/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/ordertrackingstatus/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->content."</a>";
			
			if(!empty($data->image) && file_exists(FCPATH . 'uploads/order_tracking_status/' . $data->image))
			{
				$image_src = image_url('uploads/order_tracking_status/'.$data->image);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->content' class='thumb' width='150px' style='background-color:black;'>";
				}
					
			}else {
				$imgsrc = "-";
			}

			// if(!empty($data->b_url)){ $brand_url = $data->b_url;}else { $brand_url ="-";};
			$edit_url =base_url(ADMIN_URL.'/ordertrackingstatus/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/ordertrackingstatus/delete/'.$data->id);
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
			// $brand_url,
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
						'content' => [
							'label' => getlang("content"),
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

						return redirect()->to(ADMIN_URL.'/ordertrackingstatus/add');
						exit;
					}

					$check_brand = $this->check_brand($this->request->getVar('content'));
					// echo $check_keyword;
					if($check_brand)
					{
						$this->session->setFlashdata('error',getlang('volgstatus van bestelling bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/add') );
					}
					
					$uploadPath = 'uploads/order_tracking_status'; 
					$file = $this->request->getFile('image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/order_tracking_status',$imagename);
					 	
					 	
				 	// }
					$insert_values = array(
						'content' => $this->request->getVar('content'),
						'image' => !empty($imagename) ? $imagename : '',
						
					);
				
					$this->general_model->insert_data('order_tracking_status',$insert_values);
					
                    $this->session->setFlashdata('adminsuccess',getlang('Update van de status van het volgen van bestellingen is succesvol verlopen'));
					return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/manage') );
				}
                $this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/order_tracking_status/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
                $order_tracking_status_data = $this->general_model->fetch_data('order_tracking_status',array('id'=>$id));
				if(!empty($this->request->getVar())){

                    $validation = \Config\Services::validation();
					$input = $this->validate([
						'content' => [
							'label' => getlang("content"),
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

						return redirect()->to(ADMIN_URL.'/ordertrackingstatus/edit/'.$id);
						exit;
					}

					$check_brand = $this->check_brand($this->request->getVar('content'),$id);
					// echo $check_keyword;
					if($check_brand)
					{
						$this->session->setFlashdata('error',getlang('volgstatus van bestelling bestaat'));
						return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/edit/'.$id) );
					}

					$uploadPath = 'uploads/order_tracking_status'; 
					$file = $this->request->getFile('image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $order_tracking_status_data[0]->image;
					}
					
					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/order_tracking_status',$imagename);
					 	
					 	
				 	// }else{
				 	// 	$imagename = $order_tracking_status_data[0]->image;
				 	// }
					
				 	$update_values = array(
						'content' => $this->request->getVar('content'),
						'image' => !empty($imagename) ? $imagename : '',
						
					);
					
				
					$this->general_model->update_data('order_tracking_status',$update_values,$id);
					
                    $this->session->setFlashdata('adminsuccess',getlang('Update van de status van het volgen van bestellingen is succesvol verlopen'));
					return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/manage') );
				}
				
				$this->outputData['order_tracking_status'] = $this->general_model->fetch_data('order_tracking_status',array('id'=>$id));
				$this->admin_template('beheerpaneel/order_tracking_status/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$brand_data = $this->general_model->fetch_data('order_tracking_status',array('id'=>$id));
			
			if(!empty($brand_data[0]->image)){
				unlink('./uploads/order_tracking_status/'.$brand_data[0]->image);	
			}
			$this->general_model->delete_data('order_tracking_status',$id);
			return redirect()->to(base_url(ADMIN_URL.'/ordertrackingstatus/manage'));
		}


        function check_brand($name,$bid = null)
		{
			if($bid){
				$check_data = $this->general_model->fetch_data('order_tracking_status',array('content'=>$name,'id !='=>$bid));
				
			} else {
				$check_data = $this->general_model->fetch_data('order_tracking_status',array('content'=>$name));

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