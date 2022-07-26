<?php

add_shortcode( 'button_test', 'bouton' );

function bouton( $atts ) {
	$a = shortcode_atts( array(
		'link' => 'http://vita.fr/?page_id=73',
		'id' => 'test',
		'color' => 'blue',
		'size' => '',
		'label' => 'Button',
		'target' => '_self'
	), $atts );
	$output = '<p><a href="' . esc_url( $a['link'] ) . '" id="' . esc_attr( $a['id'] ) . '" class="button '
	          . esc_attr( $a['color'] ) . ' ' . esc_attr( $a['size'] ) . '" target="' . esc_attr($a['target'])
	          . '">' . esc_attr( $a['label'] ) . '</a></p>';
	return $output;
}
