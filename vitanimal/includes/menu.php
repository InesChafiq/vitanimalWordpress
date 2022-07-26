<?php
function message(){
	echo "Bienvenue sur le menu de création";
}

function creation_admin_menu() {
	add_menu_page(
		'créer groupe',// page title
		'créer groupe',// menu title
		'manage_options',// capability
		'créer groupe',// menu slug
		'message' // callback function
	);
}
add_action('admin_menu', 'creation_admin_menu');