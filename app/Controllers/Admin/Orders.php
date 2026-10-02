<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;
	use App\Models\Email_model;


	use Firstred\PostNL\Entity\Label;
	use Firstred\PostNL\PostNL;
	use Firstred\PostNL\Entity\Customer;
	use Firstred\PostNL\Entity\Address;
	use Firstred\PostNL\Entity\Shipment;
	use Firstred\PostNL\Entity\Dimension;

	require_once '../vendor/autoload.php';


	class Orders extends BaseController 
	{
		public function __construct() {
			$this->Email_model = new Email_model();
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function index()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				return redirect()->to(base_url(ADMIN_URL.'/Orders/manage') );
		}

		// function manage(){

		// 	if(!isAdmin())
		// 		return redirect()->to(base_url(ADMIN_URL.'/login') );
		// 	else
		// 	$order_by='`id` DESC';
		// 	if ($this->request->isAJAX()) {
		// 		$tab = $this->request->getGet('tab');
		// 		$condition = array('id!='=>'');
		// 		$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
		// 		$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
		// 		$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

		// 		$searchCondition = array();
		// 		if (!empty($search)) {
		// 			$searchCondition = [
		// 				'id' => '%' . $search . '%',
		// 				'order_id' => '%' . $search . '%',
		// 				'voornaam' => '%' . $search . '%',
		// 				'achternaam' => '%' . $search . '%',
		// 				'bedrijfsnaam' => '%' . $search . '%',
		// 				'email' => '%' . $search . '%',
		// 				'postcode' => '%' . $search . '%',
		// 				'adres' => '%' . $search . '%',
		// 				'telefoon' => '%' . $search . '%',
		// 				// Add more fields if needed
		// 			];
				
		// 		}
		// 		$totalrecords = $this->general_model->fetch_data('orders',NULL,$order_by);

		// 		if(!empty($searchCondition)){
		// 			$orders = $this->outputData['orders'] = $this->general_model->fetch_without_limited('orders',$condition,$order_by,NULL,$searchCondition);

		// 		}else{

		// 			$orders = $this->outputData['orders'] = $this->general_model->fetch_limited('orders',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
		// 		}

		// 		$orders1 = $this->outputData['orders'] = $this->general_model->fetch_limited('orders',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				

		// 		// Add logic to fetch data based on the tab
		// 		switch ($tab) {
		// 			case 'general':
		// 				$totalrecords = $this->general_model->fetch_data('orders', NULL, $order_by);
		// 				$orders = $this->general_model->fetch_limited('orders', $condition, $limit, $offset, $order_by, NULL, $searchCondition);
		// 				break;
		// 			case 'tabItem2':
		// 				$condition = ['id !=' => '', 'shipment_infos !=' => ''];
		// 				$totalrecords = $this->general_model->fetch_data('orders', $condition, $order_by);
		// 				$orders = $this->general_model->fetch_limited('orders', $condition, $limit, $offset, $order_by, NULL, $searchCondition);
		// 				break;
		// 			case 'tabItem3':
		// 				$condition = ['id !=' => '', 'ship_method' => 5];
		// 				$totalrecords = $this->general_model->fetch_data('orders', $condition, $order_by);
		// 				$orders = $this->general_model->fetch_limited('orders', $condition, $limit, $offset, $order_by, NULL, $searchCondition);
		// 				break;
		// 			case 'tabItem4':
		// 				$condition = ['id !=' => '', 'payment_status' => 'cancel'];
		// 				$totalrecords = $this->general_model->fetch_data('orders', $condition, $order_by);
		// 				$orders = $this->general_model->fetch_limited('orders', $condition, $limit, $offset, $order_by, NULL, $searchCondition);
		// 				break;
		// 		}
				
		// 		$result = array();
		// 		// foreach ($orders1 as $data) {
		// 		foreach ($orders as $data) {
		// 			$result[] = $this->_make_row($data);
		// 		}



		// 		if (!empty($search)) {
		// 		$recordsTotal = $this->outputData['recordsTotal'] = count($orders);
		// 		$recordsFiltered = $this->outputData['recordsFiltered'] = count($orders);
		// 		}
		// 		else
		// 		{
		// 			$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
		// 			$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
		// 		}
		// 		echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
		// 		exit;
		// 	}
		// 	$this->admin_template('beheerpaneel/orders/manage',$this->outputData);
		// }

		public function manage() {
			if (!isAdmin()) {
				return redirect()->to(base_url(ADMIN_URL . '/login'));
			}
		
			$this->outputData['orderstatuses'] = $orderstatuses = $this->general_model->fetch_data('orderstatuses',null,'`id` desc');
			if ($this->request->isAJAX()) {
				$tab = $this->request->getGet('tab');
				$order_by = '`id` DESC';
				$condition = ['id !=' => ''];
				$limit = !empty($this->request->getGet('length')) ? $this->request->getGet('length') : 10;
				$offset = !empty($this->request->getGet('start')) ? $this->request->getGet('start') : 0;
				$search = !empty($this->request->getGet('search[value]')) ? $this->request->getGet('search[value]') : '';
		
				$searchCondition = [];
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'order_id' => '%' . $search . '%',
						'voornaam' => '%' . $search . '%',
						'achternaam' => '%' . $search . '%',
						'bedrijfsnaam' => '%' . $search . '%',
						'email' => '%' . $search . '%',
						'postcode' => '%' . $search . '%',
						'adres' => '%' . $search . '%',
						'telefoon' => '%' . $search . '%',
					];
				}
		
				// Configuration array for dynamic conditions
				$tabConditions = [];
				$tabConditions['all'] = ['id !='=>''];
				foreach ($orderstatuses as $ordsta) {
					$tabConditions[$ordsta->key] = ['payment_status' => $ordsta->key];
				}
		
				// Default condition
				$condition = $tabConditions[$tab] ?? $condition;
		
				$totalrecords = $this->general_model->fetch_data('orders', $condition, $order_by);
				$orders = $this->general_model->fetch_limited('orders', $condition, $limit, $offset, $order_by, NULL, $searchCondition);
		
				$result = [];
				foreach ($orders as $data) {
					$result[] = $this->_make_row($data);
				}
		
				$recordsTotal = !empty($search) ? count($orders) : count($totalrecords);
				$recordsFiltered = $recordsTotal;
		
				echo json_encode([
					"data" => $result,
					"recordsTotal" => $recordsTotal,
					"recordsFiltered" => $recordsFiltered
				]);
				exit;
			}
		
			
			$this->admin_template('beheerpaneel/orders/manage', $this->outputData);
		}

		private function _make_row($data) {

			$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
			$url = base_url(ADMIN_URL.'/orders/details/'.$data->id);
			$order_name = $data->voornaam.' '.$data->achternaam;
			$name = "<a  href='$url'>".$order_name."</a>";
			$get_status_color =getorderstatuscolor($data->payment_status);
			if(!empty($get_status_color)){
				// $color = "color:".$get_status_color;
				$color = $get_status_color;
			}else
			{
				$color = "";
			}
			// $payment_status = "<span style='$color'>" . $data->payment_status . "</span>";

			$dataorder_id = 'data-orderid="'.$data->id.'"';
			$payment_status = '<select name="order_status" class="orderstatus" '.$dataorder_id.' 
			style="border:1px solid #dbdfea;border-radius: 4px;padding: 1px;">
			<option value="0" style="background-color:#fff;color:black">Select Status</option>';
			$allpayment_status = $this->general_model->fetch_data('orderstatuses');
			foreach($allpayment_status as $pkey=>$ps)
			{
				$selected = '';
				if($ps->key == $data->payment_status)
				{
					$selected = 'selected';
				}
				$payment_status .= "<option value='$ps->id' $selected style='background-color:$ps->color;'>$ps->name</option>";

			}
			$payment_status .= '</select>';



			if(!empty($data->payment_type) && $data->payment_status != 'open')
			{
				if($data->payment_type != 'klarna' && $data->payment_type != 'klarnapaylater')
				{
					$image_src = get_payment_icon($data->payment_type);
				}
				else
				{
					$image_src = get_payment_klarnaicon($data->payment_type);
				}
				
				if(!empty($image_src))
				{
					$imgsrc = "<img src='$image_src' alt='$data->payment_type'>";
				}
				else
				{
					$url = base_url('uploads/noimage.jpg');
					$imgsrc = "<img src='$url' alt='$data->payment_type'>";
				}
					
			}else {
				$imgsrc = "-";
			}

			$date = strtotime($data->order_created);

			$order_date= date('d-m-Y H:i:s',$date);

			$total_amount = '&euro;'.' '.number_format((float)$data->total_amount,2,",","");


			$detail_url =base_url(ADMIN_URL.'/orders/details/'.$data->id);
			$edit_url =base_url(ADMIN_URL.'/orders/edit_order/'.$data->id);
			$encode_url = get_encoded_url($data->id);
			$invoice_url = base_url(ADMIN_URL.'/orders/invoice_pdf/'.$encode_url.'/download');
			$credit_url = base_url(ADMIN_URL.'/orders/credit_invoice/'.$data->id);
			$remove_url = base_url(ADMIN_URL.'/orders/delete/'.$data->id);
			$create_shipment_url = base_url(ADMIN_URL.'/orders/create_shipment/'.$encode_url);
			$create_klarna_shipment = base_url(ADMIN_URL.'/orders/create_klarna_shipment/'.$encode_url.'/download');
			$download_shipment_url = base_url(ADMIN_URL.'/orders/download_shipment_label/'.$encode_url.'/download');
			$packaging_slip_url = base_url(ADMIN_URL.'/orders/download_package_slip/'.$encode_url.'/download');
			if((!empty($data->klarna_shipment) && !empty($data->klarna_shipment_id)) && $data->create_shipment == 'Y'){
				// $klarna_tracking = base_url(ADMIN_URL.'/orders/create_klarna_shipment/'.$encode_url.'/download');
				$klarna_tracking = json_decode($data->klarna_shipment);
				$klarna_tracking = '<a href="' . $klarna_tracking->tracking_url . '" target="_blank"><em class="icon ni ni-search"></em><span>'. getlang('klarna_tracking_url') .'</span></a>';
				
			}else{
				$klarna_tracking ='';
			}


			$remove_lang = getlang('remove');
			$credit_lang = getlang('Create_credit_invoice');
			$package_lang = getlang('Download_shipping_label');
			$invoice_lang = getlang('Download_invoice');
			$edit_lang = getlang('Edit_Order');
			$detail_lang = getlang('Order_Detail');

			$packaging_slip_lang = getlang('download_packaging_slip');

			if(($data->payment_status =='paid' || $data->payment_status == 'authorized') && $data->create_shipment == 'N'){
				$shipping_label = "<li><a href='".$create_shipment_url."'><em class='icon ni ni-edit'></em><span'>".getlang('create_shipment')."</span></a></li>";

			} else if(($data->payment_status =='paid' || $data->payment_status == 'authorized') && $data->create_shipment == 'Y'){
				$shipping_label = "<li><a href='".$download_shipment_url."'><em class='icon ni ni-edit'></em><span>".$package_lang."</span></a></li>";

			} else {
				$shipping_label = "";

			}

			if(($data->payment_status =='paid' || $data->payment_status == 'authorized') && $data->create_shipment == 'Y'){
				$klarna_shipment = "<li><a href='".$create_klarna_shipment."'><em class='icon ni ni-edit'></em><span>".getlang('create_klarna_shipment')."</span></a></li>";

			} else {
				$klarna_shipment = "";

			}
 

			$last_r = "<div class='dropdown'>
							<a class='text-soft dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
							<div class='dropdown-menu dropdown-menu-end dropdown-menu'>
								<ul class='link-list-plain'>
								<li><a href='$detail_url'><em class='icon ni ni-eye'></em><span>$detail_lang</span></a></li>
								<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
								
								<li><a href='$invoice_url'><em class='icon ni ni-download'></em><span>$invoice_lang</span></a></li>
								
								".$shipping_label."	
								
								".$klarna_shipment."
								
								".$klarna_tracking."
								
								<li><a href='$packaging_slip_url'><em class='icon ni ni-edit'></em><span>$packaging_slip_lang</span></a></li>

								<li><a href='$credit_url'><em class='icon ni ni-edit'></em><span>$credit_lang</span></a></li>
								
								<li><a href='$remove_url' data-url='$remove_url' class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
								</ul>
							</div>
						</div>"; 
	 
			$row_data = array(
 				'<a href="#"><span>'.$data->id.'</span></a>',
				'<div class="tb-tnx-desc">
						<span class="title">'.$name.'<br />'.$data->email.'<br />'.$data->adres.'</span>
					</div>
					<div class="tb-tnx-date">
						<span class="date">'.$order_date.'</span>
						<span class="date">'.$imgsrc.'</span>
				</div>',
				'<div class="tb-tnx-total">
					<span class="amount">'.$total_amount.'</span>
				</div>
				<div class="tb-tnx-status">
					'.$payment_status.'
				</div>
				',
				'<div class="tb-tnx-picqer">
					<span class="">'.(!empty($data->picqer_id) ? $data->picqer_id : '-').'</span>
				</div>',
 				$last_r,
			);
		
			
			return $row_data;
		}


		function create_shipment($order_id){
			$orderid = get_decoded_url($order_id);
			$order_data = $this->general_model->fetch_data('orders',array('id'=>$orderid));	
			
			if($order_data){

				// PostNL configuration
				$post_nl_api_key = get_settings('postnl_apikey');
				$postnl_sandbox = get_settings('postnl_sandbox');
				if(!empty($post_nl_api_key) && !empty($postnl_sandbox))
				{
					foreach($order_data as $key => $od){
					
						$customer_code = strtotime($od->order_created);
						// Customer information
						$customer = Customer::create([
							'CollectionLocation' => '123456',
							'CustomerCode'       => 'FKHN',
							'CustomerNumber'     => '10527673',
							'ContactPerson'      => $od->voornaam,
							'Address'            => Address::create([
								'AddressType' => '02',
								'City'        => $od->city,
								'CompanyName' => $od->bedrijfsnaam,
								'Countrycode' => 'NL',
								'HouseNr'     => $od->hno,
								'Street'      => $od->straat,
								'Zipcode'     => $od->postcode,
							]),
							'Email'              =>  $od->email,
							'Name'               =>  $od->voornaam. ' ' . $od->achternaam,
						]);
						 
	
						
						$apikey = $post_nl_api_key;
						$sandbox = $postnl_sandbox;
				
						// Create PostNL instance
						$postnl = new PostNL($customer, $apikey, $sandbox);
	
						// Generate barcode for shipment
						$barcode = $postnl->generateBarcodeByCountryCode('NL');
	
						if($od->ship_voornaam && $od->ship_achternaam && $od->ship_bedrijfsnaam && $od->ship_postcode && $od->ship_hno && $od->ship_straat && $od->ship_plaats && $od->ship_city){
							$ship_city = $od->ship_city;
							$ship_voornaam = $od->ship_voornaam;
							$ship_achternaam = $od->ship_achternaam;
							$ship_postcode = $od->ship_postcode;
							$ship_hno = $od->ship_hno;
							$ship_straat = $od->ship_straat;
							$ship_toev = $od->ship_toev; 
	
						} else {
							$ship_city = $od->city;
							$ship_voornaam = $od->voornaam;
							$ship_achternaam = $od->achternaam;
							$ship_postcode = $od->postcode;
							$ship_hno = $od->hno;
							$ship_straat = $od->ship_straat;
							$ship_toev = $od->toev;
	
						}
				
						// Create shipment
						$shipment = Shipment::create([
							'Addresses'           => [
								Address::create([
									'AddressType' => '01',
									'City'        => $ship_city,
									'Countrycode' => 'NL',
									'FirstName'   => $ship_voornaam,
									'HouseNr'     => $ship_hno,
									'HouseNrExt'  => $ship_toev,
									'Name'        => $ship_voornaam . ' ' . $ship_achternaam,
									'Street'      => $ship_straat,
									'Zipcode'     => $ship_postcode,
								]),
							],
							'Barcode'             => $barcode,
							'Dimension'           => new Dimension('2000'),
							'ProductCodeDelivery' => '3085',
						]); 
	
						$update_order_data = array();
						$update_order_data['shipment_infos'] = serialize($shipment);
						$update_order_data['create_shipment'] = 'Y';
	
						$this->general_model->update_data('orders',$update_order_data,$orderid);
	
						$this->session->setFlashdata('Success_message',getlang('Verzending succesvol aangemaakt!! voor bestellings-ID').'-'.$orderid);
						return redirect()->to(base_url('beheerpaneel/orders/manage') );
	
	
					}
				}
				else
				{
					$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
					return redirect()->to(base_url('beheerpaneel/orders/manage') );
				} 
				
			}

			

			
		}

		function create_klarna_shipment($order_id){

			require_once '../vendor/autoload.php';
			$mollie = new \Mollie\Api\MollieApiClient();
			$apikey = get_settings('Mollie_Api_Key');
			$mollie->setApiKey($apikey);

			$orderid = get_decoded_url($order_id);
			$order_data = $this->general_model->fetch_data('orders',array('id'=>$orderid));	
			
			if($order_data){
				if(!empty($order_data)){

					foreach($order_data as $key => $value){
						if(!empty($value->order_method_id)){
							// $order = $mollie->orders->get($value->klarna_order_id);
							if(!empty($value) && $value->payment_status == 'authorized'){
								$creationDate = new \DateTime($value->klarna_order_createdat);
								$expirationDate = new \DateTime($value->klarna_order_expiredat);
							
								$interval = $expirationDate->diff($creationDate);
								if ($interval->days <= 28){
									if(!empty($value->shipment_infos)){
										$unseralize_shipment=unserialize($value->shipment_infos);
										$shipment_barcode = $unseralize_shipment->getBarcode();
										if(!empty($shipment_barcode)){
											$order_s = $mollie->orders->get($value->order_method_id);
											if(!empty($order_s)){
												$address = $unseralize_shipment->getAddresses()[0];
												$zipCode = $address->getZipcode();
												$shipment = $order_s->shipAll([
													'tracking' => [
														  'carrier' => 'PostNL',
														  'code' => $shipment_barcode,
														  'url' => 'http://postnl.nl/tracktrace/?B=' . $shipment_barcode . '&P=' . $zipCode . '&D=NL&T=C'
													],
											  ]);
											  if(!empty($shipment)){
												$order_status_save = $mollie->orders->get($value->order_method_id);
												
												  $ship_data = array(
													"order_id" => $shipment->orderId,
													"ship_id" =>$shipment->id,
													"createdAt" => $shipment->createdAt,
													"tracking_carrier" => $shipment->tracking->carrier,
													"tracking_code" => $shipment->tracking->code,
													"tracking_url" => $shipment->tracking->url,
													"order_status" => $order_status_save->status
												);
				
												$shipment_data = array(
												  "klarna_order_status" =>$order_status_save->status,
												  "payment_status" =>$order_status_save->status,
												  "klarna_shipment_id" =>$shipment->id,
												  "klarna_shipment"  => json_encode($ship_data)                 
											  );
				
											  $save_order =  $this->general_model->update_data('orders',$shipment_data,$orderid);
												
												if($save_order){
													$this->session->setFlashdata('Success_message',getlang('Verzending succesvol aangemaakt!! voor bestellings-ID').'-'.$orderid);
													return redirect()->to(base_url('beheerpaneel/orders/manage') );
												}
												else
												{
													$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
													return redirect()->to(base_url('beheerpaneel/orders/manage') );
												} 
											}

										}
										// echo "<pre>";
										// print_r($unseralize_shipment->getBarcode());
										// exit;
									}
								}

							}
						}
						else
						{
							$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
							return redirect()->to(base_url('beheerpaneel/orders/manage') );
						} 

					}
				}
			}

			}
		}
		


		function download_shipment_label($order_id){

			$orderid = get_decoded_url($order_id);
			$order_data = $this->general_model->fetch_data('orders',array('id'=>$orderid));	
			
			if($order_data){
				// PostNL configuration
				$post_nl_api_key = get_settings('postnl_apikey');
				$postnl_sandbox = get_settings('postnl_sandbox');

				if(!empty($post_nl_api_key) && !empty($postnl_sandbox))
				{

					foreach($order_data as $key => $od){


					$shipment_infos = unserialize($od->shipment_infos);
					
					$customer = Customer::create([
						'CollectionLocation' => '123456',
						'CustomerCode'       => 'FKHN',
						'CustomerNumber'     => '10527673',
						'ContactPerson'      => $od->voornaam,
						'Address'            => Address::create([
							'AddressType' => '02',
							'City'        => $od->city,
							'CompanyName' => $od->bedrijfsnaam,
							'Countrycode' => 'NL',
							'HouseNr'     => $od->hno,
							'Street'      => $od->straat,
							'Zipcode'     => $od->postcode,
						]),
						'Email'              =>  $od->email,
						'Name'               =>  $od->voornaam. ' ' . $od->achternaam,
					]);
					

					// PostNL configuration
					$apikey = $post_nl_api_key;
					$sandbox = $postnl_sandbox;
			
					// Create PostNL instance
					$postnl = new PostNL($customer, $apikey, $sandbox);

					header('Content-Type: application/pdf');
					header('Content-Disposition: attachment; filename="shipping_label_'.$od->id.'.pdf"');
					echo base64_decode($postnl->generateLabel(
						/* The actual shipment */ $shipment_infos, 
						/* The output format */ 'GraphicFile|PDF',
						/* Immediately confirm the shipment */ true
					)
						->getResponseShipments()[0]
						->getLabels()[0]
						->getContent()
					);
					exit;
					
					}
				}
				else
				{
					$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
					return redirect()->to(base_url('beheerpaneel/orders/manage') );
				} 
				
			}

		}


		function all_read()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$update_order_data = array('is_read'=>1);
			$condition = array('is_read'=>0);
			$this->general_model->update_condition('orders',$update_order_data,$condition);
			
			if(!empty($_SERVER['HTTP_REFERER']))
			{
				// $urls = str_replace(base_url(), $lang, $_SERVER['HTTP_REFERER']);
				$url = str_replace(base_url(), "", $_SERVER['HTTP_REFERER']);
				
				return redirect()->to(substr($url, 2));
				
			}
			else
			{
				return redirect()->to(base_url(ADMIN_URL.'/dashboard') );
			}
			
		}

		function updateorderstatus()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

			
			if($this->request->getPost())
			{
				
				

				$get_ord_status_data = $this->general_model->fetch_data('orderstatuses',array('id'=>$this->request->getPost('order_status')));
				if(!empty($get_ord_status_data))
				{
					$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$this->request->getPost('order_id')));

					$update_order_data = array('payment_status' =>$get_ord_status_data[0]->key);
					if($get_ord_status_data[0]->key === 'completed')
					{
						if(empty($get_ord_data[0]->feedback_invite_response)){
							$order_data = $get_ord_data[0];
							$secret_key1 = $this->general_model->fetch_row('review_accesstoken');
							if(!empty($secret_key1) && !empty($secret_key1->access_token)){
								$secret_key1 = $secret_key1->access_token;
								$full_name = "";
								if(!empty($order_data->voornaam)){
									$full_name = $order_data->voornaam;
									if(!empty($order_data->achternaam)){
										$full_name .= " ".$order_data->achternaam;
									}
								}elseif(empty($order_data->voornaam) && !empty($order_data->achternaam)){
									$full_name = $order_data->achternaam;
								}
			
								$curl = curl_init();
				
								curl_setopt_array($curl, array(
								CURLOPT_URL => 'https://feedbackcompany.com/api/v2/orders',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS =>' {
									"external_id": "'.$order_data->order_id.'", 
									"customer": { 
									"email": "'.$order_data->email.'", 
									"fullname": "'.$full_name .'" 
									},
									"invitation": {
									"delay": {
										"unit": "days",
										"amount": 0
									},
									"reminder": {
										"unit": "days",
										"amount": 7
									}
									}
								}',
								CURLOPT_HTTPHEADER => array(
									'Content-Type: application/json',
									'Authorization: Bearer '. $secret_key1 
								),
								));
				
								$response = curl_exec($curl);
				
								curl_close($curl);
					
								if(!empty($response)){
			
									$fb_response = json_decode($response);
									// echo "<pre>";print_r($order_response);exit;
									if(!empty($fb_response)){
										
										$res_serialize = serialize($fb_response);
										
										$update_datas = array(
											'feedback_invite_response' => $res_serialize
										);
										
										$this->general_model->update_data('orders',$update_datas,$order_data->id);
									}
								}
							}
						}

					}

					$this->general_model->update_data('orders',$update_order_data,$get_ord_data[0]->id);
					$email_values = array(
						"name" => $get_ord_data[0]->voornaam.'  '.$get_ord_data[0]->achternaam,
						"email" => $get_ord_data[0]->email,
						"order_id" => $get_ord_data[0]->order_id,
						"order_status" => getorderstatus($get_ord_data[0]->id),
					);
	
					$email_template = OM($get_ord_status_data[0]->key, $email_values);

					if(!empty($email_template))
					{
						if ($email_template[0]->status == '1' && !empty($this->request->getPost('notify_customer'))) {
							$this->Email_model->sendHtmlMail($get_ord_data[0]->email, $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,NULL,$email_template[0]->cc_mail);
						}
					}
					
					echo true;
	
					
				}
				

				
			}
		}

		function details($order_id){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else

			if($this->request->getPost())
			{
				

				$get_ord_status_data = $this->general_model->fetch_data('orderstatuses',array('id'=>$this->request->getPost('order_status')));
				if(!empty($get_ord_status_data))
				{
					$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$this->request->getPost('order_id')));

					$update_order_data = array('payment_status' =>$get_ord_status_data[0]->key);
					if($get_ord_status_data[0]->key === 'completed')
					{
						if(empty($get_ord_data[0]->feedback_invite_response)){
							$order_data = $get_ord_data[0];
							$secret_key1 = $this->general_model->fetch_row('boeskool_review_accesstoken');
							if(!empty($secret_key1) && !empty($secret_key1->access_token)){
								$secret_key1 = $secret_key1->access_token;
								$full_name = "";
								if(!empty($order_data->voornaam)){
									$full_name = $order_data->voornaam;
									if(!empty($order_data->achternaam)){
										$full_name .= " ".$order_data->achternaam;
									}
								}elseif(empty($order_data->voornaam) && !empty($order_data->achternaam)){
									$full_name = $order_data->achternaam;
								}
			
								$curl = curl_init();
				
								curl_setopt_array($curl, array(
								CURLOPT_URL => 'https://feedbackcompany.com/api/v2/orders',
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => '',
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 0,
								CURLOPT_FOLLOWLOCATION => true,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => 'POST',
								CURLOPT_POSTFIELDS =>' {
									"external_id": "'.$order_data->order_id.'", 
									"customer": { 
									"email": "'.$order_data->email.'", 
									"fullname": "'.$full_name .'" 
									},
									"invitation": {
									"delay": {
										"unit": "days",
										"amount": 0
									},
									"reminder": {
										"unit": "days",
										"amount": 7
									}
									}
								}',
								CURLOPT_HTTPHEADER => array(
									'Content-Type: application/json',
									'Authorization: Bearer '. $secret_key1 
								),
								));
				
								$response = curl_exec($curl);
				
								curl_close($curl);
					
								if(!empty($response)){
			
									$fb_response = json_decode($response);
									// echo "<pre>";print_r($order_response);exit;
									if(!empty($fb_response)){
										
										$res_serialize = serialize($fb_response);
										
										$update_datas = array(
											'feedback_invite_response' => $res_serialize
										);
										
										$this->general_model->update_data('orders',$update_datas,$order_data->id);
									}
								}
							}
						}

					}

					$this->general_model->update_data('orders',$update_order_data,$get_ord_data[0]->id);
					$email_values = array(
						"name" => $get_ord_data[0]->voornaam.'  '.$get_ord_data[0]->achternaam,
						"email" => $get_ord_data[0]->email,
						"order_id" => $get_ord_data[0]->order_id,
						"order_status" => getorderstatus($get_ord_data[0]->id),
					);
	
					$email_template = OM($get_ord_status_data[0]->key, $email_values);

					if(!empty($email_template))
					{
						if ($email_template[0]->status == '1' && !empty($this->request->getPost('notify_customer'))) {
							$this->Email_model->sendHtmlMail($get_ord_data[0]->email, $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,NULL,$email_template[0]->cc_mail);
						}
					}

					$this->session->setFlashdata('Success_message',getlang('Bestelstatus succesvol bijgewerkt'));
					return redirect()->to(base_url('beheerpaneel/orders/details/'.$get_ord_data[0]->id) );
	
					
				}

				
			}
			$update_values  = array('is_read'=>1);
			$this->general_model->update_data('orders',$update_values,$order_id);
			$order_by='`id` DESC';
			
			$this->outputData['order_data'] = $this->general_model->fetch_data('orders',array('id'=>$order_id));
			$this->outputData['order_statuses'] = $this->general_model->fetch_data('orderstatuses');
			$this->outputData['order_items'] = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id));
			if(empty($this->outputData['order_data']))
			{
				return redirect()->to(base_url(ADMIN_URL.'/Orders/manage') );
			}


			$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id));

			$edit_url =base_url(ADMIN_URL.'/orders/edit_order/'.$get_ord_data[0]->id);
			$encode_url = get_encoded_url($get_ord_data[0]->id);
			$invoice_url = base_url(ADMIN_URL.'/orders/invoice_pdf/'.$encode_url.'/download');
			$credit_url = base_url(ADMIN_URL.'/orders/credit_invoice/'.$get_ord_data[0]->id);
			$remove_url = base_url(ADMIN_URL.'/orders/delete/'.$get_ord_data[0]->id);
			$create_shipment_url = base_url(ADMIN_URL.'/orders/create_shipment/'.$encode_url);
			$create_klarna_shipment = base_url(ADMIN_URL.'/orders/create_klarna_shipment/'.$encode_url.'/download');
			$download_shipment_url = base_url(ADMIN_URL.'/orders/download_shipment_label/'.$encode_url.'/download');
			$packaging_slip_url = base_url(ADMIN_URL.'/orders/download_package_slip/'.$encode_url.'/download');
			if((!empty($get_ord_data[0]->klarna_shipment) && !empty($get_ord_data[0]->klarna_shipment_id)) && $get_ord_data[0]->create_shipment == 'Y'){
				// $klarna_tracking = base_url(ADMIN_URL.'/orders/create_klarna_shipment/'.$encode_url.'/download');
				$klarna_tracking = json_decode($get_ord_data[0]->klarna_shipment);
				$klarna_tracking = '<a href="' . $klarna_tracking->tracking_url . '" target="_blank"><em class="icon ni ni-search"></em><span>'. getlang('klarna_tracking_url') .'</span></a>';
				
			}else{
				$klarna_tracking ='';
			}


			$remove_lang = getlang('remove');
			$credit_lang = getlang('Create_credit_invoice');
			$package_lang = getlang('Download_shipping_label');
			$invoice_lang = getlang('Download_invoice');
			$edit_lang = getlang('Edit_Order');
			$detail_lang = getlang('Order_Detail');

			$packaging_slip_lang = getlang('download_packaging_slip');

			if(($get_ord_data[0]->payment_status =='paid' || $get_ord_data[0]->payment_status == 'authorized') && $get_ord_data[0]->create_shipment == 'N'){
				$shipping_label = "<li><a href='".$create_shipment_url."'><em class='icon ni ni-edit'></em><span'>".getlang('create_shipment')."</span></a></li>";

			} else if(($get_ord_data[0]->payment_status =='paid' || $get_ord_data[0]->payment_status == 'authorized') && $get_ord_data[0]->create_shipment == 'Y'){
				$shipping_label = "<li><a href='".$download_shipment_url."'><em class='icon ni ni-edit'></em><span>".$package_lang."</span></a></li>";

			} else {
				$shipping_label = "";

			}

			if(($get_ord_data[0]->payment_status =='paid' || $get_ord_data[0]->payment_status == 'authorized') && $get_ord_data[0]->create_shipment == 'Y'){
				$klarna_shipment = "<li><a href='".$create_klarna_shipment."'><em class='icon ni ni-edit'></em><span>".getlang('create_klarna_shipment')."</span></a></li>";

			} else {
				$klarna_shipment = "";

			}
 

			$this->outputData['order_menus'] = "<ul class='link-list-opt no-bdr'>
								<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
								<li><a href='$invoice_url'><em class='icon ni ni-download'></em><span>$invoice_lang</span></a></li>
								".$shipping_label."	
								".$klarna_shipment."
								".$klarna_tracking."
								<li><a href='$packaging_slip_url'><em class='icon ni ni-edit'></em><span>$packaging_slip_lang</span></a></li>
								<li><a href='$credit_url'><em class='icon ni ni-edit'></em><span>$credit_lang</span></a></li>
							</ul>";

			 
		
			$this->admin_template('beheerpaneel/orders/order_details_new',$this->outputData);
		}

		function delete_order_item_data()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_item_id = $this->request->getPost('id');
				$this->general_model->delete_data('order_items',$order_item_id);
				$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id)); 
				$get_all_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id)); 
				$total = 0;
				foreach($get_all_order_items as $oi){
					$price = $oi->product_price;
					$product_variants = json_decode($oi->product_variants, true);
					if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
						$price = $price + $product_variants['sizeoption_price'];
					}
					if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
						$price = $price + $product_variants['coloroption_price'];
					}
					if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
						$price = $price + $product_variants['batteryoption_price'];
					}
					$total += $price * $oi->product_qty;
				}
				if(!empty($get_ord_data) && !empty($get_ord_data[0]->ship_amount))
				{
					$total = $total + $get_ord_data[0]->ship_amount;
				}
				if(!empty($get_ord_data) && !empty($get_ord_data[0]->discount_amount))
				{
					$total = $total - $get_ord_data[0]->discount_amount;
				}

				$this->general_model->update_data('orders',array('total_amount'=>$total),$order_id);
				echo "success";
			}

		}

		public function notify_customer($order_id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if(!empty($order_id))
			{
				$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id));
				$email_values = array(
                    "name" => $get_ord_data[0]->voornaam.'  '.$get_ord_data[0]->achternaam,
                    "email" => $get_ord_data[0]->email,
                    "order_id" => $get_ord_data[0]->order_id,
                    "order_status" => getorderstatus($get_ord_data[0]->id),
                    "site_name" => get_settings('site_name'),
                );

                $fetch_order_data = $this->general_model->fetch_data('orders',array('id'=>$get_ord_data[0]->id));
                $this->outputData['order_data'] = $fetch_order_data;
                $fetch_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$fetch_order_data[0]->id));

                foreach($fetch_order_items as $ord_items)
                {
                    $get_product_data = product_data($ord_items->product_id);
                    if(!empty($get_product_data))
                    {
                        $orderqty = $ord_items->product_qty;
                        $product_stock = $get_product_data[0]->quantity;

                        
                        if($product_stock < $orderqty)
                        {
                            $qty = 0;

                        }
                        else 
                        {
                            $qty = $product_stock - $orderqty;
                        }

                        $update_order = $this->general_model->update_data('product',array('quantity'=>$qty),$get_product_data[0]->id);

                    }
                }
                $this->outputData['order_items'] = $fetch_order_items;
                // $this->frontend('view_order',$this->outputData);

                $new_user_data = array();

                $check_user_exists = $this->general_model->fetch_data('users',array('email'=>$get_ord_data[0]->email));
                if(empty($check_user_exists))
                {
                    $new_user_data = array(
                        'name'=>$get_ord_data[0]->voornaam,
                        'last_name'=>$get_ord_data[0]->achternaam,
                        'email'=>$get_ord_data[0]->email,
                        'address'=>$get_ord_data[0]->adres,
                        'user_type'=>'U',
                        'phone' => $get_ord_data[0]->telefoon,
                        'postalcode' => $get_ord_data[0]->postcode,
                        'city' => $get_ord_data[0]->city,
                        'state' => $get_ord_data[0]->plaats,
                        'country' => $get_ord_data[0]->land_ragio,
                        'password' => hash("sha512",random_text()),
                    );
                    $this->general_model->insert_data("users",$new_user_data);
                }
                

                require_once '../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();

				if($this->outputData['invoice_header']){
					$mpdf->SetHTMLHeader('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_header'][0]->value.'" />');
				}

				if($this->outputData['invoice_footer']){
					$mpdf->SetHTMLFooter('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_footer'][0]->value.'" />');
				}

				if($this->outputData['invoice_watermark']){
					$mpdf->SetWatermarkImage(
						FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_watermark'][0]->value,
						 1.0 
					);
				}
				$mpdf->showWatermarkImage = true;
				$mpdf->watermarkImgBehind = true;
				$mpdf->AddPage('','', '', '', '',10,10,60,30,0,0);  



                $html = view('frontend/userinvoice_pdf_2',$this->outputData);
                $mpdf->WriteHTML($html);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $filename = 'invoice-'.date('YmdHis');
                $mpdf->Output('./uploads/pdf/' . $filename . '.pdf', 'F');
                $pdf_file_path = $_SERVER['DOCUMENT_ROOT']."/uploads/pdf/".$filename.".pdf";
                $email_template = M('INVOICE', $email_values);

                if ($email_template[0]->status == '1') {
                    $this->Email_model->sendHtmlMail($get_ord_data[0]->email, $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,$pdf_file_path);
                    $update_order = $this->general_model->update_data('orders',array('send_mail'=>1),$get_ord_data[0]->id);
                }

                $adminemail_template = M('INVOICE_ADMIN', $email_values);
                if ($adminemail_template[0]->status == '1') {
                    $this->Email_model->sendHtmlMail($adminemail_template[0]->from_mail, $adminemail_template[0]->from_mail, $adminemail_template[0]->subject, $adminemail_template[0]->message,$pdf_file_path,$adminemail_template[0]->cc_mail);
                }
				$this->session->setFlashdata('Success_message',getlang('Bestelmelding succesvol verzonden!'));
				return redirect()->to(base_url(ADMIN_URL.'/orders/edit_order/'.$order_id));

			}	
		}

		public function notify_refundcustomer($order_id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if(!empty($order_id))
			{
				$get_refundord_data = $this->general_model->fetch_data('refundorders',array('order_id'=>$order_id));
				$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id));
				$email_values = array(
                    "name" => $get_ord_data[0]->voornaam.'  '.$get_ord_data[0]->achternaam,
                    "email" => $get_ord_data[0]->email,
                    "order_id" => $get_ord_data[0]->order_id,
                    "order_status" => getorderstatus($get_ord_data[0]->id),
                    "site_name" => get_settings('site_name'),
                );

                $fetch_order_data = $this->general_model->fetch_data('orders',array('id'=>$get_ord_data[0]->id));
                $this->outputData['order_data'] = $fetch_order_data;
                $this->outputData['refundorder_data'] = $get_refundord_data;
                $fetch_order_items = $this->general_model->fetch_data('refundorder_items',array('order_id'=>$fetch_order_data[0]->id));

                foreach($fetch_order_items as $ord_items)
                {
                    $get_product_data = product_data($ord_items->product_id);
                    if(!empty($get_product_data))
                    {
                        $orderqty = $ord_items->product_qty;
                        $product_stock = $get_product_data[0]->quantity;

                        
                        if($product_stock < $orderqty)
                        {
                            $qty = 0;

                        }
                        else 
                        {
                            $qty = $product_stock - $orderqty;
                        }

                        $update_order = $this->general_model->update_data('product',array('quantity'=>$qty),$get_product_data[0]->id);

                    }
                }
                $this->outputData['order_items'] = $fetch_order_items;
                // $this->frontend('view_order',$this->outputData);

                $new_user_data = array();

                $check_user_exists = $this->general_model->fetch_data('users',array('email'=>$get_ord_data[0]->email));
                if(empty($check_user_exists))
                {
                    $new_user_data = array(
                        'name'=>$get_ord_data[0]->voornaam,
                        'last_name'=>$get_ord_data[0]->achternaam,
                        'email'=>$get_ord_data[0]->email,
                        'address'=>$get_ord_data[0]->adres,
                        'user_type'=>'U',
                        'phone' => $get_ord_data[0]->telefoon,
                        'postalcode' => $get_ord_data[0]->postcode,
                        'city' => $get_ord_data[0]->city,
                        'state' => $get_ord_data[0]->plaats,
                        'country' => $get_ord_data[0]->land_ragio,
                        'password' => hash("sha512",random_text()),
                    );
                    $this->general_model->insert_data("users",$new_user_data);
                }
                

                require_once '../vendor/autoload.php';
                $mpdf = new \Mpdf\Mpdf();

				if($this->outputData['invoice_header']){
					$mpdf->SetHTMLHeader('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_header'][0]->value.'" />');
				}

				if($this->outputData['invoice_footer']){
					$mpdf->SetHTMLFooter('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_footer'][0]->value.'" />');
				}

				if($this->outputData['invoice_watermark']){
					$mpdf->SetWatermarkImage(
						FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_watermark'][0]->value,
						 1.0 
					);
				}
				$mpdf->showWatermarkImage = true;
				$mpdf->watermarkImgBehind = true;
				$mpdf->AddPage('','', '', '', '',10,10,60,30,0,0);  


                $html = view('frontend/refundinvoice_pdf_2',$this->outputData);
                $mpdf->WriteHTML($html);
                $this->response->setHeader('Content-Type', 'application/pdf');
                $filename = 'credit-'.date('YmdHis');
                $mpdf->Output('./uploads/pdf/' . $filename . '.pdf', 'F');
                $pdf_file_path = $_SERVER['DOCUMENT_ROOT']."/uploads/pdf/".$filename.".pdf";
                $email_template = M('REFUNDINVOICE', $email_values);

                if ($email_template[0]->status == '1') {
                    $this->Email_model->sendHtmlMail($get_ord_data[0]->email, $email_template[0]->from_mail, $email_template[0]->subject, $email_template[0]->message,$pdf_file_path);
                    $update_order = $this->general_model->update_data('orders',array('send_mail'=>1),$get_ord_data[0]->id);
                }

                $adminemail_template = M('REFUNDINVOICE_ADMIN', $email_values);
                if ($adminemail_template[0]->status == '1') {
                    $this->Email_model->sendHtmlMail($adminemail_template[0]->from_mail, $adminemail_template[0]->from_mail, $adminemail_template[0]->subject, $adminemail_template[0]->message,$pdf_file_path,$adminemail_template[0]->cc_mail);
                }
				$this->session->setFlashdata('Success_message',getlang('Kredietordermelding succesvol verzonden!'));
				return redirect()->to(base_url(ADMIN_URL.'/orders/credit_invoice/'.$order_id));

			}	
		}

		function credit_invoice($order_id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_item_id = $this->request->getPost('order_itemid');
				$qty = $this->request->getPost('quantity');
				$product_id = $this->request->getPost('product_id');
				$get_product_data = $this->general_model->fetch_data('product',array('id'=>$product_id));
				$price = $this->request->getPost('price');
				$get_orderitem_data = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id,'id'=>$order_item_id));
				$sizeoptionsraw = $this->request->getPost('size');
				$coloroptionsraw = $this->request->getPost('color');
				$batteryoptionsraw = $this->request->getPost('battery');

				if(!empty($sizeoptionsraw))
				{
					$sizeoptionsdata = explode('#',$sizeoptionsraw);
					if(!empty($sizeoptionsdata))
					{
						if(!empty($sizeoptionsdata[0]))
						{
							$sizeoption_id = $sizeoptionsdata[0];
						}
						if(!empty($sizeoptionsdata[1]))
						{
							$sizeoption_name = $sizeoptionsdata[1];
						}
						if(!empty($sizeoptionsdata[2]))
						{
							$sizeoption_price = $sizeoptionsdata[2];
						}
						if(!empty($sizeoptionsdata[3]))
						{
							$sizeoption_image = $sizeoptionsdata[3];
						}
						if(!empty($sizeoptionsdata[4]))
						{
							$sizeoptionName = $sizeoptionsdata[4];
						}
						$sizeoption_quantity = 1;
					}
					
				}
				
				if(!empty($coloroptionsraw))
				{
					$coloroptionsdata = explode('#',$coloroptionsraw);
					if(!empty($coloroptionsdata))
					{
						if(!empty($coloroptionsdata[0]))
						{
							$coloroption_id = $coloroptionsdata[0];
						}
						if(!empty($coloroptionsdata[1]))
						{
							$coloroption_name = $coloroptionsdata[1];
						}
						if(!empty($coloroptionsdata[2]))
						{
							$coloroption_price = $coloroptionsdata[2];
						}
						if(!empty($coloroptionsdata[3]))
						{
							$coloroption_image = $coloroptionsdata[3];
						}
						if(!empty($coloroptionsdata[4]))
						{
							$coloroptionName = $coloroptionsdata[4];
						}

						$coloroption_quantity = 1;
					}

				}
				if(!empty($batteryoptionsraw))
				{
					$batteryoptionsdata = explode('#',$batteryoptionsraw);
					if(!empty($batteryoptionsdata))
					{
						if(!empty($batteryoptionsdata[0]))
						{
							$batteryoption_id = $batteryoptionsdata[0];
						}
						if(!empty($batteryoptionsdata[1]))
						{
							$batteryoption_name = $batteryoptionsdata[1];
						}
						if(!empty($batteryoptionsdata[2]))
						{
							$batteryoption_price = $batteryoptionsdata[2];
						}
						if(!empty($batteryoptionsdata[3]))
						{
							$batteryoption_image = $batteryoptionsdata[3];
						}
						if(!empty($batteryoptionsdata[4]))
						{
							$batteryoptionName = $batteryoptionsdata[4];
						}
						$batteryoption_quantity = 1;
					}
				}

				$product = $this->general_model->fetch_data('product', array('id' => $product_id));
				if(!empty($product))
				{
					foreach($product as $pi)
					{
					
						$price = $pi->rprice;
						if(!empty($pi->regoffprice) && $pi->regoffprice != '0.00')
						{
							$price = $pi->regoffprice;
						}
						if(!empty($sizeoption_price))
						{
							$price = $price + $sizeoption_price;
						}
						if(!empty($coloroption_price))
						{
							$price = $price + $coloroption_price;
						}
						if(!empty($batteryoption_price))
						{
							$price = $price + $batteryoption_price;
						}

						$options=array(
							'sizeoption_id' => !empty($sizeoption_id)?$sizeoption_id:'',
							'sizeoption_name'=>!empty($sizeoption_name)?$sizeoption_name:'',
							'sizeoption_price'=>!empty($sizeoption_price)?$sizeoption_price:'',
							'sizeoption_quantity'=>!empty($sizeoption_quantity)?$sizeoption_quantity:1,
							'sizeoption_image'=>!empty($sizeoption_image)?$sizeoption_image:'',
							'sizeoptionName'=>!empty($sizeoptionName)?$sizeoptionName:'',

							'coloroption_id' => !empty($coloroption_id)?$coloroption_id:'',
							'coloroption_name'=>!empty($coloroption_name)?$coloroption_name:'',
							'coloroption_price'=>!empty($coloroption_price)?$coloroption_price:'',
							'coloroption_quantity'=>!empty($coloroption_quantity)?$coloroption_quantity:1,
							'coloroption_image'=>!empty($coloroption_image)?$coloroption_image:'',
							'coloroptionName'=>!empty($coloroptionName)?$coloroptionName:'',

							'batteryoption_id' => !empty($batteryoption_id)?$batteryoption_id:'',
							'batteryoption_name'=>!empty($batteryoption_name)?$batteryoption_name:'',
							'batteryoption_price'=>!empty($batteryoption_price)?$batteryoption_price:'',
							'batteryoption_quantity'=>!empty($batteryoption_quantity)?$batteryoption_quantity:1,
							'batteryoption_image'=>!empty($batteryoption_image)?$batteryoption_image:'',
							'batteryoptionName'=>!empty($batteryoptionName)?$batteryoptionName:'',
						);
							
					}
				}
					

				if(!empty($get_orderitem_data))
				{
					$update_order_data = array(
						'product_id'=>$product_id,
						'order_id' =>$order_id,
						'product_name'=>$get_product_data[0]->pname,
						'product_price'=>$price,
						'product_qty'=>$qty,
						'product_sku'=>$get_product_data[0]->product_sku,
						'vat'=> !empty($get_product_data[0]->vat)?$get_product_data[0]->vat:21,
						'product_variants'=>json_encode($options),
					);
					$get_refundorderitemdata = $this->general_model->fetch_data('refundorder_items',array('order_id'=>$order_id,'product_id'=>$product_id));
					if(!empty($get_refundorderitemdata))
					{
						$this->general_model->delete_data('refundorder_items',$get_refundorderitemdata[0]->id);
					}
					$this->general_model->insert_data('refundorder_items',$update_order_data);
					$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id)); 
					$get_all_order_items = $this->general_model->fetch_data('refundorder_items',array('order_id'=>$order_id)); 
					$total = 0;
					foreach($get_all_order_items as $oi){
						$price = $oi->product_price;
						$product_variants = json_decode($oi->product_variants, true);
						if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
							$price = $price + $product_variants['sizeoption_price'];
						}
						if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
							$price = $price + $product_variants['coloroption_price'];
						}
						if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
							$price = $price + $product_variants['batteryoption_price'];
						}
						$total += $price * $oi->product_qty;
					}
					// if(!empty($get_ord_data) && !empty($get_ord_data[0]->ship_amount))
					// {
					// 	$total = $total + $get_ord_data[0]->ship_amount;
					// }
					if(!empty($get_ord_data) && !empty($get_ord_data[0]->discount_amount))
					{
						$total = $total - $get_ord_data[0]->discount_amount;
					}

					$get_refundorderdata = $this->general_model->fetch_data('refundorders',array('order_id'=>$order_id));
					if(!empty($get_refundorderdata))
					{
						$this->general_model->insert_data('refundorders',array('total_amount'=>$total),$order_id);
					}
					else
					{
						$insest_data = array(
							'order_id'=>$get_ord_data[0]->id,
							'total_amount'=>$total,
							
						);
						$this->general_model->insert_data('refundorders',$insest_data);
					}
					
					$this->session->setFlashdata('Success_message',getlang('Kredietitem is bijgewerkt'));
					return redirect()->to(base_url(ADMIN_URL.'/orders/credit_invoice/'.$order_id));

				}


			}
			$this->outputData['order_data'] = $this->general_model->fetch_data('orders',array('id'=>$order_id));
			$this->outputData['refundorder_data'] = $this->general_model->fetch_data('refundorders',array('id'=>$order_id));
			$this->outputData['order_statuses'] = $this->general_model->fetch_data('orderstatuses');
			$this->outputData['order_items'] = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id));
			$this->outputData['refundorder_items'] = $this->general_model->fetch_data('refundorder_items',array('order_id'=>$order_id));
			if(empty($this->outputData['order_data']))
			{
				return redirect()->to(base_url(ADMIN_URL.'/orders/manage') );
			}

		
			$this->admin_template('beheerpaneel/orders/creditinvoice',$this->outputData);
		}

		public function refund($order_id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if(!empty($order_id))
			{
				
				$get_order_data =$this->general_model->fetch_row('orders',array('id'=>$order_id));
				$get_refund_order_data = $this->general_model->fetch_row('refundorders',array('order_id'=>$order_id));
				if(!empty($get_order_data) && !empty($get_refund_order_data))
				{
				// 	echo "yes";
				// exit;
					$payment_id = $get_order_data->payment_id;
					// $refund_amount = $get_refund_order_data->total_amount;
					$refund_amount = number_format($get_refund_order_data->total_amount, 2, '.', '');

					require_once APPPATH .'ThirdParty/pnl/vendor/autoload.php';
					$mollie = new \Mollie\Api\MollieApiClient();
					$mollie_id=get_settings('Mollie_Api_Key');
					if(!empty($mollie_id))
					{
						$mollie->setApiKey($mollie_id);

						$payment = $mollie->payments->get($payment_id);

						// Check if a refund has already been processed
						if ($payment->hasRefunds()) {
							$this->session->setFlashdata('error', getlang('Dubbele terugbetaling gedetecteerd'));
							return redirect()->to(base_url(ADMIN_URL . '/orders/credit_invoice/' . $order_id));
						}
						// Get payment details
						
						
						$refund = $payment->refund([
						"amount" => [
						   "currency" => "EUR",
						   "value" => "$refund_amount"
						]
						]);

						// // Validate and update the result in the database
						// if ($refund->status === 'pending' || $refund->status === 'processing') {
						// 	$update_data = array('error_message' => 'Refund is pending or processing', 'refund_at' => date('Y-m-d H:i:s'));
						// 	$this->general_model->update_condition('refundorders', $update_data, array('order_id' => $order_id));
						// } else
						if ($refund->status === 'failed') {
							// Handle refund failure
							$error = $refund->getRefund()->status;
							$update_data = array('error_message' => $error, 'refund_at' => date('Y-m-d H:i:s'));
							$this->general_model->update_condition('refundorders', $update_data, array('order_id' => $order_id));
							$this->session->setFlashdata('error', getlang('Gecrediteerd is mislukt'));
							return redirect()->to(base_url(ADMIN_URL . '/orders/credit_invoice/' . $order_id));
						} else {
							// Handle successful refund
							$refund_id = $refund->id;
							$update_data = array('error_message' => '', 'refund_at' => date('Y-m-d H:i:s'), 'refundid' => $refund_id, 'refund' => 1);
							$this->general_model->update_condition('refundorders', $update_data, array('order_id' => $order_id));
							$this->session->setFlashdata('Success_message', getlang('Succesvol gecrediteerd'));
							return redirect()->to(base_url(ADMIN_URL . '/orders/credit_invoice/' . $order_id));
						}
						
					} else {
						return redirect()->to(base_url(ADMIN_URL . '/orders/manage'));
					}
						
					

				}
			}
			else
			{
				return redirect()->to(base_url(ADMIN_URL.'/orders/manage') );
			}
		}

		function edit_order($order_id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_item_id = $this->request->getPost('order_itemid');
				$qty = $this->request->getPost('quantity');
				$product_id = $this->request->getPost('product_id');
				$get_product_data = $this->general_model->fetch_data('product',array('id'=>$product_id));
				$price = $this->request->getPost('price');
				$get_orderitem_data = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id,'id'=>$order_item_id));
				$sizeoptionsraw = $this->request->getPost('size');
				$coloroptionsraw = $this->request->getPost('color');
				$batteryoptionsraw = $this->request->getPost('battery');

				if(!empty($sizeoptionsraw))
				{
					$sizeoptionsdata = explode('#',$sizeoptionsraw);
					if(!empty($sizeoptionsdata))
					{
						if(!empty($sizeoptionsdata[0]))
						{
							$sizeoption_id = $sizeoptionsdata[0];
						}
						if(!empty($sizeoptionsdata[1]))
						{
							$sizeoption_name = $sizeoptionsdata[1];
						}
						if(!empty($sizeoptionsdata[2]))
						{
							$sizeoption_price = $sizeoptionsdata[2];
						}
						if(!empty($sizeoptionsdata[3]))
						{
							$sizeoption_image = $sizeoptionsdata[3];
						}
						if(!empty($sizeoptionsdata[4]))
						{
							$sizeoptionName = $sizeoptionsdata[4];
						}
						$sizeoption_quantity = 1;
					}
					
				}
				
				if(!empty($coloroptionsraw))
				{
					$coloroptionsdata = explode('#',$coloroptionsraw);
					if(!empty($coloroptionsdata))
					{
						if(!empty($coloroptionsdata[0]))
						{
							$coloroption_id = $coloroptionsdata[0];
						}
						if(!empty($coloroptionsdata[1]))
						{
							$coloroption_name = $coloroptionsdata[1];
						}
						if(!empty($coloroptionsdata[2]))
						{
							$coloroption_price = $coloroptionsdata[2];
						}
						if(!empty($coloroptionsdata[3]))
						{
							$coloroption_image = $coloroptionsdata[3];
						}
						if(!empty($coloroptionsdata[4]))
						{
							$coloroptionName = $coloroptionsdata[4];
						}

						$coloroption_quantity = 1;
					}

				}
				if(!empty($batteryoptionsraw))
				{
					$batteryoptionsdata = explode('#',$batteryoptionsraw);
					if(!empty($batteryoptionsdata))
					{
						if(!empty($batteryoptionsdata[0]))
						{
							$batteryoption_id = $batteryoptionsdata[0];
						}
						if(!empty($batteryoptionsdata[1]))
						{
							$batteryoption_name = $batteryoptionsdata[1];
						}
						if(!empty($batteryoptionsdata[2]))
						{
							$batteryoption_price = $batteryoptionsdata[2];
						}
						if(!empty($batteryoptionsdata[3]))
						{
							$batteryoption_image = $batteryoptionsdata[3];
						}
						if(!empty($batteryoptionsdata[4]))
						{
							$batteryoptionName = $batteryoptionsdata[4];
						}
						$batteryoption_quantity = 1;
					}
				}

				$product = $this->general_model->fetch_data('product', array('id' => $product_id));
				if(!empty($product))
				{
					foreach($product as $pi)
					{
					
						$price = $pi->rprice;
						if(!empty($pi->regoffprice) && $pi->regoffprice != '0.00')
						{
							$price = $pi->regoffprice;
						}
						if(!empty($sizeoption_price))
						{
							$price = $price + $sizeoption_price;
						}
						if(!empty($coloroption_price))
						{
							$price = $price + $coloroption_price;
						}
						if(!empty($batteryoption_price))
						{
							$price = $price + $batteryoption_price;
						}

						$options=array(
							'sizeoption_id' => !empty($sizeoption_id)?$sizeoption_id:'',
							'sizeoption_name'=>!empty($sizeoption_name)?$sizeoption_name:'',
							'sizeoption_price'=>!empty($sizeoption_price)?$sizeoption_price:'',
							'sizeoption_quantity'=>!empty($sizeoption_quantity)?$sizeoption_quantity:1,
							'sizeoption_image'=>!empty($sizeoption_image)?$sizeoption_image:'',
							'sizeoptionName'=>!empty($sizeoptionName)?$sizeoptionName:'',

							'coloroption_id' => !empty($coloroption_id)?$coloroption_id:'',
							'coloroption_name'=>!empty($coloroption_name)?$coloroption_name:'',
							'coloroption_price'=>!empty($coloroption_price)?$coloroption_price:'',
							'coloroption_quantity'=>!empty($coloroption_quantity)?$coloroption_quantity:1,
							'coloroption_image'=>!empty($coloroption_image)?$coloroption_image:'',
							'coloroptionName'=>!empty($coloroptionName)?$coloroptionName:'',

							'batteryoption_id' => !empty($batteryoption_id)?$batteryoption_id:'',
							'batteryoption_name'=>!empty($batteryoption_name)?$batteryoption_name:'',
							'batteryoption_price'=>!empty($batteryoption_price)?$batteryoption_price:'',
							'batteryoption_quantity'=>!empty($batteryoption_quantity)?$batteryoption_quantity:1,
							'batteryoption_image'=>!empty($batteryoption_image)?$batteryoption_image:'',
							'batteryoptionName'=>!empty($batteryoptionName)?$batteryoptionName:'',
						);
							
					}
				}
					

				if(!empty($get_orderitem_data))
				{
					$update_order_data = array(
						'product_id'=>$product_id,
						'order_id' =>$order_id,
						'product_name'=>$get_product_data[0]->pname,
						'product_price'=>$price,
						'product_qty'=>$qty,
						'product_sku'=>$get_product_data[0]->product_sku,
						'vat'=> !empty($get_product_data[0]->vat)?$get_product_data[0]->vat:21,
						'product_variants'=>json_encode($options),
					);
					$this->general_model->update_data('order_items',$update_order_data,$order_item_id);
					$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id)); 
					$get_all_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id)); 
					$total = 0;
					foreach($get_all_order_items as $oi){
						$price = $oi->product_price;
						$product_variants = json_decode($oi->product_variants, true);
						if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
							$price = $price + $product_variants['sizeoption_price'];
						}
						if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
							$price = $price + $product_variants['coloroption_price'];
						}
						if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
							$price = $price + $product_variants['batteryoption_price'];
						}
						$total += $price * $oi->product_qty;
					}
					if(!empty($get_ord_data) && !empty($get_ord_data[0]->ship_amount))
					{
						$total = $total + $get_ord_data[0]->ship_amount;
					}
					if(!empty($get_ord_data) && !empty($get_ord_data[0]->discount_amount))
					{
						$total = $total - $get_ord_data[0]->discount_amount;
					}

					$this->general_model->update_data('orders',array('total_amount'=>$total,'is_edited'=>1),$order_id);
					$this->session->setFlashdata('Success_message',getlang('Bestellingsitem succesvol bijgewerkt'));
					return redirect()->to(base_url(ADMIN_URL.'/orders/edit_order/'.$order_id));

				}


			}
			$this->outputData['order_data'] = $this->general_model->fetch_data('orders',array('id'=>$order_id));
			$this->outputData['order_statuses'] = $this->general_model->fetch_data('orderstatuses');
			$this->outputData['order_items'] = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id));
			if(empty($this->outputData['order_data']))
			{
				return redirect()->to(base_url(ADMIN_URL.'/Orders/manage') );
			}

		
			$this->admin_template('beheerpaneel/orders/edit_order',$this->outputData);
		}

		function add_orderitem($order_id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$qty = $this->request->getPost('quantity');
				$product_id = $this->request->getPost('product_id');
				$get_product_data = $this->general_model->fetch_data('product',array('id'=>$product_id));
				$price = $this->request->getPost('price');
				$sizeoptionsraw = $this->request->getPost('size');
				$coloroptionsraw = $this->request->getPost('color');
				$batteryoptionsraw = $this->request->getPost('battery');

				if(!empty($sizeoptionsraw))
				{
					$sizeoptionsdata = explode('#',$sizeoptionsraw);
					if(!empty($sizeoptionsdata))
					{
						if(!empty($sizeoptionsdata[0]))
						{
							$sizeoption_id = $sizeoptionsdata[0];
						}
						if(!empty($sizeoptionsdata[1]))
						{
							$sizeoption_name = $sizeoptionsdata[1];
						}
						if(!empty($sizeoptionsdata[2]))
						{
							$sizeoption_price = $sizeoptionsdata[2];
						}
						if(!empty($sizeoptionsdata[3]))
						{
							$sizeoption_image = $sizeoptionsdata[3];
						}
						if(!empty($sizeoptionsdata[4]))
						{
							$sizeoptionName = $sizeoptionsdata[4];
						}
						$sizeoption_quantity = 1;
					}
					
				}
				
				if(!empty($coloroptionsraw))
				{
					$coloroptionsdata = explode('#',$coloroptionsraw);
					if(!empty($coloroptionsdata))
					{
						if(!empty($coloroptionsdata[0]))
						{
							$coloroption_id = $coloroptionsdata[0];
						}
						if(!empty($coloroptionsdata[1]))
						{
							$coloroption_name = $coloroptionsdata[1];
						}
						if(!empty($coloroptionsdata[2]))
						{
							$coloroption_price = $coloroptionsdata[2];
						}
						if(!empty($coloroptionsdata[3]))
						{
							$coloroption_image = $coloroptionsdata[3];
						}
						if(!empty($coloroptionsdata[4]))
						{
							$coloroptionName = $coloroptionsdata[4];
						}

						$coloroption_quantity = 1;
					}

				}
				if(!empty($batteryoptionsraw))
				{
					$batteryoptionsdata = explode('#',$batteryoptionsraw);
					if(!empty($batteryoptionsdata))
					{
						if(!empty($batteryoptionsdata[0]))
						{
							$batteryoption_id = $batteryoptionsdata[0];
						}
						if(!empty($batteryoptionsdata[1]))
						{
							$batteryoption_name = $batteryoptionsdata[1];
						}
						if(!empty($batteryoptionsdata[2]))
						{
							$batteryoption_price = $batteryoptionsdata[2];
						}
						if(!empty($batteryoptionsdata[3]))
						{
							$batteryoption_image = $batteryoptionsdata[3];
						}
						if(!empty($batteryoptionsdata[4]))
						{
							$batteryoptionName = $batteryoptionsdata[4];
						}
						$batteryoption_quantity = 1;
					}
				}

				$product = $this->general_model->fetch_data('product', array('id' => $product_id));
				if(!empty($product))
				{
					foreach($product as $pi)
					{
					
						$price = $pi->rprice;
						if(!empty($pi->regoffprice) && $pi->regoffprice != '0.00')
						{
							$price = $pi->regoffprice;
						}
						if(!empty($sizeoption_price))
						{
							$price = $price + $sizeoption_price;
						}
						if(!empty($coloroption_price))
						{
							$price = $price + $coloroption_price;
						}
						if(!empty($batteryoption_price))
						{
							$price = $price + $batteryoption_price;
						}

						$options=array(
							'sizeoption_id' => !empty($sizeoption_id)?$sizeoption_id:'',
							'sizeoption_name'=>!empty($sizeoption_name)?$sizeoption_name:'',
							'sizeoption_price'=>!empty($sizeoption_price)?$sizeoption_price:'',
							'sizeoption_quantity'=>!empty($sizeoption_quantity)?$sizeoption_quantity:1,
							'sizeoption_image'=>!empty($sizeoption_image)?$sizeoption_image:'',
							'sizeoptionName'=>!empty($sizeoptionName)?$sizeoptionName:'',

							'coloroption_id' => !empty($coloroption_id)?$coloroption_id:'',
							'coloroption_name'=>!empty($coloroption_name)?$coloroption_name:'',
							'coloroption_price'=>!empty($coloroption_price)?$coloroption_price:'',
							'coloroption_quantity'=>!empty($coloroption_quantity)?$coloroption_quantity:1,
							'coloroption_image'=>!empty($coloroption_image)?$coloroption_image:'',
							'coloroptionName'=>!empty($coloroptionName)?$coloroptionName:'',

							'batteryoption_id' => !empty($batteryoption_id)?$batteryoption_id:'',
							'batteryoption_name'=>!empty($batteryoption_name)?$batteryoption_name:'',
							'batteryoption_price'=>!empty($batteryoption_price)?$batteryoption_price:'',
							'batteryoption_quantity'=>!empty($batteryoption_quantity)?$batteryoption_quantity:1,
							'batteryoption_image'=>!empty($batteryoption_image)?$batteryoption_image:'',
							'batteryoptionName'=>!empty($batteryoptionName)?$batteryoptionName:'',
						);
							
					}
				}
					

				if(!empty($order_id))
				{
					$update_order_data = array(
						'product_id'=>$product_id,
						'order_id' =>$order_id,
						'product_name'=>$get_product_data[0]->pname,
						'product_price'=>$price,
						'product_qty'=>$qty,
						'product_sku'=>$get_product_data[0]->product_sku,
						'vat'=> !empty($get_product_data[0]->vat)?$get_product_data[0]->vat:21,
						'product_variants'=>json_encode($options),
					);
					$this->general_model->insert_data('order_items',$update_order_data);
					$get_ord_data = $this->general_model->fetch_data('orders',array('id'=>$order_id)); 
					$get_all_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id)); 
					$total = 0;
					foreach($get_all_order_items as $oi){
						$price = $oi->product_price;
						$product_variants = json_decode($oi->product_variants, true);
						if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
							$price = $price + $product_variants['sizeoption_price'];
						}
						if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
							$price = $price + $product_variants['coloroption_price'];
						}
						if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
							$price = $price + $product_variants['batteryoption_price'];
						}
						$total += $price * $oi->product_qty;
					}
					if(!empty($get_ord_data) && !empty($get_ord_data[0]->ship_amount))
					{
						$total = $total + $get_ord_data[0]->ship_amount;
					}
					if(!empty($get_ord_data) && !empty($get_ord_data[0]->discount_amount))
					{
						$total = $total - $get_ord_data[0]->discount_amount;
					}

					$this->general_model->update_data('orders',array('total_amount'=>$total),$order_id);
					$this->session->setFlashdata('Success_message',getlang('Bestellingsitem succesvol bijgewerkt'));
					return redirect()->to(base_url(ADMIN_URL.'/orders/edit_order/'.$order_id));

				}


			}
		}

		public function get_creditorder_item_data()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_item_id = $this->request->getPost('id');
				$get_order_item_id = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id,'id'=>$order_item_id));
				if(!empty($get_order_item_id))
				{
					
					$this->outputData['general_model'] = $this->general_model;
					$this->outputData['products'] = $this->general_model->fetch_data('product', array('status'=>0, 'quantity>'=>0));
					
					$this->outputData['order_item_data'] = $get_order_item_id;
					$html = view("beheerpaneel/orders/getcreditorderitemdata",$this->outputData);
           			echo $html;
				}
				

			}
			// echo "yes";
		}

		public function get_order_item_data()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_item_id = $this->request->getPost('id');
				$get_order_item_id = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id,'id'=>$order_item_id));
				if(!empty($get_order_item_id))
				{
					
					$this->outputData['general_model'] = $this->general_model;
					$this->outputData['products'] = $this->general_model->fetch_data('product', array('status'=>0, 'quantity>'=>0));
					
					$this->outputData['order_item_data'] = $get_order_item_id;
					$html = view("beheerpaneel/orders/getorderitemdata",$this->outputData);
           			echo $html;
				}
				

			}
			// echo "yes";
		}

		public function get_neworder_item_data()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_data = $this->general_model->fetch_data('orders',array('id'=>$order_id));
				if(!empty($order_data))
				{
					$this->outputData['general_model'] = $this->general_model;
					$this->outputData['products'] = $this->general_model->fetch_data('product', array('status'=>0, 'quantity>'=>0));
					$this->outputData['order_id'] = $order_id;
					$html = view("beheerpaneel/orders/getneworderitemdata",$this->outputData);
					echo $html;
				}
			}
			// echo "yes";
		}
		public function get_client_info()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$order_id = $this->request->getPost('order_id');
				$order_data = $this->general_model->fetch_row('orders',array('id'=>$order_id));
				if(!empty($order_data))
				{
					$this->outputData['general_model'] = $this->general_model;
					$this->outputData['order_data'] = $order_data;
					$this->outputData['order_id'] = $order_id;
					$html = view("beheerpaneel/orders/get_client_info",$this->outputData);
					echo $html;
				}
			}
			// echo "yes";
		}
		public function save_client_info($order_id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost()){
				// $client_info = $this->request->getPost('client_info');
				$insert_order_data = array();
				$insert_order_data['voornaam'] = $this->request->getPost('voornaam');
				$insert_order_data['achternaam'] = $this->request->getPost('achternaam');

				$country_name = get_country_name($this->request->getPost('land_ragio'));
				$shipcountry_name = get_country_name($this->request->getPost('ship_land_ragio'));
				$insert_order_data['land_ragio'] = !empty($country_name)?$country_name:$this->request->getPost('land_ragio');
				$insert_order_data['country_code'] = !empty($this->request->getPost('land_ragio')) ? $this->request->getPost('land_ragio') : '';
				$insert_order_data['postcode'] = $this->request->getPost('postcode');
				$insert_order_data['hno'] = $this->request->getPost('hno');
				$insert_order_data['toev'] = $this->request->getPost('toev');
				$insert_order_data['straat'] = $this->request->getPost('straat');
				$insert_order_data['plaats'] = $this->request->getPost('plaats');
				$insert_order_data['city'] = $this->request->getPost('city');
				$insert_order_data['adres'] = $this->request->getPost('adres');
				$insert_order_data['diff_ship'] = !empty($this->request->getPost('diff_ship'))?$this->request->getPost('diff_ship'):0;
	
				$insert_order_data['ship_voornaam'] = !empty($this->request->getPost('ship_voornaam'))?$this->request->getPost('ship_voornaam'):'';
				$insert_order_data['ship_achternaam'] = !empty($this->request->getPost('ship_achternaam'))?$this->request->getPost('ship_achternaam'):'';
				$insert_order_data['ship_land_ragio'] = !empty($shipcountry_name)?$shipcountry_name:'';
				$insert_order_data['ship_country_code'] = !empty($this->request->getPost('ship_land_ragio')) ? $this->request->getPost('ship_land_ragio') :'';
				$insert_order_data['ship_postcode'] = !empty($this->request->getPost('ship_postcode'))?$this->request->getPost('ship_postcode'):'';
				$insert_order_data['ship_hno'] = !empty($this->request->getPost('ship_hno'))?$this->request->getPost('ship_hno'):'';
				$insert_order_data['ship_toev'] = !empty($this->request->getPost('ship_toev'))?$this->request->getPost('ship_toev'):'';
				$insert_order_data['ship_straat'] = !empty($this->request->getPost('ship_straat'))?$this->request->getPost('ship_straat'):'';
				$insert_order_data['ship_plaats'] = !empty($this->request->getPost('ship_plaats'))?$this->request->getPost('ship_plaats'):'';
				$insert_order_data['ship_city'] = !empty($this->request->getPost('ship_city'))?$this->request->getPost('ship_city'):'';
				$insert_order_data['ship_adres'] = !empty($this->request->getPost('ship_adres'))?$this->request->getPost('ship_adres'):'';
	
	
				$insert_order_data['email'] = $this->request->getPost('email');
				$insert_order_data['telefoon'] = $this->request->getPost('telefoon');


				$insert_order_id = $this->general_model->update_data('orders',$insert_order_data,$order_id);
				if(!empty($insert_order_id)){
					$this->session->setFlashdata('Success_message',getlang('Klantgegevens zijn succesvol bijgewerkt').'-'.$order_id);
						return redirect()->to(base_url('beheerpaneel/orders/edit_order/'.$order_id));

				}else{
					$this->session->setFlashdata('error',getlang('Er is iets fout gegaan!'));
					return redirect()->to(base_url('beheerpaneel/orders/edit_order/'.$order_id));
				}


			}
		}

		public function get_product_option_data()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			if($this->request->getPost())
			{
				$product_id = $this->request->getPost('product_id');
				$order_id = $this->request->getPost('order_id');
				if(!empty($this->request->getPost('order_itemid')))
				{
					$order_itemid = $this->request->getPost('order_itemid');
					$get_order_item_id = $this->general_model->fetch_data('order_items',array('order_id'=>$order_id,'id'=>$order_itemid));
					if(!empty($get_order_item_id))
					{
						$this->outputData['order_item_data'] = $get_order_item_id;
					}
				}
				$product_options = $this->general_model->fetch_data('product_options_with_product',array('product_id'=>$product_id));
				if(!empty($product_options))
				{
					$this->outputData['product_options'] = $product_options;
					$this->outputData['general_model'] = $this->general_model;
					$this->outputData['product_id'] = $product_id;
					$html = view("beheerpaneel/orders/getproductoptiondata",$this->outputData);
           			echo $html;
				}
				else
				{
					echo "";
				}
			}
		}

		/* refund invoice view and download start */
		public function refund_invoice($order_id,$mode="download")
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$order_id = get_decoded_url($order_id);
			$fetch_refundorder_data = $this->general_model->fetch_data('refundorders',array('order_id'=>$order_id));
			if(!empty($fetch_refundorder_data))
			{
				
				$this->outputData['refundorder_data'] = $fetch_refundorder_data;
				$this->outputData['order_data'] = $this->general_model->fetch_data('orders',array('id'=>$order_id));
				$refundorder_items = $this->general_model->fetch_data('refundorder_items',array('order_id'=>$fetch_refundorder_data[0]->order_id));
				$this->outputData['order_items'] = $refundorder_items;
				// $this->frontend('view_order',$this->outputData);
				require_once '../vendor/autoload.php';
				$mpdf = new \Mpdf\Mpdf();

				if($this->outputData['invoice_header']){
					$mpdf->SetHTMLHeader('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_header'][0]->value.'" />');
				}

				if($this->outputData['invoice_footer']){
					$mpdf->SetHTMLFooter('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_footer'][0]->value.'" />');
				}

				if($this->outputData['invoice_watermark']){
					$mpdf->SetWatermarkImage(
						FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_watermark'][0]->value,
						 1.0 
					);
				}
				$mpdf->showWatermarkImage = true;
				$mpdf->watermarkImgBehind = true;
				$mpdf->AddPage('','', '', '', '',10,10,60,30,0,0);  


				$html = view('frontend/refundinvoice_pdf_2',$this->outputData);
				$mpdf->WriteHTML($html);
				$this->response->setHeader('Content-Type', 'application/pdf');
				$filename = 'credit-'.date('YmdHis');
				$mpdf->Output('./uploads/pdf/' . $filename . '.pdf', 'F');
				if($mode == 'download')
				{
					$mpdf->Output($filename. '.pdf', 'D');
				}
				else
				{
					$mpdf->Output($filename. '.pdf', 'I');
				}
				
			}
			else
			{
				return redirect()->to(base_url(''));
			}
		}	
		/* refund invoice view and download end */
		
		/** open and download user invoice pdf**/
		public function invoice_pdf($order_id,$mode='download')
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$orderid = get_decoded_url($order_id);
			$fetch_order_data = $this->general_model->fetch_data('orders',array('id'=>$orderid));
			if(!empty($fetch_order_data))
			{
				
				$cart = \Config\Services::cart();
				$this->outputData['cart_contents']=$cart->contents();
				$this->outputData['cart']=$cart;
				$this->outputData['order_data'] = $fetch_order_data;
				$fetch_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$fetch_order_data[0]->id));
				$this->outputData['order_items'] = $fetch_order_items;
				// $this->frontend('view_order',$this->outputData);
				require_once '../vendor/autoload.php';
				$mpdf = new \Mpdf\Mpdf();
				 $html = view('frontend/userinvoice_pdf',$this->outputData);
 
				
				// if($this->outputData['invoice_header']){
				// 	$mpdf->SetHTMLHeader('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_header'][0]->value.'" />');
				// }

				// if($this->outputData['invoice_footer']){
				// 	$mpdf->SetHTMLFooter('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_footer'][0]->value.'" />');
				// }

				// if($this->outputData['invoice_watermark']){
				// 	$mpdf->SetWatermarkImage(
				// 		FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_watermark'][0]->value,
				// 		 1.0 
				// 	);
				// }

				
				$mpdf->showWatermarkImage = true;
				$mpdf->watermarkImgBehind = true;
				// $mpdf->AddPage('','', '', '', '',10,10,60,30,0,0); 
				$mpdf->AddPage(); 
				$mpdf->WriteHTML($html);
 

				$this->response->setHeader('Content-Type', 'application/pdf');
				$filename = 'invoice-'.date('YmdHis');
				$mpdf->Output('./uploads/pdf/' . $filename . '.pdf', 'F');
				if($mode =='download')
				{
					$mpdf->Output($filename. '.pdf', 'D');
				}
				else
				{
					$mpdf->Output($filename. '.pdf', 'I');
				}
				
			}
			else
			{
				return redirect()->to(base_url(''));
			}
	
		}
		/** open and download user invoice pdf**/



		/** open and download user invoice pdf**/
		public function download_package_slip($order_id,$mode='download')
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$orderid = get_decoded_url($order_id);
			$fetch_order_data = $this->general_model->fetch_data('orders',array('id'=>$orderid));
			if(!empty($fetch_order_data))
			{
				
				$cart = \Config\Services::cart();
				$this->outputData['cart_contents']=$cart->contents();
				$this->outputData['cart']=$cart;
				$this->outputData['order_data'] = $fetch_order_data;
				$fetch_order_items = $this->general_model->fetch_data('order_items',array('order_id'=>$fetch_order_data[0]->id));
				$this->outputData['order_items'] = $fetch_order_items;
				// $this->frontend('view_order',$this->outputData);
				require_once '../vendor/autoload.php';
				$mpdf = new \Mpdf\Mpdf();

				// if($this->outputData['invoice_header']){
				// 	$mpdf->SetHTMLHeader('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_header'][0]->value.'" />');
				// }

				// if($this->outputData['invoice_footer']){
				// 	$mpdf->SetHTMLFooter('<img src="' . FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_footer'][0]->value.'" />');
				// }

				// if($this->outputData['invoice_watermark']){
				// 	$mpdf->SetWatermarkImage(
				// 		FCPATH . 'uploads/printpapaer/'.$this->outputData['invoice_watermark'][0]->value,
				// 		 1.0 
				// 	);
				// }

				$mpdf->showWatermarkImage = false;
				$mpdf->watermarkImgBehind = false;
				$mpdf->AddPage('','', '', '', '',10,10,0,0,0,0);  

				 $html = view('frontend/packaging_slip',$this->outputData);
				
				$mpdf->WriteHTML($html);
				$this->response->setHeader('Content-Type', 'application/pdf');
				$filename = 'invoice-'.date('YmdHis');
				$mpdf->Output('./uploads/pdf/' . $filename . '.pdf', 'F');
				if($mode =='download')
				{
					$mpdf->Output($filename. '.pdf', 'I');
				}
				else
				{
					$mpdf->Output($filename. '.pdf', 'I');
				}
				
			}
			else
			{
				return redirect()->to(base_url(''));
			}
	
		}
		/** open and download user invoice pdf**/

		
		public function delete($id)
		{

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$this->general_model->delete_data('orders',$id);
			return redirect()->to(base_url(ADMIN_URL.'/orders/manage'));
		}

		 
		public function update_payment_icon_url()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			require_once '../vendor/autoload.php';
            $mollie = new \Mollie\Api\MollieApiClient();
			$mollie_id=get_settings('Mollie_Api_Key');
			$mollie->setApiKey($mollie_id);
			// Fetch available payment methods
			$paymentMethods = $mollie->methods->all();

			if(!empty($paymentMethods)){

				foreach($paymentMethods as $p)
				{
					$get_payment_type = $this->general_model->fetch_row('payment_icon_images',array('payment_type'=>$p->id));
					
					if(!empty($p->image->svg)){
						$svg = $p->image->svg;
						$image_name = substr($svg, strrpos($svg, '/') + 1);
						// echo "<pre>";print_r($image_name);exit;

						$target_path =  FCPATH .'uploads/payment_icons/';
						if (!is_dir($target_path)) {
							mkdir($target_path, 0777, true);
						}
						$saveto = $target_path . $image_name;
						// $target_path_dup =  WRITEPATH .'uploads/temp/';
						// $saveto_dup = $target_path_dup . $image_name;
					
						$ch = curl_init($svg);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
						$raw = curl_exec($ch);
						$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get the HTTP response code
						curl_close($ch);   
						if ($httpCode == 200 && !empty($raw)) { // Check if the image exists (HTTP status code 200)

							if (!file_exists($saveto)) {       
								file_put_contents($saveto, $raw); // Save the image to local server
								$prodata = array(
									'payment_type' => $p->id,
									'image_url' =>  $p->image->svg,
									'status' => 1,
									'image' => $image_name,
								);
								if(!empty($get_payment_type)){
									$this->general_model->update_data('payment_icon_images',$prodata,$get_payment_type->id);
						
								}else{

									$this->general_model->insert_data('payment_icon_images',$prodata);
								}
							}
						}
					}
				}
			}

			//klarna payment_method
			require_once '../vendor/autoload.php';
            $mollie_payment = new \Mollie\Api\MollieApiClient();
			$access_token = get_settings('klarna_access_token');
			$profile_id = get_settings('klarna_profile_id');
			$mollie_payment->setAccessToken($access_token);


			// profile ID
			$profileId = $profile_id;
			$profile = $mollie_payment->profiles->get($profileId);
			
			$response = $profile->enableMethod('klarna');
			if(!empty($response))
			{
				$get_payment_type = $this->general_model->fetch_row('payment_icon_images',array('payment_type'=>'klarna'));
				
					// $insert_data = array();
					// $insert_data['payment_type'] = 'klarna';
					// $insert_data['image_url'] = $response->image->size1x;
					if(!empty($response->image->svg)){
						$svg = $response->image->svg;
						$image_name = substr($svg, strrpos($svg, '/') + 1);
						// echo "<pre>";print_r($image_name);exit;

						$target_path =  FCPATH .'uploads/payment_icons/';
						if (!is_dir($target_path)) {
							mkdir($target_path, 0777, true);
						}
						$saveto = $target_path . $image_name;
						// $target_path_dup =  WRITEPATH .'uploads/temp/';
						// $saveto_dup = $target_path_dup . $image_name;
					
						$ch = curl_init($svg);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
						$raw = curl_exec($ch);
						$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get the HTTP response code
						curl_close($ch);   
						if ($httpCode == 200 && !empty($raw)) { // Check if the image exists (HTTP status code 200)

							if (!file_exists($saveto)) {       
								file_put_contents($saveto, $raw); // Save the image to local server
								$prodata = array(
									'payment_type' => 'klarna',
									'image_url' =>  $response->image->size1x,
									'status' => 1,
									'image' => $image_name,
								);
								if(!empty($get_payment_type)){
									$this->general_model->update_data('payment_icon_images',$prodata,$get_payment_type->id);
						
								}else{

									$this->general_model->insert_data('payment_icon_images',$prodata);
								}
							}
						}
					}
				
			}


			//klarna payment_method
			require_once '../vendor/autoload.php';
            $mollie_payment = new \Mollie\Api\MollieApiClient();
			$access_token = get_settings('klarna_access_token');
			$profile_id = get_settings('klarna_profile_id');
			$mollie_payment->setAccessToken($access_token);


			// profile ID
			$profileId = $profile_id;
			$profile = $mollie_payment->profiles->get($profileId);
			
			$response = $profile->enableMethod('klarnapaylater');
			if(!empty($response))
			{
				$get_payment_type = $this->general_model->fetch_row('payment_icon_images',array('payment_type'=>'klarnapaylater'));
				
				// 	$insert_data = array();
				// 	$insert_data['payment_type'] = 'klarnapaylater';
				// 	$insert_data['image_url'] = $response->image->size1x;
				// if(!empty($get_payment_type))
				// {
				// 	$this->general_model->update_data('payment_icon_images',$insert_data,$get_payment_type->id);
				// }
				// else
				// {
				// 	$this->general_model->insert_data('payment_icon_images',$insert_data);
				// }
				if(!empty($response->image->svg)){
					$svg = $response->image->svg;
					$image_name = substr($svg, strrpos($svg, '/') + 1);
					// echo "<pre>";print_r($image_name);exit;

					$target_path =  FCPATH .'uploads/payment_icons/';
					if (!is_dir($target_path)) {
						mkdir($target_path, 0777, true);
					}
					$saveto = $target_path . $image_name;
					// $target_path_dup =  WRITEPATH .'uploads/temp/';
					// $saveto_dup = $target_path_dup . $image_name;
				
					$ch = curl_init($svg);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
					$raw = curl_exec($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get the HTTP response code
					curl_close($ch);   
					if ($httpCode == 200 && !empty($raw)) { // Check if the image exists (HTTP status code 200)

						if (!file_exists($saveto)) {       
							file_put_contents($saveto, $raw); // Save the image to local server
							$prodata = array(
								'payment_type' => 'klarnapaylater',
								'image_url' =>  $response->image->size1x,
								'status' => 1,
								'image' => $image_name,
							);
							if(!empty($get_payment_type)){
								$this->general_model->update_data('payment_icon_images',$prodata,$get_payment_type->id);
					
							}else{

								$this->general_model->insert_data('payment_icon_images',$prodata);
							}
						}
					}
				}
				
				
			}
			
		}

		
		public function postcodecheck()
	{
		function lookupAddress($postcode, $houseNumber, $houseNumberAddition)
			{
                $key = get_settings('postcode_fetcher_key');
                $secret = get_settings('postcode_fetcher_secret');
				$serviceUrl = 'https://api.postcode.nl';
				$serviceKey = $key;
				$serviceSecret = $secret;
				$serviceShowcase = 'true';
				$serviceDebug = 'true' ;
				$extensionInfo = '';
				$extensionVersion = $extensionInfo ? (string)$extensionInfo->version : 'unknown';
				if (!$serviceUrl || !$serviceKey || !$serviceSecret)
				{
					return array('message' => ('Postcode.nl API niet geconfigureerd.'));
				}
				// Check for SSL support in CURL, if connecting to `https`
				if (substr($serviceUrl, 0, 8) == 'https://')
				{
					$curlVersion = curl_version();
					if (!($curlVersion['features'] & CURL_VERSION_SSL))
					{
						return array('message' => ('Er kon geen verbinding gemaakt worden met de nationale postcode database.'));
					}
				}
				$url = $serviceUrl . '/rest/addresses/' . urlencode($postcode). '/'. urlencode($houseNumber) . '/'. urlencode($houseNumberAddition);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, $serviceKey .':'. $serviceSecret);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				//curl_setopt($ch, CURLOPT_USERAGENT, 'PostcodeNl_Api_MagentoPlugin/' . $extensionVersion .' '. $this->_getMagentoVersion());
				$jsonResponse = curl_exec($ch);
				$curlError = curl_error($ch);
				curl_close($ch);
				$response = json_decode($jsonResponse, true);
				$sendResponse = array();
				if ($serviceShowcase)
				$sendResponse['showcaseResponse'] = $response;
				if ($serviceDebug)
				{
					$modules = array();
					$sendResponse['debugInfo'] = array(
					'requestUrl' => $url,
					'rawResponse' => $jsonResponse,
					'parsedResponse' => $response,
					'curlError' => $curlError,
					'configuration' => array(
					'url' => $serviceUrl,
					'key' => $serviceKey,
					'secret' => substr($serviceSecret, 0, 6) .'[hidden]',
					'showcase' => $serviceShowcase,
					'debug' => $serviceDebug,
					),
					);
				}
				if (is_array($response) && isset($response['exceptionId']))
				{
					switch ($response['exceptionId'])
					{
						case 'PostcodeNl_Controller_Address_InvalidPostcodeException':
						$sendResponse['message'] = ('De postcode is ongeldig. Gebruik geen spatie tussen cijfers en lettesr. Voorbeeld 1234AA.');
						$sendResponse['messageTarget'] = 'postcode';
						break;
						case 'PostcodeNl_Service_PostcodeAddress_AddressNotFoundException':
						$sendResponse['message'] = ('Ongeldige postcode en huisnummer combinatie.');
						$sendResponse['messageTarget'] = 'housenumber';
						break;
						case 'PostcodeNl_Controller_Address_InvalidHouseNumberException':
						$sendResponse['message'] = ('Het huisnummer is ongeldig.');
						$sendResponse['messageTarget'] = 'housenumber';
						break;
						default:
						$sendResponse['message'] = ('De validatie is mislukt. Gebruik handmatige input.');
						$sendResponse['messageTarget'] = 'housenumber';
						break;
					}
				}
				else if (is_array($response) && isset($response['postcode']))
				{
					$sendResponse = array_merge($sendResponse, $response);
				}
				else
				{
					$sendResponse['message'] = ('De validatie is mislukt. Gebruik handmatige input.');
					$sendResponse['messageTarget'] = 'housenumber';
				}
				//print_r(json_encode($sendResponse));
				print_r(json_encode($sendResponse['showcaseResponse']));
			}
		lookupAddress($_POST['post_code'], $_POST['home_no'],'');
	}

		


	}