<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/boss_add_cart.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/skeleton.css" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/responsive.css" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/getwidthbrowser.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/bossthemes.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bossthemes/notify.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>

<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/ie8.css" />
<![endif]-->

<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/ie9.css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/ie7.css" />
<![endif]-->

<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/bt_medicalhealth/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body>
<div class="frame_container">
<div id="container" class="container">
<div id="header" class="sixteen columns alpha omega">
	<div class="boss_header_top">
		<?php if ($logo) { ?>
		<div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
		<?php } ?>
		<div id="mobile_search"></div>
		<?php echo $cart; ?>
		<?php echo $header_top; ?>
	</div>
	<div class="boss_header_buttom">
		<div id="welcome">
		<?php if (!$logged) { ?>
		<?php echo $text_welcome; ?>
		<?php } else { ?>
		<?php echo $text_logged; ?>
		<?php } ?>
		</div>
		<div class="quick-access">                
			<div id="search">
				<ul>
					<li>
						<a class="icon_seach" href="index.php?route=product/search"><?php echo $text_search; ?></a>
						<div class="frame_big search_big">
						<div id="search-form">
							<div id="search-form-bot">
								<span class="title-search"><?php echo $text_search; ?></span>
								<input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />                                  
								<div class="button-search"><span><?php echo $text_search; ?></span></div>
							</div><!-- end #search-form-bot  -->
						</div><!-- end #serach-form -->
						</div><!-- end .frame_big search_big -->
					</li>
				</ul>
			</div><!-- end search -->	
			<?php echo $boss_login; ?>   		
		</div>
	</div>
</div>
<?php echo $boss_megamenu; ?>
<?php echo $header_bottom; ?>
<?php if ($error) { ?>
    
    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
    
<?php } ?>
<div id="notification" class="sixteen columns alpha omega"></div>
<div class="sixteen columns alpha omega">

<script type="text/javascript"><!--
		//window.onload = boss_header_move_search;
		//addLoadEvent(boss_header_move_search);
		$(document).ready(function() {
			boss_header_move_search();
		});
		$(window).resize(function() {
			boss_header_move_search();
		});
		
		function boss_header_move_search()	{
			if(getWidthBrowser() < 767){
				if ($("#search-form-bot").html()) {
					$("#mobile_search").html($("#search-form-bot").html());
					$("#search-form-bot").html("");
					$(".title-search").css("display", "none");
					$(".quick-access").css("display", "none");
					$('.button-search').bind('click', function() {
						url = $('base').attr('href') + 'index.php?route=product/search';
								 
						var search = $('input[name=\'search\']').attr('value');
						
						if (search) {
							url += '&search=' + encodeURIComponent(search);
						}
						
						location = url;
					});
					$('#header input[name=\'search\']').bind('keydown', function(e) {
						if (e.keyCode == 13) {
							url = $('base').attr('href') + 'index.php?route=product/search';
							 
							var search = $('input[name=\'search\']').attr('value');
							
							if (search) {
								url += '&search=' + encodeURIComponent(search);
							}
							
							location = url;
						}
					});
				}
			} else {
				if ($("#mobile_search").html()) {
					$("#search-form-bot").html($("#mobile_search").html());
					$("#mobile_search").html("");
					$(".title-search").css("display", "block");
					$(".quick-access").css("display", "block");
				}
			}
		}
//--></script>