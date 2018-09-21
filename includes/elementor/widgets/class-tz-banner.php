<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 07/06/2018
 * Time: 15:47
 */

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Widget_TZ_Banner extends Widget_Base {

	public function get_name() {
		return 'tz-banner';
	}

	public function get_title() {
		return esc_html__( 'Banner', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'fa fa-image';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'imagesloaded'
		];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Banner', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Banner Image', 'dici-feature-pack' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'tag',
			[
				'label' => __( 'Tag line', 'dici-feature-pack' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the banners tag line', 'dici-feature-pack' ),
				'placeholder' => __( 'Enter your tag line', 'dici-feature-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'dici-feature-pack' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the Banner\'s Title', 'dici-feature-pack' ),
				'placeholder' => __( 'Enter your banner\'s title', 'dici-feature-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'optional_content',
			[
				'label' => __( 'Optional Content', 'dici-feature-pack' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'placeholder' => '',
				'separator' => 'none',
				'rows' => 10,
				'show_label' => true,
			]
		);

		$this->add_control(
			'button_title',
			[
				'label' => __( 'Button title', 'dici-feature-pack' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click here', 'dici-feature-pack' ),
				'placeholder' => __( 'Click here', 'dici-feature-pack' ),
			]
		);


		$this->add_responsive_control(
			'button_alignment',
			[
				'label' => __( 'Content Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'tz-banner-content-align-',
				'default' => 'left',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link to', 'dici-feature-pack' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'dici-feature-pack' ),
				'separator' => 'before',
			]
		);



		$this->add_responsive_control(
			'banner_content_position',
			[
				'label' => __( 'Content Position', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
				        '0'
                ],
				'selectors' => [
					'{{WRAPPER}} .tz-banner-wrapper .tz-banner-content' => 'top: {{TOP}}{{UNIT}}; right:{{RIGHT}}{{UNIT}}; bottom:{{BOTTOM}}{{UNIT}}; left:{{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_responsive_control(
			'banner_content_width',
			[
				'label' => __( 'Content Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-banner-wrapper .tz-banner-content' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'tag_tag',
			[
				'label' => __( 'Tag line HTML Tag', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'span',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'dici-feature-pack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'dici-feature-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => __( 'Spacing', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.tz-banner-position-right .tz-banner-content' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.tz-banner-position-left .tz-banner-content' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.tz-banner-position-top .tz-banner-content' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.tz-banner-position-bottom .tz-banner-content' => 'top: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}}.tz-banner-position-right .tz-banner-content' => 'left: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}}.tz-banner-position-left .tz-banner-content' => 'right: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}}.tz-banner-position-top .tz-banner-content' => 'bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}}.tz-banner-position-bottom .tz-banner-content' => 'top: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}}.tz-banner-position-right .tz-banner-content' => 'left: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}}.tz-banner-position-left .tz-banner-content' => 'right: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}}.tz-banner-position-top .tz-banner-content' => 'bottom: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}}.tz-banner-position-bottom .tz-banner-content' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'dici-feature-pack' ),
				'default' => 'no',
				'type' => Controls_Manager::SELECT,
				'options' => [
					'no' => 'No Effect',
					'simple-zoom' => 'Simple Zoom',
					'button' => 'Banner Button Animation',
					'bubba' => 'Bubba',
					'chico' => 'Chico',
					'milo' => 'Milo',
					'lily' => 'Lily',
					'layla' => 'Layla',
                ],
				'prefix_class' => 'tz-banner-animation-',
				'toggle' => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'dici-feature-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tag_align',
			[
				'label' => __( 'Tag Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-banner-content .tz-banner-tag' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_align',
			[
				'label' => __( 'Title Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'dici-feature-pack' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-banner-content .tz-banner-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Content Vertical Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'dici-feature-pack' ),
					'middle' => __( 'Middle', 'dici-feature-pack' ),
					'bottom' => __( 'Bottom', 'dici-feature-pack' ),
				],
				'default' => 'top',
				'prefix_class' => 'tz-banner-vertical-align-',
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label' => __( 'Tag line', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tag_bottom_space',
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
					'{{WRAPPER}} .tz-banner-content .tz-banner-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tag_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tz-banner-content .tz-banner-tag' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tag_typography',
				'selector' => '{{WRAPPER}} .tz-banner-content .tz-banner-tag',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
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
					'{{WRAPPER}} .tz-banner-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tz-banner-content .tz-banner-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tz-banner-content .tz-banner-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_optional_text',
			[
				'label' => __( 'Optional Text', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'optional_text_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tz-banner-content .tz-banner-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'optional_text_typography',
				'selector' => '{{WRAPPER}} .tz-banner-content .tz-banner-text',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
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
				'selector' => '{{WRAPPER}} a.tz-banner-button, {{WRAPPER}} .tz-banner-button',
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
					'{{WRAPPER}} a.tz-banner-button, {{WRAPPER}} .tz-banner-button' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} a.tz-banner-button, {{WRAPPER}} .tz-banner-button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} a.tz-banner-button:hover, {{WRAPPER}} .tz-banner-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' => __( 'Background Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.tz-banner-button:hover, {{WRAPPER}} .tz-banner-button:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} a.tz-banner-button:hover, {{WRAPPER}} .tz-banner-button:hover' => 'border-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .tz-banner-button',
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
					'{{WRAPPER}} a.tz-banner-button, {{WRAPPER}} .tz-banner-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .tz-banner-button',
			]
		);

		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => __( 'Padding', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.tz-banner-button, {{WRAPPER}} .tz-banner-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$has_content = ! empty( $settings['tag'] ) || ! empty( $settings['title'] || ! empty( $settings['optional_content'] ) );

		$html = '<div class="tz-banner-wrapper tz-banner-animation-'.$settings['hover_animation'].'">';

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['hover_animation'] ) {
				$this->add_render_attribute( 'image', 'class', 'tz-banner-animation-' . $settings['hover_animation'] );
			}

			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

			if ( ! empty( $settings['link']['url'] ) ) {
				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			}

			$html .= '<figure class="tz-banner-img">' . $image_html . '</figure>';
		}

		if ( $has_content ) {
			$html .= '<div class="tz-banner-content">';

			if ( ! empty( $settings['tag'] ) ) {
				$this->add_render_attribute( 'tag', 'class', 'tz-banner-tag' );

				$this->add_inline_editing_attributes( 'tag', 'none' );

				$tag_html = $settings['tag'];

				if ( ! empty( $settings['link']['url'] ) ) {
					$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $tag_html . '</a>';
				}

				$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['tag_tag'], $this->get_render_attribute_string( 'tag' ), $tag_html );
			}

			if ( ! empty( $settings['title'] ) ) {
				$this->add_render_attribute( 'title', 'class', 'tz-banner-title' );

				$this->add_inline_editing_attributes( 'title', 'none' );

				$title_html = $settings['title'];

				if ( ! empty( $settings['link']['url'] ) ) {
					$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
				}

				$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title' ), $title_html );
			}

			if ( ! empty( $settings['optional_content'] ) ) {

				$this->add_render_attribute( 'optional_content', 'class', 'tz-banner-text' );

				$this->add_inline_editing_attributes( 'optional_content' );

				$html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'optional_content' ), $settings['optional_content'] );
			}

			if ( ! empty( $settings['button_title'] ) ) {

				$this->add_render_attribute( 'button_title', 'class', 'tz-banner-button' );

				$this->add_inline_editing_attributes( 'button_title' );

				$button_html = $settings['button_title'];

				if ( ! empty( $settings['link']['url'] ) ) {

					$button_html = '<a ' . $this->get_render_attribute_string( 'link' ) . ' ' . $this->get_render_attribute_string( 'button_title' ) . '>' . $button_html . '</a>';

				} else {
					$button_html = '<a href="#" ' . $this->get_render_attribute_string( 'button_title' ) . ' >'.$button_html.'</a>';
                }

				$html .= $button_html;

            }

			$html .= '</div>';
		}

		$html .= '</div>';

		echo $html;

	}

	protected function _content_template() {
		?>
		<#
		var html = '<div class="tz-banner-wrapper ' + settings.hover_animation + '">';

		if ( settings.image.url ) {

			var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			var imageHtml = '<img src="' + image_url + '" />';

			if ( settings.link.url ) {
				imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
			}

			html += '<figure class="tz-banner-img">' + imageHtml + '</figure>';

		}

		var hasContent = !! ( settings.tag || settings.title || settings.optional_content );

		if ( hasContent ) {

			html += '<div class="tz-banner-content">';

				if ( settings.tag ) {

					var tag_html = settings.tag;

					if ( settings.link.url ) {
						tag_html = '<a href="' + settings.link.url + '">' + tag_html + '</a>';
					}

					view.addRenderAttribute( 'tag', 'class', 'tz-banner-tag' );

					view.addInlineEditingAttributes( 'tag', 'none' );

					html += '<' + settings.tag_tag  + ' ' + view.getRenderAttributeString( 'tag' ) + '>' + tag_html + '</' + settings.tag_tag  + '>';
				}

				if ( settings.title ) {

					var title_html = settings.title;

					if ( settings.link.url ) {
						title_html = '<a href="' + settings.link.url + '">' + title_html + '</a>';
					}

					view.addRenderAttribute( 'title', 'class', 'tz-banner-title' );

					view.addInlineEditingAttributes( 'title', 'none' );

					html += '<' + settings.title_tag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title_html + '</' + settings.title_tag  + '>';
				}

				if ( settings.optional_content ) {

					view.addRenderAttribute( 'optional_content', 'class', 'tz-banner-text' );

					view.addInlineEditingAttributes( 'optional_content' );

					html += '<p ' + view.getRenderAttributeString( 'optional_content' ) + '>' + settings.optional_content + '</p>';
				}

                if ( settings.button_title ) {

                    var button_html = settings.button_title;

                    if ( settings.link.url ) {
                        button_html = '<a class="tz-banner-button" href="' + settings.link.url + '">' + button_html + '</a>';
                    } else {
                        button_html = '<a class="tz-banner-button" href="#">' + button_html + '</a>';
                    }

                    view.addRenderAttribute( 'button_title', 'class', 'tz-banner-button' );

                    view.addInlineEditingAttributes( 'button_title', 'none' );

                    html += button_html;

                }

			html += '</div>';
		}

		html += '</div>';

		print( html );
		#>
		<?php
	}


}