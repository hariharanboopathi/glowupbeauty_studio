<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <h3 class="nk-block-title page-title"><?=getlang('Email')?></h3>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card">
                                    <div class="card-inner card-inner-xl">
                                        <?php echo form_open_multipart(ADMIN_URL."/settings/email",array("id"=>'email'));?>
                                    

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("email");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="email" name="email" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->email; }?>" placeholder="<?=getlang("email");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("Sender_Name");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="text" name="sender_name" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->sender_name; }?>" placeholder="<?=getlang("Sender_Name");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                                            
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="1" name="mail_type"  <?php if(!empty($email) && $email[0]->mail_type){ ?> checked="checked" <?php } ?> id="fv-com-email" >
                                                    <label class="custom-control-label" for="fv-com-email"><?=getlang("Use-SMTP");?></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("SMTP_User_Name");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="text" name="smtp_username" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->smtp_username; }?>" placeholder="<?=getlang("SMTP_User_Name");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("SMTP_User_Host");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="text" name="smtp_host" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->smtp_host; }?>" placeholder="<?=getlang("SMTP_User_Host");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("SMTP_User_Password");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="text" name="smtp_password" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->smtp_password; }?>" placeholder="<?=getlang("SMTP_User_Password");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("SMTP_User_Port");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-control-wrap">        
                                                    <input type="text" name="smtp_port" class="form-control" id="default-01" value="<?php if(!empty($email)){ echo $email[0]->smtp_port; }?>" placeholder="<?=getlang("SMTP_User_Port");?>">    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
                                        </form>
                                        
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div><!-- .card-inner -->
                        <?php echo view('beheerpaneel/settings/settingstableftmenu');?>
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#email").validate({ 
	rules: { 
        email: {
            required: true,            
        },
        sender_name: {
            required: true,            
        },
		



    },

});

</script>