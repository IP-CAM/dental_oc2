<div class="boss_popular_box">
	<div class="box-heading"><?php echo $title; ?></div>
	<div class="box-content es-carousel-wrapper">
		<div class="hc-box-product es-carousel">
			<ul class="skin-opencart">			
			<?php foreach ($products as $product) { ?>
				<li>
					<div class="product">
						<?php if ($product['thumb']) { ?>
						<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>"  title="<?php echo $product['name']; ?>"  /></a></div>
						<?php } ?>
						<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
						<div class="model"><?php echo $product['model']; ?></div>
						<div class="price">
						  <?php if (!$product['special']) { ?>
						  <?php echo $product['price']; ?>
						  <?php } else { ?>
						  <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
						  <?php } ?>
						</div>
					</div>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript"><!--
	//window.onload = boos_popular_resize;
	addLoadEvent(boos_popular_resize);
	window.onresize = function(event) {
		boos_popular_resize();
	}
	
	function boos_popular_resize()	{
		if(getWidthBrowser() > 767){	
			$('.boss_popular_box .box-content').elastislide({
				imageW 		: 192,
				border		: 0,
				current		: 0,
				margin		: 0,
				onClick 	: true,
				minItems	: 2,
				disable_touch		: false
			});
		}
	}
//--></script>


