<?php 

namespace App\Controllers\Beheerpaneel;

use App\Controllers\BaseController;
use App\Models\General_model;

class Settings extends BaseController 
{
	public function __construct() {
		$this->cache = \Config\Services::cache();
		
	}
	function logo()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data  = $this->general_model->fetch_data('settings',array('code'=>'LOGO'));
			$christmas_logo_data  = $this->general_model->fetch_data('settings',array('code'=>'chris_logo'));
			$christmas_wit_logo_data  = $this->general_model->fetch_data('settings',array('code'=>'chris_wit_logo'));
			$sticky_data = $this->general_model->fetch_data('settings',array('code'=>'SLOGO'));
			$amvlogo_data = $this->general_model->fetch_data('settings',array('code'=>'AMVLOGO'));
			$adminlbanner_data = $this->general_model->fetch_data('settings',array('code'=>'ALBANNER'));

			$enable_captcha = $this->general_model->fetch_data('settings',array('code'=>'CAPTCHA'));

	


		if(!empty($_FILES['logo']['name']) || !empty($_FILES['slogo']['name']) || !empty($_FILES['amvlogo']['name']) || !empty($_FILES['albanner']['name']) || !empty($_FILES['chris_logo']['name']) || !empty($_FILES['chris_wit_logo']['name']))
		{
			$file  = $this->request->getFile('logo');
			$sfile = $this->request->getFile('slogo');
			$amvfile = $this->request->getFile('amvlogo');
			$alfile = $this->request->getFile('albanner');


			if(!empty($_FILES['logo']['name']) && !empty($file->getName()))
			{   
				$imagename = $file->getRandomName();
				$file->move('uploads/logo',$imagename);
			}
			else
				$imagename = $setting_data[0]->value;

			if(!empty($_FILES['slogo']['name']) && !empty($sfile->getName()))
			{   
				$simagename = $sfile->getRandomName();
				$sfile->move('uploads/logo',$simagename);
			}
			else
				$simagename = $sticky_data[0]->value;

			
			
			if(!empty($_FILES['amvlogo']['name']) && !empty($amvfile->getName()))
			{   
				$amvimagename = $amvfile->getRandomName();
				$amvfile->move('uploads/logo',$amvimagename);
			}
			else
				$amvimagename = $amvlogo_data[0]->value;


			if(!empty($_FILES['albanner']['name']) && !empty($alfile->getName()))
			{   
				$alimagename = $alfile->getRandomName();
				$alfile->move('uploads/logo',$alimagename);
 

			}
			else
				$alimagename = $adminlbanner_data[0]->value;


			



				
			
			$update_values = array(
				'name' => 'sitelogo',
				'code' => 'LOGO',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => ($imagename) ? $imagename : '',
			);
			$supdate_values = array(
				'name' => 'stickylogo',
				'code' => 'SLOGO',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => ($simagename) ? $simagename : '',
			);

			$amvupdate_values = array(
				'name' => 'adminmobilelogo',
				'code' => 'AMVLOGO',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => ($amvimagename) ? $amvimagename : '',
			);

			$alupdate_values = array(
				'name' => 'adminloginbanner',
				'code' => 'ALBANNER',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => ($alimagename) ? $alimagename : '',
			);

			
			
			
			
			if(!empty($setting_data))
				$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
			else
				$this->general_model->insert_data('settings',$update_values);

			if(!empty($sticky_data))
				$this->general_model->update_data('settings',$supdate_values,$sticky_data[0]->id);
			else
				$this->general_model->insert_data('settings',$supdate_values);


			if(!empty($amvlogo_data))
				$this->general_model->update_data('settings',$amvupdate_values,$amvlogo_data[0]->id);
			else
				$this->general_model->insert_data('settings',$amvupdate_values);


			if(!empty($adminlbanner_data))
				$this->general_model->update_data('settings',$alupdate_values,$adminlbanner_data[0]->id);
			else
				$this->general_model->insert_data('settings',$alupdate_values);


			
			
			}
				
			if($this->request->getVar('enable_captcha')){
				$enable_captcha_value = $this->request->getVar('enable_captcha');
			
			}
			
			
			// if($this->request->getVar()){
			// 	$enable_captcha_value = $this->request->getVar('enable_captcha');
			
			// 	$cupdate_values = array(
			// 		'name' => 'enable_captcha',
			// 		'code' => 'CAPTCHA',
			// 		'mod_date' => date('Y-m-d H:i:s'),
			// 		'auser_id' => $this->session->get('admin_id'),
			// 		'value' => ($enable_captcha_value) ? $enable_captcha_value : '0',
			// 	);
	
			// 	if(!empty($enable_captcha))
			// 		$this->general_model->update_data('settings',$cupdate_values,$enable_captcha[0]->id);
			// 	else
			// 		$this->general_model->insert_data('settings',$cupdate_values);
					
					
					
			// $this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			// return redirect()->to(base_url(ADMIN_URL.'/settings/logo') );
				
			// }

			
		
		$this->outputData['setting_data'] = $this->general_model->fetch_data('settings',array('code'=>'LOGO'));
		$this->outputData['sticky_data'] = $this->general_model->fetch_data('settings',array('code'=>'SLOGO'));
		$this->outputData['amvlogo_data'] = $this->general_model->fetch_data('settings',array('code'=>'AMVLOGO'));
		$this->outputData['adminlbanner_data'] = $this->general_model->fetch_data('settings',array('code'=>'ALBANNER'));


		$this->outputData['enable_captcha'] = $this->general_model->fetch_data('settings',array('code'=>'CAPTCHA'));

	
		
		$this->admin_template('beheerpaneel/settings/logo',$this->outputData);
	}

	function loginpageimage()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			return redirect()->to(base_url(ADMIN_URL.'/settings/logo') );


			exit;
			$setting_data  = $this->general_model->fetch_data('settings',array('code'=>'loginpageimage'));
			$login_text = $this->general_model->fetch_data('settings',array('code'=>'login_text'));
		
		if($this->request->getPost())
		{
			if(!empty($_FILES['loginlogo']['name']))
			{
				$file  = $this->request->getFile('loginlogo');
				if(!empty($_FILES['loginlogo']['name']) && !empty($file->getName()))
				{   
					$imagename = $file->getRandomName();
					$file->move('uploads/logo',$imagename);
				}
				else
					$imagename = $setting_data[0]->value;

				$update_values = array(
					'name' => 'Loginpage Image',
					'code' => 'loginpageimage',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => ($imagename) ? $imagename : '',
				);
				
				if(!empty($setting_data))
					$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values);

						
				
					
			}

			if(!empty($this->request->getVar('login_text')))
			{
				$update_values = array(
					'name' => 'Login Content',
					'code' => 'login_text',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => !empty($this->request->getVar('login_text'))?$this->request->getVar('login_text'):'',
				);
				if(!empty($login_text))
					$this->general_model->update_data('settings',$update_values,$login_text[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values);
			}

			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/loginpageimage') );
		}
		

			
		
		$this->outputData['setting_data'] = $this->general_model->fetch_data('settings',array('code'=>'loginpageimage'));
		$this->outputData['login_text'] = $this->general_model->fetch_data('settings',array('code'=>'login_text'));
	
		
		$this->admin_template('beheerpaneel/settings/loginpageimage',$this->outputData);
	}


	function invoicelogo()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		
		$setting_data  = $this->general_model->fetch_data('settings',array('code'=>'invoice_logo'));
		$invoice_header  = $this->general_model->fetch_data('settings',array('code'=>'invoice_header'));
		$invoice_footer  = $this->general_model->fetch_data('settings',array('code'=>'invoice_footer'));
		$invoice_watermark  = $this->general_model->fetch_data('settings',array('code'=>'invoice_watermark'));
		

		if($_FILES)
		{
			
			if(!empty($_FILES['invoicelogo']['name']))
			{
				$file  = $this->request->getFile('invoicelogo');
				if(!empty($_FILES['invoicelogo']['name']) && !empty($file->getName()))
				{   
					$imagename = $file->getRandomName();
					$file->move('uploads/logo',$imagename);
				}
				else
					$imagename = $setting_data[0]->value;

				$update_values = array(
					'name' => 'Invoice Logo',
					'code' => 'invoice_logo',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => ($imagename) ? $imagename : '',
				);
				
				if(!empty($setting_data))
					$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values); 
			}

			if(!empty($_FILES['invoice_header']['name']))
			{
				

				$file  = $this->request->getFile('invoice_header');
				if(!empty($_FILES['invoice_header']['name']) && !empty($file->getName()))
				{   
					$imagename = $file->getRandomName();
					$file->move('uploads/printpapaer',$imagename);
				}
				else
					$imagename = $invoice_header[0]->value;

				$update_values = array(
					'name' => 'Invoice Header',
					'code' => 'invoice_header',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => ($imagename) ? $imagename : '',
				);
				
				if(!empty($setting_data))
					$this->general_model->update_data('settings',$update_values,$invoice_header[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values); 
			}


			if(!empty($_FILES['invoice_footer']['name']))
			{
				$file  = $this->request->getFile('invoice_footer');
				if(!empty($_FILES['invoice_footer']['name']) && !empty($file->getName()))
				{   
					$imagename = $file->getRandomName();
					$file->move('uploads/printpapaer',$imagename);
				}
				else
					$imagename = $invoice_header[0]->value;

				$update_values = array(
					'name' => 'Invoice Footer',
					'code' => 'invoice_footer',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => ($imagename) ? $imagename : '',
				);
				
				if(!empty($setting_data))
					$this->general_model->update_data('settings',$update_values,$invoice_footer[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values); 
			}

			if(!empty($_FILES['invoice_watermark']['name']))
			{
				$file  = $this->request->getFile('invoice_watermark');
				if(!empty($_FILES['invoice_watermark']['name']) && !empty($file->getName()))
				{   
					$imagename = $file->getRandomName();
					$file->move('uploads/printpapaer',$imagename);
				}
				else
					$imagename = $invoice_header[0]->value;

				$update_values = array(
					'name' => 'Invoice Watermark',
					'code' => 'invoice_watermark',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => ($imagename) ? $imagename : '',
				);
				
				if(!empty($setting_data))
					$this->general_model->update_data('settings',$update_values,$invoice_watermark[0]->id);
				else
					$this->general_model->insert_data('settings',$update_values); 
			}


			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/invoicelogo') );
		}	
		
		$this->outputData['setting_data'] = $setting_data;
		$this->outputData['invoice_header'] = $invoice_header;
		$this->outputData['invoice_footer'] = $invoice_footer;
		$this->outputData['invoice_watermark'] = $invoice_watermark;

	
		
		$this->admin_template('beheerpaneel/settings/invoicelogo',$this->outputData);
	}

	function favicon()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data = $this->general_model->fetch_data('settings',array('code'=>'FAVICON'));
		if(!empty($_FILES['ficon']['name']))
		{
			$file = $this->request->getFile('ficon');

			if(!empty($file->getName()))
 			{   
 				$imagename = $file->getRandomName();
			 	$file->move('uploads/favicon',$imagename);
		 	}
		 	else
		 	{
		 		$imagename = $setting_data[0]->value;
		 	}

			$update_values = array(
				'name' => 'favicon',
				'code' => 'FAVICON',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => ($imagename) ? $imagename : '',
			);
			// $this->general_model->update_data('settings',$update_values,$id);
			if(!empty($setting_data))
			{
				$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
			}
			else
			{
				$this->general_model->insert_data('settings',$update_values);
			}
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/favicon') );
		}
		$this->outputData['setting_data'] = $setting_data;
		$this->admin_template('beheerpaneel/settings/favicon',$this->outputData);
	}

	function copyright()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data = $this->general_model->fetch_data('settings',array('code'=>'COPYRIGHT'));
		if(!empty($this->request->getVar()))
		{
			$update_values = array(
				'name' => 'copyright',
				'code' => 'COPYRIGHT',
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
				'value' => $this->request->getVar('copyright'),
			);
			// $this->general_model->update_data('settings',$update_values,$id);
			if(!empty($setting_data))
			{
				$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
			}
			else
			{
				$this->general_model->insert_data('settings',$update_values);
			}

			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/copyright') );
		}
		$this->outputData['setting_data'] = $setting_data;
		$this->admin_template('beheerpaneel/settings/copyright',$this->outputData);
	}

	function product_ups()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
		$setting_data = $this->general_model->fetch_data('settings',array('code'=>'product_ups'));
		if(!empty($this->request->getVar()))
		{
			if($this->request->getVar('product_ups'))
			{
				$update_values = array(
					'name' => 'Product UPS',
					'code' => 'product_ups',
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'value' => $this->request->getVar('product_ups'),
				);
				// $this->general_model->update_data('settings',$update_values,$id);
				if(!empty($setting_data))
				{
					$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
				}
				
			}

			
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/product_ups') );
		}
		$this->outputData['setting_data'] = $setting_data;
		$this->admin_template('beheerpaneel/settings/product_ups',$this->outputData);
	}

	function contactinfo()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$id = 1;
			$contact_data = $this->general_model->fetch_data('sitecontactinfo',array('id'=>$id));

			if(!empty($this->request->getVar()))
			{
				$update_values = array(
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					'name' => $this->request->getVar('name'),
					'address' => $this->request->getVar('address'),
					'postcode' => $this->request->getVar('postcode'),
					'city' => $this->request->getVar('city'),
					'country' => $this->request->getVar('country'),
					'phone' => $this->request->getVar('phone'),
					'email' => $this->request->getVar('email'),
					'lat' => $this->request->getVar('lat'),
					'lng' => $this->request->getVar('lng'),
					'contact_mail' => $this->request->getVar('cemail')
				);

				$this->general_model->update_data('sitecontactinfo',$update_values,$id);
				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/contactinfo') );
			}
			$this->outputData['contact_data'] = $contact_data;
			$this->admin_template('beheerpaneel/settings/contactinfo',$this->outputData);
	}

	function footertext()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data = $this->general_model->fetch_data('settings',array('code'=>'FOOTERTEXT'));
			$setting_data1 = $this->general_model->fetch_data('settings',array('code'=>'whatsapp_number'));

			if(!empty($this->request->getVar())){

				if(!empty($this->request->getPost('footertext')))
				{
					$update_values = array(
						'name' => 'footertext',
						'code' => 'FOOTERTEXT',
						'mod_date' => date('Y-m-d H:i:s'),
						'auser_id' => $this->session->get('admin_id'),
						'value' => $this->request->getVar('footertext'),
					);
	
					// $this->general_model->update_data('settings',$update_values,$id);
					if(!empty($setting_data)){
						$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
					}else{
						$this->general_model->insert_data('settings',$update_values);
					}
				}

				if(!empty($this->request->getPost('whatsapp_number')))
				{
					$update_values = array(
						'name' => 'Whatsapp Number',
						'code' => 'whatsapp_number',
						'mod_date' => date('Y-m-d H:i:s'),
						'auser_id' => $this->session->get('admin_id'),
						'value' => $this->request->getVar('whatsapp_number'),
					);
	
					// $this->general_model->update_data('settings',$update_values,$id);
					if(!empty($setting_data1)){
						$this->general_model->update_data('settings',$update_values,$setting_data1[0]->id);
					}else{
						$this->general_model->insert_data('settings',$update_values);
					}

				}

				

				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/footertext') );
			}
			$this->outputData['setting_data'] = $setting_data;
			$this->outputData['setting_data1'] = $setting_data1;
			$this->admin_template('beheerpaneel/settings/footertext',$this->outputData);
	}

	function general()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data = $this->general_model->fetch_data('settings',array('code'=>'product_delete_days'));
			if(!empty($this->request->getVar())){

				if(!empty($this->request->getPost('product_delete_days')))
				{
					$update_values = array(
						'name' => 'Product Delete Days',
						'code' => 'product_delete_days',
						'mod_date' => date('Y-m-d H:i:s'),
						'auser_id' => $this->session->get('admin_id'),
						'value' => $this->request->getVar('product_delete_days'),
					);
	
					// $this->general_model->update_data('settings',$update_values,$id);
					if(!empty($setting_data)){
						$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
					}else{
						$this->general_model->insert_data('settings',$update_values);
					}
				}

				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/general') );
			}
			$this->outputData['setting_data'] = $setting_data;
			$this->admin_template('beheerpaneel/settings/general',$this->outputData);
	}

	function pagination()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			$setting_data = $this->general_model->fetch_data('settings',array('code'=>'pagination'));
			if(!empty($this->request->getVar())){

				if(!empty($this->request->getPost('pagination')))
				{
					$update_values = array(
						'name' => 'Pagination',
						'code' => 'pagination',
						'mod_date' => date('Y-m-d H:i:s'),
						'auser_id' => $this->session->get('admin_id'),
						'value' => $this->request->getVar('pagination'),
					);
	
					// $this->general_model->update_data('settings',$update_values,$id);
					if(!empty($setting_data)){
						$this->general_model->update_data('settings',$update_values,$setting_data[0]->id);
					}else{
						$this->general_model->insert_data('settings',$update_values);
					}
				}

				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/pagination') );
			}
			$this->outputData['setting_data'] = $setting_data;
			$this->admin_template('beheerpaneel/settings/pagination',$this->outputData);
	}

	function contact_messages(){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $order_by='`id` DESC';
			// $this->outputData['contact_messages'] = $this->general_model->fetch_data('enquiry',NULL,$order_by);

			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['contact_messages'] = $this->general_model->fetch_data('enquiry',NULL,$order_by);
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
						'subject' => '%' . $search . '%',
						'comment' => '%' . $search . '%',
						'telefoon' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				if(!empty($searchCondition)){
					$contact_messages = $this->outputData['contact_messages'] = $this->general_model->fetch_without_limited('enquiry',$condition,$order_by,NULL,$searchCondition);
				}else{
					$contact_messages = $this->outputData['contact_messages'] = $this->general_model->fetch_limited('enquiry',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				}
				$contact_messages1 = $this->outputData['contact_messages'] = $this->general_model->fetch_limited('enquiry',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($contact_messages1 as $data) {
					$result[] = $this->_make_rowcontact($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($contact_messages);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($contact_messages);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/enquiry/manage',$this->outputData);
	}

	private function _make_rowcontact($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

		$first_letter = getFirstLetters($data->name,2);
		$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
		// $url = base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
		$name = $name_style;
		
		$date = strtotime($data->created_at);
		$sdate = date('d-m-Y H:i:s',$date);
		// $edit_url =base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/delete_contact/'.$data->id);
		$remove_lang = getlang('remove');
		$edit_lang = getlang('edit');
		$last_r = "<ul class='nk-tb-actions gx-1'>
			<li>
				<div class='drodown'>
					<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
					<div class='dropdown-menu dropdown-menu-end'>
						<ul class='link-list-opt no-bdr'>
							<li><a href='$remove_url' data-url='$remove_url' class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>";
		$row_data = array(
			$first_,
		$data->id,
		$data->email,
		$name,
		$data->subject,
		$data->comment,
		$data->telefoon,
		$sdate,
		$last_r,
		);
	
		
		return $row_data;
	}

	function delete_contact($id)
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		$this->general_model->delete_data('enquiry',$id);
		return redirect()->to(base_url(ADMIN_URL.'/settings/contact_messages'));

	}

	// function manage()
	// {
	// 	if(!isAdmin())
	// 		return redirect()->to(base_url(ADMIN_URL.'/login') );
	// 	else
	// 	if($this->request->getVar())
	// 	{
			
	// 		$update_data = array();
	// 		$data = $this->request->getVar();
	// 		foreach($data as $key=>$d)
	// 		{
	// 			if($key !='csrf_test_name' && $key != 'honeypot')
	// 			{
	// 				$update_data[$key]= !empty($d)?$d:0;
	// 			}
	// 		}
	// 		// echo "<pre>";
	// 		// print_r($update_data);
	// 		// exit;
	// 		$settings = $this->general_model->update_settings('settings',$update_data);
	// 		$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
	// 		return redirect()->to(base_url(ADMIN_URL.'/settings/manage') );
			
	// 	}
	// 	$order_by  = 'id ASC';
	// 	$condition = array('type!='=>'image');
	// 	$excludes = array('klarna_access_token','klarna_profile_id','Mollie_Api_Key','google_api_key','google_api_placeid','postnl_apikey','CACHE_ENABLED','CACHE_TIME','postcode_fetcher_secret','postcode_fetcher_key','feedback_company_client_id','feedback_company_client_secret');
	// 	$settings_data = $this->outputData['allsettings_data'] = $this->general_model->fetchexcludes_data('settings',$condition,$order_by,$excludes);

	// 	$this->admin_template('beheerpaneel/settings/index',$this->outputData);
	// }

	public function manage()
	{
		if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			
			if($this->request->getVar())
			{
				
				$update_data = array();
				$data = $this->request->getVar();
				foreach($data as $key=>$d)
				{
					if($key !='csrf_test_name' && $key != 'honeypot')
					{
						$update_data[$key]= !empty($d)?$d:0;
					}
				}
				// echo "<pre>";
				// print_r($update_data);
				// exit;
				$settings = $this->general_model->update_settings('settings',$update_data);
				$this->session->setFlashdata('Success_message',getlang('updated_successfully'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/manage') );
				
			}
			$order_by  = 'id ASC';
			$condition = array('type!='=>'image');
			$excludes = array('klarna_access_token','klarna_profile_id','Mollie_Api_Key','google_api_key','google_api_placeid','postnl_apikey','CACHE_ENABLED','CACHE_TIME','invitation_webshop_id','invitation_webshop_code');
			$settings_data = $this->outputData['allsettings_data'] = $this->general_model->fetchexcludes_data('settings',$condition,$order_by,$excludes);

			
			$this->admin_template('beheerpaneel/settings/newtab',$this->outputData);
	}


	function api_key()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
		if($this->request->getVar())
		{
			
			$update_data = array();
			$data = $this->request->getVar();
			foreach($data as $key=>$d)
			{
				if($key !='csrf_test_name' && $key != 'honeypot')
				{
					$update_data[$key]= !empty($d)?$d:0;
				}
			}
			// echo "<pre>";
			// print_r($update_data);
			// exit;
			$settings = $this->general_model->update_settings('settings',$update_data);
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/manage') );
			
		}
		$order_by  = 'id ASC';
		$includes = array('klarna_access_token','klarna_profile_id','Mollie_Api_Key','google_api_key','google_api_placeid','postnl_apikey','postcode_fetcher_secret','postcode_fetcher_key','feedback_company_client_id','feedback_company_client_secret');
		$settings_data = $this->outputData['allsettings_data'] = $this->general_model->fetchincludes_data('settings',null,$order_by,$includes);

		$this->admin_template('beheerpaneel/settings/api_key',$this->outputData);
	}


	function manage_old()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $order_by='`id` DESC';
			$excludeCodes = ['LOGO', 'FAVICON', 'SLOGO','invoice_logo','loginpageimage','login_text','product_ups'];
			// $this->outputData['general_settings'] = $this->general_model->fetchexcludes_data('settings',NULL,$order_by,$excludeCodes);
		
			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['general_settings'] = $this->general_model->fetchexcludes_data('settings',NULL,$order_by,$excludeCodes);
				$condition = array('id!='=>'');
				$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
				$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
				$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

				$searchCondition = array();
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'name' => '%' . $search . '%',
						'code' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				$general_settings = $this->outputData['general_settings'] = $this->general_model->fetchexcludes_datalimited('settings',NULL,$limit,$offset,$order_by,$excludeCodes,$searchCondition);
				
				
				$result = array();
				foreach ($general_settings as $data) {
					$result[] = $this->_make_row($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($general_settings);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($general_settings);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
			$this->admin_template('beheerpaneel/settings/manage',$this->outputData);
	}

	private function _make_row($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

		$first_letter = getFirstLetters($data->name,2);
		$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
		$url = base_url(ADMIN_URL.'/settings/edit/'.$data->id);
		$name = "<a  href='$url'>".$name_style."</a>";
		
		$value = $data->value;
		if($data->type == 'checkbox'){
			if($data->value)
			{
				$value = getlang('enabled');
			}
			else
			{
				$value = getlang('disabled');
			}
		}
		$edit_url =base_url(ADMIN_URL.'/settings/edit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/countrydelete/'.$data->id);
		$remove_lang = getlang('remove');
		$edit_lang = getlang('edit');
		$last_r = "<ul class='nk-tb-actions gx-1'>
			<li>
				<div class='drodown'>
					<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
					<div class='dropdown-menu dropdown-menu-end'>
						<ul class='link-list-opt no-bdr'>
							<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>";
		$row_data = array(
			$first_,
		$data->id,
		$name,
		$data->code,
		$value,
		$last_r,
		);
	
		
		return $row_data;
	}


	function email()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
		$email_data = $this->general_model->fetch_data('email');
		if(!empty($this->request->getVar())){

			
				$update_values = array(
					'email' => $this->request->getPost('email'),
					'sender_name' => $this->request->getPost('sender_name'),
					'mail_type' => !empty($this->request->getPost('mail_type'))?$this->request->getPost('mail_type'):0,
					'smtp_username' => $this->request->getPost('smtp_username'),
					'smtp_host' => $this->request->getPost('smtp_host'),
					'smtp_password' => $this->request->getPost('smtp_password'),
					'smtp_port' => $this->request->getPost('smtp_port'),
					'mod_date' => date('Y-m-d H:i:s'),
					'auser_id' => $this->session->get('admin_id'),
					
				);

				if(!empty($email_data)){
					$this->general_model->update_data('email',$update_values,$email_data[0]->id);
				}else{
					$this->general_model->insert_data('email',$update_values);
				}
			

			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/email') );
		}
		$this->outputData['email'] = $email_data;
		$this->admin_template('beheerpaneel/settings/email',$this->outputData);

	}

	function edit($id)
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		if(!empty($this->request->getVar())){

			$type = $this->request->getPost('type');
			$value = !empty($this->request->getPost('value'))?$this->request->getPost('value'):'';
			if($type == 'checkbox')
			{
				$value = !empty($this->request->getPost('value'))?$this->request->getPost('value'):0;
			}
			$update_values = array(
				'name' => $this->request->getVar('name'),
				'code' => $this->request->getVar('code'),
				'value' => $value,
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
			);
			
		
			$this->general_model->update_data('settings',$update_values,$id);
			
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/manage') );
		}
		
		$this->outputData['general_settings'] = $this->general_model->fetch_data('settings',array('id'=>$id));
		$this->admin_template('beheerpaneel/settings/edit',$this->outputData);
	}

	function add()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		if(!empty($this->request->getVar())){

			$update_values = array(
				'name' => $this->request->getVar('name'),
				'code' => $this->request->getVar('code'),
				'value' => $this->request->getVar('value'),
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id'),
			);
			
		
			$this->general_model->insert_data('settings',$update_values);
			
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/manage') );
		}
		
		$this->admin_template('beheerpaneel/settings/add',$this->outputData);
	}

	

	function cache()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		


		if(!empty($this->request->getVar())){

			$this->cache->clean();

			if($this->request->getVar('cache_status')){
				$cache_status = '1';
			} else {
				$cache_status = '0';

			}
			$update_values = array(
				'value' => $cache_status,
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id')
			);

			$this->general_model->update_condition('settings',$update_values,array('code' => 'CACHE_ENABLED'));

			
			$update_values_cache_time = array(
				'value' => $this->request->getVar('cache_time'),
				'mod_date' => date('Y-m-d H:i:s'),
				'auser_id' => $this->session->get('admin_id')
			);

			$this->general_model->update_condition('settings',$update_values_cache_time,array('code' => 'CACHE_TIME'));


			
			$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
			return redirect()->to(base_url(ADMIN_URL.'/settings/cache') );
		}

		$this->outputData['cache_status'] = $this->general_model->fetch_data('settings',array('code'=>'CACHE_ENABLED'));
		$this->outputData['cache_time'] = $this->general_model->fetch_data('settings',array('code'=>'CACHE_TIME'));


		$this->admin_template('beheerpaneel/settings/cache',$this->outputData);
	}


	function countrymanage(){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $this->outputData['countries'] = $this->general_model->fetch_data('country');

			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['countries'] = $this->general_model->fetch_data('country',NULL,$order_by);
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
				$countries = $this->outputData['countries'] = $this->general_model->fetch_limited('country',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($countries as $data) {
					$result[] = $this->_make_rowcountry($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($countries);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($countries);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/country/manage',$this->outputData);
	}

	private function _make_rowcountry($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

		$first_letter = getFirstLetters($data->name,2);
		$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
		$url = base_url(ADMIN_URL.'/settings/countryedit/'.$data->id);
		$name = "<a  href='$url'>".$name_style."</a>";
		
		if($data->status == 0){$status = getlang("inactive");}else{$status = getlang("active");}
		$edit_url =base_url(ADMIN_URL.'/settings/countryedit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/countrydelete/'.$data->id);
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

	function countryadd(){
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			if(!empty($this->request->getVar())){

				$insert_values = array(
					'name' => $this->request->getVar('name'),
					'content' => $this->request->getVar('content'),
					'auser_id' => $this->session->get('admin_id'),
					'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
				);
			
				$this->general_model->insert_data('country',$insert_values);
				
				$this->session->setFlashdata('Success_message',getlang('succesvol aangemaakt'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/countrymanage') );
			}

			$this->admin_template('beheerpaneel/country/add',$this->outputData);
	}

	function countryedit($id){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

			if(!empty($this->request->getVar())){

				$update_values = array(
					'name' => $this->request->getVar('name'),
					'content' => $this->request->getVar('content'),
					'auser_id' => $this->session->get('admin_id'),
					'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
					'mod_at' => date('Y-m-d H:i:s')
				);
				
			
				$this->general_model->update_data('country',$update_values,$id);
				
				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/countrymanage') );
			}
			
			$this->outputData['country'] = $this->general_model->fetch_data('country',array('id'=>$id));
			$this->admin_template('beheerpaneel/country/edit',$this->outputData);

	}

	function countrydelete(){
		
		$id=$this->request->uri->getSegment(4);
		
		$this->general_model->delete_data('country',$id);
		return redirect()->to(base_url(ADMIN_URL.'/settings/countrymanage'));
	}







	function vatmanage(){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $this->outputData['vat'] = $this->general_model->fetch_data('vat');

			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['vat'] = $this->general_model->fetch_data('vat',NULL,$order_by);
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
				$vat = $this->outputData['vat'] = $this->general_model->fetch_limited('vat',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($vat as $data) {
					$result[] = $this->_make_rowvat($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($vat);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($vat);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/vat/manage',$this->outputData);
	}

	private function _make_rowvat($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
		// $url = base_url(ADMIN_URL.'/settings/vatedit/'.$data->id);
		// $name = "<a  href='$url'>".strip_tags($data->name)."</a>";

		$first_letter = getFirstLetters($data->name,2);
			$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->name<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
			$url = base_url(ADMIN_URL.'/settings/vatedit/'.$data->id);
			$name = "<a  href='$url'>".$name_style."</a>";
		
		if($data->status == 0)
		{
			$status = getlang('active');
		}else
		{
			$status = getlang('inactive');
		}
		$edit_url =base_url(ADMIN_URL.'/settings/vatedit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/vatdelete/'.$data->id);
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

	function vatadd(){
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			if(!empty($this->request->getVar())){

				$insert_values = array(
					'name' => $this->request->getVar('name'),
					'auser_id' => $this->session->get('admin_id'),
					'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
				);
			
				$this->general_model->insert_data('vat',$insert_values);
				
				$this->session->setFlashdata('Success_message',getlang('succesvol aangemaakt'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/vatmanage') );
			}

			$this->admin_template('beheerpaneel/vat/add',$this->outputData);
	}

	function vatedit($id){

		if(!isAdmin())
			return redirect()->to(base_url('beheerpaneel/login') );
		else

			if(!empty($this->request->getVar())){

				$update_values = array(
					'name' => $this->request->getVar('name'),
					'auser_id' => $this->session->get('admin_id'),
					'status' => ($this->request->getVar('status')) ? $this->request->getVar('status') : 0,
					'mod_at' => date('Y-m-d H:i:s')
				);
				
			
				$this->general_model->update_data('vat',$update_values,$id);
				
				$this->session->setFlashdata('Success_message',getlang('succesvol geupdatet'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/vatmanage') );
			}
			
			$this->outputData['vat'] = $this->general_model->fetch_data('vat',array('id'=>$id));
			$this->admin_template('beheerpaneel/vat/edit',$this->outputData);

	}

	function vatdelete(){
		
		$id=$this->request->uri->getSegment(4);
		
		$this->general_model->delete_data('vat',$id);
		return redirect()->to(base_url(ADMIN_URL.'/settings/vatmanage'));
	}


	function newslettermanage(){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $order_by='`id` DESC';
			// $this->outputData['newsletter'] = $this->general_model->fetch_data('newsletter',null,$order_by);


			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['newsletter'] = $this->general_model->fetch_data('newsletter',NULL,$order_by);
				$condition = array('id!='=>'');
				$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
				$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
				$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

				$searchCondition = array();
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'email' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				$newsletter = $this->outputData['newsletter'] = $this->general_model->fetch_limited('newsletter',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($newsletter as $data) {
					$result[] = $this->_make_rownewsletter($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($newsletter);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($newsletter);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/newsletter/manage',$this->outputData);
	}

	private function _make_rownewsletter($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

		$first_letter = getFirstLetters($data->email,2);
		$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->email<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
		$name = $name_style;
		// $edit_url =base_url(ADMIN_URL.'/brand/edit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/newsletterdelete/'.$data->id);
		$remove_lang = getlang('remove');
		$edit_lang = getlang('edit');
		$last_r = "<ul class='nk-tb-actions gx-1'>
				<li>
					<div class='drodown'>
						<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
						<div class='dropdown-menu dropdown-menu-end'>
							<ul class='link-list-opt no-bdr'>
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
		$last_r
		);
	
		
		return $row_data;
	}

	public function newsletterdelete($id)
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		$this->general_model->delete_data('newsletter',$id);
		return redirect()->to(base_url(ADMIN_URL.'/settings/newslettermanage'));
	}
	
	public function general_notes()
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		$this->admin_template('beheerpaneel/settings/generalnotes',$this->outputData);
	}

	public function redirects_manage()
	{
		if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['redirecturls'] = $this->general_model->fetch_data('redirects',NULL,$order_by);
				$condition = array('id!='=>'');
				$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
				$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
				$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

				$searchCondition = array();
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'old_url' => '%' . $search . '%',
						'new_url' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				$redirects = $this->outputData['redirects'] = $this->general_model->fetch_limited('redirects',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($redirects as $data) {
					$result[] = $this->_make_redirects_row($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($redirects);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($redirects);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/redirects/manage',$this->outputData);
	}

	private function _make_redirects_row($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";
		$url = base_url(ADMIN_URL.'/settings/edit_redirect/'.$data->id);
		$name = "<a  href='$url'>".$data->old_url."</a>";
		
		$edit_url =base_url(ADMIN_URL.'/settings/edit_redirect/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/settings/delete_redirect/'.$data->id);
		$remove_lang = getlang('remove');
		$edit_lang = getlang('edit');
		$last_r = "<ul class='nk-tb-actions gx-1'>
			<li>
				<div class='drodown'>
					<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
					<div class='dropdown-menu dropdown-menu-end'>
						<ul class='link-list-opt no-bdr'>
							<li><a href='$edit_url'><em class='icon ni ni-edit'></em><span>$edit_lang</span></a></li>
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
		$data->new_url,
		$last_r,
		);
	
		
		return $row_data;
	}


	function add_redirect(){
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			if(!empty($this->request->getVar())){
				// Get user-entered data
				$previousInput = $this->request->getPost();

				// Store the user-entered data in session flash data
				$this->session->setFlashdata('previousInput', $previousInput);
				$validation = \Config\Services::validation();
				$input = $this->validate([
					'old_url' => [
						'label' => getlang("old_url"),
						'rules' => 'trim|required',
						'errors' => [
							'required' => '{field} '.getlang('field_is_required').'.',
						],
					],
					'new_url' => [
						'label' => getlang("new_url"),
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

					return redirect()->to(ADMIN_URL.'/settings/add_redirect');
					exit;
				}

				$check_keyword = $this->check_redirect_url($this->request->getVar('old_url'));
				// echo $check_keyword;
				if($check_keyword)
				{
					$this->session->setFlashdata('error',getlang('redirect_url_exists'));
					return redirect()->to(base_url(ADMIN_URL.'/settings/add_redirect') );
				}
				
				// exit;

				$insert_values = array(
					'old_url' => $this->request->getVar('old_url'),
					'new_url' => $this->request->getVar('new_url'),
					
				);
			
				$this->general_model->insert_data('redirects', $insert_values);
				
				$this->session->setFlashdata('adminsuccess',getlang('redirect_url_create_successfully'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/redirects_manage') );
			}
			$this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
			$this->admin_template('beheerpaneel/redirects/add',$this->outputData);
	}

	function edit_redirect($id){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

			$redirects = $this->general_model->fetch_data('redirects',array('id'=>$id));
			if(empty($redirects))
			{
				return redirect()->to(base_url(ADMIN_URL.'/settings/redirects_manage') );
			}
			if(!empty($this->request->getVar())){

				$validation = \Config\Services::validation();
				$input = $this->validate([
					'old_url' => [
						'label' => getlang("old_url"),
						'rules' => 'trim|required',
						'errors' => [
							'required' => '{field} '.getlang('field_is_required').'.',
						],
					],
					'new_url' => [
						'label' => getlang("new_url"),
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

					return redirect()->to(ADMIN_URL.'/settings/edit_redirect/'.$id);
					exit;
				}

				$update_values = array(
					'old_url' => $this->request->getVar('old_url'),
					'new_url' => $this->request->getVar('new_url'),
					
				);
				
			
				$this->general_model->update_data('redirects', $update_values,$id);
				
				$this->session->setFlashdata('adminsuccess',getlang('redirect_url_update_successfully'));
				return redirect()->to(base_url(ADMIN_URL.'/settings/redirects_manage') );
			}
			
			$this->outputData['redirectsurl'] = $this->general_model->fetch_data('redirects',array('id'=>$id));
			
			$this->admin_template('beheerpaneel/redirects/edit',$this->outputData);

	}

	function delete_redirect(){
		
		$id=$this->request->uri->getSegment(4);
		$this->general_model->delete_data('redirects',$id);
		return redirect()->to(base_url(ADMIN_URL.'/settings/redirects_manage'));
	}

	function check_redirect_url($keyword)
	{
		$check_redirect_urls = $this->general_model->fetch_data('redirects',array('old_url'=>$keyword));
		if(!empty($check_redirect_urls))
		{
			return true;
		}else
		{
			return false;
		}
	}
	

	function login_activity(){

		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else
			// $order_by='`id` DESC';
			// $this->outputData['contact_messages'] = $this->general_model->fetch_data('enquiry',NULL,$order_by);

			$order_by  = 'id DESC';
			if ($this->request->isAJAX()) {
				$totalrecords = $this->outputData['user_login_activity'] = $this->general_model->fetch_data('user_login_activity',NULL,$order_by);
				$condition = array('id!='=>'');
				$limit = !empty($this->request->getGet('length'))?$this->request->getGet('length'):10;
				$offset = !empty($this->request->getGet('start'))?$this->request->getGet('start'):0;
				$search = !empty($this->request->getGet('search[value]'))?$this->request->getGet('search[value]'):'';

				$searchCondition = array();
				if (!empty($search)) {
					$searchCondition = [
						'id' => '%' . $search . '%',
						'email' => '%' . $search . '%',
						'reason' => '%' . $search . '%',
						'ip_address' => '%' . $search . '%',
						'login_data_time' => '%' . $search . '%',
						// Add more fields if needed
					];
				
				}
				$user_login_activity = $this->outputData['user_login_activity'] = $this->general_model->fetch_limited('user_login_activity',$condition,$limit,$offset,$order_by,NULL,$searchCondition);
				
				
				$result = array();
				foreach ($user_login_activity as $data) {
					$result[] = $this->_make_user_login_activity($data);
				}
				if (!empty($search)) {
				$recordsTotal = $this->outputData['recordsTotal'] = count($user_login_activity);
				$recordsFiltered = $this->outputData['recordsFiltered'] = count($user_login_activity);
				}
				else
				{
					$recordsTotal = $this->outputData['recordsTotal'] = count($totalrecords);
					$recordsFiltered = $this->outputData['recordsFiltered'] = count($totalrecords);
				}
				echo json_encode(array("data" => $result,"recordsTotal" => $recordsTotal,"recordsFiltered" => $recordsFiltered));
				exit;
			}
		
			$this->admin_template('beheerpaneel/auth/loginactivity',$this->outputData);
	}

	private function _make_user_login_activity($data) {

		$first_ = "<div class='custom-control custom-control-sm custom-checkbox notext'><input type='checkbox' class='custom-control-input selectCheckbox' id='$data->id' name='$data->id'><label class='custom-control-label' for='$data->id'></label></div>";

		$first_letter = getFirstLetters($data->email,2);
		$name_style = "<div class='user-card'><div class='user-avatar bg-dim-primary d-none d-sm-flex'><span>$first_letter</span></div><div class='user-info'><span class='tb-lead'>$data->email<span class='dot dot-success d-md-none ms-1'></span></span></div></div>";
		// $url = base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
		$name = $name_style;
		
		$date = strtotime($data->login_data_time);
		$sdate = date('d-m-Y H:i:s',$date);
		// $edit_url =base_url(ADMIN_URL.'/faq/faq_cat_edit/'.$data->id);
		$remove_url = base_url(ADMIN_URL.'/dashboard/delete_user_login_activity/'.$data->id);
		$remove_lang = getlang('remove');
		$edit_lang = getlang('edit');
		$last_r = "<ul class='nk-tb-actions gx-1'>
			<li>
				<div class='drodown'>
					<a href='#' class='dropdown-toggle btn btn-icon btn-trigger' data-bs-toggle='dropdown'><em class='icon ni ni-more-h'></em></a>
					<div class='dropdown-menu dropdown-menu-end'>
						<ul class='link-list-opt no-bdr'>
							<li><a href='$remove_url' data-url='$remove_url'class='delete-action' onclick='confirmDelete1(event, this);'><em class='icon ni ni-delete'></em><span>$remove_lang</span></a></li>
						</ul>
					</div>
				</div>
			</li>
		</ul>";
		$row_data = array(
			$first_,
		$data->id,
		$data->email,
		$data->reason,
		$data->ip_address,
		$sdate,
		$last_r,
		);
	
		
		return $row_data;
	}

	function delete_user_login_activity($id)
	{
		if(!isAdmin())
			return redirect()->to(base_url(ADMIN_URL.'/login') );
		else

		$this->general_model->delete_data('user_login_activity',$id);
		return redirect()->to(base_url(ADMIN_URL.'/dashboard/login_activity'));

	}

	

}