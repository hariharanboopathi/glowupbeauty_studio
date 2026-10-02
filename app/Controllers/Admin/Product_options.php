<?php

namespace App\Controllers\Beheerpaneel;
use App\Controllers\BaseController;
use App\Models\General_model;

class Product_options extends BaseController{
    public function __construct(){

    }

    public function index(){

    }

    public function manage(){
        if(!isAdmin())
            return redirect()->to(base_url('beheerpaneel/login'));
        else
        {
            $order_by='`id` DESC';
            $this->outputData['product_options'] = $this->general_model->fetch_data('product_options',NULL,$order_by);

            $this->admin_template('beheerpaneel/product_options/manage',$this->outputData);
        }
    }

    public function add(){
        if(!isAdmin())
        {
            return redirect()->to(base_url('beheerpaneel/login') );
        }

        // $options = $this->general_model->get_product_variants();
        // echo "<pre>";
        // print_r($options);
        // exit;
        if(!empty($this->request->getVar())){

            // print_r($this->request->getPost());
			// 		exit;

            // Get user-entered data
            $previousInput = $this->request->getPost();

            // Store the user-entered data in session flash data
            $this->session->setFlashdata('previousInput', $previousInput);
            $validation = \Config\Services::validation();
            $input = $this->validate([
                'optionname' => [
                    'label' => getlang("name"),
                    'rules' => 'trim|required',
                    'errors' => [
                        'required' => '{field} '.getlang('field_is_required').'.',
                    ],
                ],
                'option_name' => [
                    'label' => getlang("options_name"),
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} '.getlang('field_is_required').'.',
                    ],
                ],
            ]);
            
            if (!$input) {
                $errors = $validation->getErrors();
                $errorString = implode('<br>', $errors);
                $this->session->setFlashdata('error', $errorString);

                return redirect()->to('beheerpaneel/product_options/add');
                exit;
            }

            
            $product_options_data = array(
                'optionname'=>$this->request->getPost('optionname'),
                'description'=>$this->request->getPost('description'),
                'optionstatus'=>$this->request->getVar('optionstatus'),
                'display_on_product' => $this->request->getVar('display_on_product'),
                'field_type'=>$this->request->getPost('field_type'),
               
            );

            $product_options_id = $this->general_model->insert_data('product_options',$product_options_data);

            $productOptionsName = $this->request->getPost('option_name');
            $productOptionsPrice = $this->request->getPost('options_price');
            $productOptionsStatus = $this->request->getPost('option_status');

            for ($key = 0; $key < count($_FILES['oimage']['name']); $key++) {
                $productOptionsData = [
                    'product_options_id' => $product_options_id,
                    'name' => $productOptionsName[$key],
                    'price' => !empty($productOptionsPrice[$key])? $productOptionsPrice[$key] : 0,
                    'status' => $productOptionsStatus[$key],
                ];
        
                if ($_FILES['oimage']['error'][$key] === UPLOAD_ERR_OK) {
                    $imageName = $_FILES['oimage']['name'][$key];
                
                    $timestamp = time(); 
                
                    $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                
                    $newFileName = $timestamp.'_'.$imageName;
                
                    $destinationPath = FCPATH . 'uploads/product_options/';
                
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                
                    move_uploaded_file($_FILES['oimage']['tmp_name'][$key], $destinationPath . $newFileName);
                
                    $productOptionsData['image'] = $newFileName;
                }
                $this->general_model->insert_data('product_options_variants', $productOptionsData);
            }

            $this->session->setFlashdata('adminsuccess', getlang('Productopties zijn succesvol aangemaakt'));
            return redirect()->to('beheerpaneel/product_options/manage');
            exit;
        }
        $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
        $this->outputData['option_detail'] = $this->general_model->fetch_data('options');
        // $this->admin_template('beheerpaneel/product/add',$this->outputData);
        $this->outputData['previousInput'] =  $previousInput = $this->session->getFlashdata('previousInput');
        $this->admin_template('beheerpaneel/product_options/add',$this->outputData);
    }

    public function edit($id){
        if(!isAdmin())
            return redirect()->to(base_url('beheerpaneel/login') );
        else
        $product_options_data = $this->general_model->fetch_data('product_options',array('id'=>$id));
        if(empty($product_options_data))
        {
            return redirect()->to('beheerpaneel/product_options/manage');
        }
        if(!empty($this->request->getVar())){

            // echo "<pre>";
            // print_r($this->request->getPost());
            // exit;
           
            $product_options_data = array(
                'optionname'=>$this->request->getPost('optionname'),
                'description'=>$this->request->getPost('description'),
                'optionstatus'=>$this->request->getVar('optionstatus'),
                'display_on_product' => $this->request->getVar('display_on_product'),
                'field_type'=>$this->request->getPost('field_type'),
                
            );

            $product_options_id = $this->general_model->update_data('product_options',$product_options_data,$id);

            $productOptionsName = $this->request->getPost('option_name');
            $productOptionsPrice = $this->request->getPost('options_price');
            $productOptionsStatus = $this->request->getPost('option_status');
            $productOptionsVariantID = $this->request->getPost('prod_option_variant');



            for ($key = 0; $key < count($productOptionsVariantID); $key++) {
                $productOptionsData = [
                    'product_options_id' => $id,
                    'name' => $productOptionsName[$key],
                    'price' => !empty($productOptionsPrice[$key])?$productOptionsPrice[$key]: 0,
                    'status' => $productOptionsStatus[$key],
                ];

                
                if ($_FILES['oimage']['error'][$key] === UPLOAD_ERR_OK) {
                    $imageName = $_FILES['oimage']['name'][$key];
                
                    $timestamp = time(); 
                
                    $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                
                    $newFileName = $timestamp.'_'.$imageName;
                
                    $destinationPath = FCPATH . 'uploads/product_options/';
                
                    if (!is_dir($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                
                    move_uploaded_file($_FILES['oimage']['tmp_name'][$key], $destinationPath . $newFileName);
                
                    $productOptionsData['image'] = $newFileName;
                }
                else{
                    $newFileName = $this->general_model->fetch_data('product_options_variants',array('id'=>$productOptionsVariantID[$key]));
                    if(!empty($newFileName)){
                        $productOptionsData['image'] = $newFileName[0]->image;
                    }
                }
             
        
                $this->general_model->delete_condition('product_options_variants',array('id'=>$productOptionsVariantID[$key]));
                $this->general_model->insert_data('product_options_variants', $productOptionsData);
            }

            $this->session->setFlashdata('adminsuccess', getlang('Productopties zijn succesvol bijgewerkt'));
            return redirect()->to('beheerpaneel/product_options/manage');
            exit;
            
        }
        $this->outputData['category_detail'] = $this->general_model->fetch_data('category');
        $this->outputData['product_options_details'] = $this->general_model->fetch_data('product_options',array('id'=>$id));
        $this->outputData['product_options_variants_data'] = $this->general_model->fetch_data('product_options_variants',array('product_options_id'=>$id));
        $this->admin_template('beheerpaneel/product_options/edit',$this->outputData);
    }

    public function delete($id){
        if(!isAdmin())
        {
            return redirect()->to(base_url('beheerpaneel/login') );
        }

        $id=$this->request->uri->getSegment(4);
        $this->general_model->delete_data('product_options',$id);
        $this->general_model->delete_condition('product_options_variants',array('product_options_id'=>$id));
        return redirect()->to('beheerpaneel/product_options/manage');
    }


    public function delete_varaints($optionid,$product_id){
        if(!isAdmin())
        {
            return redirect()->to(base_url('beheerpaneel/login') );
        }

        $this->general_model->delete_condition('product_options_with_product',array('option_id'=>$optionid,'product_id'=>$product_id));
        $this->general_model->delete_condition('product_options_variants_with_product',array('product_id'=>$product_id,'option_id'=>$optionid));
        return redirect()->to('beheerpaneel/product/edit/'.$product_id);
        exit;
    }

    public function select_varaints($option_id,$product_id)
    {
        $check_options = $this->general_model->fetch_data('product_options',array('id'=>$option_id));
        if(empty($check_options))
        {
            return redirect()->to('beheerpaneel/product/manage');
        }

        $check_product = $this->general_model->fetch_data('product',array('id'=>$product_id));
        if(empty($check_product))
        {
            return redirect()->to('beheerpaneel/product/manage');
        }

        if($this->request->getPost())
        {
            // echo "<pre>";
            // print_r($this->request->getPost());
            // exit;

            $productselected_option_id = $this->request->getPost('productoptionid');

            if(!empty($productselected_option_id))
            {   
                $product_options_data = array(
                    'optionname'=>$this->request->getPost('optionname'),
                    'description'=>$this->request->getPost('description'),
                    'optionstatus'=>$this->request->getVar('optionstatus'),
                    'display_on_product' => $this->request->getVar('display_on_product'),
                    'field_type'=>$this->request->getPost('field_type'),
                    'product_id'=>$this->request->getPost('product_id'),
                    'option_id'=>$this->request->getPost('product_option_id'),
                    
                );
    
                $product_options_id = $this->general_model->update_data('product_options_with_product',$product_options_data,$productselected_option_id);
    
                $productOptionsName = $this->request->getPost('option_name');
                $productOptionsPrice = $this->request->getPost('options_price');
                $productOptionsQuantity = $this->request->getPost('options_quantity');
                $productOptionsColor = $this->request->getPost('options_color_code');
                $productOptionsStatus = $this->request->getPost('option_status');
                $productOptionsVariantID = $this->request->getPost('prod_option_variant');
                
    
    
    
                for ($key = 0; $key < count($productOptionsName); $key++) {
                    $productOptionsData = [
                        'product_options_id' => $productselected_option_id,
                        'name' => $productOptionsName[$key],
                        'price' => !empty($productOptionsPrice[$key])?$productOptionsPrice[$key]: 0,
                        'quantity' => !empty($productOptionsQuantity[$key])?$productOptionsQuantity[$key]:0,
                        'color_code' => !empty($productOptionsColor[$key])?$productOptionsColor[$key]:0,
                        'status' => $productOptionsStatus[$key],
                        'product_id'=>$this->request->getPost('product_id'),
                        'option_id'=>$this->request->getPost('product_option_id'),
                    ];
    
                    
                    if ($_FILES['oimage']['error'][$key] === UPLOAD_ERR_OK) {
                        $imageName = $_FILES['oimage']['name'][$key];
                    
                        $timestamp = time(); 
                    
                        $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                    
                        $newFileName = $timestamp.'_'.$imageName;
                    
                        $destinationPath = FCPATH . 'uploads/product_options/';
                    
                        if (!is_dir($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                    
                        move_uploaded_file($_FILES['oimage']['tmp_name'][$key], $destinationPath . $newFileName);
                    
                        $productOptionsData['image'] = $newFileName;
                    }
                    else{

                        if(!empty($productOptionsVariantID[$key]))
                        {   
                            $newFileName = $this->general_model->fetch_data('product_options_variants_with_product',array('id'=>$productOptionsVariantID[$key]));
                            if(!empty($newFileName)){
                                $productOptionsData['image'] = $newFileName[0]->image;
                            }
                        }else{
                            $productOptionsData['image'] = '';
                        }
                        
                    }
                 
                    if(!empty($productOptionsVariantID[$key]))
                    {
                        $this->general_model->delete_condition('product_options_variants_with_product',array('id'=>$productOptionsVariantID[$key]));
                    }
                    
                    $this->general_model->insert_data('product_options_variants_with_product', $productOptionsData);
                }

            }else {
                $product_options_data = array(
                    'optionname'=>$this->request->getPost('optionname'),
                    'description'=>$this->request->getPost('description'),
                    'optionstatus'=>$this->request->getVar('optionstatus'),
                    'display_on_product' => $this->request->getVar('display_on_product'),
                    'field_type'=>$this->request->getPost('field_type'),
                    'product_id'=>$this->request->getPost('product_id'),
                    'option_id'=>$this->request->getPost('product_option_id'),
                    
                );
                $product_options_id = $this->general_model->insert_data('product_options_with_product',$product_options_data);
    
                $productOptionsName = $this->request->getPost('option_name');
                $productOptionsPrice = $this->request->getPost('options_price');
                $productOptionsQuantity = $this->request->getPost('options_quantity');
                $productOptionsColor = $this->request->getPost('options_color_code');
                $productOptionsStatus = $this->request->getPost('option_status');
                $productOptionsVariantID = $this->request->getPost('prod_option_variant');
    
    
    
                for ($key = 0; $key < count($productOptionsName); $key++) {
                    $productOptionsData = [
                        'product_options_id' => $product_options_id,
                        'name' => $productOptionsName[$key],
                        'price' => !empty($productOptionsPrice[$key])?$productOptionsPrice[$key]: 0,
                        'quantity' => !empty($productOptionsQuantity[$key])?$productOptionsQuantity[$key]: 0,
                        'color_code' => !empty($productOptionsColor[$key])?$productOptionsColor[$key]: 0,
                        'status' => $productOptionsStatus[$key],
                        'product_id' => $this->request->getPost('product_id'),
                        'option_id'=>$this->request->getPost('product_option_id'),
                    ];
    
                    
                    if ($_FILES['oimage']['error'][$key] === UPLOAD_ERR_OK) {
                        $imageName = $_FILES['oimage']['name'][$key];
                    
                        $timestamp = time(); 
                    
                        $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);
                    
                        $newFileName = $timestamp.'_'.$imageName;
                    
                        $destinationPath = FCPATH . 'uploads/product_options/';
                    
                        if (!is_dir($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                    
                        move_uploaded_file($_FILES['oimage']['tmp_name'][$key], $destinationPath . $newFileName);
                    
                        $productOptionsData['image'] = $newFileName;
                    }
                    else{
                        if(!empty($productOptionsVariantID[$key]))
                        {   
                            $newFileName = $this->general_model->fetch_data('product_options_variants',array('id'=>$productOptionsVariantID[$key]));
                            if(!empty($newFileName)){
                                $productOptionsData['image'] = $newFileName[0]->image;
                            }
                        }else{
                            $productOptionsData['image'] = '';
                        }
                        
                    }
                 
            
                    // $this->general_model->delete_condition('product_options_variants_with_product',array('id'=>$productOptionsVariantID[$key]));
                    $this->general_model->insert_data('product_options_variants_with_product', $productOptionsData);
                }
            }
            

            $this->session->setFlashdata('adminsuccess', getlang('Productopties zijn succesvol bijgewerkt'));
            return redirect()->to('beheerpaneel/product/edit/'.$product_id);
            exit;
        }

        $get_product_options_variants = $this->general_model->fetch_data('product_options_variants',array('product_options_id'=>$option_id));

        $this->outputData['product_options_variants_data'] = $get_product_options_variants;
        $this->outputData['product_options_data'] = $check_options;
        $this->outputData['product_data'] = $check_product;

        //Checking product variant already choosen data

        $get_choosen_product_options = $this->general_model->fetch_data('product_options_with_product',array('product_id'=>$product_id,'option_id'=>$option_id));
        if(!empty($get_choosen_product_options)){
            $get_choosen_product_option_variants = $this->general_model->fetch_data('product_options_variants_with_product',array('product_id'=>$product_id,'product_options_id'=>$get_choosen_product_options[0]->id));
            $this->outputData['product_options_data_with_product'] = $get_choosen_product_options;
            $this->outputData['product_options_variants_data_with_product'] = $get_choosen_product_option_variants;
        }
        
        

        $this->admin_template('beheerpaneel/product_options/select_variant',$this->outputData);


    }
}

?>