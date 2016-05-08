<?php

class ControllerCheckoutShippingAmount extends Controller {

    public function index() {
        // Default Shipping Address
        $this->load->model('account/address');

        $this->session->data['shipping_address_id'] = $this->request->post['shpping_address_id'];

        $shipping = explode('.', $this->request->post['shipping_method']);

        $this->session->data['shipping_method'] = $this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
      
        $this->session->data['comment'] = strip_tags($this->request->post['shipping_comment']);
    }

}
