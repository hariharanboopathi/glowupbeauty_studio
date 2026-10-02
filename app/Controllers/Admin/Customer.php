<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Customer extends BaseController 
	{
		public function __construct() {
			
			
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$this->outputData['customer_detail'] = $this->general_model->fetch_data('customers');
			
				$this->admin_template('beheerpaneel/customer/manage',$this->outputData);
		}

		function add(){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				if(!empty($this->request->getVar())){

					$file = $this->request->getFile('cimage');
					
					if(!empty($file->getName()))
         			{   
         				$imagename = $file->getRandomName();
					 	$file->move('uploads/customers',$imagename);
					 	
					 	
				 	}


					$insert_values = array(
						'fname' => $this->request->getVar('fname'),
						'lname' => $this->request->getVar('lname'),
						'email' => $this->request->getVar('email'),
						// 'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
						'phone' => $this->request->getVar('phone'),
						'c_code' => $this->request->getVar('c_code'),
						'address' => $this->request->getVar('address'),
						'city' => $this->request->getVar('city'),
						'country' => $this->request->getVar('country'),
						'postcode' => $this->request->getVar('postcode'),
						'auser_id' => $this->session->get('admin_id'),
						'cimage' => ($imagename) ? $imagename : '',
					);
				
					$this->general_model->insert_data('customers',$insert_values);
					
					$this->session->setFlashdata('Success_message',"Klant succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/customer/manage') );
				}
			$this->admin_template('beheerpaneel/customer/add');
		}

		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$customer_data = $this->general_model->fetch_data('customers',array('id'=>$id));

				if(!empty($this->request->getVar())){

					$file = $this->request->getFile('cimage');
					
					if(!empty($file->getName()))
	     			{   
	     				$imagename = $file->getRandomName();
					 	$file->move('uploads/customers',$imagename);
				 	}else{
				 		$imagename = $customer_data[0]->cimage;
				 	}

				 	if(!empty($this->request->getVar('password'))){
						$update_values = array(
							'fname' => $this->request->getVar('fname'),
							'lname' => $this->request->getVar('lname'),
							'email' => $this->request->getVar('email'),
							// 'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
							'phone' => $this->request->getVar('phone'),
							'c_code' => $this->request->getVar('c_code'),
							'address' => $this->request->getVar('address'),
							'city' => $this->request->getVar('city'),
							'country' => $this->request->getVar('country'),
							'postcode' => $this->request->getVar('postcode'),
							'auser_id' => $this->session->get('admin_id'),
							'cimage' => $imagename,
							'mod_at' => date('Y-m-d H:i:s')
						);
					}else{
						$update_values = array(
							'fname' => $this->request->getVar('fname'),
							'lname' => $this->request->getVar('lname'),
							'email' => $this->request->getVar('email'),
							'phone' => $this->request->getVar('phone'),
							'c_code' => $this->request->getVar('c_code'),
							'address' => $this->request->getVar('address'),
							'city' => $this->request->getVar('city'),
							'country' => $this->request->getVar('country'),
							'postcode' => $this->request->getVar('postcode'),
							'auser_id' => $this->session->get('admin_id'),
							'cimage' => $imagename,
							'mod_at' => date('Y-m-d H:i:s')
						);
					}
				
					$this->general_model->update_data('customers',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',"Klant succesvol geupdatet");
					return redirect()->to(base_url('beheerpaneel/customer/manage') );
				}
				$this->outputData['customer_data'] = $this->general_model->fetch_data('customers',array('id'=>$id));
				$this->admin_template('beheerpaneel/customer/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			$customer_data = $this->general_model->fetch_data('customers',array('id'=>$id));
			
			if(!empty($customer_data[0]->cimage)){
				unlink('./uploads/customers/'.$customer_data[0]->cimage);
			}
			
			$this->general_model->delete_data('customers',$id);
			return redirect()->to(base_url('beheerpaneel/customer/manage'));
		}


		function check_customer_email()
		{
			$email = $this->request->getVar('email');

			$customer_data = $this->general_model->check_customer_email('customers',$email);
			
			if($customer_data == '0')
			{
				echo "true";
			}
			else
			{
				echo "false";
			}//If end
		}

		/** Check signup user's phone number **/

	    function check_customer_phone(){
	        $phone = $this->request->getVar('phone');

	        $customer_data = $this->general_model->check_customer_phone('customers',$phone);
	        
	        if($customer_data == '0')
	        {
	            echo "true";
	        }
	        else
	        {
	            echo "false";
	        }
	    }


	}