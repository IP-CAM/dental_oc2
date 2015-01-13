<table class="form">
    <tr>
        <td><?php echo $entry_arcade; ?></td>
        <td>
            <select name="arcade">
                <?php
                echo "<option value=''>Select</option>";
                $selected = "";
                foreach ($arcade_options as $option) {

                    if ($arcade == $option['id']) {
                        $selected = "selected = 'selected'";
                    } else {
                        $selected = "";
                    }
                    echo "<option value='" . $option['id'] . "' " . $selected . ">";
                    echo $option['value'];
                    echo "</option>";
                }
                ?>
            </select>    
            <input type="hidden" name="product_config_id" value="<?php echo $product_config_id; ?>" />
        </td>
    </tr>
    <tr>
        <td><?php echo $entry_tamanho; ?></td>
        <td>
            <select name="tamanho">
                <?php
                $selected = "";
                foreach ($tamanho_options as $option) {

                    if ($tamanho == $option['id']) {
                        $selected = "selected = 'selected'";
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
    </tr>
    <tr>
        <td><?php echo $entry_cor; ?></td>
        <td>
            <select name="cor">
<?php
$selected = "";
foreach ($cor_options as $option) {

    if ($cor == $option['id']) {
        $selected = "selected = 'selected'";
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
    </tr>

</table>