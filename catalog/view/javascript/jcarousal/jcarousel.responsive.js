(function($) {
    $(function() {
     
        var jcarousel = $('.jcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
               
            })
            .jcarousel({
                wrap: 'circular'
            })

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-='+car_scroll
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+='+car_scroll
            });

      
           

            $('.jcarousel').jcarouselAutoscroll({
                target: '+='+car_scroll
            });
    });
})(jQuery);
