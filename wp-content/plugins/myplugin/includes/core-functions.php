<?php 
/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/
// function security_direct_file_call() {
    
// }
//Exit if file is called directly
if (!defined ('ABSPATH')) {

    exit;

}

//custom login logo url
function myplugin_custom_login_url($url) {
    /************************************************************************
    1. Use the get_option() function to get the plugin options 
    
        get_option ( 'option_name', default options* );
        'option_name' is defined in the register_setting() function in settings-register.php as option_name
        *: Default options to use to use if plugin options are not available in the database

    ************************************************************************/
    $options = get_option('myplugin_options', myplugin_options_default());

    // 2. Check if the custom url is set, and is not empty. If so, sanitize the URL using esc_url()
    if (isset($options['custom_url']) && !empty($options['custom_url'])) {
        
        $url = esc_url($options['custom_url']);

    }
    // 3. Return the URL
    return $url;

}

// 4. Add a filter that changes the login header URL
add_filter('login_headerurl', 'myplugin_custom_login_url');


//custom login logo title
function myplugin_custom_login_title($title) {
    
    //1. Use the get_option() function to get the plugin options 
    $options = get_option('myplugin_options', myplugin_options_default());

    // 2. Check if the custom title is set, and is not empty. If so, sanitize the title using esc_attr()
    if (isset($options['custom_title']) && !empty($options['custom_title'])) {
        
        $title = esc_attr($options['custom_title']);

    }
    // 3. Return the title
    return $title;

}

// 4. Add a filter that changes the login header Title
add_filter( 'login_headertext', 'myplugin_custom_login_title');


// custom login styles
function myplugin_custom_login_styles() {
	
    $styles = false;
    
	//1. Use the get_option() function to get the plugin options
	$options = get_option( 'myplugin_options', myplugin_options_default() );
    
    // 2. Check if the custom style is set, and is not empty. If so, sanitize the title using esc_attr()
	if ( isset( $options['custom_style'] ) && ! empty( $options['custom_style'] ) ) {
		
		$styles = sanitize_text_field( $options['custom_style'] );
		
	}
	
	if ( 'enable' === $styles ) {
            
        wp_enqueue_style( 
            // 	string           $handle, 
            'myplugin',
            // 	string           $src = '', 
            plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/myplugin-login.css', 
            // 	array            $deps = array(), 
            array(), 
            // 	string|bool|null $ver = false, 
            null, 
            // 	string           $media = 'all' 
            'screen' 
        );
        
        wp_enqueue_script( 
            // 	string           $handle, 
            'myplugin', 
            // 	string           $src = '', 
            plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/myplugin-login.js', 
            // 	array            $deps = array(), 
            array(), 
            // 	string|bool|null $ver = false, 
            null, 
            // 	bool             $in_footer = false 
            true 
        );
		
	}
	
}

add_action( 'login_enqueue_scripts', 'myplugin_custom_login_styles' );


//custom login message
function myplugin_custom_login_message($message) {
    //1. Use the get_option() function to get the plugin options 
    $options = get_option('myplugin_options', myplugin_options_default());
    
    // 2. Check if the custom message is set, and is not empty. If so, sanitize the message using wp_kses_post()
    if (isset($options['custom_message']) && !empty($options['custom_message'])) {
        
        $message = wp_kses_post($options['custom_message']) . $message;

    }
    // 3. Return the message
    return $message;
}
// 4. Add a filter to change the message to display above the login form
add_filter('login_message', 'myplugin_custom_login_message');