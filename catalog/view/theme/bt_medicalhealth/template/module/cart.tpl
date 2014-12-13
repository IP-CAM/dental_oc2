<div id="cart">
  <div class="heading">
    <a><span id="cart-total"><?php echo $text_items; ?></span></a></div>
  <div class="content">
	<div class="bg_cart">
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
      <table class="cart">
        <?php foreach ($products as $product) { ?>
        <tr>      
		<td class="remove"><img src="catalog/view/theme/bt_medicalhealth/image/remove-small.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $product['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $product['key']; ?>' + ' #cart > *');" /></td>
          <td class="image"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><br/>
			  <div class="quantity"><?php echo $product['quantity']; ?>&nbsp;x&nbsp;</div>
			  <div class="total"><?php echo $product['total']; ?></div>
            <div class="sub">
              <?php foreach ($product['option'] as $option) { ?>
              - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
              <?php } ?>

              <?php if ($product['recurring']): ?>
              - <small><?php echo $text_payment_profile ?> <?php echo $product['profile']; ?></small><br />
              <?php endif; ?>
            </div>
		  </td>

        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>        
		<td class="remove"><img src="catalog/view/theme/bt_medicalhealth/image/remove-small.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $voucher['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $voucher['key']; ?>' + ' #cart > *');" /></td>
          <td class="image"></td>
          <td class="name"><span><?php echo $voucher['description']; ?></span>
			  <div class="quantity">1&nbsp;x&nbsp;</div>
			  <div class="total"><?php echo $voucher['amount']; ?></div>
		 </td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="mini-cart-total">
      <table class="total">
        <?php foreach ($totals as $total) { ?>
        <tr>
          <td class="left<?php echo ($total == end($totals) ? ' last' : ''); ?>"><b><?php echo $total['title']; ?>:</b></td>
          <td class="right<?php echo ($total == end($totals) ? ' last' : ''); ?>"><?php echo $total['text']; ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="checkout">
		<a class="cart_button" href="<?php echo $cart; ?>"><span><?php echo $text_cart; ?></span></a> 
		<a class="checkout_button" href="<?php echo $checkout; ?>"><span><?php echo $text_checkout; ?></span></a></div>
    <?php } else { ?>
    <div class="empty"><?php echo $text_empty; ?></div>
    <?php } ?>
	
	</div>
  </div>
</div>

<script type="text/javascript"><!--
$(document).ready(function() {
	if(getWidthBrowser() < 959) {
		$('#cart > .heading a').live('click', function() {
			if($('#cart').hasClass('my-active')){
				$('#cart').removeClass('active');
				$('#cart').removeClass('my-active');
			} else {
				$('#cart').addClass('my-active');
			}
		});
	}
});
--></script>