<?php
class ControllerModuleBossHomecategory extends Controller {
    protected function index($setting) {
        static $module = 0;
       
		$this->document->addScript('catalog/view/javascript/jquery/tabs.js');
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.easing.js');
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.elastislide.js');
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_homecategory.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_homecategory.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/boss_homecategory.css');
		}

		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['template'] = $this->config->get('config_template');
		
		$this->language->load('module/boss_homecategory');
		
      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		//
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('tool/image');
		
		$this->data['tabs'] = array();
	
		$tabs = $this->config->get('boss_homecategory_check');
		if (isset($tabs)) {
			foreach($tabs as $tab){
				$catagory_name = array();
				$catagory_name = $this->model_catalog_category->getCategory($tab);
				
				$data = array(
					'filter_category_id' => $tab,
					'start' => 0,
					'limit' => $setting['limit']
				);
				$results = $this->model_catalog_product->getProducts($data);
				
				$products = array();
				
				foreach($results as $result){
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
					} else {
						$image = false;
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
							
					if ((float)$result['special']) { 
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
					
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}

					$products[] = array(
						'product_id' => $result['product_id'],
						'thumb'   	 => $image,
						'name'    	 => $result['name'],
						'price'   	 => $price,
						'special' 	 => $special,
						'rating'     => $rating,
						'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),
					);
				}
				$this->data['tabs'][] = array(
						'title'	 		 =>	$catagory_name['name'],
						'meta_description' => $catagory_name['meta_description'],
						'products'       => $products
				);
			}
		}
		
		$this->data['module'] = $module++; 
       
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_homecategory.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/boss_homecategory.tpl';
        } else {
            $this->template = 'default/template/module/boss_homecategory.tpl';
        }

        $this->render();
    }
}

?>