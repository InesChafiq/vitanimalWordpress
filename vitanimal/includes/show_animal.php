<?php
include_once "log.php";

function show_animals_group(){
	global $wpdb;
	$css_p = 'style="font-size: 10px; "';
	$query_group = $wpdb->prepare('SELECT g.id, g.name, g.features, g.number, g.number_of_female, a.name as area, e.name as enclos 
		FROM vitanimal_group g, vitanimal_area a, vitanimal_enclosure e, vitanimal_evaluation ev
		WHERE g.id_area = a.id AND g.id_enclosure = e.id AND g.id = ev.id_group');
	$group = $wpdb->get_results( $query_group );

	$retour = "";
	$retour .= '<ul style = "list-style: none">';
	foreach ($group as $nb_group){
		$retour .= '<li ><a  href="http://vita.fr/?page_id=89%id="'. $nb_group->id .' id="' . $nb_group->id
		           .'" class="button"  style="padding-left:20%;padding-right:20%; width:90%">Nom: '
		           . $nb_group->name . '<p '.$css_p. '>Secteur: ' . $nb_group->area . ' Enclos: ' . $nb_group->enclos .'</p></a></li>';
	}
	$retour .= '</ul>';

	return $retour;
}

add_shortcode('show_group', 'show_animals_group');