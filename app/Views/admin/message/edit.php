<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.sms_notification");?></h4>

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

								<a href="<?php echo base_url('admin/message/manage');?>"><?=lang("general.sms_notification");?></a>

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

									<div class="card-title"><?=lang("general.edit");?> <?=lang("general.sms_notification");?></div>

								</div>

								<form method="post" action="" id="messageeditform" enctype="multipart/form-data">

									<div class="card-body">

										<div class="row">

											<div class="col-sm-12">

												<div class="form-group">

														<label for="largeInput"><?=lang("general.keyword");?></label>

														<input type="text" class="form-control form-control" id="key" name="key" placeholder="<?=lang("general.keyword");?>" value="<?php echo $message_data[0]->key;?>" readonly>

												</div>

												<div class="form-group smscontent">

														<label for="smallInput"><?=lang("general.sms_content");?></label>

														<textarea class="form-control form-control" id="Scontent" name="message"><?php echo $message_data[0]->message;?></textarea>

												</div>

												<span class="err_msg"></span>

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

					$('#messageeditform').validate({

						rules:{

							ignore: [],

							key:{

								required: true,

							},

							message:{

								required: true,

							},

						},

						messages: {

							key:{

								required: "<?=lang("general.this_field_required");?>",

							},

							message:{

								required: "<?=lang("general.this_field_required");?>",

							},						

						},

						errorPlacement: function(error, element) 

                		{

                			if(element.attr("name") == "message"){

                				

                				error.appendTo( element.parent('.smscontent').next() );

                			}else{

                				error.insertAfter( element );		

                			}

                			

                		}

					});

				});



			</script>

			