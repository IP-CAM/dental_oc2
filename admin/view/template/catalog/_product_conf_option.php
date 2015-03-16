<?php
$options_data = array();

if (!empty($this->data['product_config_options_json'])) {
    $json_data = $this->data['product_config_options_json'][0];
    ?>

    <table class="arcade_parent list" 
           style=";width:80%;margin-top:5px;" cellpadding="0" cellspacing="0">
        <input type="hidden" class="conf_ids" name="conf_id" id="conf_id" value="<?php echo $conf_json['id']; ?>" />    
        <tr>
            <th><?php echo $entry_arcade; ?></th>
            <td>
                <select class="add_arcade" name="arcade">
                    <option value="">Select</option>
                    <?php
                    foreach ($arcade_options as $option) {
                        $selected = "";
                        if ($json_data['arcade'] == $option['id']) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";

                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                            $options_data['arcade'][$option['id']] = $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                            $options_data['arcade'][$option['id']] = $option['value'];
                        }

                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
    <!--            <td>


            <?php
//                    if ($query_c->row['count'] > 0) {
//                        echo "<b class='order_associated'>";
//                        echo $query_c->row['count'] . " Order Associated";
//                        echo "</b>";
//                    }
            ?>
            </td>-->
        </tr>
        <tr>
            <th><?php echo $entry_tamanho; ?></th>
            <td>
                <select class="add_tom" name="tamanho">
                    <option value="">Select</option>
                    <?php
                    foreach ($tamanho_options as $option) {
                        $selected = "";
                        if ($json_data['tamanho'] == $option['id']) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                            $options_data['tamanho'][$option['id']] = $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                            $options_data['tamanho'][$option['id']] = $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>

                </select>
            </td>

        </tr>
        <tr>
            <th><?php echo $entry_quantity; ?></th>
            <td>
                <select class="add_quantitdy" name="quantitdy">
                    <option value="">Select</option>
                    <?php
                    foreach ($quantitdy_options as $option) {
                        $selected = "";
                        if ($json_data['quantitdy'] == $option['id']) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                            $options_data['quantitdy'][$option['id']] = $option['value_' . $this->config->get('config_language')];
                            
                        } else {
                            echo $option['value'];
                            $options_data['quantitdy'][$option['id']] = $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>

                </select>
            </td>

        </tr>
        <tr>
            <th><?php echo $entry_cor; ?></th>
            <td>
                <select class="add_cors" name="cor">
                    <option value="">Select</option>
                    <?php
                    $selected = "";
                    foreach ($cor_options as $option) {
                        $selected = "";
                        if ($json_data['cor'] == $option['id']) {
                            $selected = "selected='selected'";
                        } else {
                            $selected = "";
                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                             $options_data['cor'][$option['id']] = $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                            $options_data['cor'][$option['id']] = $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>
                </select>

            </td>

        </tr>
    </table>

    <?php
} else {
    ?>
    <table class="arcade_parent list" 
           style=";width:80%;margin-top:5px;" cellpadding="0" cellspacing="0">
        <input type="hidden" class="conf_ids" name="conf_id" id="conf_id" value="" />    
        <tr>
            <th><?php echo $entry_arcade; ?></th>
            <td>
                <select class="add_arcade" name="arcade">
                    <option value="">Select</option>
                    <?php
                    foreach ($arcade_options as $option) {
                        $selected = "";
//                        if ($json_data['arcade'] == $option['id']) {
//                            $selected = "selected='selected'";
//                        } else {
//                            $selected = "";
//                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";

                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                        }

                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
    <!--            <td>


            <?php
//                    if ($query_c->row['count'] > 0) {
//                        echo "<b class='order_associated'>";
//                        echo $query_c->row['count'] . " Order Associated";
//                        echo "</b>";
//                    }
            ?>
            </td>-->
        </tr>
        <tr>
            <th><?php echo $entry_tamanho; ?></th>
            <td>
                <select class="add_tom" name="tamanho">
                    <option value="">Select</option>
                    <?php
                    foreach ($tamanho_options as $option) {
                        $selected = "";
//                        if ($conf_tom['tom'] == $option['id']) {
//                            $selected = "selected='selected'";
//                        } else {
//                            $selected = "";
//                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>

                </select>
            </td>

        </tr>
        <tr>
            <th><?php echo $entry_quantity; ?></th>
            <td>
                <select class="add_quantitdy" name="quantitdy">
                    <option value="">Select</option>
                    <?php
                    foreach ($quantitdy_options as $option) {
                        $selected = "";
//                        if ($conf_tom['quantitdy'] == $option['id']) {
//                            $selected = "selected='selected'";
//                        } else {
//                            $selected = "";
//                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>

                </select>
            </td>

        </tr>
        <tr>
            <th><?php echo $entry_cor; ?></th>
            <td>
                <select class="add_cors" name="cor">
                    <option value="">Select</option>
                    <?php
                    $selected = "";
                    foreach ($cor_options as $option) {
                        $selected = "";
//                        if ($conf_cor['cor'] == $option['id']) {
//                            $selected = "selected='selected'";
//                        } else {
//                            $selected = "";
//                        }
                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        if ($this->config->get('config_language') != "en") {
                            echo $option['value_' . $this->config->get('config_language')];
                        } else {
                            echo $option['value'];
                        }
                        echo "</option>";
                    }
                    ?>
                </select>

            </td>

        </tr>
    </table>

    <?php
}
?>
<input type="hidden" name="delete_conf_ids" id="delete_conf_ids" value="" />
<br/>
<?php

if (isset($referenc_products) && !empty($referenc_products)) {
    ?>
    <table class="list">
        <thead>
            <tr>
                <td class="left"><?php echo $column_name; ?></td> 
                <td class="left"><?php echo $column_model; ?></td> 
                <td class="left"><?php echo $entry_arcade; ?></td> 
                <td class="left"><?php echo $entry_tamanho; ?></td> 
                <td class="left"><?php echo $entry_quantity; ?></td> 
                <td class="left"><?php echo $entry_cor; ?></td> 
                <td></td>
            </tr>
        </thead>  
        <tbody>
            <?php
            foreach ($referenc_products as $product) {
                ?>
                <tr>
                    <td class="left"><?php echo $product['model']; ?></td> 
                    <td class="left"><?php echo $product['sku']; ?></td> 
                    <td class="left"><?php echo $options_data['arcade'][$product['arcade']]; ?></td> 
                    <td class="left"><?php echo $options_data['tamanho'][$product['tamanho']]; ?></td> 
                    <td class="left"><?php echo $options_data['quantitdy'][$product['quantitdy']]; ?></td> 
                    <td class="left"><?php echo $options_data['cor'][$product['cor']]; ?></td>      
                    <td class="right">
                        <a href="<?php
                        echo $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'].'&product_id='.$product['product_id'] , 'SSL');
                        ?>" >
                        <?php echo $this->language->get('text_edit'); ?>
                        </a>

                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table> 
    <?php
}
?>