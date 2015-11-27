<div class="jcarousel_wrapper">
    <div class="jcarousel" id="carousel<?php echo $module; ?>">
        <ul class="jcarousel-skin-opencart">
            <?php foreach ($banners as $banner) { ?>
                <li><a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></a></li>
            <?php } ?>
        </ul>
        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
        <a href="#" class="jcarousel-control-next">&rsaquo;</a>
    </div>
    
</div>

<script type="text/javascript"><!--
    var car_visible = <?php echo $limit; ?>;
    var car_scroll = <?php echo $scroll; ?>;


    $(window).load(function () {
        //setTimeout(carousal_move, 2000);
        //carousal_move();
    });

    function carousal_move() {
        console.log('----move-------');
        lef = $('div.jcarousel-prev').not('.jcarousel-prev-disabled')
        rig = $('div.jcarousel-next').not('.jcarousel-next-disabled')

        pos_ul = $("ul.jcarousel-list").position();
        li_width = 182;
        li_margin = 10;
        available_items = car_visible;
        total_items = $("ul.jcarousel-list li").length;
        current_position = (li_width * car_scroll) + (li_margin * car_scroll);




        //console.log(pos_ul.left);
        // console.log(current_position);
        // console.log("--------");
        //console.log(rig);

        if (rig.length == 0) {
            //rig.trigger("click");




        }
        else if (pos_ul.left <= -current_position) {
            // rig.trigger("click");
        }
        else {
            // lef.trigger("click");
        }
        setTimeout(function () {
            //carousal_move();
        }, 3000);

    }

    function move_prev() {
        lef = $('div.jcarousel-prev').not('.jcarousel-prev-disabled');
        if (lef.length != 0) {
            lef.trigger();
        }

        setTimeout(function () {
            move_prev();
        }, 3000);
    }

//--></script>