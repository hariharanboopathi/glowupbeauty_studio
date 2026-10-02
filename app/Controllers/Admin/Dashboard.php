<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\Auth_model;

	class Dashboard extends BaseController 
	{
		public function __construct() 
		{
			$this->auth_model = new Auth_model();
			$this->session = \Config\Services::session();	
		}

		function index()
		{
			if(!isAdmin())
			{
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			}
			else
			{	
				$product=$this->general_model->fetch_data("product");
				$order=$this->general_model->fetch_data("orders");
				$news=$this->general_model->fetch_data("blog");
				$this->outputData['news_count']=count($news);
				$this->outputData['product_count']=count($product);
				$this->outputData['order_count']=count($order);
				$this->admin_template('beheerpaneel/dashboard',$this->outputData);
			}
		}

		function report_dashboard()
		{
			if(!isAdmin())
			{
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			}
			else
			{	
				$product=$this->general_model->fetch_data("product");
				$order=$this->general_model->fetch_data("orders");
				$news=$this->general_model->fetch_data("blog");
				$this->outputData['news_count']=count($news);
				$this->outputData['product_count']=count($product);
				$this->outputData['order_count']=count($order);
				$this->admin_template('beheerpaneel/report_dashboard',$this->outputData);
			}
		}

		function logout()
		{	
			$this->auth_model->clearAdminSession();
			$this->session->setFlashdata('Success_message', "U bent veilig uitgelogd.");
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		}



		function changepassword()
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login'));
			else
			{
				$email = $this->session->get('adminemail');
				$admin = $this->auth_model->getMemberByCondition(array('email' => $email));
				$this->outputData['adminlogin'] = '1';
				

				
				if ($this->request->getMethod() == "post") {
					

					$validation = \Config\Services::validation();
					$input = $this->validate([
						'newpassword' => [
							'label' => getlang("newpassword"),
							'rules' => 'trim|required|min_length[8]|max_length[25]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/]',
							'errors' => [
								'min_length' => 'Minimum length 8 characters',
								'regex_match' => '{field} ' . getlang('the_password_field_must_contain_at_least_one_uppercase_letter, one_lowercase_letter, one_digit, and one_special_character') . '.',
							],
						],
						'cpassword' => [
							'label' => getlang("cpassword"),
							'rules' => 'matches[newpassword]',
							'errors' => [
								'matches' => '{field} '.getlang('password_confirm_password_should_match').'.',
							],
						],
					]);

				

					if($input){

						$update_values = array();

					
						$password = hash("sha512",$this->request->getVar('newpassword'));
						$update_values['password'] = $password;	
						$this->auth_model->updateMember($update_values,array('id'=>$admin[0]->id));
						$this->session->setFlashdata('Success_message',"Wachtwoord succesvol veranderd.");
						return redirect()->to(base_url(ADMIN_URL.'/dashboard/changepassword') );

					} else {

						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/dashboard/changepassword');
						exit;
					}
				
				}
				
				$this->outputData['admin_details'] 	= $this->auth_model->getMemberByCondition(array('id' => $admin[0]->id));
				$this->admin_template('beheerpaneel/auth/changepassword',$this->outputData);


				
			}
		}



		
		function editprofile()
		{
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login'));
			else
			{
				$email = $this->session->get('adminemail');
				$admin = $this->auth_model->getMemberByCondition(array('email' => $email));
				$this->outputData['adminlogin'] = '1';
				

				
				if ($this->request->getMethod() == "post") {
					
					$validation = \Config\Services::validation();
					$input = $this->validate([
						'name' => [
							'label' => getlang("name"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'email' => [
							'label' => getlang("email"),
							'rules' => 'trim|required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'address' => [
							'label' => getlang("address"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'last_name' => [
							'label' => getlang("last_name"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'postalcode' => [
							'label' => getlang("postalcode"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'city' => [
							'label' => getlang("city"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'country' => [
							'label' => getlang("country"),
							'rules' => 'required',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
							],
						],
						'phone' => [
							'label' => getlang("phone"),
							'rules' => 'required|numeric|min_length[10]|max_length[10]',
							'errors' => [
								'required' => '{field} '.getlang('field_is_required').'.',
								'numeric' => '{field} '.getlang('should_be_numeric').'.',
								'max_length' => '{field} '.getlang('maximum_length_is_10').'.',
								'min_length' => '{field} '.getlang('minimum_length_is_10').'.',
							],
						],
					]);

				
					if($input){

						$update_values = array();

						$update_values['name'] = $this->request->getVar('name');
						$update_values['email'] = $this->request->getVar('email');
						
						$update_values['phone'] = $this->request->getVar('phone');
						$update_values['address'] = $this->request->getVar('address');
						$update_values['enable_2fa'] = !empty($this->request->getPost('enable_2fa'))?$this->request->getPost('enable_2fa'):0;
						$update_values['last_name'] = $this->request->getVar('last_name');
						$update_values['postalcode'] = $this->request->getVar('postalcode');
						$update_values['city'] = $this->request->getVar('city');
						$update_values['country'] = $this->request->getVar('country');

						
						
						$this->auth_model->updateMember($update_values,array('id'=>$admin[0]->id));
						$this->session->set('adminemail', $update_values['email']);
						$this->session->setFlashdata('Success_message',"Profiel succesvol bijgewerkt.");
						return redirect()->to(base_url(ADMIN_URL.'/dashboard/editprofile') );

					} else {

						$errors = $validation->getErrors();
						$errorString = implode('<br>', $errors);
						$this->session->setFlashdata('error', $errorString);
						return redirect()->to(ADMIN_URL.'/dashboard/editprofile');
						exit;
					}
				
				}
				
				$this->outputData['admin_details'] 	= $this->auth_model->getMemberByCondition(array('id' => $admin[0]->id));
				$this->admin_template('beheerpaneel/auth/editprofile',$this->outputData);


				
			}
		}


		

		

		function email_exist()
		{
			if($this->request->getVar())
			{
				$email   = $this->request->getVar('email');
				$exemail = $this->request->getVar('exemail');

				if(!empty($exemail) && ($exemail == $email))
				{
					echo 'true';
				}
				else
				{
					$admin = $this->auth_model->getMemberByCondition(array('email' => $email));
					echo !empty($admin) ? 'false' : 'true';
				}
			}
			else
			{
				echo 'false';
			}
		}

		function enable_options($id)
		{
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			{
				$permissions = $this->auth_model->getMemberByCondition(array('id'=>$id));

				if($this->request->getVar())
				{
					$options = $this->request->getVar('option');
					$this->auth_model->updateMember(array('enabled_options'=>!empty($options)?serialize($options):''), array('id'=>$id));
					$this->session->setFlashdata('Success_message',"Machtigingen zijn succesvol bijgewerkt.");
					return redirect()->to(base_url(ADMIN_URL.'/dashboard/manage_sub_admin'));
				}
				$this->outputData['access'] 	= !empty($permissions) && !empty($permissions[0]->enabled_options)? unserialize($permissions[0]->enabled_options) : '';
				$this->admin_template('beheerpaneel/auth/enable_options', $this->outputData);
			}
		}

		public function getPaymentDataByDateRange()
		{
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');

			if (!$start_date || !$end_date) {
				return $this->response->setJSON(['success' => false, 'message' => 'Invalid date range']);
			}

			$db = \Config\Database::connect();

			$paymentTypesData = $db->table('boeskool_orders')
				->select('payment_type') 
				->where('payment_type !=', '') 
				->groupBy('payment_type')
				->get()
				->getResultArray();

				$dateRange = [];
				$start = strtotime($start_date);
				$end = strtotime($end_date);
				
				while ($start <= $end) {
					$dateRange[] = date('Y-m-d', $start); 
					$start = strtotime("+1 day", $start);
				}

			$data = $db->table('boeskool_orders')
				->select('payment_type, order_created')
				->where('DATE(order_created) >=', $start_date)
				->where('DATE(order_created) <=', $end_date)
				->whereNotIn('payment_status', ['cancel', 'open'])
				->get()
				->getResultArray();

			$paymentData = [];
			foreach ($dateRange as $date) {
				foreach ($paymentTypesData as $type) {
					$paymentData[$date][$type['payment_type']] = [];
				}
			}
		
			
			if(empty($data)){
				$formattedData = [];
				foreach ($paymentData as $date => $paymentTypes) {
					foreach ($paymentTypes as $paymentType => $entries) {
						if (!empty($entries)) {
							$formattedData[] = [
								'payment_type' => $paymentType,
								'order_created' => $date . ' 00:00:00',
							];
						}
					}
				}
			}else{
				$formattedData = $data;
			}

			return $this->response->setJSON([
				'success' => true,
				'data' => $formattedData,
				'paymentTypesData' => $paymentTypesData,
				'startDate' => $start_date,
				'endDate' => $end_date
			]);
			
		}

		function getBestSoldProductDataByDateRange()
		{
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');

			if (!$start_date || !$end_date) {
				return $this->response->setJSON(['success' => false, 'message' => 'Invalid date range']);
			}

			$db = \Config\Database::connect();

			// boeskool_orders.order_created,boeskool_order_items.product_id

			$builder = $db->table('boeskool_orders');
			$builder->select('boeskool_product.pname AS product_name, COUNT(boeskool_order_items.product_id) AS sold_count');
			$builder->join('boeskool_order_items', 'boeskool_orders.id = boeskool_order_items.order_id');
			$builder->join('boeskool_product', 'boeskool_order_items.product_id = boeskool_product.id');
			$builder->where('DATE(boeskool_orders.order_created) >=', $start_date);
			$builder->where('DATE(boeskool_orders.order_created) <=', $end_date);
			$builder->whereNotIn('payment_status', ['cancel', 'open']);
			$builder->groupBy('boeskool_order_items.product_id');
			$builder->orderBy('sold_count', 'DESC');
			$builder->limit(10);

			$result = $builder->get()->getResultArray();

			

			if (empty($result)) {
				$result = [
					[
						'product_name' => 'No product found',
						'sold_count' => 0
					]
				];
			}
		
			return $this->response->setJSON([
				'status' => 'success',
				'message' => $result[0]['product_name'] === 'No product found' ? 'No products sold in the specified date range.' : 'Data retrieved successfully',
				'data' => $result,
			]);
		}


		function getCurrentYearDataByDateRange()
		{
			$start_date = $this->request->getPost('start_date');
			$end_date = $this->request->getPost('end_date');

			$start_date1 = $this->request->getPost('start_date1');
			$end_date1 = $this->request->getPost('end_date1');

			if (!$start_date || !$end_date) {
				return $this->response->setJSON(['success' => false, 'message' => 'Invalid date range']);
			}

			$db = \Config\Database::connect();

			$builder = $db->table('boeskool_orders');
			$builder->select('boeskool_orders.total_amount,boeskool_orders.order_created, boeskool_orders.total_amount as tot_amount,boeskool_orders.ship_amount,boeskool_order_items.vat');
			$builder->join('boeskool_order_items', 'boeskool_orders.id = boeskool_order_items.order_id');
			$builder->join('boeskool_product', 'boeskool_order_items.product_id = boeskool_product.id');
			$builder->where('DATE(boeskool_orders.order_created) >=', $start_date);
			$builder->where('DATE(boeskool_orders.order_created) <=', $end_date);
			$builder->whereNotIn('payment_status', ['cancel', 'open']);
			$builder->groupBy('boeskool_order_items.order_id');

			$result = $builder->get()->getResultArray();

			$builder1 = $db->table('boeskool_orders');
			$builder->select('boeskool_orders.total_amount,boeskool_orders.order_created, boeskool_orders.total_amount as tot_amount,boeskool_orders.ship_amount,boeskool_order_items.vat');
			$builder1->join('boeskool_order_items', 'boeskool_orders.id = boeskool_order_items.order_id');
			$builder1->join('boeskool_product', 'boeskool_order_items.product_id = boeskool_product.id');
			$builder1->where('DATE(boeskool_orders.order_created) >=', $start_date1);
			$builder1->where('DATE(boeskool_orders.order_created) <=', $end_date1);
			$builder1->whereNotIn('payment_status', ['cancel', 'open']);
			$builder1->groupBy('boeskool_order_items.order_id');

			$result1 = $builder1->get()->getResultArray();

			if (empty($result) && empty($result1)) {
				return $this->response->setJSON([
					'status' => 'success',
					'data' => [
						'newData' => [],
						'oldData' => [],
						'total_amount_new' => [],
						'total_amount_old' => [],
						'new_shipping_amount' => [],
						'old_shipping_amount' => [],
						'new_vat_amount' => 0,
						'old_vat_amount' => 0,
						'result' => [],
						'result1' => [],
						'groupedData' => [],
						'groupedData2' => []
					]
				]);
			}

			// print_r($result);
			// print_r($result1);
			// print_r(array_column($result, 'total_amount'));
			// print_r(array_column($result1, 'total_amount'));
			// print_r(array_column($result, 'vat'));
			// print_r(array_column($result1, 'vat'));
			// exit;

			$groupedData = [];

			foreach ($result as $order) {
				$orderDate = substr($order['order_created'], 0, 10);

				if (!isset($groupedData[$orderDate])) {
					$groupedData[$orderDate] = [
						'total_amount' => 0,
						'ship_amount' => 0,
						'vat' => 0,
						'orders' => 0,
						'order_created' => $orderDate,
						'returns' => 0,
						'total_gross' => 0 
					];
				}

				$groupedData[$orderDate]['total_amount'] += $order['total_amount'];
				$groupedData[$orderDate]['ship_amount'] += $order['ship_amount'];
				
				// Calculate VAT
				$vat_rate = !empty($order['vat']) ? $order['vat'] : 21;
				$vamount = calculateVat($order['total_amount'], $vat_rate);
				$groupedData[$orderDate]['vat'] += $vamount['vatAmount'];
				
				$groupedData[$orderDate]['orders'] += 1;
				$groupedData[$orderDate]['total_gross'] += ($order['total_amount']);

			}

			$groupedData2 = [];

			if(!empty($result1)){
				foreach ($result1 as $order) {
					$orderDate2 = substr($order['order_created'], 0, 10);
	
					if (!isset($groupedData2[$orderDate2])) {
						$groupedData2[$orderDate2] = [
							'total_amount' => 0,
							'ship_amount' => 0,
							'vat' => 0,
							'orders' => 0,
							'order_created' => $orderDate2,
							'returns' => 0,
							'total_gross' => 0 
						];
					}
	
					$groupedData2[$orderDate2]['total_amount'] += $order['total_amount'];
					$groupedData2[$orderDate2]['ship_amount'] += $order['ship_amount'];
					
					// Calculate VAT
					$vat_rate = !empty($order['vat']) ? $order['vat'] : 21;
					$vamount = calculateVat($order['total_amount'], $vat_rate);
					$groupedData2[$orderDate2]['vat'] += $vamount['vatAmount'];
					
					$groupedData2[$orderDate2]['orders'] += 1;
					$groupedData2[$orderDate2]['total_gross'] += ($order['total_amount']);
	
				}
			}

			

			$new_vat_amt = 0;
			if(!empty($result)){
				foreach($result as $results){
					$vat_rate = !empty($results['vat'])?$results['vat']:21;
					$vamount =  calculateVat($results['total_amount'],$vat_rate);
					$new_vat_amt += $vamount['vatAmount'];
				}
			}

			$old_vat_amt = 0;
			if(!empty($result1)){
				foreach($result1 as $results){
					$vat_rate = !empty($results['vat'])?$results['vat']:21;
					$vamount =  calculateVat($results['total_amount'],$vat_rate);
					$old_vat_amt += $vamount['vatAmount'];
				}
			}

			$new_vat_amt1 = [];
			if(!empty($result)){
				foreach($result as $results){
					$vat_rate = !empty($results['vat'])?$results['vat']:21;
					$vamount =  calculateVat($results['total_amount'],$vat_rate);
					$new_vat_amt1[] = $vamount['vatAmount'];
				}
			}

			$old_vat_amt1 = [];
			if(!empty($result1)){
				foreach($result1 as $results){
					$vat_rate = !empty($results['vat'])?$results['vat']:21;
					$vamount =  calculateVat($results['total_amount'],$vat_rate);
					$old_vat_amt1[] = $vamount['vatAmount'];
				}
			}






			if (empty($result)) {
				$result = [
					[
						'total_amount' => 0,
					]
				];
			}

			
		
			return $this->response->setJSON([
				'status' => 'success',
				'data' => [
					'newData' => array_column($result, 'total_amount'),
					'oldData' => array_column($result1, 'total_amount'),
					'total_amount_new' => array_column($result, 'total_amount'),
					'total_amount_old' => array_column($result1, 'total_amount'),
					'new_shipping_amount' => array_column($result, 'ship_amount'),
					'old_shipping_amount' => array_column($result1, 'ship_amount'),
					'new_vat_amount' => $new_vat_amt,
					'old_vat_amount' => $old_vat_amt,
					'new_vat_amount1' => $new_vat_amt1,
					'old_vat_amount1' => $old_vat_amt1,
					'result' => $result,
					'result1' => $result1,
					'groupedData' => $groupedData,
					'groupedData2' => $groupedData2
				]
			]);
		}

		function getPaymentDataByDateRange1()
		{
			$start_date = date('Y-m-01');
			$end_date = date('Y-m-d');

			

			$db = \Config\Database::connect();

			$paymentTypesData = $db->table('boeskool_orders')
				->select('payment_type') 
				->where('payment_type !=', '') 
				->groupBy('payment_type')
				->get()
				->getResultArray();

				$dateRange = [];
				$start = strtotime($start_date);
				$end = strtotime($end_date);
				
				while ($start <= $end) {
					$dateRange[] = date('Y-m-d', $start); 
					$start = strtotime("+1 day", $start);
				}

			$data = $db->table('boeskool_orders')
				->select('payment_type, order_created')
				->where('DATE(order_created) >=', $start_date)
				->where('DATE(order_created) <=', $end_date)
				->whereNotIn('payment_status', ['cancel', 'open'])
				->get()
				->getResultArray();

			$paymentData = [];
			foreach ($dateRange as $date) {
				foreach ($paymentTypesData as $type) {
					$paymentData[$date][$type['payment_type']] = [];
				}
			}
		
			
			if(empty($data)){
			
				$formattedData = [];
				foreach ($paymentData as $date => $paymentTypes) {
					
					foreach ($paymentTypes as $paymentType => $entries) {
						print_r($paymentType);
						print_r($entries);
			exit;
						if (!empty($entries)) {
							
							
							$formattedData[] = [
								'payment_type' => $paymentType,
								'order_created' => $date . ' 00:00:00',
							];
						}
					}
				}
			}else{
				$formattedData = $data;
			}

			
			

				$result_order = [
					[
						'success' => true,
						'data' => $formattedData,
						'paymentTypesData' => $paymentTypesData,
						'startDate' => $start_date,
						'endDate' => $end_date
					]
				];
		
			return json_encode($result_order);
			
		}

		
	public function downloadCsv()
{
    $start_date = $this->request->getPost('start_date');
    $end_date = $this->request->getPost('end_date');

    $start_date1 = $this->request->getPost('start_date1');
    $end_date1 = $this->request->getPost('end_date1');

    if (!$start_date || !$end_date) {
        return $this->response->setJSON(['success' => false, 'message' => 'Invalid date range']);
    }

    $db = \Config\Database::connect();

    // First query
    $builder = $db->table('boeskool_orders');
    $builder->select('boeskool_orders.total_amount, boeskool_orders.order_created, boeskool_orders.ship_amount, boeskool_order_items.vat');
    $builder->join('boeskool_order_items', 'boeskool_orders.id = boeskool_order_items.order_id');
    $builder->where('DATE(boeskool_orders.order_created) >=', $start_date);
    $builder->where('DATE(boeskool_orders.order_created) <=', $end_date);
	$builder->whereNotIn('payment_status', ['cancel', 'open']);
    $builder->groupBy('boeskool_order_items.order_id');
    $result = $builder->get()->getResultArray();

    // Second query
    $builder1 = $db->table('boeskool_orders');
    $builder1->select('boeskool_orders.total_amount, boeskool_orders.order_created, boeskool_orders.ship_amount, boeskool_order_items.vat');
    $builder1->join('boeskool_order_items', 'boeskool_orders.id = boeskool_order_items.order_id');
    $builder1->where('DATE(boeskool_orders.order_created) >=', $start_date1);
    $builder1->where('DATE(boeskool_orders.order_created) <=', $end_date1);
	$builder1->whereNotIn('payment_status', ['cancel', 'open']);
    $builder1->groupBy('boeskool_order_items.order_id');
    $result1 = $builder1->get()->getResultArray();

    $groupedData = [];
    foreach ($result as $order) {
        $orderDate = substr($order['order_created'], 0, 10);
        if (!isset($groupedData[$orderDate])) {
            $groupedData[$orderDate] = [
                'total_amount' => 0,
				'ship_amount' => 0,
				'vat' => 0,
				'orders' => 0,
				'order_created' => $orderDate,
				'returns' => 0,
				'total_gross' => 0 
            ];
        }
        $groupedData[$orderDate]['total_amount'] += $order['total_amount'];
        $groupedData[$orderDate]['ship_amount'] += $order['ship_amount'];
        $vat_rate = !empty($order['vat']) ? $order['vat'] : 21;
        $vamount = calculateVat($order['total_amount'], $vat_rate);
        $groupedData[$orderDate]['vat'] += $vamount['vatAmount'];
        $groupedData[$orderDate]['orders'] += 1;
		$groupedData[$orderDate]['total_gross'] += $order['total_amount'];
    }

    $groupedData2 = [];
    foreach ($result1 as $order) {
        $orderDate2 = substr($order['order_created'], 0, 10);
        if (!isset($groupedData2[$orderDate2])) {
			$groupedData2[$orderDate2] = [
				'total_amount' => 0,
				'ship_amount' => 0,
				'vat' => 0,
				'orders' => 0,
				'order_created' => $orderDate2,
				'returns' => 0,
				'total_gross' => 0 
			];
        }
        $groupedData2[$orderDate2]['total_amount'] += $order['total_amount'];
        $groupedData2[$orderDate2]['ship_amount'] += $order['ship_amount'];
        $vat_rate = !empty($order['vat']) ? $order['vat'] : 21;
        $vamount = calculateVat($order['total_amount'], $vat_rate);
        $groupedData2[$orderDate2]['vat'] += $vamount['vatAmount'];
        $groupedData2[$orderDate2]['orders'] += 1;
		$groupedData2[$orderDate2]['total_gross'] += $order['total_amount'];
    }

    $mergedData = array_merge($groupedData2, $groupedData);

    // Send CSV headers
    $filename = "order_report_" . date('YmdHis') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Open output stream
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Date', 'Orders', 'Gross sales','Returns','Taxes','Shipping', 'Total sales']);

    foreach ($mergedData as $data) {
        fputcsv($output, [
            $data['order_created'],
            $data['orders'],
            number_format($data['total_amount'], 2, ',', '.'),
            number_format($data['returns'], 2, ',', '.'),
			number_format($data['vat'], 2, ',', '.'),
            number_format($data['ship_amount'], 2, ',', '.'),
			number_format($data['total_gross'], 2, ',', '.'),
        ]);
    }

    fclose($output);
    exit;
}



	}
