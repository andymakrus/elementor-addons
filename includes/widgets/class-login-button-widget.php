<?php
/**
 * WordPress Login Button Widget
 *
 *
 * @package   Dici_Widget_Login_Button
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

class Dici_Widget_Login_Button extends WP_Widget {

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
	protected $widget_slug = 'dici-widget-login-button';

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
			__( 'DiCi Login Button', 'dici-feature-pack' ),
			array(
				'classname'  => $this->get_widget_slug().'-class',
				'description' => __( 'DiCi Login Button Widget can be used in Top Header Sidebar, login button navigates to "my account" page or shows "Login/Register" popup if user is not logged in.', 'dici-feature-pack' )
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
	 * Outputs the content of the widget.
	 *
	 * @param array args  The array of form elements
	 * @param array instance The current instance of the widget
	 */
	public function widget( $args, $instance ) {


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

		$account_text = ! empty( $instance['account_text'] ) ? $instance['account_text'] : __('My Account', 'dici-feature-pack');
		$signin_text = ! empty( $instance['signin_text'] ) ? $instance['signin_text'] : __('Sign In', 'dici-feature-pack');

		$class_base = $this->get_widget_slug();

		$account_page_link = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'myaccount' ) ) : '#';

		$register_pop_up_class = class_exists( 'LRM_Core' ) ? 'lrm-register' : '';
		$login_pop_up_class = class_exists( 'LRM_Core' ) ? 'lrm-login' : '';

		$logged_in_class = is_user_logged_in() ? 'lrm-hide-if-logged-in' : '';

		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/widget-login-button.php' );
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
			(array) $new_instance,
			array(
				'account_text' => __('My Account', 'dici-feature-pack'),
				'signin_text' => __('Sign In', 'dici-feature-pack')
			)
		);
		$instance['account_text'] = sanitize_text_field( $new_instance['account_text'] );
		$instance['signin_text'] = sanitize_text_field( $new_instance['signin_text'] );

		return $instance;

	} // end update

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param array instance The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance,
			array(
				'account_text' => __('My Account', 'dici-feature-pack'),
				'signin_text' => __('Sign In', 'dici-feature-pack')
			)
		);

		$account_text = $instance['account_text'];
		$signin_text = $instance['signin_text'];

		// Display the admin form
		include( plugin_dir_path(__FILE__) . 'views/admin-login-button.php' );

	} // end form



} // end class

