<?php

class ControllerCheckoutRegister extends Controller {

    public function index() {
        $this->language->load('checkout/checkout');

        $this->data['text_your_details'] = $this->language->get('text_your_details');
        $this->data['text_your_address'] = $this->language->get('text_your_address');
        $this->data['text_your_password'] = $this->language->get('text_your_password');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');

        $this->data['entry_firstname'] = $this->language->get('entry_firstname');
        $this->data['entry_lastname'] = $this->language->get('entry_lastname');
        $this->data['entry_email'] = $this->language->get('entry_email');
        $this->data['entry_telephone'] = $this->language->get('entry_telephone');
        $this->data['entry_fax'] = $this->language->get('entry_fax');
        $this->data['entry_company'] = $this->language->get('entry_company');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_company_id'] = $this->language->get('entry_company_id');
        $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
        $this->data['entry_address_1'] = $this->language->get('entry_address_1');
        $this->data['entry_address_2'] = $this->language->get('entry_address_2');
        $this->data['entry_postcode'] = $this->language->get('entry_postcode');
        $this->data['entry_city'] = $this->language->get('entry_city');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_newsletter'] = sprintf($this->language->get('entry_newsletter'), $this->config->get('config_name'));
        $this->data['entry_password'] = $this->language->get('entry_password');
        $this->data['entry_confirm'] = $this->language->get('entry_confirm');
        $this->data['entry_shipping'] = $this->language->get('entry_shipping');

        //mail chimp languages

        $this->data['txt_payment_cad_name'] = $this->language->get('txt_payment_cad_name');
        $this->data['txt_payment_cad_dob'] = $this->language->get('txt_payment_cad_dob');
        $this->data['txt_payment_cad_cpf'] = $this->language->get('txt_payment_cad_cpf');
        $this->data['txt_payment_cad_rg'] = $this->language->get('txt_payment_cad_rg');
        $this->data['txt_payment_cad_telefone'] = $this->language->get('txt_payment_cad_telefone');
        $this->data['txt_payment_cad_celular'] = $this->language->get('txt_payment_cad_celular');
        $this->data['txt_payment_cad_gender'] = $this->language->get('txt_payment_cad_gender');
        $this->data['txt_payment_corop_name'] = $this->language->get('txt_payment_corop_name');
        $this->data['txt_payment_corop_trade_name'] = $this->language->get('txt_payment_corop_trade_name');
        $this->data['txt_payment_corop_cnpg'] = $this->language->get('txt_payment_corop_cnpg');
        $this->data['txt_payment_corop_responsible_name'] = $this->language->get('txt_payment_corop_responsible_name');
        $this->data['txt_payment_corop_telefone'] = $this->language->get('txt_payment_corop_telefone');
        $this->data['txt_payment_corop_responsible_cell'] = $this->language->get('txt_payment_corop_responsible_cell');
        $this->data['txt_payment_corop_state_registration'] = $this->language->get('txt_payment_corop_state_registration');
        $this->data['txt_payment_corop_isento'] = $this->language->get('txt_payment_corop_isento');

        $this->data['txt_payment_profession_type'] = $this->language->get('txt_payment_profession_type');

        $this->data['txt_payment_profession_cro'] = $this->language->get('txt_payment_profession_cro');

        $this->data['txt_payment_profession_tdp'] = $this->language->get('txt_payment_profession_tdp');

        $this->data['txt_payment_profession_matricula'] = $this->language->get('txt_payment_profession_matricula');

        $this->data['txt_payment_profession_ensino'] = $this->language->get('txt_payment_profession_ensino');

        $this->data['txt_payment_profession_graduacao'] = $this->language->get('txt_payment_profession_graduacao');

        $this->data['txt_payment_profession_instituica'] = $this->language->get('txt_payment_profession_instituica');

        $this->data['txt_payment_profession_atuacao'] = $this->language->get('txt_payment_profession_atuacao');
        $this->data['txt_payment_news_letter'] = $this->language->get('txt_payment_news_letter');

        //mail chimp heading labels
        $this->data['txt_payment_heading_customer'] = $this->language->get('txt_payment_heading_customer');

        $this->data['txt_payment_heading_account'] = $this->language->get('txt_payment_heading_account');

        $this->data['txt_payment_heading_profession'] = $this->language->get('txt_payment_heading_profession');

        $this->data['txt_payment_heading_customer_type'] = $this->language->get('txt_payment_heading_customer_type');

        //end of mail chimp

        $this->data['button_continue'] = $this->language->get('button_continue');

        $this->data['customer_groups'] = array();

        if (is_array($this->config->get('config_customer_group_display'))) {
            $this->load->model('account/customer_group');

            $customer_groups = $this->model_account_customer_group->getCustomerGroups();

            foreach ($customer_groups as $customer_group) {
                if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
                    $this->data['customer_groups'][] = $customer_group;
                }
            }
        }

        $this->data['customer_group_id'] = $this->config->get('config_customer_group_id');

        if (isset($this->session->data['shipping_postcode'])) {
            $this->data['postcode'] = $this->session->data['shipping_postcode'];
        } else {
            $this->data['postcode'] = '';
        }

        if (isset($this->session->data['shipping_country_id'])) {
            $this->data['country_id'] = $this->session->data['shipping_country_id'];
        } else {
            $this->data['country_id'] = $this->config->get('config_country_id');
        }

        if (isset($this->session->data['shipping_zone_id'])) {
            $this->data['zone_id'] = $this->session->data['shipping_zone_id'];
        } else {
            $this->data['zone_id'] = '';
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if ($this->config->get('config_account_id')) {
            $this->load->model('catalog/information');

            $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

            if ($information_info) {
                $this->data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/info', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
            } else {
                $this->data['text_agree'] = '';
            }
        } else {
            $this->data['text_agree'] = '';
        }

        $this->data['shipping_required'] = $this->cart->hasShipping();

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/register.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/checkout/register.tpl';
        } else {
            $this->template = 'default/template/checkout/register.tpl';
        }

        $this->response->setOutput($this->render());
    }

    public function validate() {
        $this->language->load('checkout/checkout');

        $this->load->model('account/customer');

        $json = array();

        // Validate if customer is already logged out.
        if ($this->customer->isLogged()) {
            $json['redirect'] = $this->url->link('checkout/checkout', '', 'SSL');
        }

        // Validate cart has products and has stock.
        if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
            $json['redirect'] = $this->url->link('checkout/cart');
        }

        // Validate minimum quantity requirments.			
        $products = $this->cart->getProducts();

        foreach ($products as $product) {
            $product_total = 0;

            foreach ($products as $product_2) {
                if ($product_2['product_id'] == $product['product_id']) {
                    $product_total += $product_2['quantity'];
                }
            }

            if ($product['minimum'] > $product_total) {
                $json['redirect'] = $this->url->link('checkout/cart');

                break;
            }
        }

        if (!$json) {
            if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
                $json['error']['firstname'] = $this->language->get('error_firstname');
            }

            if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
                $json['error']['lastname'] = $this->language->get('error_lastname');
            }

            if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
                $json['error']['email'] = $this->language->get('error_email');
            }

            if ($this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
                $json['error']['warning'] = $this->language->get('error_exists');
            }

            if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
                $json['error']['telephone'] = $this->language->get('error_telephone');
            }

            // Customer Group
            $this->load->model('account/customer_group');

            if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
                $customer_group_id = $this->request->post['customer_group_id'];
            } else {
                $customer_group_id = $this->config->get('config_customer_group_id');
            }

            $customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

            if ($customer_group) {
                // Company ID
                if ($customer_group['company_id_display'] && $customer_group['company_id_required'] && empty($this->request->post['company_id'])) {
                    $json['error']['company_id'] = $this->language->get('error_company_id');
                }

                // Tax ID
                if ($customer_group['tax_id_display'] && $customer_group['tax_id_required'] && empty($this->request->post['tax_id'])) {
                    $json['error']['tax_id'] = $this->language->get('error_tax_id');
                }
            }

            if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
                $json['error']['address_1'] = $this->language->get('error_address_1');
            }

            if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
                $json['error']['city'] = $this->language->get('error_city');
            }

            $this->load->model('localisation/country');

            $country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

            if ($country_info) {
                if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
                    $json['error']['postcode'] = $this->language->get('error_postcode');
                }

                // VAT Validation
                $this->load->helper('vat');

                if ($this->config->get('config_vat') && $this->request->post['tax_id'] && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
                    $json['error']['tax_id'] = $this->language->get('error_vat');
                }
            }

            if ($this->request->post['country_id'] == '') {
                $json['error']['country'] = $this->language->get('error_country');
            }

            if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
                $json['error']['zone'] = $this->language->get('error_zone');
            }

            if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
                $json['error']['password'] = $this->language->get('error_password');
            }

            if ($this->request->post['confirm'] != $this->request->post['password']) {
                $json['error']['confirm'] = $this->language->get('error_confirm');
            }

            if ($this->config->get('config_account_id')) {
                $this->load->model('catalog/information');

                $information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

                if ($information_info && !isset($this->request->post['agree'])) {
                    $json['error']['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
                }
            }
        }

        if (!$json) {
            $this->model_account_customer->addCustomer($this->request->post);

            $this->session->data['account'] = 'register';

            if ($customer_group && !$customer_group['approval']) {
                $this->customer->login($this->request->post['email'], $this->request->post['password']);

                $this->session->data['payment_address_id'] = $this->customer->getAddressId();
                $this->session->data['payment_country_id'] = $this->request->post['country_id'];
                $this->session->data['payment_zone_id'] = $this->request->post['zone_id'];

                if (!empty($this->request->post['shipping_address'])) {
                    $this->session->data['shipping_address_id'] = $this->customer->getAddressId();
                    $this->session->data['shipping_country_id'] = $this->request->post['country_id'];
                    $this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
                    $this->session->data['shipping_postcode'] = $this->request->post['postcode'];
                }
            } else {
                $json['redirect'] = $this->url->link('account/success');
            }

            unset($this->session->data['guest']);
            unset($this->session->data['shipping_method']);
            unset($this->session->data['shipping_methods']);
            unset($this->session->data['payment_method']);
            unset($this->session->data['payment_methods']);
        }

        $this->response->setOutput(json_encode($json));
    }

}

?>