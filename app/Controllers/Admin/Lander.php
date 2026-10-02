<?php 

	

	namespace App\Controllers\Beheerpaneel;

	use App\Controllers\BaseController;

	use App\Models\General_model;



	class Lander extends BaseController 
	{

		public function __construct() {
			
			

		}

		function manage(){
			if(!isAdmin())

				return redirect()->to(base_url(ADMIN_URL.'/login') );

			else
				// $this->outputData['page_detail'] = $this->general_model->fetch_data('pages');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {

					$totalrecords = $this->outputData['lander_detail'] = $this->general_model->fetch_data('lander',NULL,$order_by);
					$condition = array('id!='=>'');

					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'title' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$lander = $this->outputData['lander_detail'] = $this->general_model->fetch_limited('lander',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($lander as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($lander);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($lander);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}

				//$this->admin_template('beheerpaneel/pages/manage',$this->outputData);

				$this->admin_template('beheerpaneel/lander/manage',$this->outputData);

		}
		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/lander/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->title."</a>";

			$edit_url =base_url(ADMIN_URL.'/lander/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/lander/delete/'.$data->id);
            $duplicate_url = base_url(ADMIN_URL.'/lander/duplicate/'.$data->id);;
			$remove_lang = getlang('remove');
			$edit_lang = getlang('edit');
            $duplicate_lang = getlang('Duplicaat');
			$last_r = "<ul class='nk-tb-actions gx-1'>
				<li>
					<div class='drodown'>
						<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
						<div class='dropdown-menu dropdown-menu-end'>
							<ul class='link-list-opt no-bdr'>
								<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
								<li><a href='$remove_url' data-url='$remove_url' class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
                                <li><a href='$duplicate_url'><em class='icon ni ni-plus'></em><span>$duplicate_lang</span></a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>";
			$row_data = array(
				$first_,
			$data->id,
			$name,
			$data->slug,
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

					$file = $this->request->getFile('bottom_image');
					$imagename = '';

					$uploadPath = 'uploads/lander'; 

					if(!empty($file->getName()))
         			{   

         				$imagename = $file->getRandomName();

					 	$file->move('uploads/lander',$imagename);

				 	}
                    // $og_imagefile = $this->request->getFile('og_image');
					// $og_image = '';

					// $uploadPath = 'uploads/lander'; 

					// if(!empty($og_imagefile->getName()))
         			// {   

         			// 	$og_image = $og_imagefile->getRandomName();

					//  	$og_imagefile->move('uploads/lander',$og_image);

				 	// }

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'title' => [
							'label' => getlang("title"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'slug' => [
							'label' => getlang("slug"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'categories_id' => [
							'label' => getlang("categories_id"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'top_products' => [
							'label' => getlang("Topproducten"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'best_selling_products' => [
							'label' => getlang("best_selling_products"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'bottom_products' => [
							'label' => getlang("top_inhoud"),
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

						return redirect()->to(ADMIN_URL.'/lander/add');
						exit;
					}
					$url = check_page_url(cleanStr(trim($this->request->getVar('slug'))));
					$slug ='';
					if($url){
						$slug = $url;
					}else{
						$errorString = "Voer een unieke URL in";
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/lander/add');
						exit;
					}
					
					$insert_values = array(

						'title' => $this->request->getVar('title'),
						'box_content' => $this->request->getVar('box_content'),
						'button_content' => $this->request->getVar('button_content'),
						'button_url' => $this->request->getVar('button_url'),
						'sub_title1' => $this->request->getVar('sub_title1'),
						'sub_title2' => $this->request->getVar('sub_title2'),
						'bottom_content' => $this->request->getVar('bottom_content'),
						'slug' => $slug,
						'cananical_url' => $this->request->getVar('cananical_url'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_description' => $this->request->getVar('meta_description'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						// 'og_title' => $this->request->getVar('og_title'),
						'categories_id' => !empty($this->request->getVar('categories_id')) ? implode(',',$this->request->getVar('categories_id')):'',
						'top_products' => !empty($this->request->getVar('top_products')) ? implode(',',$this->request->getVar('top_products')) : '',
						'best_selling_products' => !empty($this->request->getVar('best_selling_products')) ? implode(',',$this->request->getVar('best_selling_products')) : '',
						'bottom_products' => !empty($this->request->getVar('bottom_products')) ? implode(',',$this->request->getVar('bottom_products')) : '',
						'bottom_image' => $imagename,	
						'category_content' => !empty($this->request->getVar('category_content')) ? $this->request->getVar('category_content') : '',
						'bottom_button_content' => !empty($this->request->getVar('bottom_button_content')) ? $this->request->getVar('bottom_button_content') : '',
						'bottom_button_url' => !empty($this->request->getVar('bottom_button_url')) ? $this->request->getVar('bottom_button_url') : '',

					);
                    
					$this->general_model->insert_data('lander',$insert_values);

					$this->session->setFlashdata('Success_message',"Pagina is succesvol aangemaakt");

					return redirect()->to(base_url('beheerpaneel/lander/manage') );

				}

			// $this->admin_template('beheerpaneel/pages/add');
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
            $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
            $this->outputData['all_products'] = $this->general_model->fetch_data('product');
			$this->outputData['lander_product'] = $this->general_model->fetch_data('lander_product');

			$this->admin_template('beheerpaneel/lander/add',$this->outputData);

		}
		function edit($id){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$lander_data = $this->general_model->fetch_data('lander',array('id'=>$id));



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/lander'; 
					$file = $this->request->getFile('bottom_image');
					
					if(!empty($file) && !empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/lander',$imagename);
				 	}else{
				 		$imagename = $lander_data[0]->bottom_image;
				 	}
                    // $og_imagefile = $this->request->getFile('og_image');
					// $og_image = '';


					// if(!empty($og_imagefile) && !empty($og_imagefile->getName()))
         			// {   

         			// 	$og_image = $og_imagefile->getRandomName();

					//  	$og_imagefile->move('uploads/lander',$og_image);

				 	// }else{
				 	// 	$og_image = $lander_data[0]->og_image;

                    // }


					 $validation = \Config\Services::validation();
					 $input = $this->validate([
						'title' => [
							'label' => getlang("title"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'slug' => [
							'label' => getlang("slug"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'categories_id' => [
							'label' => getlang("categories_id"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'top_products' => [
							'label' => getlang("top_products"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'best_selling_products' => [
							'label' => getlang("best_selling_products"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'bottom_products' => [
							'label' => getlang("top_inhoud"),
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
 
						 return redirect()->to('beheerpaneel/lander/edit/'.$id);
						 exit;
					 }
					$url = check_page_url(cleanStr(trim($this->request->getVar('slug'))),$id);
					$slug ='';
					if($url){
						$slug = $url;
					}else{
						$errorString = "Voer een unieke URL in";
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/lander/edit/'.$id);
						exit;
					}


					$update_values = array(

						'title' => $this->request->getVar('title'),
						'box_content' => $this->request->getVar('box_content'),
						'button_content' => $this->request->getVar('button_content'),
						'button_url' => $this->request->getVar('button_url'),
						'sub_title1' => $this->request->getVar('sub_title1'),
						'sub_title2' => $this->request->getVar('sub_title2'),
						'bottom_content' => $this->request->getVar('bottom_content'),
						'slug' => $slug,
						'cananical_url' => $this->request->getVar('cananical_url'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_description' => $this->request->getVar('meta_description'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						// 'og_title' => $this->request->getVar('og_title'),
						'categories_id' => !empty($this->request->getVar('categories_id')) ? implode(',',$this->request->getVar('categories_id')):'',
						'top_products' => !empty($this->request->getVar('top_products')) ? implode(',',$this->request->getVar('top_products')) : '',
						'best_selling_products' => !empty($this->request->getVar('best_selling_products')) ? implode( ',',$this->request->getVar('best_selling_products')) : '',
						'bottom_products' => !empty($this->request->getVar('bottom_products')) ? implode(',',$this->request->getVar('bottom_products')) : '',
						'single_bottom_products' => !empty($this->request->getVar('single_bottom_products')) ? $this->request->getVar('single_bottom_products') : '',

						'bottom_image' => $imagename,	
						'category_content' => !empty($this->request->getVar('category_content')) ? $this->request->getVar('category_content') : '',
						'bottom_button_content' => !empty($this->request->getVar('bottom_button_content')) ? $this->request->getVar('bottom_button_content') : '',
						'bottom_button_url' => !empty($this->request->getVar('bottom_button_url')) ? $this->request->getVar('bottom_button_url') : '',

					);

					$this->general_model->update_data('lander',$update_values,$id);

					$this->session->setFlashdata('Success_message',"Pagina succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/lander/manage') );

				}

				$this->outputData['lander'] = $this->general_model->fetch_data('lander',array('id'=>$id));
                $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
                $this->outputData['all_products'] = $this->general_model->fetch_data('product');
                $this->outputData['lander_product'] = $this->general_model->fetch_data('lander_product');
				//$this->admin_template('beheerpaneel/pages/edit',$this->outputData);

				$this->admin_template('beheerpaneel/lander/edit',$this->outputData);



		}
		function delete(){

			$session = session();

			

			$id=$this->request->uri->getSegment(4);

			$lander_data = $this->general_model->fetch_data('lander',array('id'=>$id));

			

			// if(!empty($lander_data[0]->image)){

			// 	unlink('./uploads/lander/'.$lander_data[0]->image);	

			// }

			

			$this->general_model->delete_data('lander',$id);

			return redirect()->to(base_url('beheerpaneel/lander/manage'));

		}
		function duplicate($id){
			$lander_data = $this->general_model->fetch_row('lander',array('id'=>$id));
			if(!empty($lander_data)){

				$unique_lander_url = get_unique_lander_url($lander_data->slug);
				$insert_values = array(

					'title' => $lander_data->title,
					'box_content' => $lander_data->box_content,
					'button_content' => $lander_data->button_content,
					'button_url' => $lander_data->button_url,
					'sub_title1' => $lander_data->sub_title1,
					'sub_title2' => $lander_data->sub_title2,
					'bottom_content' => $lander_data->bottom_content,
					'slug' => $unique_lander_url,
					'meta_title' => $lander_data->meta_title,
					'meta_description' => $lander_data->meta_description,
					'meta_keyword' => $lander_data->meta_keyword,
					'og_title' => $lander_data->og_title,
					'categories_id' => $lander_data->categories_id,
					'top_products' => $lander_data->top_products,
					'best_selling_products' => $lander_data->best_selling_products,
					'bottom_products' => $lander_data->bottom_products,
					'single_bottom_products' => $lander_data->single_bottom_products,
					'og_image' => $lander_data->og_image,
					'bottom_image' => $lander_data->bottom_image,
					'category_content' => $lander_data->category_content,
					'bottom_button_content' => $lander_data->bottom_button_content,
					'bottom_button_url' => $lander_data->bottom_button_url,	
				);
				
				$this->general_model->insert_data('lander',$insert_values);

				$this->session->setFlashdata('Success_message',"Pagina is succesvol aangemaakt");

				return redirect()->to(base_url('beheerpaneel/lander/manage') );

			}

		}
		function lander_product_manage(){
			if(!isAdmin())

				return redirect()->to(base_url(ADMIN_URL.'/login') );

			else
				// $this->outputData['page_detail'] = $this->general_model->fetch_data('pages');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					
					$totalrecords = $this->outputData['lander_detail'] = $this->general_model->fetch_data('lander_product',NULL,$order_by);
					$condition = array('id!='=>'');
					
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';
					
					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'title' => '%' . $search . '%',
							// Add more fields if needed
						];
						
					}
					$lander = $this->outputData['lander_detail'] = $this->general_model->fetch_limited('lander_product',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($lander as $data) {
						$result[] = $this->_lander_product_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($lander);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($lander);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}

				//$this->admin_template('beheerpaneel/pages/manage',$this->outputData);

				$this->admin_template('beheerpaneel/lander_product/manage',$this->outputData);

		}
		private function _lander_product_make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/lander/lander_product_edit/'.$data->id);
			$name = "<a  href='$url'>".$data->title."</a>";

			$edit_url =base_url(ADMIN_URL.'/lander/lander_product_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/lander/lander_product_delete/'.$data->id);
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
			$image = '<img src="'.image_url('uploads/noimage.jpg').'" width="100" height="100" />';
			if(!empty($data->image)){

				$image = '<img src="'.image_url('uploads/lander_product/'.$data->image).'" width="100" height="100" />';
			}
			$row_data = array(
				$first_,
			$data->id,
			$name,
			$image,
			$last_r,
			);
		
			
			return $row_data;
		}
		function lander_product_add(){

			if(!isAdmin())

				return redirect()->to(base_url(ADMIN_URL.'/login') );

			else

				if(!empty($this->request->getVar())){

					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);

					$file = $this->request->getFile('image');
					$imagename = '';

					$uploadPath = 'uploads/lander_product'; 

					if(!empty($file->getName()))
         			{   

         				$imagename = $file->getRandomName();

					 	$file->move('uploads/lander_product',$imagename);

				 	}

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

						return redirect()->to(ADMIN_URL.'/lander/lander_product_add');
						exit;
					}
					
					$insert_values = array(

						'title' => $this->request->getVar('title'),
						'content' => $this->request->getVar('content'),
						'button_text' => $this->request->getVar('button_text'),
						'button_url' => $this->request->getVar('button_url'),
						'image' => $imagename,	

					);
                    
					$this->general_model->insert_data('lander_product',$insert_values);

					$this->session->setFlashdata('Success_message',"Pagina is succesvol aangemaakt");

					return redirect()->to(base_url('beheerpaneel/lander/lander_product_manage') );

				}

			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
            $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
            $this->outputData['all_products'] = $this->general_model->fetch_data('product');

			$this->admin_template('beheerpaneel/lander_product/add',$this->outputData);

		}
		function lander_product_edit($id){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$lander_data = $this->general_model->fetch_data('lander_product',array('id'=>$id));



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/lander_product'; 
					$file = $this->request->getFile('image');
					
					if(!empty($file) && !empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/lander_product',$imagename);
				 	}else{
				 		$imagename = $lander_data[0]->image;
				 	}

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
 
						 return redirect()->to('beheerpaneel/lander/lander_product_edit/'.$id);
						 exit;
					 }

					$update_values = array(

						'title' => $this->request->getVar('title'),
						'content' => $this->request->getVar('content'),
						'button_text' => $this->request->getVar('button_text'),
						'button_url' => $this->request->getVar('button_url'),
						'image' => $imagename,	

					);

					$this->general_model->update_data('lander_product',$update_values,$id);

					$this->session->setFlashdata('Success_message',"Pagina succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/lander/lander_product_manage') );

				}

				$this->outputData['lander'] = $this->general_model->fetch_data('lander_product',array('id'=>$id));
                $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
                $this->outputData['all_products'] = $this->general_model->fetch_data('product');

				$this->admin_template('beheerpaneel/lander_product/edit',$this->outputData);

		}
		function lander_product_delete(){

			$session = session();

			

			$id=$this->request->uri->getSegment(4);

			$lander_data = $this->general_model->fetch_data('lander_product',array('id'=>$id));

			

			// if(!empty($lander_data[0]->image)){

			// 	unlink('./uploads/lander/'.$lander_data[0]->image);	

			// }

			

			$this->general_model->delete_data('lander_product',$id);

			return redirect()->to(base_url('beheerpaneel/lander/lander_product_manage'));

		}



	}