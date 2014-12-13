<?php 
class ControllerModuleBosslogin extends Controller {
	public function index() {
		$this->language->load('module/boss_login');
				
		
		$this->data['text_login'] 		= $this->language->get('text_login');		
		$this->data['text_forgotten']	= $this->language->get('text_forgotten');
		$this->data['text_register'] 	= sprintf($this->language->get('text_register'), $this->url->link('account/register', '', 'SSL'),  $this->url->link('account/register', '', 'SSL'));
		$this->data['text_email'] 		= $this->language->get('text_email');
		$this->data['text_logout'] 		= $this->language->get('text_logout');
		$this->data['contact_us'] 		= $this->language->get('contact_us');
		
		$this->data['entry_password'] 	= $this->language->get('entry_password');
		$this->data['button_login'] 	= $this->language->get('button_login');
		
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['forgotten'] =  $this->url->link('account/forgotten');
		$this->data['action_login'] = $this->url->link('account/login', '', 'SSL');
		
		$this->data['wishlist'] = $this->url->link('account/wishlist');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));		
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['text_account'] = $this->language->get('text_account');
		
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		
		$this->data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$this->data['text_logout'] 		= $this->language->get('text_logout');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/boss_login.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/boss_login.tpl';
		} else {
			$this->template = 'default/template/module/boss_login.tpl';
		}
				
		$this->response->setOutput($this->render());		
	}
}
?>