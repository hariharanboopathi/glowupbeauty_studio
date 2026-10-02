<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.testimonials');?></h4>

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

								<a href="<?php echo base_url('admin/pages/testimonials');?>"><?=lang('general.testimonials');?></a>

							</li>

							<li class="separator">

								<i class="flaticon-right-arrow"></i>

							</li>

							<li class="nav-item">

								<a href="#"><?=lang('general.add');?></a>

							</li>

						</ul>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang('general.add');?> <?=lang('general.testimonials');?></div>

								</div>

								<form method="post" action="" id="reviewform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang('general.name');?></label>

														<input type="text" class="form-control form-control" id="pagename" name="name" placeholder="<?=lang('general.name');?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang('general.content');?></label>

														<textarea class="form-control form-control" id="pcontent" name="content"></textarea>

												</div>

												

												<div class="form-group">

														<label for="smallInput"><?=lang('general.image');?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="" id="image" name="image" placeholder="Image">

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

			<script src="<?php echo base_url(); ?>/assets/js/formValidator/jquery.validationEngine.js?v=1"></script>

			<script src="<?php echo base_url(); ?>/assets/js/formValidator/languages/jquery.validationEngine-en.js?v=1"></script>

				

			<script type="text/javascript">

				$.noConflict();

				jQuery( document ).ready(function( $ ) {

					$('#reviewform').validate({

						// ignore: [],

						rules:{

							name:{

								required: true,

							},

							content:{

								required: true,

							},

						},

						messages: {

							name: { required	 : "<?=lang('general.name_required');?>" },

							content: { required	 : "<?=lang('general.enter_content');?>" },							

						},

					});

				});



			</script>

			