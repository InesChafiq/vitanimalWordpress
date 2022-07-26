<?php
include_once "log.php";

function show_animal_info(){
	$id = $_GET["id_animal"];

	js_debug(get_permalink());
	global $wpdb;
	$query = $wpdb->prepare('SELECT  a.name, a.arrival_date, a.date_of_birth, a.medical_status, a.reproductive_status, a.features,
			a.geriatric, a.gender, s.name as species
    		FROM vitanimal_animal a, vitanimal_species s
         	WHERE a.id =' . $id. ' AND a.id_species = s.id');
	$info = $wpdb->get_results( $query );
	$retour = "";
	$retour .= '<table><thead>
			<tr>
            	<th>Name</th>
            	<th>Date d\'arrivée</th>
            	<th>Date de naissance</th>
            	<th>Status médical</th>
            	<th>Status reproducteur</th>
            	<th>Caractérisriques</th>
            	<th>Espérance de vie en mois</th>
            	<th>Gériatrique</th>
            	<th>Sexe</th>
            	<th>Espèce</th>
        	</tr></thead>';
	foreach ($info as $info_details){
		$retour .= '<tbody><tr><td> '
					. $info_details->name.
		           '</td><td>'
					. $info_details->arrival_date.
		           '</td><td>'
					. $info_details->date_of_birth.
		           '</td><td>'
					. $info_details->medical_status.
		           '</td><td>'
					. $info_details->reproductive_status.
		           '</td><td>'
					. $info_details->features.
		           '</td><td>'
					. $info_details->life_expectancy_in_months .
		           '</td><td>'
					. $info_details->geriatric.
		           '</td><td>'
					. $info_details->gender.
		           '</td><td>'
					. $info_details->species . '</td>';
	}
	$retour .= '</tr></tbody></table>';
	return $retour;
}

add_shortcode('show_info', 'show_animal_info');
