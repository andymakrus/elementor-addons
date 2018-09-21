<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 11/07/2018
 * Time: 12:15
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_TZ_Woo_Sale_Countdown_Slider extends Widget_Base {

	public function get_name() {
		return 'tz-woo-sale-countdown-slider';
	}

	public function get_title() {
		return esc_html__( 'Sale Countdown Carousel', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-shopping-cart-3';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'owl-carousel',
			'owl-carousel-controller',
			'jquery-countdown',
			'tz-countdown-controller'
		];
	}

	protected function _get_sale_products_on_sale(){
		$sale_ids = wc_get_product_ids_on_sale();
		$sale_products = array();
		foreach( $sale_ids as $id ) {
			$sale_products[$id] = get_the_title($id);
		}
		return $sale_products;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'layout_view',
			[
				'label' => __( 'Widget View', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'compact' => __( 'Compact', 'dici-feature-pack' ),
					'full' => __( 'Full', 'dici-feature-pack' ),
				],
				'default' => 'full',
			]
		);

		$this->add_control(
			'products',
			[
				'label' => esc_html__( 'Products on Sale', 'dici-feature-pack' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'product_id' => '',
						'image' => '',
						'pre_countdown_text' => '',
					],
				],
				'fields' => [
					[
						'name' => 'product_id',
						'label' => esc_html__( 'Products on Sale', 'dici-feature-pack' ),
						'default' => '',
						'type' => Controls_Manager::SELECT2,
						'options' => $this->_get_sale_products_on_sale(),
					],
					[
						'name' => 'image',
						'label' => esc_html__( 'Product Image', 'dici-feature-pack' ),
						'description' => esc_html__( 'Add Custom Image for sale item instead of Product Image set in product options.', 'dici-feature-pack' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
					],
					[
						'name' => 'heading_text',
						'label'   => esc_html__( 'Heading text', 'dici-feature-pack' ),
						'type'    => Controls_Manager::TEXT,
						'default' => esc_html__( 'Heading text', 'dici-feature-pack' ),
					],
					[
						'name' => 'pre_countdown_text',
						'label'   => esc_html__( 'Pre-Countdown text', 'dici-feature-pack' ),
						'type'    => Controls_Manager::TEXTAREA,
						'default' => esc_html__( 'Default text', 'dici-feature-pack' ),
					],
					[
						'name' => 'swap_row',
						'label' => esc_html__( 'Swap Picture and Description?', 'dici-feature-pack' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => '',
						'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
						'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
						'return_value' => 'yes',
					],
					[
						'name' => 'show_price',
						'label' => esc_html__( 'Show Price?', 'dici-feature-pack' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
						'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
						'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
						'return_value' => 'yes',
					],
					[
						'name' => 'button_text',
						'label'       => esc_html__( 'Button Label', 'dici-feature-pack' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => esc_html__( 'Shop Now', 'dici-feature-pack' ),
					],
				],
				'title_field' => 'ID - {{{ product_id }}}',
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
			'arrows',
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
			'section_image_styling',
			[
				'label' => esc_html__( 'Image Layout', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sale_image_width',
			[
				'label' => __( 'Image Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sale-image > img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'sale_image_padding',
			[
				'label' => __( 'Padding', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sale-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_styling',
			[
				'label' => esc_html__( 'Content Layout', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sale_content_padding',
			[
				'label' => __( 'Padding', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sale-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_align',
			[
				'label' => __('Alignment', 'dici-feature-pack'),
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

		$this->add_control(
			'sale_content_vertical_align',
			[
				'label' => __( 'Sale Item Content Vertical Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'dici-feature-pack' ),
					'center' => __( 'Center', 'dici-feature-pack' ),
					'bottom' => __( 'Bottom', 'dici-feature-pack' ),
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_title_styling',
			[
				'label' => esc_html__( 'Item Title', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_title_tag',
			[
				'label' => __( 'Sale Item Title Tag', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'dici-feature-pack' ),
					'h2' => __( 'H2', 'dici-feature-pack' ),
					'h3' => __( 'H3', 'dici-feature-pack' ),
					'h4' => __( 'H4', 'dici-feature-pack' ),
					'h5' => __( 'H5', 'dici-feature-pack' ),
					'h6' => __( 'H6', 'dici-feature-pack' ),
					'div' => __( 'div', 'dici-feature-pack' ),
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'item_title_color',
			[
				'label' => __( 'Item Title Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-title a, {{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_title_typography',
				'selector' => '{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-title a, {{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-title',
			]
		);

		$this->add_responsive_control(
			'item_title_bottom_space',
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
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sale_heading_text',
			[
				'label' => esc_html__( 'Heading Text', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sale_heading_text_color',
			[
				'label' => __( 'Heading Text Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_heading_text_typography',
				'selector' => '{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-tag',
			]
		);

		$this->add_responsive_control(
			'item_heading_text_bottom_space',
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
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'sale_pre_countdown_text',
			[
				'label' => esc_html__( 'Pre Countdown Text', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sale_pre_countdown_text_color',
			[
				'label' => __( 'Pre Countdown Text Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_pre_countdown_text_typography',
				'selector' => '{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-text',
			]
		);

		$this->add_responsive_control(
			'sale_pre_countdown_text_bottom_space',
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
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .sale-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sale_countdown_text',
			[
				'label' => esc_html__( 'Countdown', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sale_countdown_color',
			[
				'label' => __( 'Countdown Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .countdown-wrapper' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_countdown_typography',
				'selector' => '{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .countdown-wrapper',
			]
		);

		$this->add_responsive_control(
			'sale_countdown_bottom_space',
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
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .countdown-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sale_price',
			[
				'label' => esc_html__( 'Sale Price', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label' => __( 'Sale Price Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .woocs_price_code' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_price_typography',
				'selector' => '{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .woocs_price_code',
			]
		);

		$this->add_responsive_control(
			'sale_price_bottom_space',
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
					'{{WRAPPER}} .tz-woo-sale-countdown-carousel .sale-item .woocs_price_code' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'sale_button',
			[
				'label' => esc_html__( 'Button', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_button',
			[
				'label' => __( 'Button Style', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.sale-button, {{WRAPPER}} .sale-button',
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.sale-button, {{WRAPPER}} .sale-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.sale-button, {{WRAPPER}} .sale-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' => __( 'Text Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.sale-button:hover, {{WRAPPER}} .sale-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.sale-button:hover, {{WRAPPER}} .sale-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.sale-button:hover, {{WRAPPER}} .sale-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .sale-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.sale-button, {{WRAPPER}} .sale-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .sale-button',
			]
		);

		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => __( 'Padding', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.sale-button, {{WRAPPER}} .sale-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
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
				'min' => 1,
				'max' => 1,
				'step' => 1,
				'default' => 1,
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

	public function render(){

		$settings = $this->get_settings();

		$carousel_settings = array();

		$carousel_settings['selector']       = ".tz-woo-sale-countdown-carousel";
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

		$carousel_settings = apply_filters( '/elementor/tz_woo_sale_countdown_carousel_settigns', $carousel_settings );

		$args[ 'carousel_settings' ] = wp_json_encode($carousel_settings);

		$args[ 'layout' ] = $settings[ 'layout_view' ];

		$args[ 'cols' ] = $settings['display_columns'];

		$args[ 'products' ] = $settings['products'];

		$args['item_title_tag'] = $settings['item_title_tag'];

		$args['content_align'] = $settings['content_align'];

		$args['sale_content_vertical_align'] = $settings['sale_content_vertical_align'];

		TZ_Helper::get_template('widget-sale-countdown-carousel.php', $args);

	}

}