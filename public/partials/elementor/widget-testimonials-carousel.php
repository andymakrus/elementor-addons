<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13/07/2018
 * Time: 16:29
 */

if ( count ( $testimonials ) ) : ?>
<div class="tz-testimonials-carousel"  <?php echo isset ( $carousel_settings ) ? ' data-owl="'.esc_html__( $carousel_settings ).'" ' : ''; ?> >
<?php foreach ( $testimonials as $testimonial ) : ?>
    <div class="testimonial-wrapper">
        <div class="testimonial content-align-<?php echo esc_attr( $content_align ); ?>">
            <?php if ( isset ( $testimonial['client_image']['id'] ) && ( '' != $testimonial['client_image']['id'] ) ) : ?>
            <div class="testimonial-image">
                <?php
                    $image_attributes = wp_get_attachment_image_src( $testimonial['client_image']['id'], 'full');
                    $img_alt = get_post_meta( $testimonial['client_image']['id'], '_wp_attachment_image_alt', true); ?>
                <img alt="<?php echo esc_attr($img_alt) ?>" src="<?php echo esc_url( $image_attributes[0] ) ?>" width="<?php echo esc_attr($image_attributes[1]) ?>" height="<?php echo esc_attr($image_attributes[2]) ?>" />
            </div>
            <?php endif; ?>
            <div class="testimonial-content">
                <?php if ( isset ( $testimonial['testimonial_text'] ) ) : ?>
                    <div class="testimonial-text">
                        <?php echo wp_kses_post( $testimonial['testimonial_text'] ); ?>
                    </div>
                <?php endif; ?>
                <div class="testimonial-author">
                    <?php if ( isset ( $testimonial['client_name'] ) ) : ?>
                    <<?php echo esc_html( $author_name_tag )?> class="testimonial-author-name"><?php echo esc_html( $testimonial['client_name'] ); ?></<?php echo esc_html( $author_name_tag )?>>
            <?php endif; ?>
                <?php if ( isset ( $testimonial['credentials'] ) ) : ?>
                    <span class="testimonial-credentials"><?php echo esc_html( $testimonial['credentials'] ); ?></span>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php endif;