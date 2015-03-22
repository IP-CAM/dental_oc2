<?php

class ControllerProductConfProduct extends Controller {

    public function options() {
        $this->load->model('catalog/product_options');
        $product_id = $this->request->get['product_id'];
        $options = array();
        $option_key = 'arcade';
        if (!empty($this->request->get['option'])) {
            $options = $this->request->get['option'];
        }
        if (!empty($this->request->get['option_key'])) {
            $option_key = $this->request->get['option_key'];
        }

        $model = $this->model_catalog_product_options;
        $options_arcade = $model->gerProductOptions($product_id, $option_key, $options);

        echo json_encode($options_arcade);
    }

}

?>