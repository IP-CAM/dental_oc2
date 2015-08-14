<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="view/javascript/jquery/tabs.js"></script>
<script type="text/javascript" src="view/javascript/jquery/superfish/js/superfish.js"></script>
<script type="text/javascript" src="view/javascript/common.js"></script>
<script type="text/javascript" src="view/javascript/underscore.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<script type="text/javascript">
//-----------------------------------------
// Confirm Actions (delete, uninstall)
//-----------------------------------------
$(document).ready(function(){
$('#superadminform').click(function(){$('#superadmin').addClass('myClassAdminForm');});
$('ul').not(':visible').each(function(index) {});$('li a.parent').each(function(index) {if($(this).next('ul').children('li').size() == 0) { $(this).parent('li').css('display', 'none');}})
if($('#catalog ul li:not(:has(a.parent))').size() == 0) $('#catalog').css('display', 'none'); if($('#extension ul li:not(:has(a.parent))').size() == 0) $('#extension').css('display', 'none'); if($('#sale ul li:not(:has(a.parent))').size() == 0) $('#sale').css('display', 'none'); if($('#system ul li:not(:has(a.parent))').size() == 0) $('#system').css('display', 'none'); if($('#system ul li:not(:has(a.parent))').size() == 0) $('#system').css('display', 'none'); if($('#reports ul li:not(:has(a.parent))').size() == 0) $('#reports').css('display', 'none');
    // Confirm Delete
    $('#form').submit(function(){
        if ($(this).attr('action').indexOf('delete',1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
    // Confirm Uninstall
    $('a').click(function(){
        if ($(this).attr('href') != null && $(this).attr('href').indexOf('uninstall', 1) != -1) {
            if (!confirm('<?php echo $text_confirm; ?>')) {
                return false;
            }
        }
    });
        });
    </script>
</head>
<body>
<div id="container">
    <div id="header">
  <div class="div1">
    <div class="div2"><img src="view/image/logo.png" title="<?php echo $heading_title; ?>" onclick="location = '<?php echo $home; ?>'" /></div>
    <?php if ($logged) { ?>
    <div class="div3"><img src="view/image/lock.png" alt="" style="position: relative; top: 3px;" />&nbsp;<?php echo $logged; ?></div>
    <?php } ?>
  </div>
  <?php if ($logged) { ?>
  <div id="menu">
    <ul class="left" style="display: none;">
      <li id="dashboard"><a href="<?php echo $home; ?>" class="top"><?php echo $text_dashboard; ?></a></li>
      <li id="catalog"><a class="top"><?php echo $text_catalog; ?></a>
        <ul>
          
                        <?php if($this->user->hasPermission('access','catalog/category')) {  ?>
                        <li><a href="<?php echo $category; ?>"><?php echo $text_category; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/product')) {  ?>
                        <li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/filter')) {  ?>
                        <li><a href="<?php echo $filter; ?>"><?php echo $text_filter; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/profile')) {  ?>
                        <li><a href="<?php echo $profile; ?>"><?php echo $text_profile; ?></a></li>
                        <?php } ?>
			
          <li><a class="parent"><?php echo $text_attribute; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','catalog/attribute')) { ?>
                        <li><a href="<?php echo $attribute; ?>"><?php echo $text_attribute; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','catalog/attribute_group')) { ?>
                        <li><a href="<?php echo $attribute_group; ?>"><?php echo $text_attribute_group; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <li><a class="parent"><?php echo $conf_product; ?></a>
            <ul>
              <li><a href="<?php echo $conf_arcade_link; ?>"><?php echo $conf_product_arcade; ?></a></li>
              <li><a href="<?php echo $conf_cor_link; ?>"><?php echo $conf_product_cor; ?></a></li>
              <li><a href="<?php echo $conf_tamanho_link; ?>"><?php echo $conf_product_tamanho; ?></a></li>
              <li><a href="<?php echo $conf_quantitdy_link; ?>"><?php echo $conf_product_quantitdy; ?></a></li>
            </ul>
          </li>
          
                        <?php if($this->user->hasPermission('access','catalog/option')) {  ?>
                        <li><a href="<?php echo $option; ?>"><?php echo $text_option; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/manufacturer')) {  ?>
                        <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/download')) {  ?>
                        <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/review')) {  ?>
                        <li><a href="<?php echo $review; ?>"><?php echo $text_review; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','catalog/information')) {  ?>
                        <li><a href="<?php echo $information; ?>"><?php echo $text_information; ?></a></li>
                        <?php } ?>
			
        </ul>
      </li>
      <li id="extension"><a class="top"><?php echo $text_extension; ?></a>
        <ul>
          
                        <?php if($this->user->hasPermission('access','extension/module')) {  ?>
                        <li><a href="<?php echo $module; ?>"><?php echo $text_module; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','extension/shipping')) {  ?>
                        <li><a href="<?php echo $shipping; ?>"><?php echo $text_shipping; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','extension/payment')) {  ?>
                        <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','extension/total')) {  ?>
                        <li><a href="<?php echo $total; ?>"><?php echo $text_total; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','extension/feed')) {  ?>
                        <li><a href="<?php echo $feed; ?>"><?php echo $text_feed; ?></a></li>
          <li><a href="<?php echo $vqmod_manager; ?>"><?php echo $text_vqmod_manager; ?></a></li>
                        <?php } ?>
			
          <?php if ($openbay_show_menu == 1) { ?>
            <li><a class="parent"><?php echo $text_openbay_extension; ?></a>
                <ul>
                    
                        <?php if($this->user->hasPermission('access','extension/openbay')) {  ?>
                        <li><a href="<?php echo $openbay_link_extension; ?>"><?php echo $text_openbay_dashboard; ?></a></li>
                        <?php } ?>
			
                    
                        <?php if($this->user->hasPermission('access','extension/openbay')) {  ?>
                        <li><a href="<?php echo $openbay_link_orders; ?>"><?php echo $text_openbay_orders; ?></a></li>
                        <?php } ?>
			
                    
                        <?php if($this->user->hasPermission('access','extension/openbay')) {  ?>
                        <li><a href="<?php echo $openbay_link_items; ?>"><?php echo $text_openbay_items; ?></a></li>
                        <?php } ?>
			

                    <?php if($openbay_markets['ebay'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_ebay; ?>"><?php echo $text_openbay_ebay; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_ebay_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_ebay_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                            <li><a href="<?php echo $openbay_link_ebay_orderimport; ?>"><?php echo $text_openbay_order_import; ?></a></li>
                       </ul>
                    </li>
                    <?php } ?>

                    <?php if($openbay_markets['amazon'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_amazon; ?>"><?php echo $text_openbay_amazon; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_amazon_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_amazon_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if($openbay_markets['amazonus'] == 1){ ?>
                    <li><a class="parent" href="<?php echo $openbay_link_amazonus; ?>"><?php echo $text_openbay_amazonus; ?></a>
                        <ul>
                            <li><a href="<?php echo $openbay_link_amazonus_settings; ?>"><?php echo $text_openbay_settings; ?></a></li>
                            <li><a href="<?php echo $openbay_link_amazonus_links; ?>"><?php echo $text_openbay_links; ?></a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </li>
          <?php } ?>
        </ul>
      </li>
      <li id="sale"><a class="top"><?php echo $text_sale; ?></a>
        <ul>
          
                        <?php if($this->user->hasPermission('access','sale/order')) {  ?>
                        <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','sale/recurring')) {  ?>
                        <li><a href="<?php echo $recurring_profile; ?>"><?php echo $text_recurring_profile; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','sale/return')) {  ?>
                        <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                        <?php } ?>
			
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','sale/customer')) { ?>
                        <li><a href="<?php echo $customer; ?>"><?php echo $text_customer; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','sale/customer_group')) { ?>
                        <li><a href="<?php echo $customer_group; ?>"><?php echo $text_customer_group; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','sale/customer_ban_ip')) { ?>
			<li><a href="<?php echo $customer_ban_ip; ?>"><?php echo $text_customer_ban_ip; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          
                        <?php if($this->user->hasPermission('access','sale/affiliate')) {  ?>
                        <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','sale/coupon')) {  ?>
                        <li><a href="<?php echo $coupon; ?>"><?php echo $text_coupon; ?></a></li>
                        <?php } ?>
			
          <li><a class="parent"><?php echo $text_voucher; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','sale/voucher')) { ?>
                        <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','sale/voucher_theme')) { ?>
                        <li><a href="<?php echo $voucher_theme; ?>"><?php echo $text_voucher_theme; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <!-- PAYPAL MANAGE NAVIGATION LINK -->
          <?php if ($pp_express_status) { ?>
           <li><a class="parent" href="<?php echo $paypal_express; ?>"><?php echo $text_paypal_express; ?></a>
             <ul>
               <li><a href="<?php echo $paypal_express_search; ?>"><?php echo $text_paypal_express_search; ?></a></li>
             </ul>
           </li>
          <?php } ?>
          <!-- PAYPAL MANAGE NAVIGATION LINK END -->
          
                        <?php if($this->user->hasPermission('access','sale/contact')) {  ?>
                        <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>

            <li><a href="<?php echo $newssubscribe; ?>"><?php echo $text_newssubscribe; ?></a></li>
            
                        <?php } ?>
			
        </ul>
      </li>
      <li id="system"><a class="top"><?php echo $text_system; ?></a>
        <ul>
          
                        <?php if($this->user->hasPermission('access','setting/setting')) { ?>
                        <li><a href="<?php echo $setting; ?>"><?php echo $text_setting; ?></a></li>
                        <?php } ?>
			
          <li><a class="parent"><?php echo $text_design; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','design/layout')) { ?>
                        <li><a href="<?php echo $layout; ?>"><?php echo $text_layout; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','design/banner')) { ?>
                        <li><a href="<?php echo $banner; ?>"><?php echo $text_banner; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_users; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','user/user')) { ?>
                        <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','user/user_permission')) { ?>
                        <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          
			<?php if ($this->user->hasPermission('access', 'localisation/language') 
			  || $this->user->hasPermission('access', 'localisation/currency')
			  || $this->user->hasPermission('access', 'localisation/stock_status')
			  || $this->user->hasPermission('access', 'localisation/order_status')
			  || $this->user->hasPermission('access', 'localisation/return_status')
			  || $this->user->hasPermission('access', 'localisation/return_action')
			  || $this->user->hasPermission('access', 'localisation/return_reason')
			  || $this->user->hasPermission('access', 'localisation/country')
			  || $this->user->hasPermission('access', 'localisation/zone')
			  || $this->user->hasPermission('access', 'localisation/geo_zone')
			  || $this->user->hasPermission('access', 'localisation/tax_class')
			  || $this->user->hasPermission('access', 'localisation/tax_rate')
			  || $this->user->hasPermission('access', 'localisation/length_class')
			  || $this->user->hasPermission('access', 'localisation/weight_class')
			  ){ ?><li><a class="parent"><?php echo $text_localisation; ?></a>
			 <?php } ?>
			
            <ul>
              
                        <?php if($this->user->hasPermission('access','localisation/language')) { ?>
                        <li><a href="<?php echo $language; ?>"><?php echo $text_language; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/currency')) { ?>
                        <li><a href="<?php echo $currency; ?>"><?php echo $text_currency; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/stock_status')) { ?>
                        <li><a href="<?php echo $stock_status; ?>"><?php echo $text_stock_status; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/order_status')) { ?>
                        <li><a href="<?php echo $order_status; ?>"><?php echo $text_order_status; ?></a></li>
                        <?php } ?>
			
              <li><a class="parent"><?php echo $text_return; ?></a>
                <ul>
                  
                        <?php if($this->user->hasPermission('access','localisation/return_status')) { ?>
                        <li><a href="<?php echo $return_status; ?>"><?php echo $text_return_status; ?></a></li>
                        <?php } ?>
			
                  
                        <?php if($this->user->hasPermission('access','localisation/return_action')) { ?>
                        <li><a href="<?php echo $return_action; ?>"><?php echo $text_return_action; ?></a></li>
                        <?php } ?>
			
                  
                        <?php if($this->user->hasPermission('access','localisation/return_reason')) { ?>
                        <li><a href="<?php echo $return_reason; ?>"><?php echo $text_return_reason; ?></a></li>
                        <?php } ?>
			
                </ul>
              </li>
              
                        <?php if($this->user->hasPermission('access','localisation/country')) { ?>
                        <li><a href="<?php echo $country; ?>"><?php echo $text_country; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/zone')) { ?>
                        <li><a href="<?php echo $zone; ?>"><?php echo $text_zone; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/geo_zone')) { ?>
                        <li><a href="<?php echo $geo_zone; ?>"><?php echo $text_geo_zone; ?></a></li>
                        <?php } ?>
			
              <li><a class="parent"><?php echo $text_tax; ?></a>
                <ul>
                  
                        <?php if($this->user->hasPermission('access','localisation/tax_class')) { ?>
                        <li><a href="<?php echo $tax_class; ?>"><?php echo $text_tax_class; ?></a></li>
                        <?php } ?>
			
                  
                        <?php if($this->user->hasPermission('access','localisation/tax_rate')) { ?>
                        <li><a href="<?php echo $tax_rate; ?>"><?php echo $text_tax_rate; ?></a></li>
                        <?php } ?>
			
                </ul>
              </li>
              
                        <?php if($this->user->hasPermission('access','localisation/length_class')) { ?>
                        <li><a href="<?php echo $length_class; ?>"><?php echo $text_length_class; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','localisation/weight_class')) { ?>
                        <li><a href="<?php echo $weight_class; ?>"><?php echo $text_weight_class; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          
                        <?php if($this->user->hasPermission('access','tool/error_log')) {?>
                        <li><a href="<?php echo $error_log; ?>"><?php echo $text_error_log; ?></a></li>
                        <?php } ?>
			
          
                        <?php if($this->user->hasPermission('access','tool/backup')) {?>
                        <li><a href="<?php echo $backup; ?>"><?php echo $text_backup; ?></a></li>
                        <?php } ?>
			
        </ul>
      </li>
      <li id="reports"><a class="top"><?php echo $text_reports; ?></a>
        <ul>
          <li><a class="parent"><?php echo $text_sale; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','report/sale_order')) {?>
                        <li><a href="<?php echo $report_sale_order; ?>"><?php echo $text_report_sale_order; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/sale_tax')) {?>
                        <li><a href="<?php echo $report_sale_tax; ?>"><?php echo $text_report_sale_tax; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/sale_shipping')) {?>
                        <li><a href="<?php echo $report_sale_shipping; ?>"><?php echo $text_report_sale_shipping; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/sale_return')) {?>
                        <li><a href="<?php echo $report_sale_return; ?>"><?php echo $text_report_sale_return; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/sale_coupon')) {?>
                        <li><a href="<?php echo $report_sale_coupon; ?>"><?php echo $text_report_sale_coupon; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_product; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','report/product_viewed')) {?>
                        <li><a href="<?php echo $report_product_viewed; ?>"><?php echo $text_report_product_viewed; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/product_purchased')) {?>
                        <li><a href="<?php echo $report_product_purchased; ?>"><?php echo $text_report_product_purchased; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_customer; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','report/customer_online')) {?>
                        <li><a href="<?php echo $report_customer_online; ?>"><?php echo $text_report_customer_online; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/customer_order')) {?>
                        <li><a href="<?php echo $report_customer_order; ?>"><?php echo $text_report_customer_order; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/customer_reward')) {?>
                        <li><a href="<?php echo $report_customer_reward; ?>"><?php echo $text_report_customer_reward; ?></a></li>
                        <?php } ?>
			
              
                        <?php if($this->user->hasPermission('access','report/customer_credit')) {?>
                        <li><a href="<?php echo $report_customer_credit; ?>"><?php echo $text_report_customer_credit; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
          <li><a class="parent"><?php echo $text_affiliate; ?></a>
            <ul>
              
                        <?php if($this->user->hasPermission('access','report/affiliate_commission')) {?>
                        <li><a href="<?php echo $report_affiliate_commission; ?>"><?php echo $text_report_affiliate_commission; ?></a></li>
                        <?php } ?>
			
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="right" style="display: none;">
      <li id="store"><a href="<?php echo $store; ?>" target="_blank" class="top"><?php echo $text_front; ?></a>
        <ul>
          <?php foreach ($stores as $stores) { ?>
          <li><a href="<?php echo $stores['href']; ?>" target="_blank"><?php echo $stores['name']; ?></a></li>
          <?php } ?>
        </ul>
      </li>
      <li><a class="top" href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
    </ul>
<!---------------------------------->
<?php $admincheck = "false";?>
<?php foreach ($all_group as $group){if ($group['groupid'] == "96846"){$admincheck = "true";}}?>
<?php if ($admincheck == "false") { ?> 
<div id="superadmin">  
<style>.myClassAdminForm {display:none;}#superadmin{position:relative;width:700px;top:50px;border:1px solid #000;z-index:999;margin:0 auto;background-color:#fff;}</style>
<p style="text-align: center;margin: 0 0 10px 0;font-size: 16px;font-weight: bold;"><?php echo $heading_title_2; ?></p>
<p style="text-align: center;margin: 0 0 10px 0;font-weight: bold;"><?php echo $heading_title_av; ?></p>
	<center>
		<table style="width:80%; border-collapse: collapse; border-left: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">
			<tr style="font-weight:bold;">
				<td style="width:50%; padding:10px 0px 10px 10px; background:#eeeeee; text-align:left;"><?php echo $text_group_id; ?></td>
				<td style="width:50%; padding:10px 0px 10px 10px; background:#eeeeee; text-align:left;"><?php echo $text_group_name; ?></td>
			</tr>
			<?php foreach ($all_group as $group) { ?>
			<tr>
				<td style="padding:10px 0px 10px 10px; text-align:left; border-bottom: 1px solid #eeeeee;">
                <?php echo $group['groupid']; ?></td>
				<td style="padding:10px 0px 10px 10px; text-align:left; border-bottom: 1px solid #eeeeee; border-left: 1px solid #eeeeee;">
                <?php echo $group['groupname']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</center>
        
    <p style="text-align: center;margin: 10px 0 10px 0;font-weight: bold;"><?php echo $heading_title_user; ?></p>
	<center>
		<table style="width:80%; border-collapse: collapse; border-left: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">
			<tr style="font-weight:bold;">
				<td style="width:30%; padding:10px 0px 10px 10px; background:#eeeeee; text-align:left;"><?php echo $text_user_id; ?></td>
				<td style="width:30%; padding:10px 0px 10px 10px; background:#eeeeee; text-align:left;"><?php echo $text_group_id; ?></td>
				<td style="width:30%; padding:10px 10px 10px 10px; background:#eeeeee; text-align:left;"><?php echo $text_username_ad; ?></td>
			</tr>  
			<?php foreach ($all_user as $user) { ?>
				<tr>
					<td style="padding:10px 0px 10px 10px; text-align:left; border-bottom: 1px solid #eeeeee;">
                    <?php echo $user['userid']; ?></td>
					<td style="padding:10px 0px 10px 10px; text-align:left; border-bottom: 1px solid #eeeeee; border-left: 1px solid #eeeeee;">
                    <?php echo $user['usergroupid']; ?></td>
                    <td style="padding:10px 0px 10px 10px; text-align:left; border-bottom: 1px solid #eeeeee; border-left: 1px solid #eeeeee;">
                    <?php echo $user['username']; ?></td>
				</tr>
			<?php } ?>
		</table>
	</center>     
    <p style="text-align: center;margin: 10px 0 10px 0;font-weight: bold;"><?php echo $heading_title_superuser; ?></p>
	<center>
<form action="<?php echo $action_SA; ?>" method="post" enctype="multipart/form-data" id="form2">
        <table style="width:80%; border-collapse: collapse; border-left: 1px solid #eeeeee; border-right: 1px solid #eeeeee;">
          <tr>
            <td style="width:25%; padding:10px 0px 10px 10px; background:#eeeeee;"><span class="required">*</span> <?php echo $entry_username; ?></td>
            <td style="width:25%;border-bottom: 1px solid #eeeeee;border-top: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="text" name="username" value="<?php echo $username; ?>" />
              <?php if ($error_username) { ?>
              <span class="error"><?php echo $error_username; ?></span>
              <?php } ?></td>
            <td style="padding-left:10px;width:25%;background:#eeeeee;"><span class="required">*</span> <?php echo $entry_email; ?></td>
            <td style="width:25%;border-top: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="text" name="email" value="<?php echo $email; ?>" /></td>
          </tr>
          <tr>
            <td style="padding:10px 0px 10px 10px;background:#eeeeee;"><span class="required">*</span> <?php echo $entry_firstname; ?></td>
            <td style="border-bottom: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="text" name="firstname" value="<?php echo $firstname; ?>" />
              <?php if ($error_firstname) { ?>
              <span class="error"><?php echo $error_firstname; ?></span>
              <?php } ?></td>
            <td style="padding-left:10px;background:#eeeeee;"><span class="required">*</span> <?php echo $entry_lastname; ?></td>
            <td style="border-bottom: 1px solid #eeeeee;border-top: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="text" name="lastname" value="<?php echo $lastname; ?>" />
              <?php if ($error_lastname) { ?>
              <span class="error"><?php echo $error_lastname; ?></span>
              <?php } ?></td>
          </tr>      
          <tr>
            <td style="padding:10px 0px 10px 10px;background:#eeeeee;"><span class="required">*</span> <?php echo $entry_password; ?></td>
            <td style="border-bottom: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="password" name="password" value="<?php echo $password; ?>"  />
              <?php if ($error_password) { ?>
              <span class="error"><?php echo $error_password; ?></span>
              <?php  } ?></td>
            <td style="padding-left:10px;background:#eeeeee;"><span class="required">*</span> <?php echo $entry_confirm; ?></td>
            <td style="border-bottom: 1px solid #eeeeee;"><input style="width:160px;height:100%;border:none;"type="password" name="confirm" value="<?php echo $confirm; ?>" />
              <?php if ($error_confirm) { ?>
              <span class="error"><?php echo $error_confirm; ?></span>
              <?php  } ?></td>
          </tr>
          <tr style="font-weight: bold;">
            <td style="padding:10px 0px 10px 10px;background:#eeeeee;"></td>
            <td style="background:#eeeeee;"></td>
          	<td style="padding-left:10px;background:#eeeeee;"></td>
            <td style="background:#eeeeee;"></td>
          </tr>    
        </table>
      </form>  
</center>
      <div style="text-align: right;margin: 15px;" class="buttons"><a onclick="$('#form2').submit();" class="button"><?php echo $button_save; ?></a><a class="button" id="superadminform"><?php echo $button_cancel; ?></a></div>
<p></p>
</div>
<?php } ?> 
<!---------------------------------->   
  </div>
  <?php } ?>
</div>
