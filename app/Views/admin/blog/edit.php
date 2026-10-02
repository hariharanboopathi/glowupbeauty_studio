<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("edit");?> <?=getlang("news");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url()?>/beheerpaneel/blog/manage" class="btn btn-primary"><span><?=getlang("back_to_news");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url('nieuws'.'/'.$blog_data[0]->burl); ?>" target="_blank" class="btn btn-primary"><span><?=getlang("preview");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url()?>/beheerpaneel/blog/manage" class="btn btn-icon btn-primary"><?=getlang("back_to_news");?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->


                <?php echo form_open_multipart("beheerpaneel/blog/edit/".$uri->getSegment(4),array('id'=>'blogeditform'))?>
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="card">
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                            <input type="text" name="bname" class="page_input_title form-control" id="default-01" value="<?php echo $blog_data[0]->bname;?>" placeholder="<?=getlang("news_name");?>"> 
                                        </div>
                                        <div class="nk-editor-tools d-none d-xl-flex">
                                            <ul class="d-inline-flex gx-3">
                                                <li>
                                                    <button class="btn btn-md btn-primary rounded-pill" type="submit"> Save </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-editor-main">
                                        <div class="nk-editor-base">
                                            <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#meta">Meta</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-0">
                                                <div class="tab-pane fade show active" id="general">

                                                    <div class="form-group">    
                                                        <label class="form-label" for="default-04"><?=getlang("news_url");?></label>    
                                                        <div class="form-control-wrap">        
                                                            <input type="text" name="burl" value="<?php echo $blog_data[0]->burl;?>" class="form-control" id="default-04" >    
                                                        </div>
                                                    </div> 
                                                    <!--                                                     
                                                    <div class="form-group">    
                                                        <label class="form-label" for="default-04"><?=getlang("date");?></label>    
                                                        <div class="form-control-wrap">        
                                                        <div class="form-icon form-icon-left">
                                                                                        <em class="icon ni ni-calendar"></em>
                                                                                    </div>    
                                                            <input type="text" name="bdate" value="<?php //echo date("d-m-Y",strtotime($blog_data[0]->bdate));?>" class="form-control date-picker" data-date-format="dd-mm-yyyy" id="default-04" >    
                                                        </div>
                                                    </div>  -->
                                                                    
                                                    <div class="form-group">
                                                        <label class="form-label"><?=getlang("image");?></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file" name="bimage" class="form-file-input" >
                                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <?php if($blog_data[0]->bimage){?>
                                                                    <img src="<?php echo !empty($blog_data[0]->bimage)?image_url('uploads/blog/'.$blog_data[0]->bimage):''; ?>" width="50%">
                                                                <?php }  else{?>
                                                                    <?php echo ""?>
                                                                <?php } ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label"><?=getlang("image");?></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file" name="bimage_lft" class="form-file-input" >
                                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <?php if($blog_data[0]->bimage_lft){?>
                                                                    <img src="<?php echo !empty($blog_data[0]->bimage_lft)?image_url('uploads/blog/'.$blog_data[0]->bimage_lft):''; ?>" width="50%">
                                                                <?php }  else{?>
                                                                    <?php echo ""?>
                                                                <?php } ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="form-label"><?=getlang("image");?></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file" name="bimage_ryt"  class="form-file-input" >
                                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <?php if($blog_data[0]->bimage_ryt){?>
                                                                    <img src="<?php echo !empty($blog_data[0]->bimage_ryt)?image_url('uploads/blog/'.$blog_data[0]->bimage_ryt):''; ?>" width="50%">
                                                                <?php }  else{?>
                                                                    <?php echo ""?>
                                                                <?php } ?>
                                                    </div>
                                                    <div class="form-group">    
                                                            <label class="form-label"><?=getlang("select_tags");?></label>    
                                                        <div class="form-control-wrap">   
                                                            <?php //$selected_accessories_product = explode(',',$blog_data[0]->accesorries_products_list);
                                                           $tagIds = array_map(function($item) {
                                                                return $item->tag_id;
                                                            }, $blog_tag_ids);
                                                            //print_r($blog_tag_ids);?>     
                                                            <select class="form-select js-select2" multiple name="tags[]">
                                                                <?php if(!empty($all_tags)) { foreach($all_tags as $all_t){ 
                                                                    //if($all_p->id !=$product_data[0]->id){?>
                                                                    <option value="<?=$all_t->id?>" 
                                                                        <?php if(in_array($all_t->id,$tagIds)){ echo "selected";}?>>
                                                                        <?php echo $all_t->title;?>
                                                                    </option>
                                                                <?php }  } 
                                                            //}?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                </div><!-- .tab-pane -->
                                                <div class="tab-pane fade" id="meta">

                                                <div class="form-group">    
                                                    <label class="form-label" for="default-02"><?=getlang("meta_title");?></label>    
                                                    <div class="form-control-wrap">        
                                                        <textarea type="text" name="meta_title" style="resize:none;" class="form-control" id="default-02" placeholder="<?=getlang("meta_title");?>"><?php echo $blog_data[0]->meta_title;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-03"><?=getlang("meta_description");?></label>    
                                                    <div class="form-control-wrap">        
                                                        <textarea type="text" name="meta_desc" style="resize:none;" class="form-control" id="default-03" placeholder="<?=getlang("meta_description");?>"><?php echo $blog_data[0]->meta_desc;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                                    <div class="form-control-wrap">        
                                                        <textarea type="text" name="meta_keyword" style="resize:none;" class="form-control" id="default-04" placeholder="<?=getlang("meta_keyword");?>"><?php echo $blog_data[0]->meta_keyword;?></textarea>
                                                    </div>
                                                </div>
                                                     
                                                </div><!-- .tab-pane -->
                                            </div><!-- .tab-content -->
                                        </div><!-- .nk-editor-base -->
                                        <div class="nk-editor-body" style="width:500px;">
                                            <div class="spc_dt"> <label class=""><?=getlang("Korte beschrijving voor de startpagina");?> 1</label> </div>
                                            <div>
                                                <textarea name="bdesc" class="summernote-basic"><?php echo $blog_data[0]->bdesc ?></textarea>
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 1</label> </div>
                                            <div>
                                                <textarea name="bdesc1" class="summernote-basic"><?php echo $blog_data[0]->bdesc1 ?></textarea>
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 2</label> </div>
                                            <div>
                                                <textarea name="bdesc2" class="summernote-basic"><?php echo $blog_data[0]->bdesc2 ?></textarea>
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("titel");?> 1</label> </div>
                                            <div class="nk-editor-title">
                                                <input type="text" name="title1" class="page_input_title form-control" id="default-01" value="<?php echo $blog_data[0]->title1;?>" placeholder="<?=getlang("news_name");?>"> 
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 3</label> </div>
                                            <div>
                                                <textarea name="bdesc3" class="summernote-basic"><?php echo $blog_data[0]->bdesc3 ?></textarea>
                                            </div>
                                            <div class="spc_dt"><label class=""><?=getlang("titel");?> 2</label> </div>
                                            <div class="nk-editor-title">
                                                <input type="text" name="title2" class="page_input_title form-control" id="default-01" value="<?php echo $blog_data[0]->title2;?>" placeholder="<?=getlang("news_name");?>"> 
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 4</label> </div>
                                            <div>
                                                <textarea name="bdesc4" class="summernote-basic"><?php echo $blog_data[0]->bdesc4 ?></textarea>
                                            </div>
                                            <div class="spc_dt"><label class=""><?=getlang("titel");?> 3</label> </div>
                                            <div class="nk-editor-title">
                                                <input type="text" name="title3" class="page_input_title form-control" id="default-01" value="<?php echo $blog_data[0]->title3;?>" placeholder="<?=getlang("news_name");?>"> 
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 5</label> </div>
                                            <div>
                                                <textarea name="bdesc5" class="summernote-basic"><?php echo $blog_data[0]->bdesc5 ?></textarea>
                                            </div>
                                            <div class="spc_dt"><label class=""><?=getlang("titel");?> 4</label> </div>
                                            <div class="nk-editor-title">
                                                <input type="text" name="title4" class="page_input_title form-control" id="default-01" value="<?php echo $blog_data[0]->title4;?>" placeholder="<?=getlang("news_name");?>"> 
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("Inhoud");?> 6</label> </div>
                                            <div>
                                                <textarea name="bdesc6" class="summernote-basic"><?php echo $blog_data[0]->bdesc6 ?></textarea>
                                            </div>
                                            <div class="spc_dt"> <label class=""><?=getlang("opmerking");?> 1</label> </div>
                                            <div>
                                                <textarea name="bcomment" class="summernote-basic"><?php echo $blog_data[0]->bcomment ?></textarea>
                                            </div>
                                        </div><!-- .nk-editor-body -->
                                    </div><!-- .nk-editor-main -->
                                </div><!-- .nk-editor -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>                                                     

                 
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->	

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#blogeditform").validate({ 
	rules: { 
        bname: {
            required: true,            
         },
         burl: {
         	required: true,
         }
      }
});

</script>
<?php echo minifier('summernote.min.css'); ?>
<?php echo minifier('summernote.min.js'); ?>
<script>
   let summernoteOptions = {
        height: 700
    }
    $('.summernote-basic').summernote(summernoteOptions);
</script>