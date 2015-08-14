<div class="boss-home-category-product">
<h2><span><?php echo $heading_title; ?></span></h2>
<?php if(!empty($tabs)){ ?>

<div id="boss_category_content<?php echo $module; ?>" class="boss_home_category">
	<?php $numTab = 1; ?>
	<?php foreach ($tabs as  $key => $tab) { ?>
	<div class="boss_category_box<?php echo (($key+1)%5==0 ? ' last' : ''); ?> ">
		<div id="box-heading<?php echo $key; ?>" class="boss-heading">
			<?php echo $tab['title']; ?>
		</div>
		<?php if($tab['meta_description']) { ?>
			<p><?php echo $tab['meta_description']; ?></p>
		<?php } ?>
		<div class="box" id="categorytab-<?php echo $numTab; ?><?php echo $module; ?>">
			<div class="box-content es-carousel-wrapper">
			  <div class="hc-box-product es-carousel">
				<?php if(!empty($tab['products'])){ ?>
				<ul class="skin-opencart">
					<?php $i=1; $count=count($tab['products']);?>
					<?php foreach ($tab['products'] as $product) { ?>
					  <li <?php echo($i	% $count == 0 ? 'class="last"' : ''); ?>>
						<?php if ($product['thumb']) { ?>
						<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"/></a></div>
						<?php } ?>
						<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
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
					  <?php $i++; ?>
					<?php } ?>
				</ul>
				<?php } ?>
			  </div> 
			</div><!-- end div box content -->
		</div>
		<?php $numTab++; ?>
	</div>
	<?php } ?>
</div>
<?php } ?>
</div>