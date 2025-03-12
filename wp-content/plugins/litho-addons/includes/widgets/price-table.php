<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Controls\Groups\Button_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for price table.
 *
 * @package Litho
 */

// If class `Price_Table` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Price_Table' ) ) {

	class Price_Table extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve price table widget name.
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-price-table';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve price table widget title.
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Price Table', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve price table widget icon.
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-price-table';
		}

		/**
		 * Retrieve the widget categories.
		 *
		 * @access public
		 *
		 * @return string Widget categories.
		 */

		public function get_categories() {
			return [ 'litho' ];
		}

		/**
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the widget belongs to.
		 *
		 * @access public
		 *
		 * @return array Widget keywords.
		 */
		public function get_keywords() {
			return [ 'price', 'table' ];
		}

		/**
		 * Register price table widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_price_table_content_section',
				[
					'label' => __( 'General', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_price_table_styles',
				[
					'label'         => __( 'Select style', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'price-table-style-1',
					'options'       => [                        
						'price-table-style-1'  => __( 'Style 1', 'litho-addons' ),
						'price-table-style-2'  => __( 'Style 2', 'litho-addons' ),
						'price-table-style-3'  => __( 'Style 3', 'litho-addons' ),
					], 
					'frontend_available' => true,
				]
			);
			$this->add_control(
				'litho_price_table_label',
				[
					'label'         => __( 'Label', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_item_use_image',
				[
					'label'        => __( 'Use Image?', 'litho-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'litho-addons' ),
					'label_off'    => __( 'No', 'litho-addons' ),
					'return_value' => 'yes',
					'default'      => '',
				]
			);
			$this->add_control(
				'litho_item_icon',
				[
					'label'            => __( 'Icon', 'litho-addons' ),
					'type'             => Controls_Manager::ICONS,
					'label_block'      => true,
					'fa4compatibility' => 'icon',
					'condition'        => [
						'litho_item_use_image' => '',
					],
				]
			);
			$this->add_control(
				'litho_item_image',
				[
					'label'         => __( 'Image', 'litho-addons' ),
					'type'          => Controls_Manager::MEDIA,
					'dynamic'		=> [
						'active' => true,
					],
					'default'       => [
						'url'       => Utils::get_placeholder_image_src(),
					],
					'condition'     => [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_view',
				[
					'label'         => __( 'View', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'default'   => __( 'Default', 'litho-addons' ),
						'stacked'   => __( 'Stacked', 'litho-addons' ),
						'framed'    => __( 'Framed', 'litho-addons' ),
					],
					'default'       => 'default',
					'condition'     => [
						'litho_item_use_image' => '',
					],
					'prefix_class'  => 'elementor-view-',
				]
			);
			$this->add_control(
				'litho_icon_shape',
				[
					'label'         => __( 'Shape', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'options'       => [
						'circle'    => __( 'Circle', 'litho-addons' ),
						'square'    => __( 'Square', 'litho-addons' ),
					],
					'default'       => 'circle',
					'condition'     => [
						'litho_view!'          => 'default',
						'litho_item_use_image' => '',
					],
					'prefix_class'  => 'elementor-shape-',
				]
			);
			$this->add_control(
				'litho_icon_size',
				[
					'label'         => __( 'Size', 'litho-addons' ),
					'type'          => Controls_Manager::SLIDER,
					'range'         => [ 'px'   => ['min' => 6, 'max' => 300 ] ],
					'condition'     => [
						'litho_item_use_image' => '',
					],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon, {{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'litho_thumbnail',
					'default'   => 'full',
					'exclude'	=> [ 'custom' ],
					'condition' => [ 'litho_item_use_image' => 'yes' ],
				]
			);
			$this->add_control(
				'litho_price_table_title',
				[
					'label'         => __( 'Title', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Basic', 'litho-addons' ),
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_price_table_subtitle',
				[
					'label'         => __( 'Subtitle', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'Basic features', 'litho-addons' ),
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_price_table_price',
				[
					'label'         => __( 'Price', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( '$9.99', 'litho-addons' ),
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_price_table_duration',
				[
					'label'         => __( 'Duration', 'litho-addons' ),
					'type'          => Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default'       => __( 'monthly', 'litho-addons' ),
					'label_block'   => true,
				]
			);
			$this->add_control(
				'litho_price_table_content',
				[
					'label'         => __( 'Content', 'litho-addons' ),
					'type'          => Controls_Manager::WYSIWYG,
					'dynamic'       => [
						'active'    => true,
					],
				]
			);
			$this->end_controls_section();
			
			Button_Group_Control::button_content_fields( $this, 'primary', __( 'Button', 'litho-addons' ) );

			$this->start_controls_section(
				'litho_price_table_section_general_style',
				[
					'label' 		=> __( 'General', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_price_table_box_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_box_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_price_table_section_label_style',
				[
					'label' 		=> __( 'Label', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_label_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .pricing-table .popular-label',
				]
			);
			$this->add_control(
				'litho_price_table_label_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .popular-label' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_price_table_label_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .pricing-table .popular-label',
				]
			);
			$this->add_control(
				'litho_price_table_label_position',
				[
					'label'     => __( 'Position', 'litho-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''          => __( 'Default', 'litho-addons' ),
						'absolute'  => __( 'Absolute', 'litho-addons' ),
						'fixed'     => __( 'Fixed', 'litho-addons' ),
						'relative'  => __( 'Relative', 'litho-addons' ),
					],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .popular-label' => 'position: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_label_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .popular-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_label_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .popular-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_price_table_box_icon_style_section',
				[
					'label'         => __( 'Icon or Image', 'litho-addons' ),
					'tab'           => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'      => 'litho_icon_color',
					'condition' => [
						'litho_item_use_image' => '',
						'litho_view'           => 'default',
					],
					'selector'  => '{{WRAPPER}}.elementor-view-default .elementor-icon i:before, {{WRAPPER}}.elementor-view-default .elementor-icon svg',
				]
			);
			$this->add_control(
				'litho_primary_color',
				[
					'label'         => __( 'Primary Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'condition'     => [
							'litho_view!' => 'default',
					],
					'selectors'     => [
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'litho_secondary_color',
				[
					'label'         => __( 'Secondary Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'condition'     => [
							'litho_view!'  => 'default',
					],
					'selectors'     => [
						'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.elementor-view-stacked .elementor-icon svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_icon_image_size',
				[
					'label' => __( 'Width', 'litho-addons' ),
					'type' => Controls_Manager::SLIDER,
					'size_units'     => [ 'px', '%', 'custom' ],
					'range' => [
						'px' => [
								'min' => 1,
								'max' => 1000,
						],
						'%' => [
							'max' => 100,
							'min' => 1,
						],
					],
					'default'       => [ 'unit' => '%', 'size' => 25 ],
					'selectors' => [
						'{{WRAPPER}} .elementor-icon' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition'     => [ 'litho_item_use_image' => 'yes' ],
				]
			);

			$this->add_responsive_control(
				'litho_price_table_icon_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before'
				]
			);
			$this->add_responsive_control(
				'litho_price_table_icon_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .elementor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_price_table_section_title_style',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_title_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .pricing-table .title',
				]
			);
			$this->add_control(
				'litho_price_table_title_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_price_table_title_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .pricing-table .title',
				]
			);
			$this->add_responsive_control(
				'litho_price_table_title_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_title_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_price_table_section_subtitle_style',
				[
					'label' 		=> __( 'Subitle', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_subtitle_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .pricing-table .subtitle',
				]
			);
			$this->add_control(
				'litho_price_table_subtitle_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .subtitle' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_price_table_subtitle_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .pricing-table .subtitle',
				]
			);
			$this->add_responsive_control(
				'litho_price_table_subtitle_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_subtitle_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_price_table_section_price_style',
				[
					'label' 		=> __( 'Price', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_price_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .pricing-table .price',
				]
			);
			$this->add_control(
				'litho_price_table_price_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .price' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_price_table_price_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .pricing-table .price',
				]
			);
			$this->add_responsive_control(
				'litho_price_table_price_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_price_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_price_table_section_duration_style',
				[
					'label' 		=> __( 'Duration', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_duration_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'  => '{{WRAPPER}} .pricing-table .duration',
				]
			);
			$this->add_control(
				'litho_price_table_duration_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .duration' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'litho_price_table_duration_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .duration' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_price_table_duration_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_price_table_section_content_style',
				[
					'label' 		=> __( 'Content', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'litho_price_table_content_typography',
					'selector'  => '{{WRAPPER}} .pricing-table .pricing-body',
				]
			);
			$this->add_control(
				'litho_price_table_content_color',
				[
					'label'         => __( 'Color', 'litho-addons' ),
					'type'          => Controls_Manager::COLOR,
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .pricing-body' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'          => 'litho_price_table_content_bg_color',
					'types'         => [ 'classic', 'gradient' ],
					'exclude'       => [
						'image',
						'position',
						'attachment',
						'attachment_alert',
						'repeat',
						'size',
					],
					'selector'      => '{{WRAPPER}} .pricing-table .pricing-body',
				]
			);
			$this->add_responsive_control(
				'litho_price_table_content_padding',
				[
					'label'         => __( 'Padding', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .pricing-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'     => 'before',
				]
			);
			$this->add_responsive_control(
				'litho_price_table_content_margin',
				[
					'label'         => __( 'Margin', 'litho-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors'     => [
						'{{WRAPPER}} .pricing-table .pricing-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'litho_price_table_border_heading',
				[
					'label'			=> __( 'Only for <ul> element', 'litho-addons' ),
					'type'			=> Controls_Manager::HEADING,
					'separator'		=> 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_price_table_border_ul_li',
					'selector'      => '{{WRAPPER}} .pricing-table .pricing-body ul li',
				]
			);
			$this->end_controls_section();

			Button_Group_Control::button_style_fields( $this, 'primary' );
		}

		/**
		 * Render price table widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @access protected
		 */
		protected function render() {

			$settings                 = $this->get_settings_for_display();
			$litho_price_table_styles = ( isset( $settings['litho_price_table_styles'] ) && $settings['litho_price_table_styles'] ) ? $settings['litho_price_table_styles'] : 'price-table-style-1';
			$litho_label              = ( isset( $settings['litho_price_table_label'] ) && $settings['litho_price_table_label'] ) ? $settings['litho_price_table_label'] : '';
			$litho_title              = ( isset( $settings['litho_price_table_title'] ) && $settings['litho_price_table_title'] ) ? $settings['litho_price_table_title'] : '';
			$litho_subtitle           = ( isset( $settings['litho_price_table_subtitle'] ) && $settings['litho_price_table_subtitle'] ) ? $settings['litho_price_table_subtitle'] : '';
			$litho_price              = ( isset( $settings['litho_price_table_price'] ) && $settings['litho_price_table_price'] ) ? $settings['litho_price_table_price'] : '';
			$litho_duration           = ( isset( $settings['litho_price_table_duration'] ) && $settings['litho_price_table_duration'] ) ? $settings['litho_price_table_duration'] : '';
			$litho_content            = ( isset( $settings['litho_price_table_content'] ) && $settings['litho_price_table_content'] ) ? $settings['litho_price_table_content'] : '';
			$migrated                 = isset( $settings['__fa4_migrated']['litho_item_icon'] );
			$is_new                   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

			$icon = '';
			if ( $is_new || $migrated ) {
				ob_start();
					Icons_Manager::render_icon( $settings['litho_item_icon'], [ 'aria-hidden' => 'true' ] );
				$icon .= ob_get_clean();
			} elseif ( isset( $settings['litho_item_icon']['value'] ) && ! empty( $settings['litho_item_icon']['value'] ) ) {
				$icon .= '<i class="' . esc_attr( $settings['litho_item_icon']['value'] ) . '" aria-hidden="true"></i>';
			}

			$litho_item_image = '';
			if ( ! empty( $settings['litho_item_image']['id'] ) ) {
				$srcset_data          = litho_get_image_srcset_sizes( $settings['litho_item_image']['id'], $settings['litho_thumbnail_size'] );
				$litho_item_image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['litho_item_image']['id'], 'litho_thumbnail', $settings );
				$litho_item_image_alt = Control_Media::get_image_alt( $settings['litho_item_image'] );
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" %3$s />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ), $srcset_data );
			} elseif ( ! empty( $settings['litho_item_image']['url'] ) ) {
				$litho_item_image_url = $settings['litho_item_image']['url'];
				$litho_item_image_alt = '';
				$litho_item_image     = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $litho_item_image_url ), esc_attr( $litho_item_image_alt ) );
			}
			$this->add_render_attribute( 'wrapper', 'class', [ 'pricing-table', $litho_price_table_styles ] );
			?>
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<?php if ( ! empty( $litho_label ) || ! empty( $litho_title ) || ! empty( $litho_subtitle ) || ! empty( $litho_price ) || ! empty( $litho_duration ) ) { ?>
					<div class="pricing-header">
						<?php if ( ! empty( $litho_label ) ) { ?>
							<div class="popular-label"><?php echo esc_html( $litho_label ); ?></div>
						<?php } ?>
						<?php if ( ! empty( $litho_item_image ) || ! empty( $icon ) ) { ?>
							<div class="elementor-icon">
								<?php echo filter_var( $settings['litho_item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $litho_item_image : $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $litho_title ) ) { ?>
							<div class="title"><?php echo esc_html( $litho_title ); ?></div>
						<?php } ?>
						<?php if ( ! empty( $litho_subtitle ) ) { ?>
							<div class="subtitle"><?php echo esc_html( $litho_subtitle ); ?></div>
						<?php } ?>
						<?php if ( ! empty( $litho_price ) ) { ?>
							<h3 class="price"><?php echo esc_html( $litho_price ); ?></h3>
						<?php } ?>
						<?php if ( ! empty( $litho_duration ) ) { ?>
							<span class="duration"><?php echo esc_html( $litho_duration ); ?></span>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $litho_content ) ) { ?>
					<div class="pricing-body"><?php printf( '%s', $litho_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<?php } ?>
				<div class="pricing-footer">
					<?php Button_Group_Control::render_button_content( $this, 'primary' ); ?>
				</div>
			</div>
			<?php
		}
	}
}
