<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.login_content");?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.login_content");?></div>

								</div>

								<form method="post" action="" id="contentform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">



												<div class="form-group">

														<label for="smallInput"><?=lang("general.content");?></label>

														<textarea class="form-control form-control" id="homefeature1" name="content_1"><?php echo $logincontent[0]->content_1;?></textarea>

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($logincontent[0]->image_1)?base_url('uploads/logincontent/'.$logincontent[0]->image_1):''; ?>" id="image_1" name="image_1" placeholder="<?=lang("general.image");?>">

														<!-- <?php if(!empty($logincontent[0]->image_1)){ ?>

															<img src="<?php echo image_url('uploads/logincontent/'.$logincontent[0]->image_1);?>">

														<?php } ?> -->

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

					$('#contentform').validate({

						ignore: [],

						rules:{



							content_1:{

								required: function() 

			                    {

			                    	CKEDITOR.instances.content_1.updateElement();

			                    }

							},

							

							content_2:{

								required: function() 

			                    {

			                    	CKEDITOR.instances.content_2.updateElement();

			                    }

							},

							

							

						},

						messages: {

							content_1: { required	 : "<?=lang("general.this_field_required");?>" },

							content_2: { required	 : "<?=lang("general.this_field_required");?>" }

						},

					});

				});



			</script>

			