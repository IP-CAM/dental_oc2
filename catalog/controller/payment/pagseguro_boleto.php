<?php

require_once DIR_SYSTEM . 'library/PagSeguro/HttpConnection.class.php';
require_once DIR_SYSTEM . 'library/PagSeguro/PagSeguroData.class.php';
require_once DIR_SYSTEM . 'library/PagSeguro/XmlParser.class.php';
require_once DIR_SYSTEM . 'library/PagSeguroLibrary/PagSeguroLibrary.php';

class ControllerPaymentPagseguroBoleto extends Controller {

    protected function index() {

        $this->language->load('payment/pagseguro_boleto');
        $this->load->model('account/address');

        $this->data['button_confirm'] = $this->language->get('button_confirm');
        $this->data['text_information'] = $this->language->get('text_information');
        $this->data['text_wait'] = $this->language->get('text_wait');
        $this->data['txt_payment_area_code'] = $this->language->get('txt_payment_area_code');
        $this->data['text_information'] = $this->config->get('pagseguro_boleto_text_information');

        $this->data['url'] = $this->url->link('payment/pagseguro_boleto/confirm', '', 'SSL');
        //define area codes
        $this->data['area_codes'] = array_unique(json_decode($this->model_account_address->area_codes, true));

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagseguro_boleto.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/pagseguro_boleto.tpl';
        } else {
            $this->template = 'default/template/payment/pagseguro_boleto.tpl';
        }
        // incluindo css
        if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pagseguro-checkout-transparente.css')) {
            $this->data['stylesheet'] = 'catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/pagseguro-checkout-transparente.css';
        } else {
            $this->data['stylesheet'] = 'catalog/view/theme/default/stylesheet/pagseguro-checkout-transparente.css';
        }

        $this->render();
    }

    public function confirm() {

//        echo "HERE";
        
        $this->load->model('checkout/order');
//        echo "<pre>";
//        print_r($this->session);
//        print_r( $this->config->get('pagseguro_boleto_order_aguardando_pagamento'));
//        echo "</pre>";
        
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('pagseguro_boleto_order_aguardando_pagamento'));


//        $this->cart->clear();
//
//        unset($this->session->data['shipping_method']);
//        unset($this->session->data['shipping_methods']);
//        unset($this->session->data['payment_method']);
//        unset($this->session->data['payment_methods']);
//        unset($this->session->data['guest']);
//        unset($this->session->data['comment']);
//        unset($this->session->data['order_id']);
//        unset($this->session->data['coupon']);
//        unset($this->session->data['voucher']);
//        unset($this->session->data['vouchers']);
        $urlLoc = $this->url->link('checkout/success');
        
//        echo $urlLoc;
//        die;
        
        
        echo "<script>";
        echo "window.location = '$urlLoc'";
        echo "</script>";
        $this->redirect($urlLoc);
    }

    public function callback() {

        $code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== "" ?
                        trim($_POST['notificationCode']) : null);
        $type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== "" ?
                        trim($_POST['notificationType']) : null);

        if ($code && $type) {

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();
            $this->load->model('checkout/order');

            switch ($strType) {

                case 'TRANSACTION':
                    $credentials = new PagSeguroAccountCredentials($this->config->get('pagseguro_boleto_email'), $this->config->get('pagseguro_boleto_token'));
                    try {
                        $transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
                        $order_id = $transaction->getReference();
                        $status = $transaction->getStatus()->getValue();

                        switch ($status) {
                            case 1:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_aguardando_pagamento'), '', true);
                                break;
                            case 2:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_analise'), '', true);
                                break;
                            case 3:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_paga'), '', true);
                                break;
                            case 4:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_disponivel'), '', true);
                                break;
                            case 5:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_disputa'), '', true);
                                break;
                            case 6:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_devolvida'), '', true);
                                break;
                            case 7:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_cancelada'), '', true);
                                break;
                            case 8:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_chargeback_debitado'), '', true);
                                break;
                            case 9:
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_contestacao'), '', true);
                                break;
                            default :
                                $this->model_checkout_order->update($order_id, $this->config->get('pagseguro_boleto_order_aguardando_pagamento'), '', true);
                                break;
                        }
                    } catch (PagSeguroServiceException $e) {
                        $this->log->write($e->getMessage());
                    }
                    break;

                default:
                    $this->log->write("Unknown notification type [" . $notificationType->getValue() . "]");
            }
        } else {
            $this->log->write("Invalid notification parameters.");
        }
    }

    private function getPesoEmGramas($weight_class_id, $peso) {

        if ($this->weight->getUnit($weight_class_id) == 'g') {
            return $peso;
        }
        return $peso * 1000;
    }

    private function getSessionId(PagSeguroData $pagSeguroData) {

        // Creating a http connection (CURL abstraction)
        $httpConnection = new HttpConnection();

        // Request to PagSeguro Session API using Credentials
        $httpConnection->post($pagSeguroData->getSessionURL(), $pagSeguroData->getCredentials());

        // Request OK getting the result
        if ($httpConnection->getStatus() === 200) {

            $data = $httpConnection->getResponse();

            $sessionId = $this->parseSessionIdFromXml($data);

            return $sessionId;
        } else {

            throw new Exception("PagSeguro Transparente: API Request Error: " . $httpConnection->getStatus());
        }
    }

    private function parseSessionIdFromXml($data) {

        // Creating an xml parser
        $xmlParser = new XmlParser($data);

        // Verifying if is an XML
        if ($xml = $xmlParser->getResult("session")) {

            // Retrieving the id from "session node"
            return $xml['id'];
        } else {
            throw new Exception("PagSeguro Transparente: [$data] is not an XML");
        }
    }

    private function getDDDNumero($telefone) {
        $telefone = str_replace(array('(', ')', '-', '.', '/'), '', $telefone);

        $telefone = explode(' ', $telefone);


        return $telefone;
    }

    public function payment() {
        $senderHash = $_POST['senderHash'];

        $mb_substr = (function_exists("mb_substr")) ? true : false;

        // Adding parameters

        $pagSeguroObject = new PagSeguroData(false, $this->config->get('pagseguro_boleto_email'), $this->config->get('pagseguro_boleto_token'));

        $this->load->model('checkout/order');
        $this->load->model('account/customer');
        $this->load->model('localisation/zone');
        $this->load->model('payment/pagseguro_boleto');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);


        $this->data['pagseguro_session'] = $this->getSessionId($pagSeguroObject);

        /*
         * Dados do cliente
         */

        // Ajuste no nome do comprador para o máximo de 50 caracteres exigido pela API
        $customer_name = trim($order_info['payment_firstname']) . ' ' . trim($order_info['payment_lastname']);

        if ($mb_substr) {
            $customer_name = mb_substr($customer_name, 0, 50, 'UTF-8');
        } else {
            $customer_name = utf8_encode(substr(utf8_decode($customer_name), 0, 50));
        }

        $postalCode = $order_info['payment_postcode'];
//        $postalCode = "91350-240";
//        $postalCode = "934486510-87";
        //makding error
        $params['senderCPF'] = preg_replace('/[^0-9]/', '', $_POST['senderCPF']);
        //$params['senderCPF'] = preg_replace('/[^0-9]/', '', $postalCode);

        $params['senderName'] = preg_replace('/\s+/', ' ', $customer_name);
        $params['senderEmail'] = $order_info['email'];

//        $params['senderAreaCode'] = substr(preg_replace('/[^0-9]/', '', $postalCode), 0, 2);
//        //asked by Brian to override it because he needs full postal code 
//        $params['senderAreaCode'] = $postalCode;
//        $params['senderAreaCode'] = 51;
//        $params['senderAreaCode'] = "";
        $params['senderPhone'] = substr(preg_replace('/[^0-9]/', '', $order_info['telephone']), 2);
        $params['senderHash'] = $senderHash;

        if (!empty($_POST['areaCode'])) {
            $params['senderAreaCode'] = $_POST['areaCode'];
        }

        /* Frete */

        if ($this->cart->hasShipping()) {
            $cep = $this->getDDDNumero($order_info['shipping_postcode']);
            $estado = $this->model_localisation_zone->getZone($order_info['shipping_zone_id']);
            $params['shippingAddressPostalCode'] = $cep[0];
            $params['shippingAddressStreet'] = $order_info['shipping_address_1'];
            if ($this->config->get('dados_status')) {
                $params['shippingAddressNumber'] = $order_info['shipping_numero'];
            } else {
                $params['shippingAddressNumber'] = false;
            }
            $params['shippingAddressComplement'] = $order_info['shipping_company'];
            $params['shippingAddressDistrict'] = $order_info['shipping_address_2'];
            $params['shippingAddressCity'] = $order_info['shipping_city'];
            $params['shippingAddressState'] = $estado['code'];
        } else {
            $cep = $this->getDDDNumero($order_info['payment_postcode']);
            $estado = $this->model_localisation_zone->getZone($order_info['payment_zone_id']);
            $params['shippingAddressPostalCode'] = $cep[0];
            $params['shippingAddressStreet'] = $order_info['payment_address_1'];
            if ($this->config->get('dados_status')) {
                $params['shippingAddressNumber'] = $order_info['payment_numero'];
            } else {
                $params['shippingAddressNumber'] = false;
            }
            $params['shippingAddressComplement'] = $order_info['payment_company'];
            $params['shippingAddressDistrict'] = $order_info['payment_address_2'];
            $params['shippingAddressCity'] = $order_info['payment_city'];
            $params['shippingAddressState'] = $estado['code'];
        }

        if ($params['shippingAddressDistrict'] == '' || $params['shippingAddressDistrict'] == false) {
            $params['shippingAddressDistrict'] = 'Sem bairro';
        }

        if ($params['shippingAddressNumber'] == '' || $params['shippingAddressNumber'] == false) {
            $params['shippingAddressNumber'] = 'Sem número';
        }

        $params['shippingType'] = 3; // 3: Não especificado
        $params['shippingAddressCountry'] = 'BRA';

        /*
         * Produtos
         */

        $i = 1;

        foreach ($this->cart->getProducts() as $product) {
            $options_names = '';

            foreach ($product['option'] as $option) {
                $options_names .= '/' . $option['name'];
            }
            // limite de 100 caracteres para a descrição do produto
            if ($mb_substr) {
                $description = mb_substr($product['model'] . '-' . $product['name'] . $options_names, 0, 100, 'UTF-8');
            } else {
                $description = utf8_encode(substr(utf8_decode($product['model'] . '-' . $product['name'] . $options_names), 0, 100));
            }

            $params['itemId' . $i] = $product['product_id'];
            $params['itemDescription' . $i] = $description;
            $params['itemAmount' . $i] = $this->currency->format($product['price'], $order_info['currency_code'], false, false);
            $params['itemQuantity' . $i] = $product['quantity'];

            $i++;
        }

        // url para receber notificações sobre o status das transações
        $params['notificationURL'] = $this->url->link('payment/pagseguro_boleto/callback');

        // obtendo frete, descontos e taxas
        $total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);


        $params['extraAmount'] = $total;

        $params += $pagSeguroObject->getCredentials(); // add credentials
        $params['paymentMethod'] = 'boleto';
        $params['paymentMode'] = 'default'; // paymentMode
        $params['currency'] = 'BRL'; // Currency (only BRL)
        $params['reference'] = $order_info['order_id']; // Setting the Application Order to Reference on PagSeguro
//        echo "<pre>";    
//        print_r($order_info);
        //$params['senderCPF'] = 93448651087;
        //print_r($params);
//        var_dump($params);
//        exit;
        // treat parameters here!
        $httpConnection = new HttpConnection();
        $httpConnection->post($pagSeguroObject->getTransactionsURL(), $params);



        // Get Xml From response body
        $xmlArray = $this->paymentResultXml($httpConnection->getResponse());

        // Setting http status and show json as result
        //http_response_code($httpConnection->getStatus());
        //header("HTTP/1.1 " . $httpConnection->getStatus());
//        var_dump($xmlArray); exit;

        $json = array();
//        echo "<pre>";
//        print_r($xmlArray);
//        print_r($params);
//        print_r($order_info);
//        echo $this->session->data['order_id'];

        if (array_key_exists('errors', $xmlArray)) {
            foreach ($xmlArray['errors'] as $error) {
                $this->log->write('Erro Pagseguro Checkout transparente: ' . $error['code'] . ' - ' . $error['message']);
            }
            $json['error'] = $error['message'];
        } else {
            $this->model_payment_pagseguro_boleto->addPaymentLink($this->session->data['order_id'], $xmlArray['transaction']['paymentLink']);
            $json['success'] = $xmlArray['transaction']['paymentLink'];
            $json['order_id'] = $this->session->data['order_id'];
        }

        //storing boleto log
        $log_file = getcwd() . DIRECTORY_SEPARATOR . "shopping_log.txt";
        if (!file_exists($log_file)) {
            
        }
        $myfile = fopen("boleto_log.txt", "w") or die("Unable to open file!");


        $txt = "---------Order Info ------- \n";
        fwrite($myfile, $txt);
        $txt = print_r($order_info, true);
        fwrite($myfile, $txt);

        $txt = "\n---------Post Parameter Info ------- \n";
        fwrite($myfile, $txt);

        $txt = print_r($params, true);
        fwrite($myfile, $txt);

        $txt = "\n---------Boleto Response ------- \n";
        fwrite($myfile, $txt);

        $txt = print_r($json, true);
        fwrite($myfile, $txt);

        fclose($myfile);

        $this->response->setOutput(json_encode($json));
    }

    private function paymentResultXml($data) {

        // Creating an xml parser
        $xmlParser = new XmlParser($data);

        // Verifying if is an XML
        if ($xml = $xmlParser->getResult()) {
            return $xml;
        } else {
            throw new Exception("[$data] is not an XML");
        }
    }

    private function notificationResultXml($data) {

        // Creating an xml parser
        $xmlParser = new XmlParser($data);

        // Verifying if is an XML
        if ($xml = $xmlParser->getResult()) {
            return $xml;
        } else {
            throw new Exception("[$data] is not an XML");
        }
    }

    public function open() {
        $order_id = $_GET['order_id'];

        $this->load->model('checkout/order');
        $order = $this->model_checkout_order->getOrder($order_id);

        $this->redirect($order['paymentLink']);
    }

}

?>
