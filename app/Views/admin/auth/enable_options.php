<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Permissions to Access Options</div>
							</div>
							<form method="post" action="" id="permissions">
								<div class="card-body">
									<div class="table-responsive">
										<table class="custom_tbl">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Menus</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$controllers = ['pages', 'blog', 'customer', 'category', 'options', 'product', 'orders', 'enquiry', 'discountcode', 'settings', 'socialmedia', 'email', 'message', 'PushNotifications'];

													foreach($controllers as $key => $val)
													{
												?>
												<tr>
													<td style="position:relative"><label style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;cursor:pointer;padding: 0 25px;" for="<?=$val.$key?>"><?=$key+1?></label></td>
													<td style="position:relative"><label style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;cursor:pointer;padding: 0 25px;" for="<?=$val.$key?>"><?=$val?></label></td>
													<td style="position:relative"><label style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;cursor:pointer;padding: 0 25px;" for="<?=$val.$key?>"><input type='checkbox' id="<?=$val.$key?>" value="<?=$val?>" name="option[]" <?php echo !empty($access) && in_array($val, $access) ? 'checked' : ''; ?>></label></td>
												</tr>
												<?php 
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<input type="hidden" value="yes" name="notempty">
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