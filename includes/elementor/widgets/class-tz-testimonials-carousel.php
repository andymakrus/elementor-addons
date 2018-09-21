<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13/07/2018
 * Time: 14:44
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;


class Widget_TZ_Testimonials_Carousel extends Widget_Base {

	public function get_name() {
		return 'tz-testimonials-carousel';
	}

	public function get_title() {
		return esc_html__( 'Testimonials Carousel', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-chat-1';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'owl-carousel',
			'owl-carousel-controller'
		];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'testimonials',
			[
				'label' => __('Testimonials', 'dici-feature-pack'),
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'default' => [
					[
						'client_name' => __('Customer #1', 'dici-feature-pack'),
						'credentials' => __('Developer, Themes Zone.', 'dici-feature-pack'),
						'testimonial_text' => __('I am testimonial text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dici-feature-pack'),
					],
					[
						'client_name' => __('Customer #2', 'dici-feature-pack'),
						'credentials' => __('Lead Developer, Automattic Inc', 'dici-feature-pack'),
						'testimonial_text' => __('I am testimonial text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dici-feature-pack'),
					],
					[
						'client_name' => __('Customer #3', 'dici-feature-pack'),
						'credentials' => __('Designer, Themes Zone.', 'dici-feature-pack'),
						'testimonial_text' => __('I am testimonial text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dici-feature-pack'),
					],
				],
				'fields' => [
					[
						'name' => 'client_name',
						'label' => __('Name', 'dici-feature-pack'),
						'type' => Controls_Manager::TEXT,
						'default' => __('My client name', 'dici-feature-pack'),
						'description' => __('The client or customer name for the testimonial', 'dici-feature-pack'),
						'dynamic' => [
							'active' => true,
						],
					],
					[
						'name' => 'credentials',
						'label' => __('Client Details', 'dici-feature-pack'),
						'type' => Controls_Manager::TEXT,
						'description' => __('The details of the client/customer like company name, credential held, company URL etc. HTML accepted.', 'dici-feature-pack'),
						'dynamic' => [
							'active' => true,
						],
					],

					[
						'name' => 'client_image',
						'label' => __('Customer/Client Image', 'dici-feature-pack'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'label_block' => true,
						'dynamic' => [
							'active' => true,
						],
					],

					[
						'name' => 'testimonial_text',
						'label' => __('Testimonials Text', 'dici-feature-pack'),
						'type' => Controls_Manager::WYSIWYG,
						'description' => __('What your customer/client had to say', 'dici-feature-pack'),
						'show_label' => false,
						'dynamic' => [
							'active' => true,
						],
					],

				],
				'title_field' => '{{{ client_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Carousel Options', 'dici-feature-pack' ),
				'tab' => Controls_Manager::TAB_SETTINGS,
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
				'default' => 0,
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
				'max' => 2,
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
				'max' => 2,
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
				'default' => 0,
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
				'max' => 2,
				'step' => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'tablet_scroll_columns',
			[
				'label' => __('Columns to scroll', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 2,
				'step' => 1,
				'default' => 1,
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
				'default' => 0,
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
				'max' => 2,
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
				'max' => 2,
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

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __('Text Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .testimonial .testimonial-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .testimonial .testimonial-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_border_color',
			[
				'label' => __( 'Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial .testimonial-text, {{WRAPPER}} .testimonial .testimonial-text:after' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .testimonial .testimonial-text, {{WRAPPER}} .testimonial .testimonial-text:after' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .testimonial .testimonial-text',
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
					'{{WRAPPER}} .testimonial .testimonial-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			
			'section_testimonials_author_name',
			[
				'label' => __( 'Author Name', 'dici-feature-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'author_name_tag',
			[
				'label' => esc_html__( 'Author HTML Tag', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => esc_html__( 'H1', 'dici-feature-pack' ),
					'h2' => esc_html__( 'H2', 'dici-feature-pack' ),
					'h3' => esc_html__( 'H3', 'dici-feature-pack' ),
					'h4' => esc_html__( 'H4', 'dici-feature-pack' ),
					'h5' => esc_html__( 'H5', 'dici-feature-pack' ),
					'h6' => esc_html__( 'H6', 'dici-feature-pack' ),
					'div' => esc_html__( 'div', 'dici-feature-pack' ),
				],
				'default' => 'h4',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial .testimonial-author-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .testimonial .testimonial-author-name',
			]
		);

		$this->add_responsive_control(
			'item_name_bottom_space',
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
					'{{WRAPPER}} .testimonial .testimonial-author-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonials_author_credentials',
			[
				'label' => __('Author Credentials', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'credential_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial .testimonial-credentials' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'credential_typography',
				'selector' => '{{WRAPPER}} .testimonial .testimonial-credentials',
			]
		);


		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$carousel_settings = array();

		$carousel_settings['selector']       = ".tz-testimonials-carousel";
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

		$carousel_settings = apply_filters( '/elementor/tz_testimonials_carousel_settigns', $carousel_settings );

		$args[ 'carousel_settings' ] = wp_json_encode($carousel_settings);

		$args[ 'cols' ] = $settings['display_columns'];

		$args[ 'testimonials' ] = $settings['testimonials'];

		$args['author_name_tag'] = $settings['author_name_tag'];

		$args['content_align'] = $settings['content_align'];

		TZ_Helper::get_template('widget-testimonials-carousel.php', $args);

	}

}