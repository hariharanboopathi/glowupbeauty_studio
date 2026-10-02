<?php 

	

	namespace App\Controllers\Beheerpaneel;

	use App\Controllers\BaseController;

	use App\Models\General_model;



	class Pages extends BaseController 
	{

		public function __construct() {
			
			

		}

		function manage()
		{

			if(!isAdmin())

				return redirect()->to(base_url(ADMIN_URL.'/login') );

			else

				// $this->outputData['page_detail'] = $this->general_model->fetch_data('pages');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['page_detail'] = $this->general_model->fetch_data('pages',NULL,$order_by);
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
					$pages = $this->outputData['page_detail'] = $this->general_model->fetch_limited('pages',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($pages as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($pages);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($pages);
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

				$this->admin_template('beheerpaneel/pages/manage',$this->outputData);

		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/pages/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";
			$modified_date = date('d-m-Y h:m',strtotime($data->mod_at));
			$ptype = $data->page_url; 

			$edit_url =base_url(ADMIN_URL.'/pages/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/pages/delete/'.$data->id);
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
			$ptype,
			$modified_date,
			$last_r,
			);
		
			
			return $row_data;
		}

		public function check_page_url($url,$pid = null)
		{
			// $url = $this->request->getPost('page_url');

			if($pid){
				$check_data = $this->general_model->fetch_data('pages',array('page_url'=>$url,'id !='=>$pid));
			} else {
				$check_data = $this->general_model->fetch_data('pages',array('page_url'=>$url));
			}
			
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

					$file = $this->request->getFile('image');
					$imagename = '';
					$uploadPath = 'uploads/pages'; 
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}

					// if(!empty($file->getName()))
         			// {   

         			// 	$imagename = $file->getRandomName();

					//  	$file->move('uploads/pages',$imagename);

				 	// }

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("page_name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'pageurl' => [
							'label' => getlang("page_url"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'ptype' => [
							'label' => getlang("page_type"),
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

						return redirect()->to(ADMIN_URL.'/pages/add');
						exit;
					}
					

					$check_url = $this->check_page_url($this->request->getVar('pageurl'));
					if($check_url)
					{
						$this->session->setFlashdata('error', getlang('pagina-URL bestaat al'));
						return redirect()->to(ADMIN_URL.'/pages/add');
						exit;
					}
					
					$insert_values = array(

						'name' => $this->request->getVar('name'),

						'meta_title' => $this->request->getVar('meta_title'),

						'meta_desc' => $this->request->getVar('meta_desc'), 	

						'meta_keyword' => $this->request->getVar('meta_keyword'),

						'ptype' => $this->request->getVar('ptype'),

						'page_url' => str_replace(" ","-",$this->request->getVar('pageurl')),

						'fmenu' => ($this->request->getVar('fmenu')) ? $this->request->getVar('fmenu') :0,


						'fmenu1' => ($this->request->getVar('fmenu1')) ? $this->request->getVar('fmenu1') :0,

						'hmenu' => ($this->request->getVar('hmenu')) ? $this->request->getVar('hmenu') : 0,

						'pcontent' => $this->request->getVar('pcontent'),

						'auser_id' => $this->session->get('admin_id'),

						'image' => $imagename,

						'informatie' => ($this->request->getVar('informatie')) ? $this->request->getVar('informatie') :0,

					);
                    
					$this->general_model->insert_data('pages',$insert_values);

					$this->session->setFlashdata('Success_message',"Pagina is succesvol aangemaakt");

					return redirect()->to(base_url('beheerpaneel/pages/manage') );

				}

			// $this->admin_template('beheerpaneel/pages/add');
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
			$this->admin_template('beheerpaneel/pages/add',$this->outputData);

		}



		function edit($id){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$page_data = $this->general_model->fetch_data('pages',array('id'=>$id));



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/pages'; 
					$file = $this->request->getFile('image');
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $page_data[0]->image;
					}
					
					// if(!empty($file) && !empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/pages',$imagename);
				 	// }else{
				 	// 	$imagename = $page_data[0]->image;
				 	// }


					 $validation = \Config\Services::validation();
					 $input = $this->validate([
						 'name' => [
							 'label' => getlang("page_name"),
							 'rules' => 'trim|required',
							 'errors' => [
								 'required' => '{field} '.getlang('field_is_required').'.',
							 ],
						 ],
						 'pageurl' => [
							 'label' => getlang("page_url"),
							 'rules' => 'trim|required',
							 'errors' => [
								 'required' => '{field} '.getlang('field_is_required').'.',
							 ],
						 ],
						 'page_type' => [
							 'label' => getlang("page_type"),
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
 
						 return redirect()->to('beheerpaneel/pages/edit/'.$id);
						 exit;
					 }
					 
 
					 $check_url = $this->check_page_url($this->request->getVar('pageurl'),$id);
					 if($check_url)
					 {
						 $this->session->setFlashdata('error', getlang('pagina-URL bestaat al'));
						 return redirect()->to('beheerpaneel/pages/edit/'.$id);
						 exit;
					 }

					//  print_r( $this->request->getVar('pcontent'));exit;

					$update_values = array(

						'name' => $this->request->getVar('name'),

						'meta_title' => $this->request->getVar('meta_title'),

						'meta_desc' => $this->request->getVar('meta_desc'),

						'meta_keyword' => $this->request->getVar('meta_keyword'),

						'ptype' => $this->request->getVar('ptype'),

						'page_url' => str_replace(" ","-",$this->request->getVar('pageurl')),

						'fmenu' => ($this->request->getVar('fmenu')) ? $this->request->getVar('fmenu') :0,
						
						'fmenu1' => ($this->request->getVar('fmenu1')) ? $this->request->getVar('fmenu1') :0,

						'hmenu' => ($this->request->getVar('hmenu')) ? $this->request->getVar('hmenu') : 0,

						'pcontent' => $this->request->getVar('pcontent'),

						'auser_id' => $this->session->get('admin_id'),

						'image' => $imagename,

						'informatie' => ($this->request->getVar('informatie')) ? $this->request->getVar('informatie') :0,

						'mod_at' => date('Y-m-d H:i:s')

					);

				

					$this->general_model->update_data('pages',$update_values,$id);

					

					$this->session->setFlashdata('Success_message',"Pagina succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/manage') );

				}

				$this->outputData['page_data'] = $this->general_model->fetch_data('pages',array('id'=>$id));

				//$this->admin_template('beheerpaneel/pages/edit',$this->outputData);

				$this->admin_template('beheerpaneel/pages/edit',$this->outputData);



		}



		function delete(){

			$session = session();

			

			$id=$this->request->uri->getSegment(4);

			$page_data = $this->general_model->fetch_data('pages',array('id'=>$id));

			

			if(!empty($page_data[0]->image)){

				unlink('./uploads/pages/'.$page_data[0]->image);	

			}

			

			$this->general_model->delete_data('pages',$id);

			return redirect()->to(base_url('beheerpaneel/pages/manage'));

		}

		function homefeatures()
		{
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$hdata = $this->general_model->fetch_data('homefeatures');
				if(!empty($this->request->getVar()))
				{
					$file1 = $this->request->getFile('image_1');
					$file2 = $this->request->getFile('image_2');
					$file3 = $this->request->getFile('image_3');
					$file4 = $this->request->getFile('image_4');
					if(!empty($file1->getName()))
	     			{   
	     				$imagename1 = $file1->getRandomName();
					 	$file1->move('uploads/homefeatures',$imagename1);
				 	}
					else
					{
				 		$imagename1 = $hdata[0]->image_1;
				 	}
				 	if(!empty($file2->getName()))
	     			{   
	     				$imagename2 = $file2->getRandomName();
					 	$file2->move('uploads/homefeatures',$imagename2);
				 	}
					else
					{
				 		$imagename2 = $hdata[0]->image_2;
				 	}
				 	if(!empty($file3->getName()))
	     			{   
	     				$imagename3 = $file3->getRandomName();
					 	$file3->move('uploads/homefeatures',$imagename3);
				 	}
					else
					{
				 		$imagename3 = $hdata[0]->image_3;
				 	}
				 	if(!empty($file4->getName()))
	     			{   
	     				$imagename4 = $file4->getRandomName();
					 	$file4->move('uploads/homefeatures',$imagename4);
				 	}
					else
					{
				 		$imagename4 = $hdata[0]->image_4;
				 	}

					$update_values = array(
						'title' => $this->request->getVar('title'),
						'image_1' => $imagename1,
						'content_1' => $this->request->getVar('content_1'),
						'image_2' => $imagename2,
						'content_2' => $this->request->getVar('content_2'),
						'image_3' => $imagename3,
						'content_3' => $this->request->getVar('content_3'),
						'image_4' => $imagename4,
						'content_4' => $this->request->getVar('content_4')
					);
					// $this->general_model->update_data('homefeatures',$update_values,$id);
					if(!empty($hdata)){
						$this->general_model->update_data('homefeatures',$update_values,1);
					}else{
						$this->general_model->insert_data('homefeatures',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Functies zijn succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/homefeatures') );

				}



				$this->outputData['hfeatures'] = $this->general_model->fetch_data('homefeatures');

				$this->admin_template('beheerpaneel/pages/homefeatures',$this->outputData);

			

		}





		function homebanner(){



			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				// $id = 1;



				$homebanner = $this->general_model->fetch_data('homebanner');



				if(!empty($this->request->getVar())){



					$file = $this->request->getFile('image');

					

					if(!empty($file->getName()))

	     			{   

	     				$imagename = $file->getRandomName();

					 	$file->move('uploads/homebanner',$imagename);

					 	

					 	

				 	}else{

				 		$imagename = $homebanner[0]->image;

				 	}





					$update_values = array(

						'image' => $imagename,

						'content' => $this->request->getVar('content')

					);

					// $this->general_model->update_data('homebanner',$update_values,$id);

					if(!empty($homebanner)){
						$this->general_model->update_data('homebanner',$update_values,$homebanner[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('homebanner',$update_values);
					}

					

					

					$this->session->setFlashdata('Success_message',"Banner succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/homebanner') );

				}



				$this->outputData['homebanner'] = $this->general_model->fetch_data('homebanner');

				$this->admin_template('beheerpaneel/pages/homebanner',$this->outputData);

			

		}





		function homecontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$homecontent = $this->general_model->fetch_data('homecontent');



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/homecontent'; 
					$file1 = $this->request->getFile('image_1');

					// $file2 = $this->request->getFile('image_2');

					// $file3 = $this->request->getFile('image_3');

					
					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $homecontent[0]->image_1;
					}
					// if(!empty($file1->getName()))
	     			// {   
	     			// 	$imagename1 = $file1->getRandomName();
					//  	$file1->move('uploads/homecontent',$imagename1);

				 	// } else {

				 	// 	$imagename1 = $homecontent[0]->image_1;

				 	// }



				 	// if(!empty($file2->getName()))
	     			// {   
	     			// 	$imagename2 = $file2->getRandomName();
					//  	$file2->move('uploads/homecontent',$imagename2);

				 	// }else{

				 	// 	$imagename2 = $homecontent[0]->image_2;

				 	// }



				 	// if(!empty($file3->getName()))

	     			// {   

	     			// 	$imagename3 = $file3->getRandomName();

					//  	$file3->move('uploads/homecontent',$imagename3);

				 	// }else{

				 	// 	$imagename3 = $homecontent[0]->image_3;

				 	// }





					$update_values = array(

						'image_1' => $imagename1,

						'content_1' => $this->request->getVar('content_1'),

						// 'image_2' => $imagename2,
 						// 'image_3' => $imagename3,
						
						'content_2' => $this->request->getVar('content_2'),
						
						// 'content_3' => $this->request->getVar('content_3'),

						'produt_cont' => $this->request->getVar('produt_cont'),
						
						'category_cont' => $this->request->getVar('category_cont'),

						'reviews_cont' => $this->request->getVar('reviews_cont'),
						
						'news_cont' => $this->request->getVar('news_cont'),


						'product_title' => $this->request->getVar('product_title'),
						
						// 'product_subtitle' => $this->request->getVar('product_subtitle'),

						'category_title' => $this->request->getVar('category_title'),
						
						// 'category_subtitle' => $this->request->getVar('category_subtitle'),

						// 'review_title' => $this->request->getVar('review_title'),
						
						// 'review_subtitle' => $this->request->getVar('review_subtitle'),

						'news_title' => $this->request->getVar('news_title'),

						'google_review_link' => $this->request->getVar('google_review_link'),
						'webwinkelkeur_link' => $this->request->getVar('webwinkelkeur_link'),
						'feedback_company_link' => $this->request->getVar('feedback_company_link'),
						'review_rating' => $this->request->getVar('review_rating'),
						'review_count' => $this->request->getVar('review_count'),

						
						// 'news_subtitle' => $this->request->getVar('news_subtitle'),


						

					);

				// print_r($update_values);exit;

					// $this->general_model->update_data('homecontent',$update_values,$id);

					if(!empty($homecontent)){
						$this->general_model->update_data('homecontent',$update_values,$homecontent[0]->id);
					}else{
						
						$this->general_model->insert_data('homecontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/homecontent') );

				}



				$this->outputData['homecontent'] = $this->general_model->fetch_data('homecontent');

				$this->admin_template('beheerpaneel/pages/homecontent',$this->outputData);

			

		}



		function offerad(){



			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$id = $this->request->uri->getSegment(4);



				$offeradvertisement = $this->general_model->fetch_data('offeradvertisement',array('id'=>$id));



				if(!empty($this->request->getVar())){



					$file = $this->request->getFile('image');

					

					if(!empty($file->getName()))

	     			{   

	     				$imagename = $file->getRandomName();

					 	$file->move('uploads/offers',$imagename);

					 	

					 	

				 	}else{

				 		$imagename = $offeradvertisement[0]->image;

				 	}





					$update_values = array(

						'image' => $imagename,

						'position' => $this->request->getVar('position'),

						'link' => $this->request->getVar('link')

					);

				

					$this->general_model->update_data('offeradvertisement',$update_values,$id);

					

					$this->session->setFlashdata('Success_message',"Advertentie succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/admanage') );

				}



				$this->outputData['offerad'] = $this->general_model->fetch_data('offeradvertisement',array('id'=>$id));

				$this->admin_template('beheerpaneel/pages/offerad',$this->outputData);

		

		}



		function admanage(){



			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$this->outputData['offeradvertisement'] = $this->general_model->fetch_data('offeradvertisement');

			

				$this->admin_template('beheerpaneel/pages/admanage',$this->outputData);

		}


		function addadvertisement(){



			// if(!isAdmin())

			// 	return redirect()->to(base_url('beheerpaneel/login') );

			// else

			// 	$this->outputData['offeradvertisement'] = $this->general_model->fetch_data('offeradvertisement');

			

			// 	$this->admin_template('beheerpaneel/pages/addadvertisement');


			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				// $id = $this->request->uri->getSegment(4);



				// $offeradvertisement = $this->general_model->fetch_data('offeradvertisement',array('id'=>$id));



				if(!empty($this->request->getVar())){



					$file = $this->request->getFile('image');

					

					if(!empty($file->getName()))

	     			{   

	     				$imagename = $file->getRandomName();

					 	$file->move('uploads/offers',$imagename);

					 	

					 	

				 	}/*else{

				 		$imagename = $offeradvertisement[0]->image;

				 	}*/





					$insert_values = array(

						'image' => ($imagename) ? $imagename : '',

						'position' => $this->request->getVar('position'),

						'link' => $this->request->getVar('link')

					);

				

					// $this->general_model->update_data('offeradvertisement',$update_values,$id);
					$this->general_model->insert_data('offeradvertisement',$insert_values);
					

					$this->session->setFlashdata('Success_message',"Advertentie succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/admanage') );

				}



				$this->outputData['offerad'] = $this->general_model->fetch_data('offeradvertisement',array('id'=>$id));

				$this->admin_template('beheerpaneel/pages/addadvertisement',$this->outputData);

		}


		function aboutuscontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$aboutuscontent = $this->general_model->fetch_data('aboutuscontent');



				if(!empty($this->request->getVar())){


					$uploadPath = 'uploads/aboutuscontent'; 

					$file1 = $this->request->getFile('image_1');
					$file2 = $this->request->getFile('image_2');

					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $aboutuscontent[0]->image_1;
					}
					$imagename2 = convert_to_webp($file2, $uploadPath);
					if ($imagename2 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename2 = $aboutuscontent[0]->image_2;
					}


					// if(!empty($file1->getName()))
	     			// {   
	     			// 	$imagename1 = $file1->getRandomName();
					//  	$file1->move('uploads/aboutuscontent',$imagename1);
				 	// }else{
				 	// 	$imagename1 = $aboutuscontent[0]->image_1;
				 	// }
				 	// if(!empty($file2->getName()))
	     			// {   
	     			// 	$imagename2 = $file2->getRandomName();
					//  	$file2->move('uploads/aboutuscontent',$imagename2);
				 	// }else{
				 	// 	$imagename2 = $aboutuscontent[0]->image_2;
				 	// }



				 	


					$update_values = array(

						'image_1' => $imagename1,

						'image_2' => $imagename2,

						'content_1' => $this->request->getVar('content_1'),

						'content_2' => $this->request->getVar('content_2'),

						'content_3' => $this->request->getVar('content_3'),

						'content_4' => $this->request->getVar('content_4'),

						'content_5' => $this->request->getVar('content_5'),

						'content_6' => $this->request->getVar('content_6'), 

						'content_7' => $this->request->getVar('content_7'),
						 
						'content_8' => $this->request->getVar('content_8'),


					);

				

					// $this->general_model->update_data('aboutuscontent',$update_values,$id);

					if(!empty($aboutuscontent)){
						$this->general_model->update_data('aboutuscontent',$update_values,$aboutuscontent[0]->id);
					}else{
						
						$this->general_model->insert_data('aboutuscontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/aboutuscontent') );

				}



				$this->outputData['aboutuscontent'] = $this->general_model->fetch_data('aboutuscontent');

				$this->admin_template('beheerpaneel/pages/aboutuscontent',$this->outputData);

			

		}



		function contactuscontent(){  

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$contactuscontent = $this->general_model->fetch_data('contactuscontent');



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/contactuscontent'; 
					$file1 = $this->request->getFile('image_1');


					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $contactuscontent[0]->image_1;
					}

					// if(!empty($file1->getName()))
	     			// {   

	     			// 	$imagename1 = $file1->getRandomName();

					//  	$file1->move('uploads/contactuscontent',$imagename1);

				 	// }else{

				 	// 	$imagename1 = $contactuscontent[0]->image_1;

				 	// }
					
					

					$update_values = array(

						'content_1' => $this->request->getVar('content_1'),
						'content_2' => $this->request->getVar('content_2'),
						'content_3' => $this->request->getVar('content_3'),
						'content_4' => $this->request->getVar('content_4'),
						'contact_email' => $this->request->getVar('contact_email'),
						'contact_address' => $this->request->getVar('contact_address'),
						'contact_telefoon' => $this->request->getVar('contact_telefoon'),
						'company_name' => $this->request->getVar('company_name'),
						'kvk' => $this->request->getVar('kvk'),
						'iban' => $this->request->getVar('iban'),
						'btw' => $this->request->getVar('btw'),
						'image_1' => $imagename1,
					);
					
					
				

					// $this->general_model->update_data('contactuscontent',$update_values,$id);

					if(!empty($contactuscontent)){
						$this->general_model->update_data('contactuscontent',$update_values,$contactuscontent[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('contactuscontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/contactuscontent') );

				}



				$this->outputData['contactuscontent'] = $this->general_model->fetch_data('contactuscontent');

				$this->admin_template('beheerpaneel/pages/contactuscontent',$this->outputData);

 		}
		
		
		
		
		
		
		
			function vacaturescontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else
 				
 				$vacaturescontent = $this->general_model->fetch_data('vacaturescontent');



				if(!empty($this->request->getVar())){
					$uploadPath = 'uploads/vacaturescontent'; 
					$file1 = $this->request->getFile('image_1');
					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $vacaturescontent[0]->image_1;
					}
					// if(!empty($file1->getName()))
	     			// {   
	     			// 	$imagename1 = $file1->getRandomName();
					//  	$file1->move('uploads/vacaturescontent',$imagename1);
				 	// }else{
				 	// 	$imagename1 = $vacaturescontent[0]->image_1;
				 	// }
 					

					$update_values = array(
						'content_1' => $this->request->getVar('content_1'),
						'content_2' => $this->request->getVar('content_2'),
						'content_3' => $this->request->getVar('content_3'), 
						'image_1' => $imagename1,
					);
					
					
				

					// $this->general_model->update_data('contactuscontent',$update_values,$id);

					if(!empty($vacaturescontent)){
						$this->general_model->update_data('vacaturescontent',$update_values,$vacaturescontent[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('vacaturescontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/vacaturescontent') );

				}



				$this->outputData['vacaturescontent'] = $this->general_model->fetch_data('vacaturescontent');

				$this->admin_template('beheerpaneel/pages/vacaturescontent',$this->outputData);

 		}
		
		
		
		
		
	    function fietsplancontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				
				$fietsplancontent = $this->general_model->fetch_data('fietsplancontent');



				if(!empty($this->request->getVar())){

					
					$file1 = $this->request->getFile('image_1');

					if(!empty($file1->getName()))
	     			{   
	     				$imagename1 = $file1->getRandomName();
					 	$file1->move('uploads/fietsplancontent',$imagename1);

				 	}else{
				 		$imagename1 = $fietsplancontent[0]->image_1;

				 	}
					
					
					$file2 = $this->request->getFile('image_2');

					if(!empty($file2->getName()))
	     			{   
	     				$imagename2 = $file2->getRandomName();
					 	$file2->move('uploads/fietsplancontent',$imagename2);

				 	}else{
				 		$imagename2 = $fietsplancontent[0]->image_2;

				 	}
					
					
					$file3 = $this->request->getFile('image_3');

					if(!empty($file3->getName()))
	     			{   
	     				$imagename3 = $file3->getRandomName();
					 	$file3->move('uploads/fietsplancontent',$imagename3);

				 	}else{
				 		$imagename3 = $fietsplancontent[0]->image_3;

				 	}
					

					$update_values = array(
						'content_1' => $this->request->getVar('content_1'),
						'content_2' => $this->request->getVar('content_2'),
						'content_3' => $this->request->getVar('content_3'),
						'content_4' => $this->request->getVar('content_4'),
						'image_1' => $imagename1,
						'image_2' => $imagename2,
						'image_3' => $imagename3
					);
					

					if(!empty($fietsplancontent)){
						$this->general_model->update_data('fietsplancontent',$update_values,$fietsplancontent[0]->id);
						
					}else{
						$this->general_model->insert_data('fietsplancontent',$update_values);
						
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/fietsplancontent') );

				}



				$this->outputData['fietsplancontent'] = $this->general_model->fetch_data('fietsplancontent');

				$this->admin_template('beheerpaneel/pages/fietsplancontent',$this->outputData);

 		}	
		

		
		
		
		function showroomcontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$showroomcontent = $this->general_model->fetch_data('showroomcontent');



				if(!empty($this->request->getVar())){

					
					$file1 = $this->request->getFile('image_1');

					if(!empty($file1->getName()))
	     			{   

	     				$imagename1 = $file1->getRandomName();

					 	$file1->move('uploads/showroomcontent',$imagename1);

				 	}else{

				 		$imagename1 = $showroomcontent[0]->image_1;

				 	}

					$update_values = array(
						'content_1' => $this->request->getVar('content_1'),
						'content_2' => $this->request->getVar('content_2'),
						'content_3' => $this->request->getVar('content_3'),
						'showroom_video' => $this->request->getVar('showroom_video'),
						'image_1' => $imagename1,
					);
					

					// $this->general_model->update_data('contactuscontent',$update_values,$id);

					if(!empty($showroomcontent)){
						$this->general_model->update_data('showroomcontent',$update_values,$showroomcontent[0]->id);
						
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('showroomcontent',$update_values);
						
					}

 
					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");
 					return redirect()->to(base_url('beheerpaneel/pages/showroomcontent') );

				}



				$this->outputData['showroomcontent'] = $this->general_model->fetch_data('showroomcontent');

				$this->admin_template('beheerpaneel/pages/showroomcontent',$this->outputData);

			

		}


		function showroomimagemanage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				// $this->outputData['showroomimage'] = $this->general_model->fetch_data('showroomimage');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['showroomimage'] = $this->general_model->fetch_data('showroomimage',NULL,$order_by);
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
					$showroomimage = $this->outputData['showroomimage'] = $this->general_model->fetch_limited('showroomimage',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($showroomimage as $data) {
						$result[] = $this->_make_rowshowroom($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($showroomimage);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($showroomimage);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
				$this->admin_template('beheerpaneel/showroomimage/manage',$this->outputData);
		}

		private function _make_rowshowroom($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/pages/showroomimageedit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";
			if (!empty($data->showroomimage) && file_exists(FCPATH . 'uploads/showroomimage/' . $data->showroomimage)) {
				$image_url = image_url('uploads/showroomimage/' . $data->showroomimage);
				$imgsrc = "<img src='$image_url' alt='$data->name' width='150' class='thumb' />";
			}
			else
			{
				$image_url = image_url('uploads/noimage.jpg');
				$imgsrc = "<img src='$image_url' alt='$data->name' width='150' class='thumb'>";
			}
			$edit_url =base_url(ADMIN_URL.'/pages/showroomimageedit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/pages/showroomimagedelete/'.$data->id);
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
			$imgsrc,
			$last_r,
			);
		
			
			return $row_data;
		}

		function productdetailcontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

			$productdetailcontent = $this->general_model->fetch_data('productdetailcontent');

			if(!empty($this->request->getVar())){

			  $update_values = array(
				'content_1' => $this->request->getVar('content_1'),
			  );

			   if(!empty($productdetailcontent)){
				$this->general_model->update_data('showroomcontent',$update_values,$productdetailcontent[0]->id);
				
			   }else{
				$this->general_model->insert_data('productdetailcontent',$update_values);	
			   }

			   $this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");
 			   return redirect()->to(base_url('beheerpaneel/pages/productdetailcontent') );
		    }

			$this->outputData['productdetailcontent'] = $this->general_model->fetch_data('productdetailcontent');

			$this->admin_template('beheerpaneel/pages/productdetailcontent',$this->outputData);

		}

		function blogcontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

			$blogcontent = $this->general_model->fetch_data('blogcontent');

			if(!empty($this->request->getVar())){

			  $update_values = array(
				'content_1' => $this->request->getVar('content_1'),
			  );
			   if(!empty($blogcontent)){
				$this->general_model->update_data('blogcontent',$update_values,$blogcontent[0]->id);
				
			   }else{
				$this->general_model->insert_data('blogcontent',$update_values);	
			   }

			   $this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");
 			   return redirect()->to(base_url('beheerpaneel/pages/blogcontent') );
		    }

			$this->outputData['blogcontent'] = $this->general_model->fetch_data('blogcontent');

			$this->admin_template('beheerpaneel/pages/blogcontent',$this->outputData);

		}

		function showroomimageadd(){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if(!empty($this->request->getVar())){

                    $previousInput = $this->request->getPost();
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$file = $this->request->getFile('showroomimage');
					
					if(!empty($file->getName()))
         			{   
         				$imagename = $file->getRandomName();
					 	$file->move('uploads/showroomimage',$imagename);
					 	
					 	
				 	}
					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'showroomimage' => ($imagename) ? $imagename : '',
						'auser_id' => $this->session->get('admin_id'),
						
					);
				
					$this->general_model->insert_data('showroomimage',$insert_values);
					
                    $this->session->setFlashdata('adminsuccess',getlang('succesvol toegevoegd'));
					return redirect()->to(base_url('beheerpaneel/pages/showroomimagemanage') );
				}
                $this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
				$this->admin_template('beheerpaneel/showroomimage/add',$this->outputData);
		}

		function showroomimageedit($id){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
                $showroomimage_data = $this->general_model->fetch_data('showroomimage',array('id'=>$id));
				if(!empty($this->request->getVar())){

                    $validation = \Config\Services::validation();
					

					$file = $this->request->getFile('showroomimage');
					
					if(!empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/showroomimage',$imagename);
					 	
					 	
				 	}else{
				 		$imagename = $showroomimage_data[0]->showroomimage;
				 	}
					
				 	$update_values = array(
						'name' => $this->request->getVar('name'),
						'showroomimage' => ($imagename) ? $imagename : '',
						'auser_id' => $this->session->get('admin_id'),
						'mod_at' => date('d-m-Y h:i:s'),
						
					);
					
				
					$this->general_model->update_data('showroomimage',$update_values,$id);
					
                    $this->session->setFlashdata('adminsuccess',getlang('succesvol geupdatet'));
					return redirect()->to(base_url('beheerpaneel/pages/showroomimagemanage') );
				}
				
				$this->outputData['showroomimage'] = $this->general_model->fetch_data('showroomimage',array('id'=>$id));
				$this->admin_template('beheerpaneel/showroomimage/edit',$this->outputData);

		}

		function showroomimagedelete(){
			
			$id=$this->request->uri->getSegment(4);
			$showroomimage_data = $this->general_model->fetch_data('showroomimage',array('id'=>$id));
			
			if(!empty($showroomimage_data[0]->showroomimage)){
				unlink('./uploads/showroomimage/'.$showroomimage_data[0]->showroomimage);	
			}
			$this->general_model->delete_data('showroomimage',$id);
			return redirect()->to(base_url('beheerpaneel/pages/showroomimagemanage'));
		}
		
		
		function faqcontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$faqcontent = $this->general_model->fetch_data('faqcontent');



				if(!empty($this->request->getVar())){

					$uploadPath = 'uploads/faqcontent'; 
					$file1 = $this->request->getFile('image_1');

					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $faqcontent[0]->image_1;
					}
					// if(!empty($file1->getName()))
	     			// {   

	     			// 	$imagename1 = $file1->getRandomName();

					//  	$file1->move('uploads/faqcontent',$imagename1);

				 	// }else{

				 	// 	$imagename1 = $faqcontent[0]->image_1;

				 	// }
					
					

					$update_values = array(

						'content_1' => $this->request->getVar('content_1'),
						'content_2' => $this->request->getVar('content_2'),
						'content_3' => $this->request->getVar('content_3'),
						'content_4' => $this->request->getVar('content_4'),
						'image_1' => !empty($imagename1) ? $imagename1 : '',
					);
					
					
				

					// $this->general_model->update_data('contactuscontent',$update_values,$id);

					if(!empty($faqcontent)){
						$this->general_model->update_data('faqcontent',$update_values,$faqcontent[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('faqcontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/faqcontent') );

				}



				$this->outputData['faqcontent'] = $this->general_model->fetch_data('faqcontent');

				$this->admin_template('beheerpaneel/pages/faqcontent',$this->outputData);

			

		}



		function testimonials(){



			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$this->outputData['testimonials_data'] = $this->general_model->fetch_data('testimonials');

			

				$this->admin_template('beheerpaneel/testimonials/manage',$this->outputData);

		}



		function testimonialsadd(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				if(!empty($this->request->getVar())){



					$file = $this->request->getFile('image');

					

					if(!empty($file->getName()))

         			{   

         				$imagename = $file->getRandomName();

					 	$file->move('uploads/testimonials',$imagename);

					 	

					 	

				 	}



					$insert_values = array(

						'name' => $this->request->getVar('name'),

						'content' => $this->request->getVar('content'),

						'auser_id' => $this->session->get('admin_id'),

						'image' => ($imagename) ? $imagename : '',

					);

				

					$this->general_model->insert_data('testimonials',$insert_values);

					

					$this->session->setFlashdata('Success_message',"Testimonials zijn succesvol toegevoegd");

					return redirect()->to(base_url('beheerpaneel/pages/testimonials') );

				}

			$this->admin_template('beheerpaneel/testimonials/add');

		}



		function testimonialsedit($id){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$testimonials_data = $this->general_model->fetch_data('testimonials',array('id'=>$id));



				if(!empty($this->request->getVar())){



					$file = $this->request->getFile('image');

					

					if(!empty($file->getName()))

	     			{   

	     				$imagename = $file->getRandomName();

					 	$file->move('uploads/testimonials',$imagename);

					 	

					 	

				 	}else{

				 		$imagename = $testimonials_data[0]->image;

				 	}



					$update_values = array(

						'name' => $this->request->getVar('name'),

						'content' => $this->request->getVar('content'),

						'auser_id' => $this->session->get('admin_id'),

						'image' => $imagename,

						'mod_at' => date('Y-m-d H:i:s')

					);

				

					$this->general_model->update_data('testimonials',$update_values,$id);

					

					$this->session->setFlashdata('Success_message',"Testimonials zijn succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/testimonials') );

				}

				$this->outputData['testimonials_data'] = $this->general_model->fetch_data('testimonials',array('id'=>$id));

				$this->admin_template('beheerpaneel/testimonials/edit',$this->outputData);



		}







		function testimonialsdelete(){

			

			$id=$this->request->uri->getSegment(4);

			

			$this->general_model->delete_data('testimonials',$id);

			return redirect()->to(base_url('beheerpaneel/pages/testimonials'));

		}





		function logincontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$logincontent = $this->general_model->fetch_data('logincontent');



				if(!empty($this->request->getVar())){



					$file1 = $this->request->getFile('image_1');

					

					if(!empty($file1->getName()))

	     			{   

	     				$imagename1 = $file1->getRandomName();

					 	$file1->move('uploads/logincontent',$imagename1);

					 	

				 	}else{

				 		$imagename1 = $logincontent[0]->image_1;

				 	}





					$update_values = array(

						'image_1' => $imagename1,

						'content_1' => $this->request->getVar('content_1'),

					);

				// print_r($update_values);exit;

					// $this->general_model->update_data('logincontent',$update_values,$id);

					if(!empty($logincontent)){
						$this->general_model->update_data('logincontent',$update_values,$logincontent[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('logincontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/logincontent') );

				}



				$this->outputData['logincontent'] = $this->general_model->fetch_data('logincontent');

				$this->admin_template('beheerpaneel/pages/logincontent',$this->outputData);

			

		}



		function registercontent(){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				

				$registercontent = $this->general_model->fetch_data('registercontent');



				if(!empty($this->request->getVar())){



					$file1 = $this->request->getFile('image_1');

					

					if(!empty($file1->getName()))

	     			{   

	     				$imagename1 = $file1->getRandomName();

					 	$file1->move('uploads/registercontent',$imagename1);

					 	

				 	}else{

				 		$imagename1 = $registercontent[0]->image_1;

				 	}





					$update_values = array(

						'image_1' => $imagename1,

						'content_1' => $this->request->getVar('content_1'),

					);

				// print_r($update_values);exit;

					// $this->general_model->update_data('registercontent',$update_values,$id);

					if(!empty($registercontent)){
						$this->general_model->update_data('registercontent',$update_values,$registercontent[0]->id);
					}else{
						// print_r($update_values);exit;
						$this->general_model->insert_data('registercontent',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/registercontent') );

				}



				$this->outputData['registercontent'] = $this->general_model->fetch_data('registercontent');

				$this->admin_template('beheerpaneel/pages/registercontent',$this->outputData);

			

		}





	  function manage_banners(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				// $this->outputData['homebanners'] = $this->general_model->fetch_data('homebanner');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['homebanners'] = $this->general_model->fetch_data('homebanner',NULL,$order_by);
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
					$homebanners = $this->outputData['homebanners'] = $this->general_model->fetch_limited('homebanner',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($homebanners as $data) {
						$result[] = $this->_make_rowbanners($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($homebanners);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($homebanners);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/homebanners/manage',$this->outputData);
		}

		private function _make_rowbanners($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/pages/edit_banner/'.$data->id);
			$name = "<a  href='$url'>".$data->banner_title."</a>";
			
			if(!empty($data->image))
			{
				$image_src = image_url('uploads/homebanners/'.$data->image);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->content' width='150' class='thumb'>";
				}
					
			}else {
				$imgsrc = "-";
			}

			$edit_url =base_url(ADMIN_URL.'/pages/edit_banner/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/pages/delete_banner/'.$data->id);
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
			$imgsrc,
			$last_r,
			);
		
			return $row_data;
		}

		function add_banner(){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if(!empty($this->request->getVar())){
					

					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'banner_title' => [
							'label' => getlang("titel"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'bdesc' => [
							'label' => getlang("description"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'burl' => [
							'label' => getlang("url"),
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

						return redirect()->to('beheerpaneel/pages/add_banner');
						exit;
					}

					$uploadPath = 'uploads/homebanners'; 
					$imagename = '';
					$file = $this->request->getFile('bimage');
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/homebanners',$imagename);
					 	
					 	
				 	// }

					$insert_values = array(
						'banner_title' => $this->request->getVar('banner_title'),
						'content' => $this->request->getVar('bdesc'),
						'created_at' => date('Y-m-d'),
						'image' => !empty($imagename) ? $imagename : '',
						'burl' => $this->request->getVar('burl'),
						'korting' => $this->request->getVar('korting'),

					);
					
					
				
					$this->general_model->insert_data('homebanner',$insert_values);
					
					$this->session->setFlashdata('Success_message',"Banner is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/pages/manage_banners') );
				}
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');				
			$this->admin_template('beheerpaneel/homebanners/add',$this->outputData);
		}


		function edit_banner($id){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$blog_data = $this->general_model->fetch_data('homebanner',array('id'=>$id));

		
				if(!empty($this->request->getVar())){


					$validation = \Config\Services::validation();
					$input = $this->validate([
						'banner_title' => [
							'label' => getlang("titel"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'bdesc' => [
							'label' => getlang("description"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'burl' => [
							'label' => getlang("url"),
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

						return redirect()->to('beheerpaneel/pages/edit_banner/'.$id);
						exit;
					}
					$file = $this->request->getFile('bimage');
					$uploadPath = 'uploads/homebanners'; 
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $blog_data[0]->image;
					}
					
					

					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/homebanners',$imagename);
					 	
					 	
				 	// }else{
				 	// 	$imagename = $blog_data[0]->image;
				 	// }

					$update_values = array(
						'banner_title' => $this->request->getVar('banner_title'),
						'content' => $this->request->getVar('bdesc'),
						'created_at' => date('Y-m-d'),
						'image' => !empty($imagename) ? $imagename : '',
						'burl' => $this->request->getVar('burl'),
						'korting' => $this->request->getVar('korting'),
					);


					$this->general_model->update_data('homebanner',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',"Banner succesvol bijgewerkt");
					return redirect()->to(base_url('beheerpaneel/pages/manage_banners') );
				}
				$this->outputData['homebanners_data'] = $this->general_model->fetch_data('homebanner',array('id'=>$id));
				$this->admin_template('beheerpaneel/homebanners/edit',$this->outputData);

		}
		
		

		function delete_banner(){
		
			$session = session();
			
			$id=$this->request->uri->getSegment(4);
			$blog_data = $this->general_model->fetch_data('homebanner',array('id'=>$id));
			
			if(!empty($blog_data[0]->bimage)){
				unlink('./uploads/homebanners/'.$blog_data[0]->bimage);	
			}
			
			$this->general_model->delete_data('homebanner',$id);
			return redirect()->to(base_url('beheerpaneel/pages/manage_banners'));
		}




		//working hours content function in the setting tab
		function workinghours()
		{
						if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else
				$gethours = $this->general_model->fetch_data('working_hours');



				if(!empty($this->request->getVar())){


					$update_values = array(

						'monday' => $this->request->getVar('monday'),
						'tuesday' => $this->request->getVar('tuesday'),
						'wednesday' => $this->request->getVar('wednesday'),
						'thursday' => $this->request->getVar('thursday'),
						'friday' => $this->request->getVar('friday'),
						'saturday' => $this->request->getVar('saturday'),
						'created_at'=>date('Y-m-d')

					);



					if(!empty($gethours)){
						$update_values['updated_at']=date('Y-m-d');
						$this->general_model->update_data('working_hours',$update_values,$gethours[0]->id);
					}else{
						
						$this->general_model->insert_data('working_hours',$update_values);
					}

					

					$this->session->setFlashdata('Success_message',"Inhoud is succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/pages/workinghours') );

				}



				$this->outputData['get_working_hours'] = $this->general_model->fetch_data('working_hours');

				$this->admin_template('beheerpaneel/pages/working_hours',$this->outputData);
		}
		//working hours content function end 

		function deleteselectedid($type){
			$ids=$this->request->getPost('values');


			if($type == 'faq_cat'){
				
				$res=$this->general_model->delete_where_in_condition('faq_category','id',$ids,null);
				if($res){
					$result=$this->general_model->delete_where_in_condition('faq','faq_cat_id',$ids,null);
				}else{
					$result = 0;
				}
			}elseif($type == 'faq'){
				$result = $this->general_model->delete_where_in_condition('faq','id',$ids,null);
			}elseif($type == 'pages'){

				foreach($ids as $id){
					$page_data = $this->general_model->fetch_data('pages',array('id'=>$id));
					if(!empty($page_data[0]->image)){
						if(file_exists('./uploads/pages/'.$page_data[0]->image)){
							unlink('./uploads/pages/'.$page_data[0]->image);	
						}
					}
				}
				$result = $this->general_model->delete_where_in_condition('pages','id',$ids,null);
			}elseif($type == 'news'){

				foreach($ids as $id){
				
					$blog_data = $this->general_model->fetch_data('blog',array('id'=>$id));

					if($blog_data){
						if(!empty($blog_data[0]->bimage)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage);	
						}
		
						if(!empty($blog_data[0]->bimage_lft)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage_lft);	
						}
						if(!empty($blog_data[0]->bimage_ryt)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage_ryt);	
						}
					}
				}
				$result = $this->general_model->delete_where_in_condition('blog','id',$ids,null);
				
			}elseif($type == 'homeusp'){

				$result = $this->general_model->delete_where_in_condition('homeuspcontents','id',$ids,null);
				// $db = db_connect();
				// echo "<pre>";print_r($db->getLastQuery());die;
			}elseif($type == 'homebanner'){

				foreach($ids as $id){

					$blog_data = $this->general_model->fetch_data('homebanner',array('id'=>$id));
			
					if($blog_data){
						if(!empty($blog_data[0]->bimage)){
							if(file_exists('./uploads/homebanners/'.$blog_data[0]->bimage)){
								unlink('./uploads/homebanners/'.$blog_data[0]->bimage);	
							}
						}
					}
				}
				$result = $this->general_model->delete_where_in_condition('homebanner','id',$ids,null);
				
			}elseif($type == 'brand'){

				foreach($ids as $id){

					$brand_data = $this->general_model->fetch_data('brand',array('id'=>$id));
					if($brand_data){
						if(!empty($brand_data[0]->image)){
							if(file_exists('./uploads/brand/'.$brand_data[0]->image)){
								unlink('./uploads/brand/'.$brand_data[0]->image);	
							}
						}
					}
				}
				$result = $this->general_model->delete_where_in_condition('brand','id',$ids,null);
				
			}elseif($type == 'order'){

				$result = $this->general_model->delete_where_in_condition('orders','id',$ids,null);
				
			}elseif($type == 'blog'){

				foreach($ids as $id){
					$blog_data = $this->general_model->fetch_data('blog',array('id'=>$id));
			
					if(!empty($blog_data[0]->bimage)){
						if(file_exists('./uploads/blog/'.$blog_data[0]->bimage)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage);	
						}
					}

					if(!empty($blog_data[0]->bimage_lft)){
						if(file_exists('./uploads/blog/'.$blog_data[0]->bimage_lft)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage_lft);	
						}
					}
					if(!empty($blog_data[0]->bimage_ryt)){
						if(file_exists('./uploads/blog/'.$blog_data[0]->bimage_ryt)){
							unlink('./uploads/blog/'.$blog_data[0]->bimage_ryt);	
						}
					}
					
					$result = $this->general_model->delete_data('blog',$id);
				}
				// $result = $this->general_model->delete_where_in_condition('blog','id',$ids,null);
				
			}elseif($type == 'blog_tags'){

				$result = $this->general_model->delete_where_in_condition('blog_tags','id',$ids,null);
				
			}elseif($type == 'vacature'){

				$result = $this->general_model->delete_where_in_condition('vacatures','id',$ids,null);
				
			}elseif($type == 'cookies'){

				$result = $this->general_model->delete_where_in_condition('cookies_document','id',$ids,null);
				
			}elseif($type == 'vat'){

				$result = $this->general_model->delete_where_in_condition('vat','id',$ids,null);
				
			}elseif($type == 'language_c'){

				$result = $this->general_model->delete_where_in_condition('language_content','id',$ids,null);
				
			}elseif($type == 'language'){

				foreach($ids as $id){

					$language_data = $this->general_model->fetch_data('languages',array('id'=>$id));
					if($language_data){
						if(!empty($language_data[0]->image)){
							if(file_exists('./uploads/languages/'.$language_data[0]->image)){
								unlink('./uploads/languages/'.$language_data[0]->image);	
							}
						}
					}
				}
				$result = $this->general_model->delete_where_in_condition('languages','id',$ids,null);
				
			}elseif($type == 'socialmedia'){

				$result = $this->general_model->delete_where_in_condition('socialmedia','id',$ids,null);
				
			}elseif($type == 'discount'){

				$result = $this->general_model->delete_where_in_condition('discountcode','id',$ids,null);
				
			}elseif($type == 'newsletter'){

				$result = $this->general_model->delete_where_in_condition('newsletter','id',$ids,null);
				
			}elseif($type == 'contact'){

				$result = $this->general_model->delete_where_in_condition('enquiry','id',$ids,null);
				
			}elseif($type == 'usp'){

				$result = $this->general_model->delete_where_in_condition('uspcontents','id',$ids,null);
				
			}elseif($type == 'sub_admin'){

				$result = $this->general_model->delete_where_in_condition('users','id',$ids,null);
				
			}elseif($type == 'orderstatus'){

				$result = $this->general_model->delete_where_in_condition('orderstatuses','id',$ids,null);
				
			}elseif($type == 'order_tracking_status'){

				$result = $this->general_model->delete_where_in_condition('order_tracking_status','id',$ids,null);
			
			}
			elseif($type == 'mail'){

				$result = $this->general_model->delete_where_in_condition('email_template','id',$ids,null);
				
			}elseif($type == 'product'){

				foreach($ids as $id){
				
					$product_data = $this->general_model->fetch_data('product',array('id'=>$id));

					if(!empty($product_data)){
						$query = $this->db->table('product_image')->where('product_id',$id);
						$product_image = $query->get()->getResult();	
							if(!empty($product_image)){
								foreach($product_image as $images){
									$pimg = $images->image;
									if(file_exists('./uploads/product/'.$pimg)){
										unlink('./uploads/product/'.$pimg);
										$this->general_model->delete_data('product_image',$images->id);
									}
								}
						}
					}
					// $result = $this->general_model->delete_where_in_condition('product','id',$ids,null);
					$result = $this->general_model->delete_data('product',$id);

					
				
				}
			}elseif($type == 'product_option'){

				foreach($ids as $id){
					$this->general_model->delete_data('product_options',$id);
					$result=$this->general_model->delete_condition('product_options_variants',array('product_options_id'=>$id));
				}
				
			}elseif($type == 'category'){

				foreach($ids as $id){
					$category_data = $this->general_model->fetch_data('category',array('id'=>$id));
					// $products      = $this->general_model->fetch_data('product', array('cat_id'=>$id));
					$product_categories      = $this->general_model->fetch_data('product_categories', array('category_id'=>$id));


					if(!empty($category_data) && isset($category_data[0]->image))
					{
						if(file_exists('./uploads/category/'.$category_data[0]->image)){

							unlink('./uploads/category/'.$category_data[0]->image);
						}
					}
					// if(!empty($products))
					// {
					// 	$query = $this->db->table('product_image')->where('product_id',$id);
					// 	$product_image = $query->get()->getResult();	
					// 		if(!empty($product_image)){
					// 			foreach($product_image as $images){
					// 				$pimg = $images->image;
					// 					unlink('./uploads/category/'.$pimg);
					// 			}
					// 	}
					// }
					// $this->general_model->delete_condition('product',array('cat_id'=>$id));
					if(!empty($product_categories))
					{
						foreach($product_categories as $cate){
							
							$this->general_model->delete_condition('product_categories',array('category_id'=>$cate->category_id));
						}
						
					}
					$result=$this->general_model->delete_data('category',$id);
				}
				
			}elseif($type == 'product_feature'){

				foreach($ids as $id){
						$this->general_model->delete_condition('product_features',array('feature_id'=>$id));
					$this->general_model->delete_condition('product_features_descriptions',array('feature_id'=>$id));
					

					$variant_ids = $this->general_model->fetch_data('product_feature_variants',array('feature_id'=>$id));

					if($variant_ids){
						$this->general_model->delete_condition('product_feature_variants',array('feature_id'=>$id));
					}
					if($variant_ids){
						foreach($variant_ids as $vids){
							$result=$this->general_model->delete_condition('product_feature_variant_descriptions',array('variant_id'=>$vids->variant_id));
						}
					}

				}
				// $this->general_model->update_data('showroomimage',$update_values,$id);	
			}elseif($type == 'showroomimage'){

				foreach($ids as $id){
					$showroomimage_data = $this->general_model->fetch_data('showroomimage',array('id'=>$id));


					if(!empty($showroomimage_data) && isset($showroomimage_data[0]->showroomimage))
					{
						if(file_exists('./uploads/showroomimage/'.$showroomimage_data[0]->showroomimage)){

							unlink('./uploads/showroomimage/'.$showroomimage_data[0]->showroomimage);
						}
					}
				
					// $this->general_model->delete_condition('product',array('cat_id'=>$id));
					
					$result=$this->general_model->delete_data('showroomimage',$id);
				}
				
			}else{
					$result = 0;
				}
			
			print_r($result);
			exit();

		}




	}