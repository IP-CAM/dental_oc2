
<?php 
function showSubmenu($category) {
	if (count($category['children']) > 0) {
		echo '<div class="sub_menu"><ul>';
		foreach ($category['children'] as $cat) {
			echo '<li><a href="'.$cat['href'].'">'.$cat['name'].'</a>';
			showSubmenu($cat);
			echo '</li>';
		}
		echo '</ul></div>';
	}
}
?>
<div id="boss_menu" class="mega-menu">
  <ul>
  <?php foreach ($menus as $menu) { ?>
	<li><a href="<?php echo $menu['href']; ?>"><?php echo $menu['title'] ?></a>
		<?php if (count($menu['options']) > 0) { ?>
		<div style="width: <?php echo $menu['dropdown_width']; ?>px; color: white;" class="dropdown">
			<?php foreach ($menu['options'] as $option) { ?>
			<div style="width: <?php echo $option['width']; ?>px; float: left" class="option">
				<!-- manufacturer -->
				<?php if ($option['type'] == 'manufacturer') { ?>
					<?php for ($i = 0; $i < count($option['manufacturers']);) { ?>
						<ul style="display: table-cell; width: <?php echo $menu['column_width']; ?>px" class="column manufacturer alpha omega">
						  <?php $j = $i + ceil(count($option['manufacturers']) / $option['column']); ?>
						  <?php for (; $i < $j; $i++) { ?>
							  <?php if (isset($option['manufacturers'][$i])) { ?>
								<li><a href="<?php echo $option['manufacturers'][$i]['href']; ?>">
									<?php if ($option['show_image']) { ?><img src="<?php echo $option['manufacturers'][$i]['image']; ?>" alt="<?php echo $option['manufacturers'][$i]['name']; ?>" title="<?php echo $option['manufacturers'][$i]['name']; ?>"/><?php } ?>
									<?php if ($option['show_name']) { ?><?php echo $option['manufacturers'][$i]['name']; ?><?php } ?>
								</a></li>
							  <?php } ?>
						  <?php } ?>
						</ul>
					<?php } ?>
				<?php } ?>
				<!-- category -->
				<?php if ($option['type'] == 'category') { ?>
					<?php if ($option['show_parent']) { ?>
						<a href="<?php echo $option['parent']['href']; ?>" class="parent">
							<?php if ($option['show_image'] && $option['parent']['image']) { ?><img src="<?php echo $option['parent']['image']; ?>" alt="<?php echo $option['parent']['name']; ?>" title="<?php echo $option['parent']['name']; ?>"/><?php } ?>
							<?php echo $option['parent']['name']; ?>
						</a>
					<?php } ?>
					<?php for ($i = 0; $i < count($option['categories']);) { ?>
						<ul style="display: table-cell; width: <?php echo $menu['column_width']; ?>px" class="column category alpha omega">
						  <?php $j = $i + ceil(count($option['categories']) / $option['column']); ?>
						  <?php for (; $i < $j; $i++) { ?>
							  <?php if (isset($option['categories'][$i])) { ?>
								<li><a href="<?php echo $option['categories'][$i]['href']; ?>">
									<?php if ($option['show_image'] && $option['categories'][$i]['image']) { ?><img src="<?php echo $option['categories'][$i]['image']; ?>" alt="<?php echo $option['categories'][$i]['name']; ?>" title="<?php echo $option['categories'][$i]['name']; ?>"/><?php } ?> 
									<p><?php echo $option['categories'][$i]['name']; ?></p>
								</a>
								<?php if ($option['show_submenu']) { showSubmenu($option['categories'][$i]); } ?>
								</li>
							  <?php } ?>
						  <?php } ?>
						</ul>
					<?php } ?>
				<?php } ?>
				<!-- information -->
				<?php if ($option['type'] == 'information') { ?>
					<?php for ($i = 0; $i < count($option['informations']);) { ?>
						<ul style="display: table-cell; width: <?php echo $menu['column_width']; ?>px" class="column information alpha omega">
						  <?php $j = $i + ceil(count($option['informations']) / $option['column']); ?>
						  <?php for (; $i < $j; $i++) { ?>
							  <?php if (isset($option['informations'][$i])) { ?>
								<li><a href="<?php echo $option['informations'][$i]['href']; ?>"><?php echo $option['informations'][$i]['title']; ?></a></li>
							  <?php } ?>
						  <?php } ?>
						</ul>
					<?php } ?>
				<?php } ?>
				<!-- static block -->
				<?php if ($option['type'] == 'static_block') { ?>
					<div class="staticblock"><?php echo $option['description']; ?></div>
				<?php } ?>
				<!-- product -->
				<?php if ($option['type'] == 'product') { ?>
					<?php for ($i = 0; $i < count($option['products']);) { ?>
						<ul style="display: table-cell; width: <?php echo $menu['column_width']; ?>px" class="column product alpha omega">
						  <?php $j = $i + ceil(count($option['products']) / $option['column']); ?>
						  <?php for (; $i < $j; $i++) { ?>
							  <?php if (isset($option['products'][$i])) { ?>
								<li class="products-prr">
									<?php if ($option['products'][$i]['thumb']) { ?><a href="<?php echo $option['products'][$i]['href']; ?>"><img src="<?php echo $option['products'][$i]['thumb']; ?>" alt="<?php echo $option['products'][$i]['name']; ?>" title="<?php echo $option['products'][$i]['name']; ?>"/></a><?php } ?>
									<span>
										<a href="<?php echo $option['products'][$i]['href']; ?>"><?php echo $option['products'][$i]['name']; ?></a>
									</span>
                                                                        <?php
                                                                            $strike_through = "";
                                                                            if($option['products'][$i]['special']){
                                                                                $strike_through = "text-decoration:line-through;";
                                                                            }
                                                                        ?>
                                                                        <span class="price_menue" style="<?php echo $strike_through; ?>">
                                                                             <?php echo $option['products'][$i]['price']; ?>	
                                                                        </span>
                                                                        <span class="menu_special">
                                                                            <?php echo !empty($option['products'][$i]['special'])?  $option['products'][$i]['special']:""; ?>
                                                                        </span>
                                                                        <?php
                                                                             if(!empty($option['products'][$i]['discount_arr'])){
                                                                                 foreach($option['products'][$i]['discount_arr'] as $discount){
                                                                                     echo "<span>";
                                                                                        //echo $discount['price'];
                                                                                     echo "</span>";
                                                                                 }
                                                                             }
                                                                        ?>
                                                                       
								</li>
							  <?php } ?>
						  <?php } ?>
						</ul>
					<?php } ?>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
		<?php } ?>
	</li>
  <?php } ?>
  </ul>
</div>