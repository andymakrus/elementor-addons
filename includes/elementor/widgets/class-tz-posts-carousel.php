<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 01/06/2018
 * Time: 18:15
 */

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Widget_TZ_Posts_Carousel extends Widget_Base {

	public function get_name() {
		return 'tz-posts-carousel';
	}

	public function get_title() {
		return esc_html__( 'Posts Carousel', 'dici-feature-pack' );
	}

	public function get_icon() {
		return 'tz-icon-newspaper';
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

	private function _get_all_post_type_options(){

		$post_types = get_post_types(array('public' => true), 'objects');

		$options = ['' => ''];

		foreach ($post_types as $post_type) {
			$options[$post_type->name] = $post_type->label;
		}

		return $options;

	}

	private function _get_all_taxonomy_options(){
		global $wpdb;

		$results = array();

		foreach ($wpdb->get_results("
			SELECT terms.slug AS 'slug', terms.name AS 'label', termtaxonomy.taxonomy AS 'type'
			FROM $wpdb->terms AS terms
			JOIN $wpdb->term_taxonomy AS termtaxonomy ON terms.term_id = termtaxonomy.term_id
			LIMIT 100") as $result) {

			$results[$result->type . ':' . $result->slug] = $result->type . ':' . $result->label;
		}
		return $results;
	}

	private function _build_query_args($settings){

		$query_args = [
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
		];

		if (!empty($settings['post_in'])) {
			$query_args['post_type'] = 'any';
			$query_args['post__in'] = explode(',', $settings['post_in']);
			$query_args['post__in'] = array_map('intval', $query_args['post__in']);
		}
		else {
			if (!empty($settings['post_types'])) {
				$query_args['post_type'] = $settings['post_types'];
			}

			if (!empty($settings['tax_query'])) {
				$tax_queries = $settings['tax_query'];

				$query_args['tax_query'] = array();
				$query_args['tax_query']['relation'] = 'OR';
				foreach ($tax_queries as $tq) {
					list($tax, $term) = explode(':', $tq);

					if (empty($tax) || empty($term))
						continue;
					$query_args['tax_query'][] = array(
						'taxonomy' => $tax,
						'field' => 'slug',
						'terms' => $term
					);
				}
			}
		}

		$query_args['posts_per_page'] = $settings['posts_per_page'];

		$query_args['paged'] = max(1, get_query_var('paged'), get_query_var('page'));

		return $query_args;

	}

	private function _get_taxonomies_map() {
		$map = array();
		$taxonomies = get_taxonomies();
		foreach ($taxonomies as $taxonomy) {
			$map [$taxonomy] = $taxonomy;
		}
		return $map;
	}

	static function _entry_categories(){
	    if ( 'post' === get_post_type() ) {
		    /* translators: used between list items, there is a space after the comma */
		    $categories_list = get_the_category_list(esc_html__(' ', 'dici-feature-pack'));
		    if ($categories_list) {
			    /* translators: 1: list of categories. */
			    printf('<span class="cat-links">' . esc_html__('%1$s', 'dici-feature-pack') . '</span> ', $categories_list); // WPCS: XSS OK.
		    }
		}
	}

	static function _posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'dici-feature-pack' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

	static function _posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'DATE_W3C' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'DATE_W3C' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
		/* translators: %s: post date. */
			esc_html_x( '%s ', 'post date', 'dici-feature-pack' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

	static function _comment_link(){
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dici-feature-pack' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}

	static function _entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'dici-feature-pack' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'dici-feature-pack' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'dici-feature-pack' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_posts_carousel',
			[
				'label' => esc_html__( 'Posts Query', 'dici-feature-pack'),
			]
		);

		$this->add_control(
			'post_types',
			[
				'label' => esc_html__( 'Post Types', 'dici-feature-pack'),
				'type' => Controls_Manager::SELECT2,
				'default' => 'post',
				'options' => $this->_get_all_post_type_options(),
				'multiple' => true
			]
		);

		$this->add_control(
			'tax_query',
			[
				'label' => esc_html__( 'Taxonomies', 'dici-feature-pack'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->_get_all_taxonomy_options(),
				'multiple' => true,
				'label_block' => true
			]
		);

		$this->add_control(
			'post_in',
			[
				'label' => esc_html__( 'Post In', 'dici-feature-pack'),
				'description' => esc_html__( 'Provide a comma separated list of Post IDs to display in the grid.', 'dici-feature-pack'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'dici-feature-pack'),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'advanced',
			[
				'label' => esc_html__( 'Advanced', 'dici-feature-pack'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'content_source',
			[
				'label' => esc_html__( 'Summary Content Source', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'excerpt',
				'options' => [
					'excerpt' => esc_html__( 'Excerpt', 'dici-feature-pack' ),
					'content' => esc_html__( 'Content', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'dici-feature-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Left', 'dici-feature-pack' ),
					'center' => esc_html__( 'Center', 'dici-feature-pack' ),
					'right' => esc_html__( 'Right', 'dici-feature-pack' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'dici-feature-pack'),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'none' => esc_html__( 'No order', 'dici-feature-pack'),
					'ID' => esc_html__( 'Post ID', 'dici-feature-pack'),
					'author' => esc_html__( 'Author', 'dici-feature-pack'),
					'title' => esc_html__( 'Title', 'dici-feature-pack'),
					'date' => esc_html__( 'Published date', 'dici-feature-pack'),
					'modified' => esc_html__( 'Modified date', 'dici-feature-pack'),
					'parent' => esc_html__( 'By parent', 'dici-feature-pack'),
					'rand' => esc_html__( 'Random order', 'dici-feature-pack'),
					'comment_count' => esc_html__( 'Comment count', 'dici-feature-pack'),
					'menu_order' => esc_html__( 'Menu order', 'dici-feature-pack'),
					'post__in' => esc_html__( 'By include order', 'dici-feature-pack'),
				),
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'dici-feature-pack'),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'ASC' => esc_html__( 'Ascending', 'dici-feature-pack'),
					'DESC' => esc_html__( 'Descending', 'dici-feature-pack'),
				),
				'default' => 'DESC',
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
				'default' => 3,
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
			'section_entry_title_styling',
			[
				'label' => esc_html__( 'Post Entry Title', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'entry_title_tag',
			[
				'label' => __( 'Entry Title HTML Tag', 'dici-feature-pack' ),
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
			'entry_title_color',
			[
				'label' => __( 'Entry Title Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'entry_title_typography',
				'selector' => '{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_entry_summary_styling',
			[
				'label' => esc_html__( 'Post Entry Summary', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'entry_summary_color',
			[
				'label' => __( 'Entry Summary Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'entry_summary_typography',
				'selector' => '{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_entry_meta_styling',
			[
				'label' => esc_html__( 'Post Entry Meta', 'dici-feature-pack'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_entry_meta',
			[
				'label' => __( 'Entry Meta', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'entry_meta_color',
			[
				'label' => __( 'Entry Meta Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-meta span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'entry_meta_typography',
				'selector' => '{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-meta span',
			]
		);


		$this->add_control(
			'heading_entry_meta_link',
			[
				'label' => __( 'Entry Meta Link', 'dici-feature-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_control(
			'entry_meta_link_color',
			[
				'label' => __( 'Entry Meta Link Color', 'dici-feature-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-meta span a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'entry_meta_link_typography',
				'selector' => '{{WRAPPER}} .tz-posts-carousel .tz-posts-carousel-item .entry-meta span a',
			]
		);

		$this->end_controls_section();


	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		$taxonomies = array();

		$carousel_settings = array();

		if ( 'carousel' == $settings['layout'] ) {
			$carousel_settings['selector']       = ".tz-posts-carousel";
			$carousel_settings['type']           = "content-carousel";
			$carousel_settings['slides']         = isset( $settings['display_columns'] ) ? $settings['display_columns'] : '3';
			$carousel_settings['scroll']         = isset( $settings['scroll_columns'] ) ? $settings['scroll_columns'] : '1';
			$carousel_settings['gap']            = isset( $settings['gutter'] ) ? $settings['gutter'] : '30';
			$carousel_settings['custom_nav']     = isset( $settings['arrows'] ) ? $settings['arrows'] : 'yes' ;
			$carousel_settings['dots']           = isset( $settings['dots'] ) ?  $settings['dots'] : 'no';
			$carousel_settings['autoplay']       = isset( $settings['autoplay'] ) ?  $settings['autoplay'] : 'no';
			$carousel_settings['speed']          = isset( $settings['animation_speed'] ) ? $settings['animation_speed'] : '500' ;
			$carousel_settings['autoplay_speed'] = isset( $settings['autoplay_speed'] ) ? $settings['autoplay_speed'] : '3000' ;
			$carousel_settings['loop']           = isset( $settings['loop'] ) ? $settings['loop'] : 'no';
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

			$carousel_settings = apply_filters( '/elementor/tz_posts_carousel_settigns', $carousel_settings );

		}



		// Use the processed post selector query to find posts.
		$query_args = $this->_build_query_args($settings);

		$loop = new \WP_Query($query_args);

		// Loop through the posts and do something with them.
		if ($loop->have_posts()) {

			if ( 'carousel' == $settings['layout'] ) $args['carousel_settings'] = wp_json_encode($carousel_settings);

			$args['loop'] = $loop;
			$args['cols'] =  isset( $settings['display_columns'] ) ? $settings['display_columns'] : '3';
			$args['entry_title_tag'] = $settings['entry_title_tag'];
			$args['content_source'] = $settings['content_source'];
			$args['alignment'] = $settings['alignment'];

			TZ_Helper::get_template('widget-posts-carousel.php', $args);

		}


	}


}