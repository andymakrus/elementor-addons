jQuery( window ).on( 'elementor:init', function() {
    var ControlIconTZView = elementor.modules.controls.Icon.extend({});
    elementor.addControlView( 'icontz', ControlIconTZView );
} );