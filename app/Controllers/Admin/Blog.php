<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Blog extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				// $this->outputData['blog_detail'] = $this->general_model->fetch_data('blog');

				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['blog_detail'] = $this->general_model->fetch_data('blog',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'bname' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					if(!empty($searchCondition)){
						$blog_detail = $this->outputData['blog_detail'] = $this->general_model->fetch_without_limited('blog',$condition,$order_by,NULL,$searchCondition);
					}else{
						$blog_detail = $this->outputData['blog_detail'] = $this->general_model->fetch_limited('blog',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					}
						$blog_detail1 = $this->outputData['blog_detail'] = $this->general_model->fetch_limited('blog',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($blog_detail1 as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($blog_detail);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($blog_detail);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/blog/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/blog/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->bname."</a>";
			
			if(!empty($data->bimage) && file_exists(FCPATH . 'uploads/blog/' . $data->bimage))
			{
				$image_src = image_url('uploads/blog/'.$data->bimage);
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->bname' class='thumb' height='150'>";
				}
					
			}else {
				$imgsrc = "-";
			}

			$date = date('d-m-Y',strtotime($data->bdate));
			$edit_url =base_url(ADMIN_URL.'/blog/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/blog/delete/'.$data->id);
			$remove_lang = getlang('remove');
			$edit_lang = getlang('edit');
			$last_r = "<ul class='nk-tb-actions gx-1'>
				<li>
					<div class='drodown'>
						<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
						<div class='dropdown-menu dropdown-menu-end'>
							<ul class='link-list-opt no-bdr'>
								<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
								<li><a href='$remove_url'  data-url='$remove_url'class='delete-action' onclick='confirmDelete1(event ,this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
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
		public function check_blog_url($url,$bid = null)
		{
			if($bid){
				$check_data = $this->general_model->fetch_data('blog',array('burl'=>$url,'id !='=>$bid));
				
			} else {
				$check_data = $this->general_model->fetch_data('blog',array('burl'=>$url));

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

		// public function check_blog_url($url)
		// {
		// 	// $url = $this->request->getPost('page_url');
		// 	$check_data = $this->general_model->fetch_data('blog',array('burl'=>$url));
		// 	if(empty($check_data))
		// 	{
				
		// 		return false;
		// 	}
		// 	else
		// 	{
		// 		return true;

		// 	}//If end
		// }

		function add(){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if(!empty($this->request->getVar())){
					

					// Get user-entered data
					$previousInput = $this->request->getPost();

					// Store the user-entered data in session flash data
					$this->session->setFlashdata('previousInput', $previousInput);

					$file = $this->request->getFile('bimage');
					$uploadPath = 'uploads/blog'; 
					
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = '';
					}
					
					// if(!empty($file->getName()))
         			// {   
         			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/blog',$imagename);
					 	
					 	
				 	// }

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'bname' => [
							'label' => getlang("title"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'burl' => [
							'label' => getlang("news_url"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						// 'bdate' => [
						// 	'label' => getlang("date"),
						// 	'rules' => 'trim|required',
						// 	'errors' => [
						// 		'required' => '{field} '.getlang('field_is_required').'.',
						// 	],
						// ],
					]);
					 
					if (!$input) {
						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);
 
						return redirect()->to('beheerpaneel/blog/add');
						exit;
					}
					 $burl = $this->request->getVar('burl');
					 $burl = cleanStr($burl);

					// $check_url = $this->check_blog_url($this->request->getVar('burl'));
					$check_url = $this->check_blog_url($burl);
					if($check_url)
					{
						$this->session->setFlashdata('error', getlang('URL bestaat al'));
						return redirect()->to('beheerpaneel/blog/add');
						exit;
					}
					
					$file1 = $this->request->getFile('bimage_lft');
					
					$imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = '';
					}
					// if(!empty($file1->getName()))
         			// {   
         			// 	$imagename1 = $file1->getRandomName();
					//  	$file1->move('uploads/blog',$imagename1);
				 	// }

					 $file2 = $this->request->getFile('bimage_ryt');

					 $imagename2 = convert_to_webp($file2, $uploadPath);
					if ($imagename2 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename2 = '';
					}
					
					//  if(!empty($file2->getName()))
					//   {   
					// 	  $imagename2 = $file2->getRandomName();
					// 	  $file2->move('uploads/blog',$imagename2);
					//   }
					

					$insert_values = array(
						'bname' => $this->request->getVar('bname'),
						'title1' => $this->request->getVar('title1'),
						'title2' => $this->request->getVar('title2'),
						'title3' => $this->request->getVar('title3'),
						'title4' => $this->request->getVar('title4'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						'burl' => $burl,
						'bdesc' => $this->request->getVar('bdesc'),
						'bdesc1' => $this->request->getVar('bdesc1'),
						'bdesc2' => $this->request->getVar('bdesc2'),
						'bdesc3' => $this->request->getVar('bdesc3'),
						'bdesc4' => $this->request->getVar('bdesc4'),
						'bdesc5' => $this->request->getVar('bdesc5'),
						'bdesc6' => $this->request->getVar('bdesc6'),
						'bcomment' => $this->request->getVar('bcomment'),
						// 'bdate' => $this->request->getVar('bdate'),
						'auser_id' => $this->session->get('admin_id'),
						'bimage' => !empty($imagename) ? $imagename : '',
						'bimage_lft' => !empty($imagename1) ? $imagename1 : '',
						'bimage_ryt' => !empty($imagename2) ? $imagename2 : '',
					);
				
					$this->general_model->insert_data('blog',$insert_values);
					$saved_id = $this->db->insertID();
					if(!empty($saved_id)){
						$tag_id = $this->request->getVar('tags');
						if (!empty($tag_id)) {
							foreach ($tag_id as $tg_id) {
								
									$insert_tag_values = array(
										'tag_id' => $tg_id,
										'blog_id' => $saved_id
									);
									$this->general_model->insert_data('blog_tags_id', $insert_tag_values);
							}
						}
						
					}
					$this->session->setFlashdata('Success_message',"Blog is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/blog/manage') );
				}
			$this->outputData['all_tags'] = $this->general_model->fetch_data('blog_tags',array());
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
			$this->admin_template('beheerpaneel/blog/add',$this->outputData);
		}

		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$blog_data = $this->general_model->fetch_data('blog',array('id'=>$id));

				if(!empty($this->request->getVar())){

					$file = $this->request->getFile('bimage');
					$uploadPath = 'uploads/blog'; 
					
					$imagename = convert_to_webp($file, $uploadPath);
					if ($imagename === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename = $blog_data[0]->bimage;
					}
					// if(!empty($file->getName()))
	     			// {   
	     			// 	$imagename = $file->getRandomName();
					//  	$file->move('uploads/blog',$imagename);
					 	
					 	
				 	// }else{
				 	// 	$imagename = $blog_data[0]->bimage;
				 	// }

					 $file1 = $this->request->getFile('bimage_lft');

					 $imagename1 = convert_to_webp($file1, $uploadPath);
					if ($imagename1 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename1 = $blog_data[0]->bimage_lft;
					}

					//  if(!empty($file1->getName()))
	     			// {   
	     			// 	$imagename1 = $file1->getRandomName();
					//  	$file1->move('uploads/blog',$imagename1);
				 	// }else{
				 	// 	$imagename1 = $blog_data[0]->bimage_lft;
				 	// }

					 $file2 = $this->request->getFile('bimage_ryt');

					 $imagename2 = convert_to_webp($file2, $uploadPath);
					if ($imagename2 === false) {
						// Handle the error or use the existing image if no new image was uploaded
						$imagename2 = $blog_data[0]->bimage_ryt;
					}

					//  if(!empty($file2->getName()))
	     			// {   
	     			// 	$imagename2 = $file2->getRandomName();
					//  	$file2->move('uploads/blog',$imagename2);
				 	// }else{
				 	// 	$imagename2 = $blog_data[0]->bimage_ryt;
				 	// }

					 $validation = \Config\Services::validation();
					 $input = $this->validate([
						 'bname' => [
							 'label' => getlang("title"),
							 'rules' => 'trim|required',
							 'errors' => [
								 'required' => '{field} '.getlang('field_is_required').'.',
							 ],
						 ],
						 'burl' => [
							 'label' => getlang("news_url"),
							 'rules' => 'trim|required',
							 'errors' => [
								 'required' => '{field} '.getlang('field_is_required').'.',
							 ],
						 ],
						 
						//  'bdate' => [
						// 	 'label' => getlang("date"),
						// 	 'rules' => 'trim|required',
						// 	 'errors' => [
						// 		 'required' => '{field} '.getlang('field_is_required').'.',
						// 	 ],
						//  ],
					 ]);
					  
					 if (!$input) {
						 $errors = $validation->getErrors();
						 $errorString = implode('<br>', $errors);
						 $this->session->setFlashdata('error', $errorString);
  
						 return redirect()->to('beheerpaneel/blog/edit/'.$id);
						 exit;
					 }
					 $check_url = $this->check_blog_url($this->request->getVar('burl'),$id);
					 
					 if($check_url)
					 {
						 $this->session->setFlashdata('error', getlang('url bestaat'));
						 return redirect()->to('beheerpaneel/blog/edit/'.$id);
						 exit;
					 }
					  
					/* $check_url = $this->check_blog_url($this->request->getVar('burl'));
					 if($check_url)
					 {
						 $this->session->setFlashdata('error', getlang('url_already_exists'));
						 return redirect()->to('beheerpaneel/blog/edit/'.$id);
						 exit;
					 } */

					 $burl = $this->request->getVar('burl');
					 $burl = cleanStr($burl);
					

					$update_values = array(
						'bname' => $this->request->getVar('bname'),
						'title1' => $this->request->getVar('title1'),
						'title2' => $this->request->getVar('title2'),
						'title3' => $this->request->getVar('title3'),
						'title4' => $this->request->getVar('title4'),
						'meta_title' => $this->request->getVar('meta_title'),
						'meta_desc' => $this->request->getVar('meta_desc'),
						'meta_keyword' => $this->request->getVar('meta_keyword'),
						'burl' => $burl,
						'bdesc' => $this->request->getVar('bdesc'),
						'bdesc1' => $this->request->getVar('bdesc1'),
						'bdesc2' => $this->request->getVar('bdesc2'),
						'bdesc3' => $this->request->getVar('bdesc3'),
						'bdesc4' => $this->request->getVar('bdesc4'),
						'bdesc5' => $this->request->getVar('bdesc5'),
						'bdesc6' => $this->request->getVar('bdesc6'),
						'bcomment' => $this->request->getVar('bcomment'),
						// 'bdate' => $this->request->getVar('bdate'),
						'auser_id' => $this->session->get('admin_id'),
						'bimage' => $imagename,
						'bimage_lft' => $imagename1,
						'bimage_ryt' => $imagename2,
						'mod_at' => date('Y-m-d H:i:s')
					);
				
					$saveId = $this->general_model->update_data('blog',$update_values,$id);
					

					if(!empty($saveId)){
						$all_tags = $this->general_model->fetch_data('blog_tags_id',array('blog_id' => $id));
						$tag_id = $this->request->getVar('tags');
						if(!empty($all_tags)){
							$allTagIds = array_map(function($item) {
								return $item->tag_id;
							}, $all_tags);
							
							// $missingTagIds = array_diff($tag_id, $allTagIds);
							$missingTagIds = array_unique(array_merge(array_diff($tag_id, $allTagIds), array_diff($allTagIds, $tag_id)));
							// echo "<pre>";print_r($missingTagIds);exit;
							if(!empty($missingTagIds)){
								foreach($missingTagIds as  $singleTagId){
									$missing_tags = $this->general_model->fetch_data('blog_tags_id',array('tag_id' => $singleTagId));
									if(!empty($missing_tags)){
										foreach ($missing_tags as $key => $value) {
											$this->general_model->delete_data('blog_tags_id',$value->id);
										}
									}
								}
							}
						}
						if (!empty($tag_id)) {
							foreach ($tag_id as $tg_id) {
								$tagExists = false;
								if (!empty($all_tags)) {
									foreach ($all_tags as $allTags) {
										if ($allTags->tag_id == $tg_id) {
											$tagExists = true;
											break;
										}
									}
								}
								if (!$tagExists) {
									$insert_tag_values = array(
										'tag_id' => $tg_id,
										'blog_id' => $id
									);
									$this->general_model->insert_data('blog_tags_id', $insert_tag_values);
								}
							}
						}
					}
					
					$this->session->setFlashdata('Success_message',"Blog succesvol geupdatet");
					return redirect()->to(base_url('beheerpaneel/blog/manage') );
				}
				$this->outputData['blog_data'] = $this->general_model->fetch_data('blog',array('id'=>$id));
				$this->outputData['blog_tag_ids'] = $this->general_model->fetch_data('blog_tags_id',array('blog_id'=>$id));
				$this->outputData['all_tags'] = $this->general_model->fetch_data('blog_tags',array());

				$this->admin_template('beheerpaneel/blog/edit',$this->outputData);

		}

		function delete(){
			$session = session();
			
			$id=$this->request->uri->getSegment(4);
			$blog_data = $this->general_model->fetch_data('blog',array('id'=>$id));
			
			if(!empty($blog_data[0]->bimage)){
				unlink('./uploads/blog/'.$blog_data[0]->bimage);	
			}

			if(!empty($blog_data[0]->bimage_lft)){
				unlink('./uploads/blog/'.$blog_data[0]->bimage_lft);	
			}
			if(!empty($blog_data[0]->bimage_ryt)){
				unlink('./uploads/blog/'.$blog_data[0]->bimage_ryt);	
			}
			
			$this->general_model->delete_data('blog',$id);
			return redirect()->to(base_url('beheerpaneel/blog/manage'));
		}
		function tags(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				// $this->outputData['blog_detail'] = $this->general_model->fetch_data('blog');

				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['blog_detail'] = $this->general_model->fetch_data('blog_tags',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'bname' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$blog_detail = $this->outputData['blog_detail'] = $this->general_model->fetch_limited('blog_tags',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($blog_detail as $data) {
						$result[] = $this->_make_row_1($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($blog_detail);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($blog_detail);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/blog/tags_manage',$this->outputData);
		}
		private function _make_row_1($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/blog/tag_edit/'.$data->id);
			$name = "<a  href='$url'>".$data->title."</a>";
			
	

			$edit_url =base_url(ADMIN_URL.'/blog/tag_edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/blog/tag_delete/'.$data->id);
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
			// $data->id,
			$name,
			// $imgsrc,
			$last_r,
			);
		
			
			return $row_data;
		}
		public function tag_add() {
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
 
						return redirect()->to('beheerpaneel/blog/tag_add');
						exit;
					}

					// $check_url = $this->check_blog_url($burl);
					// if($check_url)
					// {
					// 	$this->session->setFlashdata('error', getlang('url_already_exists'));
					// 	return redirect()->to('beheerpaneel/blog/add');
					// 	exit;
					// }


					$insert_values = array(
						'title' => $this->request->getVar('title')
					);
				
					$this->general_model->insert_data('blog_tags',$insert_values);
					
					$this->session->setFlashdata('Success_message',"Blog tag is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/blog/tags') );
				}
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
			$this->admin_template('beheerpaneel/blog/tag_add',$this->outputData);
		}
		public function tag_edit($id) {
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if(!empty($this->request->getVar())){

					// Get user-entered data
					$previousInput = $this->request->getPost();


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
 
						return redirect()->to('beheerpaneel/blog/tag_add');
						exit;
					}

					// $check_url = $this->check_blog_url($burl);
					// if($check_url)
					// {
					// 	$this->session->setFlashdata('error', getlang('url_already_exists'));
					// 	return redirect()->to('beheerpaneel/blog/add');
					// 	exit;
					// }


					$update_values = array(
						'title' => $this->request->getVar('title')
					);
					$this->general_model->update_data('blog_tags',$update_values,$id);
				
					
					$this->session->setFlashdata('Success_message',"Blog tag is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/blog/tags') );
				}
				$this->outputData['blog_data'] = $this->general_model->fetch_data('blog_tags',array('id'=>$id));
			$this->admin_template('beheerpaneel/blog/tag_edit',$this->outputData);
		}
		function tag_delete(){
			$session = session();
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('blog_tags',$id);
			return redirect()->to(base_url('beheerpaneel/blog/tags'));
		}

	}