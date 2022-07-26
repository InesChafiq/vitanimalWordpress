<?php
/*Plugin Name: vitanimal
  Description: Plugin fournissant le code de l'application vitanimal (remplissage de fiche et administrer des groupes/indvidus à un soigneur)
  Author: Inès Chafiq
  Version: 1.0.0
*/

include_once "includes/log.php";
if (!defined('ABSPATH')) exit;
register_activation_hook(__FILE__, "activate_myplugin");
register_deactivation_hook(__FILE__, "deactivate_myplugin");

function activate_myplugin()
{

	createDatabase();
	//createFolder();
	//createTable();
}

function deactivate_myplugin()
{
	deleteTable();

}

function deleteTable() {

}

function createDatabase() {
	global $wpdb, $prefix;

	$prefix = 'vitanimal_';

	$table_name_species = $prefix . 'species';
	$table_name_area    = $prefix . 'area';
	$table_name_enclos  = $prefix . 'enclos';

	if ( $wpdb->get_var( "show tables like '$table_name_area'" ) != $table_name_area ) {

		$sql = "CREATE TABLE IF NOT EXISTS $table_name_area (
		 `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		COMMIT;";

		require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

		dbDelta( $sql );
		//js_debug("Table 'vitanimal_area' créée correctement");

	}
}


require_once plugin_dir_path(__FILE__) . 'includes/affichage_area.php';
//require_once plugin_dir_path(__FILE__) . 'includes/menu.php';
require_once plugin_dir_path(__FILE__) . 'includes/show_animals.php';
require_once plugin_dir_path(__FILE__) . 'includes/show_animal_info.php';
require_once plugin_dir_path(__FILE__) . 'includes/create_form.php';
require_once plugin_dir_path(__FILE__) . 'includes/fill_form_ressource.php';
require_once plugin_dir_path(__FILE__) . 'includes/show_animal_to_observe.php';
require_once plugin_dir_path(__FILE__) . 'includes/fill_form_animal.php';
require_once plugin_dir_path(__FILE__) . 'includes/form_sent.php';



