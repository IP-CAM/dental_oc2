<?php

/*
 * Shipping calculation
 */

class ControllerCheckoutShippingCalculator extends Controller {

    public function index() {

        $this->load->model('catalog/product');
        $test_products = array();
        $test_product = $this->model_catalog_product->getProduct($_POST['product_id']);
        $test_products[0] = $test_product;
        $test_products[0]['key'] = $test_product['product_id'];
        $test_products[0]['total'] = $test_product['price'];

        $shipping_address = $_POST['zip_code'];
        if (!empty($shipping_address)) {
            // Shipping Methods
            $quote_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('shipping');

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {


                    if ($result['code'] != "flat") {
                        $this->load->model('shipping/' . $result['code']);
                        $quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address, $test_products);

                        if ($quote) {
                            $quote_data[$result['code']] = array(
                                'title' => $quote['title'],
                                'quote' => $quote['quote'],
                                'sort_order' => $quote['sort_order'],
                                'error' => $quote['error']
                            );
                        }
                    }
                }
            }
        }

        echo json_encode($quote_data);
    }

}
