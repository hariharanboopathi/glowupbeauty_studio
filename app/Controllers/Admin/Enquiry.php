<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Enquiry extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function manage(){

			if(!isAdmin())
				return redirect()->to(base_url('beheerpaneel/login') );
			else

				$update_values = array(
					'read_sts'		=>	"1"
				);

				$update_cond = array(
					'read_sts'	=>	"0"
				);

				$this->general_model->update_readstatus('enquiry',$update_values,$update_cond);

				$this->outputData['enquiry_data'] = $this->general_model->fetch_data('enquiry');
			
				$this->admin_template('beheerpaneel/enquiry/manage',$this->outputData);
		}


		function delete(){
			
			$id=$this->request->uri->getSegment(4);
			
			$this->general_model->delete_data('enquiry',$id);
			return redirect()->to(base_url('beheerpaneel/enquiry/manage'));
		}


	}