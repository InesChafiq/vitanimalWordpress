<?php
include_once "log.php";
include_once "utils.php";
include_once "search_animal_to_observe_page.php";
include_once "request.php";

function fill_eval(){
	$id_eval = $_GET['id_eval'];

	$observation = get_all_form($id_eval);

	$tab_id_block=[];
	foreach ($observation as $form){
		$list_blocks = get_list_id_blocks($form->id_form);
		$tab_id_block = array_merge($tab_id_block,$list_blocks);
	}


	$key = 'list_id_block';
	$tab_id_block = break_list($tab_id_block, $key);

	$tab_id_questions_comment_name=[];
	foreach ($tab_id_block as $id_block){
		foreach ($id_block as $id){
			$list_question_comment = get_id_questions_comments_name($id);
			//print_r($list_question_comment);
			$tab_id_questions_comment_name = array_merge($tab_id_questions_comment_name,$list_question_comment);
		}
	}

	$key2 = 'id_questions_comments';
	$list_id_q_c = break_list($tab_id_questions_comment_name, $key2);
	//print_r($list_id_q_c);

	$tab_questions_comments= [];
	foreach ($list_id_q_c as $all){
		foreach($all as $id_q_c){
			if($id_q_c[0] == "c"){
				$comment_questions = get_attribute_comment($id_q_c);
				//print_r($comment_questions);
			}else{
				$comment_questions = get_attribute_question($id_q_c);

			}
			//print_r($comment_questions);
			$tab_questions_comments = array_merge($tab_questions_comments, $comment_questions);
		}

	}


	//print_r(count($list_id_q_c[1]));
	//print_r($tab_questions_comments);
	if($_POST['cancel']){
		if ( wp_redirect(' http://vita.fr/?page_id=102 ') ) {
			exit;
		}
	}
	elseif($_POST['valider']){
		if ( wp_redirect(' http://vita.fr/?page_id=102 ') ) {
			exit;
		}
	}else {
		$type = get_type_form();
		$retour = '<div style="text-align: center;"><h2>'.$type[0]->description.'</h2>';
		$retour .= '<form method="post" class="form">';
		//$titled = array_column($tab_questions_comments, 'titled');
		//print_r($titled);
		//print_r($tab_questions_comments[0]->titled);
		$length = 0;
		$style = 'style ="display:flex; padding-right:5%;"';
		for($i=0;$i<count($tab_id_questions_comment_name);$i++){
			$retour .= '<h6>'. $tab_id_questions_comment_name[$i]->name.'</h6>';
			$size = count( $list_id_q_c[ $i] );
			for ($j=0; $j <$size;$j++ ) {
				//print_r(count($list_id_q_c[$i]));
				$tabDeux = [];
				if ( $j + $size * $i < count( $tab_questions_comments ) ) {
					if ( $tab_questions_comments[ $j + $length ]->titled != null ) {
						//print_r($tab_questions_comments[$j + $size *$i]);
						$retour .= '<fieldset><legend>' . $tab_questions_comments[ $j + $length ]->titled . '</legend><div ' . $style . '>';
						$answer = get_all_answer( $tab_questions_comments[ $j + $length ]->id_answer );
						foreach ( $answer as $a ) {
							$arrayA = explode( ';', $a->value );
							foreach ( $arrayA as $val ) {
								//print_r("tr: ". $val);
								$tab = strstr( $val, ':', true );
								//print_r($tab);
								array_push( $tabDeux, $tab );
							}
							foreach ( $tabDeux as $end ) {
								//print_r($end);
								$retour .= '<div ' . $style . '><input type="' . $a->type . '" name="type" value="' . $end
								           . '"><label for="type">' . $end
								           . '</label></div>';
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
		$retour .= '<div style="padding-top: 4%;">
				<input style=" margin-right: 20%;" type="submit" name="cancel" value="annuler">
				<input type="submit" name="valider" value="valider"></form></div></div> ';
	}
	return $retour;
}

add_shortcode('fill_form', 'fill_eval');