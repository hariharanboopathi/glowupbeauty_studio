<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?= getlang('script'); ?><?= getlang('manage'); ?> </h3>


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
                            <?php echo form_open('beheerpaneel/cookies/cookies_script', array('id' => 'cookies_script_form')); ?>
                            <h2 class="nk-block-title page-title">Explanation</h2>
                            <p> In the script manager it is possible to load scripts that are only executed when the
                                cookies have been accepted by the visitor.
                                why loading scripts after acceptance may be mandatory.</p>
                            <input type="hidden" value="<?php if (!empty($cookies_script)) {
                                        echo $cookies_script[0]->id;
                                    } ?>" name="cookie_script_id">
                            <div class="form-group">
                                <label class="form-label" for="default-01"><?= getlang('script'); ?></label>
                                <div class="form-control-wrap">
                                    <textarea name="script" class="summernote-basic"><?php if (!empty($cookies_script)) {
                                        echo $cookies_script[0]->script;
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