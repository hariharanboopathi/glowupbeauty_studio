<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg"> 
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('manage');?> <?=getlang('hometick');?></h3>
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
                                                <a href="<?php echo base_url('beheerpaneel/pages/add_hometick');?>" class="btn btn-primary"><em class="icon ni ni-plus"></em><span><?=getlang('add')?> <?=getlang('brand')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url('beheerpaneel/pages/add_hometick');?>" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em><?=getlang('add')?> <?=getlang('brand')?></a>
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
                                        <th class="nk-tb-col tb-col-md dis_res"><span class="sub-text"><?=getlang('content');?></span></th>
                                        <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('action');?></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($hometicks)){

                                        foreach($hometicks as $key=>$hometick){ ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="<?php echo $hometick->id;?>">
                                                <label class="custom-control-label" for="<?php echo $hometick->id;?>"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                        <?php echo $key+1;?>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb dis_res">
                                        <?php echo $hometick->content;?>
                                        </td>
										<td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="<?php echo base_url()?>/beheerpaneel/pages/edit_hometick/<?php echo $hometick->id; ?>"><em class="icon ni ni-edit"></em><span><?=getlang('edit');?></span></a></li>
                                                                <li><a href="<?php echo base_url()?>/beheerpaneel/pages/delete_hometick/<?php echo $hometick->id; ?>"><em class="icon ni ni-delete"></em><span><?=getlang('remove');?></span></a></li>
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