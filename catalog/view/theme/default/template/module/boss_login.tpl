<div class="contact-us">
	<ul>
		<li>
			<a class="contact-icon" href="index.php?route=information/contact" title="contact us"><?php echo $contact_us; ?></a>	
		</li>
	</ul>
</div> <!-- End .contact-us -->   
<div class="acount">
	<ul>
	<li>	
		<a class="login-icon" href="index.php?route=account/account"><?php echo $text_account; ?></a>
		<div class="frame_big">	
			<div class="content-login">
				<form action="<?php echo $action_login; ?>" method="post" enctype="multipart/form-data" id="logintop" >
					<div class="login-frame">
					<ul class="link">
						 <li><a href="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></a></li>
						 <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
						 <li><a href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a></li>
						 <li class="last"><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
					</ul>
					<?php if (!$logged) { ?>
					<!-- Login -->
						<span class="title-login"><?php echo $text_login; ?></span>
						<input type="text" name="email" autocomplete="off"  onblur="if(this.value=='') this.value=this.defaultValue" onfocus="if(this.value==this.defaultValue) this.value=''" value="<?php echo $text_email; ?>" />
						<input type="password" name="password" onblur="if(this.value=='') this.value=this.defaultValue" onfocus="if(this.value==this.defaultValue) this.value=''" value="<?php echo $entry_password; ?>" />
						<a onclick="$('#logintop').submit();" class="orange_button"><span><?php echo $button_login; ?></span></a>
						<a class="forgotpass" href="<?php echo $forgotten; ?>"><?php  echo $text_forgotten; ?></a><br />
						<span class="signup"><?php echo $text_register; ?></span>
					<?php } ?>
					</div>
				</form>
			</div>
			
  		</div><!-- end frame_big -->
	</li>
</ul>
</div> <!-- End .account -->  

