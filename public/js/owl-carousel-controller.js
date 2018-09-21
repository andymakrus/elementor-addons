(function( $ ) {
    'use strict';

    const OwlCarouselController = function () {
        var owlContainer = $('[data-owl]');
        if ( owlContainer.length ) {
            $(owlContainer).each(function(){
                var settings = $(this).data('owl');
                var selector = $(this).parent().find(settings.selector);
                var options = {};
                options.autoplay = ( settings.autoplay === 'yes' );
                options.dots = ( settings.dots === 'yes' );
                options.items = ( settings.slides ) ? parseInt( settings.slides ) : 4;
                options.nav = ( settings.custom_nav === 'yes' );

                options.margin = ( settings.gap ) ? parseInt( settings.gap ) : 30;
                options.smartSpeed = ( settings.speed && parseInt( settings.speed ) ) ? parseInt( settings.speed )  : 500;
                options.autoplaySpeed = ( settings.autoplay_speed && parseInt( settings.autoplay_speed ) ) ? parseInt( settings.autoplay_speed ) : 3000;
                options.loop = ( settings.loop  === 'yes' );
                options.center = ( settings.center === 'yes' );
                options.startPosition = settings.startPosition ? settings.startPosition : 1;
                options.lazyLoad = ( settings.lazyload === 'yes' );
                options.animateOut = 'fadeOut';
                options.animateIn = 'fadeIn';
                options.responsive = {
                    0 : {
                        items : ( settings.slides_mobile && parseInt( settings.slides_mobile ) ) ? parseInt( settings.slides_mobile )  : 1,
                        margin : ( settings.gap_mobile ) ? parseInt( settings.gap_mobile ) : 10
                    },
                    // breakpoint from 480 up
                    480 : {
                        items : ( settings.slides_mobile && parseInt( settings.slides_mobile ) ) ? parseInt( settings.slides_mobile )  : 1,
                        margin : ( settings.gap_mobile ) ? parseInt( settings.gap_mobile ) : 10
                    },
                    // breakpoint from 768 up
                    768 : {
                        items : ( settings.slides_tablet && parseInt( settings.slides_tablet ) ) ? parseInt( settings.slides_tablet )  : 2,
                        margin : ( settings.gap_tablet ) ? parseInt( settings.gap_tablet ) : 20
                    },

                    // breakpoint from 1024 up
                    1024 : {
                        items : ( settings.slides_desktop && parseInt( settings.slides_desktop ) ) ? parseInt( settings.slides_desktop )  : 4,
                        margin : ( settings.gap_desktop ) ? parseInt( settings.gap_desktop ) : 30
                    }
                };
                $(selector).addClass('owl-carousel');
                $(selector).owlCarousel(options);

            });
        }

    };

    $(function() {
        $(window).OwlCarouselController = new OwlCarouselController();
    });

})( jQuery );
