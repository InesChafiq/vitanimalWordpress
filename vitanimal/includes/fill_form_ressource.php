<?php
include_once "log.php";
include_once "utils.php";
include_once "search_animal_to_observe_page.php";
include_once "request.php";

function fill_eval_ressource(){
	$id_eval = $_GET['id_eval'];
	$id_group = $_GET['id_group'];
	$user = wp_get_current_user();


	$retour = '';
	if($user->ID != 0) {
		//check if an id group or animal was chosen before coming to this page
		if ( ! is_null( $id_eval ) and !is_null($id_group) ) {
			$observation = get_all_form( $id_eval );
			foreach ( $observation as $form ) {
				$test = get_type_form( $form->id_form );
				if ( $test[0]->description == 'ressource' ) {
					$list_blocks = get_list_id_blocks( $form->id_form );
					//print_r($list_blocks);
				}
			}

			//print_r($list_blocks);
			$key          = 'list_id_block';
			$tab_id_block = break_list( $list_blocks, $key );

			//print_r($tab_id_block);
			$tab_id_questions_comment_name = [];
			foreach ( $tab_id_block as $id_block ) {
				foreach ( $id_block as $id ) {
					$list_question_comment = get_id_questions_comments_name( $id );
					//print_r($list_question_comment);
					$tab_id_questions_comment_name = array_merge( $tab_id_questions_comment_name, $list_question_comment );
				}
			}

			$key2        = 'id_questions_comments';
			$list_id_q_c = break_list( $tab_id_questions_comment_name, $key2 );
			//print_r($list_id_q_c);

			$tab_questions_comments = [];
			foreach ( $list_id_q_c as $all ) {
				foreach ( $all as $id_q_c ) {
					if ( $id_q_c[0] == "c" ) {
						$comment_questions = get_attribute_comment( $id_q_c );
						//print_r($comment_questions);
					} else {
						$comment_questions = get_attribute_question( $id_q_c );

					}
					//print_r($comment_questions);
					$tab_questions_comments = array_merge( $tab_questions_comments, $comment_questions );
				}

			}


			//print_r(count($list_id_q_c[1]));
			//print_r($tab_questions_comments);


			$retour .= '<div style="text-align: center;"><h2> Ressource </h2>';
			$last_date_eval = search_last_date_exam($id_group);
			if(is_null($last_date_eval[0]->observation)){
				$retour .= '<p>Il n\'y a pas d\'évaluation antérieure</p>';
			}else{
				$retour .= '<p>Dernière évaluation: ' . $last_date_eval[0]->observation . '</p>';
			}
			$retour .= '<button id="réinitialiser"> Réinitialiser</button>';

			$retour .= '<form method="post" class="form">';

			//$titled = array_column($tab_questions_comments, 'titled');
			//print_r($titled);
			//print_r($tab_questions_comments[0]->titled);
			$length = 0;
			$style  = 'style ="display:flex; padding-right:5%;"';
			for ( $i = 0; $i < count( $tab_id_questions_comment_name ); $i ++ ) {
				$retour .= '<h6>' . $tab_id_questions_comment_name[ $i ]->name . '</h6>';
				$size   = count( $list_id_q_c[ $i ] );
				for ( $j = 0; $j < $size; $j ++ ) {
					//print_r(count($list_id_q_c[$i]));
					$tab_radio = [];

					$answer = get_all_answer( $tab_questions_comments[ $j + $length ]->id_answer );
					if ( $tab_id_questions_comment_name[ $i ]->name == 'IDENTIFICATION' ) {
						$retour .= '<div style="text-align: left;"	><label for="identification_liste">' . $tab_questions_comments[ $j + $length ]->titled . ': </label>
										<select style="width:35%;"  name="identification_liste">';
						foreach ( $answer as $identification ) {
							$tab_identification = explode( ';', $identification->value );
							//print_r($tab_identification);
							foreach ( $tab_identification as $value ) {
								$retour .= '
													<option value="' . $value . '">' . $value . '</option>';
							}
						}
						$retour .= '</select></div>';

					} else {
						if ( $tab_questions_comments[ $j + $length ]->titled != null ) {
							//print_r($tab_questions_comments[$j + $size *$i]);
							$retour .= '<fieldset style="margin-top: 5%;"><legend>' . $tab_questions_comments[ $j + $length ]->titled . '</legend><div ' . $style . '>';
							foreach ( $answer as $a ) {
								$arrayA = explode( ';', $a->value );
								foreach ( $arrayA as $val ) {
									//print_r("tr: ". $val);
									$tab = strstr( $val, ':', true );
									//print_r($tab);
									array_push( $tab_radio, $tab );
								}
								foreach ( $tab_radio as $value ) {
									$retour .= '<div style="margin-left: 5%;">
												<label for="type">' . $value . '</label>
											    <input type="' . $a->type . '" name="type" value="' . $value
									           . '"></div>';

								}

							}

							$retour .= '</div></fieldset>';
						} else {
							$retour .= '<textarea name="description" rows="4" placeholder="' . $tab_questions_comments[ $j + $length ]->description . '"></textarea>';
						}
					}


				}
				$length = $length + $size;

			}
			$retour .= '</form><div style="padding-top: 4%;">
					<button style=" margin-right: 20%;"  id="btn_cancel_ressource" name="cancel"> annuler</button>
					<button  name="valider" id="btn_valide_animal"> valider </button></div></div> ';

		} else {
			$retour .= '<p>Vous n\'avez pas sélectionné d\'animaux ou de groupe</p>';
		}
		//print_r($id_group);
		$url_fiche_animal = '/?page_id=116&id_eval=' . $id_eval . '&id_group='. $id_group;
		$retour           .= '<script type="text/javascript">
			    document.getElementById("btn_cancel_ressource").onclick = function () {
			        location.href = "/";
			    };
                
                document.getElementById("btn_valide_animal").onclick = function (){
                    location.href ="' . $url_fiche_animal . '" ;
                };
				</script>';
	}else{
		$retour .= '<p>Vous devez être connecté pour accéder à cette page</p>';
	}
	return $retour;
}



add_shortcode('fill_form_ressource', 'fill_eval_ressource');