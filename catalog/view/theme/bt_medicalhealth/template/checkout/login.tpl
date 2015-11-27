<div class="checkout_login_tp">
  <h2><?php echo $text_new_customer; ?></h2>
  <p class="text_p"><?php echo $text_checkout; ?></p>
  <?php if ($guest_checkout) { ?>
  <label for="guest">
    <?php if ($account == 'guest') { ?>
    <input class="checkout_login_ck" type="radio" name="account" value="guest" id="guest" checked="checked" />
    <?php } else { ?>
    <input class="checkout_login_ck" type="radio" name="account" value="guest" id="guest" />
    <?php } ?>
    <b><?php echo $text_guest; ?></b></label>
  <br />
  <?php } ?>
  <br />
  <label for="register">
    <?php if ($account == 'register') { ?>
    <input class="checkout_login_ck"  type="radio" name="account" value="register" id="register" checked="checked" />
    <?php } else { ?>
    <input class="checkout_login_ck" type="radio" name="account" value="register" id="register" />
    <?php } ?>
    <b><?php echo $text_register; ?></b></label>
  <br />
    


  <br />
  <p><?php echo $text_register_account; ?></p>
  <br />
  <span class="orange_button"><input type="button" value="<?php echo $button_continue; ?>" id="button-account" class="button" /></span>
</div>
<div id="login" >
  <h2><?php echo $text_returning_customer; ?></h2>
  <p class="text_p"><?php echo $text_i_am_returning_customer; ?></p>
  <b><?php echo $entry_email; ?></b><br />
  <input type="text" name="email" value="" />
  <br />
  <b><?php echo $entry_password; ?></b><br />
  <input type="password" name="password" value="" />
  <br />
  <br />
  <span class="orange_button"><input type="button" value="<?php echo $button_login; ?>" id="button-login" class="button" /></span>
  <a class="forgotten" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
</div>

<script type="text/javascript">
   if($(".checkout_login_ck").length==1){
          $(".checkout_login_ck").prop("checked",true);
   } 
   $('input[name=\'account\']').click(function(){
        button_account_click();
    })
</script>