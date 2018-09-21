<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 26/07/2018
 * Time: 15:37
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;

class Widget_TZ_Advanced_Tabs extends Widget_Base {

	public function get_name() {
		return 'tz-advanced-tabs';
	}

	public function get_title() {
		return esc_html__( 'Advanced Tabs', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-folder';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	public function get_script_depends() {
		return [
			'jquery-tabslet',
			'tz-tabslet-controller'
		];
	}

	private function _get_all_sections(){
		$sections_array = [];
		$elementor_sections = get_posts([
			'post_type' => 'elementor-sections',
			'post_status' => 'publish',
			'numberposts' => -1
			// 'order'    => 'ASC'
		]);

		foreach ( $elementor_sections as $section ) {
			$sections_array[$section->ID] = $section->post_title;
		}

		return $sections_array;

	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'toggler_title',
			[
				'label' => __( 'Toggler Title', 'dici-feature-pack' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Browse Categories', 'dici-feature-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Tabs', 'dici-feature-pack' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title' => esc_html__('Tabs', 'dici-feature-pack'),
					],
				],
				'fields' => [
					[
						'name' => 'tab_title',
						'label' => esc_html__( 'Tab Title', 'dici-feature-pack' ),
						'type'        => Controls_Manager::TEXT,
						'default'     => '',
					],
					[
						'name' => 'tab_icon',
						'label' => esc_html__( 'Tab Icon', 'dici-feature-pack' ),
						'type' => 'icontz',
					],
					[
						'name' => 'tab_content_text',
						'label' => esc_html__( 'Tab Content Text', 'dici-feature-pack' ),
						'type'        => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'tab_section',
						'label' => esc_html__( 'Or Section Area', 'dici-feature-pack' ),
						'type' => Controls_Manager::SELECT2,
						'options' =>$this->_get_all_sections(),
						'multiple' => false,
						'label_block' => false
					],

					[
						'name' => 'link_to',
						'label' => __( 'Or Link to', 'dici-feature-pack' ),
						'type' => Controls_Manager::URL,
						'dynamic' => [
							'active' => true,
						],
						'placeholder' => __( 'https://your-link.com', 'dici-feature-pack' ),
						'separator' => 'before',
					],

					[
					    'name' => 'tab_color',
						'label' => __( 'Tab Color', 'dici-feature-pack' ),
						'type' => Controls_Manager::COLOR,
					]

				],
				'title_field' => '{{{ tab_title }}}',
			]);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Tabs Settings', 'dici-feature-pack' ),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$this->add_control(
			'show_toggler',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Show Toggler?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'home_active',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'label' => esc_html__( 'Show Opened on Home Page?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'tabs_animation',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'default' => 'yes',
				'label' => esc_html__( 'Animate Tabs?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'show_first',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'default' => 'no',
				'label' => esc_html__( 'Show First Tab?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'stay_static',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'default' => 'no',
				'label' => esc_html__( 'Static Mode?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'home_opened',
			[
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'dici-feature-pack'),
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack'),
				'default' => 'yes',
				'label' => esc_html__( 'Stay Opened on Home Page?', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'switch_event',
			[
				'label' => esc_html__( 'Tab switch event', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'click',
				'options' => [
					'click' => esc_html__( 'On Click', 'dici-feature-pack' ),
					'hover' => esc_html__( 'On Hover', 'dici-feature-pack' ),
				],
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

		/*$this->add_responsive_control(
			'tabs_width',
			[
				'label' => __('Tabs Container Width', 'dici-feature-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-tabs-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);*/

		$this->add_responsive_control(
			'tabs_link_width',
			[
				'label' => __('Tabs Width', 'dici-feature-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-tabs-container .tz-tab-togglers' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_content_width',
			[
				'label' => __('Tabs Content Width', 'dici-feature-pack'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-tabs-container .tz-tabs-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_togller_styling',
			[
				'label' => esc_html__( 'Main Toggler &amp; Container', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'main_container_background_color',
			[
				'label' => __( 'Container Background Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tabs-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'main_container_padding',
			[
				'label' => __('Main Container Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false,
			]
		);

		$this->add_control(
			'main_container_border_color',
			[
				'label' => __( 'Container Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tabs-wrapper' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'main_container_border_width',
			[
				'label' => __( 'Container Border Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tabs-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				/*'condition' => [
					'view' => 'framed',
				],*/
			]
		);

		$this->add_responsive_control(
			'tabs_togller_padding',
			[
				'label' => __('Main Toggler Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-toggler' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false,
			]
		);

		$this->add_control(
			'tabs_togller_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-toggler' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tabs_togller_typography',
				'selector' => '{{WRAPPER}} .tz-advanced-tabs .tz-toggler',
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
				'label' => esc_html__( 'Show Arrows?', 'dici-feature-pack'),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_container_styling',
			[
				'label' => esc_html__( 'Tab Links Container', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_links_container_border_color',
			[
				'label' => __( 'Container Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_links_container_border_width',
			[
				'label' => __( 'Container Border Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				/*'condition' => [
					'view' => 'framed',
				],*/
			]
		);

		$this->add_responsive_control(
			'tabs_container_padding',
			[
				'label' => __('Container  Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false,
			]
		);

		$this->add_control(
			'container_background_color',
			[
				'label' => __( 'Container Background Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_icon_styling',
			[
				'label' => esc_html__( 'Tab Icons', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_links_icon_size',
			[
				'label' => __( 'Icon Size', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_links_icon_gap',
			[
				'label' => __( 'Icon Gap', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li i' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tab_styling',
			[
				'label' => esc_html__( 'Tab Style', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tab_min_height',
			[
				'label' => __( 'Tab Min Height', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => __('Tab Padding', 'dici-feature-pack'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'isLinked' => false,
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => __( 'Tab Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_color_hover',
			[
				'label' => __( 'Tab Color Hover', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li a',
			]
		);

		$this->add_control(
			'tab_links_border_color',
			[
				'label' => __( 'Border Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_links_border_width',
			[
				'label' => __( 'Border Width', 'dici-feature-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tz-advanced-tabs .tz-tab-togglers li' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$adv_tabs_settigns = array( 'show_toggler' => $settings[ 'show_toggler' ], 'homepage_open' => $settings[ 'home_active' ] );

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {
			$elementor_instance = Elementor\Plugin::instance();
		}

		?>

		<div class="tz-advanced-tabs  <?php echo ( ( $settings[ 'home_active' ] == 'yes' ) && is_front_page() ) ? 'opened' : '' ?>" data-tz-advanced-tabs="<?php echo esc_html( wp_json_encode( $adv_tabs_settigns )) ?>">
		<?php if ( 'yes' == $settings[ 'show_toggler' ] ) : ?>
            <div class="tz-toggler-cotainer">
			    <a class="tz-toggler" href="#"><?php echo esc_html( $settings[ 'toggler_title'] ) ?></a>
                <select class="tz-mobile-tabs-hidden">
                    <option></option>
		            <?php foreach ( $settings[ 'tabs' ] as $tab ) : ?>
			            <?php
			            if ( isset( $tab['link_to']['url'] ) && ( '' != $tab['link_to']['url'] ) ) $tab_link = $tab['link_to']['url'];
			            else $tab_link = '#'.strtolower ( preg_replace ('/\s+/', '-', $tab['tab_title'] ) );
			            ?>
                        <option value="<?php echo esc_attr( $tab_link ); ?>"><?php echo esc_html( $tab['tab_title'] ); ?></option>
		            <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
			<div class="tz-tabs-container" data-tabslet="true" data-animation="<?php echo ( 'yes' == $settings['tabs_animation'] ) ? 'true' : 'false'; ?>" data-active="<?php echo ( 'yes' == $settings['show_first'] ? '1' : 'false' ) ?>" data-mouseevent="<?php echo esc_attr( $settings['switch_event'] ) ?>" data-container=".tz-tabs-wrapper">
                <ul class="tz-tab-togglers">
				<?php foreach ( $settings[ 'tabs' ] as $tab ) : ?>
					<?php
                    if ( isset( $tab['link_to']['url'] ) && ( '' != $tab['link_to']['url'] ) ) $tab_link = $tab['link_to']['url'];
                    else $tab_link = '#'.strtolower ( preg_replace ('/\s+/', '-', $tab['tab_title'] ) );
					$tab_icon = ( isset( $tab[ 'tab_icon' ] ) && ( '' != $tab[ 'tab_icon' ] ) ) ? '<i class="'.$tab[ 'tab_icon' ].'"></i>' : '' ;
					?>
					<li <?php echo ( ! ( isset( $tab['link_to']['url'] ) && ( '' != $tab['link_to']['url'] ) ) && ( 'yes' == $settings['show_arrows'] ) ) ? ' class="tz-arrow" ' : '' ?> ><?php echo wp_kses_post( $tab_icon ); ?>
                        <a href="<?php echo esc_attr( $tab_link ); ?>"
                            <?php echo ( isset( $tab['link_to']['is_external'] ) && ( 'on' == $tab['link_to']['is_external'] ) ? 'target="_blank"' : '' ) ?>
	                        <?php echo ( isset( $tab['link_to']['nofollow'] ) && ( 'on' == $tab['link_to']['nofollow'] ) ? 'rel="nofollow"' : '' )  ?>
                            <?php echo ( isset( $tab['tab_color'] ) && ( '' != $tab['tab_color'] ) ) ? ' style="color: '.esc_attr( $tab['tab_color'] ).' " ' : '' ?> >
                            <?php echo esc_html( $tab['tab_title'] ); ?>
                        </a>
                    </li>
				<?php endforeach; ?>
				</ul>
                <div class="tz-tabs-wrapper <?php echo ( 'yes' != $settings['show_first'] ) ? 'tz-hide' : ''  ?>">
                    <?php foreach ( $settings[ 'tabs' ] as $tab ) : ?>
                    <?php if ( isset( $tab['link_to']['url'] ) && ( '' != $tab['link_to']['url'] ) ) continue; ?>
                    <?php $tab_id = strtolower ( preg_replace ('/\s+/', '-', $tab['tab_title'] ) ); ?>
                    <div id="<?php echo esc_attr( $tab_id ); ?>" class="tz-advanced-tab">
                    <?php if ( isset ( $tab[ 'tab_content_text' ] ) && $tab[ 'tab_content_text' ] ) : ?>
                    <?php echo wp_kses_post( $tab[ 'tab_content_text' ] ); ?>
                    <?php endif ?>
                    <?php if ( isset( $tab[ 'tab_section' ] ) && $tab[ 'tab_section' ] && is_object( $elementor_instance ) ) : ?>
                    <?php echo $elementor_instance->frontend->get_builder_content_for_display( $tab[ 'tab_section' ] ); ?>
                    <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
			</div>
		</div>
		<?php

	}

}