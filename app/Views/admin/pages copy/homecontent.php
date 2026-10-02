<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("home_content");?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <!-- <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/manage" class="btn btn-primary"><span>Manage Pages</span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="#" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
						
                        <?php echo form_open_multipart("beheerpaneel/pages/homecontent",array('id'=>'homecontent'))?>
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 1</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".jpg,.png,.jpeg,.webp" name="image_1" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($homecontent[0]->image_1){?>
                                            <img src="<?php echo !empty($homecontent[0]->image_1)?image_url('uploads/homecontent/'.$homecontent[0]->image_1):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							</div>

							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 1</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_1" class="summernote-basic"><?php echo $homecontent[0]->content_1;?></textarea>   
                                </div>
                            </div>

							<!-- <div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 2</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".jpg,.png,.jpeg,.webp" name="image_2" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div> -->
							<!-- <div class="form-group">
                            <?php //if($homecontent[0]->image_2){?>
                                            <img src="<?php //echo !empty($homecontent[0]->image_2)?image_url('uploads/homecontent/'.$homecontent[0]->image_2):''; ?>" width="50%">
                                        <?php //}  else{?>
                                            <?php //echo ""?>
                                        <?php //} ?>
							</div> -->

							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 2</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_2" class="summernote-basic"><?php echo $homecontent[0]->content_2;?></textarea>   
                                </div>
                            </div>
							<!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 3</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_3" class="summernote-basic"><?php //echo $homecontent[0]->content_3;?></textarea>   
                                </div>
                            </div> -->


                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('product');?> <?=getlang('subtitle');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="product_subtitle" class="form-control" id="default-01" placeholder="<?=getlang('product');?> <?=getlang('subtitle');?>" value="<?php //echo $homecontent[0]->product_subtitle;?>">    
                                </div>
                            </div> -->

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("product");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="produt_cont" class="summernote-basic"><?php echo $homecontent[0]->produt_cont;?></textarea>   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("product");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="product_title" class="summernote-basic"><?php echo $homecontent[0]->product_title;?></textarea>   
                                </div>
                            </div>


                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('category');?> <?=getlang('subtitle');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="category_subtitle" class="form-control" id="default-01" placeholder="<?=getlang('category');?> <?=getlang('subtitle');?>" value="<?php //echo $homecontent[0]->category_subtitle;?>">    
                                </div>
                            </div> -->
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("category");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="category_title" class="summernote-basic"><?php echo $homecontent[0]->category_title;?></textarea>   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("category");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="category_cont" class="summernote-basic"><?php echo $homecontent[0]->category_cont;?></textarea>   
                                </div>
                            </div>
                            

                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('reviews');?> <?=getlang('title');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="review_title" class="form-control" id="default-01" placeholder="<?=getlang('reviews');?> <?=getlang('title');?>" value="<?php //echo $homecontent[0]->review_title;?>">    
                                </div>
                            </div> -->
<!-- 
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('reviews');?> <?=getlang('subtitle');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="review_subtitle" class="form-control" id="default-01" placeholder="<?=getlang('reviews');?> <?=getlang('subtitle');?>" value="<?php //echo $homecontent[0]->review_subtitle;?>">    
                                </div>
                            </div> -->

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("reviews");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="reviews_cont" class="summernote-basic"><?php echo $homecontent[0]->reviews_cont;?></textarea>   
                                </div>
                            </div>

                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('news');?> <?=getlang('subtitle');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="news_subtitle" class="form-control" id="default-01" placeholder="<?=getlang('news');?> <?=getlang('subtitle');?>" value="<?php //echo $homecontent[0]->news_subtitle;?>">    
                                </div>
                            </div> -->

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("news");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="news_cont" class="summernote-basic"><?php echo $homecontent[0]->news_cont;?></textarea>   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("news");?> <?=getlang("content");?></label>    
                                <div class="form-control-wrap">        
								<textarea name="news_title" class="summernote-basic"><?php echo $homecontent[0]->news_title;?></textarea>   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("Google Review Link");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="google_review_link"  class="form-control" id="default-02" value="<?php echo $homecontent[0]->google_review_link;?>">   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("Webwinkel Keur Link");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="webwinkelkeur_link"  class="form-control" id="default-02" value="<?php echo $homecontent[0]->webwinkelkeur_link;?>">   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("Feedback Company Link");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="feedback_company_link"  class="form-control" id="default-02" value="<?php echo $homecontent[0]->feedback_company_link;?>">   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("review_rating");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="review_rating"  class="form-control"  id="default-02" value="<?php echo $homecontent[0]->review_rating;?>">   
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("review_count");?></label>    
                                <div class="form-control-wrap">        
								<input type="text" name="review_count"  class="form-control" id="default-02" value="<?php echo $homecontent[0]->review_count;?>">   
                                </div>
                            </div>
							<!-- <div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 3</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".jpg,.png,.jpeg,.webp" name="image_3" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div> -->
							<!-- <div class="form-group">
                            <?php //if($homecontent[0]->image_3){?>
                                            <img src="<?php //echo !empty($homecontent[0]->image_3)?image_url('uploads/homecontent/'.$homecontent[0]->image_3):''; ?>" width="50%">
                                        <?php //}  else{?>
                                            <?php //echo ""?>
                                        <?php //} ?>
							</div>
							 -->
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
							</form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->


<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>