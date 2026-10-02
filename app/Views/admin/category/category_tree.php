<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>

#category-tree {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #category-tree li {
            margin: 0 0 3px;
            padding: 10px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            cursor: move;
        }

        #category-tree ul {
            margin-left: 20px;
        }

        #category-tree a {
            margin-left: 10px;
            color: #337ab7;
            text-decoration: none;
        }
    </style>


<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("manage");?> <?=getlang("category");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                        <!-- <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL)?>/category/category_tree" class="btn btn-primary"><em class="icon ni ni-plus"></em><span><?=getlang("category");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL)?>/category/add" class="btn btn-primary"><em class="icon ni ni-plus"></em><span><?=getlang("add");?> <?=getlang("category");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL)?>/category/add" class="btn btn-icon btn-primary"><?=getlang("add");?> <?=getlang("category");?></a>
                                            </li> -->
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                        <h1>Category Tree</h1>
                        <ul id="category-tree" class="sortable-list">
    <?php
    if (!empty($submenu)) {
        foreach ($submenu as $men) {
            ?>
            <li id="category_<?php echo $men['id']; ?>" class="parent_cat">
                <div class="cate_inr">
                    <strong><a href="<?= base_url() . "/"; ?><?= $men['url']; ?>"><?= $men['name']; ?></a></strong>

                    <ul class="sortable-list" data-parent-id="<?= $men['id']; ?>">
                        <?php if (!empty($men['children'])) { ?>
                            <?php foreach ($men['children'] as $key => $Categories) { ?>
                                <li id="category_<?php echo $Categories['id']; ?>">
                                    <p><a href="<?= base_url() . "/"; ?><?= $men['url']; ?>/<?= $Categories['url'] ?>"><?php echo $Categories['name']; ?></a></p>
                                    <?php if (!empty($Categories['children'])) { ?>
                                        <ul class="sortable-list" data-parent-id="<?= $Categories['id']; ?>">
                                            <?php foreach ($Categories['children'] as $child) { ?>
                                                <li id="category_<?php echo $child['id']; ?>">
                                                    <a href="<?= base_url() . "/"; ?><?= $men['url']; ?>/<?= $Categories['url'] ?>/<?= $child["url"]; ?>"><?php echo $child['name']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>

                </div>
            </li>
            <?php
        }
    }
    ?>
</ul>
                           
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
         $.noConflict();
    jQuery(document).ready(function ($) {
            // Enable drag-and-drop functionality
            $(".sortable-list").sortable({
            connectWith: ".sortable-list",
            placeholder: "ui-state-highlight",
            dropOnEmpty: false, // Disable drop on empty
            start: function (event, ui) {
                // Check if the dragged element has siblings (i.e., if it's not the only child)
                var hasSiblings = ui.item.siblings().length > 0;

                // Enable or disable dropping based on whether the dragged element has siblings
                $(".sortable-list").sortable("option", "dropOnEmpty", hasSiblings);
            },
            receive: function (event, ui) {
                // Remove the dragged element from its original parent
                ui.sender.sortable('cancel');
                
                // Append the dragged element to the new parent
                var newParent = $(this);
                ui.item.appendTo(newParent);
            }
        });
              // Make nested lists sortable
        //       $(".sortable-list > ul").sortable({
        //     connectWith: ".sortable-list > ul"
        // });
        });
    </script>