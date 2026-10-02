<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Shipments extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$order_by  = 'shipping_id ASC';
			if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['shippings_detail'] = $this->general_model->fetch_data('shipping_descriptions',NULL,$order_by);
				 

					$condition = array('shipping_id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'shipping_id' => '%' . $search . '%',
							'shipping' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$products = $this->outputData['shippings_detail'] = $this->general_model->fetch_limited('shipping_descriptions',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($products as $data) {
						$result[] = $this->_make_row($data);
					}



					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($products);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($products);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				//$this->admin_template('beheerpaneel/product/manage',$this->outputData);
				$this->admin_template('beheerpaneel/shipments/manage',$this->outputData);
			}
		}


private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->shipping_id' name='$data->shipping_id'><label class='custom-control-label' for='$data->shipping_id'></label></div>";
			$url = base_url(ADMIN_URL.'/shipments/edit/'.$data->shipping_id);
			$name = "<a  href='$url'>".$data->shipping."</a>";
			$pimg = shipping_images($data->shipping_id);



			if(!empty($pimg) && file_exists(FCPATH . 'uploads/shipping/' . $pimg[0]->image))
			{
				$image_src = image_url('uploads/shipping/'.$pimg[0]->image);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->shipping' width='36' class='thumb'>";
				}
				
					
			}else {
				$imgsrc = "-";
			}

			$edit_url =base_url(ADMIN_URL.'/shipments/edit/'.$data->shipping_id);
			$remove_url = base_url(ADMIN_URL.'/shipments/delete/'.$data->shipping_id);
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
				$data->shipping_id,
				$name,
				$data->delivery_time,
				$data->description,
				$imgsrc,
				$last_r,
			);
		
			
			return $row_data;
		}



		function add(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getPost())){

					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([ 
						'sname' => [
							'label' => getlang("shipping_name"),
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

						return redirect()->to(ADMIN_URL.'/shipments/add');
						exit;
					}

					if($this->request->getVar('free_shipping')){
						$free_shipping = $this->request->getVar('free_shipping');
					} else {
						$free_shipping = '0';
					}

					if($this->request->getVar('for_bike')){
						$for_bike = $this->request->getVar('for_bike');
					} else {
						$for_bike = 'N';
					}

					if($this->request->getVar('shipping_pickup')){
						$shipping_pickup = $this->request->getVar('shipping_pickup');
					} else {
						$shipping_pickup = 'N';
					}


					$insert_values = array(
						'rate_calculation' => 'M',
						'status' => $this->request->getVar('status'),
						'free_shipping' => $free_shipping,
						'for_bike' => $for_bike,
						'shipping_pickup' => $shipping_pickup,
						'position' => $this->request->getVar('position')
					);
					$shipping_id = $this->general_model->insert_data('shippings',$insert_values);
  
					$insert_desc_values = array(
						'shipping_id' => $shipping_id,
						'shipping' => $this->request->getVar('sname'),
						'delivery_time' => $this->request->getVar('delivery_time'),
						'description' => $this->request->getVar('sinfo')
					);
					$shipping_desc_id = $this->general_model->insert_data('shipping_descriptions',$insert_desc_values);


					

					if(!empty($this->request->getFile('simage')))
					{   
							$file = $this->request->getFile('simage');
							if($file->isValid()){
								$multipleimage = $file->getRandomName();
							
								$file->move('uploads/shipping',$multipleimage);
								$insert_shippingimage_values = array(
									'shipping_id' => $shipping_id,
									'image' => $multipleimage,
									'position' => 0
								);
								$this->general_model->insert_data('shipping_image',$insert_shippingimage_values);
							}
					}



					if($this->request->getVar('price')){

						$price = $this->request->getVar('price');
						$qty = $this->request->getVar('qty');


						foreach($this->request->getVar('country') as $key => $cid) {
							if($price[$key] >=0 ){
								$insert_values_shipping_rates = array(
									'shipping_id' => $shipping_id,
									'base_rate' => $price[$key],
									'qty_bikes' => ($for_bike == 'Y') ? $qty[$key] : 0,
									'country_id' => $cid
								);

								$shipping_rate_id = $this->general_model->insert_data('shipping_rates',$insert_values_shipping_rates);
							}

						}


					}


					$this->session->setFlashdata('Success_message',getlang('succesvol toegevoegd'));
					return redirect()->to(base_url(ADMIN_URL.'/shipments/manage') );
				}

				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['category_detail'] = generateOptions($menu);
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');
				$this->outputData['countries'] = $this->general_model->fetch_data('country');

				
				// $this->admin_template('beheerpaneel/product/add',$this->outputData);
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->outputData['all_products'] = $this->general_model->fetch_data('product');
				$this->outputData['product_options_with_variants'] =  $this->general_model->get_product_variants();
				$this->admin_template('beheerpaneel/shipments/add',$this->outputData);
			
		}



		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			
			
				$imagename1 = '';
				$imagename2 = '';
			
 				if(!empty($this->request->getVar())){


					$validation = \Config\Services::validation();
					$input = $this->validate([ 
						'sname' => [
							'label' => getlang("shipping_name"),
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
						return redirect()->to(ADMIN_URL.'/product/edit/'.$id);
						exit;
					}

				 
					
					if($this->request->getVar('free_shipping')){
						$free_shipping = $this->request->getVar('free_shipping');
					} else {
						$free_shipping = '0';
					}

					if($this->request->getVar('for_bike')){
						$for_bike = $this->request->getVar('for_bike');
					} else {
						$for_bike = 'N';
					}

					if($this->request->getVar('shipping_pickup')){
						$shipping_pickup = $this->request->getVar('shipping_pickup');
					} else {
						$shipping_pickup = 'N';
					}


					$update_values = array(
						'rate_calculation' => 'M',
						'status' => $this->request->getVar('status'),
						'free_shipping' => $free_shipping,
						'for_bike' => $for_bike,
						'shipping_pickup' => $shipping_pickup,
						'position' => $this->request->getVar('position')
					);
					$this->general_model->update_shipping_data('shippings',$update_values,$id);


					$update_desc_values = array(
						'shipping' => $this->request->getVar('sname'),
						'delivery_time' => $this->request->getVar('delivery_time'),
						'description' => $this->request->getVar('sinfo')
					);
					$this->general_model->update_shipping_data('shipping_descriptions',$update_desc_values,$id);



					if(!empty($this->request->getFile('simage')))
					{   
							$file = $this->request->getFile('simage');
						
							if($file->isValid()){
				 
								$multipleimage = $file->getRandomName();
							
								$file->move('uploads/shipping',$multipleimage);
								$insert_shippingimage_values = array(
									'shipping_id' => $id,
									'image' => $multipleimage,
									'position' => 0
								);
								$this->general_model->insert_data('shipping_image',$insert_shippingimage_values);
							}
					}
					 
					if($this->request->getVar('price')){

						$price = $this->request->getVar('price');
						$qty = $this->request->getVar('qty');

						foreach($this->request->getVar('country') as $key => $cid) {
							if($price[$key] >=0){
// echo "<pre>";print_r($price[$key]);exit;/

								if($for_bike == 'N'){
									$shipping_rate = $this->general_model->fetch_data('shipping_rates',array('shipping_id'=>$id,'country_id'=>$cid));
								} else {
									$shipping_rate = $this->general_model->fetch_data('shipping_rates',array('shipping_id'=>$id,'country_id'=>$cid,'qty_bikes'=>$qty[$key]));

								}
								
								if($shipping_rate){
									$update_values_shipping_rates = array(
										'base_rate' => $price[$key] 
									);



									if($for_bike == 'N'){
										$condition = array('shipping_id'=>$id,'country_id'=>$cid);
									} else {
										$condition = array('shipping_id'=>$id,'country_id'=>$cid,'qty_bikes'=>$qty[$key]);
									}
									$this->general_model->update_shipping_price('shipping_rates',$update_values_shipping_rates,$condition);

								} else {

									$insert_values_shipping_rates = array(
										'shipping_id' => $id,
										'base_rate' => $price[$key],
										'qty_bikes' => ($for_bike == 'Y') ? $qty[$key] : 0,
										'country_id' => $cid
									);
									$shipping_rate_id = $this->general_model->insert_data('shipping_rates',$insert_values_shipping_rates);
									
								}


							}

						}
					}

					$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/shipments/manage') );
				}
				$order  = 'shippings.shipping_id ASC';
				$this->outputData['shipping_infos'] = $this->general_model->limited_join_fetch('shippings','shipping_descriptions','shippings.*,shipping_descriptions.shipping,shipping_descriptions.delivery_time,shipping_descriptions.description','shippings.shipping_id = shipping_descriptions.shipping_id',array('shippings.shipping_id'=>$id),null,null,$order,null);
				$this->outputData['countries'] = $this->general_model->fetch_data('country');
				$this->outputData['shipping_image'] = $this->general_model->fetch_data('shipping_image',array('shipping_id'=>$id));
				$this->outputData['shipping_rates'] = $this->general_model->fetch_data('shipping_rates',array('shipping_id'=>$id));

			
				$this->admin_template('beheerpaneel/shipments/edit',$this->outputData);

		}

		public function deleteImage()
		{
			$imageId = $this->request->getPost('image_id');
			$shipping_id = $this->request->getPost('shipping_id');
			
			$shipping_image_data = $this->general_model->fetch_data('shipping_image',array('id'=>$imageId,'shipping_id'=>$shipping_id));
			if(!empty($shipping_image_data[0]->image)){
				unlink('./uploads/shipping/'.$shipping_image_data[0]->image);
				
			}
			$this->general_model->delete_condition('shipping_image',array('id'=>$imageId,'shipping_id'=>$shipping_id));
			
			return $this->response->setJSON(['success' => true]);
		}


		function delete()
		{
			$id=$this->request->uri->getSegment(4);
			$shipping_data = $this->general_model->fetch_data('shipping_image',array('shipping_id'=>$id));
			if(!empty($shipping_data[0]->image)){
				$pimg = explode(',',$shipping_data[0]->image);
				foreach($pimg as $p){
					unlink('./uploads/shipping/'.$p);
				}
			}
			
			$this->general_model->delete_condition('shippings',array('shipping_id'=>$id));
			$this->general_model->delete_condition('shipping_descriptions',array('shipping_id'=>$id));
			$this->general_model->delete_condition('shipping_rates',array('shipping_id'=>$id));



			return redirect()->to(base_url(ADMIN_URL.'/shipments/manage'));
		}



	}