<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"> <?=getlang("vacatures_Submit_records");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/vacatures/vacatures_manage" class="btn btn-primary"><span><?=getlang('vacatures');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/vacatures/vacatures_manage" class="btn btn-icon btn-primary"><span><?=getlang('vacatures');?></a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                <label class="custom-control-label" for="uid"></label>
                                            </div>
                                        </th>
                                        <th class="nk-tb-col tb-col-mb"><span class="sub-text"><?=getlang('id');?></span></th>
										<th class="nk-tb-col tb-col-mb dis_res"><span class="sub-text"><?=getlang('naam');?></span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text"><?=getlang('Email');?></span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text"><?=getlang('vacature');?></span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text"><?=getlang('comment');?></span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text"><?=getlang('telefoon');?></span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text"><?=getlang('date');?></span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text"><?=getlang('file');?></span></th>
                                        <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('action');?></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php if(!empty($vacatures_submitted_records_data)){

                                                foreach($vacatures_submitted_records_data as $vacature){ ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="<?php echo $vacature->id;?>">
                                                <label class="custom-control-label" for="<?php echo $vacature->id;?>"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                        <?php echo $vacature->id; ?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb dis_res">
                                        <?php echo $vacature->name; ?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
										<?php echo $vacature->email;?>
                                        </td>
										<td class="nk-tb-col tb-col-mb">
										<?php echo get_vacature_name($vacature->vacature);?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
										<?php echo $vacature->comment;?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
										<?php echo $vacature->telefoon;?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
										<?php $date = strtotime($vacature->created_at);?>
                                        <?php echo date('d-m-Y H:i:s',$date);?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
										<?php if(!empty($vacature->cv_file)){?>
                                            <a href="<?php echo base_url('uploads/cv_file/'.$vacature->cv_file);?>" download><?=getlang('file');?></a>
                                            <?php } else { echo "-"; }?>
                                        
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="<?php echo base_url()?>/beheerpaneel/vacatures/vacatures_record_delete/<?php echo $vacature->id; ?>"><em class="icon ni ni-delete"></em><span><?=getlang("remove");?></span></a></li>
                                                                
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                        <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>