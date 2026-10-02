<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.manage");?> <?=lang("general.sms_notifications");?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="d-flex align-items-center">

										<h4 class="card-title"><?=lang("general.manage");?> <?=lang("general.sms_notifications");?></h4>

										 <a class="btn btn-primary btn-round ml-auto" style="color: #fff;" href="<?php echo base_url('admin/message/add');?>">

										 	<i class="fa fa-plus"></i>

											<?=lang("general.add");?> <?=lang("general.sms_notifications");?>

										</a> 

									</div>

								</div>

								<div class="card-body">



									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover">

											<thead>

												<tr>

													<th><?=lang("general.id");?></th>

													<th><?=lang("general.keyword");?></th>

													<th><?=lang("general.action");?></th>

												</tr>

											</thead>

												<tbody>

													<?php if(!empty($message_detail)){

														foreach($message_detail as $m){ ?>

															<tr>

																<td><?php echo $m->id;?></td>

																<td><?php echo $m->key;?></td>

																<td>

																	<div class="form-button-action">

																		<a href="<?php echo base_url();?>/admin/message/edit/<?php echo $m->id; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="<?=lang("general.edit");?>">

																			<i class="fa fa-edit"></i>

																		</a>

																		<a href="<?php echo base_url();?>/admin/message/delete/<?php echo $m->id; ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="<?=lang("general.remove");?>" id="del_btn">

																			<i class="fa fa-times"></i>

																		</a>

																	</div>

																</td>

															</tr>

													<?php }



													 } ?>

												</tbody>

											

										</table>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>





			