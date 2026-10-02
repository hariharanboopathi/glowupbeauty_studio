<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Category extends BaseController 
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
				{
				

				$order_by  = 'id desc';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['category_detail'] = $this->general_model->fetch_data('category',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					// echo "<pre>";print_r($this->request->getGet('search[value]'));

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'name' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					if(!empty($searchCondition)){

						$category = $this->outputData['category_detail'] = $this->general_model->fetch_without_limited('category',$condition,$order_by,NULL,$searchCondition);
					}else{
						$category = $this->outputData['category_detail'] = $this->general_model->fetch_limited('category',$condition,$limit,$offset,$order_by,NULL,$searchCondition);

					}
					
						$category1 = $this->outputData['category_detail'] = $this->general_model->fetch_limited('category',$condition,$limit,$offset,$order_by,NULL,$searchCondition);

					
					
					
					$result = array();
					foreach ($category1 as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($category);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($category);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				// $this->outputData['category_detail'] = $this->general_model->fetch_data('category', NULL, $order);	
				

				$this->admin_template('beheerpaneel/category/manage',$this->outputData);
			}
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/category/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";
			$cimg = $data->image;



			if(!empty($cimg) && file_exists(FCPATH . 'uploads/category/' . $cimg))
			{
				$image_src = image_url('uploads/category/'.$cimg);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->name' class='thumb' width='150px'>";
				}
				
					
			}else {
				$imgsrc = "-";
			}

			// if($data->status == '1')
			if($data->status == '0')
			{
				$status = getlang('active');
			}
			else{
				$status = getlang('inactive');
			}

			$edit_url =base_url(ADMIN_URL.'/category/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/category/delete/'.$data->id);
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
			$imgsrc,
			$last_r,
			);
		
			
			return $row_data;
		}

		function category_tree(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				{
				

				 // submenu code start
				 $menu = $this->general_model->fetch_data('category');
				 $menu1 = buildMenu($menu);
				 $this->outputData['submenu'] = $menu1;
				 // submenu code end
				$this->outputData['category_detail'] = $this->general_model->fetch_data('category', NULL);	
				

				$this->admin_template('beheerpaneel/category/category_tree',$this->outputData);
			}
		}

		public function check_category_url($url)
		{
			// $url = $this->request->getPost('page_url');
			$check_data = $this->general_model->fetch_data('category',array('slug'=>$url));
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
						'slug' => [
							'label' => getlang("category_url"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						// 'image' => [
						// 	'label' => getlang("image"),
						// 	'rules' => 'uploaded[image]|max_size[image,20480]|is_image[image]',
						// 	'errors' => [
						// 		'uploaded' => '{field} '.getlang('field_is_required').'.',
						// 		'max_size' => '{field} '.getlang('file_too_large').'.',
						// 		'is_image' => '{field} '.getlang('must_be_valid_image_file').'.',
						// 	],
						// ],

						
					]);
					
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);

						return redirect()->to(ADMIN_URL.'/category/add');
						exit;
					}

					$check_url = $this->check_category_url($this->request->getVar('slug'));
					if($check_url)
					{
						$this->session->setFlashdata('error', getlang('URL bestaat al'));
						return redirect()->to(ADMIN_URL.'/category/add');
						exit;
					}

					$uploadPath = 'uploads/category'; 
					$file = $this->request->getFile('image');
					
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/category',$imagename);
					 	
					 	
				 	// }

					$file1 = $this->request->getFile('bimage');

					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = '';
					}
				
					// if(!empty($file1->getName()))
					// {   
					// 	$imagename1 = $file1->getRandomName();
					// 	$file1->move('uploads/category',$imagename1);
						
						
					// }

					$file2 = $this->request->getFile('bottom_cont_image');

					$imagename2 = convert_to_webp($file2, $uploadPath);
					if ($imagename2 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename2 = '';
					}
				
					// if(!empty($file2->getName()))
					// {   
					// 	$imagename2 = $file2->getRandomName();
					// 	$file2->move('uploads/category',$imagename2);
					// }


					$uploadPath1 = 'uploads/productcategoriesmetainfo'; 
					$cmog_image = $this->request->getFile('cmog_image');

					$cmimagename = convert_to_webp($cmog_image, $uploadPath1);
					if ($cmimagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$cmimagename = '';
					}
					
					// if(!empty($cmog_image->getName()))
         			// {   
         			// 	$cmimagename = $cmog_image->getRandomName();
					//  	$cmog_image->move('uploads/productcategoriesmetainfo',$cmimagename);
					 	
					 	
				 	// }
					 $multi_parent_categories = '';
					if(!empty($this->request->getVar('multi_parent_categories'))){
						$multi_parent_categories = implode(',',$this->request->getVar('multi_parent_categories'));
					}

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'description' => $this->request->getVar('description'),
						'featured_category' => ($this->request->getVar('featured_category')) ? $this->request->getVar('featured_category') : 0,
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'show_on_homepage' => ($this->request->getVar('show_on_homepage')) ? $this->request->getVar('show_on_homepage') : 0,
						'show_on_footer' => ($this->request->getVar('show_on_footer')) ? $this->request->getVar('show_on_footer') : 0,
						'chris_theme' => ($this->request->getVar('chris_theme')) ? $this->request->getVar('chris_theme') : 0,
						'is_sale' => ($this->request->getVar('is_sale')) ? $this->request->getVar('is_sale') : 0,
						'parent_id' => $this->request->getVar('parent_categories'),
						'multi_parent_categories' => $multi_parent_categories,
						'path_id' => 0,
						'auser_id' => $this->session->get('admin_id'),
						'image' => !empty($imagename) ? $imagename : '',
						'bimage' => !empty($imagename1) ? $imagename1 : '',
						'ban_description' =>$this->request->getVar('ban_description'),
						'bottom_cont_title' =>$this->request->getVar('bottom_cont_title'),
						'bottom_cont_sub_title' =>$this->request->getVar('bottom_cont_sub_title'),
						'bottom_content' =>$this->request->getVar('bottom_content'),
						'bottom_content_title2' =>$this->request->getVar('bottom_content_title2'),
						'bottom_content3' =>$this->request->getVar('bottom_content3'),
						'bottom_cont_button_name' =>$this->request->getVar('bottom_cont_button_name'),
						'bottom_cont_button_url' =>$this->request->getVar('bottom_cont_button_url'),
						'bottom_cont_image' => !empty($imagename2) ? $imagename2 : '',
						'slug' => cleanStr($this->request->getVar('slug')),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						'shoppingfeed' => $this->request->getVar('shoppingfeed'),
						'cmmeta_title' => $this->request->getVar('cmmeta_title'),
						'cmmeta_keyword' => $this->request->getVar('cmmeta_keyword'),
						'cmmeta_desc' => $this->request->getVar('cmmeta_desc'),
						'cmog_title' => $this->request->getVar('cmog_title'),
						'cmog_image' => !empty($cmimagename) ? $cmimagename : '',

					);
				
					$save_id = $this->general_model->insert_data('category',$insert_values);
					
					$category_info = $this->general_model->fetch_data('category',array("id"=>$save_id));

					if(!empty($save_id) && !empty($category_info))
					{
						if(empty($category_info[0]->parent_id))
						{
							$update_data["path_id"] = $category_info[0]->id;
							$this->general_model->update_data('category',$update_data,$save_id);
						}else{
							if(!empty($category_info[0]->parent_id))
							{
								$parentid_info = $this->general_model->fetch_data('category',array("id"=>$category_info[0]->parent_id));

								$update_data["path_id"] = $parentid_info[0]->path_id."/".$save_id;
								$this->general_model->update_data('category',$update_data,$save_id);
							}
						}
					}

					
					$this->session->setFlashdata('Success_message',"Categorie is succesvol aangemaakt");
					return redirect()->to(base_url(ADMIN_URL.'/category/manage') );
				}
				$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['option_detail'] = generateOptions($menu,0,'');
				$this->admin_template('beheerpaneel/category/add',$this->outputData);
		}

		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$category_data = $this->general_model->fetch_data('category',array('id'=>$id));

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
						'slug' => [
							'label' => getlang("category_url"),
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

						return redirect()->to(ADMIN_URL.'/category/edit/'.$id);
						exit;
					}
					$uploadPath = 'uploads/category'; 
					$file = $this->request->getFile('image');

					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $category_data[0]->image;
					}
					
					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/category',$imagename);
				 	// }else{
				 	// 	$imagename = $category_data[0]->image;
				 	// }

					$file1 = $this->request->getFile('bimage');
				
					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $category_data[0]->bimage;
					}
					// if(!empty($file1->getName()))
					// {   
					// 	$imagename1 = $file1->getRandomName();
					// 	$file1->move('uploads/category',$imagename1);
					// }else{
					// 	$imagename1 = $category_data[0]->bimage;
					// }

					$file2 = $this->request->getFile('bottom_cont_image');
				
					$imagename2 = convert_to_webp($file2, $uploadPath);
					if ($imagename2 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename2 = $category_data[0]->bottom_cont_image;
					}
					// if(!empty($file2->getName()))
					// {   
					// 	$imagename2 = $file2->getRandomName();
					// 	$file2->move('uploads/category',$imagename2);
					// }else{
					// 	$imagename2 = $category_data[0]->bottom_cont_image;
					// }

					// $fids = '';
					// if($this->request->getVar('features_id')){
					// 	$fids = '';
					// 	foreach($this->request->getVar('features_id') as $feat_ids){
					// 		$fids .= $feat_ids .',';
					// 	}
					// }

				 	
					$uploadPath1 = 'uploads/productcategoriesmetainfo'; 

					$cmog_image = $this->request->getFile('cmog_image');

					$cmimagename = convert_to_webp($cmog_image, $uploadPath1);
					if ($cmimagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$cmimagename = $category_data[0]->cmog_image;
					}
					
					// if(!empty($cmog_image->getName()))
	     			// {   
	     			// 	$cmimagename = $cmog_image->getRandomName();
					//  	$cmog_image->move('uploads/productcategoriesmetainfo',$cmimagename);
					 	
					 	
				 	// }else{
				 	// 	$cmimagename = $category_data[0]->cmog_image;
				 	// }
					$multi_parent_categories = '';
					if(!empty($this->request->getVar('multi_parent_categories'))){
						$multi_parent_categories = implode(',',$this->request->getVar('multi_parent_categories'));
					}
 
					$update_values = array(
						'name' => $this->request->getVar('name'),
						'description' => $this->request->getVar('description'),
						'featured_category' => ($this->request->getVar('featured_category')) ? $this->request->getVar('featured_category') : 0,
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'show_on_homepage' => ($this->request->getVar('show_on_homepage')) ? $this->request->getVar('show_on_homepage') : 0,
						'show_on_footer' => ($this->request->getVar('show_on_footer')) ? $this->request->getVar('show_on_footer') : 0,
						'chris_theme' => ($this->request->getVar('chris_theme')) ? $this->request->getVar('chris_theme') : 0,
						'is_sale' => ($this->request->getVar('is_sale')) ? $this->request->getVar('is_sale') : 0,
						'parent_id' => $this->request->getVar('parent_categories'),
						'multi_parent_categories' => $multi_parent_categories,
						'path_id' => 0,
						'auser_id' => $this->session->get('admin_id'),
						'image' => !empty($imagename) ? $imagename : '',
						'bimage' => !empty($imagename1) ? $imagename1 : '',
						'ban_description' =>$this->request->getVar('ban_description'),
						'bottom_cont_title' =>$this->request->getVar('bottom_cont_title'),
						'bottom_cont_sub_title' =>$this->request->getVar('bottom_cont_sub_title'),
						'bottom_content' =>$this->request->getVar('bottom_content'),
						'bottom_content_title2' =>$this->request->getVar('bottom_content_title2'),
						'bottom_content3' =>$this->request->getVar('bottom_content3'),
						'bottom_cont_button_name' =>$this->request->getVar('bottom_cont_button_name'),
						'bottom_cont_button_url' =>$this->request->getVar('bottom_cont_button_url'),
						'bottom_cont_image' => !empty($imagename2) ? $imagename2 : '',
						'slug' => cleanStr($this->request->getVar('slug')),
						'mod_date' => date('Y-m-d H:i:s'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						'shoppingfeed' => $this->request->getVar('shoppingfeed'),
						'cmmeta_title' => $this->request->getVar('cmmeta_title'),
						'cmmeta_keyword' => $this->request->getVar('cmmeta_keyword'),
						'cmmeta_desc' => $this->request->getVar('cmmeta_desc'),
						'cmog_title' => $this->request->getVar('cmog_title'),
						'cmog_image' => !empty($cmimagename) ? $cmimagename : '',

						// 'filter_feature_id' => substr($fids,0,-1),
					);
					
				
					$this->general_model->update_data('category',$update_values,$id);

					$category_info = $this->general_model->fetch_data('category',array("id"=>$id));

					if(!empty($id) && !empty($category_info))
					{
						if(empty($category_info[0]->parent_id))
						{
							$update_data["path_id"] = $category_info[0]->id;
							$this->general_model->update_data('category',$update_data,$id);
						}else{
							if(!empty($category_info[0]->parent_id))
							{
								$parentid_info = $this->general_model->fetch_data('category',array("id"=>$category_info[0]->parent_id));

								$update_data["path_id"] = $parentid_info[0]->path_id."/".$id;
								$this->general_model->update_data('category',$update_data,$id);
							}
						}
					}
					
					$this->session->setFlashdata('Success_message',"Categorie succesvol geupdatet");
					return redirect()->to(base_url(ADMIN_URL.'/category/manage') );
				}
				$this->outputData['category_data'] = $this->general_model->fetch_data('category',array('id'=>$id));
				$category_data = $this->general_model->fetch_data('category',array('id'=>$id));
				$category_info = $this->general_model->fetch_data('category',null,'`position` asc');
				$menu = buildMenu($category_info);
				$this->outputData['option_detail'] = generateOptions($menu,0,$category_data[0]->parent_id);
				$multiple =array();
				if(!empty($category_data[0]->multi_parent_categories)){

					$multiple = explode(',',$category_data[0]->multi_parent_categories);
				}
				$this->outputData['option_detail1'] = generateOptions11($menu,0,$multiple);
				// echo "<pre>";print_r($this->outputData['option_detail1'] );exit;



				$select = 'product_features.*,  product_features_descriptions.internal_name, product_features_descriptions.full_description';
				$where  = 'product_features.status="A"';
				$join   = 'product_features.feature_id = product_features_descriptions.feature_id';
				$order  = 'product_features.feature_id ASC';
				$this->outputData['features_detail'] = $this->general_model->limited_join_fetch('product_features', 'product_features_descriptions', $select, $join, $where, null,null, $order, null);	
				
				$this->admin_template('beheerpaneel/category/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$category_data = $this->general_model->fetch_data('category',array('id'=>$id));
			$products      = $this->general_model->fetch_data('product', array('cat_id'=>$id));

			if(!empty($category_data) && !empty($category_data[0]->image))
			{
				if(file_exists('./uploads/category/'.$category_data[0]->image)){

					unlink('./uploads/category/'.$category_data[0]->image);
				}
			}

			// if(!empty($products))
			// {
			// 	foreach($products as $key => $val)
			// 	{
			// 		if(isset($val->pimage) && !empty($val->pimage))
			// 		{					
			// 			unlink('./uploads/product/'.$val->pimage);
			// 		}
			// 	}
			// }
			
			// $this->general_model->delete_condition('product',array('cat_id'=>$id));
			$product_categories = $this->general_model->fetch_data('product_categories', array('category_id'=>$id));


			if(!empty($product_categories))
			{
				foreach($product_categories as $cate){
					
					$this->general_model->delete_condition('product_categories',array('category_id'=>$cate->category_id));
				}
				
			}
			$this->general_model->delete_data('category',$id);
			return redirect()->to(base_url(ADMIN_URL.'/category/manage'));
		}

		function menu_settings(){


			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			
			else

				if(!empty($this->request->getVar())){

					$menu = $this->request->getVar('menu');
					$array_menu = json_decode($menu, true);
					
					// $this->general_model->update_condition('category', array('status' => '1'), array('id !=' =>''));
					// echo "<pre>";print_r($array_menu);exit;

					updateMenu($array_menu,null,null);

					$this->session->setFlashdata('Success_message',"Met succes opgeslagen");
					return redirect()->to(base_url(ADMIN_URL.'/category/menu_settings'));
				
				}
				
			$this->admin_template('beheerpaneel/category/menu_settings',$this->outputData);

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
					$this->session->set('cat_entries', $selected);
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		function remove_cat_image($id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				if(!empty($id)){
					
					$imageValue = $this->request->getVar('imageValue');
					$key = $this->request->getVar('key');
					if($key == "image"){
						$update_data["image"] = '';
					}elseif($key == "bimage"){
						$update_data["bimage"] = '';
					}elseif($key == "bottom_cont_image"){
						$update_data["bottom_cont_image"] = '';
					}
					// echo "<pre>";print_r($update_data);exit;
					if(!empty($update_data)){
						$this->general_model->update_data('category',$update_data,$id);
						if(file_exists(FCPATH.'uploads/category/'.$imageValue)){
							unlink(FCPATH.'uploads/category/'.$imageValue);
						}
						echo json_encode(array("success" => true,"message" => 'removed successfully'));
					}else{
						echo json_encode(array("error" => true,"message" => 'not removed successfully'));
	
					}
				}else{
					echo json_encode(array("error" => true,"message" => 'not removed successfully'));

				}
			}
		}

		


	}