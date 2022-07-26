<?php

include_once "log.php";
//Fuseau horaire
setlocale(LC_ALL, 'fr_FR');
date_default_timezone_set('Europe/Paris');

//Permet d'utiliser des variables de session en php
if (!session_id()) {
	session_start();
}

class Fill {
	protected $data = array( // Default options values
		'jq_theme' => 'smoothness'
	);
	/*public function __construct()
	{

		// Check if is admin
		// We can later update this to include other user roles
		if (is_admin()) {
			add_action('plugins_loaded', array($this, 'wp_create_area_plugins_loaded')); //Handles tasks that need to be done at plugins loaded stage.
			add_action('admin_menu', array($this, 'wp_create_area_register'));  // Create admin menu page
			add_action('admin_init', array($this, 'wp_create_area_settings')); // Create settings
			register_activation_hook(__FILE__, array($this, 'wp_create_areab_activate')); // Add settings on plugin activation
		}
	}*/

}