<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("contactus_content");?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
						<?php echo form_open_multipart("beheerpaneel/pages/contactuscontent",array('id'=>'contactuscontent'))?>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 1</label>
								<input type="text" name="contact_email"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->contact_email;?>">  
							</div>	

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("Company_Name");?></label>
								<input type="text" name="company_name"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->company_name;?>">  
							</div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("KVK");?></label>
								<input type="text" name="kvk"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->kvk;?>">  
							</div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("IBAN");?></label>
								<input type="text" name="iban"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->iban;?>">  
							</div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("BTW");?></label>
								<input type="text" name="btw"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->btw;?>">  
							</div>

							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("address");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="contact_address" class="summernote-basic"><?php echo $contactuscontent[0]->contact_address;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("telefoon");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="contact_telefoon"  class="form-control" id="default-02" value="<?php echo $contactuscontent[0]->contact_telefoon;?>">   
                                </div>
                            </div>
                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("openingstijden");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="openingstijden" class="summernote-basic"><?php echo $contactuscontent[0]->openingstijden;?></textarea>   
                                </div>
                            </div> -->
                            
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 1</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_1" class="summernote-basic"><?php echo $contactuscontent[0]->content_1;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 2</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_2" class="summernote-basic"><?php echo $contactuscontent[0]->content_2;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 3</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_3" class="summernote-basic"><?php echo $contactuscontent[0]->content_3;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 4</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_4" class="summernote-basic"><?php echo $contactuscontent[0]->content_4;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 1</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image_1" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($contactuscontent[0]->image_1){?>
                                            <img src="<?php echo !empty($contactuscontent[0]->image_1)?image_url('uploads/contactuscontent/'.$contactuscontent[0]->image_1):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							</div>

							
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
							</form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e --><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>