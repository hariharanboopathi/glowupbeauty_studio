<?php 

	

	namespace App\Controllers\Beheerpaneel;

	use App\Controllers\BaseController;

	use App\Models\General_model;



	class Lander_header extends BaseController 
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

					$totalrecords = $this->outputData['lander_header_detail'] = $this->general_model->fetch_data('lander_header',NULL,$order_by);
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
					$lander_header = $this->outputData['lander_header_detail'] = $this->general_model->fetch_limited('lander_header',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($lander_header as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($lander_header);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($lander_header);
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

				$this->admin_template('beheerpaneel/lander_header/manage',$this->outputData);

		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/lander_header/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->name."</a>";

			$edit_url =base_url(ADMIN_URL.'/lander_header/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/lander_header/delete/'.$data->id);
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
			$data->url,
            $data->sort,
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

					// $file = $this->request->getFile('image');
					// $imagename = '';

					// $uploadPath = 'uploads/lander_header'; 

					// if(!empty($file->getName()))
         			// {   

         			// 	$imagename = $file->getRandomName();

					//  	$file->move('uploads/lander_header',$imagename);

				 	// }
                    // $og_imagefile = $this->request->getFile('og_image');
					// $og_image = '';

					// $uploadPath = 'uploads/lander_header'; 

					// if(!empty($og_imagefile->getName()))
         			// {   

         			// 	$og_image = $og_imagefile->getRandomName();

					//  	$og_imagefile->move('uploads/lander_header',$og_image);

				 	// }

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("title"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
                        'url' => [
							'label' => getlang("slug"),
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

						return redirect()->to(ADMIN_URL.'/lander_header/add');
						exit;
					}
					
					$insert_values = array(

						'name' => $this->request->getVar('name'),
						'sort' => $this->request->getVar('sort'),
						'url' => $this->request->getVar('url'),
					);
                    
					$this->general_model->insert_data('lander_header',$insert_values);

					$this->session->setFlashdata('Success_message',"Pagina is succesvol aangemaakt");

					return redirect()->to(base_url('beheerpaneel/lander_header/manage') );

				}

			// $this->admin_template('beheerpaneel/pages/add');
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');

			$this->admin_template('beheerpaneel/lander_header/add',$this->outputData);

		}



		function edit($id){

			if(!isAdmin())

				return redirect()->to(base_url('beheerpaneel/login') );

			else

				$lander_header_data = $this->general_model->fetch_data('lander_header',array('id'=>$id));

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
                        'url' => [
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
 
						 return redirect()->to('beheerpaneel/lander_header/edit/'.$id);
						 exit;
					 }

					$update_values = array(

						'name' => $this->request->getVar('name'),
						'sort' => $this->request->getVar('sort'),
						'url' => $this->request->getVar('url'),
					);

					$this->general_model->update_data('lander_header',$update_values,$id);

					$this->session->setFlashdata('Success_message',"Pagina succesvol bijgewerkt");

					return redirect()->to(base_url('beheerpaneel/lander_header/manage') );

				}

				$this->outputData['lander_header'] = $this->general_model->fetch_data('lander_header',array('id'=>$id));

				$this->admin_template('beheerpaneel/lander_header/edit',$this->outputData);



		}



		function delete(){

			$session = session();

			$id=$this->request->uri->getSegment(4);

			$lander_header_data = $this->general_model->fetch_data('lander_header',array('id'=>$id));

			$this->general_model->delete_data('lander_header',$id);

			return redirect()->to(base_url('beheerpaneel/lander_header/manage'));

		}


	}