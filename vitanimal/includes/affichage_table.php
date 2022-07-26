<?php
include_once "log.php";

function show_table_area($atts){

	global $wpdb;
	$query = $wpdb->prepare('SELECT * FROM vitanimal_area');
	$area = $wpdb->get_results( $query );
	$retour = "";
	$retour .= '<ul style = "list-style: none">';
	foreach ($area as $nb_area){
		$retour .= '<li ><a href="http://vita.fr/?page_id=38" id="' . $nb_area->id
		           .'"class="button" >'
		           . $nb_area->name . '</a></li>';
	}
	$retour .= '</ul>';

	return $retour;
}

add_shortcode('show_table', 'show_table_area');
