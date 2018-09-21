<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themes.zone
 * @since      1.0.0
 *
 * @package    Dici_Feature_Pack
 * @subpackage Dici_Feature_Pack/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Dici_Feature_Pack
 * @subpackage Dici_Feature_Pack/includes
 * @author     Andy <andy@themes.zone>
 */
class Dici_Feature_Pack {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Dici_Feature_Pack_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'DICI_FEATURE_PACK_VERSION' ) ) {
			$this->version = DICI_FEATURE_PACK_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'dici-feature-pack';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Dici_Feature_Pack_Loader. Orchestrates the hooks of the plugin.
	 * - Dici_Feature_Pack_i18n. Defines internationalization functionality.
	 * - Dici_Feature_Pack_Admin. Defines all hooks for the admin area.
	 * - Dici_Feature_Pack_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Loading Helper Library Class
		 *
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tz-helper.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dici-feature-pack-loader.php';

		/**
		 * This class loads Themes Zone's Elementor extensions
		 *
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/class-tz-elementor-extension.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dici-feature-pack-i18n.php';

		/**
		 * This Header/Footer Elementor Controller class
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dici-feature-pack-elementor-hf.php';


		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dici-feature-pack-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-dici-feature-pack-public.php';

		/**
		 * Load widgets
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-login-button-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-call-back-button-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-shop-address-widget.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-header-cart-widget.php';


		$this->loader = new Dici_Feature_Pack_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Dici_Feature_Pack_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Dici_Feature_Pack_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Dici_Feature_Pack_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/* Elementor Header/Footer functionality START */

		if ( defined( 'ELEMENTOR_VERSION' ) && class_exists( 'Elementor\Plugin' ) ) {

			TZ_Elementor_Extension::instance();

			$this->loader->add_action('init', $plugin_admin, 'register_elementor_hf_posttype');
			$this->loader->add_action('admin_menu', $plugin_admin, 'register_admin_menu_hf');
			$this->loader->add_action('add_meta_boxes', $plugin_admin, 'register_hf_metabox');
			$this->loader->add_action('save_post', $plugin_admin, 'save_meta_for_dici_hf');
			$this->loader->add_action('admin_notices', $plugin_admin, 'location_notice');
			$this->loader->add_action('template_redirect', $plugin_admin, 'block_template_frontend');
			$this->loader->add_action('single_template', $plugin_admin, 'load_canvas_template');

			$this->loader->add_action('init', $plugin_admin, 'register_elementor_sections_posttype');
			$this->loader->add_action('admin_menu', $plugin_admin, 'register_admin_menu_sections');
			$this->loader->add_action('add_meta_boxes', $plugin_admin, 'register_sections_metabox');
			$this->loader->add_action('save_post', $plugin_admin, 'save_meta_for_dici_sections');


		}

		/* Elementor Header/Footer functionality END */

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Dici_Feature_Pack_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'widgets_init', $plugin_public, 'register_widgets' );


		$elementor_hf = new Dici_Feature_Pack_Elementor_HF( $this->get_plugin_name(), $this->get_version() );

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

			$this->loader->add_action( 'wp_enqueue_scripts', $elementor_hf, 'enqueue_scripts' );

			$this->loader->add_action( 'elementor/page_templates/canvas/before_content', $elementor_hf, 'add_wrapper_class_start');
			$this->loader->add_action( 'elementor/page_templates/canvas/after_content', $elementor_hf, 'add_wrapper_class_end');

			$this->loader->add_filter( 'body_class', $elementor_hf, 'body_class' );

		} else {

			$this->loader->add_action( 'admin_notices', $elementor_hf, 'elementor_not_available' );
			$this->loader->add_action( 'network_admin_notices', $elementor_hf, 'elementor_not_available' );

		}


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Dici_Feature_Pack_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
