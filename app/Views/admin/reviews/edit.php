<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.reviews');?></h4>

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

								<a href="<?php echo base_url('admin/reviews/manage');?>"><?=lang('general.reviews');?></a>

							</li>

							<li class="separator">

								<i class="flaticon-right-arrow"></i>

							</li>

							<li class="nav-item">

								<a href="#"><?=lang('general.edit');?></a>

							</li>

						</ul>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang('general.edit');?> <?=lang('general.review');?></div>

								</div>

								<form method="post" action="" id="reviewform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<!-- <div class="form-group">

														<label for="largeInput"><?=lang('general.reviewer_name');?></label>

														<input type="text" class="form-control form-control" id="pagename" name="rname" placeholder="<?=lang('general.reviewer_name');?>" value="<?php echo $review_data[0]->rname;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.review_title');?></label>

														<input type="text" class="form-control form-control" id="pagename" name="rtitle" placeholder="<?=lang('general.review_title');?>" value="<?php echo $review_data[0]->rtitle;?>">

												</div>

												<div class="form-group">

														<label for="defaultSelect"><?=lang('general.review_product');?></label>

														<select class="form-control form-control" id="defaultSelect" name="prod_id">

															<option value=""><?=lang('general.select_product');?></option>

															<?php if(!empty($product)){ 

																foreach($product as $p){?>

																	<option value="<?php echo $p->id;?>" <?php if($review_data[0]->prod_id == $p->id){echo "selected";}?>><?php echo $p->pname;?></option>

															<?php } }?>

															

														</select>

												</div> -->

												<div class="form-group">

														<label for="smallInput"><?=lang('general.review_content');?></label>

														<textarea class="form-control form-control" id="" name="rcontent"><?php echo $review_data[0]->rcontent;?></textarea>

												</div>

												<div class="form-group">

													<label class="form-check-label">

														<span class="form-check-sign"><?php echo "Approve";?></span>

														<input class="" type="checkbox" value="1" name="status" <?php if($review_data[0]->status == '1'){echo "checked";}?>>

													</label>

												</div>

												

												<!-- <div class="form-group">

														<label for="smallInput"><?=lang('general.image');?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file" id="image" name="rimage" placeholder="<?=lang('general.image');?>">

												</div>

												<?php if(!empty($review_data[0]->rimage)){ ?>

													<img src="<?php echo image_url('uploads/reviews/'.$review_data[0]->rimage);?>">

												<?php } ?> -->

												

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

						ignore: [],

						rules:{

							/*rname:{

								required: true,

							},*/

							rcontent:{

								required: true,

							},

						},

						messages: {

							/*rname: { required	 : "<?=lang('general.enter_reviewer_name');?>" },*/

							rcontent: { required	 : "<?=lang('general.enter_review_content');?>" },							

						},

					});

				});



			</script>

			