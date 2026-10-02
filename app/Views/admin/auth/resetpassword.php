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
    <title>Boeskool CMS | <?=getlang("reset_password");?></title>
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
                                        <h5 class="nk-block-title"><?=getlang("reset_your_password");?></h5>
                                        
                                    </div>
                                </div><!-- .nk-block-head -->
                                <?php echo form_open_multipart(ADMIN_URL."/login/resetpassword",array('id'=>'resetpassword'))?>

                                <input type="hidden" name="email" value="<?=$resetemail?>">
                                <input type="hidden" name="resetcode" value="<?=$resetcode?>">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email-address"><?=getlang("password");?></label>
                                           
                                        </div>
                                        <div class="form-control-wrap">
                                            <input  name="pass" type="password" id="pass" class="form-control form-control-lg" id="pass" placeholder="<?=getlang("password");?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email-address"><?=getlang("confirm_password");?></label>
                                           
                                        </div>
                                        <div class="form-control-wrap">
                                            <input  name="reset_pass" type="password" id="reset_pass" class="form-control form-control-lg" id="reset_pass" placeholder="<?=getlang("confirm_password");?>" >
                                        </div>
                                    </div>
                                    
                                    <!-- .form-group -->
                                    
                                    

                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block"><?=getlang("submit");?></button>
                                        <a class="forget_btn" href="<?php echo base_url(ADMIN_URL.'/login'); ?>"><?=getlang("login");?></a>
                                     </div>
                                </form>
                                
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; <?=date('Y');?>. <a href="<?php echo base_url(ADMIN_URL);?>" target="_blank"><?=get_settings('site_name');?></a></p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->

                   
                        
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
			function refreshCaptcha(arg)
			{
				var src='<?php echo base_url();?>/captcha/refresh/'+arg;
				document.getElementById("captchaimg").src=src;
			}
			$(document).ready(function()
			{
				refreshCaptcha('loginform');
			});

        <?php } ?>
        $.validator.addMethod("noSpaceStart", function (value, element) {
        return this.optional(element) || /^[^\s].*$/.test(value);
        }, "Value should not start with empty space");

        $("#resetpassword").validate({
        rules: {
            pass: {
            required: true,
            noSpaceStart: true
            },
            reset_pass: {
            required: true,
            noSpaceStart: true
            },
            
        },
        messages: {
            pass: {
            required: '<?= getlang('Password_Is_benodigd'); ?>',
            },
            reset_pass: {
            required: '<?= getlang('Confirm_Password_Is_benodigd'); ?>',
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