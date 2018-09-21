<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 18/07/2018
 * Time: 16:27
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TZ_Woo_Menu_Categories extends Widget_Base {

	public function get_name() {
		return 'tz-woo-menu-categories';
	}
	/**
	 * Retrieve the widget title.
	 */
	public function get_title() {
		return esc_html__( 'Products Categories for Mega Menu', 'dici-feature-pack' );
	}
	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon() {
		return 'fa fa-bars';
	}

	public function get_categories() {
		return [ 'themes-zone-elements' ];
	}

	private function _get_categories(){

		$categories = array();

		$args = array(
			'taxonomy'     => 'product_cat',
			'hide_empty'   => false
		);

		$all_product_categories = get_categories( $args );

		foreach ( $all_product_categories as $category ){
			$sub_cats_num = count ( get_term_children( $category->term_id, 'product_cat' ) );
			$categories [ $category->term_id ] = $category->name.( $sub_cats_num ? ' ('.$sub_cats_num.') ' : '' );
		}

		return $categories;

	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Product Category', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->_get_categories(),
				'description' => esc_html__( 'Note: make sure that desired categories have sub-categories', 'dici-feature-pack' ),
			]
		);

		$this->add_control(
			'show_subs',
			[
				'label' => esc_html__( 'Show subcategories?', 'dici-feature-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => esc_html__( 'Yes', 'dici-feature-pack' ),
				'label_off' => esc_html__( 'No', 'dici-feature-pack' ),
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(

			'section_testimonials_author_name',
			[
				'label' => __( 'Parent Category', 'dici-feature-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_tag',
			[
				'label' => esc_html__( 'Parent Category HTML Tag', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h4' => esc_html__( 'H4', 'dici-feature-pack' ),
					'h5' => esc_html__( 'H5', 'dici-feature-pack' ),
					'h6' => esc_html__( 'H6', 'dici-feature-pack' ),
					'div' => esc_html__( 'div', 'dici-feature-pack' ),
					'span' => esc_html__( 'span', 'dici-feature-pack' ),
				],
				'default' => 'h5',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-categories-menu .tz-category' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tz-categories-menu .tz-category',
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
					'{{WRAPPER}} .tz-categories-menu .tz-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_styling',
			[
				'label' => esc_html__( 'Category', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_title_color',
			[
				'label' => __( 'Category Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tz-categories-menu > ul > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'selector' => '{{WRAPPER}} .tz-categories-menu > ul > li > a',
			]
		);

		$this->add_responsive_control(
			'category_bottom_space',
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
					'{{WRAPPER}} .tz-categories-menu > ul > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		if ( isset( $settings['category'] ) ) {
			$category = get_term_by( 'id', $settings['category'], 'product_cat' );
		}
		if ( isset( $category ) && is_object( $category ) ) :
			$parent_cat_url = get_term_link( $category->slug, $category->taxonomy );
			?>
			<div class="tz-categories-menu">
			<<?php echo esc_html( $settings['category_tag'] ) ?> class="tz-category">
			<a href="<?php echo esc_url( $parent_cat_url ) ?>"><?php echo esc_html( $category->name ); ?></a>
			</<?php echo esc_html( $settings['category_tag'] ) ?>>
			<?php
			if ( "yes" == $settings['show_subs'] ) {
				$args = array(
					'hierarchical' => 1,
					'show_option_none' => '',
					'hide_empty' => 0,
					'parent' => $settings['category'],
					'taxonomy' => 'product_cat'
				);
				$subcategories = get_categories($args);
			}

			if ( count ( $subcategories ) ) :
				?>
				<ul>
					<?php foreach ( $subcategories as $sub ) : ?>
						<?php $sub_url = get_term_link( $sub->slug, $sub->taxonomy ); ?>
						<li>
							<a href="<?php echo esc_url( $sub_url ) ?>"><?php echo esc_html( $sub->name ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			</div>
		<?php
		endif;

	}

}