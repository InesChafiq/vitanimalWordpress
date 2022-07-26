<?php

/*
 * take all the forms that are part of the evaluation
 * @param integer $id_eval
 * return array
 */
function get_all_form($id_eval){
	global $wpdb;
	$query_observation = $wpdb->prepare('SELECT * FROM vitanimal_observation  WHERE id_evaluation =' . $id_eval);
	$observation = $wpdb->get_results( $query_observation );
	return $observation;
}

/*
 * return the list of id of the block inside blocks
 * @param integer $id
 * @return array
 */
function get_list_id_blocks($id){
	global $wpdb;
	$query_blocks = $wpdb->prepare('SELECT list_id_block FROM vitanimal_blocks b, vitanimal_form f
                     WHERE f.id = b.id_form AND b.id_form ='. $id);
	$list_blocks = $wpdb->get_results($query_blocks);
	//sprint_r($list_blocks);
	return $list_blocks;
}

/*
 * return all the id of question and comment in the block and the name of the block based on the block id
 * @param integer $id
 * return array
 */
function get_id_questions_comments_name($id){
	global $wpdb;
	$query_block = $wpdb->prepare('SELECT name, id_questions_comments FROM vitanimal_block WHERE id='. $id);
	$list_question_comment_name = $wpdb->get_results($query_block);
	return $list_question_comment_name;
}

/*
 * return all the attribute of the table comment for an id
 * @param $id_q_c
 * return array
 */
function get_attribute_comment($id_q_c){
	global $wpdb;
	$query_comment = $wpdb->prepare('SELECT * FROM vitanimal_comment WHERE id='. $id_q_c[1]);
	$comment = $wpdb->get_results($query_comment);
	return $comment;
}

/*
 * return all the attribute of the table questions for an id
 * @param $id_q_c
 * return array
 */
function get_attribute_question($id_q_c){
	global $wpdb;
	$query_questions = $wpdb->prepare('SELECT * FROM vitanimal_question WHERE id='. $id_q_c);
	$questions = $wpdb->get_results($query_questions);
	return $questions;
}

/*
 * return the possible answer in the answer table for a question
 * @param $id
 * return array
 */
function get_all_answer($id){
	global $wpdb;
	$query_answer = $wpdb->prepare( 'SELECT * FROM vitanimal_answer WHERE id=' . $id );
	$answer       = $wpdb->get_results( $query_answer );
	return $answer;
}

/*
 * return the type of a form based on the id form type in the table form
 * @param $id_form
 * return array
 */
function get_type_form($id_form){
	global $wpdb;
	$query_form = $wpdb->prepare('SELECT t.description FROM vitanimal_form_type t, vitanimal_form f 
					WHERE  f.id_form_type = t.id AND f.id =' . $id_form  );
	$form_type = $wpdb->get_results( $query_form );
	//print_r($form_type);
	return $form_type;
}

/*
 * return in an array the id,name of the animal; the id, name of the group; the name of the area; the name of the enclosure
 * the name of the species; the id, eval_begin, eval_end of the evaluation
 * @param $id_user
 * @return array
 */
function get_all_animal_group_to_observe($id_user){
	global $wpdb;
	$query_group = $wpdb->prepare( 'SELECT g.id , g.name, a.name as area, e.name as enclos,
       s.name as species,  ev.eval_begin, ev.eval_end, ev.id as eval
		FROM vitanimal_group g, vitanimal_area a, vitanimal_enclosure e, vitanimal_evaluation ev, vitanimal_animal an, wp_users u, vitanimal_species s
		WHERE g.id_area = a.id AND g.id_enclosure = e.id AND g.id = ev.id_group AND an.id = g.id_animal
		AND ev.id_user=u.ID AND s.id=an.id_species AND ev.observation IS NULL AND u.ID =' . $id_user .' ORDER BY g.name' );
	$group       = $wpdb->get_results( $query_group );
	return $group;
}

/*
 * will count all the animal that a user has to observe, useful to show it in the page show animal to observe
 * @param $id_user
 * @return array
 */
function count_all_animal_group_to_observe($id_user){
	global $wpdb;
	$query_count_animal_group_to_observe =$wpdb->prepare('SELECT COUNT(g.id) as nb_group
		FROM  vitanimal_group g,  vitanimal_evaluation ev, vitanimal_animal an, wp_users u
		WHERE g.id = ev.id_group AND an.id = g.id_animal AND ev.observation IS NULL AND ev.id_user=u.ID AND u.ID =' . $id_user );
	$count = $wpdb->get_results($query_count_animal_group_to_observe);
	return $count;
}

/*
 * Look at the last evaluation of an animal
 * @param id_animal
 * @return array
 */
function search_last_date_exam($id_group){
	global $wpdb;
	$query_last_date_eval = $wpdb->prepare('SELECT MAX(observation) as observation FROM vitanimal_evaluation WHERE observation IS NOT NULL AND id_group = '. $id_group);
	$date_eval_group = $wpdb->get_results($query_last_date_eval);
	//print_r($date_eval_group);
	return $date_eval_group;
}

/*
 * Will put a date of the evaluation that was completed
 * @param $id_eval, $date
 * @return nothing
 */
function put_evaluation_to_complete($id_eval, $date){
	global $wpdb;
	$query_add_datetime_to_evaluation = $wpdb->query($wpdb->prepare('UPDATE vitanimal_evaluation 
										SET observation= "' . $date. '" WHERE id =' . $id_eval));
	return $query_add_datetime_to_evaluation;
}

/*
 * delete in the table observation the eval that was completed
 * @param $id_eval
 * return nothing
 */
function delete_evaluation_in_observation($id_eval){
	global $wpdb;
	$query_delete_evaluation_in_observation = $wpdb->query($wpdb->prepare('DELETE FROM  vitanimal_observation WHERE id_evaluation = '. $id_eval));
	return $query_delete_evaluation_in_observation;
}