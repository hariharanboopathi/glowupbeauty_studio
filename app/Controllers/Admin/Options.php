<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Options extends BaseController 
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
				$this->outputData['option_detail'] = $this->general_model->fetch_data('options');
			
				$this->admin_template('beheerpaneel/options/manage',$this->outputData);
		}

		function add(){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				if(!empty($this->request->getVar())){

					$insert_values = array(
						'name' => $this->request->getVar('name'),
						'price' => $this->request->getVar('price'),
						'auser_id' => $this->session->get('admin_id')
					);
				
					$this->general_model->insert_data('options',$insert_values);
					
					$this->session->setFlashdata('Success_message',getlang("Opties zijn succesvol toegevoegd"));
					return redirect()->to(base_url(ADMIN_URL.'/options/manage') );
				}
			$this->admin_template('beheerpaneel/options/add');
		}

		function edit($id){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
				$options_data = $this->general_model->fetch_data('options',array('id'=>$id));

				if(!empty($this->request->getVar())){

						$update_values = array(
							'name' => $this->request->getVar('name'),
							'price' => $this->request->getVar('price'),
							'auser_id' => $this->session->get('admin_id'),
							'mod_date' => date('Y-m-d H:i:s')
						);
					
				
					$this->general_model->update_data('options',$update_values,$id);
					
					$this->session->setFlashdata('Success_message',getlang("Opties zijn succesvol bijgewerkt"));
					return redirect()->to(base_url('beheerpaneel/options/manage') );
				}
				$this->outputData['options_data'] = $this->general_model->fetch_data('options',array('id'=>$id));
				$this->admin_template('beheerpaneel/options/edit',$this->outputData);

		}

		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('options',$id);
			return redirect()->to(base_url(ADMIN_URL.'/options/manage'));
		}


	}