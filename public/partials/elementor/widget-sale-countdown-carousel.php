<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 11/07/2018
 * Time: 18:34
 */

if ( count ( $products ) ) : ?>
<div class="tz-woo-sale-countdown-carousel tz-view-<?php echo esc_attr( $layout )?>"  <?php echo isset ( $carousel_settings ) ? ' data-owl="'.esc_html__( $carousel_settings ).'" ' : ''; ?> >
	<?php foreach ( $products as $product ) : ?>
		<?php if ( $product['product_id'] && ( $sale_product = wc_get_product( (int) $product['product_id'] ) ) ) : ?>
		<div class="sale-item">
			<div class="sale-image">
			<?php if ( isset ( $product['image']['id'] ) ) :
				$image_attributes = wp_get_attachment_image_src($product['image']['id'], 'full');
				$img_alt = get_post_meta($product['image']['id'], '_wp_attachment_image_alt', true);
				?>
				<img alt="<?php echo esc_attr($img_alt) ?>" src="<?php echo esc_url( $image_attributes[0] ) ?>" width="<?php echo esc_attr($image_attributes[1]) ?>" height="<?php echo esc_attr($image_attributes[2]) ?>" />
			<?php endif; ?>
			</div>
			<div class="sale-content content-align-<?php echo esc_attr( $content_align ); ?> content-vertical-align-<?php echo esc_attr( $sale_content_vertical_align ) ?>">
                <div class="sale-content-wrapper">
                    <?php if ( isset ( $product['heading_text'] ) ) : ?><div class="sale-tag"><?php esc_html_e($product['heading_text']) ?></div><?php endif ?>
                    <?php if ( $the_title = $sale_product->get_title() ) : ?><<?php echo esc_html($item_title_tag) ?> class="sale-title"><?php echo esc_html($the_title) ?></<?php echo esc_html($item_title_tag) ?>><?php endif; ?>
                    <?php if ( isset ( $product['pre_countdown_text'] ) ) : ?><div class="sale-text"><?php echo wp_kses_post( $product['pre_countdown_text'] ) ?></div><?php endif; ?>
                    <?php
                        $sales_date_end = get_post_meta( $product['product_id'], '_sale_price_dates_to', true );
                        if ( isset ( $sales_date_end ) && ( '' != $sales_date_end ) ) :
                            $sales_date_end = date_i18n( 'Y/m/d', (int) $sales_date_end);
                        ?>
                            <div class="countdown-wrapper" data-countdown="container" data-countdown-target="<?php esc_attr_e( $sales_date_end ) ?>"></div>
                    <?php endif; ?>
                    <?php if ( isset ( $product['show_price'] ) && ( 'yes' == $product['show_price'] ) ) : ?>
                        <?php echo $sale_product->get_price_html() ?>
                    <?php endif; ?>
                    <?php if ( isset ( $product['button_text'] ) ) : ?>
                        <a class="sale-button" href="<?php echo esc_url( $sale_product->get_permalink() ) ?>">
                            <?php esc_html_e( $product['button_text'] ) ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php endif;