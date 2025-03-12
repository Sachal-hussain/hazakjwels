<?php
/**
 * Metabox Map
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'litho_meta_box_text' ) ) {
	function litho_meta_box_text( $litho_id, $litho_label, $litho_desc = '', $litho_short_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . $litho_desc . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<input type="text" id="' . esc_attr( $litho_id ) . '" name="' . esc_attr( $litho_id ) . '" value="' . get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) . '" />';
		if ( $litho_short_desc ) {
			$html .= '<span class="short-description">' . esc_attr( $litho_short_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_dropdown' ) ) {
	function litho_meta_box_dropdown( $litho_id, $litho_label, $litho_options, $litho_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.

		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<select id="' . esc_attr( $litho_id ) . '" name="' . esc_attr( $litho_id ) . '">';
		if ( ! empty( $litho_options ) ) {
			foreach ( $litho_options as $key => $option ) {
				if ( get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) == (string) $key && get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) != '' ) {
					$litho_selected = ' selected="selected"';
				} else {
					$litho_selected = '';
				}

				$html .= '<option' . $litho_selected . ' value="' . esc_attr( $key ) . '">' . esc_attr( $option ) . '</option>';
			}
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_dropdown_multiple' ) ) {
	function litho_meta_box_dropdown_multiple( $litho_id, $litho_label, $litho_options, $litho_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$litho_get_post_meta = get_post_meta( $post->ID, $meta_prefix . $litho_id, true );

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<select class="litho-dropdown-select2" id="' . esc_attr( $litho_id ) . '" name="' . esc_attr( $litho_id ) . '[]" multiple="multiple" style="width:35%;max-width:25em;">';
		if ( ! empty( $litho_options ) ) {
			foreach ( $litho_options as $key => $option ) {
				$litho_selected = ( is_array( $litho_get_post_meta ) && in_array( $key, $litho_get_post_meta ) ) ? ' selected="selected"' : '';
				$html          .= '<option' . $litho_selected . ' value="' . esc_attr( $key ) . '">' . esc_attr( $option ) . '</option>';
			}
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_dropdown_sidebar' ) ) {
	function litho_meta_box_dropdown_sidebar( $litho_id, $litho_label, $litho_options, $litho_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<select id="' . esc_attr( $litho_id ) . '" name="' . esc_attr( $litho_id ) . '">';
		if ( ! empty( $litho_options ) ) {
			foreach ( $litho_options as $key => $option ) {
				if ( get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) == $key && get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) != '' ) {
					$litho_selected = ' selected="selected"';
				} else {
					$litho_selected = '';
				}

				$html .= '<option' . $litho_selected . ' value="' . esc_attr( $key ) . '">' . esc_attr( $option ) . '</option>';
			}
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_textarea' ) ) {
	function litho_meta_box_textarea( $litho_id, $litho_label, $litho_desc = '', $litho_default = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$litho_value     = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value; 
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';

		if ( get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) ) {
			$litho_value = get_post_meta( $post->ID, $meta_prefix . $litho_id, true );
		}

		$html .= '<div class="right-part">';
		$html .= '<textarea cols="120" id="' . esc_attr( $litho_id ) . '" name="' . esc_attr( $litho_id ) . '">' . $litho_value . '</textarea>';
		$html .= '</div>';
		$html .= '</div>';

		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_upload' ) ) {
	function litho_meta_box_upload( $litho_id, $litho_label, $litho_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val = array();

			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';

		$litho_meta_box_upload_img_src = get_post_meta( $post->ID, $meta_prefix . $litho_id, true );
		$litho_meta_box_upload_img_id  = get_post_meta( $post->ID, $meta_prefix . $litho_id . '_id', true );

		$html .= '<input name="' . $litho_id . '" class="upload_field" type="text" value="' . $litho_meta_box_upload_img_src . '" />';
		$html .= '<input name="' . $litho_id . '_id" class="' . $litho_id . '_id" id="' . $litho_id . '_id" type="hidden" value="' . $litho_meta_box_upload_img_id . '" />';
		$html .= '<img class="upload_image_screenshort" src="' . $litho_meta_box_upload_img_src . '" />';
		$html .= '<input class="litho_upload_button" id="litho_upload_button" type="button" value="' . esc_attr__( 'Browse', 'litho-addons' ) . '" />';
		$html .= '<span class="litho_remove_button button">' . esc_html__( 'Remove', 'litho-addons' ) . '</span>';
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_upload_multiple' ) ) {
	function litho_meta_box_upload_multiple( $litho_id, $litho_label, $litho_desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . esc_attr( $litho_id ) . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $litho_label;
		if ( $litho_desc ) {
			$html .= '<span class="description">' . esc_attr( $litho_desc ) . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<input name="' . esc_attr( $litho_id ) . '" class="upload_field upload_field_multiple" id="litho_upload" type="hidden" value="' . get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) . '" />';
		$html .= '<div class="multiple_images">';

		$litho_val = explode( ',', get_post_meta( $post->ID, $meta_prefix . $litho_id, true ) );

		foreach ( $litho_val as $key => $value ) {
			if ( ! empty( $value ) ) {
				$litho_image_url = wp_get_attachment_url( $value, 'full' );

				$html .= '<div id=' . esc_attr( $value ) . '>';
				$html .= '<img class="upload_image_screenshort_multiple" src="' . esc_url( $litho_image_url ) . '" style="width:100px;" />';
				$html .= '<a href="javascript:void(0)" class="remove">' . esc_html__( 'Remove', 'litho-addons' ) . '</a>';
				$html .= '</div>';
			}
		}
		$html .= '</div>';
		$html .= '<input class="litho_upload_button_multiple" id="litho_upload_button_multiple" type="button" value="' . esc_attr__( 'Browse', 'litho-addons' ) . '" />' . esc_html__( 'Select Files', 'litho-addons' );
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_colorpicker' ) ) {
	function litho_meta_box_colorpicker( $id, $label, $desc = '', $litho_dependency = '' ) {

		global $post;

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();
		$meta_prefix     = '_';

		if ( ! empty( $litho_dependency ) ) {
			$val = array();

			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . $id . '_box description_box"' . $dependency_attr . '>';
		$html .= '<div class="left-part">';
		$html .= $label;
		if ( $desc ) {
			$html .= '<span class="description">' . $desc . '</span>';
		}
		$html .= '</div>';
		$html .= '<div class="right-part">';
		$html .= '<input type="text" class="litho-color-picker" id="' . $id . '" name="' . $id . '" value="' . get_post_meta( $post->ID, $meta_prefix . $id, true ) . '" />';
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'litho_meta_box_separator' ) ) {
	function litho_meta_box_separator( $id, $label, $desc = '', $short_desc = '', $litho_dependency = '' ) {

		// Meta Prefix.
		$dependency_attr = '';
		$html            = '';
		$dependency_arr  = array();

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"';
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		$html .= '<div class="' . $id . '_box separator_box"' . $dependency_attr . '>';
		$html .= '<div class="meta-heading-separator">';
		$html .= '<h3>' . $label . '</h3>';
		if ( $desc ) {
			$html .= '<span class="description">' . $desc . '</span>';
		}
		$html .= '</div>';
		$html .= '</div>';
		echo sprintf( '%s', $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Meta Box Main Wrap Start.
if ( ! function_exists( 'litho_after_main_separator_start' ) ) {
	function litho_after_main_separator_start( $id, $litho_dependency = '' ) {

		$dependency_attr = '';
		$dependency_arr  = array();

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		echo '<div class="' . $id . '_main_content_wrap"' . $dependency_attr . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Meta Box Inner Wrap Start.
if ( ! function_exists( 'litho_after_inner_separator_start' ) ) {
	function litho_after_inner_separator_start( $id, $litho_dependency = '' ) {

		$dependency_attr = '';
		$dependency_arr  = array();

		if ( ! empty( $litho_dependency ) ) {
			$val              = array();
			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		echo '<div class="' . $id . '_content_wrap"' . $dependency_attr . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// Meta Box Inner Wrap End.
if ( ! function_exists( 'litho_before_inner_separator_end' ) ) {
	function litho_before_inner_separator_end( $id, $litho_dependency = '' ) {

		$dependency_attr = '';
		$dependency_arr  = array();

		if ( ! empty( $litho_dependency ) ) {
			$val = array();

			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$dependency_attr  = implode( ' ', $dependency_arr );
		}

		echo '</div>';
	}
}

// Meta Box Main Wrap End.
if ( ! function_exists( 'litho_before_main_separator_end' ) ) {
	function litho_before_main_separator_end( $id, $litho_dependency = '' ) {

		$dependency_attr = '';
		$dependency_arr  = array();

		if ( ! empty( $litho_dependency ) ) {
			$val = array();

			$dependency_arr[] = 'data-element="' . $litho_dependency['element'] . '"';
			foreach ( $litho_dependency['value'] as $key => $value ) {
				$val[] = $value;
			}
			$dep_list         = implode( ',', $val );
			$dependency_arr[] = 'data-value="' . $dep_list . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$dependency_attr  = implode( ' ', $dependency_arr );
		}
		echo '</div>';
	}
}
