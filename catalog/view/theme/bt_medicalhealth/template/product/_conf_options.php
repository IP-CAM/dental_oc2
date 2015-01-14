<?php
$product_config_options_arc = $product_config_options['arcade'];
echo "<b>Arcade</b><br /><br />";
?>
<div id="option-arcade" class="option">
    <?php foreach ($product_config_options_arc as $option_v) { ?>
        <span style="margin-right:10px;">
            <input type="radio" name="option[<?php echo $keyconf ?>]" value="<?php echo $option_v['id']; ?>" id="option-value-<?php echo $option_v['value']; ?>" />
            <label for="option-value-<?php echo $option_v['id']; ?>"><?php echo $option_v['value']; ?>

            </label>
        </span>
    <?php } ?>
</div>
<div id="option-arcade" class="option">
     <?php 
        foreach ($product_config_options_arc as $option_v) {
        $json_data = $option_v['json_data'];
        $json_data = json_decode($json_data,true);
            
     ?>
        <span style="margin-right:10px;">
            <input type="radio" name="option[<?php echo $keyconf ?>]" value="<?php echo $option_v['id']; ?>" id="option-value-<?php echo $option_v['value']; ?>" />
            <label for="option-value-<?php echo $option_v['id']; ?>"><?php echo $option_v['value']; ?>

            </label>
        </span>
    <?php } ?>
</div>
<br />
<?php

?>
