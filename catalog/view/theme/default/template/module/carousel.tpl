<div id="carousel<?php echo $module; ?>">
  <ul class="jcarousel-skin-opencart">
    <?php foreach ($banners as $banner) { ?>
    <li><a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></a></li>
    <?php } ?>
  </ul>
</div>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?> ul').jcarousel({
	vertical: false,
	visible: <?php echo $limit; ?>,
	scroll: <?php echo $scroll; ?>,
        //auto: true,
        //autostart: true
});
$( window ).load(function() {
   //setTimeout(carousal_move, 2000);
   carousal_move();
});

function carousal_move(){
    console.log('----move-------');
    lef = $('div.jcarousel-prev').not('.jcarousel-prev-disabled')
    rig = $('div.jcarousel-next').not('.jcarousel-next-disabled')

    if (rig.length>0){
        rig.trigger("click");
    }
    else if(lef.length>0){
         lef.trigger("click");
    }
    setTimeout(function() {
         carousal_move();
    }, 3000);
   
}

//--></script>