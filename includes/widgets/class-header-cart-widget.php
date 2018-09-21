<?php
/**
 * WordPress Header Cart Widget
 *
 *
 * @package   Dici_Widget_Header_Cart
 * @author    Andy <andy@themes.zone>
 * @license   GPL-2.0+
 * @link      https://themes.zone
 * @copyright 2018 Themes Zone
 *
 */

// Prevent direct file access
if ( ! defined ( 'ABSPATH' ) ) {
	exit;
}

class Dici_Widget_Header_Cart extends WP_Widget {

	/**
	 * @TODO - Rename "widget-name" to the name your your widget
	 *
	 * Unique identifier for your widget.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * widget file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $widget_slug = 'dici-header-cart';

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		parent::__construct(
			$this->get_widget_slug(),
			__( 'DiCi Header Cart', 'dici-feature-pack' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'DiCi Header Cart Widget shows the number of products in Shopping Cart. Should be used in either Widget Area Before Logo or Widget Area After Logo', 'dici-feature-pack' )
			)
		);

		// Refreshing the widget's cached output with each new post
		add_action( 'save_post',    array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );

	} // end constructor


	/**
	 * Return the widget slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'dici-feature-pack' ); ?>">
			<?php /* translators: number of items in the mini cart. */ ?>
			<?php
            if ( function_exists( 'WC' ) && ( is_object( WC()->cart ) ) ) :
                $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                    _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'dici-feature-pack' ),
                    WC()->cart->get_cart_contents_count()
                );
                ?>
                <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
            <?php endif; ?>
		</a>
		<?php
	}

	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function woocommerce_header_cart() {

		$class = $this->get_widget_slug().'-view';

		?>
		<section id="site-header-cart" class="site-header-cart">
			<div class="cart-toggler <?php echo esc_attr( $class ); ?>">
				<?php $this->woocommerce_cart_link(); ?>
			</div>
			<div class="site-header-cart-contents">
				<?php
				the_widget( 'WC_Widget_Cart' );
				?>
			</div>
		</section>
		<?php
	}


	/**
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		if ( ! class_exists( 'WooCommerce') ) return;

		// Check if there is a cached output
		$cache = wp_cache_get( $this->get_widget_slug(), 'widget' );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( ! isset ( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset ( $cache[ $args['widget_id'] ] ) )
			return print $cache[ $args['widget_id'] ];

		// go on with your widget logic, put everything into a string and …


		extract( $args, EXTR_SKIP );

		$before_widget = '';
		$after_widget = '';

		$widget_string = $before_widget;


		ob_start();

		$this->woocommerce_header_cart();

		// Here we go

		$widget_string .= ob_get_clean();
		$widget_string .= $after_widget;


		$cache[ $args['widget_id'] ] = $widget_string;

		wp_cache_set( $this->get_widget_slug(), $cache, 'widget' );

		print $widget_string;

	} // end widget


	public function flush_widget_cache()
	{
		wp_cache_delete( $this->get_widget_slug(), 'widget' );
	}
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param array new_instance The new instance of values to be generated via the update.
	 * @param array old_instance The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$new_instance = wp_parse_args(
			(array) $new_instance
		);

		return $instance;

	} // end update

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance
		);

		?>
		<p></p>
		<?php

	} // end form



} // end class

