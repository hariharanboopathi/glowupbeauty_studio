<!DOCTYPE html>
<html>

<head>
    <title><?=lang("general.adminpanel");?> | <?=lang("general.login");?></title>
    <meta charset="UTF-8">
    <meta #-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/css/style.css">
</head>

<body>
    <header>
        <a href="#">
            <img src="<?php echo image_url('assets/admin/images/logo.png'); ?>">
        </a>
    </header>
    
    
    <div class="main_content">
        <div class="forgot_main login_main">
            <img src="<?php echo image_url('assets/admin/images/login_bg.jpg'); ?>">
            <form class="sign-in-form" id="loginform" name="loginform" method="post" action="<?php echo current_url(); ?>" >
            <div class="forgot_frm login_frm">
                <h1><?=lang("general.confirm_password");?></h1>
                <p><?=lang("general.confirm_password_desc");?></p>
                <div class="form-fields">
                    <div class="fields">
                        <label><?=lang("general.password");?></label>
                         <input type="password" id="inputPassword" class="pswd form-control" placeholder="<?=lang("general.password");?>" required name="pass">
                    </div>
                    
                     <?php 
                     
			// echo "<pre>";print_r('hh');exit;
                     
                     if(!empty($validation) && !empty($validation->getError('pass'))) {?>
                        <div class='flashdata_error'>
                          <?= $error = $validation->getError('pass'); ?>
                        </div>
                    <?php }?>
                    
                    <div class="fields">
                        <label><?=lang("general.reset_password");?></label>
                         <input type="password" id="inputPassword_confirm" class="pswd form-control" data-rule-equalTo="#inputPassword" placeholder="<?=lang("general.reset_password");?>" required name="reset_pass">
                    </div>
                    
                    
                     <?php if(!empty($validation) && !empty($validation->getError('reset_pass'))) { ?>
                        <div class='flashdata_error'>
                          <?= $error = $validation->getError('reset_pass'); ?>
                        </div>
                    <?php }?>
                    
                   
                    
                    
                    <button type="submit" class="logn_btn"><?=lang("general.confirm_password");?></button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    
    <footer class="form-footer">
        <div class="ft_main">
            <p>© 2023 Boeskool</p>
            <ul>
                <li>
                    <a href="#">Terms</a>
                </li>
                <li>
                    <a href="#">Privacy</a>
                </li>
                <li>
                    <a href="#">Help</a>
                </li>
            </ul>
        </div>
    </footer>

        <script src="<?php echo base_url(); ?>/assets/admin/js/jquery-3.7.0.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/admin/js/bootstrap.min.js"></script>
        <!-- <script src="js/script.js"></script> -->
</body>
</html>