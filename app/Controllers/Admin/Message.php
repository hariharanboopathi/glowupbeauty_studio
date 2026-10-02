<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Message extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$this->outputData['message_detail'] = $this->general_model->fetch_data('message');
			
				$this->admin_template('beheerpaneel/message/manage',$this->outputData);
		}

		function add(){

			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getVar())){

					$insert_values = array(
						'key' => $this->request->getVar('key'),
						'message' => $this->request->getVar('message'),
						'auser_id' => $this->session->get('admin_id'),
					);
				
					$this->general_model->insert_data('message',$insert_values);
					
					$this->session->setFlashdata('Success_message',"SMS-melding is succesvol aangemaakt");
					return redirect()->to(base_url('beheerpaneel/message/manage') );
				}

			
				$this->admin_template('beheerpaneel/message/add');
		}

		function edit($id){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else
				$message_data = $this->general_model->fetch_data('message',array('id'=>$id));

				if(!empty($this->request->getVar())){

					$update_values = array(
						'key' => $this->request->getVar('key'),
						'message' => $this->request->getVar('message'),
						'auser_id' => $this->session->get('admin_id'),
						'mod_at' => date('Y-m-d H:i:s')
					);
				
					$this->general_model->update_data('message',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',"SMS-melding succesvol bijgewerkt");
					return redirect()->to(base_url('beheerpaneel/message/manage') );
				}
				
				$this->outputData['message_data'] = $message_data;
				$this->admin_template('beheerpaneel/message/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('message',$id);
			return redirect()->to(base_url('beheerpaneel/message/manage'));
		}


	}