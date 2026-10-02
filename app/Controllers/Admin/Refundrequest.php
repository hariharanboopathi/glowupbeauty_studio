<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;
    use App\Models\Email_model;

	class Refundrequest extends BaseController 
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
					$totalrecords = $this->outputData['order_refund_requests'] = $this->general_model->fetch_data('order_refund_requests',NULL,$order_by);
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
							$totalrecords = $this->general_model->fetch_data('order_refund_requests', NULL, $order_by);
							$order_refund_requests = $this->outputData['order_refund_requests']=$this->general_model->fetch_limited('order_refund_requests',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
							break;
						case 'completed':
							$condition = ['id !=' => '', 'completed' => 1];
							$totalrecords = $this->general_model->fetch_data('order_refund_requests', $condition, $order_by);
							$order_refund_requests = $this->outputData['order_refund_requests']= $this->general_model->fetch_limited('order_refund_requests',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
							break;
						
					}
					
					$result = array();
					foreach ($order_refund_requests as $data) {
						$result[] = $this->_make_row($data);
					}
					if (!empty($search)) {
					$recordsTotal = $this->outputData['recordsTotal'] = count($order_refund_requests);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($order_refund_requests);
					}
					else
					{
						$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
						$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
					}
					echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
					exit;
				}
			
				$this->admin_template('beheerpaneel/refundrequests/manage',$this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = 'javascript:void(0);';
			$name = "<a  href='$url'>".$data->name."</a>";
			
			

			$date = date('d-m-Y',strtotime($data->created_at));
			$complete_url =base_url(ADMIN_URL.'/refundrequest/makecomplete/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/refundrequest/delete/'.$data->id);
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
                $status = getlang('refund');
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
				return redirect()->to(base_url(ADMIN_URL.'refundrequest/manage') );
			}
            $get_request_data = $this->general_model->fetch_data('order_refund_requests',array('id'=>$id));
            $get_order_data = $this->general_model->fetch_data('orders',array('order_id'=>$get_request_data[0]->order_id));


			$get_order_items_data = $this->general_model->fetch_row('order_items',array('id'=>$get_request_data[0]->order_table_id));
			// echo "<pre>";print_r($get_request_data);exit;
			$get_total_count_items = $this->general_model->fetch_data('order_items',array('order_id'=>$get_order_data[0]->id));
			$total_product= count($get_total_count_items);
			$product_not_refund=0;
			foreach($get_total_count_items as $key => $prd){
				if($prd->refund == 0){
					$product_not_refund++;
				}
			}
			$msg="";
			$payment_status="";
			if($total_product == 1){
				$msg="Refunding the order.";
				$payment_status="refund";
			}else{
				$msg ="Refunding the particular product.";
				if($product_not_refund > 1){
					$payment_status="refund/paid";
				}
				$payment_status="refund";
			}
			$trans_id = $get_order_data[0]->payment_id;
			$mollie = new \Mollie\Api\MollieApiClient();
			$mollie_id=$this->general_model->fetch_data('settings',array('code'=>'Mollie_Api_Key'));
			$mollie->setApiKey($mollie_id[0]->value);
			$total_amount = $get_order_items_data->product_price * $get_order_items_data->product_qty;
			$total_amount = number_format((float) str_replace(',', '.', $total_amount), 2, '.', '');

			// Get the order
			$payment = $mollie->payments->get($trans_id);

			// Alternative: Refund the entire order
			$refundAll = $mollie->paymentRefunds->createFor($payment, [
				"amount" => [
					"currency" => $payment->amount->currency, // Ensure correct currency
					"value" => $total_amount, // 
				],
				"description" => $msg,
			]);
			print_r($refundAll);
			echo "<br><br><br>";
			$status = $refundAll->status;
			// $settlementAmount = $refundAll->settlementAmount->value;
			echo "Refund status: " . $status."<br>";
			// echo $settlementAmount;
            $this->general_model->update_data('orders',array('payment_status' => $payment_status),$get_order_data[0]->id);
            // $email_values = array(
            //     "name" => $get_order_data[0]->voornaam.'  '.$get_order_data[0]->achternaam,
            //     "email" => $get_order_data[0]->email,
            //     "order_id" => date('Y').$get_order_data[0]->id,
            //     "order_status" => getorderstatus($get_order_data[0]->id),
            //     "site_name" => get_settings('site_name'),
            //     "message" => $message,
            //     'product_name' => $product_name,
            // );
            // $email_template = M('REFUND_COMPLETED', $email_values);
            // if ($email_template[0]->status == '1') {
                //$this->Email_model->sendHtmlMail('1@tester.ibmhub.nl', $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,null,$email_template[0]->cc_mail);
            // }

			$update_data = array('completed'=>1,'result'=>$refundAll->status,'tr_id'=>$refundAll->paymentId,'re_id'=>$refundAll->id);
			$this->general_model->update_data('order_refund_requests',$update_data,$id);
			$this->general_model->update_data('order_items',array('refund'=>1),$get_request_data[0]->order_table_id);
			$this->session->setFlashdata('Success_message',getlang('order_refund_request_completed_successfully!'));
			return redirect()->to(base_url(ADMIN_URL.'/refundrequest/manage') );
			exit;
		}
		

		

		function delete(){
			$session = session();
			
			$id=$this->request->uri->getSegment(4);
			$this->general_model->delete_data('order_refund_requests',$id);
			return redirect()->to(base_url('beheerpaneel/refundrequest/manage'));
		}
		
	}