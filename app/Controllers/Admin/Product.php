<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Product extends BaseController 
	{
		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['product_detail'] = $this->general_model->fetch_data('product',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'pname' => '%' . $search . '%',
							'product_sku' =>'%' . $search . '%',
							'ean' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					if(!empty($searchCondition)){
						$products = $this->outputData['product_detail'] = $this->general_model->fetch_without_limited('product',$condition,$order_by,NULL,$searchCondition);

					}else{

						$products = $this->outputData['product_detail'] = $this->general_model->fetch_limited('product',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					}
					$products1 = $this->outputData['product_detail'] = $this->general_model->fetch_limited('product',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($products1 as $data) {
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
				$this->admin_template('beheerpaneel/product/manage',$this->outputData);
			}
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/product/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->pname."</a>";
			$pimg = product_images($data->id);
			if(!empty($pimg) && file_exists(FCPATH . 'uploads/product/' . $pimg[0]->image))
			{
				$image_src = image_url('uploads/product/'.$pimg[0]->image);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->pname' class='thumb' />";
				}
				
					
			}else {
				$imgsrc = "-";
			}

			$edit_url =base_url(ADMIN_URL.'/product/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/product/delete/'.$data->id);
			$remove_lang = getlang('remove');
			$edit_lang = getlang('edit');
			$last_r = '<ul class="nk-tb-actions gx-1 my-n1">
							<li class="me-n1">
								<div class="dropdown">
									<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
									<div class="dropdown-menu dropdown-menu-end">
										<ul class="link-list-opt no-bdr">
										<li><a href="'.$edit_url.'"><em class="icon ni ni-edit"></em><span>'.getlang('edit').'</span></a></li>
											<li><a href="'.$remove_url.'" data-url="'.$remove_url.'" class="delete-action" onclick="confirmDelete1(event, this);"><em class="icon ni ni-delete"></em><span>'.getlang('remove').'</span></a></li>
										</ul>
									</div>
								</div>
							</li>
						</ul>';
						$pric = '<span class="tb-lead">'.$data->regoffprice.'</span>';
					if(($data->rprice != "0.00" ) && !empty($data->rprice )){
						$pric = '<span class="tb-lead"><strike>'.$data->rprice.'</strike>'.$data->regoffprice.'</span>';
					}
			$row_data = array(
				$first_,
				'<span class="tb-product">'.$imgsrc.'<span class="title">'.$name.'</span></span>',
				'<span class="tb-sub">'.$data->product_sku.'</span>',
				'<span class="tb-sub">'.(!empty($data->ean) ? $data->ean : "-").'</span>',
				$pric,
				'<span class="tb-sub">'.$data->quantity.'</span>',
				'<span class="tb-sub">'.$data->cat_id.'</span>',
				$last_r,
			);
		
			
			return $row_data;
		}

		public function check_product_url($url)
		{
			// $url = $this->request->getPost('page_url');
			$check_data = $this->general_model->fetch_data('product',array('slug'=>$url));
			if(empty($check_data))
			{
				
				return false;
			}
			else
			{
				return true;

			}//If end
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
						'cat_id' => [
							'label' => getlang("category"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'pname' => [
							'label' => getlang("product_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'product_sku' => [
							'label' => getlang("product_sku"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'quantity' => [
							'label' => getlang("stock"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'rprice' => [
							'label' => getlang("regular_price"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						// 'regoffprice' => [
						// 	'label' => getlang("offer_price"),
						// 	'rules' => 'trim|required',
						// 	'errors' => [
						// 		'required' => '{field} '.getlang('field_is_required').'.',
						// 	],
						// ],
						'slug' => [
							'label' => getlang("product_url"),
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

						return redirect()->to(ADMIN_URL.'/product/add');
						exit;
					}

					$check_url = $this->check_product_url($this->request->getVar('slug'));
					if($check_url)
					{
						$this->session->setFlashdata('error', getlang('URL bestaat al'));
						return redirect()->to(ADMIN_URL.'/product/add');
						exit;
					}
					$imagename='';

					$slug_url = '';
					if(!empty($this->request->getVar('slug'))){
						$slug_url = cleanStr($this->request->getVar('slug'));
					}
					
				 	// foreach($this->request->getFileMultiple('pimage') as $file)
         			// {   
         			// 	$multipleimage = $file->getRandomName();
         				
					//  	$file->move('uploads/product',$multipleimage);
					//  	$imagename .= $multipleimage.',';
					 	
				 	// }


					$ogimagename = '';
					$ogfile = $this->request->getFile('og_image');
					$uploadPath = 'uploads/product'; 

					$ogimagename = convert_to_webp($ogfile, $uploadPath);
					if ($ogimagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$ogimagename = '';
					}
					
					// if(!empty($ogfile->getName()))
					// {   
					// 	$ogimagename = $ogfile->getRandomName();
					// 	$ogfile->move('uploads/product',$ogimagename);
						
						
					// }

					if(!empty($this->request->getPost('accesorries_products_list')))
					{
						$accesorries_products_list = implode(',',$this->request->getPost('accesorries_products_list'));
					}else{	
						$accesorries_products_list = '';
					}

					$cat_ids = implode(',',$this->request->getVar('cat_id'));
					$insert_values = array(
						'pname' => $this->request->getVar('pname'),
						'quantity' => $this->request->getVar('quantity'),
						'stock' => $this->request->getVar('stock'),
						'rprice' => $this->request->getVar('rprice'),
						'regoffprice' => $this->request->getVar('regoffprice'),
						'product_sku' => $this->request->getVar('product_sku'),
						'ean' => $this->request->getVar('ean'),
						'productfeed_ean' => $this->request->getVar('productfeed_ean'),
						'cat_id' => ($cat_ids) ? $cat_ids : 0,
						'pinfo' => $this->request->getVar('pinfo'),
						'additional_info' => $this->request->getVar('additional_info'),
						'product_ups' => $this->request->getVar('product_ups'),
						'shortdesc' => $this->request->getVar('shortdesc'),
						'subtitle1' => $this->request->getVar('subtitle1'),
						'subtitle2' => $this->request->getVar('subtitle2'),
						'shortdesc1' => $this->request->getVar('shortdesc1'),
						'shortdesc2' => $this->request->getVar('shortdesc2'),
						'slug' => $slug_url,
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id'),
						'pimage' => ($imagename) ? trim($imagename, ',') : '',
						'vat' => $this->request->getVar('vat'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						'og_image' => ($ogimagename) ? trim($ogimagename, ',') : '',
						'og_title' => $this->request->getVar('og_title'),
						'accesorries_products_list'=>$accesorries_products_list,
						'review_star_rating' =>$this->request->getVar('review_star_rating'),
						'is_sale' =>($this->request->getVar('is_sale')) ? $this->request->getVar('is_sale') : 0,
						'bestseller' =>($this->request->getVar('bestseller')) ? $this->request->getVar('bestseller') : 0,
						'cart_product' =>($this->request->getVar('cart_product')) ? $this->request->getVar('cart_product') : 0,
						'insurance_price' =>$this->request->getVar('review_star_rating'),
						'insurance_pop_content' =>$this->request->getVar('review_star_rating'),
						'group_product_list' => !empty($this->request->getVar('group_product_list')) ? $this->request->getVar('group_product_list') : 0,
						'DeliveryTime' => !empty($this->request->getVar('DeliveryTime')) ? $this->request->getVar('DeliveryTime') : '',
						'DeliveryCosts' =>!empty($this->request->getVar('DeliveryCosts')) ? $this->request->getVar('DeliveryCosts') : 0.00,

					);

				
					$product_id = $this->general_model->insert_data('product',$insert_values);
					
					if($this->request->getVar('cat_id')){

						foreach($this->request->getVar('cat_id') as $cat_id){

							$insert_cat_values = array(
								'product_id' => $product_id,
								'category_id' => $cat_id
							);
							$this->general_model->insert_data('product_categories',$insert_cat_values);
						}

						}
					
					
					
						if (!empty($this->request->getFileMultiple('pimage'))) {
							foreach ($this->request->getFileMultiple('pimage') as $file) {
								if ($file->isValid()) {
									$webpFileName = get_product_webpImage_name($file);
									if ($webpFileName !== false) {
										$insert_productimage_values = array(
											'product_id' => $product_id,
											'image' => $webpFileName,
											'position' => 0,
										);
										$this->general_model->insert_data('product_image', $insert_productimage_values);
									} 
								} 
							}
						} 
				 	
					$this->session->setFlashdata('Success_message',"Product is succesvol aangemaakt");
					return redirect()->to(base_url(ADMIN_URL.'/product/manage') );
				}

				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['category_detail'] = generateOptions($menu);
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');
				$this->outputData['group_products'] = $this->general_model->fetch_data('group_product');
				// $this->admin_template('beheerpaneel/product/add',$this->outputData);
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->outputData['all_products'] = $this->general_model->fetch_data('product');
				$this->outputData['product_options_with_variants'] =  $this->general_model->get_product_variants();
				$this->admin_template('beheerpaneel/product/add',$this->outputData);
		}

		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			
				$product_data = $this->general_model->fetch_data('product',array('id'=>$id));
			
			$imagename1 = '';
			$imagename2 = '';
			
 				if(!empty($this->request->getVar())){

					// 			echo "<pre>";
					// print_r($this->request->getPost());
					// exit;

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'cat_id' => [
							'label' => getlang("category"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'pname' => [
							'label' => getlang("product_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'product_sku' => [
							'label' => getlang("product_sku"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'quantity' => [
							'label' => getlang("stock"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'rprice' => [
							'label' => getlang("regular_price"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						// 'regoffprice' => [
						// 	'label' => getlang("offer_price"),
						// 	'rules' => 'trim|required',
						// 	'errors' => [
						// 		'required' => '{field} '.getlang('field_is_required').'.',
						// 	],
						// ],
						'slug' => [
							'label' => getlang("product_url"),
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

						// echo '<pre>';
						// echo '--';
						// print_r($ererrorStringrorString);
						// exit;

						return redirect()->to(ADMIN_URL.'/product/edit/'.$id);
						exit;
					}

				 	$file1 = $this->request->getFileMultiple('pimage');

				 	$eximagename = $product_data[0]->pimage;

					// foreach($this->request->getFileMultiple('pimage') as $file)
					// {   
					// 	if(!empty($file->getName())){
					// 		$multipleimage = $file->getRandomName();
							
					// 		$file->move('uploads/product',$multipleimage);
					// 		$imagename1 .= $multipleimage.',';
						
					// 	}else{
					// 		$imagename2 = $product_data[0]->pimage;
					// 	} 
					// }
					$imagename = (!empty($imagename1) && isset($imagename1))?($eximagename.','.$imagename1):$eximagename;

					

					$ogfile = $this->request->getFile('og_image');
					$uploadPath = 'uploads/product'; 

					$ogimagename = convert_to_webp($ogfile, $uploadPath);
					if ($ogimagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$ogimagename = $product_data[0]->og_image;
					}

					
					// if(!empty($ogfile->getName()))
	     			// {   
	     			// 	$ogimagename = $ogfile->getRandomName();
					//  	$ogfile->move('uploads/product',$ogimagename);
					 	
					 	
				 	// }else{
				 	// 	$ogimagename = $product_data[0]->og_image;
				 	// }
					if(!empty($this->request->getPost('accesorries_products_list')))
					{
						$accesorries_products_list = implode(',',$this->request->getPost('accesorries_products_list'));
					}else{	
						$accesorries_products_list = '';
					}
					$o_slug_url = '';
					if(!empty($this->request->getVar('slug'))){
						$slug_url = cleanStr($this->request->getVar('slug'));
						$slug_url_data = $this->general_model->fetch_row('product',array('slug'=> $slug_url));
						if(empty($slug_url_data) || (!empty($slug_url_data) && $slug_url_data->id == $id)){
							$o_slug_url = $slug_url;
						}
					}
					
					$cat_ids = implode(',',$this->request->getVar('cat_id'));
				 	$update_values = array(
						'pname' => $this->request->getVar('pname'),
						'quantity' => $this->request->getVar('quantity'),
						'stock' => $this->request->getVar('stock'),
						'rprice' => $this->request->getVar('rprice'),
						'product_sku' => $this->request->getVar('product_sku'),
						'ean' => $this->request->getVar('ean'),
						'productfeed_ean' => $this->request->getVar('productfeed_ean'),
						'regoffprice' => $this->request->getVar('regoffprice'),
						'cat_id' => ($cat_ids) ? $cat_ids : 0,
						'pinfo' => $this->request->getVar('pinfo'),
						'additional_info' => $this->request->getVar('additional_info'),
						'product_ups' => $this->request->getVar('product_ups'),
						'shortdesc' => $this->request->getVar('shortdesc'),
						'shortdesc1' => $this->request->getVar('shortdesc1'),
						'shortdesc2' => $this->request->getVar('shortdesc2'),
						'subtitle1' => $this->request->getVar('subtitle1'),
						'subtitle2' => $this->request->getVar('subtitle2'),

						'slug' => $o_slug_url,
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'auser_id' => $this->session->get('admin_id'),
						// 'pimage' => ($imagename) ? trim($imagename, ',') : $imagename2,
						'mod_at' => date('Y-m-d H:i:s'),
						'vat' => $this->request->getVar('vat'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						// 'og_image' => !empty($ogimagename) ? trim($ogimagename, ',') : '',
						'og_title' => $this->request->getVar('og_title'),
						'accesorries_products_list'=>$accesorries_products_list,
						'review_star_rating' =>$this->request->getVar('review_star_rating'),
						'is_sale' =>($this->request->getVar('is_sale')) ? $this->request->getVar('is_sale') : 0,
						'bestseller' =>($this->request->getVar('bestseller')) ? $this->request->getVar('bestseller') : 0,
						'cart_product' =>($this->request->getVar('cart_product')) ? 1 : 0,
						'insurance_price' =>$this->request->getVar('insurance_price'),
						'insurance_pop_content' =>$this->request->getVar('insurance_pop_content'),
						'group_product_list' => !empty($this->request->getVar('group_product_list')) ? $this->request->getVar('group_product_list') : 0,
						'DeliveryTime' => !empty($this->request->getVar('DeliveryTime')) ? $this->request->getVar('DeliveryTime') : '',
						'DeliveryCosts' =>!empty($this->request->getVar('DeliveryCosts')) ? $this->request->getVar('DeliveryCosts') : 0.00,

					); 
					$this->general_model->update_data('product',$update_values,$id);

				
					if($this->request->getVar('youtube_code')){

						$position = $this->request->getVar('pos');
						$this->general_model->delete_condition('product_videos',array('product_id'=>$id));

						foreach($this->request->getVar('youtube_code') as $key => $pv) {
							if($pv){
								$insert_values_product_videos = array(
									'position' => $position[$key],
									'youtube_code' => $pv,
									'product_id' => $id
								);
								$this->general_model->insert_data('product_videos',$insert_values_product_videos);
							}
						}
					}



					$this->general_model->delete_condition('product_categories',array('product_id'=>$id));

					if($this->request->getVar('cat_id')){ 
						foreach($this->request->getVar('cat_id') as $cat_id){

							$insert_cat_values = array(
								'product_id' => $id,
								'category_id' => $cat_id
							);
							$this->general_model->insert_data('product_categories',$insert_cat_values);
						} 
					}

					if (!empty($this->request->getFileMultiple('pimage'))) {   
						foreach ($this->request->getFileMultiple('pimage') as $file) {
							if ($file->isValid()) {
								
								$webpFileName = get_product_webpImage_name($file);
								if ($webpFileName !== false) {
									$insert_productimage_values = array(
										'product_id' => $id,
										'image' => $webpFileName,
										'position' => 0,
									);
									$this->general_model->insert_data('product_image', $insert_productimage_values);
								}
							}
						}
					}
					if(!empty($this->request->getVar('product_imags_sort')))
					{   
						$array = explode(',',$this->request->getVar('product_imags_sort'));
						foreach($array as $key => $value){
							$update_productimage_values = array(
								'position' => $key,
								);
							$check_pro = $this->general_model->fetch_row('product_image',array('id'=>$value));
							if(!empty($check_pro)){
								$this->general_model->update_data('product_image',$update_productimage_values,array('id'=>$value));
							}
						}
					}

					//Delete product features 
					$this->general_model->delete_condition('product_features_values',array('product_id'=>$id));



					// Insert product features values
					$product_features_values = $this->request->getVar('product_data[product_features]');

					if($product_features_values){

						foreach($product_features_values as $key => $pf){

							$feature_id = explode("_",$key);

							if(($feature_id[1] == 'checkbox' && $feature_id[2] == 'c') || ($feature_id[1] == 'text' && $feature_id[2] == 'd')){

								$insert_product_features_values = array(
									'feature_id' => $feature_id[0],
									'product_id' => $id,
									'variant_id' => '0',
									'value' => end($pf)
								); 

								$this->general_model->insert_data('product_features_values',$insert_product_features_values);

							} else {

								foreach($pf as $pfv){

									$insert_product_features_values = array(
										'feature_id' => $feature_id[0],
										'product_id' => $id,
										'variant_id' => $pfv,
										'value' => '-'
									); 
									$this->general_model->insert_data('product_features_values',$insert_product_features_values);
								}

							}
						}

					}



					
					$this->session->setFlashdata('Success_message',"Product succesvol bijgewerkt");
					return redirect()->to(base_url(ADMIN_URL.'/product/manage') );
				}
				
				$product_info = $this->general_model->fetch_data('product',array('id'=>$id));
				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['category_detail'] = generateOptions1($menu,0,$product_info[0]->cat_id,$id);
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');
				$this->outputData['product_data'] = $this->general_model->fetch_data('product',array('id'=>$id));
				$product_categories = get_product_categories($id);
                $this->outputData['product_features'] = $this->general_model->limited_join_fetch_product_categories('product_features','product_features_descriptions','product_features.feature_id, purpose, feature_style, feature_type, categories_path, display_on_product, display_on_filter, status, position, timestamp, updated_timestamp,full_description,internal_name','product_features_descriptions.feature_id = product_features.feature_id',array('product_features.status'=>'A'),null,null,'product_features.feature_id desc',null,null,null);//substr($product_categories,0,-1));
				$category_ids = get_pro_category($id);
				if(!empty($category_ids)){
					$this->outputData['feature_having_catergory'] = findFeatureIdsByCategory($this->outputData['product_features'], $category_ids);
				}

				// $db = db_connect();
				// echo "<pre>";print_r($feature_having_catergory);die;

                $this->outputData['all_products'] = $this->general_model->fetch_data('product');
				//$this->admin_template('beheerpaneel/product/edit',$this->outputData);
				$this->outputData['product_options_with_variants'] =  $this->general_model->get_product_variants();
				// $this->outputData['product_options'] =  $this->general_model->fetch_data('product_options');
				$this->outputData['product_options'] =  $this->general_model->fetch_data('product_options',null,'`id` desc');


				$this->outputData['product_videos'] = $this->general_model->fetch_data('product_videos',array('product_id'=>$id));
				$this->outputData['group_products'] = $this->general_model->fetch_data('group_product');

				$get_choosen_product_options = $this->general_model->fetch_data('product_options_with_product',array('product_id'=>$id));
				if(!empty($get_choosen_product_options)){
					$get_choosen_product_option_variants = $this->general_model->fetch_data('product_options_variants_with_product',array('product_id'=>$id,'product_options_id'=>$get_choosen_product_options[0]->id));
					$this->outputData['product_options_data_with_product'] = $get_choosen_product_options;
					$this->outputData['product_options_variants_data_with_product'] = $get_choosen_product_option_variants;
				}
				$this->admin_template('beheerpaneel/product/edit',$this->outputData);

		}

		function delete()
		{
			$id=$this->request->uri->getSegment(4);
			$product_data = $this->general_model->fetch_data('product',array('id'=>$id));
			
			if(!empty($product_data[0]->pimage)){
				$pimg = explode(',',$product_data[0]->pimage);
				foreach($pimg as $p){
					if(file_exists('./uploads/product/'.$p)){
						unlink('./uploads/product/'.$p);
					}
				}
			}
			
			$this->general_model->delete_data('product',$id);
			return redirect()->to(base_url(ADMIN_URL.'/product/manage'));
		}

		public function deleteImage()
		{
			$imageId = $this->request->getVar('image_id');
			$product_id = $this->request->getVar('product_id');
			// print_r($product_id);exit;
			$product_image_data = $this->general_model->fetch_data('product_image',array('id'=>$imageId,'product_id'=>$product_id));
			if(!empty($product_image_data[0]->image)){
				unlink('./uploads/product/'.$product_image_data[0]->image);
				
			}
			$this->general_model->delete_condition('product_image',array('id'=>$imageId,'product_id'=>$product_id));

			// echo json_encode(array('success' => true));
			
			return $this->response->setJSON(['success' => true]);
		}

		function deletepimage()
		{
			$id = $this->request->getVar('id');
			$product_data = $this->general_model->fetch_data('product',array('id'=>$id));

			if(!empty($product_data)){
				$exp_prod = explode(',',$product_data[0]->pimage);
				foreach($exp_prod as $key => $pro){
					if($pro == $this->request->getVar('image'))
					{
						unset($exp_prod[$key]);
					}
				}

				$up_val = array('pimage' => implode(',',$exp_prod));
				$this->general_model->update_data('product',$up_val,$id);
				
			}
		}

		function features(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{

				$this->outputData['features'] = $this->general_model->fetch_data('features');
				$this->admin_template('beheerpaneel/product/features',$this->outputData);

			}

		}



		function changeEntry()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				if($this->request->getVar('selected'))
				{
					$selected = $this->request->getVar('selected');
					$this->session->set('product_entries', $selected);
					return true;
				}
				else
				{
					return false;
				}
			}
		}




		

function manage_product_features(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$limit  = ($this->session->get('product_features_entries')?$this->session->get('product_features_entries'):10);
				$page   = ($this->request->getget('page')?($this->request->getget('page')):1);
				$start  = ($this->request->getget('page')?($page-1)*$limit:0);
				$count  = $this->general_model->fetch_count('product_features', array('status'=>0));
				$select = 'product_features.*,  product_features_descriptions.internal_name, product_features_descriptions.full_description';
				$where  = 'product_features.status="A"';
				$join   = 'product_features.feature_id = product_features_descriptions.feature_id';
				$order  = 'product_features.feature_id ASC';

				$this->outputData['searchKey']  = "";
				$this->outputData['sort'] 		= "id";
				$this->outputData['type'] 		= "asc";

				if($this->request->getget('search'))
				{
					$s	   	   = $this->request->getget('search');
					$where     = '(product_features_descriptions.internal_name like "%'.$s.'%" OR product_features_descriptions.full_description like "%'.$s.'%")'; 
					$seachrows = $this->general_model->limited_join_fetch('product_features', 'product_features_descriptions', $select, $join, $where, null, null, $order, null);
					$count     = !empty($seachrows)?count($seachrows):0;
					$this->outputData['searchKey']  = $s;
				}
				
				if($this->request->getget('sort') && $this->request->getget('stype'))
				{
					$order = $this->request->getget('sort').' '.$this->request->getget('stype');
					$this->outputData['sort'] = $this->request->getget('sort');
					$this->outputData['type'] = $this->request->getget('stype');
				
				}

				$this->outputData['product_detail'] = $this->general_model->limited_join_fetch('product_features', 'product_features_descriptions', $select, $join, $where, null, $start, $order, null);	
				
				
				$this->outputData['currentPage'] 	= $this->request->getget('page');
				$this->outputData['pages'] 			= $this->pager->makeLinks($page, $limit, $count);
				$this->outputData['entries']     	= $limit;

				$this->admin_template('beheerpaneel/product_features/manage',$this->outputData);
			}

		}



		function add_product_features(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
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
						'feature_name' => [
							'label' => getlang("feature_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'category_id' => [
							'label' => getlang("category_id"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/product/add_product_features');
						exit;
					}

					 
					$cids = '';
					if($this->request->getVar('category_id')){
						$cids = '';
						foreach($this->request->getVar('category_id') as $cat_ids){
							$cids .= $cat_ids .',';
						}
					}
					
					
					$insert_values_features= array(
						'feature_style' => $this->request->getVar('feature_style'),
						'feature_type' => $this->request->getVar('feature_type'),
						'categories_path' => substr($cids,0,-1),
						'display_on_product' => !empty($this->request->getVar('display_on_product')) ? $this->request->getVar('display_on_product') : 'Y',
						'display_on_filter' => !empty($this->request->getVar('display_on_filter')) ? $this->request->getVar('display_on_filter') : 'N',
						'status' => $this->request->getVar('status'),
						'position' => $this->request->getVar('position'),
						'timestamp' => date('Y-m-d H:i:s')
					);	
					$feature_id = $this->general_model->insert_data('product_features',$insert_values_features);

					$insert_values_features_desc= array(
						'feature_id' => $feature_id,
						'internal_name' => $this->request->getVar('feature_name'),
						'full_description' => '-',
						'slug' => cleanStr($this->request->getVar('feature_name'))
					);
					$feature_id_desc = $this->general_model->insert_data('product_features_descriptions',$insert_values_features_desc);

					

					if($this->request->getVar('feature_style') == 'text' && $this->request->getVar('feature_type') == 'date'){

						$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$feature_id));
						$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$feature_id));

						if($variant_ids){
							foreach($variant_ids as $vids){
								$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
							}
						}
			
		
					} else if($this->request->getVar('feature_style') == 'checkbox' && $this->request->getVar('feature_type') == 'checkbox'){
						
						$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$feature_id));
						$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$feature_id));

						if($variant_ids){
							foreach($variant_ids as $vids){
								$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
							}
						}

		
					} else {


						if($this->request->getVar('variant')){

							$position = $this->request->getVar('pos');

							foreach($this->request->getVar('variant') as $key => $pv) {

								$insert_values_feature_variants = array(
									'feature_id' => $feature_id,
									'position' => $position[$key]
								);						
								$feature_variant_id = $this->general_model->insert_data('product_feature_variants',$insert_values_feature_variants);


								$insert_values_feature_variants_desc = array(
									'variant_id' => $feature_variant_id,
									'variant' => $pv
								);
								$feature_variant_id_desc = $this->general_model->insert_data('product_feature_variant_descriptions',$insert_values_feature_variants_desc);
							
							}

						}
					
					}


					$this->session->setFlashdata('Success_message',"Productfunctie succesvol toegevoegd");
					return redirect()->to(base_url(ADMIN_URL.'/product/manage_product_features') );
				}

				$this->outputData['category_detail'] = $this->general_model->fetch_data('category');
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');

				
			


				// $this->admin_template('beheerpaneel/product/add',$this->outputData);
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/product_features/add',$this->outputData);


			}

		}


		function edit_product_features(){

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
						'feature_name' => [
							'label' => getlang("feature_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'category_id' => [
							'label' => getlang("category_id"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/product/edit_product_features/'.$this->request->uri->getSegment(4));
						exit;
					}

					
					 
					$cids = '';
					if($this->request->getVar('category_id')){
						$cids = '';
						foreach($this->request->getVar('category_id') as $cat_ids){
							$cids .= $cat_ids .',';
						}
					}
					

					
					


					$insert_values_features= array(
						'feature_style' => $this->request->getVar('feature_style'),
						'feature_type' => $this->request->getVar('feature_type'),
						'categories_path' => substr($cids,0,-1),
						'display_on_product' => $this->request->getVar('display_on_product'),
						'display_on_filter' => $this->request->getVar('display_on_filter'),
						'status' => $this->request->getVar('status'),
						'position' => $this->request->getVar('position'),
						'timestamp' => date('Y-m-d H:i:s')
					);	
					$this->general_model->update_condition('product_features',$insert_values_features,array('feature_id'=>$this->request->uri->getSegment(4)));

					$update_info = $this->general_model->fetch_row('product_features_descriptions',array('feature_id'=>$this->request->uri->getSegment(4)));
					$slug = cleanStr($this->request->getVar('feature_name'));
					if(!empty($update_info)){
						if(!empty($update_info->slug)){
							$slug = $update_info->slug;
						}
					} 

					$insert_values_features_desc= array(
						'internal_name' => $this->request->getVar('feature_name'),
						'full_description' => '-',
                        'slug' => $slug,
					);
					$this->general_model->update_condition('product_features_descriptions',$insert_values_features_desc,array('feature_id'=>$this->request->uri->getSegment(4)));

					

					if($this->request->getVar('feature_style') == 'text' && $this->request->getVar('feature_type') == 'date'){

						$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$this->request->uri->getSegment(4)));
						$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$this->request->uri->getSegment(4)));

						if($variant_ids){
							foreach($variant_ids as $vids){
								$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
							}
						}
			
		
					} else if($this->request->getVar('feature_style') == 'checkbox' && $this->request->getVar('feature_type') == 'checkbox'){
						
						$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$this->request->uri->getSegment(4)));
						$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$this->request->uri->getSegment(4)));

						if($variant_ids){
							foreach($variant_ids as $vids){
								$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
							}
						}

		
					} else {
						

						if($this->request->getVar('variant')){

							$position = $this->request->getVar('pos');
							$variant_value = $this->request->getVar('variant_value');
							$color_value = $this->request->getVar('color_code');
	
							 
							foreach($this->request->getVar('variant') as $key => $pv) {
	
								if(isset($variant_value[$key])){
									
									$update_values_feature_variants = array(
										'position' => $position[$key]
									);			
									$feature_variant_id = $this->general_model->update_condition('product_feature_variants',$update_values_feature_variants,array('variant_id'=>$variant_value[$key]));

									$update_values_feature_variants_desc = array(
										'variant' => $pv,
										'color_code' => !empty($color_value[$key]) ?  $color_value[$key] : '' ,

									);
									$feature_id_desc = $this->general_model->update_condition('product_feature_variant_descriptions',$update_values_feature_variants_desc,array('variant_id'=>$variant_value[$key]));
	
								} else {
									$insert_values_feature_variants = array(
										'feature_id' => $this->request->uri->getSegment(4),
										'position' => $position[$key]
									);			
									$feature_variant_id = $this->general_model->insert_data('product_feature_variants',$insert_values_feature_variants);
									$variant_value[] = $feature_variant_id;
									$insert_values_feature_variants_desc = array(
										'variant_id' => $feature_variant_id,
										'variant' => $pv,
										'color_code' => !empty($color_value[$key]) ?  $color_value[$key] : '' ,

									);
									$feature_variant_id_desc = $this->general_model->insert_data('product_feature_variant_descriptions',$insert_values_feature_variants_desc);
								}
							}
							//$condition = array('feature_id'=>$this->request->uri->getSegment(4));
							//$this->general_model->delete_where_not_in_condition('product_feature_variants','variant_id',$variant_value,$condition);
							//$this->general_model->delete_where_not_in_condition('product_feature_variant_descriptions','variant_id',$variant_value);
	
						}

		
					}



					


					
					$this->session->setFlashdata('Success_message',"Productfunctie bijgewerkt");
					return redirect()->to(base_url(ADMIN_URL.'/product/manage_product_features') );
				}

				$this->outputData['category_detail'] = $this->general_model->fetch_data('category');
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');

 				
				$this->outputData['product_features'] = $this->general_model->limited_join_fetch('product_features','product_features_descriptions','product_features.feature_id, purpose, feature_style, feature_type, categories_path, display_on_product,display_on_filter, status, position, timestamp, updated_timestamp,full_description,internal_name','product_features_descriptions.feature_id = product_features.feature_id',array('product_features.feature_id'=>$this->request->uri->getSegment(4)),null,null,'product_features.feature_id desc');
				
				$this->outputData['product_feature_variants'] = $this->general_model->limited_join_fetch('product_feature_variants','product_feature_variant_descriptions','product_feature_variants.variant_id, variant,color_code,position','product_feature_variant_descriptions.variant_id = product_feature_variants.variant_id',array('product_feature_variants.feature_id'=>$this->request->uri->getSegment(4)),null,null,'product_feature_variants.position asc');


				
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/product_features/edit',$this->outputData);

		}



		function delete_product_features()
		{
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_condition('product_features',array('feature_id'=>$id));
			$this->general_model->delete_condition('product_features_descriptions',array('feature_id'=>$id));

			$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$id));

			$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$id));


			if($variant_ids){
				foreach($variant_ids as $vids){


					$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
				}
			}
			
			return redirect()->to(base_url(ADMIN_URL.'/product/manage_product_features'));
		}
		public function gegroepeerde_producten(){

			if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['group_product'] = $this->general_model->fetch_data('group_product',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'pname' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					if(!empty($searchCondition)){
						$products = $this->outputData['group_product'] = $this->general_model->fetch_without_limited('group_product',$condition,$order_by,NULL,$searchCondition);

					}else{

						$products = $this->outputData['group_product'] = $this->general_model->fetch_limited('group_product',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					}
					$products1 = $this->outputData['group_product'] = $this->general_model->fetch_limited('group_product',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($products1 as $data) {
						$result[] = $this->_make_row_group_product($data);
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
				$this->admin_template('beheerpaneel/product/group_product',$this->outputData);
			}

		}
		private function _make_row_group_product($data) {

					// echo "<pre>";print_r($data);exit;
			

			// $first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/product/group_product_edit/'.$data->id);
			$name = "<a  href='$url'>".$data->pname."</a>";
			$edit_url =base_url(ADMIN_URL.'/product/group_product_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/product/gp_delete/'.$data->id);
			$remove_lang = getlang('remove');
			$edit_lang = getlang('edit');
			$last_r = '<ul class="nk-tb-actions gx-1 my-n1">
							<li class="me-n1">
								<div class="dropdown">
									<a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
									<div class="dropdown-menu dropdown-menu-end">
										<ul class="link-list-opt no-bdr">
										<li><a href="'.$edit_url.'"><em class="icon ni ni-edit"></em><span>'.getlang('edit').'</span></a></li>
											<li><a href="'.$remove_url.'"  data-url="'.$remove_url.'" class="delete-action" onclick="confirmDelete1(event, this);"><em class="icon ni ni-delete"></em><span>'.getlang('remove').'</span></a></li>
										</ul>
									</div>
								</div>
							</li>
						</ul>';
			$sku = array();
			if(!empty($data->product_sku)){
				$sku_arr = explode(',',$data->product_sku);
				if(!empty($sku_arr)){
					foreach ($sku_arr as $key => $value) {
						$skudata =  $this->general_model->fetch_row('product',array('id' => $value));
						// print_r($skudata);exit;

						if(!empty($skudata)){
							array_push($sku ,$skudata->pname  . ' - ' . $skudata->product_sku);
						}
					}
				}
				$sku = implode("<br>",$sku);
			}
			$row_data = array(
				$name,
				$sku,
				$last_r,
			);
		
			
			return $row_data;
		}
		function group_product_add(){
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
						'pname' => [
							'label' => getlang("group_product_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'product_sku' => [
							'label' => getlang("product_sku"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/product/group_product_add');
						exit;
					}

					
					$imagename='';
					
				 	// foreach($this->request->getFileMultiple('pimage') as $file)
         			// {   
         			// 	$multipleimage = $file->getRandomName();
         				
					//  	$file->move('uploads/product',$multipleimage);
					//  	$imagename .= $multipleimage.',';
					 	
				 	// }


					$ogimagename = '';
					
					$insert_values = array(
						'pname' => $this->request->getVar('pname'),
						'product_sku' => !empty($this->request->getVar('product_sku')) ? implode(',',$this->request->getVar('product_sku')) : '',
					);

				
					$product_id = $this->general_model->insert_data('group_product',$insert_values);
					if(!empty($product_id)){
						if(!empty($this->request->getVar('product_sku'))){
							foreach($this->request->getVar('product_sku') as $sku){
								$product_info = $this->general_model->fetch_data('product',array('id' => $sku),null,'id,group_product_list');
								if(!empty($product_info)){
									foreach($product_info as $info){

										if(!empty($info->group_product_list)){
											$gp = explode(',',$info->group_product_list);
											if(in_array($product_id,$gp)){

											}else{

												array_push($gp,$product_id);
											}
											$gp = implode(',',$gp);
											$update_values1 = array(
												'group_product_list' => $gp 
											);
											$this->general_model->update_data('product',$update_values1,$info->id);

										}else{
											$update_values1 = array(
												'group_product_list' => $product_id
											);
											$this->general_model->update_data('product',$update_values1,$info->id);
										}
									}
								}
							}
						}

					}

					$this->session->setFlashdata('Success_message',"Product is succesvol aangemaakt");
					return redirect()->to(base_url(ADMIN_URL.'/product/gegroepeerde_producten') );
				}

				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['category_detail'] = generateOptions($menu);
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');
				// $this->admin_template('beheerpaneel/product/add',$this->outputData);
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->outputData['all_products'] = $this->general_model->fetch_data('product');
				$this->outputData['product_options_with_variants'] =  $this->general_model->get_product_variants();
				$this->admin_template('beheerpaneel/product/gp_add',$this->outputData);
		}
		function group_product_edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			
				// $product_data = $this->general_model->fetch_data('product',array('id'=>$id));
				$group_product_data = $this->general_model->fetch_row('group_product',array('id'=>$id));

			
 				if(!empty($this->request->getVar())){

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'pname' => [
							'label' => getlang("product_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'product_sku' => [
							'label' => getlang("product_sku"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);


						return redirect()->to(ADMIN_URL.'/product/group_product_edit/'.$id);
						exit;
					}

					if(!empty($group_product_data) && !empty($group_product_data->product_sku)){
						$old_sku = explode(',',$group_product_data->product_sku);
						$new_sku = $this->request->getVar('product_sku');
						if(!empty($new_sku)){
							$removed_sku = array_diff($old_sku, $new_sku); // This will output values in $old_sku that are not in $new_sku 
							if(!empty($removed_sku)){
								foreach($removed_sku as $rem){
									$product_info1 = $this->general_model->fetch_data('product',array('id' => $rem),null,'id,group_product_list');

									if(!empty($product_info1)){
										foreach($product_info1 as $info1){
									// echo "<pre>";print_r($info);exit;
	
											if(!empty($info1->group_product_list)){
												$gp1 = explode(',',$info1->group_product_list);
												if(in_array($id,$gp1)){

													$gp1 = array_filter($gp1, function($value) use ($id) {
														return $value != $id;
													});
	
													$gp1 = implode(',',$gp1);
													$update_values2 = array(
														'group_product_list' => $gp1 
													);
													$this->general_model->update_data('product',$update_values2,$info1->id);
												}
											}
										}
									}
								}
							}
						}

						

					}
					
					
				 	$update_values = array(
						'pname' => $this->request->getVar('pname'),
						'product_sku' => !empty($this->request->getVar('product_sku')) ? implode(',',$this->request->getVar('product_sku')) : '',
					); 

					$updated = $this->general_model->update_data('group_product',$update_values,$id);

					if(!empty($updated)){
						if(!empty($this->request->getVar('product_sku'))){
							foreach($this->request->getVar('product_sku') as $sku){
								$product_info = $this->general_model->fetch_data('product',array('id' => $sku),null,'id,group_product_list');
								if(!empty($product_info)){
									foreach($product_info as $info){
								// echo "<pre>";print_r($info);exit;

										if(!empty($info->group_product_list)){
											$gp = explode(',',$info->group_product_list);
											if(in_array($id,$gp)){

											}else{

												array_push($gp,$id);
											}
											$gp = implode(',',$gp);
											$update_values1 = array(
												'group_product_list' => $gp 
											);
											$this->general_model->update_data('product',$update_values1,$info->id);

										}else{
											$update_values1 = array(
												'group_product_list' => $id
											);
											$this->general_model->update_data('product',$update_values1,$info->id);
										}
									}
								}
								// echo "<pre>";print_r($product_info);

							}
							// exit;
						}

					}

					
					$this->session->setFlashdata('Success_message',"Product succesvol bijgewerkt");
					return redirect()->to(base_url(ADMIN_URL.'/product/gegroepeerde_producten') );
				}
		
				$this->outputData['product_data'] = $this->general_model->fetch_row('group_product',array('id'=>$id));
                $this->outputData['all_products'] = $this->general_model->fetch_data('product');

			
				$this->admin_template('beheerpaneel/product/gp_edit',$this->outputData);

		}
		function gp_delete(){
			$id=$this->request->uri->getSegment(4);
			$group_data = $this->general_model->fetch_row('group_product',array('id'=>$id));
			if(!empty($group_data) && !empty($group_data->product_sku)){
				$skus = explode(',',$group_data->product_sku);
				foreach($skus as $sku){
 					$product_data = $this->general_model->fetch_row('product',array('id'=>$sku));
					if(!empty($product_data) && !empty($product_data->group_product_list)){
						$list = explode(',',$product_data->group_product_list);
						if(!empty($list) && in_array($id,$list)){
							$key = array_search($id, $list);
							unset($list[$key]);
						}
						$list = implode(',',$list);

						$update_values = array(
							'group_product_list' => $list
						);
						$this->general_model->update_data('product',$update_values,$sku);
					}
				}
			}
			
			$this->general_model->delete_data('group_product',$id);
			return redirect()->to(base_url(ADMIN_URL.'/product/gegroepeerde_producten'));
		}

		public function productexport(){

			if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$order_by  = 'id ASC';
				// if ($this->request->isAJAX()) {
					
				// }
				if(!empty($this->request->getPost())){

					$previousInput = $this->request->getPost();
					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'start_date' => [
							'label' => getlang("start_date"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'end_date' => [
							'label' => getlang("end_date"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
					]);

					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/product/productexport');
						exit;
					}
					$start_date = $this->request->getPost('start_date');
					$end_date = $this->request->getPost('end_date');
					$data = $this->general_model->fetch_data('product',array('DATE(created_at) >= ' => $start_date,'DATE(created_at) <= ' => $end_date));
					if($data){
						$allprodbuypr = array_sum(array_column($data, 'rprice'));
						$allprodorderpr = array_sum(array_column($data, 'regoffprice'));
						$j = 0;
						foreach($data as $res){
							$category_info = '';
							$category_data = $this->general_model->fetch_data('product_categories',array('product_id' => $res->id));
							if(!empty($category_data)){
								foreach($category_data as $cat){
									$cat_info = $this->general_model->fetch_row('category',array('id' => $cat->category_id));
									if(!empty($cat_info)){
										if(!empty($category_info)){
											$category_info .= '/'.$cat_info->name;
										}else{
											$category_info .= $cat_info->name;

										}
									}
								}
							}
							$url = '';
							if(!empty($res->slug)){
								$url = base_url().$res->slug;
							}
							
							$ortble[$j]['Product ID'] = $res->id;
							$ortble[$j]['Title'] = $res->pname;
							
							$ortble[$j]['Stock'] = $res->stock;
							$ortble[$j]['Base price'] = $res->rprice;
							$ortble[$j]['Offer price'] = $res->regoffprice;
							$ortble[$j]['Category Title'] = (!empty($category_info) ? $category_info  : '-');
							$ortble[$j]['Description'] = $res->shortdesc;
							$ortble[$j]['URL'] = $url;
							$ortble[$j]['BTW'] = number_format($res->vat,2,".","");
							$ortble[$j]['Created at'] = $res->created_at;
							$ortble[$j]['Modified at'] = $res->mod_at;
							$ortble[$j]['Product SKU'] = $res->product_sku;
							$ortble[$j]['EAN'] = $res->ean;
							$ortble[$j]['Meta title'] = $res->meta_title;
							$ortble[$j]['Meta description'] = $res->meta_desc;
							$ortble[$j]['Meta keyword'] = $res->meta_keyword;
							$ortble[$j]['Warranty type'] = $res->warranty_type;
							$ortble[$j]['Warranty validity time'] = $res->warranty_validity_time;
							$ortble[$j]['Warranty exceptions'] = $res->warranty_exceptions;

							// $ortble[$j]['Deposit total amount'] = number_format($res->deposit_totalprice,2,".","");
							
							
							$j++;
						}
						
				
						
						$headers = array(
							'Content-Type' => 'text/csv',
						);
					
						$filename_o = 'product_export.csv';
						$newline = "\t";
						$f_o = fopen(FCPATH.'uploads/temp2/'.$filename_o, 'w');
						$order_header = array("Product ID;Title;Stock;Base price;Offer price;Category Title;Description;URL;BTW;Created at;Modified at;Product SKU;EAN;Meta title;Meta description;Meta keyword;Warranty type;Warranty validity time;Warranty exceptions");
						
						
						fputs($f_o, implode(';', $order_header)."\n");
		
						foreach($ortble as $ordertable){
							
								$neworderval = array($ordertable['Product ID'].';'.$ordertable['Title'].';'.$ordertable['Stock'].';'.$ordertable['Base price'].';'.$ordertable['Offer price'].';'.$ordertable['Category Title'].';'.$ordertable['Description'].';'.$ordertable['URL'].';'.$ordertable['BTW'].';'.$ordertable['Created at'].';'.$ordertable['Modified at'].';'.$ordertable['Product SKU'].';'.$ordertable['EAN'].';'.$ordertable['Meta title'].';'.$ordertable['Meta description'].';'.$ordertable['Meta keyword'].';'.$ordertable['Warranty type'].';'.$ordertable['Warranty validity time'].';'.$ordertable['Warranty exceptions']);
							
							
							fputs($f_o, str_replace("\t", "",implode(';', $neworderval))."\n");
						}
						$file_path = FCPATH.'uploads/temp2/'.$filename_o;
						if (is_file($file_path) && is_readable($file_path)) {
							// Output file path for debugging
							header('Content-Type: text/csv');
							header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
							header('Content-Length: ' . filesize($file_path));
							readfile($file_path);
							exit;
						} 
						// return redirect()->to(ADMIN_URL.'/product/productexport');
						// exit;
					}
					else{
						$errorString = "Er zijn geen gegevens aanwezig op de opgegeven datum";
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/product/productexport');
						exit;
					}
				}
				$this->outputData[] = ''; 
				$this->admin_template('beheerpaneel/product/export_product',$this->outputData);
			}

		}
		public function productimport(){
			ini_set('max_execution_time', 600);
			ini_set('memory_limit', '-1');   // Unlimited memory
			if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$order_by  = 'id ASC';
				// if ($this->request->isAJAX()) {
					
				// }
				if(!empty($this->request->getPost())){

					$previousInput = $this->request->getPost();
					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'file_url' => [
							'label' => getlang("file_url"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						
					]);

					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/product/productimport');
						exit;
					}

					$headers = [
						"Authorization: Bearer YOUR_API_KEY",
						"User-Agent: PostmanRuntime/7.29.0"
					];
					
					$contextOptions = [
						"http" => [
							"method" => "GET",
							"header" => implode("\r\n", $headers)
						]
					];
					
					$context = stream_context_create($contextOptions);
					$file_url = $this->request->getPost('file_url');
					
					if(!empty($file_url)){
						$csvContent = file_get_contents($file_url, false, $context);
						// $csvContent = file_get_contents($file_url);

						// echo "<pre>";print_r($csvContent);exit;
        
						// Check if the content was fetched successfully
						if ($csvContent === FALSE) {
							echo "Failed to fetch CSV content.";
							return;
						}
						$headers = [
							'UniqueID', 'Title', 'Price', 'Description', 'Brand', 'Category', 'ImageLink', 'URL',
							'DeliveryTime', 'DeliveryCosts', 'DeliveryTimeAlternative', 'DeliveryCostsAlternative',
							'Stock', 'SKU', 'EAN', 'Family', 'FamilyName', 'FromPrice', 'Material', 'Size', 'Color',
							'ExtraImageLink1', 'ExtraImageLink2', 'ExtraImageLink3', 'ExtraImageLink4', 'ExtraImageLink5',
							'ExtraImageLink6', 'ExtraImageLink7', 'ExtraImageLink8', 'ExtraImageLink9'
						];
						
						// Define the regular expression to match '|' not inside quotes
						$pattern = '/\s*\|\s*(?=(?:(?:[^"]*"){2})*[^"]*$)/';
						
						// Use preg_split to split the CSV data based on the pattern
						$rows = preg_split('/\r\n|\r|\n/', $csvContent);
						$rows = array_filter(array_map('trim', $rows)); // Remove blank rows
						$data = [];
						
						foreach ($rows as  $rowIndex => $row) {
							$fields = str_getcsv($row, '|'); // Use pipe as the delimiter

							if (count($fields) !== count($headers)) {
								echo "Row #{$rowIndex} mismatch: " . count($fields) . " fields, " . count($headers) . " headers.\n";
								print_r($fields);
								continue; // Skip invalid rows
							}
						
							$data[] = array_combine($headers, $fields);
						}
						// echo "<pre>";print_r($data);exit;
						
						// Output the result
						foreach ($data as $key => $entry) {
							if($key > 0){
								if(!empty($entry['UniqueID'])){

									$product = $this->general_model->fetch_row('product',array('product_sku' =>$entry['UniqueID']));
									if(!empty($product)){
										$insert_data = array(
											'quantity' => !empty($entry['Stock']) ? $entry['Stock'] : 0,
											'regoffprice' => !empty($entry['Price']) ? $entry['Price'] : 0.00,
											'rprice' => !empty($entry['FromPrice']) ? $entry['FromPrice'] : 0.00,
											'DeliveryTime' => !empty($entry['DeliveryTime']) ? $entry['DeliveryTime'] : '',
											'DeliveryCosts' => !empty($entry['DeliveryCosts']) ? $entry['DeliveryCosts'] : 0.00,
											'DeliveryTimeAlternative' => !empty($entry['DeliveryTimeAlternative']) ? $entry['DeliveryTimeAlternative'] : '',
											'DeliveryCostsAlternative' => !empty($entry['DeliveryCostsAlternative']) ? $entry['DeliveryCostsAlternative'] : 0.00,
										); 
									  $this->general_model->update_data('product',$insert_data,$product->id);
									 

										
									}
								}
								
							}
							
							
						}
						$this->session->setFlashdata('Success_message', 'successfully updated');
						return redirect()->to(ADMIN_URL.'/product/productimport');

					}
					else{
						$errorString = "Voer een geldige bestands-URL in";
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/product/productimport');
						exit;
					}
				}
				$this->outputData[] = ''; 
				$this->admin_template('beheerpaneel/product/import_product',$this->outputData);
			}
		}

// 		function test(){
// 			// $data = count($this->general_model->fetch_data('product',NULL,null));
// 			// echo $data;
// 			$data = $this->general_model->fetch_limit('product',30,array(),null);


// 			$db = \Config\Database::connect();


// 			$builder1 = $db->table('product');
// 			$builder1->select('*');
// 			$builder1->limit(1000, 1001);
// 			$query1 = $builder1->get();
// 			$data1 = $query1->getResult();
// 			if(!empty($data1)){
// 				foreach($data1 as $dt1){

// 					$builder = $db->table('product_image');
// 					$builder->select('*');
// 					// $builder->limit(100, 1901);
// 					$builder->where('product_id', $dt1->id);
// 					$query = $builder->get();
// 					$data = $query->getResult();

// 					foreach($data as $dt){
// 						$imageValue = $dt->image;
// 						// Find the ID
// 						$this->findSecondImageId($data, $imageValue);
// 					}
// 				}
// 			}
// exit;
			
// 		}

// 		function findSecondImageId($array, $imageValue) {
// 			set_time_limit(120);
// 			$occurrences = 0;
// 			echo "<pre>";print_r($imageValue);
// 			foreach ($array as $item) {
// 				if ($item->image === $imageValue) {
// 					$occurrences++;
// 					if ($occurrences >= 2) {
// 						echo  ' '.$item->id .' ';
// 						$this->general_model->delete_data('product_image',$item->id );
// 					}
// 				}
// 			}
// 			return null; // Return null if the image value is not found twice
// 		}
// 		function test1(){
// 			// $data = count($this->general_model->fetch_data('product',NULL,null));
// 			// echo $data;
// 			$data = $this->general_model->fetch_limit('product',30,array(),null);


// 			$db = \Config\Database::connect();

// 			// Build the query using Query Builder
// 			$builder = $db->table('product');
// 			$builder->select('*');
// 			$builder->limit(100, 3501);

// 			$query = $builder->get();

// 			// Fetch the result
// 			$data = $query->getResult();
// 			$images = '';
// 			$imageArray = array();
// 			$img1= array();

// 			foreach($data as $dt){
// 				$images  = $this->general_model->fetch_data('product_image',array('product_id'=>$dt->id));
// 				$imageArray =  array_reduce($images, function($carry, $item) {
// 					$carry[$item->id] = $item->image;
// 					return $carry;
// 				}, []);
// 				foreach($imageArray as $key => $arr){
// 					$img = $imageArray;
// 					unset($img[$key]);
// 					if(in_array($arr,$img)){
// 						array_push($img1,$key);
						
// 						echo "<pre>";echo $key; 
// 					}
					
// 				}
// 				// foreach($img1 as $key1 => $im){
// 				// 	if($key1 == 0){
// 				// 		continue;
// 				// 	}
// 				// 	echo "<pre>";echo $im;
// 				// 	// $this->general_model->delete_data('product_image',$im);
// 				// }

// 				echo "<pre>";print_r($imageArray);
// 			}
			
// 			exit;
// 		}
// 		function test2(){
// 			$data = count($this->general_model->fetch_data('product',NULL,null));
// 			echo $data;exit;
// 			$data = $this->general_model->fetch_limit('product',30,array(),null);


// 			$db = \Config\Database::connect();

// 			// Build the query using Query Builder
// 			$builder = $db->table('product');
// 			$builder->select('*');
// 			$builder->limit(100, 2501);

// 			$query = $builder->get();

// 			// Fetch the result
// 			$data = $query->getResult();
// 			$images = '';
// 			$imageArray = array();
// 			$img1= array();

// 			foreach($data as $dt){
// 				$images  = $this->general_model->fetch_data('product_image',array('product_id'=>$dt->id));
// 				$imageArray =  array_reduce($images, function($carry, $item) {
// 					$carry[$item->id] = $item->image;
// 					return $carry;
// 				}, []);
// 				foreach($imageArray as $key => $arr){
// 					$img = $imageArray;
// 					unset($img[$key]);
// 					if(in_array($arr,$img)){
// 						array_push($img1,$key);
						
// 						echo "<pre>";echo $key; 
// 					}
					
// 				}
// 				// foreach($img1 as $key1 => $im){
// 				// 	if($key1 == 0){
// 				// 		continue;
// 				// 	}
// 				// 	echo "<pre>";echo $im;
// 				// 	// $this->general_model->delete_data('product_image',$im);
// 				// }

// 				echo "<pre>";print_r($imageArray);
// 			}
			
// 			exit;
// 		}

	}