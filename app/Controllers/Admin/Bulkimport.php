<?php 
	
	namespace App\Controllers\Beheerpaneel;
	use App\Controllers\BaseController;
	use App\Models\General_model;

	class Bulkimport extends BaseController 
	{
		public function __construct() {
			
			
		}

		function add(){
			if(!isAdmin())
				return redirect()->to(base_url(ADMIN_URL.'/login') );
			else
                    // $input = $this->validate([
                    //     'file' => 'uploaded[file]|max_size[file,2048]'
                    // ]);
                    // if (!$input) {
					// 	$errors = $validation->getErrors();
					// 	$errorString = implode('<br>', $errors);
					// 	$this->session->setFlashdata('error', $errorString);

					// 	return redirect()->to('beheerpaneel/bulkimport/add');
					// 	exit;
					// }else{
                        if($file = $this->request->getFile('uploadFile')) {
                            if ($file->isValid() && ! $file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move('uploads/csvfile', $newName);
                            $file = fopen("uploads/csvfile/".$newName,"r");
                            $i = 0;
                            $numberOfFields = 18;
                            $csvArr = array();

                            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                                $num = count($filedata);
                                if($i > 0 && $num == $numberOfFields){ 
                                    $csvArr[$i]['product_name'] = $filedata[0];
                                    $csvArr[$i]['quantity'] = $filedata[1];
                                    $csvArr[$i]['regular_price'] = $filedata[2];
                                    $csvArr[$i]['offer_price'] = $filedata[3];
                                    $csvArr[$i]['product_image'] = $filedata[4];
                                    $csvArr[$i]['category'] = $filedata[5];
                                    $csvArr[$i]['shortdesc'] = $filedata[6];
                                    $csvArr[$i]['product_info'] = $filedata[7];
                                    $csvArr[$i]['product_url'] = $filedata[8];
                                    $csvArr[$i]['status'] = $filedata[9];
                                    $csvArr[$i]['bestseller'] = $filedata[10];
                                    $csvArr[$i]['product_sku'] = $filedata[11];
                                    $csvArr[$i]['meta_title'] = $filedata[12];
                                    $csvArr[$i]['meta_description'] = $filedata[13];
                                    $csvArr[$i]['meta_keyword'] = $filedata[14];
                                    $csvArr[$i]['additional_info'] = $filedata[15];
                                    $csvArr[$i]['accesorries_products_list'] = $filedata[16];
                                    $csvArr[$i]['vat'] = $filedata[17];
                                }
                                $i++;
                            }
                            fclose($file);
                            $count = 0;
                           
                                foreach($csvArr as $userdata){
                                    if(empty($userdata['category'])){
                                        $this->flash_error(getlang("category field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add');
                                        exit;
                                    }
                                    if(empty($userdata['product_name'])){
                                        $this->flash_error(getlang("product_name field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add');
                                        exit;
                                    }
                                    if(empty($userdata['product_sku'])){
                                        $this->flash_error(getlang("product_sku field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add');
                                        exit;
                                    }
                                    if(empty($userdata['quantity'])){
                                        $this->flash_error(getlang("stock_field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add'); 
                                        exit;
                                    }
                                    if(empty($userdata['regular_price'])){
                                        $this->flash_error(getlang("regular_price field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add');
                                        exit;
                                    }

                                    // if(empty($userdata['offer_price'])){
                                    //     $this->flash_error(getlang("offer_price field_is_required"),$newName);
                                    //     return redirect()->to('beheerpaneel/bulkimport/add');
                                    //     exit;
                                    // }

                                    if(empty($userdata['product_url'])){
                                        $this->flash_error(getlang("product_url field_is_required"),$newName);
                                        return redirect()->to(ADMIN_URL.'/bulkimport/add');
                                        exit;
                                    }

                                    
                                    $findRecord = $this->general_model->fetch_data('product',array('product_sku'=>$userdata['product_sku']));
                                    if(!empty($findRecord)){

                                        $update_values = array(
                                            'pname' => $userdata['product_name']?$userdata['product_name']:$findRecord[0]->pname,
                                            'quantity' => $userdata['quantity']?$userdata['quantity']:$findRecord[0]->quantity,
                                            'rprice' => $userdata['regular_price']?$userdata['regular_price']:$findRecord[0]->rprice,
                                            'regoffprice' => $userdata['offer_price']?$userdata['offer_price']:$findRecord[0]->regoffprice,
                                            'product_sku' => $userdata['product_sku']?$userdata['product_sku']:$findRecord[0]->product_sku,
                                            'cat_id' =>$userdata['category']?$userdata['category']:$findRecord[0]->cat_id,
                                            'pinfo' => $userdata['product_info']?$userdata['product_info']:$findRecord[0]->pinfo,
                                            'additional_info' => $userdata['additional_info']?$userdata['additional_info']:$findRecord[0]->additional_info,
                                            'shortdesc' => $userdata['shortdesc']?$userdata['shortdesc']:$findRecord[0]->shortdesc,
                                            'slug' => str_replace(" ","-",$userdata['product_url'])?$userdata['product_url']:$findRecord[0]->slug,
                                            'is_sale' => ($userdata['bestseller']) ? $userdata['bestseller'] :$findRecord[0]->is_sale,
                                            'status' => ($userdata['status']) ? $userdata['status'] :$findRecord[0]->status,
                                            'vat' => ($userdata['vat']) ? $userdata['vat'] :$findRecord[0]->vat,
                                            'auser_id' => $this->session->get('admin_id'),
                                            'pimage' => $userdata['product_image']? trim($userdata['product_image'], ',') : $findRecord[0]->pimage,
                                            'mod_at' => date('Y-m-d H:i:s'),
                                            'meta_title' => $userdata['meta_title']?$userdata['meta_title']:$findRecord[0]->meta_title,
                                            'meta_desc' =>$userdata['meta_description']?$userdata['meta_description']:$findRecord[0]->meta_desc,
                                            'meta_keyword' => $userdata['meta_keyword']?$userdata['meta_keyword']:$findRecord[0]->meta_keyword,
                                            'accesorries_products_list'=>$userdata['accesorries_products_list']?$userdata['accesorries_products_list']:$findRecord[0]->accesorries_products_list,
                                        );
                                        
                                        $res=$this->general_model->update_data('product',$update_values,$findRecord[0]->id);

                                        $this->general_model->delete_condition('product_categories',array('product_id'=>$findRecord[0]->id));

                                        $category_id = explode(',',$userdata['category']);
                                        foreach($category_id as $cat_id){

                                            $insert_cat_values = array(
                                                'product_id' => $findRecord[0]->id,
                                                'category_id' => $cat_id
                                            );
                                            $this->general_model->insert_data('product_categories',$insert_cat_values);
                                        }

                                        $this->general_model->delete_condition('product_image',array('product_id'=>$findRecord[0]->id));
                                        $product_images = explode(',',$userdata['product_image']);
                                        foreach($product_images as $file)
                                        {
                                            $insert_productimage_values = array(
                                                'product_id' => $findRecord[0]->id,
                                                'image' => $file,
                                                'position' => 0,
                                            );
                                            $this->general_model->insert_data('product_image',$insert_productimage_values);
                                        }
                                       
                                    }else{
                                        $insert_values = array(
                                            'pname' => $userdata['product_name'],
                                            'quantity' => $userdata['quantity'],
                                            'rprice' => $userdata['regular_price'],
                                            'regoffprice' => $userdata['offer_price'],
                                            'product_sku' => $userdata['product_sku'],
                                            'cat_id' =>$userdata['category'],
                                            'pinfo' => $userdata['product_info'],
                                            'additional_info' => $userdata['additional_info'],
                                            'shortdesc' => $userdata['shortdesc'],
                                            'slug' => str_replace(" ","-",$userdata['product_url']),
                                            'status' => ($userdata['status']) ? $userdata['status'] : 0,
                                            'is_sale' => ($userdata['bestseller']) ? $userdata['bestseller'] : 0,
                                            'vat' => ($userdata['vat']) ? $userdata['vat'] :0,
                                            'auser_id' => $this->session->get('admin_id'),
                                            'pimage' => $userdata['product_image']? trim($userdata['product_image'], ',') : '',
                                            'meta_title' => $userdata['meta_title'],
                                            'meta_desc' =>$userdata['meta_description'],
                                            'meta_keyword' => $userdata['meta_keyword'],
                                            'accesorries_products_list'=>$userdata['accesorries_products_list'],
                                        );
                                        $product_id=$this->general_model->insert_data('product',$insert_values);
                                        $category_id = explode(',',$userdata['category']);
                                        foreach($category_id as $cat_id){

                                            $insert_cat_values = array(
                                                'product_id' => $product_id,
                                                'category_id' => $cat_id
                                            );
                                            $this->general_model->insert_data('product_categories',$insert_cat_values);
                                        }

                                        $product_images = explode(',',$userdata['product_image']);
                                        foreach($product_images as $file)
                                        {
                                            $insert_productimage_values = array(
                                                'product_id' => $product_id,
                                                'image' => $file,
                                                'position' => 0,
                                            );
                                            $this->general_model->insert_data('product_image',$insert_productimage_values);
                    
                                        }
                                    }
                                    if(!empty($product_id)){
                                        $count++;
                                    }
                                }
                                $this->file_unlink($newName); 
                            }
                                $this->session->setFlashdata('Success_message', $count. getlang("rijen zijn succesvol toegevoegd of bijgewerkt"));
                            return redirect()->to(ADMIN_URL.'/bulkimport/add');                        
                        }
			$this->admin_template('beheerpaneel/bulkimport/add',$this->outputData);
		}

        function file_unlink($newName){
            if(file_exists(FCPATH.'/uploads/csvfile/'.$newName)){
                unlink(FCPATH . '/uploads/csvfile/' . $newName);
            }
        }

        function flash_error($message,$newName){
            $this->session->setFlashdata('error', $message);
            $this->file_unlink($newName);
        }

	}