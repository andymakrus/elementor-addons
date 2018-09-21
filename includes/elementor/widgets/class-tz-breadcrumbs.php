<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 28/05/2018
 * Time: 14:06
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;

class Widget_TZ_Breadcrumbs extends Widget_Base {

	public function get_name() {
		return 'tz-breadcrumbs';
	}

	public function get_title() {
		return __( 'Breadcrumbs', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-cash';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Breadcrumbs', 'dici-feature-pack' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager ::CHOOSE,
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-tz-breadcrumbs-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-tz-breadcrumbs-wrapper .nav-crumbs',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		if ( function_exists('yoast_breadcrumb') ) {

			$settings = $this->get_settings_for_display();

			$this->add_render_attribute( 'wrapper', 'class', 'elementor-tz-breadcrumbs-wrapper' );
			$this->add_inline_editing_attributes( 'content' );
			?>
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php yoast_breadcrumb('<nav class="nav-crumbs" '.$this->get_render_attribute_string( 'content' ).' >','</nav>',  true ); ?>
			</div>
			<?php

		} else return false;
	}

	protected function _content_template() {}

}