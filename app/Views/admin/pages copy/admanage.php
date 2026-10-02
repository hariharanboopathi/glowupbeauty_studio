<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang("general.manage_advertisement");?></h4>

					</div>

					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="d-flex align-items-center">

										<h4 class="card-title"><?=lang("general.manage_advertisement");?></h4>

									</div>

								</div>

								<div class="card-body">



									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover">

											<thead>

												<tr>

													<th><?=lang("general.id");?></th>

													<th>Position</th>

													<th><?=lang("general.offer");?></th>

													<th><?=lang("general.action");?></th>

												</tr>

											</thead>

												<tbody>

													<?php if(!empty($offeradvertisement)){

														foreach($offeradvertisement as $p){ ?>

															<tr>

																<td><?php echo $p->id;?></td>

																<td><?php if($p->position == '0'){echo "Categories";}else{echo "News";}?></td>

																<td><img src="<?php echo image_url('uploads/offers/'.$p->image);?>" style="height: 85%;"></td>

																<td>

																	<div class="form-button-action">

																		<a href="<?php echo base_url();?>/beheerpaneel/pages/offerad/<?php echo $p->id; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="<?=lang("general.edit");?>">

																			<i class="fa fa-edit"></i>

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





			