<?php
/**
 * Checks for show_animal_observation shortcode and flags the post with post meta.
 * @param integer $post_id
 * @return integer
 */
function save_animal_observation_postmeta($post_id)
{
	// Make sure this isn't an autosave.
	if(!defined('DOING_AUTOSAVE') || !DOING_AUTOSAVE){
		// Get Post Content
		$content = get_post_field('post_content', $post_id);
		// Check for shortcode
		if(has_shortcode($content, 'show_animal_observation')) {
			// Update (or it will insert) the 'has_calender' post meta.
			update_post_meta($post_id, 'has_animal_observation', '1');
		}
		else {
			// Delete the has calender post meta if it exists.
			delete_post_meta($post_id, 'has_animal_observation');
		}
	}
	return $post_id;
}
add_action('save_post', 'save_animal_observation_postmeta');

/**
 * Check if a post has a animal_observation.
 * @param int $post_id
 * @return boolean
 */
function post_has_animal_observation($post_id)
{
	return (get_post_meta($post_id, 'has_animal_observation'));
}