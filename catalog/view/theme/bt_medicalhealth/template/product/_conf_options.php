
<script>
    var arcades = [];
    var all_options = <?php echo json_encode($product_config_all);
?>;
</script>
<?php
$this->load->model('catalog/product_options');
$options_arcade = $this->model_catalog_product_options->gerProductOptions($product_id);


$arcade_count = $this->model_catalog_product_options->getOptionCount($product_id, 'arcade');

$tamanho_count = $this->model_catalog_product_options->getOptionCount($product_id, 'tamanho');
$quantitdy_count = $this->model_catalog_product_options->getOptionCount($product_id, 'quantitdy');
$cor_count = $this->model_catalog_product_options->getOptionCount($product_id, 'cor');
?>
<script type="text/javascript">
    var arcade_count = <?php echo $arcade_count; ?>;
    var tamanho_count = <?php echo $tamanho_count; ?>;
    var quantitdy_count = <?php echo $quantitdy_count; ?>;
    var cor_count = <?php echo $cor_count; ?>;
</script>

<?php
$level_tree = array();
if (!empty($options_arcade)) {
    $level_tree[] = 'arcade';
}

if ($arcade_count > 0) {
    echo "<b>Arcade</b><br /><br />";
    ?>
    <div id="option-arcade" class="option">
        <?php
        $index = 0;
        foreach ($options_arcade as $option_v) {
            ?>
            <span style="margin-right:10px;">
                <input db_id="<?php echo $option_v['option_id']; ?>" 
                       index="<?php echo $index ?>" type="radio" name="option[arcade]" 
                       product_id="<?php echo $option_v['product_id']; ?>" 
                       value="<?php echo $option_v['option_id']; ?>" 
                       price="<?php echo $option_v['price']; ?>"
                       tax="<?php echo $option_v['tax']; ?>"
                       special="<?php echo $option_v['special']; ?>"
                       quantity="<?php echo $option_v['quantity']; ?>"
                       id="option-value-<?php echo $option_v['option_id']; ?>" />
                <label for="option-value-<?php echo $option_v['option_id']; ?>"><?php echo $option_v['value']; ?>

                </label>
            </span>
            <?php
            $index++;
        }
        ?>
    </div>
    <br/>
    <?php
}
?>
<?php
if ($tamanho_count > 0) {
    echo "<b>Tamanho</b><br /><br />";
    ?>
    <div id="option-tom" class="option">
        <?php
        if ($arcade_count == 0) {
            $options_tamanho = $this->model_catalog_product_options->gerProductOptions($product_id, 'tamanho');

            if (!empty($options_tamanho)) {
                $level_tree[] = 'tamanho';

                $index = 0;
                foreach ($options_tamanho as $option_v) {
                    ?>
                    <span style="margin-right:10px;">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[tamanho]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               id="option-value-<?php echo $option_v['option_id']; ?>" />
                        <label for="option-value-<?php echo $option_v['option_id']; ?>"><?php echo $option_v['value']; ?>

                        </label>
                    </span>
                    <?php
                    $index++;
                }
            }
        }
        ?>
    </div>
    <?php
}
?>
<br/>
<?php
if ($quantitdy_count > 0) {
    echo "<b>Quantitdy</b><br /><br />";
    ?>

    <div id="option-quantitdy" class="option">
        <?php
        if ($arcade_count == 0 && $tamanho_count == 0) {
            $options_quantitdy = $this->model_catalog_product_options->gerProductOptions($product_id, 'quantitdy');
            if (!empty($options_quantitdy)) {

                $level_tree[] = 'quantitdy';

                $index = 0;
                foreach ($options_quantitdy as $option_v) {
                    ?>
                    <span style="margin-right:10px;">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[quantitdy]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               id="option-value-<?php echo $option_v['option_id']; ?>" />
                        <label for="option-value-<?php echo $option_v['option_id']; ?>"><?php echo $option_v['value']; ?>

                        </label>
                    </span>
                    <?php
                    $index++;
                }
            }
        }
        ?>
    </div>
    <?php
}
?>
<br/>
<?php
if ($cor_count > 0) {
    echo "<b>Cor</b><br /><br />";
    ?>

    <div id="option-cor" class="option">
        <?php
        if ($arcade_count == 0 && $tamanho_count == 0 && $quantitdy_count == 0) {
            $options_cor = $this->model_catalog_product_options->gerProductOptions($product_id, 'cor');
            if (!empty($options_cor)) {

                $level_tree[] = 'cor';

                $index = 0;
                foreach ($options_cor as $option_v) {
                    ?>
                    <span style="margin-right:10px;">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[cor]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               id="option-value-<?php echo $option_v['option_id']; ?>" />
                        <label for="option-value-<?php echo $option_v['option_id']; ?>"><?php echo $option_v['value']; ?>

                        </label>
                    </span>
                    <?php
                    $index++;
                }
            }
        }
        ?>
    </div>
    <?php
}
?>
<input type="hidden" id="conf_option_id" name="option[conf_id]" value="" />

<script>
    $(function() {
        $("#option-arcade input").click(function() {
            loader_box.show();
            un_prop_all();
            reset_tam();
            reset_quantitdy();
            reset_cor();
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=tamanho&option[arcade]=" + $(this).val();

            $.getJSON(url, function(data) {
                if (data.length > 0) {
                    renderToms(data);
                }
                else {
                    $('input[type=hidden][name=product_id]').val($(this).attr('product_id'));
                    $("span.price-text").html($(this).attr("price"));
                    $("span.product_tax").html($(this).attr("tax"));
                }
                loader_box.hide();
            });
            //renderToms(arcades[index_v]);

        })
        $("#option-tom input").live('click', function() {
            loader_box.show();
            un_prop_all();
            reset_quantitdy();
            reset_cor();
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=quantitdy&option[tamanho]=" + $(this).val();
            if (arcade_count != 0) {
                url += "&option[arcade]=" + $("#option-arcade input:checked").val();
            }
            $.getJSON(url, function(data) {
                if (data.length > 0) {
                    renderQuantity(data);
                }
                else {
                    $('input[type=hidden][name=product_id]').val($(this).attr('product_id'));
                    $("span.price-text").html($(this).attr("price"));
                    $("span.product_tax").html($(this).attr("tax"));
                }

                loader_box.hide();
            });

        })
        $("#option-quantitdy input").live('click', function() {
            loader_box.show();
            un_prop_all();
            reset_cor();
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=cor&option[quantitdy]=" + $(this).val();
            if (arcade_count != 0) {
                url += "&option[arcade]=" + $("#option-arcade input:checked").val();
            }
            if (tamanho_count != 0) {
                url += "&option[tamanho]=" + $("#option-tom input:checked").val();
            }
            $.getJSON(url, function(data) {
                if (data.length > 0) {
                    renderCor(data);
                }
                else {
                    $('input[type=hidden][name=product_id]').val($(this).attr('product_id'));
                    $("span.price-text").html($(this).attr("price"));
                    $("span.product_tax").html($(this).attr("tax"));
                }

                loader_box.hide();
            });

        })

        $("#option-cor input").live('click', function() {
            $('input[type=hidden][name=product_id]').val($(this).attr('product_id'));
            $("span.price-text").html($(this).attr("price"));
            $("span.product_tax").html($(this).attr("tax"));
        })

    })

    function renderToms(toms) {
        htm = "";
        $.each(toms, function(k, v) {
            index = 0;
            console.log(v);
            htm += '<span style="margin-right:10px;">' +
                    '<input index="' + index + '" type="radio" name="option[tamanho]"' +
                    'value="' + v['option_id'] + '" ' +
                    'product_id="' + v['product_id'] + '" ' +
                    'price="' + v['price'] + '" ' +
                    'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' +
                    'quantity="' + v['quantity'] + '" ' +
                    'id="option-value-' + v['option_id'] + '" />' +
                    '<label for="option-value-' + v['option_id'] + '">' + v['value'] +
                    '</label>' +
                    '</span>';
            index++;
        })

        $("#option-tom").html(htm);
    }

    function renderQuantity(quantaties) {

        htm = "";
        disabled = '';

        $.each(quantaties, function(k, v) {
            htm += '<span style="margin-right:10px;">' +
                    '<input  type="radio" name="option[quantitdy]"' +
                    'value="' + v['option_id'] + '" ' +
                    'product_id="' + v['product_id'] + '" ' +
                    'price="' + v['price'] + '" ' +
                    'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' +
                    'quantity="' + v['quantity'] + '" ' +
                    'id="option-value-' + v['option_id'] + '" ' + disabled + ' ' + v['value'] + ' />' +
                    '<label for="option-value-' + v['option_id'] + '">' + v['value'] +
                    '</label>' +
                    '</span>';
        })

        $("#option-quantitdy").html(htm);

    }
    function renderCor(cors) {

        htm = "";
        disabled = '';

        $.each(cors, function(k, v) {
            htm += '<span style="margin-right:10px;">' +
                    '<input  type="radio" name="option[cor]"' +
                    'value="' + v['option_id'] + '" ' +
                    'product_id="' + v['product_id'] + '" ' +
                    'price="' + v['price'] + '" ' +
                    'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' +
                    'quantity="' + v['quantity'] + '" ' +
                    'id="option-value-' + v['option_id'] + '" ' + disabled + ' ' + v['value'] + ' />' +
                    '<label for="option-value-' + v['option_id'] + '">' + v['value'] +
                    '</label>' +
                    '</span>';
        })

        $("#option-cor").html(htm);

    }

    function un_prop_all() {
        $('input[type="checkbox"]').prop('checked', false);


    }

    function reset_tam() {
        if (tamanho_count != 0) {
            $("#option-tom").html('');
        }
    }
    function reset_quantitdy() {
        if (quantitdy_count != 0) {
            $("#option-quantitdy").html('');
        }
    }
    function reset_cor() {
        if (cor_count != 0) {
            $("#option-cor").html('');
        }
    }
</script>