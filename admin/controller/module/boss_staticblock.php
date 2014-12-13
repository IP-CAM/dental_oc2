<?php 
class ControllerModuleBossStaticblock extends Controller {
	private $error = array(); 
	 
	public function index() {   
		$this->language->load('module/boss_staticblock');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('boss_staticblock', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_header_top'] = $this->language->get('text_header_top');
		$this->data['text_header_bottom'] = $this->language->get('text_header_bottom');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
        $this->data['text_footer_top'] = $this->language->get('text_footer_top');
		$this->data['text_footer_bottom'] = $this->language->get('text_footer_bottom');
        $this->data['text_alllayout'] = $this->language->get('text_alllayout');
		$this->data['text_default'] = $this->language->get('text_default');
		
		$this->data['entry_content'] = $this->language->get('entry_content');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_new_block'] = $this->language->get('button_add_new_block');
		
		$this->data['tab_block'] = $this->language->get('tab_block');
		
		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/boss_staticblock', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/boss_staticblock', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();
		
		if (isset($this->request->post['boss_staticblock_module'])) {
			$this->data['modules'] = $this->request->post['boss_staticblock_module'];
		} elseif ($this->config->get('boss_staticblock_module')) { 
			$this->data['modules'] = $this->config->get('boss_staticblock_module');
		}	
				
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('setting/store');
		
		$this->data['stores'] = $this->model_setting_store->getStores();
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/boss_staticblock.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/boss_staticblock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	private function getIdLayout($layout_name) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "layout WHERE LOWER(name) = LOWER('".$layout_name."')");
		return (int)$query->row['layout_id'];
	}
	
	//boss_static
	public function install() 
	{
		$this->load->model('setting/setting');
		
		$this->load->model('localisation/language');
			
		$languages = $this->model_localisation_language->getLanguages();
		
		$array_description0 = array();
		$array_description1 = array();
		$array_description2 = array();
		$array_description3 = array();
		$array_description4 = array();
						
		foreach($languages as $language){
			$array_description0{$language['language_id']} = '&lt;div class=&quot;live-chat&quot;&gt;
	&lt;h1&gt;
		LIVE CHAT 24/7&lt;/h1&gt;
	&lt;p&gt;
		Consectetur adipiscing elit purus tortor ornare&lt;/p&gt;
&lt;/div&gt;';
			$array_description1{$language['language_id']} = '&lt;div class=&quot;boss-static-home&quot;&gt;
	&lt;div class=&quot;frame-static-home&quot;&gt;
		&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;MEDICAL &amp;amp; HEALTH&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/static_banner.jpg&quot; title=&quot;MEDICAL &amp;amp; HEALTH&quot; /&gt;&lt;/a&gt;
		&lt;div class=&quot;static-content&quot;&gt;
			&lt;h3&gt;
				Praesent lorem lucte estibulum nulla&lt;/h3&gt;
			&lt;p&gt;
				Lorem ipsum dolor consectetur adipiscing eros Praesent sagittis tristique pulvinar Integer nec mauris dui. Etiam pellentesque mauris id nisl tempus luctus ellentesque&lt;/p&gt;
		&lt;/div&gt;
		&lt;a class=&quot;learnmore&quot; href=&quot;#&quot;&gt;&lt;span&gt;Learn more&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;
&lt;/div&gt;';
			$array_description2{$language['language_id']} = '&lt;div class=&quot;footer-top-left&quot;&gt;
	&lt;div class=&quot;heading&quot;&gt;
		&lt;h3&gt;
			REVIEW MEDICAL &amp;amp; HEALTH&lt;/h3&gt;
	&lt;/div&gt;
	&lt;div class=&quot;frame_boss_description&quot;&gt;
		&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;REVIEW MEDICAL &amp;amp; HEALTH&quot; class=&quot;description_img&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/block_01.jpg&quot; title=&quot;REVIEW MEDICAL &amp;amp; HEALTH&quot; /&gt;&lt;/a&gt;
		&lt;div class=&quot;boss_description&quot;&gt;
			&lt;h4&gt;
				Nam nibh nibh, iaculis non tristique in, semper sodales ipsum tristique mollis nunc nunc aliquet&lt;/h4&gt;
			&lt;p&gt;
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sagittis tristique pulvinar. Integer nec mauris dui. Etiam pellentesque mauris id nisl tempus luctus. Pellentesque a orci sem, ut vestibulum nisi. Nulla eu elit vitae odio aliquam interdum. Suspendisse non libero ante. Mauris nunc arcu, sodales ac pharetra ullamcorper velit. Integer ultricies blandit ipsum vel tristique. Praesent gravida nunc eu mi cursus eu placerat Quisque augue augue, scelerisque at elementum sit amet, convallis ut metus. Cras porttitor rhoncus arcu. Etiam felis urna tincidunt a semper non, imperdiet at lorem. Mauris at tincidunt neque. Praesent sit amet rhoncus risus&lt;/p&gt;
		&lt;/div&gt;
		&lt;div class=&quot;boss_description&quot;&gt;
			&lt;div class=&quot;boss_des&quot;&gt;
				&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;block2&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/block_02.jpg&quot; title=&quot;block2&quot; /&gt;&lt;/a&gt;
				&lt;h4&gt;
					Praesent nec velit vel lorem luctus&lt;/h4&gt;
				&lt;p&gt;
					Proin ultricies nibh at diam bibendum eget eleifend lorem pellentesque eros etiam amet augue lectus erosun&lt;/p&gt;
			&lt;/div&gt;
			&lt;div class=&quot;boss_des last&quot;&gt;
				&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;block3&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/block_03.jpg&quot; title=&quot;block3&quot; /&gt;&lt;/a&gt;
				&lt;h4&gt;
					Maecenas venenatis magna auctor&lt;/h4&gt;
				&lt;p&gt;
					Phasellus vulputate sollicitudin quam in placerat. Nullam elementum ante at odio vehicula porttitor consequat&lt;/p&gt;
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/div&gt;';
			$array_description3{$language['language_id']} = '&lt;div class=&quot;boss_column&quot;&gt;
	&lt;h3&gt;
		CHILDREN HEALTHCARE&lt;/h3&gt;
	&lt;ul&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Mauris viverra &lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Donec euismod&lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Maecenas nec&lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Donec sagittis&lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Aliquam imperdiet&lt;/a&gt;&lt;/li&gt;
		&lt;li&gt;
			&lt;a href=&quot;#&quot;&gt;Nunc egestas &lt;/a&gt;&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;';
			$array_description4{$language['language_id']} = '&lt;div class=&quot;boss_paypal&quot;&gt;
	&lt;div class=&quot;accept&quot;&gt;
		&lt;h3&gt;
			WE ACCEPT&lt;/h3&gt;
		&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;visa&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_06.png&quot; title=&quot;visa&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;mastercard&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_03.png&quot; title=&quot;mastercard&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;American Express&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_09.png&quot; title=&quot;American Express&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;Paypal&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_18.png&quot; title=&quot;Paypal&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;Bcc&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_15.png&quot; title=&quot;Bcc&quot; /&gt;&lt;/a&gt;&lt;/div&gt;
	&lt;div class=&quot;delivery&quot;&gt;
		&lt;h3&gt;
			OUR DELIVERY&lt;/h3&gt;
		&lt;a href=&quot;#&quot;&gt;&lt;img alt=&quot;FedEx&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_30.png&quot; title=&quot;FedEx&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;DHL&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_33.png&quot; title=&quot;DHL&quot; /&gt;&lt;/a&gt; &lt;a href=&quot;#&quot;&gt; &lt;img alt=&quot;Ups&quot; src=&quot;http://demo.bossthemes.com/medicalhealth/image/data/medicalhealth/payment_27.png&quot; title=&quot;Ups&quot; /&gt;&lt;/a&gt;&lt;/div&gt;
&lt;/div&gt;';
		}
		$boss_staticblock = array('boss_staticblock_module' => array ( 
			0 => array ( 'description' => $array_description0, 'layout_id' => 0, 'store_id' => array(0=>0), 'position' => 'header_top', 'status' => 1, 'sort_order' => 1),
			1 => array ('description' => $array_description1, 'layout_id' => $this->getIdLayout("home"), 'store_id' => array(0=>0), 'position' => 'content_top', 'status' => 1, 'sort_order' => 4),
			2 => array ( 'description' => $array_description2, 'layout_id' => 0, 'store_id' => array(0=>0), 'position' => 'footer_top', 'status' => 1, 'sort_order' => 1),
			3 => array ( 'description' => $array_description3, 'layout_id' => 0, 'store_id' => array(0=>0), 'position' => 'footer_bottom', 'status' => 1, 'sort_order' => 1),	
			4 => array (  'description' => $array_description4, 'layout_id' => 0, 'store_id' => array(0=>0), 'position' => 'footer_bottom', 'status' => 1, 'sort_order' => 2),	
		));

		$this->model_setting_setting->editSetting('boss_staticblock', $boss_staticblock);		
	}	
}
?>