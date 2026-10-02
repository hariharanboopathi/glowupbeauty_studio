<!-- Sidebar -->
    <script type='text/javascript' src='//code.jquery.com/jquery-3.7.0.min.js'></script><!--older version jQuery-->

<div class="side_menu">
			
               <?php 
				$session = session();
				$admin_id = $session->get('admin_id');

				if (!empty($admin_id)) 
				{
					$db 		= \Config\Database::connect();
					$request 	= \Config\Services::request();

					$builder 	= $db->table("users");
					$query 		= $builder->where(['id' => $admin_id])->get()->getRow();
					 
					$options 	= !empty($query) && !empty($query->enabled_options) ? unserialize($query->enabled_options) : array();
					
					$page = $test = $news = $customer = $category = $option = $product = $order = $enquiry = $discount = $email = $message = $PushNotifications = $settings = $site = $socialmedia = true;
					if($session->get('role') == 'sub-administrator'){
						if(!empty($options)){
							$page = $test = 	(in_array('pages', $options) ? true : false);
							$news = 			(in_array('blog', $options) ? true : false);
							$customer = 		(in_array('customer', $options) ? true : false);
							$category = 		(in_array('category', $options) ? true : false); 
							$option = 			(in_array('options', $options) ? true : false);
							$product = 			(in_array('product', $options) ? true : false); 
							$order = 			(in_array('orders', $options) ? true : false); 
							$enquiry = 			(in_array('enquiry', $options) ? true : false); 
							$discount = 		(in_array('discountcode', $options) ? true : false); 
							$email = 			(in_array('email', $options) ? true : false); 
							$message = 			(in_array('message', $options) ? true : false); 
							$PushNotifications =(in_array('PushNotifications', $options) ? true : false); 
							$settings = $site = (in_array('settings', $options) ? true : false); 
							$socialmedia = 		(in_array('socialmedia', $options) ? true : false); 
						}
						else{
							$page = $test = $news = $customer = $category = $option = $product = $order = $enquiry = $discount = $email = $message = $PushNotifications = $settings = $site = $socialmedia = false;
						}
					}
			?>
            
            <ul class="sidebar">
                <li class="dashboard <?php if($request->uri->getSegment(2) == 'dashboard' && $request->uri->getSegment(3) == ''){ echo 'active'; } ?>">
					<a href="<?php echo base_url('beheerpaneel/dashboard'); ?>"><?= lang('general.dashboard'); ?></a>
				</li>
                <li class="frontend ">
                    <a href="#"> Front End </a>
                    <ul class="submenu" style="display:none;">
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/manage') : 'javascript:void(0)'; ?>" class="active_in">Pages</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/blog/manage') : 'javascript:void(0)'; ?>">News</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/homecontent') : 'javascript:void(0)'; ?>">Home content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/manage_banners') : 'javascript:void(0)'; ?>">Home Banners</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/aboutuscontent') : 'javascript:void(0)'; ?>">Overons content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/contactuscontent') : 'javascript:void(0)'; ?>">Contact us content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/faqcontent') : 'javascript:void(0)'; ?>">FAQ content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/showroomcontent') : 'javascript:void(0)'; ?>"  >Showroom content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/fietsplancontent') : 'javascript:void(0)'; ?>" >Fietsplan content</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/pages/vacaturescontent') : 'javascript:void(0)'; ?>"  >Vacatures content</a></li>
                     </ul>
                </li>
                <li class="Orders">
                    <a href="#"> Orders </a>
                </li>
                <li class="Shipments">
                    <a href="#"> Shipments </a>
                </li>
                <li class="Customers">
                    <a href="#"> Customers </a>
                </li>
                <li class="Products">
                    <a href="#"> Products </a>
                     <ul class="submenu" style="display:none;">
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/product/manage') : 'javascript:void(0)'; ?>">Products</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/category/manage') : 'javascript:void(0)'; ?>">Categories</a></li>
                    </ul>
                </li>
                
                
                <li class="Products">
                    <a href="<?php echo $page ? base_url('beheerpaneel/vacatures/vacatures_manage') : 'javascript:void(0)'; ?>"> Vacatures </a>
                </li>
                
                <!--<li class="Products">
                    <a href="#"> Showroom </a>
                     <ul class="submenu" style="display:none;">
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/showroom/images') : 'javascript:void(0)'; ?>" class="active_in">showroom images</a></li>
                    </ul>
                </li>-->
                
                 <li class="Products">
                    <a href="#"> FAQ </a>
                     <ul class="submenu" style="display:none;">
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/faq/faq_manage_cat') : 'javascript:void(0)'; ?>" class="active_in">Categories</a></li>
                        <li><a href="<?php echo $page ? base_url('beheerpaneel/faq/faq_manage') : 'javascript:void(0)'; ?>" class="active_in">FAQ</a></li>
                    </ul>
                </li>
                
                <li class="Settings">
                    <a href="#"> Settings </a>
                    <ul class="submenu" style="display:none;">
                    	<li>
								<a href="<?php echo $settings ? base_url('beheerpaneel/settings/logo') : 'javascript:void(0)'; ?>">
									<span class="sub-item"><?= lang('general.logo'); ?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo $settings ? base_url('beheerpaneel/settings/favicon') : 'javascript:void(0)'; ?>">
									<span class="sub-item"><?= lang('general.favicon'); ?></span>
								</a>
							</li>
							<li>
								<a href="<?php echo $settings ? base_url('beheerpaneel/settings/copyright') : 'javascript:void(0)'; ?>">
									<span class="sub-item"><?= lang('general.copyright'); ?></span>
								</a>
							</li>
						
                    </ul>
                </li>
                <li class="Webshop">
                    <a href="#"> Webshop Settings </a>
                </li>
                
            
                <li class="frontend ">
                    <a href="#"> Sub admin </a>
                    <ul class="submenu" style="display:none;">
                       <?php 
									if($query->user_type == 'A')
									{
								?>
								<li class="nav-item <?php echo ($request->uri->getSegment(2) == 'dashboard' && ($request->uri->getSegment(3) == 'add_sub_admin')) ? 'active':''; ?>">
									<a href="<?php echo base_url('beheerpaneel/dashboard/add_sub_admin'); ?>">
										<span class="link-collapse">Add sub-admin</span>
									</a>
								</li>
								<li class="nav-item <?php echo ($request->uri->getSegment(2) == 'dashboard' && ($request->uri->getSegment(3) == 'manage_sub_admin')) ? 'active':''; ?>">
									<a href="<?php echo base_url('beheerpaneel/dashboard/manage_sub_admin'); ?>">
										<span class="link-collapse">Manage sub-admin</span>
									</a>
								</li>
								<?php
									}
								?>
                    </ul>
                </li>
                
                 <li class="Webshop">
                    <a href="<?php echo base_url('beheerpaneel/dashboard/logout');?>"> <?=lang('general.logout');?> </a>
                </li>
                
        
                
               
            </ul>
            
            
            
          <?php } ?>   
            
			
            
            
        </div>
        
        
        

<!-- End Sidebar -->