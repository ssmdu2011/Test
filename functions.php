<?php

add_action(
    'init', function () {
        register_block_type(get_template_directory() . '/components/cards/block.json');
    }
);

/**
 * Enqueue theme styles
 */
function test_theme() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/custom.css');
 }
 add_action( 'wp_enqueue_scripts', 'test_theme' );


/* ACF helper function*/
 function get_the_attr( ? array $attributes = array() ): string {
	if ( ! is_array( $attributes ) || empty( $attributes ) ) {
		return '';
	}
	$output = '';
	foreach ( $attributes as $attribute => $value ) {
		if ( 'class' === $attribute && is_array( $value ) ) {
			$value = implode( ' ', $value );
		}
		$output .= is_bool( $value ) ? true === $value ? " {$attribute}" : '' : " {$attribute}=\"{$value}\"";
	}
	return trim( $output );
}

function the_attr( ? array $attributes = array() ): void {
	echo wp_kses_post( get_the_attr( $attributes ) );
}

function the_image( $id = null, $size = 'large', $attr = array(), $return = 'figure' ): void {
	echo wp_kses_post( get_the_image( $id, $size, $attr, $return ) );
}

function get_the_image( $id = null, $size = 'large', $attr = array(), $return = 'figure' ): string {
	if ( null === $id ) {
		$id = in_the_loop() ? get_post_thumbnail_id() : null;
	}
	if ( ! $id ) {
		return '';
	}
	$img     = wp_get_attachment_image( $id, $size, $attr );
	$attr    = array_merge( array( 'caption' => true ), $attr );
	$caption = true === $attr['caption'] ? wp_get_attachment_caption( $id ) : $attr['caption'];
	if ( $caption && 'figure' === $return ) {
		return "<figure>$img<figcaption>$caption</figcaption></figure>";
	}
	return $img;
}


function the_acf_non_empty_field( $field, $before = '', $after = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}
	$value = $field;
	if ( is_string( $value ) ) {
		$value = acf_get_loop() === false ? get_field( $field ) : get_sub_field( $field );
	}
	if ( empty( $value ) ) {
		return;
	}
	echo wp_kses_post( $before . $value . $after );
}
