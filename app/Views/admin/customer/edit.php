<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.customer");?></h4>

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

								<a href="<?php echo base_url('beheerpaneel/customer/manage');?>"><?=lang("general.customer");?></a>

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

									<div class="card-title"><?=lang("general.edit");?> <?=lang("general.customer");?></div>

								</div>

								<form method="post" action="" id="customereditform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang("general.fname");?></label>

														<input type="text" class="form-control form-control" id="fname" name="fname" placeholder="<?=lang("general.fname");?>" value="<?php echo $customer_data[0]->fname;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.lname");?></label>

														<input type="text" class="form-control form-control" id="lname" name="lname" placeholder="<?=lang("general.lname");?>" value="<?php echo $customer_data[0]->lname;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.email");?></label>

														<input type="email" class="form-control form-control" id="email" name="email" placeholder="<?=lang("general.email");?>" value="<?php echo $customer_data[0]->email;?>">

												</div>

												<!-- <div class="form-group">

														<label for="smallInput">Password</label>

														<input type="password" class="form-control form-control" id="password" name="password" placeholder="Password">

												</div> -->

												<div class="form-group" style="float: left;width: 11%;">

													<label for="smallInput"><?=lang("general.phone");?></label>

													<div class="input-group mb-3">

														<div class="input-group-prepend">

															<span class="input-group-text">+</span>

														</div>

														<input type="text" class="form-control" name="c_code" id="c_code" placeholder="91" value="<?php echo $customer_data[0]->c_code;?>">

													</div>

												</div>

												<div class="form-group" style="float: left;padding: 38px;width: 89%;">

														<input type="text" class="form-control form-control" id="phone" name="phone" placeholder="<?=lang("general.phone");?>" value="<?php echo $customer_data[0]->phone;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.address");?></label>

														<input type="text" class="form-control form-control" id="address" name="address" placeholder="<?=lang("general.address");?>" value="<?php echo $customer_data[0]->address;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.city");?></label>

														<input type="text" class="form-control form-control" id="city" name="city" placeholder="<?=lang("general.city");?>" value="<?php echo $customer_data[0]->city;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.country");?></label>

														<input type="text" class="form-control form-control" id="country" name="country" placeholder="<?=lang("general.country");?>" value="<?php echo $customer_data[0]->country;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.postcode");?></label>

														<input type="text" class="form-control form-control" id="postcode" name="postcode" placeholder="<?=lang("general.postcode");?>" value="<?php echo $customer_data[0]->postcode;?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" data-default-file="<?php echo !empty($customer_data[0]->cimage)?base_url('uploads/customers/'.$customer_data[0]->cimage):''; ?>" id="cimage" name="cimage">

												</div>

												<!-- <?php if(!empty($customer_data[0]->cimage)){ ?>

													<img src="<?php echo image_url('uploads/customers/'.$customer_data[0]->cimage);?>">

												<?php } ?> -->

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

					$('#customereditform').validate({

						rules:{

							fname:{

								required: true,

								accept: "[a-zA-Z]+",

							},

							lname:{

								required: true,

								// accept: "[a-zA-Z]+",

							},

							email:{

								required: true,

								email :true,

							},

							phone:{

								required: true,

								number:true,

								maxlength: 10,

							},

							c_code:{

								required: true,

								number:true

							},

							address:{

								required: true,

							},

							city:{

								required: true,

							},

							country:{

								required: true,

							},

							postcode:{

								required: true,

							},

						},

						messages: {

							fname:{

								required: "<?=lang("general.firstname_is_required");?>",

								accept: "<?=lang("general.letters_only");?>",

							},

							lname:{

								required: "<?=lang("general.lastname_is_required");?>",

								// accept: "Enter letters only",

							},

							email:{

								required : "<?=lang("general.email_is_required");?>",

                        		email : "<?=lang("general.valid_email");?>",

							},

							phone:{

								required : "<?=lang("general.phonenumber_required");?>",

                        		number:"<?=lang("general.only_numbers");?>"

							},

							c_code:{

								required : "<?=lang("general.country_code_required");?>",

                        		number:"<?=lang("general.only_numbers");?>"

							},

							address:{

								required : "<?=lang("general.address_required");?>",

							},

							city:{

								required: "<?=lang("general.city_is_required");?>",

							},

							country:{

								required: "<?=lang("general.country_is_required");?>",

							},

							postcode:{

								required: "<?=lang("general.postcode_is_required");?>",

							}

							

						},

					});

				});



			</script>

			