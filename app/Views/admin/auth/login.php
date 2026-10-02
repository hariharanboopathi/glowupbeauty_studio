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
		$favicon = $general_model->fetch_data('settings',array('code'=>'FAVICON'))[0]->value;
		if($favicon){
	?>
	<link rel="icon" href="<?=base_url('uploads/favicon').'/'.$favicon?>">
	<?php } ?>
    <!-- Page Title  -->
    <title>Boeskool CMS | <?=getlang("login");?></title>
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
                                        $albanner      = $general_model->fetch_data('settings',array('code'=>'ALBANNER'));

                                        ?>
                                    <a href="<?php echo base_url(ADMIN_URL);?>" class="logo-link">
                                        <img class="logo-img logo-img-lg" src="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" srcset="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" alt="logo" style="background-color:black;">
                                        <img class="logo-dark logo-img logo-img-small" src="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" srcset="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title"><?=lang("general.logintoyouraccount");?></h5>
                                        
                                    </div>
                                </div><!-- .nk-block-head -->
                                <?php echo form_open_multipart(ADMIN_URL."/login",array('id'=>'loginform'))?>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email-address"><?=getlang("Email");?></label>
                                           
                                        </div>
                                        <div class="form-control-wrap">
                                            <input  name="login" type="email" id="login" class="form-control form-control-lg" id="email-address" placeholder="<?=getlang("Email");?>" >
                                        </div>
                                    </div><!-- .form-group -->
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label"  for="password"><?=getlang("password");?></label>
                                            <a class="link link-primary link-sm" tabindex="-1" href="<?php echo base_url('beheerpaneel/login/forgot_password'); ?>"><?=lang("general.forgot_password_link");?></a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg is-shown" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input autocomplete="new-password" name="pass" type="password" class="form-control form-control-lg"  id="passwordField" placeholder="Enter your passcode">
                                        </div>
                                    </div><!-- .form-group -->
                                    <?php if(get_settings('CAPTCHA')){?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label>
                                                <div class="captcha_blk" style="display: flex;align-items: center;">
                                                    <img src="" id="captchaimg">
                                                    <input type="number" pattern="[\d]*" inputmode="numeric" id="captcha" name="captcha" class="form-control" placeholder="Captcha" required>
                                                    <!-- <a href="javascript:void(0);" onclick="refreshCaptcha('loginform');" class="refreshCaptcha">Klik hier</a> -->
                                                    
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block"><?=getlang("Login");?></button>
                                     </div>
                                </form>
                                
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; <?=date('Y');?>. <a href="<?php echo base_url(ADMIN_URL);?>" target="_blank"><?=get_settings('site_name');?></a></p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->

                   
                        <div style="background:url(<?php if(!empty($albanner[0]->value)){echo image_url('uploads/logo/'.$albanner[0]->value);}?>) no-repeat;background-size:cover;" class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-toggle-body="true" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                            <!-- <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
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
                                    </div>
                                </div>
                            </div> -->
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
    
    <script src="<?php echo base_url();?>/assets/admin_new/js/bundle.js?ver=3.2.2"></script>
    <script src="<?php echo base_url();?>/assets/admin_new/js/scripts.js?ver=3.2.2"></script>
    <script src="<?php echo base_url(); ?>/assets/admin_new/plugins/bower_components/toast-master/js/jquery.toast.js"></script>  


    <script>


 $(document).ready(function() {
   
<?php 
  $session = \Config\Services::session();
  if($session->getFlashdata('adminsuccess')){ ?>

toastr.clear();
    NioApp.Toast('<?php echo $session->getFlashdata('adminsuccess'); ?>', 'success');


   <?php } elseif($session->getFlashdata('error')){ ?>

  toastr.clear();
    NioApp.Toast('<?php echo $session->getFlashdata('error'); ?>', 'error');



  <?php } elseif($session->getFlashdata('Success_message')){ ?>

toastr.clear();
    NioApp.Toast('<?php echo $session->getFlashdata('Success_message'); ?>', 'success');


   

 <?php }?>
 }); 

</script>

<?php 
$adminurl = ADMIN_URL;
if(($request->uri->getSegment(1)== $adminurl))
		{ 
	?>
		<script type="text/javascript"> 
        <?php if(get_settings('CAPTCHA')){?>
			// function refreshCaptcha(arg)
			// {
			// 	var src='<?php //echo base_url();?>/captcha/refresh/'+arg;
			// 	document.getElementById("captchaimg").src=src;
            //     console.log(arg);
			// }

            function refreshCaptcha(arg)
            {
           document.getElementById("captchaimg").src='';
            $.ajax({
                url : '<?php echo base_url();?>/captcha/refresh/'+arg,
                method: 'GET',
                success:function(repsonse) {
                    console.log(repsonse);
                    document.getElementById("captchaimg").src='<?php echo base_url();?>assets/admin_new/images/capcha/'+repsonse;
                }
            })
            }
			$(document).ready(function()
			{
				refreshCaptcha('loginform');
			});

        <?php } ?>
        $.validator.addMethod("noSpaceStart", function (value, element) {
        return this.optional(element) || /^[^\s].*$/.test(value);
        }, "Value should not start with empty space");

        $("#loginform").validate({
        rules: {
            login: {
            required: true,
            noSpaceStart: true
            },
            pass: {
            required: true,
            noSpaceStart: true
            },
        },
        messages: {
            login: {
            required: '<?= getlang('email_Is_benodigd'); ?>',
            noSpaceStart: '<?= getlang('Uw_e-mailadres_moet_de_notatie_naam@domein.com_hebben'); ?>'
            },
            pass: {
            required: '<?= getlang('wachtwoord_Is_benodigd'); ?>',
            email: '<?= getlang('wachtwoord_must_not_start_with_an_empty_space'); ?>'
            },
        }
        });
		</script>



<script>
    document.addEventListener('DOMContentLoaded', function () {

        var passwordField = document.getElementById('passwordField');
        var field = document.querySelector('.form-control-wrap');
        var togglePassword = document.querySelector('.passcode-switch');

        togglePassword.addEventListener('click', function () {
            var type = passwordField.getAttribute('type');

            if (type === 'password') {
                field.classList.add('is-shown');
                togglePassword.classList.add('is-shown'); // Show open eye icon
                passwordField.setAttribute('type', 'text');
                
            } else {
                field.classList.remove('is-shown');
                togglePassword.classList.remove('is-shown'); // Show closed eye icon
                passwordField.setAttribute('type', 'password');
                
            }
        });

    });
</script>




	<?php } ?>
    
		
</html>