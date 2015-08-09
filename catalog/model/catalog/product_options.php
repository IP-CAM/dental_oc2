<?php

class ModelCatalogProductOptions extends Model {

    /**
     * 
     */
    public function gerProductOptions($product_id, $option_type = 'arcade', $options_arr = array()) {
        $options_types = array(
            'arcade' => 'arcade',
            'tamanho' => 'tamanho',
            'quantitdy' => 'quantity',
            'cor' => 'cor',
        );

        $sub_query = "SELECT product_id FROM ( ";
        $sub_query.= " SELECT product_id FROM " . DB_PREFIX . "product WHERE referenc_id =" . $product_id;
        $sub_query.= " UNION SELECT product_id FROM " . DB_PREFIX . "product WHERE product_id =" . $product_id;
        $sub_query.= " ) as product_view ";
        $column = "value";
        if ($this->config->get('config_language') != "en") {
            $column = "value_" . $this->config->get('config_language');
        }
        $sql = "Select DISTINCT($option_type) as option_id,$column as value,t.product_id,prod.price,prod.model,prod.status as product_status,prod_desc.name,prod.quantity,ss.name as stock_status,prod.tax_class_id,prod_sp.price as special FROM " . DB_PREFIX . "product_config_options t INNER JOIN " .
                " " . DB_PREFIX . "conf_product_" . $options_types[$option_type] . " op ON op.id = t." . $option_type .
                " INNER JOIN " . DB_PREFIX . "product  as prod ON prod.product_id = t.product_id " .
                " LEFT JOIN " . DB_PREFIX . "product_description  as prod_desc ON prod.product_id = prod_desc.product_id " .
                " AND language_id = '" . (int) $this->config->get('config_language_id') . "'" .
                " LEFT JOIN " . DB_PREFIX . "stock_status  as ss ON ss.stock_status_id = prod.stock_status_id " .
                " LEFT JOIN " . DB_PREFIX . "product_special as prod_sp ON t.product_id = prod_sp.product_id " .
                "  WHERE t.product_id IN($sub_query) ";
        $sql.= ' ';


        $where = '';
        if (!empty($options_arr)) {
            $where = array();
            foreach ($options_arr as $key => $option) {
                if ($option != "undefined") {
                    $where[] = "t." . $key . ' = ' . $option;
                }
            }
            if (!empty($where)) {
                $where = "AND " . implode(" AND ", $where);
            }
        }
        $sql.= $where . ' group by   ' . $option_type;



        $query = $this->db->query($sql);
        $options_return = array();
        foreach ($query->rows as $key => $option) {
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $option['price'] = $this->currency->format($this->tax->calculate($option['price'], $option['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $option['price'] = false;
            }

            if ($this->config->get('config_tax')) {
                $option['tax'] = $this->currency->format((float) $option['special'] ? $option['special'] : $option['price']);
            } else {
                $option['tax'] = false;
            }

            if ((float) $option['special']) {
                $option['special'] = $this->currency->format($this->tax->calculate($option['special'], $option['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $option['special'] = false;
            }

            if ($option['product_status'] == 0) {
                $option['stock_status'] = '';
            }

            $options_return[$key] = $option;
        }
        return $options_return;
    }

    public function getOptionCount($product_id, $column) {
        $sub_query = "SELECT product_id FROM " . DB_PREFIX . "product WHERE referenc_id =" . $product_id;

        $sql = "Select count($column) as count FROM " . DB_PREFIX . "product_config_options t  " .
                " " . " WHERE t.product_id IN($sub_query) AND t.$column IS NOT NULL AND t.$column<>'' ";
        $sql.= ' ';

        return $this->db->query($sql)->row['count'];
    }

    public function get_product_option($product_id) {
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $sql = "Select p.model,pd.name,pd.description,p.image FROM  " . DB_PREFIX . "product p " .
                " LEFT JOIN " . DB_PREFIX . "product_description  as pd ON p.product_id = pd.product_id " .
                " WHERE p.product_id = " . $product_id;

        $results = $this->model_catalog_product->getProductImages($product_id);


        $images = array();
        foreach ($results as $result) {
            $images[] = array(
                'popup' => $this->model_tool_image->resize_for_email($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
                'thumb' => $this->model_tool_image->resize_for_email($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
            );
        }
        
        $row = $this->db->query($sql)->row;
        if(!empty($row['image'])){
            $row['image'] = $this->model_tool_image->resize_for_email($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_width'));
            $row['image_popup'] = $this->model_tool_image->resize_for_email($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_width'));
            $row['image_thumb'] = $this->model_tool_image->resize_for_email($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'));
        }
        else {
            $row['image'] = 'http://eunicesolucoes.web1129.kinghost.net/download/not_available.jpg';
        }
       
        return array('product'=>$row,'images'=>$images);
    }

}

?>
