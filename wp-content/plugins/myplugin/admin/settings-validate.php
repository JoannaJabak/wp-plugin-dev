<?php 

require_once plugin_dir_path(__FILE__) . '../includes/core-functions.php';

/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/

    /************************************************************
    *                  Validation Functions                     *
    ************************************************************/
// Validate plugin settings
function myplugin_callback_validate_options($input) {

    //custom url
    //If the custom url is set, then sanitize it
    if ( isset( $input['custom_url'])) {
        //Use esc_url() function to sanitize form input
        $input['custom_url'] = esc_url($input['custom_url']);
    }

    //custom title
    //If the custom title is set, then sanitize it
    if ( isset ($input['custom_title'])) {
        //Use sanitize_text_field() function to sanitize form input
        $input['custom_title'] = sanitize_text_field($input['custom_title']);
    }

    //custom style
    $radio_options = [
        'enable' => 'Enable custom styles',
        'disable' => 'Disable custom styles'
    ];

    // Check if the custom style option exists, and if not, then we set it to null
    if (!isset($input['custom_style'])) {
        
        $input['custom_style'] = null;

    }

    //Check if the custom style option exists in the $radio_options array, if not then set it to null
    if ( !array_key_exists($input['custom_style'], $radio_options)) {
        $input['custom_style'] = null;
    }

    //custom message
    //If the custom message is set, then sanitize it
    if (isset ($input['custom_message'])) {
        //Use sanitize_text_field() function to sanitize form input
        $input['custom_message'] = wp_kses_post($input['custom_message']);
    }

    //custom footer message
    //If the custom footer message is set, then sanitize it
    if (isset ($input['custom_footer'])) {
        //Use sanitize_text_field() function to sanitize form input
        $input['custom_footer'] = sanitize_text_field($input['custom_footer']);
    }

    //custom toolbar
    //First, we check if the option is set, and if not, we set it to null
    if (!isset($input['custom_toolbar'])) {
        
        $input['custom_toolbar'] = null;

    }
    //Then, we check the value of the option to make sure it is either set to true or false ( 1 or 0 )
    $input['custom_toolbar'] = ($input['custom_toolbar'] == 1 ? 1 : 0 ); 

    //custom scheme
    $select_options = [
        'default' => 'Default',
        'light' => 'Light',
        'blue' => 'Blue',
        'coffee' => 'Coffee',
        'ectoplasm' => 'Ectoplasm',
        'midnight' => 'Midnight', 
        'ocean' => 'Ocean', 
        'sunrise' => 'Sunrise', 
    ];

    if (!isset($input['custom_scheme'])) {
        $input['custom_scheme'] = null;
    }

    return $input;

}