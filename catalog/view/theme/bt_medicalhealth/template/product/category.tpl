<?php echo $header; ?>
<div class="breadcrumb bc_category">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content" class="twelve columns">
    <div class="codespot-content main-column-content">
        <?php echo $content_top; ?>
        <h1 class="title_category"><?php echo $heading_title; ?></h1>
        <?php if ($thumb || $description) { ?>
            <div class="category-info">
                <?php if ($thumb) { ?>
                    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
                <?php } ?>
                <?php if ($description) { ?>
                    <?php echo $description; ?>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($categories) { ?>
            <div class="category-list">
                <h2><?php echo $text_refine; ?></h2>
                <?php if (count($categories) <= 3) { ?>
                    <ul>
                        <?php foreach ($categories as $category) { ?>
                            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <?php for ($i = 0; $i < count($categories);) { ?>
                        <ul>
                            <?php $j = $i + ceil(count($categories) / 3); ?>
                            <?php for (; $i < $j; $i++) { ?>
                                <?php if (isset($categories[$i])) { ?>
                                    <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($products) { ?>
            <!--<div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div>-->
            <div class="product-filter row">
                <div class="display"><b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display('grid');"><?php echo $text_grid; ?></a></div>
                <div class="limit"><b><?php echo $text_limit; ?></b>
                    <select onchange="location = this.value;">
                        <?php foreach ($limits as $limits) { ?>
                            <?php if ($limits['value'] == $limit) { ?>
                                <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="sort"><b><?php echo $text_sort; ?></b>
                    <select onchange="location = this.value;">
                        <?php foreach ($sorts as $sorts) { ?>
                            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
                                <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="product-list">
                <?php foreach ($products as $key => $product) { ?>
                    <div class="<?php echo (($key + 1) % 3 == 0 ? 'one-product-list last' : 'one-product-list' );
            echo ($product == end($products) ? ' lastest' : ''); ?>">
                        <?php if ($product['thumb']) { ?>
                            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
                        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                        <div class="description"><?php echo $product['description']; ?></div>
                        <?php if ($product['rating']) { ?>
                            <div class="rating"><img src="catalog/view/theme/bt_medicalhealth/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                        <?php } ?>
                            <?php if ($product['price']) { ?>
                            <div class="price">
                                <?php if (!$product['special']) { ?>
                                    <?php echo $product['price']; ?>
                                <?php } else { ?>
                                    <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                <?php } ?>
                                <?php if ($product['tax']) { ?>
                                    <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
                            <?php } ?>
                            </div>
        <?php } ?>
                        <div class="cart">
                            <?php 
                                $button_cart_text = $button_cart;
                                if(isset($product['product_on_phone']) && $product['product_on_phone'] ==1){
                                     $button_cart_text= 'Compras pelo televendas';
                                }
                                else {
                                    $button_cart_text = $button_cart;
                                }
                            ?>
                            <input type="button" value="<?php echo  $button_cart_text; ?>" onclick="boss_redirect('<?php echo $product['href']; ?>');" class="button" />
                        </div>
                        <div class="wishlist"><a onclick="boss_addToWishList('<?php echo $product['product_id']; ?>');"><?php echo $button_wishlist; ?></a></div>
                        <div class="compare"><a onclick="boss_addToCompare('<?php echo $product['product_id']; ?>');"><?php echo $button_compare; ?></a></div>
                        
                    </div>
    <?php } ?>
            </div>
            <div class="pagination"><?php echo $pagination; ?></div>
        <?php } ?>
<?php if (!$categories && !$products) { ?>
            <div class="content"><?php echo $text_empty; ?></div>
            <div class="buttons">
                <div class="left"><a href="<?php echo $continue; ?>" class="orange_button"><span><?php echo $button_continue; ?></span></a></div>
            </div>
        <?php } ?>
<?php echo $content_bottom; ?>
    </div>
</div>
<script type="text/javascript"><!--
function display(view) {
        if (view == 'list') {
            $('.product-grid').attr('class', 'product-list');

            $('.product-list > div').each(function (index, element) {
                html = '<div class="right">';

                html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
                html += '  <div class="description">' + $(element).find('.description').html() + '</div>';

                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price + '</div>';
                }

                html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
                html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
                html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                html += '</div>';

                html += '<div class="left">';

                var image = $(element).find('.image').html();

                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                html += '</div>';


                $(element).html(html);
            });

            $('.display').html('<b><?php echo $text_display; ?></b> <span class="active-list" title="<?php echo $text_list; ?>"><?php echo $text_list; ?></span><a title="<?php echo $text_grid; ?>" class="no-active-gird" onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');

            $.totalStorage('display', 'list');
        } else {
            $('.product-list').attr('class', 'product-grid');

            $('.product-grid > div').each(function (index, element) {
                html = '';

                var image = $(element).find('.image').html();

                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                html += '<div class="name">' + $(element).find('.name').html() + '</div>';
                html += '<div class="description">' + $(element).find('.description').html() + '</div>';

                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price + '</div>';
                }

                html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
                html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
                html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';

                $(element).html(html);
            });

            $('.display').html('<b><?php echo $text_display; ?></b> <a title="<?php echo $text_list; ?>" class="no-active-list" onclick="display(\'list\');"><?php echo $text_list; ?></a><span class="active-gird" title="<?php echo $text_grid; ?>" ><?php echo $text_grid; ?></span>');

            $.totalStorage('display', 'grid');
        }
    }

    view = $.totalStorage('display');

    if (view) {
        display(view);
    } else {
        display('list');
    }
//--></script> 
<script type="text/javascript"><!--
    $(document).ready(function () {
        category_resize();
    });
    $(window).resize(function () {
        category_resize();
    });
    function category_resize()
    {
        if (getWidthBrowser() < 767) {
            display('grid');
        }
    }

    function boss_redirect(path) {
        window.location = path;
    }
//--></script> 
<?php echo $footer; ?>