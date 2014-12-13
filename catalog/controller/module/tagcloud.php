<?php
//-----------------------------------------------------
// TagCloud for your Onlinestore   
// Created by villagedefrance                          
// contact@villagedefrance.net                                    
//-----------------------------------------------------

class ControllerModuleTagCloud extends Controller {

	private $_name = 'tagcloud';
	
	protected function index($setting) {
		static $module = 0;
		
		$this->load->language('module/' . $this->_name);

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title' . $language['language_id']])) {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->request->post[$this->_name . '_title' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->config->get($this->_name . '_title' . $language['language_id']);
			}
		}
		
		$this->data['title'] = $this->config->get($this->_name . '_title' . $this->config->get('config_language_id'));
		$this->data['header'] = $this->config->get($this->_name . '_header');
 
		if (!$this->data['title']) { $this->data['title'] = $this->data['heading_title']; } 
		if (!$this->data['header']) { $this->data['title'] = ''; }
		
		$this->data['icon'] = $this->config->get($this->_name . '_icon');
		$this->data['box'] = $this->config->get($this->_name . '_box');

		$this->data['text_notags'] = $this->language->get('text_notags');
		
		$this->load->model('catalog/tagcloud');
		
		$this->data['tagcloud'] = $this->model_catalog_tagcloud->getRandomTags(
			$setting['limit'],
			(int)$setting['min_font_size'],
			(int)$setting['max_font_size'],
			$setting['font_weight']
		);
		
		$this->data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl';
			} else {
				$this->template = 'default/template/module/' . $this->_name . '.tpl';
			}
			
		$this->render();
	}
}
?>
