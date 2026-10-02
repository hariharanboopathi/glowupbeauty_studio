<div class="main-panel">

	<div class="content">

		<div class="page-inner">

			<div class="page-header">

				<h4 class="page-title"><?=lang('general.delivery_fee');?></h4>

			</div>

			<div class="row">

				<div class="col-md-12">

					<div class="card">

						<div class="card-header">

							<div class="card-title"><?=lang('general.delivery_fee');?></div>

						</div>

						<form method="post" action="<?php echo base_url('beheerpaneel/settings/delivery_fee');?>" id="delivery_feeform" enctype="multipart/form-data">

							<div class="card-body">

								<div class="row">

									<div class="col-sm-12">

										<div class="form-group">

												<label for="delivery_fee"><?=lang('general.delivery_fee')?> (per Km):</label>

												<input type="text" class="form-control form-control" id="delivery_fee" name="delivery_fee" placeholder="<?=lang('general.delivery_fee');?>" value="<?php echo !empty($setting_data[0]->value)?$setting_data[0]->value:'';?>">

										</div>

										<div class="form-group">

												<label for="charge_below"><?=lang('general.charge');?>:</label>

												<input type="text" class="form-control form-control" id="charge_below" name="charge_below" placeholder="<?=lang('general.charge');?>" value="<?php echo !empty($charge[0]->value)?$charge[0]->value:'';?>">

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

		jQuery( document ).ready(function( $ ) 
		{
			$('#delivery_feeform').validate(
			{
				rules:
				{
					delivery_fee:
					{
						required : true,
						number   : true
					},
					charge_below:
					{
						number   : true
					}
				},
				messages: 
				{
					delivery_fee:
					{
						required : "<?=lang('general.this_field_required');?>",
						number   : "<?=lang('general.only_numbers');?>"
					},
					charge_below:
					{
						number   : "<?=lang('general.only_numbers');?>"
					},
				},

			});



		});



	</script>

	