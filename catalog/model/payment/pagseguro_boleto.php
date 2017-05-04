<?php

class ModelPaymentPagseguroBoleto extends Model {

    public function getMethod($address, $total) {
        $this->load->language('payment/pagseguro_boleto');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int) $this->config->get('pagseguro_geo_zone_id') . "' AND country_id = '" . (int) $address['country_id'] . "' AND (zone_id = '" . (int) $address['zone_id'] . "' OR zone_id = '0')");

        if (!$this->config->get('pagseguro_boleto_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        $method_data = array();

        if ($status) {
            $method_data = array(
                'code' => 'pagseguro_boleto',
                'title' => $this->config->get('pagseguro_boleto_nome_boleto'),
                'sort_order' => $this->config->get('pagseguro_boleto_sort_order')
            );
        }

        return $method_data;
    }

    public function addPaymentLink($order_id, $payment_link){
        $this->db->query("INSERT INTO " . DB_PREFIX . "order_pagseguro SET paymentLink = '" . $payment_link . "' , order_id = '" . (int)$order_id . "'");
    }

    public function getPaymentLink($order_id){
        $order = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_pagseguro WHERE order_id = '" . (int)$order_id . "'");

        if($order->num_rows) {
            return $order->row['paymentLink'];
        }else{
            return '';
        }
    }

}

?>