<?php 
require_once plugin_dir_path(__FILE__) . '../includes/initialize.php';

/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/

    /************************************************************
    *                  Callback Functions                       *
    ************************************************************/

//callback: login section
function myplugin_callback_section_login() {

    echo "<p>These settings enable you to customize the WP Login Screen.</p>";
}


//callback: admin section
function myplugin_callback_section_admin() {

    echo "<p>These settings enable you to customize the WP Admin Area.</p>";
}

//callback: text field
function myplugin_callback_field_text( $args ) {
    /************************************************************************
    
    1. Define the variables

    1.1 Use the get_option() function to get the plugin options 
    
        get_option ( 'option_name', default options* );
        'option_name' is defined in the register_setting() function in settings-register.php as option_name
        *: Default options to use to use if plugin options are not available in the database

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // $args are passed from the add_settings_field() function in settings-register.php 
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Check if the id of the options is set, and if so, sanitize that variable, if not, then set it to an empty string
    $value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';

    // 2. Output the field markup
    echo '<input 
                id    = "myplugin_options_' . $id . '" 
                name  = "myplugin_options[' . $id . ']" 
                type  = "text"
                size  = "40"
                value = "' . $value . '">';
    
    echo '<br>';
    
    echo '<label for="myplugin_options_' . $id . '">' . $label . '</label>';
}

//callback: radio button 
function myplugin_callback_field_radio($args) {

    /************************************************************************
    
    1. Define the variables

    1.1 Use the get_option() function to get the plugin options 
        get_option ( 'option_name', default options* );

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // $args are passed from the add_settings_field() function in settings-register.php 
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Check if the id of the options is set, and if so, sanitize that variable, if not, then set it to an empty string
    $selected_option = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';

    // Define an array that contains the radio options
    $radio_options = [
                        'enable' => 'Enable custom styles',
                        'disable' => 'Disable custom styles'
                     ];
    
    // Loop through the array and check if the current radio option is selected using the checked() function, and display the markup for the different radio options
    foreach ($radio_options as $value => $label ) {
        
        $checked = checked( $selected_option === $value, true, false );

        // 2. Output the field markup
        echo '<label><input 
                    name  = "myplugin_options[' . $id . ']" 
                    type  = "radio"
                    value = "' . $value . '"
                    '. $checked .'>';
        
        echo '<span>' . $label . '</span></label><br>';
    }

}

//callback: textarea field
function myplugin_callback_field_textarea($args) {

    /************************************************************************
    
    1. Define the variables
    1.1 Use the get_option() function to get the plugin options 

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // $args are passed from the add_settings_field() function in settings-register.php 
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Returns an array of allowed HTML tags to enable the user to add basic markup to the textarea option
    $allowed_tags = wp_kses_allowed_html('post');

    // Check if the id of the options is set, and if so, sanitize that variable, if not, then set it to an empty string
    //wp_kses and stripslashes_deep sanitize the variable
    $value = isset($options[$id]) ? wp_kses(stripslashes_deep($options[$id]), $allowed_tags ) : '';

    // 2. Output the field markup
    echo '<textarea 
                id    = "myplugin_options_' . $id . '" 
                name  = "myplugin_options[' . $id . ']" 
                rows  = "5"
                cols  = "50">' . $value . '</textarea>';

    echo '<br>';
    
    echo '<label for="myplugin_options_' . $id . '">' . $label . '</label>';
}

//callback: checkbox field
function myplugin_callback_field_checkbox($args) { 

        /************************************************************************
    
    1. Define the variables

    1.1 Use the get_option() function to get the plugin options 
        get_option ( 'option_name', default options* );

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // $args are passed from the add_settings_field() function in settings-register.php 
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Check if the id of the options is set, and if so, check if it is checked, if not, then set $checked to an empty string
    $checked = isset($options[$id]) ? checked($options[$id], true, false) : '';

    // Output the markup which will appear on the settings page
    echo '<input 
                id    = "myplugin_options_' . $id . '" 
                name  = "myplugin_options[' . $id . ']"
                type  = "checkbox"
                value = "1" '. 
                $checked . '>';
    echo '<label for="myplugin_options_' . $id . '">' . $label . "</label>";

}

//callback: select field
function myplugin_callback_field_select($args) {

    /************************************************************************
    
    1. Define the variables

    1.1 Use the get_option() function to get the plugin options 
        get_option ( 'option_name', default options* );

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // $args are passed from the add_settings_field() function in settings-register.php 
    $id     = isset($args['id'])    ? $args['id']    : '';
    $label  = isset($args['label']) ? $args['label'] : '';

    // Check if the id of the options is set, and if so, sanitize that variable, if not, then set it to an empty string
    $selected_option = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';

    // Define an array that contains the select options
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
    
    // Output the markup which will appear on the settings page
    echo '<select id="myplugin_options_' . $id . '" name="myplugin_options[' . $id . ']" >';
    
    //Loop through the options to display them
    foreach ($select_options as $value => $option) {
        // Use the selected() function to determine which option is selected
        $selected = selected($selected_option === $value, true, false);

        echo '<option value=" ' . $value . '"' . $selected . '>' . $option . '</option>';
    }
    echo '</select>';
    echo '<label for="myplugin_options_' . $id . '">' . $label . "</label>";

}

