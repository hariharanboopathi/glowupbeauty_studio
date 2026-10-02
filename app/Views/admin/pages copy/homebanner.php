<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.home_banner");?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.home_banner");?></div>

								</div>

								<form method="post" action="" id="bannerform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">



												<div class="form-group">

														<label for="smallInput"><?=lang("general.banner_content");?></label>

														<textarea class="form-control form-control" id="bannertext" name="content"><?php echo $homebanner[0]->content;?></textarea>

												</div>

												

												<div class="form-group">

														<label for="smallInput"><?=lang("general.banner_image");?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($homebanner[0]->image)?base_url('uploads/homebanner/'.$homebanner[0]->image):''; ?>" id="image" name="image" placeholder="<?=lang("general.banner_image");?>">

														<!-- <?php if(!empty($homebanner[0]->image)){ ?>

															<img src="<?php echo image_url('uploads/homebanner/'.$homebanner[0]->image);?>">

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




			<?php echo minifier('adminvalidate.min.js'); ?>
				

			<script type="text/javascript">

				$.noConflict();

				jQuery( document ).ready(function( $ ) {

					$('#bannerform').validate({

						ignore: [],

						rules:{
							content:{

								required: function() 

			                    {

			                    	CKEDITOR.instances.content.updateElement();

			                    }

							},

							

						},

						messages: {

							content_1: { required	 : "<?=lang("general.this_field_required");?>" }

						},

					});

				});



			</script>

			