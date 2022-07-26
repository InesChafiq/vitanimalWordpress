<?php
include_once "log.php";
include_once "utils.php";
include_once "request.php";

function form_sent(){
	$id_eval = $_GET['id_eval'];
	$user = wp_get_current_user();

	$retour = '<div style="text-align: center;">';
	if($user->ID != 0) {

		//print_r($id_eval);
		//print_r(date('Y-m-d H:i:s'));
		if ( isset( $id_eval ) ) {
			put_evaluation_to_complete( $id_eval, date( 'Y-m-d H-i-s' ) );
			delete_evaluation_in_observation($id_eval);
			$retour .= '<p>Le formulaire a bien été envoyé!</p>
						<button id="return_home">Retour à l\'accueil</button>';
		} else {
			$retour .= '<p>Vous devez remplir les formulaires avant de les envoyer</p>';
		}
	}else{
		$retour .= '<p>Vous devez être connecté pour accéder à cette page</p>';
	}
	$retour .= '</div>';
	$retour              .= '<script type="text/javascript">
			    document.getElementById("return_home").onclick = function () {
			        location.href = "/";
			    }</script>';
	return $retour;
}

add_shortcode('form_sent', 'form_sent');