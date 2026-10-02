<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('email_template');?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- <div class="nk-block-head-content text-center">
                        <h2 class="nk-block-title fw-normal">News Detail Page</h2>
                        <div class="nk-block-des">
                            <p class="lead">We love to share ideas! Visit our blog if you're looking for great articles or inspiration to get you going.</p>
                        </div>
                    </div> -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">

                        <h1>Minify Configuration</h1>

                        <?php if ($enableMinification): ?>
                        <p>Minification is currently enabled.</p>
                       <?php else: ?>
                       <p>Minification is currently disabled.</p>
                       <?php endif; ?>

                       <form method="post" action="<?= site_url('/minify/toggleMinification') ?>">
                        <button type="submit">Toggle Minification</button>
                           </form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->

<?php echo minifier('adminvalidate.min.js'); ?>

<!-- <script>
$("#email_form").validate({ 
	rules: { 
        key: {
            required: true,            
         },
         subject: {
         	required: true,
         },
         message: {
         	required: true,
         },
         from_mail: {
         	required: true,
         },
      },

});

</script> -->