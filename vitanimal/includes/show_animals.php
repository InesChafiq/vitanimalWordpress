<?php
include_once "log.php";

function show_animals_group_eval(){
	global $wpdb;
	$css_p = 'style="font-size: 10px; "';
	$query_group = $wpdb->prepare('SELECT an.id as animal, g.id, g.name, g.features, g.number, g.number_of_female, a.name as area, e.name as enclos,
       s.name as species
		FROM vitanimal_group g, vitanimal_area a, vitanimal_enclosure e, vitanimal_animal an, vitanimal_species s
		WHERE g.id_area = a.id AND g.id_enclosure = e.id AND an.id = g.id_animal
		AND s.id=an.id_species');
	$group = $wpdb->get_results( $query_group );

	$retour = "";
	$retour .= '<ul style = "list-style: none">';
	foreach ($group as $nb_group){
		$retour .= '<li ><a href="http://vita.fr/?page_id=89&id_animal='. $nb_group->animal. '
		             " class="button" style="padding-left:20%;padding-right:20%; width:90%;">'
		            . $nb_group->name . '<p '.$css_p. '> Espèce: '. $nb_group->species . ' Secteur: ' . $nb_group->area . ' Enclos: ' . $nb_group->enclos .'</p></a></li>';
	}
	$retour .= '</ul>';

	return $retour;
}

add_shortcode('show_group', 'show_animals_group_eval');