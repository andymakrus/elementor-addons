<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themes.zone
 * @since      1.0.0
 *
 * @package    Dici_Feature_Pack
 * @subpackage Dici_Feature_Pack/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dici_Feature_Pack
 * @subpackage Dici_Feature_Pack/admin
 * @author     Andy <andy@themes.zone>
 */
class Dici_Feature_Pack_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dici_Feature_Pack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dici_Feature_Pack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dici-feature-pack-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dici_Feature_Pack_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dici_Feature_Pack_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dici-feature-pack-admin.js', array( 'jquery' ), $this->version, false );

	}

	/*
	 * Register Header/Footer Post Type
	 *
	 * @since    1.0.0
	 */
	public function register_elementor_hf_posttype(){
		$labels = array(
			'name'               => __( 'Header/Footer Template', 'dici-feature-pack' ),
			'singular_name'      => __( 'Elementor Header/Footer', 'dici-feature-pack' ),
			'menu_name'          => __( 'Header/Footer Template', 'dici-feature-pack' ),
			'name_admin_bar'     => __( 'Elementor Header/Footer ', 'dici-feature-pack' ),
			'add_new'            => __( 'Add New', 'dici-feature-pack' ),
			'add_new_item'       => __( 'Add New Header/Footer', 'dici-feature-pack' ),
			'new_item'           => __( 'New Header/Footer Template', 'dici-feature-pack' ),
			'edit_item'          => __( 'Edit Header/Footer Template', 'dici-feature-pack' ),
			'view_item'          => __( 'View Header/Footer Template', 'dici-feature-pack' ),
			'all_items'          => __( 'All Elementor Header/Footer', 'dici-feature-pack' ),
			'search_items'       => __( 'Search Header/Footer Templates', 'dici-feature-pack' ),
			'parent_item_colon'  => __( 'Parent Header/Footer Templates:', 'dici-feature-pack' ),
			'not_found'          => __( 'No Header/Footer Templates found.', 'dici-feature-pack' ),
			'not_found_in_trash' => __( 'No Header/Footer Templates found in Trash.', 'dici-feature-pack' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-kitchensink',
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'elementor-dici-hf', $args );
	}

	public function register_elementor_sections_posttype(){
		$labels = array(
			'name'               => __( 'Elementor Sections', 'dici-feature-pack' ),
			'singular_name'      => __( 'Elementor Section', 'dici-feature-pack' ),
			'menu_name'          => __( 'Elementor Section Template', 'dici-feature-pack' ),
			'name_admin_bar'     => __( 'Elementor Sections', 'dici-feature-pack' ),
			'add_new'            => __( 'Add New', 'dici-feature-pack' ),
			'add_new_item'       => __( 'Add New Elementor Section', 'dici-feature-pack' ),
			'new_item'           => __( 'New Elementor Section Template', 'dici-feature-pack' ),
			'edit_item'          => __( 'Edit Elementor Section Template', 'dici-feature-pack' ),
			'view_item'          => __( 'View Elementor Section Template', 'dici-feature-pack' ),
			'all_items'          => __( 'All Elementor Sections', 'dici-feature-pack' ),
			'search_items'       => __( 'Search Elementor Section Templates', 'dici-feature-pack' ),
			'parent_item_colon'  => __( 'Parent Elementor Section Templates:', 'dici-feature-pack' ),
			'not_found'          => __( 'No Elementor Sections found.', 'dici-feature-pack' ),
			'not_found_in_trash' => __( 'No Elementor Sections found in Trash.', 'dici-feature-pack' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'rewrite'             => false,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-kitchensink',
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'elementor-sections', $args );
	}

	/*
	 * Register Admin Menu under "Themes" section
	 *
	 * @since 1.0.0
	 */

	public function register_admin_menu_hf() {
		add_submenu_page(
			'themes.php',
			__( 'Header Footer Builder ', 'dici-feature-pack' ),
			__( 'Header Footer Builder DiCi Theme', 'dici-feature-pack' ),
			'edit_pages',
			'edit.php?post_type=elementor-dici-hf'
		);
	}

	public function register_admin_menu_sections() {
		add_submenu_page(
			'themes.php',
			__( 'Elementor Sections', 'dici-feature-pack' ),
			__( 'Elementor Sections DiCi Theme', 'dici-feature-pack' ),
			'edit_pages',
			'edit.php?post_type=elementor-sections'
		);
    }



	/*
	 * Register Options Meta box
	 *
	 * @since 1.0.0
	 */

	function register_hf_metabox() {
		add_meta_box(
			'elementor-dici-hf-meta-box', __( 'Elementor Header/Footer options', 'dici-feature-pack' ), array(
			$this,
			'metabox_hf_render',
		), 'elementor-dici-hf', 'normal', 'high'
		);
	}

	function register_sections_metabox() {
		add_meta_box(
			'elementor-sections-meta-box', __( 'Elementor Sections Options', 'dici-feature-pack' ), array(
			$this,
			'metabox_sections_render',
		), 'elementor-sections', 'normal', 'high'
		);
	}

	/**
	 * Render Meta field.
	 *
	 * @param  POST $post Currennt post object which is being displayed.
	 */
	function metabox_hf_render( $post ) {
		$values            = get_post_custom( $post->ID );
		$template_type     = isset( $values['dici_hf_template_type'] ) ? esc_attr( $values['dici_hf_template_type'][0] ) : '';
		$display_on_canvas = isset( $values['display-on-canvas'] ) ? true : false;
		$display_on_home = isset( $values['display-on-home'] ) ? true : false;

		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'dici_hf_meta_nounce', 'dici_hf_meta_nounce' );
		?>
		<p>
			<label for="dici_hf_template_type"><?php _e( 'Select the type of template this is', 'dici-feature-pack' ); ?></label>
			<select name="dici_hf_template_type" id="dici_hf_template_type">
				<option value="" <?php selected( $template_type, '' ); ?>><?php _e( 'Select Option', 'dici-feature-pack' ); ?></option>
				<option value="type_header" <?php selected( $template_type, 'type_header' ); ?>><?php _e( 'Header', 'dici-feature-pack' ); ?></option>
				<option value="type_footer" <?php selected( $template_type, 'type_footer' ); ?>><?php _e( 'Footer', 'dici-feature-pack' ); ?></option>
			</select>
		</p>
		<p>
			<label for="display-on-canvas">
				<input type="checkbox" id="display-on-canvas" name="display-on-canvas" value="1" <?php checked( $display_on_canvas, true ); ?> />
				<?php _e( 'Display Layout on Elementor Canvas Template?', 'dici-feature-pack' ); ?>
			</label>
		</p>
		<p class="description"><?php _e( 'If enabled your header/footer templates will be displayed using Elementor Canvas.', 'dici-feature-pack' ); ?></p>
        <p>
            <label for="display-on-home">
                <input type="checkbox" id="display-on-home" name="display-on-home" value="0" <?php checked( $display_on_home, true ); ?> />
				<?php _e( 'Use only on home page', 'dici-feature-pack' ); ?>
            </label>
        </p>
        <p class="description"><?php _e( 'If checked this template will only be shown on home page.', 'dici-feature-pack' ); ?></p>
        <?php
	}

	function metabox_sections_render( $post ) {
		$values            = get_post_custom( $post->ID );
		$display_on_canvas = isset( $values['display-on-canvas'] ) ? true : false;

		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'sections_meta_nounce', 'sections_meta_nounce' );
		?>
        <p>
            <label for="display-on-canvas">
                <input type="checkbox" id="display-on-canvas" name="display-on-canvas" value="1" <?php checked( $display_on_canvas, true ); ?> />
				<?php _e( 'Display Layout on Elementor Canvas Template?', 'dici-feature-pack' ); ?>
            </label>
        </p>
        <p class="description"><?php _e( 'If enabled your section templates will be displayed using Elementor Canvas.', 'dici-feature-pack' ); ?></p>
		<?php
	}


	/**
	 * Save meta field.
	 *
	 * @param  POST $post_id Currennt post object which is being displayed.
	 *
	 * @return Void
	 */
	public function save_meta_for_dici_hf( $post_id ) {

		// Bail if we're doing an auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! isset( $_POST['dici_hf_meta_nounce'] ) || ! wp_verify_nonce( $_POST['dici_hf_meta_nounce'], 'dici_hf_meta_nounce' ) ) {
			return;
		}

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		if ( isset( $_POST['dici_hf_template_type'] ) ) {
			update_post_meta( $post_id, 'dici_hf_template_type', esc_attr( $_POST['dici_hf_template_type'] ) );
		}

		if ( isset( $_POST['display-on-canvas'] ) ) {
			update_post_meta( $post_id, 'display-on-canvas', esc_attr( $_POST['display-on-canvas'] ) );
		} else {
			delete_post_meta( $post_id, 'display-on-canvas' );
		}

		if ( isset( $_POST['display-on-home'] ) ) {
			update_post_meta( $post_id, 'display-on-home', esc_attr( $_POST['display-on-home'] ) );
		} else {
			delete_post_meta( $post_id, 'display-on-home' );
		}

	}

	public function save_meta_for_dici_sections( $post_id ) {

		// Bail if we're doing an auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! isset( $_POST['dici_sections_meta_nounce'] ) || ! wp_verify_nonce( $_POST['sections_meta_nounce'], 'sections_meta_nounce' ) ) {
			return;
		}

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		if ( isset( $_POST['display-on-canvas'] ) ) {
			update_post_meta( $post_id, 'display-on-canvas', esc_attr( $_POST['display-on-canvas'] ) );
		} else {
			delete_post_meta( $post_id, 'display-on-canvas' );
		}

	}


	/**
	 * Display notice when editing the header or footer when there is one more of similar layout is active on the site.
	 *
	 * @since 1.0.0
	 */
	public function location_notice() {

		global $pagenow;
		global $post;

		if ( 'post.php' != $pagenow || ! is_object( $post ) || 'elementor-dici-hf' != $post->post_type ) {
			return;
		}

		$template_type = get_post_meta( $post->ID, 'dici_hf_template_type', true );

		if ( '' !== $template_type ) {
			$templates = Dici_Feature_Pack_Elementor_HF::get_template_id( $template_type );

			// Check if more than one template is selected for current template type.
			if ( is_array( $templates ) && isset( $templates[1] ) && $post->ID != $templates[0] ) {

				$post_title        = '<strong>' . get_the_title( $templates[0] ) . '</strong>';
				$template_location = '<strong>' . $this->template_location( $template_type ) . '</strong>';
				/* Translators: Post title, Template Location */
				$message = sprintf( __( 'Template %1$s is already assigned to the location %2$s', 'dici-feature-pack' ), $post_title, $template_location );

				echo '<div class="error"><p>';
				echo $message;
				echo '</p></div>';
			}
		}

	}

	/**
	* Convert the Template name to be added in the notice.
	*
	* @since  1.0.0
	*
	* @param  String $template_type Template type name.
	*
	* @return String $template_type Template type name.
	*/
	public function template_location( $template_type ) {
		$template_type = ucfirst( str_replace( 'type_', '', $template_type ) );

		return $template_type;
	}


	/**
	 * Don't display the elementor header footer templates on the frontend for non edit_posts capable users.
	 *
	 * @since  1.0.0
	 */
	public function block_template_frontend() {
		if ( is_singular( 'elementor-dici-hf' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 );
			die;
		}
	}


	/**
	 * Single template function which will choose our template
	 *
	 * @since  1.0.1
	 *
	 * @param  String $single_template Single template.
	 */
	function load_canvas_template( $single_template ) {

		global $post;

		if ( ( 'elementor-dici-hf' == $post->post_type ) || ( 'elementor-sections' == $post->post_type ) ) {

			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}


}
