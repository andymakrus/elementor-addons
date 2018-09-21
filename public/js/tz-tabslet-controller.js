(function( $ ) {
    'use strict';

    const TzTabsletController = function(){

        var tabsletContainer = $('[data-tabslet]');
        if ( tabsletContainer.length ) {
            tabsletContainer.each(function(){
                var _this = this;
                $(_this).find('ul > li > a').on('click', function(e){
                    if ( $(this).attr('href').indexOf('#') != 0 ) {
                        e.stopPropagation();
                    }
                });
                $(_this).tabslet({
                    active: $(_this).data('active'),
                    container: $(_this).data('container') ? $(_this).data('container') : '',
                   // animation: $(_this).data('animate') ? $(_this).data('animation') : 'false' ,
                    mouseevent: $(_this).data('mouseevent') ? $(_this).data('animation') : 'click'
                });

                $(_this).on("_before", function ( event ) {
                   if ( $(event.target).find('a').attr('href').indexOf('#') != -1 ) {
                       $(_this).find($(_this).data('container')).find( '>div' ).removeClass('active');
                       $( $(event.target).find('a').attr('href') ).addClass('active');
                       $(_this).find($(_this).data('container')).css('display','block');
                   }
                });

                if ( $(this).data('active') == false ){
                    $('body').on( 'click' , function(event){
                        if ( event.target != $(_this) && ( ! $.contains( _this, event.target ) ) ){
                            $(_this).find($(_this).data('container')).css('display','none');
                        }
                    });
                }

            });
        }

    };

    const TzAdvancedTabsTogglerController = function () {
        var tzAdvancedTabsContainer = $('[data-tz-advanced-tabs]');
        if ( tzAdvancedTabsContainer.length ) {
            tzAdvancedTabsContainer.each(function(){
                var _this = this;
                var settings = $(_this).data('tz-advanced-tabs');
                if ( settings.show_toggler == 'yes' ) {
                    var toggler = $(_this).find('.tz-toggler');
                    $('body').on( 'click' , function(event){
                        if ( event.target == $( toggler )[0] ) {
                            event.stopPropagation();
                            if ( !( settings.homepage_open == 'yes' && $('body').hasClass('home') ) ) $(_this).toggleClass('opened');
                            if (window.matchMedia("(max-width: 768px)").matches) {
                                $(_this).find('.tz-mobile-tabs-hidden').trigger('focus');
                            }
                        } else if (
                                ( event.target !=  $(_this)[0] )
                                && ( event.target !=  $( toggler )[0] )
                                ){
                            if ( ! (
                                    settings.homepage_open == 'yes'
                                    && $('body').hasClass('home')
                                    )
                                )
                                $(_this).removeClass('opened');
                        }
                    });
                    var mobileToggler = $(_this).find('.tz-mobile-tabs-hidden');
                    $(mobileToggler).on( 'change', function(e) {
                        var targetTab = $(this).val();
                        $(_this).find('.tz-tab-togglers').find('a[href=' + targetTab + ']').trigger('click');
                    });

                }
            });
        }

    };

    $(function() {
        $(window).tzTabsletController = new TzTabsletController();
        $(window).tzAdvancedTabsTogglerController = new TzAdvancedTabsTogglerController();
    });

})( jQuery );