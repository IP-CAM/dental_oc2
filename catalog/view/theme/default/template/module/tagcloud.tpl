<?php
//-----------------------------------------------------
// TagCloud for your Onlinestore   
// Created by villagedefrance                          
// contact@villagedefrance.net                                    
//-----------------------------------------------------
?>

<?php if($box) { ?>
	<div class="box">
		<div class="box-heading">
			<?php if($icon) { ?>	
				<div style="float: left; margin-right: 8px;"><img src="catalog/view/theme/default/image/cloud.png" alt="" /></div>
			<?php } ?>
			<?php if($title) { ?>	
				<?php echo $title; ?>
			<?php } ?>
		</div>
		
		<div class="box-content" style="text-align:center;"> 
			<?php if($tagcloud) { ?>
				<?php echo $tagcloud; ?>
			<?php } else { ?>
				<?php echo $text_notags; ?>
			<?php } ?>
		</div>
	</div>
	
<?php } else { ?>
	
	<div style="text-align:center; margin-bottom:10px;">
		<?php if($tagcloud) { ?>
			<?php echo $tagcloud; ?>
		<?php } else { ?>
			<?php echo $text_notags; ?>
		<?php } ?>
	</div>
	
<?php } ?>