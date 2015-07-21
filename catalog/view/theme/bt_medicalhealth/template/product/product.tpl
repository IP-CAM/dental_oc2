<?php echo $header; ?>
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
    <div class="codespot-content main-column-content product_detail">
        <?php echo $content_top; ?>
        <div class="twelve product-info codespot-detail">
            <?php if ($thumb || $images) { ?>
                <div class="left">
                    <?php if ($thumb) { ?>
                        <div class="image a_bossthemes a_bossthemes_zoom"><a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image"
                                                                                                                                                    data-zoom-image="<?php echo $popup; ?>"

                                                                                                                                                    /></a></div>
                        <?php } ?>
                        <?php if ($images) { ?>
                        <div class="image-additional a_bossthemes">
                            <div class="es-carousel">
                                <ul  class="skin-opencart">
                                    <?php foreach ($images as $image) { ?>
                                        <li><div class="boss-image-add"><a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" 
                                                                                                                                                                             alt="<?php echo $heading_title; ?>" 
                                                                                                                                                                            
                                                                                                                                                                             /></a></div></li>
                                        <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="right">
                <h3 id="title_heading"><?php echo $heading_title; ?></h3>
                <div class="description">
                    <?php if ($manufacturer) { ?>
                        <span><?php echo $text_manufacturer; ?></span> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a><br />
                    <?php } ?>
                    <span ><?php echo $text_model; ?></span> <span id="text_model"><?php echo $model; ?></span><br />
                    <?php if ($reward) { ?>
                        <span><?php echo $text_reward; ?></span> <?php echo $reward; ?><br />
                    <?php } ?>
                    <span><?php echo $text_stock; ?></span><b id="stock_status"><?php echo $stock; ?></b><br />

                </div>
                <?php if ($price) { ?>
                    <div class="price">
                        <?php if (!$special) { ?>
                            <span class="price-text">
                                <?php echo $price; ?>
                            </span>


                        <?php } else { ?>
                            <span class="price-old"><?php echo $price; ?></span> <span class="price-new"><?php echo $special; ?></span>
                        <?php } ?>
                        <?php if ($tax) { ?>
                            <span class="price-tax"><?php echo $text_tax; ?> <span class="product_tax"><?php echo $tax; ?></span></span>
                        <?php } ?>
                        <?php if ($points) { ?>
                            <span class="reward"><small><?php echo $text_points; ?> <?php echo $points; ?></small></span>
                        <?php } ?>
                        <?php if ($discounts) { ?>
                            <div class="discount">
                                <?php foreach ($discounts as $discount) { ?>
                                    <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($profiles): ?>
                    <div class="option">
                        <h2><span class="required">*</span><?php echo $text_payment_profile ?></h2>
                        <br />
                        <select name="profile_id">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($profiles as $profile): ?>
                                <option value="<?php echo $profile['profile_id'] ?>"><?php echo $profile['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br />
                        <br />
                        <span id="profile-description"></span>
                        <br />
                        <br />
                    </div>
                <?php endif; ?>
                <?php if ($options) { ?>
                    <div class="options">
                        <h2><?php echo $text_option; ?></h2>
                        <br />
                        <?php foreach ($options as $option) { ?>
                            <?php if ($option['type'] == 'select') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <select name="option[<?php echo $option['product_option_id']; ?>]">
                                        <option value=""><?php echo $text_select; ?></option>
                                        <?php foreach ($option['option_value'] as $option_value) { ?>
                                            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <br />
                                <h2><?php echo $text_conf_option; ?></h2>
                                <br />

                                <br />

                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'radio') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <?php foreach ($option['option_value'] as $option_value) { ?>
                                        <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                        <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                            <?php if ($option_value['price']) { ?>
                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                            <?php } ?>
                                        </label>
                                        <br />
                                    <?php } ?>
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'checkbox') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <?php foreach ($option['option_value'] as $option_value) { ?>
                                        <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                        <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                            <?php if ($option_value['price']) { ?>
                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                            <?php } ?>
                                        </label>
                                        <br />
                                    <?php } ?>
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'image') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <table class="option-image">
                                        <?php foreach ($option['option_value'] as $option_value) { ?>
                                            <tr>
                                                <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
                                                <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
                                                <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                        <?php if ($option_value['price']) { ?>
                                                            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                        <?php } ?>
                                                    </label></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'text') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'textarea') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'file') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <span class="orange_button"><input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button"></span>
                                    <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'date') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'datetime') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
                                </div>
                                <br />
                            <?php } ?>
                            <?php if ($option['type'] == 'time') { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                    <b><?php echo $option['name']; ?>:</b>
                                    <?php if ($option['required']) { ?>
                                        <span class="required">*</span>
                                    <?php } ?><br />
                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
                                </div>
                                <br />
                            <?php } ?>
                        <?php } ?>
                        <?php
                        ?>
                    </div>
                <?php } ?>
                <div class="options">
                    <?php
                    //including something
                    include_once(DIR_TEMPLATE . "bt_medicalhealth/template/product/_conf_options.php");
                    ?>
                </div>
                <div class="cart">
                    <div><span class="qty"><?php echo $text_qty; ?></span>
                        <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
                        <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
                        &nbsp;
                        <div class="minimum"><?php echo $text_minimum; ?></div>
                        <input type="button" value="<?php echo $button_cart; ?>" id="button-cart" class="button" />
                    </div>
                    <div>
                        <div class="compare"><a onclick="boss_addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></div>
                        <div class="wishlist"><a onclick="boss_addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a></div>
                    </div>  
                    <?php if ($minimum > 1) { ?>
                    <?php } ?>
                </div>
                <?php
                //calculate shipping
                include_once(DIR_TEMPLATE . "bt_medicalhealth/template/product/_calculate_shipping.php");
                ?>
                <?php if ($review_status) { ?>
                    <div class="review">
                        <div><img src="catalog/view/theme/bt_medicalhealth/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');
                                    goToByScroll('tab-review');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');
                                            goToByScroll('review-title');"><?php echo $text_write; ?></a></div>
                        <div class="share"><!-- AddThis Button BEGIN -->
                            <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
                            <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
                            <!-- AddThis Button END --> 
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="tabs" class="htabs"><a href="#tab-description"><?php echo $tab_description; ?></a>
            <?php if ($attribute_groups) { ?>
                <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
            <?php } ?>
        </div>
        <h2 class="ta-header"><span><?php echo $tab_description; ?></span></h2>
        <div id="tab-description" class="tab-content">
            <?php echo $description; ?>
            <br/>
            <?php
            if (!empty($youtube)) {
                ?>
                <span><?php echo $text_youtube; ?></span>
                <?php
                if (strstr($youtube, 'http') && strstr($youtube, 'youtube')) {
                    if (!strstr($youtube, 'embed')) {
                        $youtube = explode("?v=", $youtube);

                        if (!empty($youtube[1])) {
                            $youtube = "https://www.youtube.com/embed/" . trim($youtube[1]);
                        }
                    } else {
                        
                    }
                    echo '<object width="420" height="315"
                                data="' . $youtube . '">
                                </object>';
                } else {
                    ?>
                    <b><?php echo $youtube; ?></b>    
                    <?php
                }
                ?>

                <?php
            }
            ?>
        </div>


        <?php if ($tags) { ?>
            <div class="tags"><b><?php echo $text_tags; ?></b>
                <?php for ($i = 0; $i < count($tags); $i++) { ?>
                    <?php if ($i < (count($tags) - 1)) { ?>
                        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                    <?php } else { ?>
                        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($attribute_groups) { ?>
            <h2 class="ta-header"><span><?php echo $tab_attribute; ?></span></h2>
            <div id="tab-attribute" class="tab-content">
                <table class="attribute">
                    <?php foreach ($attribute_groups as $attribute_group) { ?>
                        <thead>
                            <tr>
                                <td colspan="2"><?php echo $attribute_group['name']; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                <tr>
                                    <td><?php echo $attribute['name']; ?></td>
                                    <td><?php echo $attribute['text']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
        <?php if ($review_status) { ?>
            <h2 class="ta-review"><span><?php echo $tab_review; ?></span></h2>
            <div id="tab-review" class="tab-content">
                <div id="review" style="display:none"></div>

                <h2 id="review-title"><?php echo $text_write; ?></h2>
                <div id="review-form">  
                    <b><?php echo $entry_name; ?></b><br />
                    <input type="text" name="name" value="" />
                    <br />
                    <b><?php echo $entry_review; ?></b><br/>
                    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea><br/>
                    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
                    <br />
                    <span><?php echo $entry_rating; ?></span> &nbsp;&nbsp;<span class="entry"><?php echo $entry_bad; ?></span>&nbsp;&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;&nbsp;<span class="entry"><?php echo $entry_good; ?></span><br />
                    <br />v
                    <b><?php echo $entry_captcha; ?></b><br />
                    <input type="text" name="captcha" value="" />
                    <br />
                    <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><br />
                    <br />
                    <div class="buttons">
                        <div class="left"><a id="button-review" class="orange_button"><span><?php echo $button_continue; ?></span></a></div>
                    </div>
                </div>

            </div>
        <?php } ?>

        <?php if ($products) { ?>
            <h2 class="ta-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</h2>
            <div id="tab-related" class="tab-content">
                <div class="es-carousel">
                    <ul class="skin-opencart">
                        <?php foreach ($products as $product) { ?>
                            <li><div class="boss-tab-related">
                                    <?php if ($product['thumb']) { ?>
                                        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"  title="<?php echo $product['name']; ?>" /></a></div>
                                    <?php } ?>
                                    <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                                    <?php if ($product['price']) { ?>
                                        <div class="price">
                                            <?php if (!$product['special']) { ?>
                                                <?php echo $product['price']; ?>
                                            <?php } else { ?>
                                                <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div class="cart"><a onclick="boss_addToCart('<?php echo $product['product_id']; ?>');" class="button"><?php echo $button_cart; ?></a></div>
                                </div></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php } ?>


        <?php echo $content_bottom; ?></div></div>


<?php
if (file_exists('catalog/view/theme/bt_medicalhealth/stylesheet/boss_carousel_product.css')) {
    echo '<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/boss_carousel_product.css" media="screen" />';
} else {
    echo '<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/boss_carousel_product.css" media="screen" />';
}
?>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.easing.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/jquery.elastislide.js"></script>


<script type="text/javascript"><!--

    $(function () {
        $(".ta-review").live("click", function () {

            $("#review").toggle("slow");
        })

        $("#review-title").live("click", function () {

            $("#review-form").toggle("slow");
        })
    })
    function goToByScroll(id) {
        $('html,body').animate({scrollTop: $("#" + id).offset().top}, 'slow');
    }
//--></script>    
<script type="text/javascript"><!--
    $('select[name="profile_id"], input[name="quantity"]').change(function () {
        $.ajax({
            url: 'index.php?route=product/product/getRecurringDescription',
            type: 'post',
            data: $('input[name="product_id"], input[name="quantity"], select[name="profile_id"]'),
            dataType: 'json',
            beforeSend: function () {
                $('#profile-description').html('');
            },
            success: function (json) {
                $('.success, .warning, .attention, information, .error').remove();
                if (json['success']) {
                    $('#profile-description').html(json['success']);
                }
            }
        });
    });
    $('#button-cart').bind('click', function () {
        $.ajax({
            url: 'index.php?route=bossthemes/cart/add',
            type: 'post',
            data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
            dataType: 'json',
            success: function (json) {
                $('.warning, .attention, information, .error').remove();
                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                        }
                    }
                    if (json['error']['profile']) {
                        $('select[name="profile_id"]').after('<span class="error">' + json['error']['profile'] + '</span>');
                    }
                }

                if (json['success']) {
                    addProductNotice(json['title'], json['thumb'], json['success'], 'success');
                    $('#cart_menu span.s_grand_total').html(json['total_sum']);
                    $('#cart_menu div.s_cart_holder').html(json['output']);
                    $('#cart-total').html(json['total']);
                }
            }
        });
    });
    function appendNoticeTemplates() {
        if (!$("#notification-container").length) {
            var tpl = '<div id="notification-container" style="display: none">\
               <div id="thumb-template">\
                 <a class="ui-notify-cross ui-notify-close boss_button_remove" href="javascript:;"></a>\
                 <h2 class="boss_icon_success"><span class="boss_title"></span>#{title}</h2>\
                 <div class="boss_text">\
                   #{thumb}\
                   <h3>#{text}</h3>\
                 </div>\
               </div>\
               <div id="nothumb-template">\
                 <a class="ui-notify-cross ui-notify-close boss_button_remove" href="javascript:;"></a>\
                 <h2 class="boss_icon_success"><span class="boss_title"></span>#{title}</h2>\
                 <div class="boss_text">\
                   <h3>#{text}</h3>\
                 </div>\
               </div>\
             </div>';
            $(tpl).appendTo("body");
            $("#notification-container").notify();
        }
    }

    function addProductNotice(title, thumb, text, type) {
        if ($.browser.msie && $.browser.version.substr(0, 1) < 8) {
            simpleNotice(title, text, type);
            return false;
        }
        appendNoticeTemplates();
        $("#notification-container").notify("create", "thumb-template", {
            title: title,
            thumb: thumb,
            text: text,
            type: type
        }, {
            expires: 4000
        }
        );
    }

    function simpleNotice(title, text, type) {
        appendNoticeTemplates();
        $("#notification-container").notify("create", "nothumb-template", {
            title: title,
            text: text,
            type: type
        }, {
            expires: 4000
        }
        );
    }
//--></script>
<script type="text/javascript"><!--
    $(document).ready(function () {
        $('.colorbox').colorbox({
            overlayClose: true,
            opacity: 0.5,
            rel: "colorbox"
        });
    });
//--></script> 

<?php if ($options) { ?>
    <script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
    <?php foreach ($options as $option) { ?>
        <?php if ($option['type'] == 'file') { ?>
            <script type="text/javascript"><!--
            new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
                    action: 'index.php?route=product/product/upload',
                    name: 'file',
                    autoSubmit: true,
                    responseType: 'json',
                    onSubmit: function (file, extension) {
                        $('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
                        $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
                    },
                    onComplete: function (file, json) {
                        $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
                        $('.error').remove();
                        if (json['success']) {
                            alert(json['success']);
                            $('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
                        }

                        if (json['error']) {
                            $('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
                        }

                        $('.loading').remove();
                    }
                });
                //--></script>
        <?php } ?>
    <?php } ?>
<?php } ?>
<script type="text/javascript" 
src="catalog/view/javascript/bossthemes/jquery.elevatezoom.js"></script>

<script>

                $(".image.a_bossthemes_zoom img").elevateZoom({
                    //zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                });</script>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function () {
        $('#review').fadeOut('slow');
        $('#review').load(this.href);
        $('#review').fadeIn('slow');
        return false;
    });
    $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');
    $('#button-review').bind('click', function () {
        $.ajax({
            url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
            type: 'post',
            dataType: 'json',
            data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
            beforeSend: function () {
                $('.success, .warning').remove();
                $('#button-review').attr('disabled', true);
                $('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
            },
            complete: function () {
                $('#button-review').attr('disabled', false);
                $('.attention').remove();
            },
            success: function (data) {
                if (data['error']) {
                    $('#review-title').after('<div class="warning">' + data['error'] + '</div>');
                }

                if (data['success']) {
                    $('#review-title').after('<div class="success">' + data['success'] + '</div>');
                    $('input[name=\'name\']').val('');
                    $('textarea[name=\'text\']').val('');
                    $('input[name=\'rating\']:checked').attr('checked', '');
                    $('input[name=\'captcha\']').val('');
                }
            }
        });
    });
//--></script>
<script type="text/javascript"><!--
    $('h2.ta-header').click(function () {
        $(this).next().toggle();
        return false;
    }).next().hide();
//--></script> 
<script type="text/javascript"><!--
    $('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function () {
        if ($.browser.msie && $.browser.version == 6) {
            $('.date, .datetime, .time').bgIframe();
        }

        $('.date').datepicker({dateFormat: 'yy-mm-dd'});
        $('.datetime').datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'h:m'
        });
        $('.time').timepicker({timeFormat: 'h:m'});
    });
//--></script>
<script type="text/javascript"><!--
    $(document).ready(function () {
        product_resize();
    });
    $(window).resize(function () {
        product_resize();
    });
    function disableLink(e) {
        e.preventDefault();
        return false;
    }

    function product_resize() {
        if (getWidthBrowser() < 767) {
            $('div.a_bossthemes a').bind('click', disableLink);
            $('#tabs').hide();
            $('h2.ta-header').show();
        } else {
            $('div.a_bossthemes a').unbind('click', disableLink);
            $('h2.ta-header').hide();
            $('#tabs').show();
            $('#tab-related').elastislide({
                imageW: 225,
                border: 0,
                current: 0,
                margin: 0,
                onClick: true,
                minItems: 3,
                disable_touch: true
            });
            $('.image-additional').elastislide({
                imageW: 90,
                border: 0,
                current: 0,
                margin: 0,
                onClick: true,
                minItems: 3,
                disable_touch: true
            });
        }
    }

//--></script> 
<?php echo $footer; ?>