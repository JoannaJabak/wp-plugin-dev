<?php 
/*
Plugin Name: Customize Login Plugin
Description: Customizes the login page
Author: Joanna Douba-Jabak
Version: 1.0
Text Domain: myplugin
Domain Path: /languages
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.txt
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/

//Exit if file is called directly
if (!defined ('ABSPATH')) {

    exit;

}

/***************************************************************************
*                     Internationalization Feature                         *
***************************************************************************/
// load text domain
// We load text domain to enable internationalization of the plugin 
function myplugin_load_textdomain() {
    
    load_plugin_textdomain( 
        //the plugin's text domain*
        //*: should match the "Text Domain" specified in the file header, AND the name of the main plugin file AND the name of the main plugin folder
        'myplugin', 
        
        //
        false, 
        // Path to the localization files
        plugin_dir_path(__FILE__) . 'languages/');

}

add_action('plugins_loaded', 'myplugin_load_textdomain'); 

// if admin area
if (is_admin()) {
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-validate.php';
}

// include dependencies: admin and public
require_once plugin_dir_path( __FILE__ ) . ('includes/core-functions.php');


// Default values for the plugin settings
function myplugin_options_default() {

    $options = [
        // Default custom login logo url
        'custom_url'    => 'https://terabit.ca/',
        // Default custom title
        // __() retrieves the translation of text
        // esc_html__() retrieves the translation while also sanitizing the input
        // 'myplugin' specifies the text domain
        'custom_title'  => esc_html__('Powered by Terabit', 'myplugin'),
        // Default custom style setting
        'custom_style'  => 'disable',
        // Default custom message
        'custom_message'=> '<p class="custom-message">' . esc_html__( 'Welcome to Terabit.ca', 'myplugin' ) . '</p>',
        //Default custom footer message
        'custom_footer' => esc_html__('Powered by Terabit', 'myplugin'),
        //Default custom toolbar setting
        'custom_toolbar'=> false,
        //Default custom color scheme for new users
        'custom_scheme' => 'default',
    ];

    return $options;
}

// // remove options on uninstall
// function myplugin_on_uninstall() {
//     //check if the user is an admin, if sp then delete the plugin options
//     if (! current_user_can('activate_plugins')) return;
    
//     delete_option ('myplugin_options');

// }

// register_uninstall_hook(__FILE__, 'myplugin_on_uninstall');