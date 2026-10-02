<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.pages");?></h4>

						<ul class="breadcrumbs">

							<li class="nav-home">

								<a href="<?php echo base_url('beheerpaneel/dashboard');?>">

									<i class="flaticon-home"></i>

								</a>

							</li>

							<li class="separator">

								<i class="flaticon-right-arrow"></i>

							</li>

							<li class="nav-item">

								<a href="<?php echo base_url('beheerpaneel/pages/manage');?>"><?=lang("general.pages");?></a>

							</li>

							<li class="separator">

								<i class="flaticon-right-arrow"></i>

							</li>

							<li class="nav-item">

								<a href="#"><?=lang("general.add");?></a>

							</li>

						</ul>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.add");?> <?=lang("general.page");?></div>

								</div>

								<form method="post" action="" id="pageform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="defaultSelect">Select Position</label>

														<select class="form-control form-control" id="defaultSelect" name="position">

															<option value="">Select</option>


																<option value="0">Categories</option>

																<option value="1">News</option>

														</select>

												</div>


												<div class="form-group">

														<label for="smallInput">Link</label>

														<input type="text" class="form-control" id="link" name="link" placeholder="">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?></label>

														<input type="file" class="form-control-file" accept=".png,.jpg,.jpeg,.webp" id="image" name="image" placeholder="">

												</div>

											</div>

										</div>

									</div>

									<div class="card-action">

										<button class="btn btn-success" type="submit"><?=lang("general.submit");?></button>

									</div>

								</form>

							</div>

						</div>

					</div>

				</div>

			</div>





			<script src="<?php echo base_url();?>/assets/js/core/jquery.3.2.1.min.js"></script>

			<script src="<?php echo base_url(); ?>/assets/js/formValidator/jquery.validate.js"></script>

			<script src="<?php echo base_url(); ?>/assets/js/formValidator/jquery.validationEngine.js?v=1"></script>

			<script src="<?php echo base_url(); ?>/assets/js/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>

				

			<script type="text/javascript">

				$.noConflict();

				jQuery( document ).ready(function( $ ) {

					$('#pageform').validate({

						rules:{

							image:{

								required: true,

							},

							position:{

								required: true

							},
						},

						messages: {

							image: { required	 : "Please select image" },

							position: { required	 : "This field is required" },							

						},

					});

				});



			</script>

			