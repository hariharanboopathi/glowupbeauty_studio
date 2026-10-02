<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Uspcontents extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/uspcontents/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['uspcontents'] = $this->general_model->fetch_data('uspcontents');


				$order_by  = 'id DESC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['uspcontents'] = $this->general_model->fetch_data('uspcontents',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'contents' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}
					$uspcontents = $this->outputData['uspcontents'] = $this->general_model->fetch_limited('uspcontents',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
					$result = array();
					foreach ($uspcontents as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($uspcontents);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($uspcontents);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/uspcontents/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
	
			$first_letter = getFirstLetters($data->contents,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->contents<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/uspcontents/edit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
			
			if($data->status == 0)
			{
				$status = getlang('active');
			}else
			{
				$status = getlang('inactive');
			}
			$edit_url =base_url(ADMIN_URL.'/uspcontents/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/uspcontents/delete/'.$data->id);
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
			$last_r,
			);
		
			
			return $row_data;
		}

		function add(){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getVar())){

					$insert_values = array(
						'contents' => $this->request->getVar('contents'),
                        'auser_id' => $this->session->get('admin_id'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
					);
				
					$this->general_model->insert_data('uspcontents',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol aangemaakt'));
					return redirect()->to(base_url(ADMIN_URL.'/uspcontents/manage') );
				}

				$this->admin_template('beheerpaneel/uspcontents/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

				if(!empty($this->request->getVar())){

					$update_values = array(
						'contents' => $this->request->getVar('contents'),
                        'auser_id' => $this->session->get('admin_id'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('uspcontents',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/uspcontents/manage') );
				}
				
				$this->outputData['uspcontents'] = $this->general_model->fetch_data('uspcontents',array('id'=>$id));
				$this->admin_template('beheerpaneel/uspcontents/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('uspcontents',$id);
			return redirect()->to(base_url(ADMIN_URL.'/uspcontents/manage'));
		}


	}