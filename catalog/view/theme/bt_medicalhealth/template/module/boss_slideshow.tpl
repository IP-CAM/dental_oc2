<div class="slideshow">
	<div id="bossslideshow<?php echo $module; ?>" class="flexslider">
		<ul class="slides">
		<?php foreach ($images as $key => $image) { ?>
			<li>
				<?php if ($image['link']) { ?>
				<a href="<?php echo $image['link']; ?>"><img src="<?php echo $image['image']; ?>" title="slide<?php echo $key; ?>" alt="slide<?php echo $key; ?>" /></a>
				<?php } else { ?>
				<img src="<?php echo $image['image']; ?>" title="slide<?php echo $key; ?>" alt="slide<?php echo $key; ?>" />
				<?php } ?>
				<p class="flex-caption"><?php echo $image['description']; ?></p>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>

<script type="text/javascript">
	$(window).load(function(){
	  $('#bossslideshow<?php echo $module; ?>').flexslider({
		animation: "slide",
		slideshowSpeed: 4500,
		animationSpeed: 2000
		//start: function(slider){
		 // $('body').removeClass('loading');
		//}
	  });
	});
 </script>