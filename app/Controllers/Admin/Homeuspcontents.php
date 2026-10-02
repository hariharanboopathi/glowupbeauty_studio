<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Homeuspcontents extends BaseController 
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
				return redirect()->to(base_url(ADMIN_URL.'/homeuspcontents/manage') );
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				// $this->outputData['homeuspcontents'] = $this->general_model->fetch_data('homeuspcontents');
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$totalrecords = $this->outputData['homeuspcontents'] = $this->general_model->fetch_data('homeuspcontents',NULL,$order_by);
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
					$pages = $this->outputData['homeuspcontents'] = $this->general_model->fetch_limited('homeuspcontents',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
					
					
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
			
				$this->admin_template('beheerpaneel/homeuspcontents/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/homeuspcontents/edit/'.$data->id);
			$name = "<a  href='$url'>".$data->contents."</a>";
			
			$status = $data->status;
			if($status == 0)
			{
				$status = getlang('active');
			}else
			{
				$status = getlang('inactive');
			} 

			$edit_url =base_url(ADMIN_URL.'/homeuspcontents/edit/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/homeuspcontents/delete/'.$data->id);
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
						'subcontents' => $this->request->getVar('subcontents'),
                        'auser_id' => $this->session->get('admin_id'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
					);
				
					$this->general_model->insert_data('homeuspcontents',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol aangemaakt'));
					return redirect()->to(base_url(ADMIN_URL.'/homeuspcontents/manage') );
				}

				$this->admin_template('beheerpaneel/homeuspcontents/add',$this->outputData);
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else

				if(!empty($this->request->getVar())){

					$update_values = array(
						'contents' => $this->request->getVar('contents'),
						'subcontents' => $this->request->getVar('subcontents'),
                        'auser_id' => $this->session->get('admin_id'),
						'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
						'mod_at' => date('Y-m-d H:i:s')
					);
					
				
					$this->general_model->update_data('homeuspcontents',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
					return redirect()->to(base_url(ADMIN_URL.'/homeuspcontents/manage') );
				}
				
				$this->outputData['homeuspcontents'] = $this->general_model->fetch_data('homeuspcontents',array('id'=>$id));
				$this->admin_template('beheerpaneel/homeuspcontents/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('homeuspcontents',$id);
			return redirect()->to(base_url(ADMIN_URL.'/homeuspcontents/manage'));
		}


	}