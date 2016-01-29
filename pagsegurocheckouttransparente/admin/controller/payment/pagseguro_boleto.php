<?php

class ControllerPaymentPagseguroBoleto extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('payment/pagseguro_boleto');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
            $this->model_setting_setting->editSetting('pagseguro_boleto', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');

        $this->data['entry_token'] = $this->language->get('entry_token');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_nome_boleto'] = $this->language->get('entry_nome_boleto');
        $this->data['entry_text_information'] = $this->language->get('entry_text_information');
        $this->data['entry_order_status'] = $this->language->get('entry_order_status');
        $this->data['entry_order_aguardando_retorno'] = $this->language->get('entry_order_aguardando_retorno');
        $this->data['entry_order_aguardando_pagamento'] = $this->language->get('entry_order_aguardando_pagamento');
        $this->data['entry_order_analise'] = $this->language->get('entry_order_analise');
        $this->data['entry_order_paga'] = $this->language->get('entry_order_paga');
        $this->data['entry_order_disponivel'] = $this->language->get('entry_order_disponivel');
        $this->data['entry_order_disputa'] = $this->language->get('entry_order_disputa');
        $this->data['entry_order_devolvida'] = $this->language->get('entry_order_devolvida');
        $this->data['entry_order_cancelada'] = $this->language->get('entry_order_cancelada');
        $this->data['entry_order_chargeback_debitado'] = $this->language->get('entry_order_chargeback_debitado');
        $this->data['entry_order_contestacao'] = $this->language->get('entry_order_contestacao');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_update_status_alert'] = $this->language->get('entry_update_status_alert');
        $this->data['entry_tipo_frete'] = $this->language->get('entry_tipo_frete');
        $this->data['entry_total'] = $this->language->get('entry_total');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['token'])) {
            $this->data['error_token'] = $this->error['token'];
        } else {
            $this->data['error_token'] = '';
        }

        if (isset($this->error['email'])) {
            $this->data['error_email'] = $this->error['email'];
        } else {
            $this->data['error_email'] = '';
        }

        if (isset($this->error['nome_boleto'])) {
            $this->data['error_nome_boleto'] = $this->error['nome_boleto'];
        } else {
            $this->data['error_nome_boleto'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('text_home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('text_payment'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('payment/pagseguro_boleto', 'token=' . $this->session->data['token'], 'SSL'),
            'text' => $this->language->get('heading_title'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('payment/pagseguro_boleto', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['_token'])) {
            $this->data['pagseguro_boleto_token'] = $this->request->post['pagseguro_boleto_token'];
        } else {
            $this->data['pagseguro_boleto_token'] = $this->config->get('pagseguro_boleto_token');
        }

        if (isset($this->request->post['pagseguro_boleto_email'])) {
            $this->data['pagseguro_boleto_email'] = $this->request->post['pagseguro_boleto_email'];
        } else {
            $this->data['pagseguro_boleto_email'] = $this->config->get('pagseguro_boleto_email');
        }

        if (isset($this->request->post['pagseguro_boleto_nome_boleto'])) {
            $this->data['pagseguro_boleto_nome_boleto'] = $this->request->post['pagseguro_boleto_nome_boleto'];
        } else {
            $this->data['pagseguro_boleto_nome_boleto'] = $this->config->get('pagseguro_boleto_nome_boleto');
        }

        if (isset($this->request->post['pagseguro_boleto_text_information'])) {
            $this->data['pagseguro_boleto_text_information'] = $this->request->post['pagseguro_boleto_text_information'];
        } else {
            $this->data['pagseguro_boleto_text_information'] = $this->config->get('pagseguro_boleto_text_information');
        }

        if (isset($this->request->post['pagseguro_boleto_posfixo'])) {
            $this->data['pagseguro_boleto_posfixo'] = $this->request->post['pagseguro_boleto_posfixo'];
        } else {
            $this->data['pagseguro_boleto_posfixo'] = $this->config->get('pagseguro_boleto_posfixo');
        }

        if (isset($this->request->post['pagseguro_boleto_total'])) {
            $this->data['pagseguro_boleto_total'] = $this->request->post['pagseguro_boleto_total'];
        } else {
            $this->data['pagseguro_boleto_total'] = $this->config->get('pagseguro_boleto_total');
        }

        if (isset($this->request->post['pagseguro_boleto_tipo_frete'])) {
            $this->data['pagseguro_boleto_tipo_frete'] = $this->request->post['pagseguro_boleto_tipo_frete'];
        } else {
            $this->data['pagseguro_boleto_tipo_frete'] = $this->config->get('pagseguro_boleto_tipo_frete');
        }

        if (isset($this->request->post['pagseguro_boleto_update_status_alert'])) {
            $this->data['pagseguro_boleto_update_status_alert'] = $this->request->post['pagseguro_boleto_update_status_alert'];
        } else {
            $this->data['pagseguro_boleto_update_status_alert'] = $this->config->get('pagseguro_boleto_update_status_alert');
        }

        if (isset($this->request->post['pagseguro_boleto_order_aguardando_retorno'])) {
            $this->data['pagseguro_boleto_order_aguardando_retorno'] = $this->request->post['pagseguro_boleto_order_aguardando_retorno'];
        } else {
            $this->data['pagseguro_boleto_order_aguardando_retorno'] = $this->config->get('pagseguro_boleto_order_aguardando_retorno');
        }

        if (isset($this->request->post['pagseguro_boleto_order_aguardando_pagamento'])) {
            $this->data['pagseguro_boleto_order_aguardando_pagamento'] = $this->request->post['pagseguro_boleto_order_aguardando_pagamento'];
        } else {
            $this->data['pagseguro_boleto_order_aguardando_pagamento'] = $this->config->get('pagseguro_boleto_order_aguardando_pagamento');
        }

        if (isset($this->request->post['pagseguro_boleto_order_analise'])) {
            $this->data['pagseguro_boleto_order_analise'] = $this->request->post['pagseguro_boleto_order_analise'];
        } else {
            $this->data['pagseguro_boleto_order_analise'] = $this->config->get('pagseguro_boleto_order_analise');
        }

        if (isset($this->request->post['pagseguro_boleto_order_paga'])) {
            $this->data['pagseguro_boleto_order_paga'] = $this->request->post['pagseguro_boleto_order_paga'];
        } else {
            $this->data['pagseguro_boleto_order_paga'] = $this->config->get('pagseguro_boleto_order_paga');
        }

        if (isset($this->request->post['pagseguro_boleto_order_disponivel'])) {
            $this->data['pagseguro_boleto_order_disponivel'] = $this->request->post['pagseguro_boleto_order_disponivel'];
        } else {
            $this->data['pagseguro_boleto_order_disponivel'] = $this->config->get('pagseguro_boleto_order_disponivel');
        }

        if (isset($this->request->post['pagseguro_boleto_order_disputa'])) {
            $this->data['pagseguro_boleto_order_disputa'] = $this->request->post['pagseguro_boleto_order_disputa'];
        } else {
            $this->data['pagseguro_boleto_order_disputa'] = $this->config->get('pagseguro_boleto_order_disputa');
        }

        if (isset($this->request->post['pagseguro_boleto_order_devolvida'])) {
            $this->data['pagseguro_boleto_order_devolvida'] = $this->request->post['pagseguro_boleto_order_devolvida'];
        } else {
            $this->data['pagseguro_boleto_order_devolvida'] = $this->config->get('pagseguro_boleto_order_devolvida');
        }

        if (isset($this->request->post['pagseguro_boleto_order_cancelada'])) {
            $this->data['pagseguro_boleto_order_cancelada'] = $this->request->post['pagseguro_boleto_order_cancelada'];
        } else {
            $this->data['pagseguro_boleto_order_cancelada'] = $this->config->get('pagseguro_boleto_order_cancelada');
        }
        
        if (isset($this->request->post['pagseguro_boleto_order_chargeback_debitado'])) {
            $this->data['pagseguro_boleto_order_chargeback_debitado'] = $this->request->post['pagseguro_boleto_order_chargeback_debitado'];
        } else {
            $this->data['pagseguro_boleto_order_chargeback_debitado'] = $this->config->get('pagseguro_boleto_order_chargeback_debitado');
        }
        
        if (isset($this->request->post['pagseguro_boleto_order_contestacao'])) {
            $this->data['pagseguro_boleto_order_contestacao'] = $this->request->post['pagseguro_boleto_order_contestacao'];
        } else {
            $this->data['pagseguro_boleto_order_contestacao'] = $this->config->get('pagseguro_boleto_order_contestacao');
        }

        if (isset($this->request->post['pagseguro_boleto_order_nao_efetivado'])) {
            $this->data['pagseguro_boleto_order_nao_efetivado'] = $this->request->post['pagseguro_boleto_order_nao_efetivado'];
        } else {
            $this->data['pagseguro_boleto_order_nao_efetivado'] = $this->config->get('pagseguro_boleto_order_nao_efetivado');
        }

        if (isset($this->request->post['pagseguro_boleto_order_status_id'])) {
            $this->data['pagseguro_boleto_order_status_id'] = $this->request->post['pagseguro_boleto_order_status_id'];
        } else {
            $this->data['pagseguro_boleto_order_status_id'] = $this->config->get('pagseguro_boleto_order_status_id');
        }

        $this->load->model('localisation/order_status');

        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['pagseguro_boleto_geo_zone_id'])) {
            $this->data['pagseguro_boleto_geo_zone_id'] = $this->request->post['pagseguro_boleto_geo_zone_id'];
        } else {
            $this->data['pagseguro_boleto_geo_zone_id'] = $this->config->get('pagseguro_boleto_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['pagseguro_boleto_status'])) {
            $this->data['pagseguro_boleto_status'] = $this->request->post['pagseguro_boleto_status'];
        } else {
            $this->data['pagseguro_boleto_status'] = $this->config->get('pagseguro_boleto_status');
        }

        if (isset($this->request->post['pagseguro_boleto_sort_order'])) {
            $this->data['pagseguro_boleto_sort_order'] = $this->request->post['pagseguro_boleto_sort_order'];
        } else {
            $this->data['pagseguro_boleto_sort_order'] = $this->config->get('pagseguro_boleto_sort_order');
        }

        $this->template = 'payment/pagseguro_boleto.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
    }

    private function validate() {

        if (!$this->user->hasPermission('modify', 'payment/pagseguro_boleto')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['pagseguro_boleto_token']) {
            $this->error['token'] = $this->language->get('error_token');
        }

        if (!$this->request->post['pagseguro_boleto_email']) {
            $this->error['email'] = $this->language->get('error_email');
        }

        if (!$this->request->post['pagseguro_boleto_nome_boleto']) {
            $this->error['nome_boleto'] = $this->language->get('error_nome_boleto');
        }

        if (!$this->error) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function install() {

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "order_pagseguro` (`order_id` int(11) NOT NULL, `paymentLink` varchar(512) NOT
 NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");


    }

}

?>