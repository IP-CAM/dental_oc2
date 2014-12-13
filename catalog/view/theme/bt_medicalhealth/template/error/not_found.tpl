<?php echo $header; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content" class="eleven omega alpha columns clearfix<?php  if(($_GET['route'])=='checkout/cart'){ echo ' error_cart';} ?>">
<div class="codespot-content main-column-content"><?php echo $content_top; ?>
  <h1><?php echo $heading_title; ?></h1>
  <div class="content"><?php echo $text_error; ?></div>
  <div class="buttons">
    <div class="left"><a href="<?php echo $continue; ?>" class="orange_button"><span><?php echo $button_continue; ?></span></a></div>
  </div>
  <?php echo $content_bottom; ?></div></div>
<?php echo $footer; ?>