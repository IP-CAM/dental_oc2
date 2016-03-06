<?php
$stock_statuses = array(
    "in_stock" => $this->language->get('text_instock'),
    "out_of_stock" => $this->language->get('text_outstock')
);
?>
<script>
    var arcades = [];
    var all_options = <?php echo json_encode($product_config_all); ?>;
    var stock_statuses = <?php echo json_encode($stock_statuses); ?>;


</script>
<style>
    div.right div.option {
        min-width: 490px;
    }
</style>
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
    echo "<b class='label_arcade label_option'>Arcada</b><br /><br />";
    ?>
    <div id="option-arcade" class="option">
        <?php
        $index = 0;
        foreach ($options_arcade as $option_v) {
            $title_alt = '';
            if ($option_v['quantity'] <= 0) {
//                if ($option_v['stock_status'] == 'Out Of Stock') {
//                    $title_alt = $stock_statuses['out_of_stock'];
//                } else {
//                    $title_alt = $option_v['stock_status'];
//                }
                //When product quantiy in backend 0 = Fora de estoque in product option
                $title_alt = $stock_statuses['out_of_stock'];
            } else if ($option_v['quantity'] > 0) {
                $title_alt = $stock_statuses['in_stock'];
            } else {
                $title_alt = $stock_statuses['in_stock'];
            }
            ?>
            <span style="margin-right:10px;" alt="<?php echo $title_alt; ?>" title="<?php echo $title_alt; ?>">
                <input db_id="<?php echo $option_v['option_id']; ?>" 
                       index="<?php echo $index ?>" type="radio" name="option[arcade]" 
                       product_id="<?php echo $option_v['product_id']; ?>" 
                       value="<?php echo $option_v['option_id']; ?>" 
                       price="<?php echo $option_v['price']; ?>"
                       tax="<?php echo $option_v['tax']; ?>"
                       special="<?php echo $option_v['special']; ?>"
                       quantity="<?php echo $option_v['quantity']; ?>"
                       p_name="<?php echo $option_v['name']; ?>"
                       model="<?php echo $option_v['model']; ?>"
                       product_on_phone="<?php echo $option_v['product_on_phone']; ?>"
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
    echo "<b class='label_tamanho label_option'>Tamanho</b><br /><br />";
    ?>
    <div id="option-tom" class="option">
        <?php
        if ($arcade_count == 0) {
            $options_tamanho = $this->model_catalog_product_options->gerProductOptions($product_id, 'tamanho');

            if (!empty($options_tamanho)) {
                $level_tree[] = 'tamanho';
                echo "<select id='option-tom-select'>";
                echo '<option value=""></option>';
                foreach ($options_tamanho as $option_v) {
                    $stock_status_class = '';
                    $stoc_css = '';
                    if ($option_v['quantity'] <= 0) {
                        if ($option_v['stock_status'] == 'Fora de Estoque') {
                            //$stock_status_class = ' **não disponível';
                            $stoc_css = 'red_staric';
                        } else {
                            
                        }
                    } else if ($option_v['quantity'] > 0) {
                        
                    } else {
                        
                    }

                    if ($option_v['stock_status'] != "Em Estoque") {
                        //$stock_status_class = ' **não disponível';
                        $stoc_css = 'red_staric';
                    }
                    echo "<option class='$stoc_css' value='" . $option_v['option_id'] . "' product_id='" . $option_v['product_id'] . "'>";
                    echo $option_v['value'] . $stock_status_class;
                    echo "</option>";
                }
                echo "</select>";
                $index = 0;
                foreach ($options_tamanho as $option_v) {
                    $title_alt = '';
                    if ($option_v['quantity'] <= 0) {
//                        if ($option_v['stock_status'] == 'Out Of Stock') {
//                            $title_alt = $stock_statuses['out_of_stock'];
//                        } else {
//                            $title_alt = $option_v['stock_status'];
//                        }
                        //When product quantiy in backend 0 = Fora de estoque in product option
                        $title_alt = $stock_statuses['out_of_stock'];
                    } else if ($option_v['quantity'] > 0) {
                        $title_alt = $stock_statuses['in_stock'];
                    } else {
                        $title_alt = $stock_statuses['in_stock'];
                    }
                    ?>
                    <span style="display:none;margin-right:10px;" alt="<?php echo $title_alt; ?>" title="<?php echo $title_alt; ?>">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[tamanho]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               p_name="<?php echo $option_v['name']; ?>"
                               model="<?php echo $option_v['model']; ?>"
                               product_on_phone="<?php echo $option_v['product_on_phone']; ?>"
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
    echo "<b class='label_quantitdy label_option'>Voltagem</b><br /><br />";
    ?>

    <div id="option-quantitdy" class="option">
        <?php
        if ($arcade_count == 0 && $tamanho_count == 0) {
            $options_quantitdy = $this->model_catalog_product_options->gerProductOptions($product_id, 'quantitdy');
            if (!empty($options_quantitdy)) {

                $level_tree[] = 'quantitdy';

                echo "<select id='option-quantitdy-select'>";
                echo '<option value=""></option>';
                foreach ($options_quantitdy as $option_v) {
                    $stock_status_class = '';
                    $stoc_css = '';
                    if ($option_v['quantity'] <= 0) {
                        if ($option_v['stock_status'] == 'Out Of Stock') {
                            //$stock_status_class = ' **não disponível';
                            $stoc_css = 'red_staric';
                        } else {
                            
                        }
                    } else if ($option_v['quantity'] > 0) {
                        
                    } else {
                        
                    }

                    echo "<option class='$stoc_css' value='" . $option_v['option_id'] . "' product_id='" . $option_v['product_id'] . "'>";
                    echo $option_v['value'] . $stock_status_class;
                    echo "</option>";
                }
                echo "</select>";

                $index = 0;
                foreach ($options_quantitdy as $option_v) {
                    $title_alt = '';
                    if ($option_v['quantity'] <= 0) {
//                        if ($option_v['stock_status'] == 'Out Of Stock') {
//                            $title_alt = $stock_statuses['out_of_stock'];
//                        } else {
//                            $title_alt = $option_v['stock_status'];
//                        }
                        //When product quantiy in backend 0 = Fora de estoque in product option
                        $title_alt = $stock_statuses['out_of_stock'];
                    } else if ($option_v['quantity'] > 0) {
                        $title_alt = $stock_statuses['in_stock'];
                    } else {
                        $title_alt = $stock_statuses['in_stock'];
                    }
                    ?>
                    <span style="display:none;margin-right:10px;" alt="<?php echo $title_alt; ?>" title="<?php echo $title_alt; ?>">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[quantitdy]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               p_name="<?php echo $option_v['name']; ?>"
                               model="<?php echo $option_v['model']; ?>"
                               product_on_phone="<?php echo $option_v['product_on_phone']; ?>"
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
    echo "<b class='label_cor label_option'>Cor</b><br /><br />";
    ?>

    <div id="option-cor" class="option">
        <?php
        if ($arcade_count == 0 && $tamanho_count == 0 && $quantitdy_count == 0) {
            $options_cor = $this->model_catalog_product_options->gerProductOptions($product_id, 'cor');
            if (!empty($options_cor)) {

                $level_tree[] = 'cor';

                echo "<select id='option-cor-select'>";
                echo '<option value=""></option>';
                foreach ($options_cor as $option_v) {
                    $stock_status_class = '';
                    $stoc_css = '';
                    if ($option_v['quantity'] <= 0) {
                        if ($option_v['stock_status'] == 'Out Of Stock') {
                            //$stock_status_class = ' **não disponível';
                            $stoc_css = 'red_staric';
                        } else {
                            
                        }
                    } else if ($option_v['quantity'] > 0) {
                        
                    } else {
                        
                    }

                    echo "<option class='$stoc_css' value='" . $option_v['option_id'] . "' product_id='" . $option_v['product_id'] . "'>";
                    echo $option_v['value'] . $stock_status_class;
                    echo "</option>";
                }
                echo "</select>";

                $index = 0;
                foreach ($options_cor as $option_v) {
                    $title_alt = '';
                    if ($option_v['quantity'] <= 0) {
//                        if ($option_v['stock_status'] == 'Out Of Stock') {
//                            $title_alt = $stock_statuses['out_of_stock'];
//                        } else {
//                            $title_alt = $option_v['stock_status'];
//                        }
                        //When product quantiy in backend 0 = Fora de estoque in product option
                        $title_alt = $stock_statuses['out_of_stock'];
                    } else if ($option_v['quantity'] > 0) {
                        $title_alt = $stock_statuses['in_stock'];
                    } else {
                        $title_alt = $stock_statuses['in_stock'];
                    }
                    ?>
                    <span style="display:none;margin-right:10px;" alt="<?php echo $title_alt; ?>" title="<?php echo $title_alt; ?>">
                        <input db_id="<?php echo $option_v['option_id']; ?>" index="<?php echo $index ?>" type="radio" name="option[cor]" 
                               value="<?php echo $option_v['option_id']; ?>" 
                               product_id="<?php echo $option_v['product_id']; ?>"
                               price="<?php echo $option_v['price']; ?>"
                               tax="<?php echo $option_v['tax']; ?>"
                               special="<?php echo $option_v['special']; ?>"
                               quantity="<?php echo $option_v['quantity']; ?>"
                               p_name="<?php echo $option_v['name']; ?>"
                               model="<?php echo $option_v['model']; ?>"
                               product_on_phone="<?php echo $option_v['product_on_phone']; ?>"
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

<div id="availability_status" style="margin-top:10px;"></div>
<input type="hidden" id="conf_option_id" name="option[conf_id]" value="" />

<script>
    function IsEmail_valid(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    $(function () {
        $("#button-stock_email").click(function () {
            if ($("#email_for_stock").val() != "" && IsEmail_valid($("#email_for_stock").val())) {
                loader_box.show();
                url = "?route=product/conf_product/send_email&product_id=" + $('input[type=hidden][name=product_id]').val();
                url += '&email=' + $("#email_for_stock").val();

                $.getJSON(url, function (data) {
                    console.log(data);
                    loader_box.hide();
                    alert("E-mail enviado com sucesso");
                })
            }
            else {
                alert("Não válido de e-mail");
            }

        })
        $("#option-cor-select").live('change', function () {
            if ($(this).val() != "") {
                console.log($("#option-cor span input[value='" + $(this).val() + "']"));
                $("#option-cor span input[value='" + $(this).val() + "']").trigger("click");
            }
        });
        $("#option-tom-select").live('change', function () {
            if ($(this).val() != "") {
                $("#option-tom span input[value='" + $(this).val() + "']").trigger("click");
            }
        });
        $("#option-quantitdy-select").live('change', function () {
            if ($(this).val() != "") {
                $("#option-quantitdy span input[value='" + $(this).val() + "']").trigger("click");
            }
        });
        $("#option-arcade input").click(function () {
            ob = $(this);
            loader_box.show();
            un_prop_all();
            reset_tam();
            reset_quantitdy();
            reset_cor();
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=tamanho&option[arcade]=" + $(this).val();

            $.getJSON(url, function (data) {
                if (data['data'].length > 0) {
                    $(".label_option").show();
                    if (data['option_name'] == 'tamanho') {

                        renderToms(data);
                    }
                    else if (data['option_name'] == 'quantitdy') {
                        $(".label_tamanho").hide();
                        renderQuantity(data);
                    }
                    else if (data['option_name'] == 'cor') {
                        $(".label_tamanho").hide();
                        $(".label_quantitdy").hide();
                        renderCor(data);
                    }

                }
                else {
                    $('input[type=hidden][name=product_id]').val($(ob).attr('product_id'));
                    $("span.price-text").html($(ob).attr("price"));
                    $("span.product_tax").html($(ob).attr("tax"));
                    $("#title_heading").html($(ob).attr("p_name"));
                    $("#text_model").html($(ob).attr("model"));
                    $("#stock_status").html($(ob).parent().attr("title"));

                    if (stock_statuses['out_of_stock'] == $(ob).parent().attr("title")) {
                        $("#availability_status").attr("class", "red_color");
                        $("#stock_status").addClass("stock_danger");
                        $(".stock_email").show();
                    }
                    else {
                        $("#availability_status").attr("class", "green_color");
                        $("#stock_status").removeClass("stock_danger");
                        $(".stock_email").hide();
                    }
                    $("#availability_status").html($(ob).parent().attr("title"));
                    $("#stock_status").html($(ob).parent().attr("title"));

                    if ($(ob).attr("product_on_phone") == '1') {
                        $("#button-cart-phone").show();
                        $("#button-cart").hide();
                    }
                    else {
                        //
                        $("#button-cart-phone").hide();
                        $("#button-cart").show();
                    }
                }
                loader_box.hide();
            });
            //renderToms(arcades[index_v]);

        })
        $("#option-tom input").live('click', function () {
            ob = $(this);
            loader_box.show();
            un_prop_all();
            reset_quantitdy();
            reset_cor();
            url = "?route=product/conf_product/options&product_id=<?php echo $product_id; ?>";
            url += "&option_key=quantitdy&option[tamanho]=" + $(this).val();
            if (arcade_count != 0) {
                url += "&option[arcade]=" + $("#option-arcade input:checked").val();
            }
            $.getJSON(url, function (data) {
                if (data['data'].length > 0) {
                    $(".label_option").show();
                    if (data['option_name'] == 'quantitdy') {

                        renderQuantity(data);
                    }
                    else if (data['option_name'] == 'cor') {

                        renderCor(data);
                    }
                }
                else {
                    $('input[type=hidden][name=product_id]').val($(ob).attr('product_id'));
                    $("span.price-text").html($(ob).attr("price"));
                    $("span.product_tax").html($(ob).attr("tax"));

                    $("#title_heading").html($(ob).attr("p_name"));
                    $("#text_model").html($(ob).attr("model"));
                    $("#stock_status").html($(ob).parent().attr("title"));
                    if (stock_statuses['out_of_stock'] == $(ob).parent().attr("title")) {
                        $("#availability_status").attr("class", "red_color");
                        $("#stock_status").addClass("stock_danger");
                        $(".stock_email").show();
                    }
                    else {
                        $("#availability_status").attr("class", "green_color");
                        $("#stock_status").removeClass("stock_danger");
                        $(".stock_email").hide();
                    }
                    $("#availability_status").html($(ob).parent().attr("title"));
                    $("#stock_status").html($(ob).parent().attr("title"));
                    
                    if ($(ob).attr("product_on_phone") == '1') {
                        $("#button-cart-phone").show();
                        $("#button-cart").hide();
                    }
                    else {
                        //
                        $("#button-cart-phone").hide();
                        $("#button-cart").show();
                    }
                }

                loader_box.hide();
            });

        })
        $("#option-quantitdy input").live('click', function () {
            ob = $(this);
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
            $.getJSON(url, function (data) {
                if (data['data'].length > 0) {
                    renderCor(data);
                }
                else {

                    $('input[type=hidden][name=product_id]').val($(ob).attr('product_id'));
                    $("span.price-text").html($(ob).attr("price"));
                    $("span.product_tax").html($(ob).attr("tax"));
                    $("#title_heading").html($(ob).attr("p_name"));
                    $("#text_model").html($(ob).attr("model"));

                    if ($(ob).attr("product_on_phone") == '1') {
                        $("#button-cart-phone").show();
                        $("#button-cart").hide();
                    }
                    else {
                        //
                        $("#button-cart-phone").hide();
                        $("#button-cart").show();
                    }
                }

                loader_box.hide();
            });

        })

        $("#option-cor input").live('click', function () {
            $('input[type=hidden][name=product_id]').val($(this).attr('product_id'));
            $("span.price-text").html($(this).attr("price"));
            $("span.product_tax").html($(this).attr("tax"));
            $("#title_heading").html($(this).attr("p_name"));
            $("#text_model").html($(this).attr("model"));
            
            console.log($(this).parent().attr("title"));
            console.log(stock_statuses['out_of_stock']);
            
           

            if (stock_statuses['out_of_stock'] == $(this).parent().attr("title")) {
                $("#availability_status").attr("class", "red_color");
                $("#stock_status").addClass("stock_danger");
                $(".stock_email").show();
            }
            else {
                $("#availability_status").attr("class", "green_color");
                $("#stock_status").removeClass("stock_danger");
                $(".stock_email").hide();
            }
            $("#availability_status").html($(this).parent().attr("title"));
            $("#stock_status").html($(this).parent().attr("title"));

            if ($(this).attr("product_on_phone") == '1') {
                $("#button-cart-phone").show();
                $("#button-cart").hide();
            }
            else {
                //
                $("#button-cart-phone").hide();
                $("#button-cart").show();
            }

        })

    })

    function renderToms(toms) {
        htm = "";

        htm += "<select id='option-tom-select'>";
        htm += '<option value=""></option>';
        $.each(toms['data'], function (k, v) {
            stock_status_class = '';
            stock_css = '';
            if (v['quantity'] <= 0) {
                if (v['stock_status'] == 'Out Of Stock') {
                    //stock_status_class = ' **não disponível';
                    stock_css = 'red_staric';
                }
                else {

                }

            }

            htm += "<option class='" + stock_css + "' value='" + v['option_id'] + "' product_id='" + v['product_id'] + "'>";
            htm += v['value'] + stock_status_class;
            htm += "</option>";

        });
        htm += "</select>";
        $.each(toms['data'], function (k, v) {
            index = 0;

            title_alt = '';
            if (v['quantity'] <= 0) {
//                if (v['stock_status'] == 'Out Of Stock') {
//                    title_alt = stock_statuses['out_of_stock'];
//                }
//                else {
//                    title_alt = v['stock_status'];
//                }
                //When product quantiy in backend 0 = Fora de estoque in product option
                title_alt = stock_statuses['out_of_stock'];

            } else if (v['quantity'] > 0) {
                title_alt = stock_statuses['in_stock'];
            } else {
                title_alt = stock_statuses['in_stock'];
            }
            htm += '<span style="display:none;margin-right:10px;" alt="' + title_alt + '" title="' + title_alt + '">' +
                    '<input index="' + index + '" type="radio" name="option[tamanho]"' +
                    'value="' + v['option_id'] + '" ' +
                    'product_id="' + v['product_id'] + '" ' +
                    'price="' + v['price'] + '" ' +
                    'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' +
                    'quantity="' + v['quantity'] + '" ' +
                    'p_name="' + v['name'] + '" ' +
                    'model="' + v['model'] + '" ' +
                    'product_on_phone="' + v['product_on_phone'] + '" ' +
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

        htm += "<select id='option-quantitdy-select'>";
        htm += '<option value=""></option>';
        $.each(quantaties['data'], function (k, v) {
            stock_status_class = '';
            stock_css = '';
            if (v['quantity'] <= 0) {
                if (v['stock_status'] == 'Out Of Stock') {
                    //stock_status_class = ' **não disponível';
                    stock_css = 'red_staric';
                }
                else {

                }

            }
            htm += "<option class='" + stock_css + "' value='" + v['option_id'] + "' product_id='" + v['product_id'] + "'>";
            htm += v['value'] + stock_status_class;
            htm += "</option>";

        });
        htm += "</select>";



        $.each(quantaties['data'], function (k, v) {
            title_alt = '';

            if (v['quantity'] <= 0) {
//                if (v['stock_status'] == 'Out Of Stock') {
//                    title_alt = stock_statuses['out_of_stock'];
//                }
//                else {
//                    title_alt = v['stock_status'];
//                }
//When product quantiy in backend 0 = Fora de estoque in product option
                title_alt = stock_statuses['out_of_stock'];

            } else if (v['quantity'] > 0) {
                title_alt = stock_statuses['in_stock'];
            } else {
                title_alt = stock_statuses['in_stock'];
            }
            htm += '<span style="display:none;margin-right:10px;" alt="' + title_alt + '" title="' + title_alt + '">' +
                    '<input  type="radio" name="option[quantitdy]"' +
                    'value="' + v['option_id'] + '" ' + 'product_id="' + v['product_id'] + '" ' +
                    'price="' + v['price'] + '" ' + 'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' + 'quantity="' + v['quantity'] + '" ' +
                    'p_name="' + v['name'] + '" ' +
                    'model="' + v['model'] + '" ' +
                    'product_on_phone="' + v['product_on_phone'] + '" ' +
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

        htm += "<select id='option-cor-select'>";
        htm += '<option value=""></option>';
        $.each(cors['data'], function (k, v) {

            stock_status_class = '';
            stock_css = '';
            if (v['quantity'] <= 0) {
                if (v['stock_status'] == 'Out Of Stock') {
                    //stock_status_class = ' **não disponível';
                    stock_css = 'red_staric';
                }
                else {

                }

            }
            htm += "<option class='" + stock_css + "' value='" + v['option_id'] + "' product_id='" + v['product_id'] + "'>";

            htm += v['value'] + stock_status_class;
            htm += "</option>";

        });
        htm += "</select>";

        $.each(cors['data'], function (k, v) {
            title_alt = '';
            if (v['quantity'] <= 0) {
//                if (v['stock_status'] == 'Out Of Stock') {
//                    title_alt = stock_statuses['out_of_stock'];
//                }
//                else {
//                    title_alt = v['stock_status'];
//                }

//When product quantiy in backend 0 = Fora de estoque in product option
                title_alt = stock_statuses['out_of_stock'];

            } else if (v['quantity'] > 0) {
                title_alt = stock_statuses['in_stock'];
            } else {
                title_alt = stock_statuses['in_stock'];
            }
            htm += '<span style="display:none;margin-right:10px;" alt="' + title_alt + '" title="' + title_alt + '">' +
                    '<input  type="radio" name="option[cor]"' + 'value="' + v['option_id'] + '" ' + 'product_id="' + v['product_id'] + '" ' + 'price="' + v['price'] + '" ' +
                    'tax="' + v['tax'] + '" ' +
                    'special="' + v['special'] + '" ' +
                    'quantity="' + v['quantity'] + '" ' +
                    'p_name="' + v['name'] + '" ' +
                    'model="' + v['model'] + '" ' +
                    'product_on_phone="' + v['product_on_phone'] + '" ' +
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
<style>
    select option.red_staric {
        /*color:red;*/
    }
    div.green_color {
        color:green;
    }
    div.red_color {
        color:red;
    }
    .product-info .stock_email input[type='email']{
        border: 1px solid #D2D2D2;
        color: #424141;
        font-size: 11px;
        height: 24px;
        line-height: 24px;
        margin: 0;
        padding: 0 3px 2px;
        width: 340px;
        width:233px!important; margin-top:6px;
    }

    .product-info .stock_email .orange_button{
        margin-top: 15px;
        margin-left: 35px;
    }
    .cart_over_phone {
        cursor:default !important;;
    }
    .cart_over_phone:hover {
        background:url("../image/cart_03.png") no-repeat scroll 15px center #FA7337 !important;

    }
</style>    