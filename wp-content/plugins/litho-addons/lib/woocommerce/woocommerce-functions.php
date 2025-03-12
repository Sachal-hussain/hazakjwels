<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Product alternate image
if ( ! function_exists( 'litho_product_alternate_image_content' ) ) :
	function litho_product_alternate_image_content( $post ) {

		$id               = 'product_alternate_image';
		$alternate_img_id = get_post_meta( $post->ID, '_litho_product_alternate_image_single', true );
		$nonce            = wp_create_nonce( $id . $post->ID );

		if ( $alternate_img_id ) {
			$link_title         = wp_get_attachment_image( $alternate_img_id, 'full', false, array( 'style' => 'width:100%;height:auto;', ) );
			$hide_remove_button = '';
		} else {
			$alternate_img_id   = -1;
			$link_title         = esc_html__( 'Add alternate product image', 'litho-addons' );
			$hide_remove_button = 'display: none;';
		}
		?>
		<p class="hide-if-no-js litho-product-alternate-image-container-<?php echo esc_attr( $id ); ?>">
			<a href="#" class="litho-product-alternate-add-media litho-alternate-media-edit litho-alternate-media-edit-<?php echo esc_attr( $id ); ?>" data-title="<?php esc_html_e( 'Alternate image', 'litho-addons' ); ?>" data-button="<?php esc_html_e( 'Use as alternate product image', 'litho-addons' ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" data-postid="<?php echo esc_attr( $post->ID ); ?>" style="display: inline-block;">
				<?php echo wp_kses_post( $link_title ); ?>
			</a>
		</p>

		<p class="hide-if-no-js howto" style="<?php echo esc_attr( $hide_remove_button ); ?>"><?php esc_html_e( 'Click the image to edit or update', 'litho-addons' ); ?></p>

		<p class="hide-if-no-js hide-if-no-image-<?php echo esc_attr( $id ); ?>" style="<?php echo esc_attr( $hide_remove_button ); ?>">
			<a href="#" class="litho-product-alternate-media-delete litho-product-alternate-media-delete-<?php echo esc_attr( $id ); ?>" data-title="<?php esc_html_e( 'Alternate image', 'litho-addons' ); ?>" data-button="<?php esc_html_e( 'Use as alternate product image', 'litho-addons' ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>" data-postid="<?php echo esc_attr( $post->ID ); ?>" data-label_set="<?php esc_html_e( 'Add alternate product image', 'litho-addons' ); ?>">
				<?php esc_html_e( 'Remove alternate product image', 'litho-addons' ); ?>
			</a>
		</p>
		<?php
	}
endif;

if ( ! function_exists( 'litho_add_meta_box' ) ) :
	function litho_add_meta_box() {

		add_meta_box( 'litho-product-alternate-image', esc_html__( 'Alternate image', 'litho-addons' ), 'litho_product_alternate_image_content', 'product', 'side', 'low' );
	}
endif;
add_action( 'add_meta_boxes', 'litho_add_meta_box' );

if ( ! function_exists( 'litho_ajax_set_product_alternate_image' ) ) :
	function litho_ajax_set_product_alternate_image() {

		$alt_img_id = intval( $_POST['alt_img_id'] );
		$postid     = intval( $_POST['postid'] );
		$id         = $_POST['id'];

		check_ajax_referer( $id . $postid, 'sec' );

		if ( wp_attachment_is_image( $alt_img_id ) ) {
			echo wp_get_attachment_image( $alt_img_id, 'full', false, array( 'style' => 'width:100%;height:auto;', ) );
			update_post_meta( $postid, '_litho_product_alternate_image_single', $alt_img_id );
		}

		wp_die();
	}
endif;

if ( ! function_exists( 'litho_ajax_remove_product_alternate_image' ) ) :
	function litho_ajax_remove_product_alternate_image() {

		$postid    = intval( $_POST['postid'] );
		$label_set = $_POST['label_set'];
		$id        = $_POST['id'];

		check_ajax_referer( $id . $postid, 'sec' );

		delete_post_meta( $postid, '_litho_product_alternate_image_single' );

		echo esc_attr( $label_set );

		wp_die();
	}
endif;

add_action( 'wp_ajax_set_product_alternate_image', 'litho_ajax_set_product_alternate_image' );
add_action( 'wp_ajax_remove_product_alternate_image', 'litho_ajax_remove_product_alternate_image' );
