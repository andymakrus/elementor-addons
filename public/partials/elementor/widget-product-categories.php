<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 24/05/2018
 * Time: 14:21
 */
?>

<?php if ( count( $categories ) ) : ?>

    <ul class="tz-woo-product-categories tz-grid tz-cols-<?php esc_attr_e( $cols )?>" <?php echo isset( $carousel_settings ) ? ' data-owl="'.esc_html__( $carousel_settings ).'" ' : ''; ?> >
    <?php foreach ( $categories as $category ) : ?>
	    <?php
        $cat_term = get_term( $category, 'product_cat' );
        if ( $cat_term ) :
	    ?>
        <li class="product-cat-<?php esc_attr_e( $category ); ?>">
        <?php
        $thumbnail_id = get_term_meta( $category, 'thumbnail_id', true );
        $image = wp_get_attachment_image( $thumbnail_id, 'tz-woo-categories' );
        $parent_cat_url = get_term_link( $cat_term->slug, $cat_term->taxonomy );
        ?>
            <a href="<?php echo esc_url( $parent_cat_url ); ?>">
            <?php if ( $image ) : ?>
                <span class="cat-thumbnail"><?php echo wp_kses_post($image) ?></span>
            <?php endif; ?>
                <div class="cat-caption">
                    <span class="cat-name"><?php esc_html_e( $cat_term->name ) ?></span>
                    <?php if ( isset( $show_product_count ) && ( 'yes' == $show_product_count ) ) : ?>
                    <span class="cat-count">
                        <?php
                        printf( // WPCS: XSS OK.
                            esc_html( _nx( '%1$s item', '%1$s items', $cat_term->count, 'number of products in category', 'dici-feature-pack' ) ),
                            number_format_i18n( $cat_term->count )
                        );
                        ?>
                    </span>
                    <?php endif; ?>
                    <span class="cat-button"><?php esc_html_e($view_more_button_text); ?></span>
                </div>
            </a>
        </li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>

<?php else : ?>
    <p><?php esc_html_e( 'Sorry but there are no product categories to show', 'dici-feature-pack' ); ?></p>
<?php endif; ?>
