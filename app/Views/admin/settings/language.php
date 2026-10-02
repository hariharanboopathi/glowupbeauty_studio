<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title"><?=getlang("language");?></h4>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><?=getlang("language");?></div>
								</div>
								<form method="post" action="<?php echo base_url('beheerpaneel/settings/language');?>" id="languageform" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group">
														<label for="largeInput"><?=getlang("select_language");?>:</label><br>
														EN:<input type="radio" class="form-control" id="language" name="language" value="en" <?php if($setting_data[0]->value == 'en'){ echo "checked";}?>>
														NL:<input type="radio" class="form-control" id="language" name="language" value="nl" <?php if($setting_data[0]->value == 'nl'){ echo "checked";}?>>
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

					$('#languageform').validate({
						rules:{
							language:{
								required: true,
							},
						},
						messages: {
							language:{
								required: "This field is required",
							},
						},
					});

				});

			</script>
			