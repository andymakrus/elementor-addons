<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 17/07/2018
 * Time: 17:13
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_TZ_Woo_Product_Tabs extends Widget_Base {

	public function get_name() {
		return 'tz-woo-product-tabs';
	}

	public function get_title() {
		return esc_html__( 'Product Tabs', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-copy';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'owl-carousel',
			'owl-carousel-controller',
			'jquery-tabslet',
			'tz-tabslet-controller'
		];
	}

	private function _get_products_ids(){
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
		);

		$products = get_posts($args);

		$products_ids = [];

		if ( count ( $products ) ) {
			foreach ( $products as $product ) {
				$products_ids[ $product->ID ] = get_the_title($product->ID);
			}
		}

		return $products_ids;

	}

	private function _get_product_categories(){

		$pr_categories_array = [];
		$cat_args = array(
			'orderby'    => 'id',
			'order'      => 'asc',
			'hide_empty' => false,
		);
		$product_categories = get_terms( 'product_cat', $cat_args );

		foreach ( $product_categories as $category ) {
			$pr_categories_array[ $category->slug ] = $category->name;
		}

		return $pr_categories_array;

	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'product_tabs',
			[
				'label' => esc_html__( 'Products Tabs', 'dici-feature-pack' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => esc_html__('Products', 'dici-feature-pack'),
						'limit' => '-1',
						'columns' => '4',
					],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => esc_html__( 'Tab Title', 'dici-feature-pack' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => esc_html__( 'Products', 'dici-feature-pack' ),
					],
					[
						'name' => 'limit',
						'label' => esc_html__( 'Maximum Products', 'dici-feature-pack' ),
						'type' => Controls_Manager::NUMBER,
						'min' => -1,
						'max' => 100,
						'step' => 1,
						'default' => -1,
					],
					[
						'name' => 'columns',
						'label' => esc_html__( 'Products per Row', 'dici-feature-pack' ),
						'type' => Controls_Manager::NUMBER,
						'min' => 2,
						'max' => 6,
						'step' => 1,
						'default' => 4,
					],
					[
						'name' => 'paginate',
						'label' => esc_html__( 'Paginate?', 'dici-feature-pack' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
						'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
						'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
						'return_value' => true,
					],
					[
						'name' => 'orderby',
						'label' => esc_html__( 'Order By', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' => [
							'date' => esc_html__( 'Date', 'dici-feature-pack' ),
							'id' => esc_html__( 'ID', 'dici-feature-pack' ),
							'menu_order' => __( 'Menu Order', 'dici-feature-pack' ),
							'popularity' => esc_html__( 'Popularity', 'dici-feature-pack' ),
							'rand' => esc_html__( 'Random', 'dici-feature-pack' ),
							'rating' => esc_html__( 'Rating', 'dici-feature-pack' ),
							'title' => esc_html__( 'Title', 'dici-feature-pack' ),
						],
						'default' => 'date',
					],
					[
						'name' => 'order',
						'label' => esc_html__( 'Order', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' => [
							'ASC' => esc_html__( 'Ascending', 'dici-feature-pack' ),
							'DESC' => esc_html__( 'Descending', 'dici-feature-pack' ),
						],
						'default' => 'ASC',
					],
					[
						'name' => 'ids',
						'label' => esc_html__( 'Product IDs', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' =>$this->_get_products_ids(),
						'multiple' => true,
						'label_block' => true
					],

					[
						'name' => 'categories',
						'label' => esc_html__( 'Product Categories', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' =>$this->_get_product_categories(),
						'multiple' => true,
						'label_block' => true
					],
					[
						'name' => 'visibility',
						'label' => esc_html__( 'Product Visibility', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' => [
							'visible' => esc_html__( 'Visible', 'dici-feature-pack' ),
							'catalog' => esc_html__( 'Catalog', 'dici-feature-pack' ),
							'search' => esc_html__( 'Search', 'dici-feature-pack' ),
							'hidden' => esc_html__( 'Hidden', 'dici-feature-pack' ),
							'featured' => esc_html__( 'Featured', 'dici-feature-pack' ),
						],
					],
					[
						'name' => 'set',
						'label' => esc_html__( 'OR Select a Set', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' => [
							'on_sale' => esc_html__( 'On Sale Products', 'dici-feature-pack' ),
							'best_selling' => esc_html__( 'Best Selling Products', 'dici-feature-pack' ),
							'top_rated' => esc_html__( 'Top Rated Products', 'dici-feature-pack' ),
						],
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_settings',
			[
				'label' => esc_html__( 'Layout Settings', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'tabs_on',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Tabs Enabled?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'tabs_animation',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Animate Tabs?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'tabs_loop',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'label' => esc_html__( 'Rotate Tabs?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Display Mode', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'grid' => esc_html__( 'Grid', 'dici-feature-pack' ),
					'carousel' => esc_html__( 'Carousel', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Prev/Next Arrows?', 'dici-feature-pack'),
			]
		);


		$this->add_control(
			'dots',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'label' => esc_html__( 'Show dot indicators for navigation?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Pause on Hover?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'label' => esc_html__( 'Autoplay?', 'dici-feature-pack'),
				'description' => esc_html__( 'Should the carousel auto play as in a slideshow.', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => esc_html__( 'Autoplay duration in ms', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 3000,
			]
		);


		$this->add_control(
			'animation_speed',
			[
				'label' => esc_html__( 'Animation duration in ms', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
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
			'start_position',
			[
				'label' => __('Start Position', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 1,
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

		$this->start_controls_section(
			'section_styling',
			[
				'label' => esc_html__( 'Testimonial Content', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_align',
			[
				'label' => __('Tab Alignment', 'dici-feature-pack'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'dici-feature-pack'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'dici-feature-pack'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'dici-feature-pack'),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'dici-feature-pack'),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_responsive_control(
			'tabs_padding',
			[
				'label' => __('Tabs Titles Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tz-product-tabs .tz-tab-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-product-tabs .tz-tab-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_border_color',
			[
				'label' => __( 'Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-product-tabs .tz-tab-title a, {{WRAPPER}} .tz-product-tabs .tz-tab-title a:after' => 'border-color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'text_border_width',
			[
				'label' => __( 'Border Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-product-tabs .tz-tab-title a, {{WRAPPER}} .tz-product-tabs .tz-tab-title a:after' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .tz-product-tabs .tz-tab-title a',
			]
		);

		$this->add_responsive_control(
			'item_text_bottom_space',
			[
				'label' => __( 'Spacing', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-product-tabs .tz-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$carousel_settings = array();

		$carousel_settings['selector']       = ".products";
		$carousel_settings['type']           = "content-carousel";
		$carousel_settings['slides']         = isset( $settings['cols'] ) ? $settings['cols'] : '1';
		$carousel_settings['scroll']         = isset( $settings['scroll'] ) ? $settings['scroll'] : '1';
		$carousel_settings['custom_nav']     = isset( $settings['show_arrows'] ) ? $settings['show_arrows'] : 'no' ;
		$carousel_settings['dots']           = isset( $settings['show_dots'] ) ?  $settings['show_dots'] : 'yes';
		$carousel_settings['autoplay']       = isset( $settings['autoplay'] ) ?  $settings['autoplay'] : 'yes';
		$carousel_settings['gap']            = isset( $settings['gap'] ) ? $settings['gap'] : '0';
		$carousel_settings['speed']          = isset( $settings['speed'] ) ? $settings['speed'] : '500' ;
		$carousel_settings['autoplay_speed'] = isset( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : '3000' ;
		$carousel_settings['loop']           = isset( $settings['loop'] ) ? $settings['loop'] : 'yes';
		$carousel_settings['center']         = isset( $settings['center'] ) ? $settings['center'] : 'no';
		$carousel_settings['lazyload']       = isset( $settings['lazyload'] ) ? $settings['lazyload'] : 'no';
		$carousel_settings['pause_on_hover'] = isset( $settings['pause_on_hover'] ) ? $settings['pause_on_hover'] : 'no';
		$carousel_settings['startPosition']  = isset( $settings['start_position'] ) ? $settings['start_position'] : 1;

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

		$carousel_settings = apply_filters( '/elementor/tz_product_tabs_carousel_settigns', $carousel_settings );

		$args[ 'carousel_settings' ] = wp_json_encode($carousel_settings);

		$args['layout'] = $settings['layout'];

		$args[ 'cols' ] = $settings['display_columns'];

		$args['tab_align'] = $settings['tab_align'];

		$args['tabs_on'] = $settings['tabs_on'];

		$args['tabs_animation'] = $settings['tabs_animation'];

		$args['tabs_loop'] = $settings['tabs_loop'];

		$args['product_tabs'] = $settings['product_tabs'];

		TZ_Helper::get_template('widget-product-tabs.php', $args);

	}

}