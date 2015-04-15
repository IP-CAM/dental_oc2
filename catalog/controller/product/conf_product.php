<?php

class ControllerProductConfProduct extends Controller {

    public $options_types = array(
  
        'tamanho' => 'tamanho',
        'quantitdy' => 'quantitdy',
        'cor' => 'cor',
    );

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
        $option_name = $option_key;
        if(empty($options_arcade)){
            unset($this->options_types[$this->request->get['option_key']]);
            //to save recursion
            if($this->request->get['option_key']=='quantitdy'){
                unset($this->options_types['tamanho']);
            }
            foreach($this->options_types as $option){
               $options_arcade = $model->gerProductOptions($product_id, $option, $options);
               $option_name = $option;
               break;
            }
        }
        $data['option_name'] = $option_name;
        $data['data'] = $options_arcade;
        echo json_encode($data);
    }

}

?>