<?php
namespace LithoAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use LithoAddons\Controls\Groups\Text_Gradient_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 *
 * Litho widget for text rotator.
 *
* @package Litho
 */

// If class `Text_Rotator` doesn't exists yet.
if ( ! class_exists( 'LithoAddons\Widgets\Text_Rotator' ) ) {

	class Text_Rotator extends Widget_Base {

		public function __construct( $data = [], $args = null ) {
			
			parent::__construct( $data, $args );

			wp_register_style(
				'rotate-text',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/css/rotate-text.css',
				[],
				LITHO_ADDONS_PLUGIN_VERSION
			);
		}

		/**
		 * Retrieve the list of styles the drop cap widget depended on.
		 *
		 * Used to set styles dependencies required to run the widget.
		 *
		 *
		 * @access public
		 *
		 * @return array Widget styles dependencies.
		 */
		public function get_style_depends() {
			return [ 'rotate-text' ];
		}

		/**
		 * Get widget name.
		 *
		 * Retrieve text rotator widget name.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget name.
		 */
		public function get_name() {
			return 'litho-text-rotator';
		}

		/**
		 * Get widget title.
		 *
		 * Retrieve text rotator widget title.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget title.
		 */
		public function get_title() {
			return __( 'Litho Text Rotator', 'litho-addons' );
		}

		/**
		 * Get widget icon.
		 *
		 * Retrieve text rotator widget icon.
		 *
		 *
		 * @access public
		 *
		 * @return string Widget icon.
		 */
		public function get_icon() {
			return 'eicon-animation-text';
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
			return [ 'rotate', 'flip', 'animation', 'effect' ];
		}

		/**
		 * Register text rotator widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 *
		 * @access protected
		 */
		protected function register_controls() {
			
			$this->start_controls_section(
				'litho_text_rotate_content_section',
				[
					'label'		=> __( 'Content', 'litho-addons' ),
				]
			);
			$this->add_control(
				'litho_text_rotate_title',
				[
					'label' 	=> __( 'Title', 'litho-addons' ),
					'type' 		=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 	=> '',
					'label_block' => true,
				]
			);
			$repeater = new Repeater();
			$repeater->add_control(
				'litho_text_rotate_text',
				[
					'label' 	=> __( 'Add text here', 'litho-addons' ),
					'type' 		=> Controls_Manager::TEXT,
					'dynamic' 		=> [
						'active' 	=> true,
					],
					'default' 	=> '',
					'label_block' => true,
				]
			);
			$this->add_control(
				'litho_text_rotate_items',
				[
					'label' 		=> __( 'Custom Text', 'litho-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'fields' 		=> $repeater->get_controls(),
					'default' 		=> [
						[
							'litho_text_rotate_text' => __( 'Add text here', 'litho-addons' ),
						],
					],
					'title_field'	=> '{{{ litho_text_rotate_text }}}',
				]
			);       	
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_text_rotate_settings_section',
				[
					'label'         => __( 'Settings', 'litho-addons' ),
				]
			);

			$this->add_control(
				'litho_text_rotate_animation',
				[
					'label'         => __( 'Animation Type', 'litho-addons' ),
					'type'          => Controls_Manager::SELECT,
					'default'       => 'slide',
					'description'	=> __( 'Changes will be reflected in the preview only after the page reload.', 'litho-addons' ),
					'options'       => [
						'slide'     	=> __( 'Slide', 'litho-addons' ),
						'loading-bar'   => __( 'Loading Bar', 'litho-addons' ),
						'clip'     		=> __( 'Clip', 'litho-addons' ),
						'zoom'     		=> __( 'Zoom', 'litho-addons' ),
						'scale'     	=> __( 'Scale', 'litho-addons' ),
						'push'     		=> __( 'Push', 'litho-addons' ),
						'type'     		=> __( 'Type', 'litho-addons' ),
						'rotate-1'      => __( 'Rotate 1', 'litho-addons' ),
						'rotate-2'     	=> __( 'Rotate 2', 'litho-addons' ),
						'rotate-3'     	=> __( 'Rotate 3', 'litho-addons' ),
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'litho_text_rotate_title_style_section',
				[
					'label' 		=> __( 'Title', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_text_align',
				[
					'label'     => __( 'Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						]
					],
					'selectors' => [
						'{{WRAPPER}} .cd-headline' => 'text-align: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'litho_text_rotate_title_typography',
					'global' => [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector' => '{{WRAPPER}} .cd-headline .title',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name' => 'litho_text_rotate_title_color',
					'selector' => '{{WRAPPER}} .cd-headline .title',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_rotate_title_shadow',
					'selector' 		=> '{{WRAPPER}} .cd-headline .title',
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_title_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .cd-headline .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_title_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .cd-headline .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_title_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'initial'		=> __( 'Initial', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'default'		=> '',
					'selectors'		=> [
						'{{WRAPPER}} .cd-headline .title' => 'display: {{VALUE}} !important;',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'litho_text_rotate_style_section',
				[
					'label' 		=> __( 'Text Rotator', 'litho-addons' ),
					'tab' 			=> Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_align',
				[
					'label'     => __( 'Alignment', 'litho-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'left'      => [
							'title'     => __( 'Left', 'litho-addons' ),
							'icon'      => 'eicon-text-align-left',
						],
						'center'    => [
							'title'     => __( 'Center', 'litho-addons' ),
							'icon'      => 'eicon-text-align-center',
						],
						'right'     => [
							'title'     => __( 'Right', 'litho-addons' ),
							'icon'      => 'eicon-text-align-right',
						]
					],
					'selectors' => [
						'{{WRAPPER}} .cd-words-wrapper' => 'text-align: {{VALUE}};',
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'		=> 'litho_text_rotate_typography',
					'global'	=> [
						'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
					],
					'selector'	=> '{{WRAPPER}} .cd-headline .text-rotator',
				]
			);
			$this->add_group_control(
				Text_Gradient_Background::get_type(),
				[
					'name'		=> 'litho_text_rotate_color',
					'selector'	=> '{{WRAPPER}} .cd-headline .text-rotator',
				]
			);
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				[
					'name' 			=> 'litho_text_rotate_shadow',
					'selector' 		=> '{{WRAPPER}} .cd-headline .text-rotator',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'          => 'litho_text_rotate_border',
					'selector'      => '{{WRAPPER}} .cd-headline .text-rotator',
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_padding',
				[
					'label' 		=> __( 'Padding', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .cd-headline .text-rotator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'		=> 'before'
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_margin',
				[
					'label' 		=> __( 'Margin', 'litho-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
					'selectors' 	=> [
						'{{WRAPPER}} .cd-headline .text-rotator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'litho_text_rotate_display_settings' ,
				[
					'label'        	=> __( 'Display', 'litho-addons' ),
					'type'         	=> Controls_Manager::SELECT,
					'options' 		=> [
						''	 			=> __( 'Default', 'litho-addons' ),
						'block' 		=> __( 'Block', 'litho-addons' ),
						'inline' 		=> __( 'Inline', 'litho-addons' ),
						'inline-block' 	=> __( 'Inline Block', 'litho-addons' ),
						'initial'		=> __( 'Initial', 'litho-addons' ),
						'none' 			=> __( 'None', 'litho-addons' ),
					],
					'default'		=> '',
					'selectors'		=> [
						'{{WRAPPER}} .cd-words-wrapper' => 'display: {{VALUE}} !important;',
					],
				]
			);
			$this->end_controls_section();
		}

		/**
		 * Render text rotator widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 *
		 * @access protected
		 */
		protected function render() {

			$litho_text_rotate_animation_class = '';
			$litho_text_rotate_class           = '';
			$settings                          = $this->get_settings_for_display();
			$litho_text_rotate_animation       = ( isset( $settings[ 'litho_text_rotate_animation' ] ) && ! empty( $settings[ 'litho_text_rotate_animation' ] ) ) ? $settings[ 'litho_text_rotate_animation' ] : '';
			$litho_text_rotate_title           = ( isset( $settings[ 'litho_text_rotate_title' ] ) && ! empty( $settings[ 'litho_text_rotate_title' ] ) ) ? $settings[ 'litho_text_rotate_title' ] : '';

			switch ( $litho_text_rotate_animation ) {
				case 'clip':
					$litho_text_rotate_animation_class = 'is-full-width ' . $litho_text_rotate_animation;
					break;
				case 'scale':
				case 'type':
				case 'rotate-2':
				case 'rotate-3':
					$litho_text_rotate_animation_class = 'letters ' . $litho_text_rotate_animation;
					break;
				default:
					$litho_text_rotate_animation_class = $litho_text_rotate_animation;
					break;
			}

			$this->add_render_attribute( 'headline', 'class', [ 'cd-headline', $litho_text_rotate_animation_class ] );
			$this->add_render_attribute( 'wrapper', 'class', [ 'cd-words-wrapper', $litho_text_rotate_class ] );
			?>
			<h5 <?php $this->print_render_attribute_string( 'headline' ); ?>>
				<?php if ( ! empty( $litho_text_rotate_title ) ) { ?>
					<span class="title"><?php echo esc_html( $litho_text_rotate_title ); ?></span>
				<?php } ?>
				<span <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
					<?php
					$litho_active = true;
					foreach ( $settings['litho_text_rotate_items'] as $index => $item ) {
						$litho_visible_class = ( true === $litho_active ) ? 'is-visible' : '';
						$this->add_render_attribute( $index, 'class', [
							'text-rotator',
							$litho_visible_class
						] );
						?>
						<?php if ( isset( $item[ 'litho_text_rotate_text' ] ) && ! empty( $item[ 'litho_text_rotate_text' ] ) ) { ?>
							<b <?php $this->print_render_attribute_string( $index ); ?>><?php echo sprintf( '%s', $item[ 'litho_text_rotate_text' ] );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></b>
						<?php } ?>
						<?php
						$litho_active = false;
					}
					?>
				</span>
			</h5>
			<?php
		}
	}
}
