<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?= getlang('cookie_policy_page'); ?></h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <!-- <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="" class="btn btn-icon btn-primary"><em
                                                        class="icon ni ni-plus"></em></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                            <?php echo form_open('beheerpaneel/cookies/cookies_content', array('id' => 'cookie_form')); ?>
                            <input type="hidden" value="<?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->id;
                                    } ?>" id="cookie_id" name="cookie_id">
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('content'); ?></label>
                                <div class="form-control-wrap">
                                    <textarea name="content" class="summernote-basic"><?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->content;
                                    } ?></textarea>
                                </div>
                            </div>

                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?= getlang('save'); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>