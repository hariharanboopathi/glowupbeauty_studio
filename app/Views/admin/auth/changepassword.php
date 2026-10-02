<!-- content @s -->

<div class="nk-content nk-content-fluid">
	<div class="container-xl wide-xl">
		<div class="nk-content-body">
			<div class="nk-block">
				<div class="card">
					<div class="card-aside-wrap">
						
						<div class="card-inner card-inner-lg">
						<?php echo form_open_multipart("beheerpaneel/dashboard/changepassword",array('id'=>'password_form'))?>
                        <div class="nk-block-head nk-block-head-lg">
								<div class="nk-block-between">
									<div class="nk-block-head-content">
										<h4 class="nk-block-title"><?=getlang('Change_password')?></h4>
										<div class="nk-block-des">
											<p>Basic info, like your name and address, that you use on Nio Platform.</p>
										</div>
									</div>
									<div class="nk-block-head-content align-self-start d-lg-none">
										<a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
									</div>
								</div>
							</div><!-- .nk-block-head -->
							<div class="nk-block">
								<div class="nk-data data-list">
									<div class="data-head">
										<h6 class="overline-title"><?=getlang('Change_password')?></h6>
									</div>
									<div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
										<div class="data-col">
											<span class="data-label"><?=getlang("new_password");?></span>
											<span class="data-value"><input type="password" name="newpassword"  class="form-control" id="newpassword"></span>
										</div>
									</div><!-- data-item -->  

                                    <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
										<div class="data-col">
											<span class="data-label"><?=getlang("confirm_password");?></span>
											<span class="data-value"><input type="password" name="cpassword"  class="form-control" id="cpassword"></span>
										</div>
									</div><!-- data-item -->

                                    <div class="data-item">
										<div class="data-col">
										<button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button>
										</div>
									</div> 	

								</div><!-- data-list -->
								 

								 
							</div><!-- .nk-block -->
						</form>


						</div>
						
						<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
							<div class="card-inner-group" data-simplebar>
								<div class="card-inner">
									<div class="user-card">
										<div class="user-avatar bg-primary" style="color: #000000;background: #66ccff !important;">
											<span><?php echo strtoupper(substr($admin_details[0]->name,0,2)); ?></span>
										</div>
										<div class="user-info">
											<span class="lead-text"><?php echo $admin_details[0]->name;?></span>
											<span class="sub-text"><?php echo $admin_details[0]->email;?></span>
										</div>
										<div class="user-action">
											<div class="dropdown">
												<a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
												<div class="dropdown-menu dropdown-menu-end">
													<ul class="link-list-opt no-bdr">
														<li><a href="<?php echo admin_url('dashboard/editprofile'); ?>"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div><!-- .user-card -->
								</div><!-- .card-inner -->
								<div class="card-inner p-0">
									<ul class="link-list-menu">
										<li><a href="<?php echo admin_url('dashboard/editprofile'); ?>"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
										<li><a class="active" href="<?php echo admin_url('dashboard/changepassword'); ?>"><em class="icon ni ni-lock-alt-fill"></em><span><?=getlang('change_password')?></span></a></li>
										<li><a href="<?php echo admin_url('admin_menu/menu_settings'); ?>"><em class="icon ni ni-user-fill-c"></em><span><?=getlang('Admin_Left_Menu')?></span></a></li>
										<li><a href="<?php echo admin_url('admin_menu/clean_cache'); ?>"><em class="icon ni ni-lock-alt-fill"></em><span><?=getlang('Clean_cache')?></span></a></li>
										<li><a href="<?php echo admin_url('dashboard/logout'); ?>"><em class="icon ni ni-grid-add-fill-c"></em><span><?=getlang('sign_out')?></span></a></li>
									</ul>
								</div><!-- .card-inner -->
							</div><!-- .card-inner-group -->
						</div><!-- card-aside -->
					</div><!-- .card-aside-wrap -->
				</div><!-- .card -->
			</div><!-- .nk-block -->
		</div>
	</div>
</div>
<!-- content @e -->

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#password_form").validate({ 
	rules: { 
		newpassword: {
            required: true,            
         },
         cpassword: {
         	required: true,
         },
      },
});

</script>