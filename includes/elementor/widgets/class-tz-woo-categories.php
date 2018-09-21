<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 22/05/2018
 * Time: 20:15
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Widget_TZ_Woo_Categories extends Widget_Base {

	public function get_name() {
		return 'tz-woo-categories';
	}

	public function get_title() {
		return esc_html__( 'Product Categories', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-package-2';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'owl-carousel',
			'owl-carousel-controller',
		];
	}

	private function _get_product_categories(){
		/* Get categories with sub-cats */
		$prod_cats = array();
		$args = array(
			'taxonomy'     => 'product_cat',
			'hide_empty'   => apply_filters('/elementor/tz_categories_hide_empty', 1),
		);
		$all_product_categories = get_categories( $args );
		foreach ($all_product_categories as $cat) {
			$prod_cats[$cat->term_id] = $cat->name;
		}

		return $prod_cats;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Categories Layout', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => esc_html__( 'Grid', 'dici-feature-pack' ),
					'carousel' => esc_html__( 'Carousel', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'cols',
			[
				'label' => esc_html__( 'Number of items per row ', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'2' => esc_html__( '2 Cols', 'dici-feature-pack' ),
					'3' => esc_html__( '3 Cols', 'dici-feature-pack' ),
					'4' => esc_html__( '4 Cols', 'dici-feature-pack' ),
					'5' => esc_html__( '5 Cols', 'dici-feature-pack' ),
					'6' => esc_html__( '6 Cols', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'scroll',
			[
				'label' => esc_html__( 'Number of items to scroll ', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( '1', 'dici-feature-pack' ),
					'2' => esc_html__( '2', 'dici-feature-pack' ),
					'3' => esc_html__( '3', 'dici-feature-pack' ),
					'4' => esc_html__( '4', 'dici-feature-pack' ),
					'5' => esc_html__( '5', 'dici-feature-pack' ),
					'6' => esc_html__( '6', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label' => __( 'Product Categories', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->_get_product_categories(),
				'multiple' => true,
				'label_block' => true,
				'description' => esc_html__( 'The categories you want to show in widget.', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'prod_count',
			[
				'label' => esc_html__( 'Show products count?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'button_title',
			[
				'label'       => esc_html__( 'View Button Title', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'View More', 'dici-feature-pack' ),
				'placeholder' => esc_html__( 'View More', 'dici-feature-pack' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Carousel Options', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label' => esc_html__( 'Show Arrows?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label' => esc_html__( 'Show Dots?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'gap',
			[
				'label' => esc_html__( 'Gap between items', 'dici-feature-pack' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '30',
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Transition speed', 'dici-feature-pack' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '500',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay speed in ms', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop Items', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);


		$this->add_control(
			'center',
			[
				'label' => esc_html__( 'Center Items?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'lazyload',
			[
				'label' => esc_html__( 'Use lazyload?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_responsive',
			[
				'label' => __('Responsive Options', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'heading_desktop',
			[
				'label' => __( 'Desktop', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);



		$this->add_control(
			'gutter',
			[
				'label' => __('Gutter', 'dici-feature-pack'),
				'description' => __('Space between columns.', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
				'selectors' => [
					'{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item' => 'grid-gap: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'display_columns',
			[
				'label' => __('Columns per row', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 2,
				'max' => 6,
				'step' => 1,
				'default' => 4,
			]
		);


		$this->add_control(
			'scroll_columns',
			[
				'label' => __('Columns to scroll', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'heading_tablet',
			[
				'label' => __( 'Tablet', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'tablet_gutter',
			[
				'label' => __('Gutter', 'dici-feature-pack'),
				'description' => __('Space between columns.', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
				'selectors' => [
					'(tablet-){{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item' => 'grid-gap: {{VALUE}}px;',
				],
			]
		);


		$this->add_control(
			'tablet_display_columns',
			[
				'label' => __('Columns per row', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'tablet_scroll_columns',
			[
				'label' => __('Columns to scroll', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 5,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'heading_mobile',
			[
				'label' => __( 'Mobile', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'mobile_gutter',
			[
				'label' => __('Gutter', 'dici-feature-pack'),
				'description' => __('Space between columns.', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'selectors' => [
					'(mobile-){{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item' => 'grid-gap: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'mobile_display_columns',
			[
				'label' => __('Columns per row', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 3,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'mobile_scroll_columns',
			[
				'label' => __('Columns to scroll', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 3,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$carousel_settings = array();

		if ( 'carousel' == $settings['layout'] ) {
			$carousel_settings['selector']       = ".tz-woo-product-categories";
			$carousel_settings['type']           = "content-carousel";
			$carousel_settings['slides']         = isset( $settings['cols'] ) ? $settings['cols'] : '4';
			$carousel_settings['scroll']         = isset( $settings['scroll'] ) ? $settings['scroll'] : '1';
			$carousel_settings['custom_nav']     = isset( $settings['show_arrows'] ) ? $settings['show_arrows'] : 'yes' ;
			$carousel_settings['dots']           = isset( $settings['show_dots'] ) ?  $settings['show_dots'] : 'no';
			$carousel_settings['autoplay']       = isset( $settings['autoplay'] ) ?  $settings['autoplay'] : 'no';
			$carousel_settings['gap']            = isset( $settings['gap'] ) ? $settings['gap'] : '30';
			$carousel_settings['speed']          = isset( $settings['speed'] ) ? $settings['speed'] : '500' ;
			$carousel_settings['autoplay_speed'] = isset( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : '3000' ;
			$carousel_settings['loop']           = isset( $settings['loop'] ) ? $settings['loop'] : 'no';
			$carousel_settings['center']         = isset( $settings['center'] ) ? $settings['center'] : 'no';
			$carousel_settings['lazyload']       = isset( $settings['lazyload'] ) ? $settings['lazyload'] : 'no';
			$carousel_settings['pause_on_hover'] = isset( $settings['pause_on_hover'] ) ? $settings['pause_on_hover'] : 'no';
		}

		$responsive_settings = [
			'slides_desktop' => $settings['display_columns'],
			'scroll_desktop' => $settings['scroll_columns'],
			'gap_desktop' => $settings['gutter'],
			'slides_tablet' => $settings['tablet_display_columns'],
			'scroll_tablet' => $settings['tablet_scroll_columns'],
			'gap_tablet' => $settings['tablet_gutter'],
			'slides_mobile' => $settings['mobile_display_columns'],
			'scroll_mobile' => $settings['mobile_scroll_columns'],
			'gap_mobile' => $settings['mobile_gutter'],
		];

		$carousel_settings = array_merge($carousel_settings, $responsive_settings);

		$carousel_settings = apply_filters( '/elementor/tz_woo_categories_carousel_settigns', $carousel_settings );

		$args[ 'carousel_settings' ] = wp_json_encode($carousel_settings);

		$args[ 'cols' ] = $settings['display_columns'];

		$args[ 'categories' ] = $settings['categories'];

		$args[ 'show_product_count'] = $settings['prod_count'];

		$args[ 'view_more_button_text'] = $settings['button_title'];

		TZ_Helper::get_template('widget-product-categories.php', $args);

	}

	protected function _content_template() {}

}
