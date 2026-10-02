<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add')?> <?=getlang('page')?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/manage" class="btn btn-primary"><span><?=getlang('back_to_pages')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_pages')?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->

                <?php echo form_open_multipart("beheerpaneel/pages/add",array('id'=>'pageform'))?>
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="card">
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                        <input type="text" name="name" class="page_input_title form-control" id="default-01" placeholder="<?=getlang("page_name");?>" value="<?= old('name', $previousInput['name'] ?? ''); ?>">
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
                                                    <label class="form-label" for="fv-topics"><?=getlang('page_type')?></label>
                                                    <div class="form-control-wrap ">
                                                        <select class="form-select js-select2" id="fv-topics" name="ptype" data-placeholder="<?=getlang('select_type')?>" >
                                                        <option value=""><?=getlang('select_type')?></option>
                                                        <option value="0" <?= (old('ptype') === '0') ? 'selected' : '' ?>><?=getlang('dynamic_page')?></option>
                                                        <option value="1" <?= (old('ptype') === '1') ? 'selected' : '' ?>><?=getlang('static_page')?></option>                              
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-07"><?=getlang("page_url");?></label>    
                                                    <div class="form-control-wrap">        
                                                        <input type="text" name="pageurl" class="form-control page_url" id="default-07" placeholder="<?=getlang("page_url");?>" value="<?= old('pageurl', $previousInput['pageurl'] ?? ''); ?>">    
                                                    </div>
                                                </div>					
                                                <div class="form-group">
                                                    <label class="form-label"><?=getlang("image");?></label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" name="image" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                                            <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                                                <div class="form-group">
                                                                    
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="1" name="hmenu"  id="fv-com-email" <?= (old('hmenu') === '1') ? 'checked' : '' ?>>
                                                            <label class="custom-control-label" for="fv-com-email"><?=getlang("header_menu");?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="1" name="fmenu"  id="fv-com-phone" <?= (old('fmenu') === '1') ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="fv-com-phone"> <?=getlang("footer_menu");?></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="1" name="fmenu1"  id="fv-com-fmenu1" <?= (old('fmenu1') === '1') ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="fv-com-fmenu1"> <?=getlang("footer_menu");?>1</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" value="1" name="informatie"  id="fv-com-phone" <?= (old('informatie') === '1') ? 'checked' : '' ?>>
                                                        <label class="custom-control-label" for="fv-com-phone"> <?=getlang("Informatie");?></label>
                                                    </div>
                                                </div>
                                                    
                                                </div><!-- .tab-pane -->
                                                <div class="tab-pane fade" id="meta">

                                                    <div class="form-group">    
                                                        <label class="form-label" for="default-02"><?=getlang("meta_title");?></label>    
                                                        <div class="form-control-wrap">        
                                                            <textarea type="text" name="meta_title"  class="form-control" id="default-02" style="resize: none;" placeholder="<?=getlang("meta_title");?>" value="<?= old('meta_title', $previousInput['meta_title'] ?? ''); ?>"> </textarea>   
                                                        </div>
                                                    </div>
                                                    <div class="form-group">    
                                                        <label class="form-label" for="default-03"><?=getlang("meta_description");?></label>    
                                                        <div class="form-control-wrap">        
                                                            <textarea type="text" name="meta_desc"  class="form-control" id="default-03" style="resize: none;" placeholder="<?=getlang("meta_description");?>" value="<?= old('meta_desc', $previousInput['meta_desc'] ?? ''); ?>">    </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">    
                                                        <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                                        <div class="form-control-wrap">        
                                                            <textarea type="text" name="meta_keyword"  class="form-control" id="default-04" style="resize: none;" placeholder="<?=getlang("meta_keyword");?>" value="<?= old('meta_keyword', $previousInput['meta_keyword'] ?? ''); ?>">    </textarea>
                                                        </div>
                                                    </div>
                                                     
                                                </div><!-- .tab-pane -->
                                            </div><!-- .tab-content -->
                                        </div><!-- .nk-editor-base -->
                                        <div class="nk-editor-body" style="width:500px;">
                                        <textarea name="pcontent" class="summernote-basic"><?= old('pcontent', $previousInput['pcontent'] ?? ''); ?></textarea>
                                            
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
$("#pageform").validate({ 
	rules: { 
         name: {
            required: true,            
         },
         pageurl: {
         	required: true,
         },
         ptype: {
         	required: true,
         },
      },
//    messages: {
        // name: { required: 'Vraag is vereist.'},
		// pageurl: 	{ required: 'Antwoord is vereist.'},
		// ptype: { required: 'Sorteren is vereist.'},
		// }
});

</script> 
<?php echo minifier('summernote.min.css'); ?>
<script src="<?php echo base_url().'assets/admin_new/js/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/admin/js/bootstrap4.min.js'; ?>"></script>
<?php echo minifier('summernote.min.js'); ?>
<script>
let summernoteOptions = {
     height: 700
 }
 $('.summernote-basic').summernote(summernoteOptions);
</script>
