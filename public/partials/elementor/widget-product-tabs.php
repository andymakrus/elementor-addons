<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 19/07/2018
 * Time: 13:54
 */

if ( count ( $product_tabs ) ) : ?>
<div class="tz-product-tabs"
	<?php echo ( ( isset( $tabs_on ) && ( 'yes' == $tabs_on ) ) ? ' data-toggle="tabslet" ' : '' )  ?>
    <?php echo ( ( isset( $tabs_animation ) && ( 'yes' == $tabs_animation ) ) ? ' data-animation="true" ' : '' )  ?>
	<?php echo ( ( isset( $tabs_loop ) && ( 'yes' == $tabs_loop ) ) ? ' data-autorotate="true" ' : '' )  ?>
>
	<?php if ( ( count ( $product_tabs ) > 1 ) && ( isset( $tabs_on ) && ( 'yes' == $tabs_on ) ) ) : ?>
    <ul class="tz-tab-align-<?php echo esc_attr ( $tab_align ) ?>">
    <?php foreach ( $product_tabs as $tab ) : ?>
        <?php
        $tab_link = strtolower ( preg_replace ('/\s+/', '-', $tab['tab_title'] ) );
        ?>
        <li class="tz-tab-title"><a href="#<?php echo esc_attr($tab_link) ?>"><?php echo esc_html( $tab['tab_title'] ) ?></a></li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php foreach ( $product_tabs as $tab ) : ?>
    <?php $tab_id = strtolower ( preg_replace ('/\s+/', '-', $tab['tab_title'] ) ); ?>
	<div id="<?php echo esc_attr( $tab_id ); ?>" class="tz-product-tab"
    <?php echo ( ( isset( $layout ) && ( 'carousel' == $layout ) ) ? 'data-owl="'.esc_html( $carousel_settings ).'"' : '' ) ?>
    >
		<?php
		$shortcode = '[products 
					  '.( isset( $tab['limit'] ) ? 'limit="'.$tab['limit'].'"' : '' ).'
					  '.( isset( $tab['columns'] ) ? 'columns="'.$tab['columns'].'"' : '' ).'
					  '.( ( isset( $tab['paginate'] ) && $tab['paginate'] == 'yes' ) ? 'paginate="true"' : '' ).'
					  '.( isset( $tab['orderby'] ) ? 'orderby="'.$tab['orderby'].'"' : '' ).'
					  '.( ( isset( $tab['ids'] ) && is_array( $tab['ids'] ) ) ? 'ids="'.implode(',', $tab['ids'] ).'"' : '' ).'
					  '.( ( isset( $tab['categories'] ) && is_array( $tab['categories'] ) ) ? 'category="'.implode(',', $tab['categories'] ).'"' : '' ).'
					  '.( isset( $tab['order'] ) ? 'order="'.$tab['order'].'"' : '' ).'
					  '.( isset( $tab['visibility'] ) ? 'visibility="'.$tab['visibility'].'"' : '' ).'
					  '.( isset( $tab['set'] ) ? ''.$tab['set'].'="true"' : '' ).'
					  ]';
		?>
		<?php echo do_shortcode( $shortcode ); ?>
	</div>
	<?php endforeach; ?>
</div>
<?php endif;
