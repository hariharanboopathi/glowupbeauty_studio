<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.options");?></h4>

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

								<a href="<?php echo base_url('beheerpaneel/options/manage');?>"><?=lang("general.options");?></a>

							</li>

							<li class="separator">

								<i class="flaticon-right-arrow"></i>

							</li>

							<li class="nav-item">

								<a href="#"><?=lang("general.edit");?></a>

							</li>

						</ul>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.edit");?> <?=lang("general.options");?></div>

								</div>

								<form method="post" action="" id="optioneditform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang("general.name");?></label>

														<input type="text" class="form-control form-control" id="name" name="name" placeholder="<?=lang("general.name");?>" value="<?php echo $options_data[0]->name;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.price");?></label>

														<input type="text" class="form-control form-control" id="price" name="price" placeholder="<?=lang("general.price");?>" value="<?php echo $options_data[0]->price;?>">

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

					$('#optioneditform').validate({

						rules:{

							name:{

								required: true,

							},

							price:{

								required: true,

								number:true,

							},

						},

						messages: {

							name:{

								required: "<?=lang("general.name_required");?>",

							},

							price:{

								required: "<?=lang("general.price_required");?>",

								number:"<?=lang("general.only_numbers");?>"

							}

													

						},

					});

				});



			</script>

			