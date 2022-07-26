<?php
include_once "log.php";

//use to break the array and send back an array without char
function break_list($tab, $key){
	$fiche = [];
	foreach ($tab as $id_block){
		$b1 = explode(';', $id_block->$key);
		array_push($fiche,$b1);

	}
	//print_r($fiche[0]);

	$tab_id= array();

	foreach ($fiche as $block_fiche){
		for ($i=0; $i<count($block_fiche); $i++){
			if($block_fiche[$i][0] == 'c'){
				$block_fiche[ $i ] = "c" . substr( $block_fiche[ $i ], 2 ) ;
			}else {
				$block_fiche[ $i ] = substr( $block_fiche[ $i ], 2 );
			}
		}
		//print_r($block_fiche);
		array_push($tab_id, $block_fiche);
	}

	//print_r($tab_id_c);
	//print_r("id_q: " . $tab_id);
	return $tab_id;
}

/*
 *
 */
function crop_datetime_to_date($datetime){
	$date = strstr($datetime, ' ', true);
	$date = str_replace('-', '/', $date);
	return $date;
}


/*
 * Transform a date in english to french
 * @param date
 * @return date
 */
function date_english_to_french($date_english){
	$day = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
	$month = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
	$explode = explode(' ', $date_english);
	$day_french = $day[$explode[1] - 1];
	$month_french = $month[$explode[2] -1];
	return $day_french . ' ' . $explode[0] . ' ' . $month_french . ' ' . $explode[3];
}

/*function redirect_to_other_page() {
	if ( wp_redirect(' http://vita.fr/?page_id=102 ') ) {
		exit;
	}
}*/

//add_action( 'template_redirect', 'redirect_to_other_page' );
