<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=getlang('Generalsettings_Info')?></h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner">
                            <h5 class="card-title"><?=getlang('Web_Store_Setting')?></h5>
                            <p><?=getlang('Here_is_your_basic_store_setting_of_your_website.')?></p>
                           <!-- <form action="#" class="gy-3 form-settings"> -->
                           <?php echo form_open_multipart("beheerpaneel/settings/manage",array('id'=>'settingsform','class'=>'gy-3 form-settings'));?>

                                <?php if(!empty($allsettings_data)){ foreach($allsettings_data as $key=>$setting_data){?>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-label" for="<?=$setting_data->code;?>"><?=$setting_data->name;?></label>
                                            <!-- <span class="form-note">Specify the name of your website.</span> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        
                                        <?php if($setting_data->type == 'text'){?>
                                        <div class="form-group">
                                        
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="<?=$setting_data->code;?>" name ="<?=$setting_data->code;?>" value="<?=$setting_data->value;?>" required>
                                            </div>
                                        </div>
                                        <?php }elseif($setting_data->type == 'textarea'){ ?>
                                        <div class="form-group">
                                            <label class="form-label" for="default-06"><?=getlang('content');?></label>
                                            <div class="form-control-wrap">
                                                <textarea name="<?=$setting_data->code;?>" class="summernote-basic" required><?php echo $setting_data->value;?></textarea>
                                            </div>
                                        </div>
                                        <?php } elseif($setting_data->type == 'radio'){?>
                                        <div class="form-group">
                                                
                                            <ul class="custom-control-group g-3 align-center flex-wrap">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" <?php if($setting_data->value == 1){ ?> checked="checked" <?php } ?> name="<?=$setting_data->code;?>" id="reg-enable<?=$setting_data->code;?>" value="1" required>
                                                        <label class="custom-control-label" for="reg-enable<?=$setting_data->code;?>"><?=getlang('enabled')?></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" <?php if($setting_data->value == 0){ ?> checked="checked" <?php } ?> name="<?=$setting_data->code;?>" id="reg-disable<?=$setting_data->code;?>" value="0" required>
                                                        <label class="custom-control-label" for="reg-disable<?=$setting_data->code;?>"><?=getlang('disabled')?></label>
                                                    </div>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } } ?>
                                
                                <div class="row g-3">
                                    <div class="col-lg-7 offset-lg-5">
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<script>
$("#settingsform").validate({ 
	rules: { 
        site_name: {
            required: true,            
        },
    },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>