<?php

class ModelCatalogProductOptions extends Model {
    /**
     * 
     */
    public function gerProductOptions($product_id, $option_type = 'arcade',$options_arr = array()){
        $options_types = array(
            'arcade'=>'arcade',
            'cor'=>'cor',
            'quantitdy'=>'quantity',
            'tamanho'=>'tamanho',
        );
        
        $sub_query = "SELECT product_id FROM ".DB_PREFIX."product WHERE referenc_id =".$product_id;
        $column = "value";
        if($this->config->get('config_language')!="en"){
            $column = "value_".$this->config->get('config_language');
        }
        $sql = "Select DISTINCT($option_type) as option_id,$column as value FROM ".DB_PREFIX."product_config_options t INNER JOIN ".
            " ".DB_PREFIX."conf_product_".$options_types[$option_type]." op ON op.id = t.".$option_type." WHERE t.product_id IN($sub_query) ";
        $sql.= ' ';
        
       
        $where = '';
        if(!empty($options_arr)){
             $where = array();
            foreach($options_arr as $key=>$option){
              $where[] = "t.".$key.' = '.$option;
            }
            if(!empty($where)){
                $where = "AND ".implode(" AND ", $where);
            }
        }
        $sql.= $where;
//        echo $sql;
//        die;
        $query = $this->db->query($sql);
        return $query->rows;
    }
}

?>
