<?php

class Controllercatalogconfcustomeroption extends Controller {

    private $error = array();
    private $_model = '';
    private $_type = '';

    public function index() {


        $this->_type = $this->request->get['type']; 

        $this->load->model('catalog/conf_customer_option'); 

        $this->getList();
    }

    public function insert() {
        $this->_type = $this->request->get['type'];
        $this->language->load('catalog/conf_customer_option');

        $this->document->setTitle($this->language->get('heading_title')." [ ".$this->_type."]");
        $this->load->model('catalog/conf_customer_option');
        $model = 'model_catalog_conf_product_' . $this->_model;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_catalog_conf_customer_option->add($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&type=' . $this->_type;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        $this->getForm();
    }

    public function update() {
        $this->_type = $this->request->get['type'];
        $this->language->load('catalog/conf_customer_option');

        

        $this->document->setTitle($this->language->get('heading_title')." [ ".$this->_type."]");

        $this->load->model('catalog/conf_customer_option');
       
//        echo $this->request->server['REQUEST_METHOD'];
//        die;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            $this->model_catalog_conf_customer_option->edit($this->request->get['id'], $this->request->post);


            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&type=' . $this->_type;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->_type = $this->request->get['type'];
        $this->language->load('catalog/conf_customer_option');
        $this->load->model('catalog/conf_customer_option'); 

        $this->document->setTitle($this->language->get('heading_title')." [ ".$this->_type."]");

    
        $model = 'model_catalog_conf_customer_option';
        
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $conf_id) {
                $this->$model->delete($conf_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&type=' . $this->_type;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    

    protected function getList() {

        $this->language->load('catalog/conf_customer_option');
        $this->load->model('catalog/conf_customer_option');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'ad.name';
        }


        $url = '';
        $url = '&type=' . $this->_type;
        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title')." [ ".$this->_type."]",
            'href' => $this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('catalog/conf_customer_option/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('catalog/conf_customer_option/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['repair'] = $this->url->link('catalog/conf_customer_option/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $data = array(
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'sort'  => $sort,
            'order' => $order,
            'limit' => $this->config->get('config_admin_limit')
        );

        $model = 'model_catalog_conf_customer_option';

        $total = $this->$model->getTotal($this->_type);
        $results = $this->$model->getAll($data ,$this->_type);

        $this->data['results'] = array();
        $this->data['admin_language'] = $this->config->get('config_language');
        $i = 0;
        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/conf_customer_option/update', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, 'SSL')
            );

            $this->data['results'][$i] = array(
                'id' => $result['id'],
                'name' => $result['numero_complemento'],
                //'sort_order' => $result['sort_order'],
                'selected' => isset($this->request->post['selected']) && in_array($result['category_id'], $this->request->post['selected']),
                'action' => $action
            );
           
            $i++;
        }


        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        $this->data['sort_name'] = $this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . '&sort=ad.name' . $url, 'SSL');

        $this->data['heading_title'] = $this->language->get('heading_title')." [ ".$this->_type."]";

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_sort_order'] = $this->language->get('column_sort_order');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');
        $this->data['button_repair'] = $this->language->get('button_repair');


       


        $url = '&type='.$this->_type;;
        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $this->data['order'] = $order;
        $this->data['sort'] = $sort;

        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();


  

        $this->template = 'catalog/conf_customer_options.php';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title')." [ ".$this->_type."]";

        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_percent'] = $this->language->get('text_percent');
        $this->data['text_amount'] = $this->language->get('text_amount');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['numero'] = $this->language->get('numero');
        $this->data['complemento'] = $this->language->get('complemento');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_parent'] = $this->language->get('entry_parent');
        $this->data['entry_filter'] = $this->language->get('entry_filter');
        $this->data['entry_store'] = $this->language->get('entry_store');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_top'] = $this->language->get('entry_top');
        $this->data['entry_column'] = $this->language->get('entry_column');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_layout'] = $this->language->get('entry_layout');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_design'] = $this->language->get('tab_design');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = array();
        }

        $url = '&type=' . $this->_type;

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title')." [ ".$this->_type."]",
            'href' => $this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['id'])) {
            $this->data['action'] = $this->url->link('catalog/conf_customer_option/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('catalog/conf_customer_option/update', 'token=' . $this->session->data['token'] . $url . '&id=' . $this->request->get['id'], 'SSL');
        }

        $this->data['cancel'] = $this->url->link('catalog/conf_customer_option', 'token=' . $this->session->data['token'] . $url, 'SSL');



        $this->data['token'] = $this->session->data['token'];


        if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {

            $model = 'model_catalog_conf_customer_option';

            $info = $this->$model->get($this->request->get['id']);
        }



        if (isset($this->request->post['id'])) {
            $this->data['id'] = $this->request->post['id'];
        }
        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } elseif (!empty($info)) {
            $this->data['name'] = $info['numero_complemento'];
        } else {
            $this->data['name'] = '';
        }


        if (isset($this->request->post['type'])) {
            $this->data['type'] = $this->request->post['type'];
        }
        else if (isset($this->request->get['type'])) {
            $this->data['type'] = $this->request->get['type'];
        }
         elseif (!empty($info)) {
            $this->data['type'] = $info['field_type'];
        } else {
            $this->data['type'] = '';
        }

   


        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->template = 'catalog/conf_customer_option_form.php';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {

        if (!$this->user->hasPermission('modify', 'catalog/conf_customer_option')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
       
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/conf_customer_option')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}
