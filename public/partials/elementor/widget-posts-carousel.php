<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 04/06/2018
 * Time: 17:33
 */
?>
<div id="tz-posts-carousel-<?php echo uniqid(); ?>"
			     class="tz-posts-carousel tz-grid tz-container tz-cols-<?php esc_attr_e( $cols ); ?> tz-post-content-<?php esc_attr_e( $alignment ); ?>"
	<?php echo isset( $carousel_settings ) ? ' data-owl="'.esc_html__( $carousel_settings ).'" ' : ''; ?>>


	<?php while ($loop->have_posts()) : $loop->the_post(); ?>

        <div data-id="id-<?php the_ID(); ?>" class="tz-posts-carousel-item">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <section class="<?php echo esc_attr( 'tz-post-inner' ); ?>">

                    <div class="entry-categories">
						<?php Widget_TZ_Posts_Carousel::_entry_categories(); ?>
                    </div>

                    <header class="entry-header">
						<?php

						the_title( '<'.$entry_title_tag.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.$entry_title_tag.'>' );

						if ( 'post' === get_post_type() ) :
							?>
                            <div class="entry-meta">
								<?php
								Widget_TZ_Posts_Carousel::_posted_by();
								Widget_TZ_Posts_Carousel::_posted_on();
								Widget_TZ_Posts_Carousel::_comment_link();
								?>
                            </div><!-- .entry-meta -->
						<?php endif; ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">

                        <?php if ( 'content' === $content_source ) : ?>

                            <?php
                            the_content( sprintf(
                                wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dici' ),
                                    array(
                                        'span' => array(
                                            'class' => array(''),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ) );

                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dici' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        <?php else: ?>

                            <?php

	                        the_excerpt();

                            ?>

                        <?php endif; ?>

                    </div><!-- .entry-content -->

					<?php /* ?>
                                <footer class="entry-footer">
		                            <?php self::_entry_footer(); ?>
                                </footer><!-- .entry-footer -->
                                <?php */?>

                </section>
                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		            <?php
		            the_post_thumbnail( 'large', array(
			            'alt' => the_title_attribute( array(
				            'echo' => false,
			            ) ),
		            ) );
		            ?>
                </a>
            </article><!-- #post-<?php the_ID(); ?> -->

        </div><!--.tz-posts-carousel-item -->

	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

</div> <!-- .tz-posts-carousel -->