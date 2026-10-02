<?php
    date_default_timezone_set("Europe/Amsterdam");
    setlocale(LC_ALL, 'nl_NL');
    $current_time =time();
    $current_date= date('Y-m-d');
    $xmlString ='<?xml version="1.0" encoding="UTF-8"?>
	<urlset
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	
	$xmlString .= '<url>
                <loc>'.base_url().'</loc>
                <lastmod>'.$current_date.'T'.date("H:i:s",$current_time).'+00:00</lastmod>
                <priority>1.0</priority>
                <changefreq>daily</changefreq>
				</url>';
    $url_segment='';
				
	if(!empty($item_data)){
		foreach($item_data as $i_data){
			
			
			$date =explode(' ',$i_data->updated_at);
			
			
			//$url_data = base_url($url_segment);
			// $url_data = base_url(strtolower($i_data->category_slug).'/'.strtolower($i_data->sub_categories_slug).'/'.strtolower($i_data->sub_sub_category_slug).'/'.strtolower($i_data->sub_sub_sub_category_slug).'/'.strtolower($i_data->url));
			$url_data = base_url(strtolower($i_data->url));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
		}
	}
	

	if(!empty($page_data)) {
	
		foreach($page_data as $p_data) {
			if($p_data->page_url!='Thankyou' && $p_data->page_url !='confirmpassword' && $p_data->page_url !='products') {
					$date =explode(' ',$p_data->updated_at);
			$url_data = base_url(str_replace(' ', '_', $p_data->page_url));
			
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
		}
		}
	}

	if(!empty($category_data)) {
		foreach($category_data as $p_data) {
			$date =explode(' ',$p_data->updated_at);
			$url_data = base_url(strtolower($p_data->slug));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
	
		}
	}
	if(!empty($sub_category)) {
		foreach($sub_category as $p_data) {
			if(!empty($p_data->item_categories)){
				$category = $Item_categories_model->get_one($p_data->item_categories);
			}
			$date =explode(' ',$p_data->updated_at);
			$url_data = base_url(strtolower($category->slug).'/'.strtolower($p_data->slug));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
	
		}
	}
	if(!empty($sub_sub_category)) {
		foreach($sub_sub_category as $p_data) {
			if(!empty($p_data->item_sub_categories)){
				$sub_category = $Item_sub_categories_model->get_one($p_data->item_sub_categories);
				
				$category = $Item_categories_model->get_one($sub_category->item_categories);
				

			}
			$date =explode(' ',$p_data->updated_at);
			$url_data = base_url(strtolower($category->slug).'/'.strtolower($sub_category->slug).'/'.strtolower($p_data->slug));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
	
		}
	}
	if(!empty($sub_sub_sub_category)) {
		foreach($sub_sub_sub_category as $p_data) {
			if(!empty($p_data->item_sub_categories1)){
				$sub_sub_category = $Item_sub_category1_model->get_one($p_data->item_sub_categories1);
				$sub_category = $Item_sub_categories_model->get_one($sub_sub_category->item_sub_categories);
				
				$category = $Item_categories_model->get_one($sub_category->item_categories);
				
				

			}
         $date =explode(' ',$p_data->updated_at);
			$url_data = base_url(strtolower($category->slug).'/'.strtolower($sub_category->slug).'/'.strtolower($sub_sub_category->slug).'/'.strtolower($p_data->slug));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
	
		}
	}
	
	if(!empty($blogs_data)) {
		foreach($blogs_data as $p_data) {
			$date =explode(' ',$p_data->updated_at);
			// echo "<pre>";
			// print_r($date);
			// exit;
			$url_data = base_url('blogs/'.strtolower($p_data->slug));
			$xmlString .= '<url>';
			$xmlString .= '<loc>'.$url_data.'</loc>';
			$xmlString .= '<lastmod>'.$date[0].'T'.$date[1].'+00:00</lastmod>';
			$xmlString .= '<priority>1.0</priority>';
			$xmlString .= '<changefreq>daily</changefreq>';
			$xmlString .= '</url>';
	
		}
	}
	
	$xmlString .= '</urlset>';
	$dom = new DOMDocument;

	$dom->preserveWhiteSpace = FALSE;
	$dom->loadXML($xmlString);
	if($dom->save(FCPATH.'/sitemap.xml')){
		echo "<h2>Site Map Created SuccessFully</h2>";
	} else {
		echo "<h2>something went wrong.</h2>";
	}
?>