<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;
    use App\Models\Email_model;

	class Newproductrequest extends BaseController 
	{
		public function __construct() {
            $this->Email_model = new Email_model();

			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$order_by  = 'id ASC';
				if ($this->request->isAJAX()) {
					$tab = $this->request->getGet('tab');
					$totalrecords = $this->outputData['order_newproduct_requests'] = $this->general_model->fetch_data('order_newproduct_requests',NULL,$order_by);
					$condition = array('id!='=>'');
					$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
					$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
					$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

					$searchCondition = array();
					if (!empty($search)) {
						$searchCondition = [
							'id' => '%' . $search . '%',
							'name' => '%' . $search . '%',
							'email' => '%' . $search . '%',
							'order_id' => '%' . $search . '%',
							'message' => '%' . $search . '%',
							'product_name' => '%' . $search . '%',
							// Add more fields if needed
						];
					
					}

					// Add logic to fetch data based on the tab
					switch ($tab) {
						case 'general':
							$totalrecords = $this->general_model->fetch_data('order_newproduct_requests', NULL, $order_by);
							$order_newproduct_requests = $this->outputData['order_newproduct_requests']=$this->general_model->fetch_limited('order_newproduct_requests',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
							break;
						case 'completed':
							$condition = ['id !=' => '', 'completed' => 1];
							$totalrecords = $this->general_model->fetch_data('order_newproduct_requests', $condition, $order_by);
							$order_newproduct_requests = $this->outputData['order_newproduct_requests']= $this->general_model->fetch_limited('order_newproduct_requests',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
							break;
						
					}
					
					$result = array();
					foreach ($order_newproduct_requests as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($order_newproduct_requests);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($order_newproduct_requests);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/newproductrequests/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = 'javascript:void(0);';
			$name = "<a  href='$url'>".$data->name."</a>";
			
			

			$date = date('d-m-Y',strtotime($data->created_at));
			$complete_url =base_url(ADMIN_URL.'/newproductrequest/makecomplete/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/newproductrequest/delete/'.$data->id);
			$remove_lang = getlang('remove');
			$complete_lang = getlang('make_as_completed');

			if($data->completed == 0)
			{
				$complete_label = "<li><a href='$complete_url'  ><em class='icon ni ni-edit'></em><span>$complete_lang</span></a></li>";
                $status = getlang('pending');
			}
			else
			{
				$complete_label = "";
                $status = getlang('completed');
			}
			$last_r = "<ul class='nk-tb-actions gx-1'>
				<li>
					<div class='drodown'>
						<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
						<div class='dropdown-menu dropdown-menu-end'>
							<ul class='link-list-opt no-bdr'>
								".$complete_label."	
								<li><a href='$remove_url' data-url='$remove_url'class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>";
			$row_data = array(
				$first_,
			$data->id,
			$name,
			$data->email,
			$data->order_id,
			$data->product_name,
			$data->message,
			$date,
            $status,
			$last_r,
			);
		
			
			return $row_data;
		}


		function makecomplete($id)
		{
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
			if(empty($id))
			{
				return redirect()->to(base_url(ADMIN_URL.'newproductrequest/manage') );
			}
            
            $get_request_data = $this->general_model->fetch_data('order_newproduct_requests',array('id'=>$id));
            $get_order_data = $this->general_model->fetch_data('orders',array('order_id'=>$get_request_data[0]->order_id));
            $this->general_model->update_data('orders',array('payment_status' =>"complete"),$get_order_data[0]->id);
            $email_values = array(
                "name" => $get_order_data->voornaam.'  '.$get_order_data->achternaam,
                "email" => $get_order_data->email,
                "order_id" => date('Y').$get_order_data->id,
                "order_status" => getorderstatus($get_order_data->id),
                "site_name" => get_settings('site_name'),
                "message" => $message,
                'product_name' => $product_name,
            );
            $email_template = M('NEW_PRODUCT_COMPLETED', $email_values);
            if ($email_template[0]->status == '1') {
                $this->Email_model->sendHtmlMail('1@tester.ibmhub.nl', $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,null,$email_template[0]->cc_mail);
            }


			$update_data = array('completed'=>1);
			$this->general_model->update_data('order_newproduct_requests',$update_data,$id);
			$this->session->setFlashdata('Success_message',getlang('order_newproduct_request_completed_successfully!'));
			return redirect()->to(base_url(ADMIN_URL.'/newproductrequest/manage') );

		}
		

		

		function delete(){
			$session = session();
			
			$id=$this->request->uri->getSegment(4);
			$this->general_model->delete_data('order_newproduct_requests',$id);
			return redirect()->to(base_url('beheerpaneel/newproductrequest/manage'));
		}
		
	}