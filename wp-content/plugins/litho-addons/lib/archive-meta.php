<?php
/**
 * Post, Portfolio, Product category custom fields meta
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litho post category extra custom fields
 */

if ( ! function_exists( 'litho_category_add_meta_field' ) ) :
	function litho_category_add_meta_field() {

		// This will add the custom meta field to the add new term page.
		?>
		<div class="form-field">
			<label for="litho_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label>
			<input type="text" name="litho_archive_title_subtitle" id="litho_archive_title_subtitle" value="" class="category-custom-field-input">
		</div>
		<div class="form-field">
			<label for="litho_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label>
			<input name="litho_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="" />
			<input name="litho_archive_title_bg_image" class="litho_archive_title_bg_image_thumb" id="litho_archive_title_bg_image_thumb" type="hidden" value="" />
			<img class="upload_image_screenshort" src="" />
			<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
			<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
		</div>

		<div class="form-field">
			<label for="litho_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label>
			<input name="litho_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
			<div class="multiple_images">
			</div>
			<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
			<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label>
			<input type="text" name="litho_archive_title_video_mp4" id="litho_archive_title_video_mp4" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label>
			<input type="text" name="litho_archive_title_video_ogg" id="litho_archive_title_video_ogg" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label>
			<input type="text" name="litho_archive_title_video_webm" id="litho_archive_title_video_webm" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_archive_title_video_youtube"><?php echo esc_html__( 'External Video Url', 'litho-addons' ); ?></label>
			<input type="text" name="litho_archive_title_video_youtube" id="litho_archive_title_video_youtube" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<?php
	}
endif;
add_action( 'category_add_form_fields', 'litho_category_add_meta_field', 10, 2 );
add_action( 'post_tag_add_form_fields', 'litho_category_add_meta_field', 10, 2 );

if ( ! function_exists( 'litho_taxonomy_edit_meta_field' ) ) :
	function litho_taxonomy_edit_meta_field( $term ) {

		// Put the term ID into a variable.
		$litho_t_id                            = $term->term_id;
		$litho_archive_title_subtitle          = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_subtitle', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_subtitle', true ) : '';
		$litho_archive_title_bg_image          = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_bg_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_bg_image', true ) : '';
		$litho_archive_title_bg_multiple_image = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_bg_multiple_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_bg_multiple_image', true ) : '';
		$litho_archive_title_video_mp4         = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_video_mp4', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_video_mp4', true ) : '';
		$litho_archive_title_video_ogg         = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_video_ogg', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_video_ogg', true ) : '';
		$litho_archive_title_video_webm        = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_video_webm', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_video_webm', true ) : '';
		$litho_archive_title_video_youtube     = ! empty( get_term_meta( $litho_t_id, 'litho_archive_title_video_youtube', true ) ) ? get_term_meta( $litho_t_id, 'litho_archive_title_video_youtube', true ) : '';
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_archive_title_subtitle" id="litho_archive_title_subtitle" value="<?php echo esc_attr( $litho_archive_title_subtitle ); ?>" class="category-custom-field-input">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label></th>
			<td>
				<input name="litho_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="<?php echo esc_url( $litho_archive_title_bg_image ); ?>" />
				<input name="litho_archive_title_bg_image" class="litho_archive_title_bg_image_thumb" id="litho_archive_title_bg_image_thumb" type="hidden" value="<?php echo esc_url( $litho_archive_title_bg_image ); ?>" />
				<img class="upload_image_screenshort" <?php echo esc_url( $litho_archive_title_bg_image ); ?> />
				<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
				<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label></th>
			<td>
				<input name="litho_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
				<div class="multiple_images">
					<?php
					$litho_val = explode( ',', $litho_archive_title_bg_multiple_image );
					foreach ( $litho_val as $key => $value ) {
						if ( ! empty( $value ) ) :
							$litho_image_url   = wp_get_attachment_url( $value );
							$litho_img_alt     = litho_option_image_alt( $value );
							$litho_img_title   = litho_option_image_title( $value );
							$litho_image_alt   = ! empty( $litho_img_alt['alt'] ) ? ' alt="' . esc_attr( $litho_img_alt['alt'] ) . '"' : ' alt="' . esc_attr__( 'Image', 'litho-addons' ) . '"';
							$litho_image_title = ! empty( $litho_img_title['title'] ) ? ' title="' . esc_attr( $litho_img_title['title'] ) . '"' : '';

							echo '<div id=' . esc_attr( $value ) . '>';
								echo '<img class="upload_image_screenshort_multiple width-100px"' . $litho_image_alt . $litho_image_title . ' src="' . esc_url( $litho_image_url ) . '" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo '<a href="javascript:void(0)" class="remove">' . esc_html__( 'Remove', 'litho-addons' ) . '</a>';
							echo '</div>';
						endif;
					}
					?>
				</div>
				<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_attr__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
				<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_archive_title_video_mp4" id="litho_archive_title_video_mp4" value="<?php echo esc_attr( $litho_archive_title_video_mp4 ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_archive_title_video_ogg" id="litho_archive_title_video_ogg" value="<?php echo esc_attr( $litho_archive_title_video_ogg ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_archive_title_video_webm" id="litho_archive_title_video_webm" value="<?php echo esc_attr( $litho_archive_title_video_webm ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_archive_title_video_youtube"><?php echo esc_html__( 'External Video Url', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_archive_title_video_youtube" id="litho_archive_title_video_youtube" value="<?php echo esc_attr( $litho_archive_title_video_youtube ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<?php
	}
endif;
add_action( 'category_edit_form_fields', 'litho_taxonomy_edit_meta_field', 10, 2 );
add_action( 'post_tag_edit_form_fields', 'litho_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'litho_save_taxonomy_custom_meta' ) ) :
	function litho_save_taxonomy_custom_meta( $litho_term_id ) {
		$litho_t_id = $litho_term_id;
		if ( isset( $_POST['litho_archive_title_subtitle'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_subtitle', $_POST['litho_archive_title_subtitle'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_bg_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_bg_image', $_POST['litho_archive_title_bg_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_bg_multiple_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_bg_multiple_image', $_POST['litho_archive_title_bg_multiple_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_video_mp4'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_video_mp4', $_POST['litho_archive_title_video_mp4'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_video_ogg'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_video_ogg', $_POST['litho_archive_title_video_ogg'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_video_webm'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_video_webm', $_POST['litho_archive_title_video_webm'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_archive_title_video_youtube'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_archive_title_video_youtube', $_POST['litho_archive_title_video_youtube'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
	}
endif;
add_action( 'edited_category', 'litho_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_category', 'litho_save_taxonomy_custom_meta', 10, 2 );
add_action( 'edited_post_tag', 'litho_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_post_tag', 'litho_save_taxonomy_custom_meta', 10, 2 );

/**
 * Litho portfolio category extra custom fields
 */

if ( ! function_exists( 'litho_portfolio_category_add_meta_field' ) ) :
	function litho_portfolio_category_add_meta_field() {

		// This will add the custom meta field to the add new term page.
		?>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label>
			<input type="text" name="litho_portfolio_archive_title_subtitle" id="litho_portfolio_archive_title_subtitle" value="" class="category-custom-field-input">
		</div>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label>
			<input name="litho_portfolio_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="" />
			<input name="litho_portfolio_archive_title_bg_image" class="litho_portfolio_archive_title_bg_image_thumb" id="litho_portfolio_archive_title_bg_image_thumb" type="hidden" value="" />
			<img class="upload_image_screenshort" src="" />
			<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
			<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
		</div>

		<div class="form-field">
			<label for="litho_portfolio_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label>
			<input name="litho_portfolio_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
			<div class="multiple_images">
			</div>
			<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
			<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label>
			<input type="text" name="litho_portfolio_archive_title_video_mp4" id="litho_portfolio_archive_title_video_mp4" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label>
			<input type="text" name="litho_portfolio_archive_title_video_ogg" id="litho_portfolio_archive_title_video_ogg" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label>
			<input type="text" name="litho_portfolio_archive_title_video_webm" id="litho_portfolio_archive_title_video_webm" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<div class="form-field">
			<label for="litho_portfolio_archive_title_video_youtube"><?php echo esc_html__( 'External Video URL', 'litho-addons' ); ?></label>
			<input type="text" name="litho_portfolio_archive_title_video_youtube" id="litho_portfolio_archive_title_video_youtube" value="" class="category-custom-field-input">
			<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
		</div>
		<?php
	}
endif;
add_action( 'portfolio-category_add_form_fields', 'litho_portfolio_category_add_meta_field', 10, 2 );
add_action( 'portfolio-tags_add_form_fields', 'litho_portfolio_category_add_meta_field', 10, 2 );

if ( ! function_exists( 'litho_portfolio_taxonomy_edit_meta_field' ) ) :
	function litho_portfolio_taxonomy_edit_meta_field( $term ) {

		$litho_t_id                                      = $term->term_id;
		$litho_portfolio_archive_title_subtitle          = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_subtitle', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_subtitle', true ) : '';
		$litho_portfolio_archive_title_bg_image          = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_image', true ) : '';
		$litho_portfolio_archive_title_bg_multiple_image = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_multiple_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_multiple_image', true ) : '';
		$litho_portfolio_archive_title_video_mp4         = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_mp4', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_mp4', true ) : '';
		$litho_portfolio_archive_title_video_ogg         = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_ogg', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_ogg', true ) : '';
		$litho_portfolio_archive_title_video_webm        = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_webm', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_webm', true ) : '';
		$litho_portfolio_archive_title_video_youtube     = ! empty( get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_youtube', true ) ) ? get_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_youtube', true ) : '';
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_portfolio_archive_title_subtitle" id="litho_portfolio_archive_title_subtitle" value="<?php echo esc_attr( $litho_portfolio_archive_title_subtitle ); ?>" class="category-custom-field-input">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label></th>
			<td>
				<input name="litho_portfolio_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="<?php echo esc_url( $litho_portfolio_archive_title_bg_image ); ?>" />
				<input name="litho_portfolio_archive_title_bg_image" class="litho_portfolio_archive_title_bg_image_thumb" id="litho_portfolio_archive_title_bg_image_thumb" type="hidden" value="<?php echo esc_url( $litho_portfolio_archive_title_bg_image ); ?>" />
				<img class="upload_image_screenshort" <?php echo esc_url( $litho_portfolio_archive_title_bg_image ); ?> />

				<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
				<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label></th>
			<td>
				<input name="litho_portfolio_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
				<div class="multiple_images">
					<?php
					$litho_val = explode( ',', $litho_portfolio_archive_title_bg_multiple_image );
					foreach ( $litho_val as $key => $value ) {
						if ( ! empty( $value ) ) :
							$litho_image_url   = wp_get_attachment_url( $value );
							$litho_img_alt     = litho_option_image_alt( $value );
							$litho_img_title   = litho_option_image_title( $value );
							$litho_image_alt   = ! empty( $litho_img_alt['alt'] ) ? ' alt="' . esc_attr( $litho_img_alt['alt'] ) . '"' : ' alt="' . esc_attr__( 'Image', 'litho-addons' ) . '"';
							$litho_image_title = ! empty( $litho_img_title['title'] ) ? ' title="' . esc_attr( $litho_img_title['title'] ) . '"' : '';

							echo '<div id=' . esc_attr( $value ) . '>';
								echo '<img class="upload_image_screenshort_multiple width-100px"' . $litho_image_alt . $litho_image_title . ' src="' . esc_url( $litho_image_url ) . '" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo '<a href="javascript:void(0)" class="remove">' . esc_html__( 'Remove', 'litho-addons' ) . '</a>';
							echo '</div>';
						endif;
					}
					?>
				</div>
				<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_attr__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
				<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_portfolio_archive_title_video_mp4" id="litho_portfolio_archive_title_video_mp4" value="<?php echo esc_attr( $litho_portfolio_archive_title_video_mp4 ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_portfolio_archive_title_video_ogg" id="litho_portfolio_archive_title_video_ogg" value="<?php echo esc_attr( $litho_portfolio_archive_title_video_ogg ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_portfolio_archive_title_video_webm" id="litho_portfolio_archive_title_video_webm" value="<?php echo esc_attr( $litho_portfolio_archive_title_video_webm ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="litho_portfolio_archive_title_video_youtube"><?php echo esc_html__( 'External Video URL', 'litho-addons' ); ?></label></th>
			<td>
				<input type="text" name="litho_portfolio_archive_title_video_youtube" id="litho_portfolio_archive_title_video_youtube" value="<?php echo esc_attr( $litho_portfolio_archive_title_video_youtube ); ?>" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</td>
		</tr>
	<?php
	}
endif;
add_action( 'portfolio-category_edit_form_fields', 'litho_portfolio_taxonomy_edit_meta_field', 10, 2 );
add_action( 'portfolio-tags_edit_form_fields', 'litho_portfolio_taxonomy_edit_meta_field', 10, 2 );

if ( ! function_exists( 'litho_save_portfolio_taxonomy_custom_meta' ) ) :
	function litho_save_portfolio_taxonomy_custom_meta( $litho_term_id ) {

		$litho_t_id = $litho_term_id;

		if ( isset( $_POST['litho_portfolio_archive_title_subtitle'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_subtitle', $_POST['litho_portfolio_archive_title_subtitle'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_bg_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_image', $_POST['litho_portfolio_archive_title_bg_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_bg_multiple_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_bg_multiple_image', $_POST['litho_portfolio_archive_title_bg_multiple_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_video_mp4'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_mp4', $_POST['litho_portfolio_archive_title_video_mp4'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_video_ogg'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_ogg', $_POST['litho_portfolio_archive_title_video_ogg'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_video_webm'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_webm', $_POST['litho_portfolio_archive_title_video_webm'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['litho_portfolio_archive_title_video_youtube'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			update_term_meta( $litho_t_id, 'litho_portfolio_archive_title_video_youtube', $_POST['litho_portfolio_archive_title_video_youtube'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
	}
endif;
add_action( 'edited_portfolio-category', 'litho_save_portfolio_taxonomy_custom_meta', 10, 2 );
add_action( 'create_portfolio-category', 'litho_save_portfolio_taxonomy_custom_meta', 10, 2 );
add_action( 'edited_portfolio-tags', 'litho_save_portfolio_taxonomy_custom_meta', 10, 2 );
add_action( 'create_portfolio-tags', 'litho_save_portfolio_taxonomy_custom_meta', 10, 2 );

/**
 * Litho product category extra custom fields
 */

 /* if WooCommerce plugin is activated */
if ( is_woocommerce_activated() ) {

	if ( ! function_exists( 'litho_product_category_add_meta_field' ) ) :
		function litho_product_category_add_meta_field() {

			// This will add the custom meta field to the add new term page.
			?>
			<div class="form-field">
				<label for="litho_product_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label>
				<input type="text" name="litho_product_archive_title_subtitle" id="litho_product_archive_title_subtitle" value="" class="category-custom-field-input">
			</div>
			<div class="form-field">
				<label for="litho_product_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label>
				<input name="litho_product_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="" />
				<input name="litho_product_archive_title_bg_image" class="litho_product_archive_title_bg_image_thumb" id="litho_product_archive_title_bg_image_thumb" type="hidden" value="" />
				<img class="upload_image_screenshort" src="" />
				<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
				<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
			</div>

			<div class="form-field">
				<label for="litho_product_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label>
				<input name="litho_product_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
				<div class="multiple_images">	
				</div>
				<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
				<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
			</div>
			<div class="form-field">
				<label for="litho_product_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label>
				<input type="text" name="litho_product_archive_title_video_mp4" id="litho_product_archive_title_video_mp4" value="" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</div>
			<div class="form-field">
				<label for="litho_product_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label>
				<input type="text" name="litho_product_archive_title_video_ogg" id="litho_product_archive_title_video_ogg" value="" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</div>
			<div class="form-field">
				<label for="litho_product_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label>
				<input type="text" name="litho_product_archive_title_video_webm" id="litho_product_archive_title_video_webm" value="" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</div>
			<div class="form-field">
				<label for="litho_product_archive_title_video_youtube"><?php echo esc_html__( 'External Video URL', 'litho-addons' ); ?></label>
				<input type="text" name="litho_product_archive_title_video_youtube" id="litho_product_archive_title_video_youtube" value="" class="category-custom-field-input">
				<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
			</div>
			<?php
		}
	endif;
	add_action( 'product_cat_add_form_fields', 'litho_product_category_add_meta_field', 99, 2 );
	add_action( 'product_tag_add_form_fields', 'litho_product_category_add_meta_field', 99, 2 );

	if ( ! function_exists( 'litho_product_taxonomy_edit_meta_field' ) ) :
		function litho_product_taxonomy_edit_meta_field( $term ) {

			$litho_t_id                                    = $term->term_id;
			$litho_product_archive_title_subtitle          = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_subtitle', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_subtitle', true ) : '';
			$litho_product_archive_title_bg_image          = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_bg_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_bg_image', true ) : '';
			$litho_product_archive_title_bg_multiple_image = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_bg_multiple_image', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_bg_multiple_image', true ) : '';
			$litho_product_archive_title_video_mp4         = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_video_mp4', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_video_mp4', true ) : '';
			$litho_product_archive_title_video_ogg         = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_video_ogg', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_video_ogg', true ) : '';
			$litho_product_archive_title_video_webm        = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_video_webm', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_video_webm', true ) : '';
			$litho_product_archive_title_video_youtube     = ! empty( get_term_meta( $litho_t_id, 'litho_product_archive_title_video_youtube', true ) ) ? get_term_meta( $litho_t_id, 'litho_product_archive_title_video_youtube', true ) : '';
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_subtitle"><?php echo esc_html__( 'Subtitle', 'litho-addons' ); ?></label></th>
				<td>
					<input type="text" name="litho_product_archive_title_subtitle" id="litho_product_archive_title_subtitle" value="<?php echo esc_attr( $litho_product_archive_title_subtitle ); ?>" class="category-custom-field-input">
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_bg_image"><?php echo esc_html__( 'Background image', 'litho-addons' ); ?></label></th>
				<td>
					<input name="litho_product_archive_title_bg_image" class="upload_field" id="litho_upload" type="text" value="<?php echo esc_url( $litho_product_archive_title_bg_image ); ?>" />
					<input name="litho_product_archive_title_bg_image" class="litho_product_archive_title_bg_image_thumb" id="litho_product_archive_title_bg_image_thumb" type="hidden" value="<?php echo esc_url( $litho_product_archive_title_bg_image ); ?>" />
					<img class="upload_image_screenshort" <?php echo esc_url( $litho_product_archive_title_bg_image ); ?> />

					<input class="litho_upload_button_category" id="litho_upload_button_category" type="button" value="<?php echo esc_html__( 'Browse', 'litho-addons' ); ?>" />
					<span class="litho_remove_button_category button"><?php echo esc_html__( 'Remove', 'litho-addons' ); ?></span>
				</td>
			</tr>

			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_bg_multiple_image"><?php echo esc_html__( 'Background gallery images', 'litho-addons' ); ?></label></th>
				<td>
					<input name="litho_product_archive_title_bg_multiple_image" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="" />
					<div class="multiple_images">
						<?php
						$litho_val = explode( ',', $litho_product_archive_title_bg_multiple_image );
						foreach ( $litho_val as $key => $value ) {
							if ( ! empty( $value ) ) :

								$litho_image_url   = wp_get_attachment_url( $value );
								$litho_img_alt     = litho_option_image_alt( $value );
								$litho_img_title   = litho_option_image_title( $value );
								$litho_image_alt   = ! empty( $litho_img_alt['alt'] ) ? ' alt="' . esc_attr( $litho_img_alt['alt'] ) . '"' : ' alt="' . esc_attr__( 'Image', 'litho-addons' ) . '"';
								$litho_image_title = ! empty( $litho_img_title['title'] ) ? ' title="' . esc_attr( $litho_img_title['title'] ) . '"' : '';

								echo '<div id=' . esc_attr( $value ) . '>';
									echo '<img class="upload_image_screenshort_multiple width-100px"' . $litho_image_alt . $litho_image_title . ' src="' . esc_url( $litho_image_url ) . '" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									echo '<a href="javascript:void(0)" class="remove">' . esc_html__( 'Remove', 'litho-addons' ) . '</a>';
								echo '</div>';
							endif;
						}
						?>
					</div>
					<input class="litho_upload_button_multiple_category" id="litho_upload_button_multiple_category" type="button" value="<?php echo esc_attr__( 'Browse', 'litho-addons' ); ?>" /><?php echo esc_html__( 'Select Files', 'litho-addons' ); ?>
					<p class="description"><?php echo esc_html__( 'Use only for gallery background title style.', 'litho-addons' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_video_mp4"><?php echo esc_html__( 'MP4', 'litho-addons' ); ?></label></th>
				<td>
					<input type="text" name="litho_product_archive_title_video_mp4" id="litho_product_archive_title_video_mp4" value="<?php echo esc_attr( $litho_product_archive_title_video_mp4 ); ?>" class="category-custom-field-input">
					<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_video_ogg"><?php echo esc_html__( 'OGG', 'litho-addons' ); ?></label></th>
				<td>
					<input type="text" name="litho_product_archive_title_video_ogg" id="litho_product_archive_title_video_ogg" value="<?php echo esc_attr( $litho_product_archive_title_video_ogg ); ?>" class="category-custom-field-input">
					<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_video_webm"><?php echo esc_html__( 'WEBM', 'litho-addons' ); ?></label></th>
				<td>
					<input type="text" name="litho_product_archive_title_video_webm" id="litho_product_archive_title_video_webm" value="<?php echo esc_attr( $litho_product_archive_title_video_webm ); ?>" class="category-custom-field-input">
					<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="litho_product_archive_title_video_youtube"><?php echo esc_html__( 'External Video URL', 'litho-addons' ); ?></label></th>
				<td>
					<input type="text" name="litho_product_archive_title_video_youtube" id="litho_product_archive_title_video_youtube" value="<?php echo esc_attr( $litho_product_archive_title_video_youtube ); ?>" class="category-custom-field-input">
					<p class="description"><?php echo esc_html__( 'Use only for background video title style.', 'litho-addons' ); ?></p>
				</td>
			</tr>
			<?php
		}
	endif;
	add_action( 'product_cat_edit_form_fields', 'litho_product_taxonomy_edit_meta_field', 99, 2 );
	add_action( 'product_tag_edit_form_fields', 'litho_product_taxonomy_edit_meta_field', 99, 2 );

	if ( ! function_exists( 'litho_save_product_taxonomy_custom_meta' ) ) :
		function litho_save_product_taxonomy_custom_meta( $litho_term_id ) {

			$litho_t_id = $litho_term_id;

			if ( isset( $_POST['litho_product_archive_title_subtitle'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_subtitle', $_POST['litho_product_archive_title_subtitle'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_bg_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_bg_image', $_POST['litho_product_archive_title_bg_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_bg_multiple_image'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_bg_multiple_image', $_POST['litho_product_archive_title_bg_multiple_image'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_video_mp4'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_video_mp4', $_POST['litho_product_archive_title_video_mp4'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_video_ogg'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_video_ogg', $_POST['litho_product_archive_title_video_ogg'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_video_webm'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_video_webm', $_POST['litho_product_archive_title_video_webm'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
			if ( isset( $_POST['litho_product_archive_title_video_youtube'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				update_term_meta( $litho_t_id, 'litho_product_archive_title_video_youtube', $_POST['litho_product_archive_title_video_youtube'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			}
		}
	endif;
	add_action( 'edited_product_cat', 'litho_save_product_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_product_cat', 'litho_save_product_taxonomy_custom_meta', 10, 2 );
	add_action( 'edited_product_tag', 'litho_save_product_taxonomy_custom_meta', 10, 2 );
	add_action( 'create_product_tag', 'litho_save_product_taxonomy_custom_meta', 10, 2 );
}
