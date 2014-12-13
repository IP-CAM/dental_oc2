<?php
class ControllerModuleBossPopular extends Controller {
	protected function index($setting) {
				
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.easing.js');
		$this->document->addScript('catalog/view/javascript/bossthemes/jquery.elastislide.js');
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_popular.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/boss_popular.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/boss_popular.css');
		}
		
		$this->load->model('catalog/product');		
		$this->load->model('tool/image');
		$this->load->model('catalog/review');
      	
		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['products'] = array();
		$this->data['template'] = $this->config->get('config_template');
		$this->data['title'] = $setting['title'][$this->config->get('config_language_id')];
				
		$results = $this->model_catalog_product->getPopularProducts($setting['limit']);
		
		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
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
			
			 
			$this->data['products'][] = array(
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
				'product_id' => $result['product_id'],
				'thumb'   	 => $image,
				'name'    	 => $result['name'],
				'model'		 => $result['model'],
				'price'   	 => $price,
				'special' 	 => $special,
				'rating'     => $rating,
				'count_rating' => $this->model_catalog_review->getTotalReviewsByProductId($result['product_id']),
				'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
				'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
			);
		}
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_popular.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/boss_popular.tpl';
		} else {
			$this->template = 'default/template/module/boss_popular.tpl';
		}

		$this->render();
	}
}
?>