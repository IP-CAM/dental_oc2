<?php
if (!empty($this->data['product_config_options_json'])) {
    foreach ($this->data['product_config_options_json'] as $conf_json) {
        $json_data = $conf_json['json_data'];
        $json_data = json_decode($json_data, true);
//        echo "<pre>";
//        print_r($json_data);
//        echo "</pre>";
//        die;
        ?>
        <table class="arcade_parent list" 
               style=";width:80%;margin-top:5px;" cellpadding="0" cellspacing="0">
            <tr>
                <th><?php echo $entry_arcade; ?></th>
                <td>
                    <select class="add_arcade">
                        <?php
                        foreach ($arcade_options as $option) {
                            $selected = "";
                            if ($json_data['arcade'] == $option['id']) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='" . $option['id'] . "' " . $selected . ">";
                            echo $option['value'];
                            echo "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="button" value="Add More" onclick="create_parent_clone(this)" />
                    <input type="button" class="remove_parent" 
                           value="Remove" onclick="remove_parent(this)" />
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <?php
                    if (isset($json_data['toms']) && is_array($json_data['toms'])) {
                        foreach ($json_data['toms'] as $conf_tom) {
                            ?>
                            <table class="tom_table list" style="width:80%;">
                                <tr>
                                    <th><?php echo $entry_tamanho; ?></th>
                                    <td>
                                        <select class="add_tom">
                                            <?php
                                            foreach ($tamanho_options as $option) {
                                                $selected = "";
                                                if ($conf_tom['tom'] == $option['id']) {
                                                    $selected = "selected='selected'";
                                                } else {
                                                    $selected = "";
                                                }
                                                echo "<option value='" . $option['id'] . "' " . $selected . ">";
                                                echo $option['value'];
                                                echo "</option>";
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td>
                                        <input type="button" value="Add More" 
                                               onclick="create_tom_clone(this)" />
                                        <input class="remove_tom" type="button" value="Remove" 
                                               onclick="remove_tom_clone(this)" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <?php
                                        if (isset($conf_tom['cors']) && is_array($conf_tom['cors'])) {
                                            foreach ($conf_tom['cors'] as $conf_cor) {
                                                ?>
                                                <table class="cor_table list" style="width:80%;">
                                                    <tr>
                                                        <th><?php echo $entry_cor; ?></th>
                                                        <td>
                                                            <select class="add_cors">
                                                                <?php
                                                                $selected = "";
                                                                foreach ($cor_options as $option) {
                                                                    $selected = "";
                                                                    if ($conf_cor['cor'] == $option['id']) {
                                                                        $selected = "selected='selected'";
                                                                    } else {
                                                                        $selected = "";
                                                                    }
                                                                    echo "<option value='" . $option['id'] . "' " . $selected . ">";
                                                                    echo $option['value'];
                                                                    echo "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <input class="add_sku" value="<?php echo $conf_cor['sku']; ?>" type="text" placeholder="SKU" />
                                                            <input class="add_qty" value="<?php echo $conf_cor['qty']; ?>" type="text" placeholder="Quantity" />
                                                        </td>
                                                        <td>
                                                            <input type="button" value="Add More" 
                                                                   onclick="create_cor_clone(this)" />
                                                            <input class="remove_cor" type="button" value="Remove" 
                                                                   onclick="remove_cor_clone(this)" />
                                                        </td>
                                                    </tr>
                                                </table>  

                                                <?php
                                            }
                                        }
                                        ?>
                                    </td> 
                                </tr> 
                            </table>
                            <?php
                        }
                    }
                    ?>

                </td>
            </tr> 
        </table>

        <?php
    }
} else {
    ?>
    <table class="arcade_parent list" 
           style=";width:80%;margin-top:5px;" cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $entry_arcade; ?></th>
            <td>
                <select class="add_arcade">
                    <?php
                    foreach ($arcade_options as $option) {
                        $selected = "";

                        echo "<option value='" . $option['id'] . "' " . $selected . ">";
                        echo $option['value'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <input type="button" value="Add More" onclick="create_parent_clone(this)" />
                <input type="button" class="remove_parent" 
                       value="Remove" onclick="remove_parent(this)" />
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table class="tom_table list" style="width:80%;">
                    <tr>
                        <th><?php echo $entry_tamanho; ?></th>
                        <td>
                            <select class="add_tom">
                                <?php
                                foreach ($tamanho_options as $option) {
                                    $selected = "";

                                    echo "<option value='" . $option['id'] . "' " . $selected . ">";
                                    echo $option['value'];
                                    echo "</option>";
                                }
                                ?>

                            </select>
                        </td>
                        <td>
                            <input type="button" value="Add More" 
                                   onclick="create_tom_clone(this)" />
                            <input class="remove_tom" type="button" value="Remove" 
                                   onclick="remove_tom_clone(this)" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="cor_table list" style="width:80%;">
                                <tr>
                                    <th><?php echo $entry_cor; ?></th>
                                    <td>
                                        <select class="add_cors">
                                            <?php
                                            $selected = "";
                                            foreach ($cor_options as $option) {
                                                $selected = "";

                                                echo "<option value='" . $option['id'] . "' " . $selected . ">";
                                                echo $option['value'];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                        <input class="add_sku" type="text" placeholder="SKU" />
                                        <input class="add_qty" type="text" placeholder="Quantity" />
                                    </td>
                                    <td>
                                        <input type="button" value="Add More" 
                                               onclick="create_cor_clone(this)" />
                                        <input class="remove_cor" type="button" value="Remove" 
                                               onclick="remove_cor_clone(this)" />
                                    </td>
                                </tr>
                            </table>  
                        </td> 
                    </tr> 
                </table>  

            </td>
        </tr> 
    </table>
    <?php
}
?>