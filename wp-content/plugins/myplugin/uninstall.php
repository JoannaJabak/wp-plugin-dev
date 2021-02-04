<?php 

/*
    uninstall.php

    - is executed when plugin is uninstalled via the Plugins screen

*/

// exit if uninstall constant not defined 
// the uninstall constant ensures that the user has the proper permissions and that the file is loaded within WordPress.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    
    exit;

}

// delete the plugin options
delete_option('myplugin_options');