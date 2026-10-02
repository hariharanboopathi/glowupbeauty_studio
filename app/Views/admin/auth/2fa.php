<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="./././">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <?php 
        $general_model = new App\Models\General_model();
        $session = \Config\Services::session();
		$favicon = $general_model->fetch_data('settings',array('code'=>'FAVICON'))[0]->value;
		if($favicon){
	?>
	<link rel="icon" href="<?=base_url('uploads/favicon').'/'.$favicon?>">
	<?php } ?>
    <!-- Page Title  -->
    <title><?=getlang("adminpanel");?> | <?=getlang("login");?></title>
    <!-- StyleSheets  -->
    <link href="<?php echo base_url(); ?>/assets/admin_new/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin_new/css/boeskool.css?ver=3.2.2">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url();?>/assets/admin_new/css/theme.css?ver=3.2.2">
</head>

<body class="nk-body ui-rounder npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-lg">
                        <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="brand-logo pb-5">
                                        <?php 
                                        $slogo      = $general_model->fetch_data('settings',array('code'=>'SLOGO'));
                                        $amvlogo      = $general_model->fetch_data('settings',array('code'=>'AMVLOGO'));

                                        ?>
                                    <a href="<?php echo base_url(ADMIN_URL);?>" class="logo-link">
                                        <img class="logo-img logo-img-lg" src="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" srcset="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" alt="logo" style="background-color:black;">
                                        <img class="logo-dark logo-img logo-img-small" src="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" srcset="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title"><?=getlang("2fa_header_text");?></h5>
                                        
                                    </div>
                                </div><!-- .nk-block-head -->
                                <?php echo form_open_multipart(ADMIN_URL."/login/twofa",array('id'=>'2faform'))?>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email-address"><?=getlang("Code");?></label>
                                           
                                        </div>
                                        <div class="form-control-wrap">
                                            <input  name="code" type="text" id="code" class="form-control form-control-lg"  placeholder="<?=getlang("Code");?>" >
                                        </div>
                                    </div><!-- .form-group -->
                                    
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block"><?=getlang("submit");?></button>
                                        <a class="forget_btn" href="<?php echo base_url(ADMIN_URL.'/login/regenerate_twofa_code'); ?>"><?=getlang("resend_code");?></a>
                                    </div>
                                </form>
                                
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; <?=date('Y');?>. <a href="<?php echo base_url(ADMIN_URL);?>" target="_blank"><?=get_settings('site_name');?></a></p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                            <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                                <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                                    <div class="slider-item">
                                        <div class="nk-feature nk-feature-center">
                                            <?php $loginpage_logo=get_settings('loginpageimage');?>
                                            <?php $loginpage_text=get_settings('login_text');?>
                                            <?php if(!empty($loginpage_logo)){?>
                                            <div class="nk-feature-img">
                                                <img class="round" src="<?php echo image_url('uploads/logo/'.$loginpage_logo);?>" srcset="<?php echo image_url('uploads/logo/'.$loginpage_logo);?>" alt="Logo">
                                            </div>
                                            <?php } ?>
                                            <div class="nk-feature-content py-4 p-sm-5">
                                            <?php if(!empty($loginpage_text)){?>
                                                <?php echo $loginpage_text;?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div><!-- .slider-item -->
        </div>
        </div>
        </div>
                        <!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    
    

    <?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#2faform").validate({ 
	rules: { 
        code: {
            required: true,            
        },
        
    },

});

</script>

<script src="<?php echo base_url();?>/assets/admin_new/js/bundle.js?ver=3.2.2"></script>
    <script src="<?php echo base_url();?>/assets/admin_new/js/scripts.js?ver=3.2.2"></script>
    <script src="<?php echo base_url(); ?>/assets/admin_new/plugins/bower_components/toast-master/js/jquery.toast.js"></script>  


    <script>


 $(document).ready(function() {
   
<?php 
  $session = \Config\Services::session();
  if($session->getFlashdata('adminsuccess')){ ?>

  $.toast({
            heading: 'Success!',
            text: '<?php echo $session->getFlashdata('adminsuccess'); ?>',
            position: 'top-right',
            loaderBg: '#0c4170',
            icon: 'success',
            hideAfter: 5000,
            stack: 6
		
			});
   <?php } elseif($session->getFlashdata('error')){ ?>

 $.toast({
            heading: 'Error!',
            text: '<?php echo $session->getFlashdata('error'); ?>',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 5000,
            stack: 6
		
			});

  <?php } elseif($session->getFlashdata('Success_message')){ ?>
    $.toast({
            heading: 'Success!',
            text: '<?php echo $session->getFlashdata('Success_message'); ?>',
            position: 'top-right',
            loaderBg: '#0c4170',
            icon: 'success',
            hideAfter: 5000,
            stack: 6
		
			});

 <?php }?>
 }); 

</script>
    
		
</html>