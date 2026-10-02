<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.site_information');?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="card-title"><?=lang('general.site_information');?></div>

								</div>

								<form method="post" action="<?php echo base_url('beheerpaneel/settings/contactinfo');?>" id="siteinfoform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang('general.site_name');?></label>

														<input type="text" class="form-control form-control" id="name" name="name" placeholder="<?=lang('general.site_name');?>" value="<?php echo $contact_data[0]->name;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.address');?></label>

														<input type="text" class="form-control form-control" id="address" name="address" placeholder="<?=lang('general.address');?>" value="<?php echo $contact_data[0]->address;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.postcode');?></label>

														<input type="text" class="form-control form-control" id="postcode" name="postcode" placeholder="<?=lang('general.postcode');?>" value="<?php echo $contact_data[0]->postcode;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.city');?></label>

														<input type="text" class="form-control form-control" id="city" name="city" placeholder="<?=lang('general.city');?>" value="<?php echo $contact_data[0]->city;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.country');?></label>

														<input type="text" class="form-control form-control" id="country" name="country" placeholder="<?=lang('general.country');?>" value="<?php echo $contact_data[0]->country;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.phone');?></label>

														<input type="text" class="form-control form-control" id="phone" name="phone" placeholder="<?=lang('general.phone');?>" value="<?php echo $contact_data[0]->phone;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.email');?></label>

														<input type="email" class="form-control form-control" id="email" name="email" placeholder="<?=lang('general.email');?>" value="<?php echo $contact_data[0]->email;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.latitude');?></label>

														<input type="text" class="form-control form-control" id="lat" name="lat" placeholder="<?=lang('general.latitude');?>" value="<?php echo $contact_data[0]->lat;?>">

												</div>

												<div class="form-group">

														<label for="largeInput"><?=lang('general.longitude');?></label>

														<input type="text" class="form-control form-control" id="lng" name="lng" placeholder="<?=lang('general.longitude');?>" value="<?php echo $contact_data[0]->lng;?>">

												</div>
												<div class="form-group">
														<label for="largeInput"><?=lang('general.email');?></label>
														<input type="email" class="form-control form-control" id="cemail" name="cemail" placeholder="<?=lang('general.email');?>" value="<?php echo !empty($contact_data)&&isset($contact_data[0]->contact_mail)?$contact_data[0]->contact_mail:'';?>">
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



					$('#siteinfoform').validate({

						rules:{

							name:{

								required: true,

							},

							address:{

								required: true,

							},

							postcode:{

								required: true,

							},

							city:{

								required: true,

							},

							country:{

								required: true,

							},

							phone:{

								required: true,

								// number:true,

								// maxlength: 10,

							},

							email:{

								required: true,

								email :true,

							},

							/*lat:{

								required: true,

							},

							lng:{

								required: true,

							},*/

						},

						messages: {

							name:{

								required: "<?=lang('general.name_required');?>",

							},

							address:{

								required: "<?=lang('general.address_required');?>",

							},

							postcode:{

								required: "<?=lang('general.postcode_is_required');?>",

							},

							city:{

								required: "<?=lang('general.city_is_required');?>",

							},

							country:{

								required: "<?=lang('general.country_is_required');?>",

							},

							phone:{

								required: "<?=lang('general.phonenumber_required');?>",

								// number:"Only numbers are allowed"

							},

							email:{

								required: "<?=lang('general.email_is_required');?>",

								email : "<?=lang('general.valid_email');?>",

							},

							/*lat:{

								required: "<?=lang('general.latitude_is_required');?>",

							},

							lng:{

								required: "<?=lang('general.longitude_is_required');?>",

							},*/

						},

					});



				});



			</script>

			