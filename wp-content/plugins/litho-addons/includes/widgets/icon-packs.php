<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;
use LithoAddons\Custom_icons\Render_custom_icons_html;
use LithoAddons\Controls\Icon_Hover_Animation;
use LithoAddons\Controls\Groups\Column_Group_Control;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litho widget for icon packs
 *
 * @package Litho
 */
class Icon_Packs extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon packs widget name.
	 *
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'litho-icon-packs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon packs widget title.
	 *
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Litho Icon Packs', 'litho-addons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon packs widget icon.
	 *
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the widget categories.
	 *
	 *
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
	 *
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'library', 'list', 'icons', 'font' ];
	}

	/**
	 * Register icon packs widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 *
	 * @access protected
	 */
	protected function register_controls() {
		
		$this->start_controls_section(
			'litho_icon_packs_section',
			[
				'label' 		=> __( 'General', 'litho-addons' ),
			]
		);
		$this->add_control(
			'litho_icons_packs',
			[
				'label'       	=> __( 'Select Icons library', 'litho-addons' ),
				'type'        	=> Controls_Manager::SELECT,
				'default'     	=> 'etline',
				'options'     	=> [
					'iconsmind-line'		=> __( 'Iconsmind line', 'litho-addons' ),
					'iconsmind-solid'		=> __( 'Iconsmind solid', 'litho-addons' ),
					'feather'				=> __( 'Feather', 'litho-addons' ),
					'fontawsome'			=> __( 'Fontawsome', 'litho-addons' ),
					'etline'				=> __( 'Etline', 'litho-addons' ),
					'themify'				=> __( 'Themify', 'litho-addons' ),
					'simpleline'			=> __( 'Simpleline', 'litho-addons' ),
				],
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'litho_fontawsome_brands',
			[
				'label'       	=> __( 'Brands', 'litho-addons' ),
				'type'        	=> Controls_Manager::SWITCHER,
				'default'       => 'brands',
				'label_off'     => __( 'No', 'litho-addons' ),
				'label_on'      => __( 'Yes', 'litho-addons' ),
				'return_value'  => 'brands',
				'condition'     => [
					'litho_icons_packs' => 'fontawsome', // IN
				],
			]
		);
		$this->add_control(
			'litho_fontawsome_regular',
			[
				'label'       	=> __( 'Regular', 'litho-addons' ),
				'type'        	=> Controls_Manager::SWITCHER,
				'default'       => 'regular',
				'label_off'     => __( 'No', 'litho-addons' ),
				'label_on'      => __( 'Yes', 'litho-addons' ),
				'return_value'  => 'regular',
				'condition'     => [
					'litho_icons_packs' => 'fontawsome', // IN
				],
			]
		);
		$this->add_control(
			'litho_fontawsome_solid',
			[
				'label'       	=> __( 'Solid', 'litho-addons' ),
				'type'        	=> Controls_Manager::SWITCHER,
				'default'       => 'solid',
				'label_off'     => __( 'No', 'litho-addons' ),
				'label_on'      => __( 'Yes', 'litho-addons' ),
				'return_value'  => 'solid',
				'condition'     => [
					'litho_icons_packs' => 'fontawsome', // IN
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'litho_icon_packs_settings_section',
			[
				'label' 		=> __( 'Settings', 'litho-addons' ),
			]
		);
		$this->add_group_control(
			Column_Group_Control::get_type(),
			[
				'name'		=> 'litho_column_settings'
			]
		);
		$this->add_responsive_control(
			'litho_columns_gap',
			[
				'label' 	=> __( 'Columns Gap', 'litho-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
						'px' => [
							'min'	=> 0,
							'max'	=> 100,
							'step'	=> 1,
						]
				],
				'selectors' => [
					'{{WRAPPER}} .grid-gutter' => 'padding: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'litho_icons_general_section_style',
			[
				'label' 		=> __( 'General', 'litho-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'litho_icon_content_box_tabs' );
			$this->start_controls_tab( 'litho_icon_content_box_normal_tab', [ 'label' => __( 'Normal', 'litho-addons' ) ] );
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'			=> 'litho_icon_content_box_color',
						'types'			=> [ 'classic', 'gradient' ],
						'exclude'		=> [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'		=> '{{WRAPPER}} .icon-box-inner',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_icon_content_box_shadow',
						'selector' 		=> '{{WRAPPER}} .icon-box-inner',
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab( 'litho_icon_content_box_hover_tab', [ 'label' => __( 'Hover', 'litho-addons' ) ] );
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'              => 'litho_icon_content_box_bg_hover_color',
						'types'             => [ 'classic', 'gradient' ],
						'exclude'           => [
							'image',
							'position',
							'attachment',
							'attachment_alert',
							'repeat',
							'size',
						],
						'selector'      => '{{WRAPPER}} .icon-box:hover .icon-box-inner',
					]
				);
				$this->add_control(
					'litho_icon_content_box_border_hover_color',
					[
						'label'     => __( 'Border Color', 'litho-addons' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .icon-box:hover .icon-box-inner' => 'border-color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' 			=> 'litho_icon_content_hover_box_shadow',
						'selector' 		=> '{{WRAPPER}} .icon-box:hover .icon-box-inner',
					]
				);
				$this->add_control(
					'litho_hover_animation',
					[
						'label'         => __( 'Hover Animation', 'litho-addons' ),
						'type'          => Controls_Manager::HOVER_ANIMATION,
					]
				);
				$this->add_control(
					'litho_hover_transition',
					[
						'label'         => __( 'Transition Duration', 'litho-addons' ),
						'type'          => Controls_Manager::SLIDER,
						'default'       => [
							'size'          => 0.4,
						],
						'range'         => [
							'px'        => [
								'max'       => 3,
								'step'      => 0.1,
							],
						],
						'render_type'   => 'ui',
						'selectors'     => [
							'{{WRAPPER}} .icon-box' => 'transition-duration: {{SIZE}}s;-webkit-transition-duration: {{SIZE}}s;-moz-transition-duration: {{SIZE}}s;-ms-transition-duration: {{SIZE}}s',
						]
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'          => 'litho_icon_content_box_border',
				'selector'      => '{{WRAPPER}} .icon-box-inner',
				'fields_options' => [
					'border' 	=> [
						'separator' => 'before',
					],
				],
			]
		);
		$this->add_responsive_control(
			'litho_icon_content_box_border_radius',
			[
				'label'         => __( 'Border Radius', 'litho-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'custom' ],
				'selectors'     => [
					'{{WRAPPER}} .icon-box-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'litho_icon_packs_content_box_padding',
			[
				'label'         => __( 'Padding', 'litho-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'     => [
					'{{WRAPPER}} .icon-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'     => 'before'
			]
		);
		$this->add_responsive_control(
			'litho_icon_packs_content_box_margin',
			[
				'label'         => __( 'Margin', 'litho-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'     => [
					'{{WRAPPER}} .icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'litho_icons_section_style',
			[
				'label' 		=> __( 'Icon', 'litho-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Text_Gradient_Background::get_type(),
			[
				'name' 		=> 'litho_icon_color',
				'selector' => '{{WRAPPER}} .icon-box-icon i:before',
			]
		);
		$this->add_responsive_control(
			'litho_icon_size',
			[
				'label' 	=> __( 'Size', 'litho-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'litho_icon_space',
			[
				'label' 	=> __( 'Spacing', 'litho-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
						'size' => 20,
				],
				'range' 	=> [
					'px' 	=> [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-icon'	=> 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'litho_rotate',
			[
				'label' 	=> __( 'Rotate', 'litho-addons' ),
				'type' 		=> Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .icon-box-icon i' => 'transform: rotate({{SIZE}}deg);',
				],
				'condition'     => [
					'litho_icon_hover_animation' => '',
				],
			]
		);
		$this->add_control(
			'litho_icon_hover_animation',
			[
				'label'       	=> __( 'Hover Animation', 'litho-addons' ),
				'type'        	=> 'icon-hover-animation',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'litho_icon_text_section_style',
			[
				'label' 		=> __( 'Icon Text', 'litho-addons' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'litho_icon_text_typography',
				'selector' 		=> '{{WRAPPER}} .icon-box-content span',
			]
		);
		$this->add_control(
			'litho_icon_text_color',
			[
				'label' 		=> __( 'Color', 'litho-addons' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .icon-box-content span' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render icon packs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 *
	 * @access protected
	 */
	protected function render() {

		$settings                 = $this->get_settings_for_display();
		$litho_icons_packs        = $this->get_settings( 'litho_icons_packs' );
		$litho_fontawsome_brands  = $this->get_settings( 'litho_fontawsome_brands' );
		$litho_fontawsome_regular = $this->get_settings( 'litho_fontawsome_regular' );
		$litho_fontawsome_solid   = $this->get_settings( 'litho_fontawsome_solid' );

		/* Column Settings */
		$litho_column_class      = array();
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_larger_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_larger_desktop_column' ] : 'grid-3col';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_large_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_large_desktop_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_desktop_column' ] ) ? $settings[ 'litho_column_settings_litho_desktop_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_tablet_column' ] ) ? $settings[ 'litho_column_settings_litho_tablet_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_landscape_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_landscape_phone_column' ] : '';
		$litho_column_class[]    = ! empty( $settings[ 'litho_column_settings_litho_portrait_phone_column' ] ) ? $settings[ 'litho_column_settings_litho_portrait_phone_column' ] : '';
		$litho_column_class      = array_filter( $litho_column_class );
		$litho_column_class_list = implode( ' ', $litho_column_class );
		/* End Column Settings */
		
		if ( empty( $litho_icons_packs ) ) {
			return;
		}

		$this->add_render_attribute(
			'wrapper',
			[
				'class' => [
					'icons-pack-wrapper',
					'grid',
					$litho_column_class_list,
				],
			]
		);
		?>
		<ul <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php
			$prefix         = '';
			$display_prefix = '';

			switch ( $litho_icons_packs ) {
				case 'themify':
					$prefix      = 'ti-';
					$library_key = $litho_icons_packs;
					$this->litho_get_icons_content( $prefix, $library_key, $display_prefix );
					break;
				case 'fontawsome':
					$prefix         = 'fa-';
					if ( 'brands' === $litho_fontawsome_brands ) {
						$library_key    = $prefix . $litho_fontawsome_brands;
						$display_prefix = 'fa-brands ';
						$this->litho_get_icons_content( $prefix, $library_key, $display_prefix );
					}
					if ( 'regular' === $litho_fontawsome_regular ) {
						$library_key    = $prefix . $litho_fontawsome_regular;
						$display_prefix = 'fa-regular ';
						$this->litho_get_icons_content( $prefix, $library_key, $display_prefix );
					}
					if ( 'solid' === $litho_fontawsome_solid ) {
						$library_key    = $prefix . $litho_fontawsome_solid;
						$display_prefix = 'fa-solid ';
						$this->litho_get_icons_content( $prefix, $library_key, $display_prefix );
					}
					break;
				default:
					$library_key = $litho_icons_packs;
					$this->litho_get_icons_content( $prefix, $library_key, $display_prefix );
					break;
			}
			?>
		</ul>
		<?php
	}

	// Get icons list
	public function litho_get_icons_content( $prefix, $library_key, $display_prefix ) {

		$settings                   = $this->get_settings_for_display();
		$litho_hover_animation      = ( isset( $settings['litho_hover_animation'] ) && $settings['litho_hover_animation'] ) ? ' hvr-' . $settings['litho_hover_animation'] : '';
		$litho_icon_hover_animation = ( isset( $settings['litho_icon_hover_animation'] ) && $settings['litho_icon_hover_animation'] ) ? ' hvr-' . $settings['litho_icon_hover_animation'] : '';
		$litho_icons                = Render_custom_icons_html::render_icon( $library_key );

		if ( ! empty( $litho_icons ) ) {
			$i = 0;
			foreach ( (array) $litho_icons as $key => $value ) {
				$hvr_icon = '';
				$icon_key = 'icon_' . $key;
				$value    = $prefix . $value;

				if ( ! empty( $litho_icon_hover_animation ) ) {
					$hvr_icon = ' hvr-icon';
				}
				?>
				<li class="icon-box grid-gutter<?php echo esc_attr( $litho_hover_animation ); ?>">
					<div class="icon-box-inner">
						<div class="icon-box-icon<?php echo esc_attr( $litho_icon_hover_animation ); ?>">
							<i class="<?php echo esc_attr( $display_prefix ) . esc_attr( $value ); ?><?php echo esc_attr( $hvr_icon ); ?>"></i>
						</div>
						<div class="icon-box-content">
							<span><?php echo esc_html( $value ); ?></span>
						</div>
					</div>
				</li>
				<?php
				$i++;
			}
		}
	}
}
