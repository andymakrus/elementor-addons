(function( $ ) {
    'use strict';

    const TzCountdownController = function () {
        var countdownContainer = $('[data-countdown]');
        if ( countdownContainer.length ) {
            $(countdownContainer).each(function(){
                $(this).countdown($(this).data('countdown-target'), function(event) {
                    var $this = $(this).html(event.strftime(''
                        + '<span>%D</span> : '
                        + '<span>%H</span> : '
                        + '<span>%M</span> : '
                        + '<span>%S</span>'));
                });
            });
        }
    };

    $(function() {
        $(window).TzCountdownController = new TzCountdownController();
    });

})( jQuery );