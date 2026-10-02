<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Cookies extends BaseController 
	{
		public function __construct() {
			/*$this->general_model = new General_model();
			$this->session = \Config\Services::session();
			$this->request = \Config\Services::request();*/
			
		}

		function cookies_content()
        {
            if(!isAdmin()){
            return redirect()->to(base_url('beheerpaneel/login') );
        }else{
                $id = 1;
                if (!$id) {
                    return redirect()->to('beheerpaneel/cookies/cookies_content');
                }

                if (!empty($this->request->getPost())) {

                    $insert_data['content'] = $this->request->getPost('content') ? $this->request->getPost('content') : "";

                    if(!empty($this->request->getPost('cookie_id'))){
                        $this->general_model->update_data('cookies', $insert_data, array("id" => $id));
                    }else{
                    $this->general_model->update_condition('cookies', $insert_data, array("id" => $id));
                    }
                    // $this->general_model->insert_data('cookies', $insert_data, array("id" => $id));
                    $this->session->setFlashdata('adminsuccess', getlang('Succesvol_Bewerkt'));
                    return redirect()->to('beheerpaneel/cookies/cookies_content/' . $id);

                }
                $this->outputData['cookies_content'] = $this->general_model->fetch_data("cookies", array("id" => $id));

                $this->admin_template('beheerpaneel/cookies/cookies_content', $this->outputData);
            }
        }
        function cookies_page()
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $id = 1;
                if (!$id) {
                    return redirect()->to('beheerpaneel/cookies/cookies_page');
                }

                if (!empty($this->request->getPost())) {

                    $insert_data['title'] = $this->request->getPost('title') ? $this->request->getPost('title') : "";
                    $insert_data['content'] = $this->request->getPost('content') ? $this->request->getPost('content') : "";
                    $insert_data['link1'] = $this->request->getPost('link1') ? $this->request->getPost('link1') : "";
                    $insert_data['link2'] = $this->request->getPost('link2') ? $this->request->getPost('link2') : "";

                    if(!empty($this->request->getPost('cookie_page_id'))){
                        $this->general_model->update_data('cookies_content', $insert_data, array("id" => $id));
                    }else{
                    $this->general_model->insert_data('cookies_content', $insert_data);
                    }
                    // $this->general_model->update_data('cookies_content', $insert_data, array("id" => $id));
                    $this->session->setFlashdata('adminsuccess', getlang('Succesvol_Bewerkt'));
                    return redirect()->to('beheerpaneel/cookies/cookies_page/' . $id);

                }
                $this->outputData['cookies_content'] = $this->general_model->fetch_data("cookies_content", array("id" => $id));

                $this->admin_template('beheerpaneel/cookies/cookies_page', $this->outputData);
            }
        }



        function cookies_script()
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $id = 1;
                if (!$id) {
                    return redirect()->to('beheerpaneel/cookies/cookies_script');
                }

                if (!empty($this->request->getPost())) {

                    $insert_data['script'] = $this->request->getPost('script') ? $this->request->getPost('script') : "";

                    if(!empty($this->request->getPost('cookie_script_id'))){
                        $this->general_model->update_data('cookies_script', $insert_data, array("id" => $id));
                    }else{
                    $this->general_model->insert_data('cookies_script', $insert_data, array("id" => $id));
                    }
                    $this->session->setFlashdata('adminsuccess', getlang('Succesvol_Bewerkt'));
                    return redirect()->to('beheerpaneel/cookies/cookies_script/' . $id);

                }
                $this->outputData['cookies_script'] = $this->general_model->fetch_data("cookies_script", array("id" => $id));

                $this->admin_template('beheerpaneel/cookies/cookies_script', $this->outputData);
            }
        }



        public function Instruction_manual()
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $this->admin_template('beheerpaneel/cookies/cookies_instruction_manage', $this->outputData);
            }
        }

        public function cookies_document_manage()
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $this->outputData['cookies_document'] = $this->general_model->fetch_data("cookies_document");
                $this->admin_template('beheerpaneel/cookies/cookies_document_manage', $this->outputData);
            }
        }

        public function cookies_document_add()
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                if (!empty($this->request->getVar())) {


                    $insert_values = array(
                        'service_name	' => $this->request->getVar('service_name'),
                        'cookies_informatie	' => $this->request->getVar('cookies_informatie'),
                        'sorting	' => $this->request->getVar('sorting'),

                    );

                    $this->general_model->insert_data('cookies_document', $insert_values);
                    $this->session->setFlashdata('adminsuccess', getlang('Succesvol_Toegevoegd'));
                    return redirect()->to('beheerpaneel/cookies/cookies_document_manage');
                }
                $this->admin_template('beheerpaneel/cookies/cookies_document_add',$this->outputData);
            }
        }





        public function cookies_document_edit($id)
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $cond = array('id' => $id);
                $page = $this->general_model->fetch_data("cookies_document", $cond);

                if (empty($page)) {
                    return redirect()->to('beheerpaneel/cookies/cookies_document_manage');
                }

                if ($this->request->getVar()) {


                    $update_values = array(
                        'service_name	' => $this->request->getVar('service_name'),
                        'cookies_informatie	' => $this->request->getVar('cookies_informatie'),
                        'sorting	' => $this->request->getVar('sorting'),



                    );

                    $this->general_model->update_data('cookies_document', $update_values, $cond);
                    $this->session->setflashdata(['adminsuccess' => getlang('Succesvol_Bewerkt')]);
                    return redirect()->to('beheerpaneel/cookies/cookies_document_manage');

                }

                $this->outputData['cookies_document'] = $page;
                $this->admin_template('beheerpaneel/cookies/cookies_document_edit', $this->outputData);
            }
        }




        public function cookies_document_delete($id)
        {
            if(!isAdmin()){
                return redirect()->to(base_url('beheerpaneel/login') );
            }else{
                $cond = array('id' => $id);


                $this->general_model->delete_data("cookies_document", array('cookies_document_id' => $id));
                // $this->cache->delete('common_user_menus');
                $this->session->setFlashdata('adminsuccess', getlang('Succesvol_Verwijderd'));
                return redirect()->to('beheerpaneel/cookies/cookies_document_manage');
            }
        }


	}