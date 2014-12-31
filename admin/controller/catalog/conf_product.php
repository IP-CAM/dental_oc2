<?php

class ControllerCatalogConfProduct extends Controller {

    private $error = array();
    private $_model = '';

    public function index() {

        $this->_model = $this->request->get['model'];

        $this->load->model('catalog/conf_product_' . $this->_model);
        $this->getList();
    }

    protected function getList() {

        $this->language->load('catalog/conf_product_' . $this->_model);
        $this->load->model('catalog/conf_product_' . $this->_model);

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';
        $url = '&model=' . $this->_model;
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
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('catalog/conf_product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('catalog/conf_product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['repair'] = $this->url->link('catalog/conf_product/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

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
            'limit' => $this->config->get('config_admin_limit')
        );

        $model = 'model_catalog_conf_product_' . $this->_model;

        if ($this->_model == "arcade") {
            $total = $this->$model->getTotalArcade();
            $results = $this->$model->getArcades();
            
        } else if ($this->_model == "cor") {
            $total = $this->$model->getTotalCor();
            $results = $this->$model->getCores();
        } else if ($this->_model == "tamanho") {
            $total = $this->$model->getTotalTamanho();
            $results = $this->$model->getTamanhoes();
        }

        $this->data['results'] = array();
        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/conf_product/update', 'token=' . $this->session->data['token'] . '&conf_product_id=' . $result['id'] . $url, 'SSL')
            );

            $this->data['results'][] = array(
                'id' => $result['id'],
                'name' => $result['value'],
                //'sort_order' => $result['sort_order'],
                'selected' => isset($this->request->post['selected']) && in_array($result['category_id'], $this->request->post['selected']),
                'action' => $action
            );
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_sort_order'] = $this->language->get('column_sort_order');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');
        $this->data['button_repair'] = $this->language->get('button_repair');




        $this->template = 'catalog/conf_product_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

}
