<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 18/05/2018
 * Time: 19:07
 */

final class TZ_Elementor_Extension {

	const VERSION = DICI_FEATURE_PACK_VERSION;
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		add_action( 'init', [$this, 'init'] );

		// Register custom widget category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_widget_category' ], 1 );

	}

	public function init() {


		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Include plugin files
		$this->includes();

		// Register controls
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		$this->add_image_sizes();

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'dici-feature-pack' ),
			'<strong>' . esc_html__( 'Themes Zone Elementor Extension', 'dici-feature-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'dici-feature-pack' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'dici-feature-pack' ),
			'<strong>' . esc_html__( 'Themes Zone Elementor Extension', 'dici-feature-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'dici-feature-pack' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'dici-feature-pack' ),
			'<strong>' . esc_html__( 'Themes Zone Elementor Extension', 'dici-feature-pack' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'dici-feature-pack' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function widget_styles() {

		wp_register_style( 'tz-icons', DICI_FEATURE_PACK_URI . 'public/css/tz-icons.css', [], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_style( 'tz-icons' );

		wp_register_style( 'tz-jewelry-icons', DICI_FEATURE_PACK_URI . 'public/css/tz-jewelry-icons.css', [], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_style( 'tz-jewelry-icons' );

		wp_register_style( 'owl-carousel', DICI_FEATURE_PACK_URI . 'public/css/owl.carousel.min.css', [], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_style( 'owl-carousel' );

	}

	public function widget_scripts(){
		wp_register_script( 'owl-carousel', DICI_FEATURE_PACK_URI . 'public/js/owl.carousel.min.js', ['jquery', 'imagesloaded'],true );
		wp_register_script( 'owl-carousel-controller', DICI_FEATURE_PACK_URI . 'public/js/owl-carousel-controller.js', ['owl-carousel'],true );
		wp_register_script( 'jquery-countdown', DICI_FEATURE_PACK_URI . 'public/js/jquery.countdown.min.js', ['jquery'],true );
		wp_register_script( 'tz-countdown-controller', DICI_FEATURE_PACK_URI . 'public/js/tz-countdown-controller.js', ['jquery-countdown'],true );
		wp_register_script( 'jquery-tabslet', DICI_FEATURE_PACK_URI . 'public/js/jquery.tabslet.min.js', ['jquery'],true );
		wp_register_script( 'tz-tabslet-controller', DICI_FEATURE_PACK_URI . 'public/js/tz-tabslet-controller.js', ['jquery-tabslet'],true );
	}

	public function includes() {

		require_once( __DIR__ . '/controls/class-tz-icons-control.php' );

		require_once( __DIR__ . '/widgets/class-tz-icon.php' );

		require_once( __DIR__ . '/widgets/class-tz-icon-box.php' );

		require_once( __DIR__ . '/widgets/class-tz-banner.php' );

		require_once( __DIR__ . '/widgets/class-tz-breadcrumbs.php' );

		require_once( __DIR__ . '/widgets/class-tz-posts-carousel.php' );

		require_once( __DIR__ . '/widgets/class-tz-testimonials-carousel.php' );

		require_once( __DIR__ . '/widgets/class-tz-site-logo.php' );

		require_once( __DIR__ . '/widgets/class-tz-navigation.php' );

		require_once( __DIR__ . '/widgets/class-tz-advanced-tabs.php' );

		if ( class_exists('WooCommerce') ) {

			require_once( __DIR__ . '/widgets/class-tz-menu-categories.php' );

			require_once( __DIR__ . '/widgets/class-tz-woo-categories.php' );

			require_once( __DIR__ . '/widgets/class-tz-woo-sale-countdown-slider.php' );

			require_once( __DIR__ . '/widgets/class-tz-woo-product-tabs.php' );

		}

	}

	public function register_widgets() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Icon() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Icon_Box() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Banner() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Breadcrumbs() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Posts_Carousel() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Testimonials_Carousel() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Site_Logo() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Navigation() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Advanced_Tabs() );

		if ( class_exists('WooCommerce') ) {

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Woo_Categories() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Woo_Sale_Countdown_Slider() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Woo_Product_Tabs() );

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widget_TZ_Woo_Menu_Categories() );

		}

	}

	public function register_controls() {

		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control( 'icontz', new TZ_Icons_Control() );

	}

	public function add_widget_category( $elements_manager ) {

		$elements_manager->add_category(
			'themes-zone-elements',
			[
				'title' => esc_html__( 'Themes Zone Widgets', 'dici-feature-pack' ),
				'icon' => 'tz-logo',
			]
		);

	}

	function add_image_sizes(){

		add_image_size( 'tz-woo-categories', 544, 544 );

	}

}