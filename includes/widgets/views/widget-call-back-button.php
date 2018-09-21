<section class="<?php esc_attr_e( $class_base )?>-view">
	<div class="<?php esc_attr_e( $class_base )?>-view-title"><?php esc_html_e( $call_back_title )?></div>
    <div class="<?php esc_attr_e( $class_base )?>-view-text"><?php esc_html_e( $call_back_text )?></div>
    <?php if ( $call_back_button ) echo do_shortcode( $call_back_button ); ?>
</section>