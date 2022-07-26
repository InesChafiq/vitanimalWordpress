<?php
include_once "log.php";

function create_eval(){
	global $wpdb;
	//we will request all the data needed
	$query_all_animal = $wpdb->prepare('SELECT * FROM vitanimal_animal a');
	$all_animal = $wpdb->get_results( $query_all_animal );

	$retour = '<form action="" method="post">';
	$retour .= '<label for="group_animal">Choisir un groupe ou un animal</label>';
	$retour .= '<select name="group_animal">';
	foreach($all_animal as $name){
		$retour .= '<option value="' . $name->name . '">' . $name->name . '</option>';

	}
	$retour .= '</select>';
    $retour .=  '</form>';

	return $retour;

}

add_shortcode('create_form', 'create_eval');