<?php 
/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/

//Exit if file is called directly
if (!defined ('ABSPATH')) {

    exit;

}

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
        esc_html__('My Plugin Settings', 'myplugin'),

        // string   $menu_title,
        esc_html__('My Plugin', 'myplugin'),
        
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
//         esc_html__('Customize Login Settings', 'myplugin'),

//         // string   $menu_title,
//         esc_html__('Customize Login', 'myplugin'),

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

