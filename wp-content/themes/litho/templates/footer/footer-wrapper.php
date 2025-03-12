<?php
/**
 * Footer Wrapper
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$litho_enable_header_general = litho_builder_customize_option( 'litho_enable_header_general', '1' );
$litho_enable_header         = litho_builder_option( 'litho_enable_header', '1', $litho_enable_header_general );
$litho_header_section_id     = litho_builder_option( 'litho_header_section', '', $litho_enable_header_general );
$litho_template_header_style = get_post_meta( $litho_header_section_id, '_litho_template_header_style', true );

if ( 'standard' === $litho_template_header_style ) {
	?>
		</div><!-- End .litho-main-content-wrap -->
	</div><!-- box-layout / page-layout -->
	<?php
	get_template_part( 'templates/footer/footer' );
} else {
	?>
	</div><!-- End .litho-main-content-wrap -->
			</div><!-- box-layout / page-layout -->
			<?php
			get_template_part( 'templates/footer/footer' );

			if ( ( 'left-menu-modern' == $litho_template_header_style ) && 1 == $litho_enable_header ) {
				?>
		</div><!-- End .page-wrapper -->
				<?php
			}
			if ( 'left-menu-classic' == $litho_template_header_style && 1 == $litho_enable_header ) {
				?>
			</div><!-- End .page-main-site-content -->
		</div><!-- End .left-sidebar-wrapper -->
				<?php
			}
}
