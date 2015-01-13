<?php
foreach ($product_config_options as $keyconf => $conf) {

    echo "<b>" . ucfirst($keyconf) . "</b><br /><br />";
    ?>
    <div id="option-arcade" class="option">


        <?php foreach ($conf as $option_v) { ?>
            <span style="margin-right:10px;">
                <input type="radio" name="option[<?php echo $keyconf ?>]" value="<?php echo $option_v['id']; ?>" id="option-value-<?php echo $option_v['value']; ?>" />
                <label for="option-value-<?php echo $option_v['id']; ?>"><?php echo $option_v['value']; ?>

                </label>
            </span>


        <?php } ?>
    </div>
    <br />
    <?php
}
?>
