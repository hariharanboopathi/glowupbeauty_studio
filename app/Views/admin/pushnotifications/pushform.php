<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Push Notifications</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="<?php echo base_url('admin/dashboard');?>">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?php echo base_url('admin/PushNotifications/pushNotification');?>">Push Notifications</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Push Notifications</div>
						</div>
						<form method="post" action="" id="pushform" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="largeInput">Notification Title</label>
											<input type="text" class="form-control form-control" id="title" name="title" placeholder="title">
										</div>
										<div class="form-group">
											<label for="smallInput">Notification Body</label>
											<textarea class="form-control form-control" id="body" name="body" placeholder="body"></textarea>
										</div>
										<div class="form-group">
											<label for="smallInput">Click Action</label>
											<select name="click_action" class="form-control form-control valid">
												<option value="">Select</option>
												<option value="CategoryListItemScreen" selected="">Category Items</option>
												<option value="DishItemScreen">Dish Detail</option>
												<option value="SpecialOfferScreen">Special Offer</option>
												<option value="PopularDishScreen">Popular Dish</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="card-action">
								<button class="btn btn-success" type="submit"><?=lang('general.submit');?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url();?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>/assets/js/formValidator/jquery.validate.js"></script>
	<script>
		$.noConflict();
		jQuery(document).ready(function($) 
		{
			$('#pushform').validate(
			{
				rules:{
					title: {
						required : true,
					},
					body: {
						required : true,
					},
				},
				messages:{
					title: {
						required : "Please provide a notification title",
					},
					body: {
						required : "Please provide a notification body",
					},
				},
			});
		});

	</script>
			