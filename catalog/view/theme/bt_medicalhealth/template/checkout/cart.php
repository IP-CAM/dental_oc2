<?php echo $header; ?>
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<h1><?php echo $heading_title; ?>
    <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
    <?php } ?>
</h1>
<?php if ($attention) { ?>
    <div class="attention"><?php echo $attention; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($success) { ?>
    <div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>

<?php
?>
<div id="content"><?php echo $content_top; ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="cart-info">
            <table>
                <thead>
                    <tr>
                        <td class="name"  colspan="2"><?php echo $column_name; ?></td>
                        <td class="model"><?php echo $column_model; ?></td>
                        <td class="quantity"><?php echo $column_quantity; ?></td>
                        <td class="price"><?php echo $column_price; ?></td>
                        <td class="total"><?php echo $column_total; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <?php if ($product['recurring']): ?>
                            <tr>
                                <td colspan="6" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" /><span style="float:left;line-height:18px; margin-left:10px;"> 
                                        <strong><?php echo $text_recurring_item ?></strong>
                                        <?php echo $product['profile_description'] ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="image">

                                <?php if ($product['thumb']) { ?>
                                    <a class="img_cart" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                                <?php } ?></td>
                            <td class="name product_ids"  product_id = "<?php echo str_replace(":", "", $product['key']); ?>"><a href="<?php echo $product['href']; ?>"><?php echo empty($product['reference_id']) ? $product['unique_name'] : $product['name']; ?></a>
                                <?php if (!$product['stock']) { ?>
                                    <span class="stock">***</span>
                                <?php } ?>
                                <div>
                                    <?php foreach ($product['option'] as $option) { ?>
                                        - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                                    <?php } ?>

                                    <?php if ($product['recurring']): ?>
                                        - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                                    <?php endif; ?>
                                </div>
                                <?php if ($product['reward']) { ?>
                                    <small><?php echo $product['reward']; ?></small>
                                <?php } ?></td>
                            <td class="model"><?php echo $product['model']; ?>

                                <div class="remove"><a href="<?php echo $product['remove']; ?>"><img src="catalog/view/theme/bt_medicalhealth/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></div>

                            </td>



                            <td class="quantity"><input type="text" name="quantity[<?php echo $product['key']; ?>]" value="<?php echo $product['quantity']; ?>" size="1" />
                                &nbsp;
                                <input type="image" src="catalog/view/theme/bt_medicalhealth/image/update.png" alt="<?php echo $button_update; ?>" title="<?php echo $button_update; ?>" />
                                &nbsp;</td>
                            <td class="price"><?php echo $product['price']; ?></td>
                            <td class="total"><?php echo $product['total']; ?></td>
                        </tr>
                    <?php } ?>
                    <?php foreach ($vouchers as $vouchers) { ?>
                        <tr>
                            <td class="image vouchers"><div class="remove"><a href="<?php echo $vouchers['remove']; ?>"><img src="catalog/view/theme/bt_medicalhealth/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></div></td>
                            <td class="name vouchers"><?php echo $vouchers['description']; ?></td>
                            <td class="model vouchers"></td>
                            <td class="quantity vouchers"><input type="text" name="" value="1" size="1" disabled="disabled" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td class="price vouchers"><?php echo $vouchers['amount']; ?></td>
                            <td class="total vouchers"><?php echo $vouchers['amount']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    <?php if ($coupon_status || $voucher_status || $reward_status || $shipping_status) { ?>
                                                <!--      <h2 class="title_cart"><?php echo $text_next; ?></h2>
                                                        <div class="content shopping-module">
                                                            <p><?php echo $text_next_choice; ?></p>
                                                            <table class="radio">
        <?php if ($coupon_status) { ?>
                                                                                                                    <tr class="highlight">
                                                                                                                        <td><?php if ($next == 'coupon') { ?>
                                                                                                                                                                                <input type="radio" name="next" value="coupon" id="use_coupon" checked="checked" />
            <?php } else { ?>
                                                                                                                                                                                <input type="radio" name="next" value="coupon" id="use_coupon" />
            <?php } ?></td>
                                                                                                                        <td><label for="use_coupon"><?php echo $text_use_coupon; ?></label></td>
                                                                                                                    </tr>
        <?php } ?>
        <?php if ($voucher_status) { ?>
                                                                                                                    <tr class="highlight" style="display:none;">
                                                                                                                        <td><?php if ($next == 'voucher') { ?>
                                                                                                                                                                                <input type="radio" name="next" value="voucher" id="use_voucher" checked="checked" />
            <?php } else { ?>
                                                                                                                                                                                <input type="radio" name="next" value="voucher" id="use_voucher" />
            <?php } ?></td>
                                                                                                                        <td><label for="use_voucher"><?php echo $text_use_voucher; ?></label></td>
                                                                                                                    </tr>
        <?php } ?>
        <?php if ($reward_status) { ?>
                                                                                                                    <tr class="highlight">
                                                                                                                        <td><?php if ($next == 'reward') { ?>
                                                                                                                                                                                <input type="radio" name="next" value="reward" id="use_reward" checked="checked" />
            <?php } else { ?>
                                                                                                                                                                                <input type="radio" name="next" value="reward" id="use_reward" />
            <?php } ?></td>
                                                                                                                        <td><label for="use_reward"><?php echo $text_use_reward; ?></label></td>
                                                                                                                    </tr>
        <?php } ?>
        <?php if ($shipping_status) { ?>
                                                                                                                    <tr class="highlight">
                                                                                                                        <td><?php if ($next == 'shipping') { ?>
                                                                                                                                                                                <input type="radio" name="next" value="shipping" id="shipping_estimate" checked="checked" />
            <?php } else { ?>
                                                                                                                                                                                <input type="radio" name="next" value="shipping" id="shipping_estimate" />
            <?php } ?></td>
                                                                                                                        <td><label for="shipping_estimate"><?php echo $text_shipping_estimate; ?></label></td>
                                                                                                                    </tr>
        <?php } ?>
                                                            </table>
                                                        </div>
                                                        
        -->


        <div class="cart-module">
            <?php //echo ($next == 'shipping' ? 'block' : 'none');  ?>
            <div id="shipping" class="content" style="display: block;">
                <div class="label"><?php echo $text_shipping_detail; ?></div>

                <div>
                    <input type='hidden' name='country_id' value="<?php echo $country_id; ?>" />
                    <input type='hidden' name='zone_id' value="<?php echo $zone_id; ?>" />
                    <input type="text" name="postcode" value="<?php echo $postcode; ?>" />
                </div>

                <div class="button"><span class="orange_button"><input type="button" value="<?php echo $button_quote; ?>" id="button-quote" class="button" /></span></div>
            </div>
            
            <?php //echo ($next == 'coupon' ? 'block' : 'none');  ?>
            <div id="coupon" class="content coupon" style="display:block">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="label"><?php echo $entry_coupon; ?></div>
                    <div class="field"><input type="text" name="coupon" value="<?php echo $coupon; ?>" /></div>
                    <input type="hidden" name="next" value="coupon" />

                    <div class="button"><span class="orange_button"><input type="submit" value="<?php echo $button_coupon; ?>" class="button" /></span></div>
                </form>
            </div>
            <div id="voucher" class="content" style="display: <?php echo ($next == 'voucher' ? 'block' : 'none'); ?>;">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="label"><?php echo $entry_voucher; ?></div>

                    <div><input type="text" name="voucher" value="<?php echo $voucher; ?>" /></div>
                    <input type="hidden" name="next" value="voucher" />

                    <div class="button"><span class="orange_button"><input type="submit" value="<?php echo $button_voucher; ?>" class="button" /></span></div>
                </form>
            </div>
            <div id="reward" class="content" style="display: <?php echo ($next == 'reward' ? 'block' : 'none'); ?>;">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <div class="label"><?php echo $entry_reward; ?></div>
                    <input type="text" name="reward" value="<?php echo $reward; ?>" />
                    <div><input type="hidden" name="next" value="reward" /></div>

                    <div class="button"><span class="orange_button"><input type="submit" value="<?php echo $button_reward; ?>" class="button" /></span></div>
                </form>
            </div>
            
            <div style="display: block">
                <div class="left"><a href="<?php echo $continue; ?>" class="orange_button"><span><?php echo $button_shopping; ?></span></a></div>
            </div>
        </div>
    <?php } ?>
    <div class="cart-total">
        <table id="total">
            <?php foreach ($totals as $total) { ?>
                <tr>
                    <td class="right<?php echo ($total == end($totals) ? ' last' : ''); ?>"><b><?php echo $total['title']; ?>:</b></td>
                    <td class="right<?php echo ($total == end($totals) ? ' last' : ''); ?>"><?php echo $total['text']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="buttons shopping_cart">
        <div class="right"><a href="<?php echo $checkout; ?>" class="orange_button"><span><?php echo $button_checkout; ?></span></a></div>

    </div>
    <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
//$('input[name=\'next\']').bind('change', function () {
//        $('.cart-module > div').hide();
//
//        $('#' + this.value).show();
//    });
//--></script>
<?php
$shipping_method_chck = 0;
if (!empty($shipping_method)) {
    $shipping_method_chck = 1;
}
?>
<?php if ($shipping_status) { ?>

    <script type="text/javascript"><!--
        var shipping_method_chk = "< ?php echo $shipping_method_chck; ? >";
        function get_Width_Height() {
            var array = new Array();
            if (getWidthBrowser() > 766) {
                array[0] = 450;
                array[1] = 350;
            } else if (getWidthBrowser() < 767 && getWidthBrowser() > 480) {
                array[0] = 450;
                array[1] = 350;
            } else {
                array[0] = 300;
                array[1] = 300;
            }
            return array;
        }

        function calculate_shipping(zip_code, country_id, zone_id) {
            products = [];
            $("div.cart-info table td.product_ids").each(function () {
                if(typeof($(this).attr("product_id"))!="undefined"){
                    products.push($(this).attr("product_id"));
                }
                
               
            })
            related_products = products.join(",");
            var sendInfo = {
                zip_code: zip_code,
                country_id: country_id,
                zone_id: zone_id,
                products: related_products
            };
            
            if (zip_code != '') {
                $.ajax({
                    type: "POST",
                    url: "?route=checkout/shipping_calculator",
                    dataType: "json",
                    beforeSend: function () {
                        $('#button-quote').attr('disabled', true);
                        $('#button-quote').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                    },
                    complete: function () {
                        $('#button-quote').attr('disabled', false);
                        $('.wait').remove();
                    },
                    success: function (msg) {
                        li_ht = "<table class='radio'>";
                        if (typeof (msg['correios']) != "undefined" && typeof (msg['correios']['error']) != "undefined" && msg['correios']['error'] != false) {

                           
                            li_ht += '<tr class="highlight"><td>';
                            li_ht += msg['correios']['error'];
                            li_ht += "</td></tr>";
                            //$("#error_box").hide("fade", {}, 30000)
                        }
                        else {
                           
                            if (typeof (msg['correios']) != "undefined") {
                                for (ob in msg['correios']['quote']) {
                                    qut = msg['correios']['quote'];
                                    li_ht+= "<tr class='highlight'><td>" + qut[ob]['title'] + "</td>";
                                  
                                    li_ht += "<td>" + qut[ob]['code'] + "</td>";
                                    li_ht += "<td>" + qut[ob]['text'] + "</td>";
                                    li_ht += "</tr>";
                                   
                                }
                            }
                            else {
                                li_ht+= "<tr class='highlight'><td>N‹o Encontrado</td>";
                                li_ht += "</tr>";

                            }



                            //$("#result_box").hide("fade", {}, 30000)
                        }
                        li_ht += "</table>";
                        $.colorbox({
                            overlayClose: true,
                            opacity: 0.5,
                            width: get_Width_Height()[0],
                            height: get_Width_Height()[1],
                            href: false,
                            html: li_ht
                        });


                    },
                    data: sendInfo
                });
            }
            else {
                alert(empty_error);
                $("#loading_status").hide();
            }

        }

        $('#button-quote').live('click', function () {
            calculate_shipping(encodeURIComponent($('input[name=\'postcode\']').val()), $('input[name=\'country_id\']').val(), $('input[name=\'zone_id\']').val());
            return true;
            $.ajax({
                //url: 'index.php?route=checkout/cart/quote',
                url: '?route=checkout/shipping_calculator',
                type: 'post',
                data: 'country_id=' + $('input[name=\'country_id\']').val() + '&zone_id=' + $('input[name=\'zone_id\']').val() + '&postcode=' + encodeURIComponent($('input[name=\'postcode\']').val()),
                dataType: 'json',
                beforeSend: function () {
                    $('#button-quote').attr('disabled', true);
                    $('#button-quote').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                },
                complete: function () {
                    $('#button-quote').attr('disabled', false);
                    $('.wait').remove();
                },
                success: function (json) {
                    $('.success, .warning, .attention, .error').remove();

                    if (json['error']) {
                        if (json['error']['warning']) {
                            $('#notification').html('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

                            $('.warning').fadeIn('slow');

                            $('html, body').animate({scrollTop: 0}, 'slow');
                        }

                        if (json['error']['country']) {
                            $('input[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                        }

                        if (json['error']['zone']) {
                            $('input[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                        }

                        if (json['error']['postcode']) {
                            $('input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                        }
                    }

                    if (json['shipping_method']) {
                        html = '<h2><?php echo $text_shipping_method; ?></h2>';
                        html += '<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">';
                        html += '  <table class="radio">';
                        for (i in json['shipping_method']) {
                            html += '<tr>';
                            html += '  <td colspan="3"><b>' + json['shipping_method'][i]['title'] + '</b></td>';
                            html += '</tr>';
                            if (!json['shipping_method'][i]['error']) {
                                for (j in json['shipping_method'][i]['quote']) {
                                    html += '<tr class="highlight">';
                                    if (json['shipping_method'][i]['quote'][j]['code'] == '<?php echo $shipping_method; ?>') {
                                        html += '<td><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" checked="checked" /></td>';
                                    } else {
                                        html += '<td><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" /></td>';
                                    }

                                    html += '  <td><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</label></td>';
                                    html += '  <td style="text-align: left;"><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['text'] + '</label></td>';
                                    html += '</tr>';
                                }
                            } else {
                                html += '<tr>';
                                html += '  <td colspan="3"><div class="error">' + json['shipping_method'][i]['error'] + '</div></td>';
                                html += '</tr>';
                            }
                        }

                        html += '  </table>';
                        html += '  <br />';
                        html += '  <input type="hidden" name="next" value="shipping" />';
                        if (shipping_method_chk == '1') {
                            html += '  <span class="orange_button">';
                            html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="button" />';
                            html += '  </span>';
                        } else {
                            html += '  <span class="orange_button">';
                            html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="button" disabled="disabled" />';
                            html += '  </span>';
                        }
                        html += '</form>';
                        $.colorbox({
                            overlayClose: true,
                            opacity: 0.5,
                            width: get_Width_Height()[0],
                            height: get_Width_Height()[1],
                            href: false,
                            html: html
                        });

                        $('input[name=\'shipping_method\']').bind('change', function () {
                            $('#button-shipping').attr('disabled', false);
                        });
                    }
                }
            });
        });
        //--></script> 
    <script type="text/javascript"><!--
        $('input[name=\'country_id\']').bind('change', function () {
            $.ajax({
                url: 'index.php?route=checkout/cart/country&country_id=' + this.value,
                dataType: 'json',
                beforeSend: function () {
                    $('input[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                },
                complete: function () {
                    $('.wait').remove();
                },
                success: function (json) {
                    if (json['postcode_required'] == '1') {
                        $('#postcode-required').show();
                    } else {
                        $('#postcode-required').hide();
                    }

                    html = '<option value=""><?php echo $text_select; ?></option>';
                    selected_zone = "0";
                    if (json['zone'] != '') {
                        for (i = 0; i < json['zone'].length; i++) {
                            html += '<option value="' + json['zone'][i]['zone_id'] + '"';

                            if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
                                html += ' selected="selected"';

                            }

                            html += '>' + json['zone'][i]['name'] + '</option>';
                        }
                    } else {
                        html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                    }

                    //$('input[name=\'zone_id\']').html(html);
                    //$('input[name=\'zone_id\']').val();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        $('input[name=\'country_id\']').trigger('change');
        //--></script>
<?php } ?>
<?php echo $footer; ?>