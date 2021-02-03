<?php 
require_once plugin_dir_path(__FILE__) . '../includes/initialize.php';

/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/


// add sub-level administrative menu
function myplugin_add_sublevel_menu() {
	
		
	/*
	
	add_submenu_page(
		string   $parent_slug,
		string   $page_title,
		string   $menu_title,
		string   $capability,
		string   $menu_slug,
		callable $function = ''
	);
	
	*/
	add_submenu_page(
        // string   $parent_slug,
        'options-general.php',

        // string   $page_title,
        'My Plugin Settings',

        // string   $menu_title,
        'My Plugin',
        
        // string   $capability,
        'manage_options',
        
        // string   $menu_slug,
        'myplugin',
        
        // callable $function = ''
        'myplugin_display_settings_page'
        
    );
}
add_action('admin_menu', 'myplugin_add_sublevel_menu');

// // add top-level administrative menu
// function myplugin_add_toplevel_menu() {
	
// 	/* 
// 		add_menu_page(
// 			string   $page_title, 
// 			string   $menu_title, 
// 			string   $capability, 
// 			string   $menu_slug, 
// 			callable $function = '', 
// 			string   $icon_url = '', 
// 			int      $position = null 
// 		)
// 	*/
// 	add_menu_page(
//         // string   $page_title,
//         'Customize Login Settings',

//         // string   $menu_title,
//         'Customize Login',

//         // string   $capability, 
//         'manage_options',

//         // string   $menu_slug, 
//         'customize-login-plugin',

//         // callable $function = '', 
//         'myplugin_display_settings_page',
        
//         // string   $icon_url = '', 
//         'dashicons-admin-generic',

//         // int      $position = null (sets the priority / 0 is the highest)
//         null
//     );
// }
// add_action('admin_menu', 'myplugin_add_toplevel_menu');

