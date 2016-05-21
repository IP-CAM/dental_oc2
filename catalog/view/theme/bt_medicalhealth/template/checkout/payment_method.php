<?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if (!isset($redirect)) { ?>
    <div class="checkout-product payment_method_total" >
        <?php include_once(DIR_TEMPLATE."bt_medicalhealth/template/checkout/cart_total.php"); ?>
    </div>
<?php } ?>
<?php if ($payment_methods) { ?>
    <p><?php echo $text_payment_method; ?></p>
    <table class="radio">
        <?php foreach ($payment_methods as $payment_method) { ?>
            <tr class="highlight">
                <td><?php if ($payment_method['code'] == $code || !$code) { ?>
                        <?php $code = $payment_method['code']; ?>
                        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>"  />
                    <?php } else { ?>
                        <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" />
                    <?php } ?></td>
                <td><label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></label></td>
            </tr>
        <?php } ?>
    </table>
    <br />
<?php } ?>
<b><?php echo $text_comments; ?></b>
<textarea name="comment" rows="8" style="width: 95%;"><?php echo $comment; ?></textarea>
<br />
<br />
<?php if ($text_agree) { ?>
    <div class="buttons">
        <div class="left">
            <?php if ($agree) { ?>
                <input type="checkbox" name="agree" id="agree_to" value="1" checked="checked" />
            <?php } else { ?>
                <input type="checkbox" name="agree" value="1" id="agree_to" />
            <?php } ?>&nbsp;&nbsp;<?php echo $text_agree; ?> 

        </div>
    </div>
    <div class="buttons hidden">
        <div class="left">

            <span class="orange_button"><input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" class="button" /></span>
        </div>
    </div>
<?php } else { ?>
    <div class="buttons hidden">
        <div class="left">
            <span class="orange_button"><input type="button" value="<?php echo $button_continue; ?>" id="button-payment-method" class="button" /></span>
        </div>
    </div>
<?php } ?>

<script type="text/javascript"><!--
function get_Width_Height() {
        var array = new Array();
        if (getWidthBrowser() > 767) {
            array[0] = 640;
            array[1] = 480;
        } else if (getWidthBrowser() < 767 && getWidthBrowser() > 480) {
            array[0] = 450;
            array[1] = 350;
        } else {
            array[0] = 300;
            array[1] = 300;
        }
        return array;
    }
    $('.colorbox').colorbox({
        width: get_Width_Height()[0],
        height: get_Width_Height()[1]
    });

    //For boleto methods only 
    function payment_method_checkout_boleto() {
        var boleto_methods = '0';
        if ($("#pagseguro_boleto,#pagseguro_credit_card,#pagseguro_eft").length > 0) {
            boleto_methods = '1';
        }
        $.ajax({
            url: 'index.php?route=checkout/payment_method/validate&boleto_methods=' + boleto_methods,
            type: 'post',
            data: $('.payment-method-step  input[type=\'radio\']:checked, .payment-method-step  input[type=\'checkbox\']:checked, .payment-method-step  textarea'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-payment-method').attr('disabled', true);
                $('#button-payment-method').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-payment-method').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.payment-method-step  .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }
                } else {
                    checkout_confirm_boleto();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //for boleto checkbox
    function checkout_confirm_boleto() {
        url_checkout = 'index.php?route=checkout/confirm&boleto=1&is_ajax=1';
        $(loader_box).show();
        $.ajax({
            url: url_checkout,
            dataType: 'html',
            success: function (html) {
                $('#confirm .checkout-content').html(html);
                $('#confirm .checkout-content').slideDown('slow');
                fill_cpfField();
                $("#button_final_verify").hide();
                $(loader_box).hide();
                
                
                


            },
            error: function (xhr, ajaxOptions, thrownError) {
                $(loader_box).hide();
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    
   
    //custom payment methods
    $("#pagseguro_boleto,#pagseguro_credit_card,#pagseguro_eft").change(function () {
        if ($(this).is(':checked')) {
            $("#agree_to").prop("checked", true);
            payment_address_checkout(false);
            payment_method_checkout_boleto();
        }
    })
//--></script> 