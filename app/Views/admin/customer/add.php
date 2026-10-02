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

								<a href="#"><?=lang("general.add");?></a>

							</li>

						</ul>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang("general.add");?> <?=lang("general.customer");?></div>

								</div>

								<form method="post" action="" id="customeraddform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang("general.fname");?></label>

														<input type="text" class="form-control form-control" id="fname" name="fname" placeholder="<?=lang("general.fname");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.lname");?></label>

														<input type="text" class="form-control form-control" id="lname" name="lname" placeholder="<?=lang("general.lname");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.email");?></label>

														<input type="email" class="form-control form-control" id="email" name="email" placeholder="<?=lang("general.email");?>">

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

														<input type="text" class="form-control" name="c_code" id="c_code" placeholder="91" value="<?php echo (!empty($customer_data) && isset($customer_data[0]->c_code))?$customer_data[0]->c_code:'';?>">

													</div>

													

												</div>

												<div class="form-group" style="float: left;padding: 38px;width: 89%;">

														<input type="text" class="form-control form-control" id="phone" name="phone" placeholder="<?=lang("general.phone");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.address");?></label>

														<input type="text" class="form-control form-control" id="address" name="address" placeholder="<?=lang("general.address");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.city");?></label>

														<input type="text" class="form-control form-control" id="city" name="city" placeholder="<?=lang("general.city");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.country");?></label>

														<input type="text" class="form-control form-control" id="country" name="country" placeholder="<?=lang("general.country");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.postcode");?></label>

														<input type="text" class="form-control form-control" id="postcode" name="postcode" placeholder="<?=lang("general.postcode");?>">

												</div>

												<div class="form-group">

														<label for="smallInput"><?=lang("general.image");?></label>

														<input type="file" accept=".png,.jpg,.jpeg,.webp" class="form-control-file dropify" id="cimage" name="cimage">

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

					$('#customeraddform').validate({

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

								remote: {

		                            url: "<?php echo base_url('beheerpaneel/customer/check_customer_email'); ?>",

		                            type: "post",

		                            data: {

		                                email: function() {

		                                    return $("#email").val();

		                                }

		                            }

		                        }

							},

							/*password:{

								required: true,

							},*/

							phone:{

								required: true,

								number:true,

								maxlength: 10,

								remote: {

		                            url: "<?php echo base_url('beheerpaneel/customer/check_customer_phone'); ?>",

		                            type: "post",

		                            data: {

		                                phone: function() {

		                                    return $("#phone").val();

		                                }

		                            }

		                        }

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

                        		remote   : "<?=lang("general.email_already_used");?>"

							},

							/*password:{

								required: "Password is required",

							},*/

							phone:{

								required : "<?=lang("general.phonenumber_required");?>",

                        		number:"<?=lang("general.only_numbers");?>",

                        		remote   : "<?=lang("general.phno_already_used");?>"

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

			