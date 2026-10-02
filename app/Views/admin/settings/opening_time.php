<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.opening_time');?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang('general.opening_time');?></div>

								</div>

								<form method="post" action="<?php echo base_url('admin/settings/opening_time');?>" id="copyrightform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="smallInput"><?=lang('general.opening_time');?></label>

														<textarea class="form-control form-control" id="opening_time" name="opening_time"><?php echo $setting_data[0]->value;?></textarea>

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



					$('#copyrightform').validate({

						rules:{

							opening_time:{

								required: true,

							},

						},

						messages: {

							opening_time:{

								required: "<?=lang('general.this_field_required');?>",

							},

						},

					});



				});



			</script>

			