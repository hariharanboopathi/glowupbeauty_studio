<div class="main-panel">

			<div class="content">

				<div class="page-inner">

					<div class="page-header">

						<h4 class="page-title"><?=lang('general.reviews');?></h4>

					</div>
					<?php
						$request = \Config\Services::request();
						
					?>
					<div class="row">

						<div class="col-md-12">

							<div class="card">

								<div class="card-header">

									<div class="d-flex align-items-center">

										<h4 class="card-title"><?=lang('general.reviews');?></h4>

										<a class="btn btn-primary btn-round ml-auto" style="color: #fff;" href="<?php echo base_url('admin/reviews/add/'.$request->uri->getSegment(4));?>">

											<i class="fa fa-plus"></i>

											<?=lang('general.add');?> <?=lang('general.review');?>

										</a> 

									</div>

								</div>

								<div class="card-body">



									<div class="table-responsive">

										<table id="basic-datatables" class="display table table-striped table-hover">

											<thead>

												<tr>

													<th><?=lang('general.id');?></th>

													<th><?=lang('general.reviewer');?></th>

													<th><?=lang('general.reviewpostdate');?></th>

													<!-- <th>Rating</th> -->

													<th><?=lang('general.action');?></th>

												</tr>

											</thead>

												<tbody>

													<?php if(!empty($review_data)){

														foreach($review_data as $r){ ?>

															<tr>

																<td><?php echo $r->id;?></td>

																<td><?php echo strip_tags($r->rcontent);?></td>

																<td><?php echo date('d-m-Y',strtotime($r->rp_date));?></td>

																<!-- <td><?php echo $r->star_rating;?></td> -->

																<td>

																	<div class="form-button-action">

																		<a href="<?php echo base_url();?>/admin/reviews/edit/<?php echo $r->id; ?>" type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="<?=lang('general.edit');?> <?=lang('general.review');?>">

																			<i class="fa fa-edit"></i>

																		</a>

																		<a href="<?php echo base_url();?>/admin/reviews/delete/<?php echo $r->id; ?>" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="<?=lang('general.remove');?>" id="del_btn">

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





			