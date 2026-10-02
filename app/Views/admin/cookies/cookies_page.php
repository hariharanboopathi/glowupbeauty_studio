<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?= getlang('cookie'); ?> <?= getlang('content'); ?></h3>
                                <div class="nk-block-des text-soft">

                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                            <?php echo form_open('beheerpaneel/cookies/cookies_page', array('id' => 'cookies_page_form')); ?>

                            <input type="hidden" id="cookie_page_id" name="cookie_page_id" value="<?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->id;
                                    } ?>">
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('title'); ?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="title" value="<?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->title;
                                    } ?>" class="form-control" id="default-01" placeholder="<?= getlang('title'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('content'); ?></label>
                                <div class="form-control-wrap">
                                    <textarea name="content" class=" form-control"><?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->content;
                                    } ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('button_link_1'); ?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="link1" value="<?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->link1;
                                    } ?>" class="form-control" id="default-01" placeholder="<?= getlang('button_link_1'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('button_link_2'); ?></label>
                                <div class="form-control-wrap">
                                    <input type="text" name="link2" value="<?php if (!empty($cookies_content)) {
                                        echo $cookies_content[0]->link2;
                                    } ?>" class="form-control" id="default-01" placeholder="<?= getlang('button_link_2'); ?>">
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
</div>