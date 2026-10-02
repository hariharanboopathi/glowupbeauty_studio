<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.offer_ad');?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang('general.offer_ad');?></div>

								</div>

								<form method="post" action="" id="off_form" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">
												

												<div class="form-group">

														<label for="smallInput"><?=lang('general.image');?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($offerad[0]->image)?base_url('uploads/offers/'.$offerad[0]->image):''; ?>" id="image" name="image" placeholder="<?=lang('general.image');?>">

														<!-- <?php if(!empty($offerad[0]->image)){ ?>

															<img src="<?php echo image_url('uploads/offers/'.$offerad[0]->image);?>">

														<?php } ?> -->

												</div>

												<select class="form-control form-control" id="defaultSelect" name="position">

													    <option value="">Select</option>

													    <option value="0" <?php if($offerad[0]->position == '0'){echo "selected";}?>>Categories</option>
													    <option value="1" <?php if($offerad[0]->position == '1'){echo "selected";}?>>News</option>
														<!-- <option value="0">Categories</option>

														<option value="1">News</option> -->

												</select>

												<div class="form-group">

														<label for="smallInput">Link</label>

														<input type="text" class="form-control" id="link" name="link" placeholder="Link" value="<?php echo $offerad[0]->link;?>">

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

					$('#off_form').validate({

						

						rules:{

							position:{

								required: true

							},

							

						},

						messages: {

							position: { required	 : "This field is required" },		

						},

					});

				});



			</script>

			