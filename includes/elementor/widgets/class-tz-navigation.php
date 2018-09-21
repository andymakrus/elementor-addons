<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 25/07/2018
 * Time: 13:54
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_TZ_Navigation extends Widget_Base{

	public function get_name() {
		return 'tz-navigation';
	}

	public function get_title() {
		return esc_html__( 'Site Navigation', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-link';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	private function _get_all_menus() {

		$menu_array = [];
		$menus = get_terms('nav_menu');

		foreach ( $menus as $menu ) {
			$menu_array[ $menu->slug ] = $menu->name;
		}

		return $menu_array;

	}

	private function _get_all_menu_locations(){

		$menu_location = get_registered_nav_menus();

		return $menu_location;

	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'menu',
			[   'label' => esc_html__( 'Menu to Show', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT2,
				'options' =>$this->_get_all_menus(),
			]
		);

		$this->add_control(
			'menu_location',
			[   'label' => esc_html__( 'Menu Location to Use', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT2,
				'options' =>$this->_get_all_menu_locations(),
			]
		);

		$this->add_control(
			'root_class',
			[
				'label'       => esc_html__( 'Root Container Class', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'main-navigation',
			]
		);

		$this->add_control(
			'root_id',
			[
				'label'       => esc_html__( 'Root Container ID', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'site-navigation',
			]
		);

		$this->add_control(
			'toggle_title',
			[
				'label'       => esc_html__( 'Mobile Toggle Title', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Menu', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'menu_class',
			[
				'label'       => esc_html__( 'Menu Class', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'menu_id',
			[
				'label'       => esc_html__( 'Menu ID', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'container',
			[
				'label' => __( 'Menu Container', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => '',
					'div' => 'div',
					'span' => 'span',
					'section' => 'section',
					'nav' => 'nav',
					'p' => 'p',
				],
				'default' => '',
			]
		);

		$this->add_control(
			'container_class',
			[
				'label'       => esc_html__( 'Container Class', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'container_id',
			[
				'label'       => esc_html__( 'Container ID', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'before',
			[
				'label'       => esc_html__( 'Before', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'after',
			[
				'label'       => esc_html__( 'After', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'link_before',
			[
				'label'       => esc_html__( 'Before Link', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'link_after',
			[
				'label'       => esc_html__( 'After Link', 'dici-feature-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			]
		);

		$this->add_control(
			'depth',
			[
				'label' => esc_html__( 'Menu Depth', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'item_spacing',
			[
				'label' => __( 'Item Spacing', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'preserve' => esc_html__( 'Preserve', 'dici-feature-pack' ),
					'discard' => esc_html__( 'Discard', 'dici-feature-pack' ),
				],
				'default' => 'preserve',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_styling',
			[
				'label' => esc_html__( 'Menu Styling', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_align',
			[
				'label' => __('Menu Alignment', 'dici-feature-pack'),
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
			'item_menu_color',
			[
				'label' => __( 'Item Title Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} nav > ul > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_menu_typography',
				'selector' => '{{WRAPPER}} nav > ul > li > a',
			]
		);

		$this->add_responsive_control(
			'menu_item_margin',
			[
				'label' => __( 'Margin', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} nav > ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'menu_item_padding',
			[
				'label' => __( 'Padding', 'dici-feature-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} nav > ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();
		if ( isset ( $settings['menu'] ) && ( '' != $settings['menu'] ) ) :
		?>
		<nav id="<?php echo esc_attr( $settings['root_id'] ) ?>" class="<?php echo esc_attr( $settings['root_class'] ); ?> tz-menu-align-<?php echo esc_attr( $settings['menu_align'] ); ?>">
			<button class="menu-toggle" aria-controls="<?php echo esc_attr( $settings['menu'] ); ?>" aria-expanded="false"><?php echo esc_html( $settings['toggle_title'] ); ?></button>
			<?php
			wp_nav_menu([
				'menu' => $settings['menu'],
				'menu_class' => $settings['menu_class'],
				'menu_id' => $settings['menu_id'],
				'container' => $settings['container'],
				'container_class' => $settings['container_class'],
				'container_id' => $settings['container_id'],
				'before' => $settings['before'],
				'after' => $settings['after'],
				'link_before' => $settings['link_before'],
				'link_after' => $settings['link_after'],
				'depth' => $settings['depth'],
				'theme_location' => $settings['menu_location'],
				'item_spacing' => $settings['item_spacing'],
			]);
			?>
		</nav>
		<?php
		endif;

	}

}