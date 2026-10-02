<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('Order_Status');?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL) ?>/orderstatuses/manage"
                                                    class="btn btn-primary"><span><?=getlang('manage');?> <?=getlang('Order_Status');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL) ?>/orderstatuses/manage"
                                                    class="btn btn-icon btn-primary"><em class=""></em><?=getlang('manage');?> <?=getlang('Order_Status');?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- <div class="nk-block-head-content text-center">
                        <h2 class="nk-block-title fw-normal">News Detail Page</h2>
                        <div class="nk-block-des">
                            <p class="lead">We love to share ideas! Visit our blog if you're looking for great articles or inspiration to get you going.</p>
                        </div>
                    </div> -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">

                            <?php echo form_open(ADMIN_URL."/orderstatuses/add/", array('id' => 'orderstatusesform')); ?> 
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('key');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="key" value="<?= old('key', $previousInput['key'] ?? ''); ?>" class="form-control" id="default-01"
                                        placeholder="<?=getlang('key');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('naam');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="name" value="<?= old('name', $previousInput['name'] ?? ''); ?>" class="form-control" id="default-01"
                                        placeholder="<?=getlang('naam');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('From_Mail');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="from_mail" value="<?= old('from_mail', $previousInput['from_mail'] ?? ''); ?>" class="form-control" id="default-01"
                                        placeholder="<?=getlang('From_Mail');?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('CC_Mail');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="cc_mail" value="<?= old('cc_mail', $previousInput['cc_mail'] ?? ''); ?>" class="form-control" id="default-01"
                                        placeholder="<?=getlang('CC_Mail');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-02"><?=getlang('subject');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="subject" value="<?= old('subject', $previousInput['subject'] ?? ''); ?>" class="form-control" id="default-02"
                                        placeholder="<?=getlang('subject');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label"><?=getlang('status');?></label>
                                <div class="radio radio-primary">
                                    <input type="radio" name="status" id="radio5" value="1" checked>
                                    <label for="radio5"> <?=getlang('active');?> </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="status" id="radio5" value="0">
                                    <label for="radio5"> <?=getlang('inactive');?> </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="defa ult-03"><?=getlang('message');?></label>
                                <div class="form-control-wrap">
                                <textarea name='message' class="summernote-basic"></textarea>
                                 </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('color');?></label>
                                <div class="form-control-wrap">
                                    <input type="color" name="color" value="<?= old('color', $previousInput['color'] ?? ''); ?>" class="form-control" id="default-01"
                                        placeholder="<?=getlang('color');?>">
                                </div>
                            </div>

                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang('submit');?></button></div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#orderstatusesform").validate({ 
	rules: { 
        key: {
            required: true,            
         },
         name: {
            required: true,            
         },
         subject: {
         	required: true,
         },
         message: {
         	required: true,
         },
         from_mail: {
         	required: true,
         },
         color: {
         	required: true,
         },
      },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>