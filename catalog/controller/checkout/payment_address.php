<?php

class ControllerCheckoutPaymentAddress extends Controller {

    public function index() {
        $this->language->load('checkout/checkout');

        $this->data['text_address_existing'] = $this->language->get('text_address_existing');
        $this->data['text_address_new'] = $this->language->get('text_address_new');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');

        $this->data['entry_firstname'] = $this->language->get('entry_firstname');
        $this->data['entry_lastname'] = $this->language->get('entry_lastname');
        $this->data['entry_company'] = $this->language->get('entry_company');
        $this->data['entry_company_id'] = $this->language->get('entry_company_id');
        $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
        $this->data['entry_address_1'] = $this->language->get('entry_address_1');
        $this->data['entry_address_2'] = $this->language->get('entry_address_2');
        $this->data['entry_postcode'] = $this->language->get('entry_postcode');
        $this->data['entry_city'] = $this->language->get('entry_city');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_zone'] = $this->language->get('entry_zone');

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




        $this->data['button_continue'] = $this->language->get('button_continue');

        if (isset($this->session->data['payment_address_id'])) {
            $this->data['address_id'] = $this->session->data['payment_address_id'];
        } else {
            $this->data['address_id'] = $this->customer->getAddressId();
        }

        $this->data['addresses'] = array();

        $this->load->model('account/address');

        $this->data['addresses'] = $this->model_account_address->getAddresses();
        $last_index = array_keys($this->data['addresses']);
        if (!empty($last_index)) {
            //print_r($last_index[count($last_index) - 1]);
            foreach (array_keys($this->model_account_address->_mail_chimp_columns) as $field) {
                $this->data[$field] = utf8_decode($this->data['addresses'][$last_index[count($last_index) - 1]][$field]);
            }
        }


        $this->load->model('account/customer_group');

        $customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());

        if ($customer_group_info) {
            $this->data['company_id_display'] = $customer_group_info['company_id_display'];
        } else {
            $this->data['company_id_display'] = '';
        }

        if ($customer_group_info) {
            $this->data['company_id_required'] = $customer_group_info['company_id_required'];
        } else {
            $this->data['company_id_required'] = '';
        }

        if ($customer_group_info) {
            $this->data['tax_id_display'] = $customer_group_info['tax_id_display'];
        } else {
            $this->data['tax_id_display'] = '';
        }

        if ($customer_group_info) {
            $this->data['tax_id_required'] = $customer_group_info['tax_id_required'];
        } else {
            $this->data['tax_id_required'] = '';
        }

        if (isset($this->session->data['payment_country_id'])) {
            $this->data['country_id'] = $this->session->data['payment_country_id'];
        } else {
            $this->data['country_id'] = $this->config->get('config_country_id');
        }

        if (isset($this->session->data['payment_zone_id'])) {
            $this->data['zone_id'] = $this->session->data['payment_zone_id'];
        } else {
            $this->data['zone_id'] = '';
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/payment_address.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/checkout/payment_address.tpl';
        } else {
            $this->template = 'default/template/checkout/payment_address.tpl';
        }

        $this->response->setOutput($this->render());
    }

    public function validate() {
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        die;

        $this->language->load('checkout/checkout');

        $json = array();

        // Validate if customer is logged in.
        if (!$this->customer->isLogged()) {
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

            if (isset($this->request->post['payment_address']) && $this->request->post['payment_address'] == 'existing') {
                $this->load->model('account/address');

                if (empty($this->request->post['address_id'])) {
                    $json['error']['warning'] = $this->language->get('error_address');
                } elseif (!in_array($this->request->post['address_id'], array_keys($this->model_account_address->getAddresses()))) {
                    $json['error']['warning'] = $this->language->get('error_address');
                } else {

                    // Default Payment Address
                    $this->load->model('account/address');

                    $address_info = $this->model_account_address->getAddress($this->request->post['address_id']);

                    if ($address_info) {
                        $this->load->model('account/customer_group');

                        $customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());

                        // Company ID
                        if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && !$address_info['company_id']) {
                            $json['error']['warning'] = $this->language->get('error_company_id');
                        }

                        // Tax ID
                        if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && !$address_info['tax_id']) {
                            $json['error']['warning'] = $this->language->get('error_tax_id');
                        }
                    }
                }

                if (!$json) {
                    $this->session->data['payment_address_id'] = $this->request->post['address_id'];

                    if ($address_info) {
                        $this->session->data['payment_country_id'] = $address_info['country_id'];
                        $this->session->data['payment_zone_id'] = $address_info['zone_id'];
                    } else {
                        unset($this->session->data['payment_country_id']);
                        unset($this->session->data['payment_zone_id']);
                    }
                    //PCM:

                    if (!isset($this->request->get['unset'])) {

                        //unset($this->session->data['payment_method']);
                        //unset($this->session->data['payment_methods']);
                    }
                }
               
            } else {
                if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
                    $json['error']['firstname'] = $this->language->get('error_firstname');
                }

                if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
                    $json['error']['lastname'] = $this->language->get('error_lastname');
                }

                // Customer Group
                $this->load->model('account/customer_group');

                $customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->customer->getCustomerGroupId());

                if ($customer_group_info) {
                    // Company ID
                    if ($customer_group_info['company_id_display'] && $customer_group_info['company_id_required'] && empty($this->request->post['company_id'])) {
                        $json['error']['company_id'] = $this->language->get('error_company_id');
                    }

                    // Tax ID
                    if ($customer_group_info['tax_id_display'] && $customer_group_info['tax_id_required'] && empty($this->request->post['tax_id'])) {
                        $json['error']['tax_id'] = $this->language->get('error_tax_id');
                    }
                }

                if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
                    $json['error']['address_1'] = $this->language->get('error_address_1');
                }

                if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 32)) {
                    $json['error']['city'] = $this->language->get('error_city');
                }

                //validate custom fields 

                if (!empty($this->request->post['cusomer_type'])) {
                    if ($this->request->post['cusomer_type'] == 'Pessoa Física') {
                        if (!$this->validaCPF($this->request->post['payment_cad_cpf'])) {
                            $json['error']['payment_cad_cpf'] = 'Not Valid CPF';
                        }
                        if (empty($this->request->post['payment_cad_name'])) {
                            $json['error']['payment_cad_name'] = 'Not Valid Name';
                        }
                        if (empty($this->request->post['payment_cad_dob'])) {
                            $json['error']['payment_cad_dob'] = 'Not Valid DOB';
                        }
                        if (empty($this->request->post['payment_cad_cpf'])) {
                            $json['error']['payment_cad_cpf'] = 'Not Valid CPF';
                        }
                        if (empty($this->request->post['payment_cad_rg'])) {
                            $json['error']['payment_cad_rg'] = 'Not Valid RG';
                        }
                    } else if ($this->request->post['cusomer_type'] == 'Pessoa Jurídica') {
//                        if(!$this->validaCPF($this->request->post['payment_corop_cnpg'])){
//                            $json['error']['payment_corop_cnpg'] = 'Not Valid CNPG';
//                        }
                        if (empty($this->request->post['payment_corop_name'])) {
                            $json['error']['payment_corop_name'] = 'Not Valid Name';
                        }
                        if (empty($this->request->post['payment_corop_trade_name'])) {
                            $json['error']['payment_corop_trade_name'] = 'Not Valid Trade Name';
                        }
//                        if(empty($this->request->post['payment_corop_cnpg'])){
//                            $json['error']['payment_corop_cnpg'] = 'Not Valid CNPG';
//                        }
                        if (empty($this->request->post['payment_corop_responsible_name'])) {
                            $json['error']['payment_corop_responsible_name'] = 'Not Valid Responsible Name';
                        }
                    }
                }

                $this->load->model('localisation/country');

                $country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

                if ($country_info) {
                    if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
                        $json['error']['postcode'] = $this->language->get('error_postcode');
                    }

                    // VAT Validation
                    $this->load->helper('vat');

                    if ($this->config->get('config_vat') && !empty($this->request->post['tax_id']) && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
                        $json['error']['tax_id'] = $this->language->get('error_vat');
                    }
                }

                if ($this->request->post['country_id'] == '') {
                    $json['error']['country'] = $this->language->get('error_country');
                }

                if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
                    $json['error']['zone'] = $this->language->get('error_zone');
                }
            }
        }
    
        if (!$json) {
            // Default Payment Address
            $this->load->model('account/address');

            $this->session->data['payment_address_id'] = $this->model_account_address->addAddress($this->request->post);
            $this->session->data['payment_country_id'] = $this->request->post['country_id'];
            $this->session->data['payment_zone_id'] = $this->request->post['zone_id'];
            //PCM:

            if (!isset($this->request->get['unset'])) {

                //unset($this->session->data['payment_method']);
                //unset($this->session->data['payment_methods']);
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    private function validaCNPJ($cnpj) {
        $cnpj = str_pad(preg_replace('/[^0-9]/', '', $cnpj), 14, '0', STR_PAD_LEFT);
        if (strlen($cnpj) != 14) {
            return false;
        } else {
            $j = 5;
            $k = 6;
            $soma1 = '';
            $soma2 = '';

            for ($i = 0; $i < 13; $i++) {
                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;
                $soma2 += ($cnpj{$i} * $k);

                if ($i < 12)
                    $soma1 += ($cnpj{$i} * $j);

                $k--;
                $j--;
            }

            $digito1 = ($soma1 % 11 < 2) ? 0 : (11 - ($soma1 % 11));
            $digito2 = ($soma2 % 11 < 2) ? 0 : (11 - ($soma2 % 11));
            return (($cnpj{12} == $digito1) && ($cnpj{13} == $digito2));
        }
    }

    private function validaCPF($cpf) {
        // Verifiva se o número digitado contém todos os digitos
        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999' || $cpf == '12345678909') {
            return false;
        } else {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    private function validaCep($cep) {
        // retira espacos em branco
        $cep = trim($cep);
        // expressao regular para avaliar o cep
        $avaliaCep = preg_match('/^[0-9]{5}-[0-9]{3}$/', $cep, $matches);

        // verifica o resultado
        if (!$avaliaCep) {
            return false;
        } else {
            return true;
        }
    }

}

?>