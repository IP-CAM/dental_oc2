</div>
<div id="footer" class="sixteen columns alpha omega">
  <?php echo $footer_top; ?>
  <?php if ($informations) { ?>
  <div class="footerwrap">
  <div class="three columns">
    <h3 class="color_1"><?php echo $text_information; ?></h3>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
      <li><a class="pagfooter"><img src="http://eunicesolucoes.web1129.kinghost.net/image/data/Banner Slide/PagSeguro_Footer.jpg" alt="Banner" title="Banner"/></a></li>

    </ul>
  </div>
  <?php } ?>
  <div class="three columns">
    <h3 class="color_2"><?php echo $text_service; ?></h3>
    <ul>
      <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>

    </ul>
  </div>
  <div class="three columns">
    <h3 class="color_3"><?php echo $text_extra; ?></h3>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <!--<li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li> -->
      <!-- <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li> -->
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
    </div>
	<?php echo $footer_bottom; ?>
</div>

<div id="powered" class="sixteen columns alpha omega">
	<div class="select_active"><?php echo $currency; ?>
	<?php echo $language; ?></div>
	<span class="text-power"><?php echo $powered; ?></span>
</div>

</div>
</div>
</body></html>