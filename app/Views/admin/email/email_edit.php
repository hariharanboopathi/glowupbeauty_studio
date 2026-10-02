<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('email');?></h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL) ?>/email/email_manage"
                                                    class="btn btn-primary"><span><?=getlang('manage');?> <?=getlang('email_template');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL) ?>/email/email_manage"
                                                    class="btn btn-icon btn-primary"><em class=""></em><?=getlang('manage');?> <?=getlang('email_template');?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $uri = current_url(true);?> 
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                            <?php echo form_open(ADMIN_URL."/email/email_edit/".$uri->getSegment(4), array('id' => 'email_editform')); ?> 
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('key');?></label>
                                <div class="form-control-wrap">

                                    <input type="text" name="key" class="form-control" value="<?php if (!empty($email_information[0]->key)) {
                                        echo $email_information[0]->key;
                                    } ?>" id="default-01" placeholder="<?=getlang('key');?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('From_Mail');?></label>
                                <div class="form-control-wrap">

                                    <input type="text" name="from_mail" class="form-control" value="<?php if (!empty($email_information[0]->from_mail)) {
                                        echo $email_information[0]->from_mail;
                                    } ?>" id="default-01" placeholder="<?=getlang('From_Mail');?>" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01"><?=getlang('CC_Mail');?></label>
                                <div class="form-control-wrap">

                                    <input type="text" name="cc_mail" class="form-control" value="<?php if (!empty($email_information[0]->cc_mail)) {
                                        echo $email_information[0]->cc_mail;
                                    } ?>" id="default-01" placeholder="<?=getlang('CC_Mail');?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-02"><?=getlang('subject');?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="subject" class="form-control" value="<?php if (!empty($email_information[0]->subject)) {
                                        echo $email_information[0]->subject;
                                    } ?>" id="default-02" placeholder="<?=getlang('subject');?>">
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="form-label" for="defa ult-03"><?=getlang('message');?></label>
                                <div class="form-control-wrap">
                                <textarea name='message' class="summernote-basic"><?php if (!empty($email_information[0]->message)) {
                                        echo $email_information[0]->message;
                                    } ?></textarea>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName1" class="control-label"><?=getlang('status');?></label>
                                <div class="radio radio-primary">
                                    <input type="radio" name="status" id="radio5" value="1" <?php if ($email_information[0]->status == '1') {
                                        echo "checked";
                                    } ?>>
                                    <label for="radio5"> <?=getlang('active');?> </label>
                                </div>
                                <div class="radio radio-primary">
                                    <input type="radio" name="status" id="radio5" value="0" <?php if ($email_information[0]->status == '0') {
                                        echo "checked";
                                    } ?>>
                                    <label for="radio5"> <?=getlang('inactive');?> </label>
                                </div>
                            </div>
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang('submit');?></button></div>
                        <?php echo form_close(); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#email_editform").validate({ 
	rules: { 
        key: {
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
      },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>