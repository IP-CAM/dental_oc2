<?php

class ControllerCatalogConfProduct extends Controller {

    private $error = array();
    private $_model = '';

    public function index() {

        $this->_model = $this->request->get['model'];

        $this->load->model('catalog/conf_product_' . $this->_model);
        $this->getList();
    }

    public function insert() {
        $this->_model = $this->request->get['model'];
        $this->language->load('catalog/conf_product_' . $this->_model);

        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/conf_product_' . $this->_model);
        $model = 'model_catalog_conf_product_' . $this->_model;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            if ($this->_model == "arcade") {
                $this->$model->addArcade($this->request->post);
            } else if ($this->_model == "cor") {
                $this->$model->addCor($this->request->post);
            } else if ($this->_model == "tamanho") {
                $this->$model->addTamanho($this->request->post);
            }


            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&model=' . $this->_model;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
        $this->getForm();
    }

    public function update() {
        $this->_model = $this->request->get['model'];
        $this->language->load('catalog/conf_product_' . $this->_model);

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/conf_product_' . $this->_model);
        $model = 'model_catalog_conf_product_' . $this->_model;
//        echo $this->request->server['REQUEST_METHOD'];
//        die;
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            if ($this->_model == "arcade") {
                $this->$model->editArcade($this->request->get['conf_product_id'], $this->request->post);
            } else if ($this->_model == "cor") {
                $this->$model->editCor($this->request->get['conf_product_id'], $this->request->post);
            } else if ($this->_model == "tamanho") {
                $this->$model->editTamanho($this->request->get['conf_product_id'], $this->request->post);
            }


            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&model=' . $this->_model;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->_model = $this->request->get['model'];
        $this->language->load('catalog/conf_product_' . $this->_model);

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/conf_product_' . $this->_model);
        $model = 'model_catalog_conf_product_' . $this->_model;

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $conf_id) {
                if ($this->_model == "arcade") {
                    $this->$model->deleteArcade($conf_id);
                } else if ($this->_model == "cor") {
                    $this->$model->deleteCor($conf_id);
                } else if ($this->_model == "tamanho") {
                    $this->$model->deleteTamanho($conf_id);
                }
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '&model=' . $this->_model;

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

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

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

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

        $url = '&model=' . $this->_model;

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['conf_product_id'])) {
            $this->data['action'] = $this->url->link('catalog/conf_product/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('catalog/conf_product/update', 'token=' . $this->session->data['token'] . $url . '&conf_product_id=' . $this->request->get['conf_product_id'], 'SSL');
        }

        $this->data['cancel'] = $this->url->link('catalog/conf_product', 'token=' . $this->session->data['token'] . $url, 'SSL');



        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->get['conf_product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {

            $model = 'model_catalog_conf_product_' . $this->_model;

            if ($this->_model == "arcade") {
                $info = $this->$model->getArcade($this->request->get['conf_product_id']);
            } else if ($this->_model == "cor") {
                $info = $this->$model->getCor($this->request->get['conf_product_id']);
            } else if ($this->_model == "tamanho") {
                $info = $this->$model->Tamanho($this->request->get['conf_product_id']);
            }
        }



        if (isset($this->request->post['conf_product_id'])) {
            $this->data['conf_product_id'] = $this->request->post['conf_product_id'];
        }
        if (isset($this->request->post['name'])) {
            $this->data['name'] = $this->request->post['name'];
        } elseif (!empty($info)) {
            $this->data['name'] = $info['value'];
        } else {
            $this->data['name'] = '';
        }



        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

        $this->template = 'catalog/conf_product_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateForm() {

        if (!$this->user->hasPermission('modify', 'catalog/conf_product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (empty($this->request->post['name'])) {
            $this->error['warning'] = $this->language->get('entry_name_error');
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
        if (!$this->user->hasPermission('modify', 'catalog/conf_product')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}
