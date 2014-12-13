<div class="boss-home-filter-product">
<?php if(!empty($tabs)){ ?>

<?php $numTab = 1; ?>
<?php foreach ($tabs as $tab) { ?>
	<div id="tab-<?php echo $numTab; ?><?php echo $module; ?>" class="home-tab">
	  <div class="box">
			<div class="box-heading">
				<span><?php echo $tab['title']; ?></span>
			</div>
		  <div class="box-content">
			<div class="boss_home_filter">
			  <?php if(!empty($tab['products'])){ ?>
			  <ul class="jcarousel-skin-opencart">
			  <?php foreach ($tab['products'] as $product) { ?>
				  <li <?php echo ($product==end($tab['products']) ? 'class="last"' : ''); ?>>
					<?php if ($product['thumb']) { ?>
					<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a></div>
					<?php } ?>
					<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
					<div class="model"><?php echo $product['model']; ?></div>
					<?php if ($product['price']) { ?>
					<div class="price">
					  <?php if (!$product['special']) { ?>
					  <?php echo $product['price']; ?>
					  <?php } else { ?>
					  <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
					  <?php } ?>
					</div>
					<?php } ?>
				  </li>
				  <?php } ?>
			  </ul> 
			  <?php } ?>
			</div>
		  </div>
	  </div>
	</div>
<?php $numTab++; ?>
<?php } ?>
<?php } ?>
</div>