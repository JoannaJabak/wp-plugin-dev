<?php 
/*
Plugin Name: Customize Login Plugin
Description: Customizes the login page
Author: Joanna Douba-Jabak
Version: 1.0
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




// if admin area
if (is_admin()) {
    // require_once '../admin/admin-menu.php';
    //A better way of doing it is using the plugin_dir_path() function
    require_once plugin_dir_path( __FILE__ ) . ('includes/initialize.php');

    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
    
    // require_once '../admin/settings-page.php';
    //A better way of doing it is using the plugin_dir_path() function
    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';

    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-register.php';

    require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callbacks.php';
}

// Default values for the plugin settings
function myplugin_options_default() {

    return [
        // Default custom login logo url
        'custom_url' => 'https://terabit.ca/',
        // Default custom title
        'custom_title' => 'Powered by Terabit',
        // Default custom style setting
        'custom_style' => 'disable',
        // Default custom message
        'custom_message' => '<p class="custom-message">Welcome to Terabit.ca</p>',
        //Default custom footer message
        'custom_footer' => 'Powered by Terabit',
        //Default custom toolbar setting
        'custom_toolbar' => false,
        //Default custom color scheme for new users
        'custom_scheme' => 'default',
    ];
}

