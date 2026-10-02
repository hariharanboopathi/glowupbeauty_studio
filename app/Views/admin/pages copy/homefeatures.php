<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.home_features");?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.home_features");?></div>

								</div>

								<form method="post" action="" id="featureform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">



												<div class="form-group">

														<label for="smallInput"><?=lang("general.title");?></label>

														<input type="text" class="form-control" id="title" name="title" placeholder="<?=lang("general.title");?>" value="<?php echo $hfeatures[0]->title;?>">

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?> 1</label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($hfeatures[0]->image_1)?base_url('uploads/homefeatures/'.$hfeatures[0]->image_1):''; ?>" id="image_1" name="image_1" placeholder="<?=lang("general.image");?>">

														<!-- <?php if(!empty($hfeatures[0]->image_1)){ ?>

															<img src="<?php echo image_url('uploads/homefeatures/'.$hfeatures[0]->image_1);?>">

														<?php } ?> -->

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.content");?> 1</label>

														<textarea class="form-control form-control" id="homefeature1" name="content_1"><?php echo $hfeatures[0]->content_1;?></textarea>

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?> 2</label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($hfeatures[0]->image_2)?base_url('uploads/homefeatures/'.$hfeatures[0]->image_2):''; ?>" id="image_2" name="image_2" placeholder="<?=lang("general.image");?>">

														<!-- <?php if(!empty($hfeatures[0]->image_2)){ ?>

															<img src="<?php echo image_url('uploads/homefeatures/'.$hfeatures[0]->image_2);?>">

														<?php } ?> -->

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.content");?> 2</label>

														<textarea class="form-control form-control" id="homefeature2" name="content_2"><?php echo $hfeatures[0]->content_2;?></textarea>

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?> 3</label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($hfeatures[0]->image_3)?base_url('uploads/homefeatures/'.$hfeatures[0]->image_3):''; ?>" id="image_3" name="image_3" placeholder="<?=lang("general.image");?>">

														<!-- <?php if(!empty($hfeatures[0]->image_3)){ ?>

															<img src="<?php echo image_url('uploads/homefeatures/'.$hfeatures[0]->image_3);?>">

														<?php } ?> -->

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.content");?> 3</label>

														<textarea class="form-control form-control" id="homefeature3" name="content_3"><?php echo $hfeatures[0]->content_3;?></textarea>

												</div>





												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($hfeatures[0]->image_4)?base_url('uploads/homefeatures/'.$hfeatures[0]->image_4):''; ?>" id="image_4" name="image_4" placeholder="<?=lang("general.image");?>">

														<!-- <?php if(!empty($hfeatures[0]->image_4)){ ?>

															<img src="<?php echo image_url('uploads/homefeatures/'.$hfeatures[0]->image_4);?>">

														<?php } ?> -->

												</div>



												<div class="form-group">

														<label for="smallInput"><?=lang("general.content");?> 4</label>

														<textarea class="form-control form-control" id="homefeature4" name="content_4"><?php echo $hfeatures[0]->content_4;?></textarea>

												</div>



											</div>

										</div>

									</div>

									<div class="card-action">

										<button class="btn btn-success" type="submit">Submit</button>

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

					$('#featureform').validate({

						ignore: [],

						rules:{



							title:{

								required: true,

							},

							

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

							

							content_3:{

								required: function() 

			                    {

			                    	CKEDITOR.instances.content_3.updateElement();

			                    }

							},

							

							content_4:{

								required: function() 

			                    {

			                    	CKEDITOR.instances.content_4.updateElement();

			                    }

							},

						},

						messages: {

							title: { required	 : "<?=lang("general.this_field_required");?>" },

							content_1: { required	 : "<?=lang("general.this_field_required");?>" },

							content_2: { required	 : "<?=lang("general.this_field_required");?>" },

							content_3: { required	 : "<?=lang("general.this_field_required");?>" },

							content_4: { required	 : "<?=lang("general.this_field_required");?>" }							

						},

					});

				});



			</script>

			