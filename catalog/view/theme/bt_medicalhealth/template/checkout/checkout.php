<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<script type="text/javascript">
    var loggin_in = '<?php echo $logged; ?>';</script>

<div id="content"><?php echo $content_top; ?>
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <h1 class="checkout_title"><?php echo $heading_title; ?></h1>
    <div class="checkout row">

        <div class="step_container six columns" style="">

            <div id="checkout" style="<?php echo (!empty($logged)) ? "display:none" : ""; ?>">   
                <div class="step-title">
                    <?php echo $text_checkout_option_step; ?>
                </div>
                <div class="checkout-content"></div>
            </div>
            <div class="payment-address-step" id="payment-address" style="<?php echo (!empty($logged)) ? "display:none" : ""; ?>">   
                <div class="step-title ">
                    <?php
                    if (!$logged) {
                        echo $text_checkout_account_step;
                    } else {
                        echo $text_checkout_payment_address_step;
                    }
                    ?>
                </div>
                <div class="checkout-content"></div>
            </div>
            <?php
            if ($logged) {
                ?>
                <div class="payment-address-2-step" id="payment-address-2" >   
                    <div class="step-title ">
                        <?php echo $txt_payment_heading_customer_step; ?>
                    </div>
                    <div class="checkout-content"></div>
                </div>
            <?php } else { ?>
                <div class="payment-address-2-guest-step" id="payment-address-2-guest">   
                    <div class="step-title ">
                        <?php echo $txt_payment_heading_customer_step; ?>
                    </div>
                    <div class="checkout-content"></div>
                </div>
            <?php } ?>

        </div>

        <div class="step_container six columns" style="">
            <?php
            if ($shipping_required) {
                ?>
                <div class="shipping-address-step" id="shipping-address">   
                    <div class="step-title">
                        <?php echo $text_checkout_shipping_address_step; ?>
                    </div>
                    <div class="checkout-content"></div>
                </div>


                <?php
            }
            ?>
            <?php
            if ($shipping_required) {
                ?>
                <div class="shipping-method-step">   
                    <div class="step-title">
                        <?php echo $text_checkout_shipping_method_step; ?>
                    </div>
                    <div class="checkout-content"></div>
                </div>
                <?php
            }
            ?>





        </div>

        <div class="step_container six columns" style="">


            <div class="payment-method-step">   
                <div class="step-title">
                    <?php echo $text_checkout_payment_method_step; ?>
                </div>
                <div class="checkout-content"></div>
            </div>
            <div id="confirm">   
                <div class="step-title" style="display:none">
                    <?php echo $text_checkout_confirm_step; ?>
                </div>
                <div class="checkout-content"></div>
            </div>


        </div>
        <div class="clear"></div>




    </div>
    <?php echo $content_bottom; ?></div>
<script type="text/javascript">
    var logged_in = '<?php echo $logged; ?>';
    var quickconfirm_in = '<?php echo isset($quickconfirm) ? 1 : 0; ?>';
    var shipping_required_in = '<?php echo $shipping_required; ?>';

    //checkout register validate
    function checkout_register() {
        $.ajax({
            url: 'index.php?route=checkout/register/validate',
            type: 'post',
            data: $('.payment-address-step input[type=\'text\'], .payment-address-step input[type=\'password\'], .payment-address-step input[type=\'checkbox\']:checked, .payment-address-step input[type=\'radio\']:checked, .payment-address-step input[type=\'hidden\'], .payment-address-step select'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-register').attr('disabled', true);
                $('#button-register').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-register').attr('disabled', false);
                $('.wait').remove();
                loader_box.hide();
            },
            success: function (json) {

                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.payment-address-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['error']['firstname']) {
                        $('.payment-address-step input[name=\'firstname\'] + br').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }

                    if (json['error']['lastname']) {
                        $('.payment-address-step input[name=\'lastname\'] + br').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['email']) {
                        $('.payment-address-step input[name=\'email\'] + br').after('<span class="error">' + json['error']['email'] + '</span>');
                    }

                    if (json['error']['telephone']) {
                        $('.payment-address-step input[name=\'telephone\'] + br').after('<span class="error">' + json['error']['telephone'] + '</span>');
                    }

                    if (json['error']['company_id']) {
                        $('.payment-address-step input[name=\'company_id\'] + br').after('<span class="error">' + json['error']['company_id'] + '</span>');
                    }

                    if (json['error']['tax_id']) {
                        $('.payment-address-step input[name=\'tax_id\'] + br').after('<span class="error">' + json['error']['tax_id'] + '</span>');
                    }

                    if (json['error']['address_1']) {
                        $('.payment-address-step input[name=\'address_1\'] + br').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }

                    if (json['error']['city']) {
                        $('.payment-address-step input[name=\'city\'] + br').after('<span class="error">' + json['error']['city'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('.payment-address-step input[name=\'postcode\'] + br').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }

                    if (json['error']['country']) {
                        $('.payment-address-step select[name=\'country_id\'] + br').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('.payment-address-step select[name=\'zone_id\'] + br').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }

                    if (json['error']['password']) {
                        $('.payment-address-step input[name=\'password\'] + br').after('<span class="error">' + json['error']['password'] + '</span>');
                    }

                    if (json['error']['confirm']) {
                        $('.payment-address-step input[name=\'confirm\'] + br').after('<span class="error">' + json['error']['confirm'] + '</span>');
                    }


                } else {
                    if (shipping_required_in) {
                        var shipping_address = $('.payment-address-step input[name=\'shipping_address\']:checked').attr('value');
                        if (shipping_address) {
                            checkout_shipping_method();
                        } else {
                            checkout_shipping();
                        }
                    } else {
                        checkout_payment_method();
                    }
                    checkout_payment_address();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

    }
    //checkout login
    function checkout_login() {
        $.ajax({
            url: 'index.php?route=checkout/login',
            dataType: 'html',
            success: function (html) {
                $('#checkout .checkout-content').html(html);
                $('#checkout .checkout-content').slideDown('slow');

                $(".checkout_login_register").prop("checked", false);

                button_account_click();
                //checkout_shipping();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //Load of checkout payment 
    function checkout_payment() {

        $(loader_box).show();
        $.ajax({
            url: 'index.php?route=checkout/payment_address',
            dataType: 'html',
            success: function (html) {

                //$('.payment-address-step .checkout-content').html(html);
                //$('.payment-address-step .checkout-content').slideDown('slow');
                $(".payment-address-step").hide();

                $(".payment-address-step").find("div.checkout-content").html(html);

                $("#payment-address-2 div.checkout-content").html($(".payment-address-step div#payment-new-2").html());
                $(".payment-address-step div#payment-new-2").remove();

                //for login user this box will be disabled 
                if (loggin_in == "") {

                    $(".payment-address-step").show();
                    $(".payment-address-step").find("div.checkout-content").slideDown('slow');
                }

                $("#payment-address-2 div.checkout-content").slideDown('slow');

                console.log($(".payment-address-step"));

                payment_address_checkout(false);
                customer_section_scripts();
                if (shipping_required_in === '1') {

                    checkout_shipping();
                }
                else {

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //Load of checkout shipping
    function checkout_shipping() {
        $.ajax({
            url: 'index.php?route=checkout/shipping_address',
            dataType: 'html',
            success: function (html) {
                $('.shipping-address-step .checkout-content').html(html);
                $('.shipping-address-step .checkout-content').slideDown('slow');


                if (shipping_required_in == '1') {
                    checkout_shipping_method();
                }
                else {

                }
                shipping_address_checkout(false);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //load of payment mthods
    function checkout_payment_method() {
        $.ajax({
            url: 'index.php?route=checkout/payment_method',
            dataType: 'html',
            success: function (html) {
                $('.payment-method-step  .checkout-content').html(html);

                $('.payment-method-step  .checkout-content').slideDown('slow');

                if ($('input[name=\'account\']:checked') == "guest") {
                    payment_method_checkout();
                }
                checkout_confirm('1');

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //load of payment address
    function checkout_payment_address() {

        $.ajax({
            url: 'index.php?route=checkout/payment_address',
            dataType: 'html',
            success: function (html) {
                $(".payment-address-step").hide();

                $(".payment-address-step").find("div.checkout-content").html(html);

                $("#payment-address-2 div.checkout-content").html($(".payment-address-step").find("div#payment-new").html());
                $(".payment-address-step").find("div#payment-new").remove();


                //for login user this box will be disabled 
                if (loggin_in == "") {
                    $(".payment-address-step").show();
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function guest_shipping() {
        $.ajax({
            url: 'index.php?route=checkout/guest_shipping',
            dataType: 'html',
            success: function (html) {
                $('.shipping-address-step .checkout-content').html(html);

                $('.shipping-address-step .checkout-content').slideDown('slow');

                checkout_shipping_method();

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    //=============Validates functions start==================================
    //Shipping address validate
    function guest_shipping_checkout(loadShipping) {
        //hide in process when it comes here
        $("#button-guest").hide();
        $("#button_final_verify").show();
        $("style#display_remove").remove();

        $(window).scrollTop(0);
        $.ajax({
            url: 'index.php?route=checkout/guest_shipping/validate',
            type: 'post',
            data: $('.shipping-address-step input[type=\'text\'], .shipping-address-step select'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-guest-shipping').attr('disabled', true);
                $('#button-guest-shipping').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-guest-shipping').attr('disabled', false);
                $('.wait').remove();


            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.shipping-address-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['error']['firstname']) {
                        $('.shipping-address-step input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }

                    if (json['error']['lastname']) {
                        $('.shipping-address-step input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['address_1']) {
                        $('.shipping-address-step input[name=\'address_1\']').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }

                    if (json['error']['city']) {
                        $('.shipping-address-step input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('.shipping-address-step input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }

                    if (json['error']['country']) {
                        $('.shipping-address-step select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('.shipping-address-step select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }
                } else {
                    if (loadShipping) {
                        checkout_shipping_method();
                    }
                    else {
                        shipping_method_checkout();
                    }
                    //No Need now
//                    $.ajax({
//                        url: 'index.php?route=checkout/shipping_method',
//                        dataType: 'html',
//                        success: function (html) {
//                            $('.shipping-method-step .checkout-content').html(html);
//                            $('.shipping-method-step .checkout-content').slideDown('slow');
//
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                        }
//                    });

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function shipping_address_checkout(further) {

        ajaxUrl = 'index.php?route=checkout/shipping_address/validate';
        if (further == false) {
            ajaxUrl += '&unset=false';
        }
        $.ajax({
            url: ajaxUrl,
            type: 'post',
            data: $('.shipping-address-step input[type=\'text\'], .shipping-address-step input[type=\'password\'],.shipping-address-step input[type=\'checkbox\']:checked, .shipping-address-step input[type=\'radio\']:checked, .shipping-address-step select'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-shipping-address').attr('disabled', true);
                $('#button-shipping-address').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-shipping-address').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.shipping-address-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['error']['firstname']) {
                        $('.shipping-address-step input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }

                    if (json['error']['lastname']) {
                        $('.shipping-address-step input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['email']) {
                        $('.shipping-address-step input[name=\'email\']').after('<span class="error">' + json['error']['email'] + '</span>');
                    }

                    if (json['error']['telephone']) {
                        $('.shipping-address-step input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
                    }

                    if (json['error']['address_1']) {
                        $('.shipping-address-step input[name=\'address_1\']').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }

                    if (json['error']['city']) {
                        $('.shipping-address-step input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('.shipping-address-step input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }

                    if (json['error']['country']) {
                        $('.shipping-address-step select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('.shipping-address-step select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }
                } else {

                    if (shipping_required_in == '1' && further == true) {
                        shipping_method_checkout();
                    }

                    //No Need for this coz its happening on self

//                    $.ajax({
//                        url: 'index.php?route=checkout/shipping_method',
//                        dataType: 'html',
//                        success: function (html) {
//                            $('.shipping-method-step .checkout-content').html(html);
//                            $('.shipping-method-step .checkout-content').slideDown('slow');
//                            //No Need for this coz its happening on self
//                         
//                            $.ajax({
//                                url: 'index.php?route=checkout/shipping_address',
//                                dataType: 'html',
//                                success: function (html) {
//                                    $('.shipping-address-step .checkout-content').html(html);
//                                },
//                                error: function (xhr, ajaxOptions, thrownError) {
//                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                                }
//                            });
//                           
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                        }
//                         
//                    });

                    //No Need for this coz its happening on self
                    /*
                     $.ajax({
                     url: 'index.php?route=checkout/payment_address',
                     dataType: 'html',
                     success: function (html) {
                     $('.payment-address-step .checkout-content').html(html);
                     },
                     error: function (xhr, ajaxOptions, thrownError) {
                     alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                     }
                     });
                     */
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //payment address validate
    function payment_address_checkout(further) {
        console.log("-=============-");
        ajaxUrl = 'index.php?route=checkout/payment_address/validate';

        $("#button-guest").hide();
        $("#button_final_verify").show();

        if (further == false) {
            ajaxUrl += '&unset=false';
        }
        
        $.ajax({
            url: ajaxUrl,
            type: 'post',
            data: $('.payment-address-step input[type=\'text\'], .payment-address-step input[type=\'password\'], .payment-address-step input[type=\'checkbox\']:checked, .payment-address-step input[type=\'radio\']:checked, .payment-address-step input[type=\'hidden\'], .payment-address-step select,#payment-address-2 input[type=\'text\'], #payment-address-2 input[type=\'password\'], #payment-address-2 input[type=\'checkbox\']:checked, #payment-address-2 input[type=\'radio\']:checked, #payment-address-2 input[type=\'hidden\'], #payment-address-2 select'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-payment-address').attr('disabled', true);
                $('#button-payment-address').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-payment-address').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    console.log(json['error']);
                    console.log("-----------");
                    if (json['error']['warning']) {
                        $('.payment-address-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['error']['firstname']) {
                        console.log(json['error']['firstname']);
                        $('.payment-address-step input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }

                    if (json['error']['lastname']) {
                        $('.payment-address-step input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['telephone']) {
                        $('.payment-address-step input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
                    }

                    if (json['error']['company_id']) {
                        $('.payment-address-step input[name=\'company_id\']').after('<span class="error">' + json['error']['company_id'] + '</span>');
                    }

                    if (json['error']['tax_id']) {
                        $('.payment-address-step input[name=\'tax_id\']').after('<span class="error">' + json['error']['tax_id'] + '</span>');
                    }

                    if (json['error']['address_1']) {
                        $('.payment-address-step input[name=\'address_1\']').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }

                    if (json['error']['city']) {
                        $('.payment-address-step input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('.payment-address-step input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }

                    if (json['error']['country']) {
                        $('.payment-address-step select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('.payment-address-step select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }
                    if (typeof manage_custom_field_errors == 'function') {
                        manage_custom_field_errors(json['error']);
                    }
                } else {
                    if (further == false) {

                    }
                    else {
                        if (shipping_required_in === '1') {
                            //checkout_shipping();
                            shipping_address_checkout(true);
                        }
                        else {
                            //checkout_payment_method();
                        }
                    }



                }


            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //Payment method validate
    function payment_method_checkout() {
        
        $.ajax({
            url: 'index.php?route=checkout/payment_method/validate&boleto_methods=',
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
                    checkout_confirm();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //Guest Validate
    //load payment
    function guest_validate(further, load_payment) {
        $.ajax({
            url: 'index.php?route=checkout/guest/validate',
            type: 'post',
            data: $('.payment-address-step input[type=\'text\'], .payment-address-step input[type=\'checkbox\']:checked, .payment-address-step select'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-guest').attr('disabled', true);
                $('#button-guest').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-guest').attr('disabled', false);
                $('.wait').remove();

            },
            success: function (json) {



                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.payment-address-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }

                    if (json['error']['firstname']) {
                        $('.payment-address-step input[name=\'firstname\'] + br').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }

                    if (json['error']['lastname']) {
                        $('.payment-address-step input[name=\'lastname\'] + br').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['email']) {
                        $('.payment-address-step input[name=\'email\'] + br').after('<span class="error">' + json['error']['email'] + '</span>');
                    }

                    if (json['error']['telephone']) {
                        $('.payment-address-step input[name=\'telephone\'] + br').after('<span class="error">' + json['error']['telephone'] + '</span>');
                    }

                    if (json['error']['company_id']) {
                        $('.payment-address-step input[name=\'company_id\'] + br').after('<span class="error">' + json['error']['company_id'] + '</span>');
                    }

                    if (json['error']['tax_id']) {
                        $('.payment-address-step input[name=\'tax_id\'] + br').after('<span class="error">' + json['error']['tax_id'] + '</span>');
                    }

                    if (json['error']['address_1']) {
                        $('.payment-address-step input[name=\'address_1\'] + br').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }

                    if (json['error']['city']) {
                        $('.payment-address-step input[name=\'city\'] + br').after('<span class="error">' + json['error']['city'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('.payment-address-step input[name=\'postcode\'] + br').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }

                    if (json['error']['country']) {
                        $('.payment-address-step select[name=\'country_id\'] + br').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('.payment-address-step select[name=\'zone_id\'] + br').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }
                } else {
                    //load payment method we need to load
                    $("#button_final_verify").show();
                    console.log($("#button_final_verify"));
                    if (load_payment) {
                        checkout_payment_method();
                    }


                    if (shipping_required_in == '1') {
                        var shipping_address = $('.payment-address-step input[name=\'shipping_address\']:checked').attr('value');
                        if (shipping_address) {
                            if (further == true) {
                                guest_shipping_checkout(false);
                            }



                            //No need to do load shipping method
//                            $.ajax({
//                                url: 'index.php?route=checkout/shipping_method',
//                                dataType: 'html',
//                                success: function (html) {
//                                    $('.shipping-method-step .checkout-content').html(html);
//
//                                    $('.shipping-method-step .checkout-content').slideDown('slow');
//
//                                    // guest_shipping();
//                                    
//                                },
//                                error: function (xhr, ajaxOptions, thrownError) {
//                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                                }
//                            });
                        } else {
                            // guest_shipping();
                        }

                    } else {
                        //No payment method need
//                        $.ajax({
//                            url: 'index.php?route=checkout/payment_method',
//                            dataType: 'html',
//                            success: function (html) {
//                                $('.payment-method-step  .checkout-content').html(html);
//                                $('.payment-method-step  .checkout-content').slideDown('slow');
//
//                            },
//                            error: function (xhr, ajaxOptions, thrownError) {
//                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                            }
//                        });
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function shipping_method_checkout() {
        $.ajax({
            url: 'index.php?route=checkout/shipping_method/validate',
            type: 'post',
            data: $('.shipping-method-step input[type=\'radio\']:checked, .shipping-method-step textarea'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-shipping-method').attr('disabled', true);
                $('#button-shipping-method').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-shipping-method').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('.shipping-method-step .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                        $('.warning').fadeIn('slow');
                    }
                } else {

                    payment_method_checkout();

                    //No Need this function
//                    $.ajax({
//                        url: 'index.php?route=checkout/payment_method',
//                        dataType: 'html',
//                        success: function (html) {
//                            $(' .checkout-content').html(html);
//                            $('.shipping-method-step .checkout-content').slideUp('slow');
//                            $('.payment-method-step  .checkout-content').slideDown('slow');
//                            $('.shipping-method-step .checkout-heading a').remove();
//                            $('.payment-method-step  .checkout-heading a').remove();
//                            $('.shipping-method-step .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                        }
//                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    /**
     * lOAD sHIPPING METHODS
     
     * @returns {undefined}     */
    function checkout_shipping_method() {
        $.ajax({
            url: 'index.php?route=checkout/shipping_method',
            dataType: 'html',
            success: function (html) {
                $('.shipping-method-step .checkout-content').html(html);
                $('.shipping-method-step .checkout-content').slideDown('slow');

                if ($('input[name=\'account\']:checked') == "guest") {
                    guest_shipping_checkout(false);
                }


                checkout_payment_method();

//                $.ajax({
//                    url: 'index.php?route=checkout/shipping_address',
//                    dataType: 'html',
//                    success: function (html) {
//                        $('.shipping-address-step .checkout-content').html(html);
//                    },
//                    error: function (xhr, ajaxOptions, thrownError) {
//                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//                    }
//                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function checkout_confirm(is_ajax) {
        if (is_ajax == '1') {
            url_checkout = 'index.php?route=checkout/confirminit&is_ajax=' + is_ajax;
        }
        else {
            url_checkout = 'index.php?route=checkout/confirm';
        }
   

        $.ajax({
            url: url_checkout,
            dataType: 'html',
            success: function (html) {
                $('#confirm .checkout-content').html(html);
                $('#confirm .checkout-content').slideDown('slow');
                fill_cpfField();
                
                if (is_ajax != '1') {
                    // $("#button-confirm").remove();

                    $("#button_final_verify").hide();
                }
                else {
                    //$("#button_final_verify").show();
                }
                $(loader_box).hide();

                if (is_ajax == '1') {
                    $("span.error").remove();
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }




//==========End payment address=============
// Checkout
    function button_account_click() {
        if (logged_in == '') {
            //$(".checkout_login_ck").prop("checked", false);
            if ($('input[name=\'account\']:checked').attr("value") == "register") {
                window.location = "?route=account/register&action=checkout";
                $(loader_box).hide();
                return false;

            }
            if ($(".checkout_login_register").length > 0 && $(".checkout_login_guest").length == 0) {
                $(loader_box).hide();
                return false;
            }


        }




        $.ajax({
            url: 'index.php?route=checkout/' + $('input[name=\'account\']:checked').attr('value'),
            dataType: 'html',
            beforeSend: function () {
                $('#button-account').attr('disabled', true);
                $('#button-account').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-account').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (html) {
                $('.warning, .error').remove();
                //making 3rd step here from js
                $('.payment-address-step').hide();

                $('.payment-address-step .checkout-content').html(html);
                $('.payment-address-step .checkout-content').slideDown('slow');

                if ($('input[name=\'account\']:checked').attr('value') == "guest") {
                    guest_shipping();
                    guest_validate(false, false);

                    ///handling 3rd step here from js

                    $("#payment-address-2-guest div.checkout-content").html($(".payment-address-step div#payment-new-2-guest").html());
                    $(".payment-address-step div#payment-new-2-guest").remove();
                    //for login user this box will be disabled 
                    if (loggin_in == "") {
                        $(".payment-address-step").show();
                        $(".payment-address-step").find("div.checkout-content").slideDown('slow');
                    }
                    $("#payment-address-2-guest div.checkout-content").slideDown('slow');

                    console.log($(".payment-address-step"));
                    if (logged_in != "") {
                        customer_information();
                    }
                }
                else {
                    //checkout_shipping();
                    checkout_register();
                }


            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function button_login_click() {
        $.ajax({
            url: 'index.php?route=checkout/login/validate',
            type: 'post',
            data: $('#checkout #login :input'),
            dataType: 'json',
            beforeSend: function () {
                $('#button-login').attr('disabled', true);
                $('#button-login').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('#button-login').attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {
                $('.warning, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    $('#checkout .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
                    $('.warning').fadeIn('slow');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

    function quickConfirm(module) {
        $.ajax({
            url: 'index.php?route=checkout/confirm',
            dataType: 'html',
            success: function (html) {
                $('#confirm .checkout-content').html(html);
                $('#confirm .checkout-content').slideDown('slow');
                fill_cpfField();
                $('.checkout-heading a').remove();
                $('#checkout .checkout-heading a').remove();
                $('#checkout .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
                $('.shipping-address-step .checkout-heading a').remove();
                $('.shipping-address-step .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
                $('.shipping-method-step .checkout-heading a').remove();
                $('.shipping-method-step .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
                $('.payment-address-step .checkout-heading a').remove();
                $('.payment-address-step .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
                $('.payment-method-step  .checkout-heading a').remove();
                $('.payment-method-step  .checkout-heading').append('<a><?php echo $text_modify; ?></a>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    
    function fill_cpfField(){
        if($('#confirm .checkout-content #creditCardHolderCPF').length>0){
            $('#confirm .checkout-content #creditCardHolderCPF').val($("#payment_cad_cpf").val());
        }
        else if($('#confirm .checkout-content #senderCPF').length>0){
            $('#confirm .checkout-content #senderCPF').val($("#payment_cad_cpf").val());
        }
        
    }

    $('#checkout .checkout-content input[name=\'account\']').live('change', function () {
        if ($(this).attr('value') == 'register') {
            $('.payment-address-step .checkout-heading span').html('<?php echo $text_checkout_account; ?>');
        } else {
            $('.payment-address-step .checkout-heading span').html('<?php echo $text_checkout_payment_address; ?>');
        }
    });
    $('.checkout-heading a').live('click', function () {
        $('.checkout-content').slideUp('slow');
        $(this).parent().parent().find('.checkout-content').slideDown('slow');
    });
    //button click
    $('#button-account').live('click', function () {
        button_account_click();
    });
// Login
    $('#button-login').live('click', function () {
        button_login_click();
    });
// Register
    $('#button-register').live('click', function () {
        checkout_register();
    });
// Payment Address	
    $('#button-payment-address').live('click', function () {
        payment_address_checkout(false);
    });
// Shipping Address			
    $('#button-shipping-address').live('click', function () {
        shipping_address_checkout(false);
    });

    $('#button-shipping-method').live('click', function () {
        shipping_method_checkout();
    });
    $('#button-payment-method').live('click', function () {
        payment_method_checkout();
    });
    // Guest Process
    $('#button-guest').live('click', function () {
        guest_validate(true, true);
    });
// Guest Shipping
    $('#button-guest-shipping').live('click', function () {

    });

    //============ Process of checkout ======================
    $(document).ready(function () {
        if (logged_in == "") {
            if (quickconfirm_in === "1") {
                quickConfirm();
            }
            else {
                checkout_login();
            }
        }
        else {
            if (quickconfirm_in === "1") {
                quickConfirm();
            }
            else {
                checkout_payment();
            }

        }
    });
    $(window).load(function () {
        loader_box.hide();
    });
//--></script> 
<?php echo $footer; ?>