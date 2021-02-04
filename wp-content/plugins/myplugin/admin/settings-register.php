<?php 
/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/

//Exit if file is called directly
if (!defined ('ABSPATH')) {

    exit;

}

/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/ 
    /************************************************************
    *                  Register Settings Function               *
    ************************************************************/
function myplugin_register_settings() {
    //register_setting(
    //  string $option_group,
    //  string $option_name,
    //  callable $sanitize_callback
    //);
    
    /************************************************************
     * 1) Register the settings section in the options table
    ************************************************************/
    register_setting(
    //  string $option_group,
    /* must match the value included under settings_field in the myplugin_display_settings_page() function */
        'myplugin_options',

    //  string $option_name,
        'myplugin_options',

    //  callable $sanitize_callback    
        'myplugin_callback_validate_options'
    );

    /************************************************************
     * 2) Add settings section to the back end (Login Area)
    ************************************************************/
    //add_settings_section(
    //  string $id,
    //  string $title,
    //  callable $callback,
    //  string $page
    //);
    add_settings_section(
    //  string $id,    
        'myplugin_section_login',

    //  string $title,
        esc_html__('Customize Login Page', 'myplugin'),

    //  callable $callback,
        'myplugin_callback_section_login',
    
    // Should match the "slug" in the add_submenu_page() function and the "output setting section" included within the myplugin_display_settings_page() function

    //  string $page
        'myplugin'
    );

    /************************************************************
     * 3) Add fields to change the settings in the back end
    ************************************************************/
    /*
        add_settings_field(
            string   $id,
            string   $title,
            callable $callback,
            string   $page,
            string   $section = 'default',
            array    $args = []
        );
    */
    // Custom URL field
    add_settings_field(
        // string   $id,
        // Used to retrieve the setting from the database
        'custom_url',
        // string   $title,
        // This parameter will be displayed next to the setting to
        esc_html__('Custom URL', 'myplugin'),
        // callable $callback,
        // The name of the function with the markup to display the setting. MUST BE DEFINED LATER
        'myplugin_callback_field_text',
        // string   $page,
        // The page on which the setting should be displayed
        // Should match the menu slug specified in the add_submenu_page() function
        'myplugin',
        //string   $section = 'default',
        // The section that should display the setting.
        // Should match the section ID specified in the add_settings_section() above
        'myplugin_section_login',
        // array    $args = []
        // An array of data we want to pass to the callback function
        [   
            // field id, label
            // Facilitates writing the callback functions for the settings
            'id'    => 'custom_url', 
            'label' => esc_html__('Custom URL for the login logo link', 'myplugin'),
        ]
    );

    // Custom Title field
    add_settings_field(
        // string   $id,
        'custom_title',
        // string   $title,
        esc_html__('Custom Title', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_text',
        // string   $page,
        'myplugin',
        // string   $section = 'default',
        'myplugin_section_login',
        // array $args = []
		[ 
            'id' => 'custom_title', 
            'label' => esc_html__('Custom title attribute for the logo link', 'myplugin') 
        ]
	);

    // Custom CSS field
    add_settings_field(
        // string   $id,
        'custom_style',
        // string   $title,
        esc_html__('Custom Style', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_radio',
        // string   $page,
        'myplugin',
        //string   $section = 'default',
        'myplugin_section_login',
        // array    $args = []
        [ 
            'id' => 'custom_style', 
            'label' => esc_html__('Custom CSS for the login screen', 'myplugin')
        ]
    );

    // Custom Message field
    add_settings_field(
        // string   $id,
        'custom_message',
        // string   $title,
        esc_html__('Custom Message', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_textarea',
        // string   $page,        
        'myplugin',
        //string   $section = 'default',               
        'myplugin_section_login',
        // array    $args = []
		[ 
            'id' => 'custom_message', 
            'label' => esc_html__('Custom text and/or markup', 'myplugin') 
        ]
	);    

     /************************************************************
     * 4) Add another settings section to the back end (Admin Area)
     ************************************************************/  
    add_settings_section(
        //  string $id,    
            'myplugin_section_admin',
    
        //  string $title,
            esc_html__('Customize Admin Area', 'myplugin'),
    
        //  callable $callback,
            'myplugin_callback_section_admin',
        
        //  string $page
            'myplugin'
    );

    /************************************************************
    *    5) Add fields to change the settings in the back end   *
    ************************************************************/
    add_settings_field(
        // string   $id,
        'custom_footer',
        // string   $title,
        esc_html__('Custom Footer', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_text',
        // string   $page,
        'myplugin',
        //string   $section = 'default',
        'myplugin_section_admin',
        // array    $args = []
		[ 
            'id' => 'custom_footer', 
            'label' => esc_html__('Custom footer text', 'myplugin'),
        ]
	);

	add_settings_field(
        // string   $id,
        'custom_toolbar',
        // string   $title,
        esc_html__('Custom Toolbar', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_checkbox',
        // string   $page,
        'myplugin',
        //string   $section = 'default',
        'myplugin_section_admin',
        // array    $args = []
		[ 
            'id' => 'custom_toolbar', 
            'label' => esc_html__('Remove new post and comment links from the Toolbar', 'myplugin'),
        ]
	);

	add_settings_field(
        // string   $id,
        'custom_scheme',
        // string   $title,
        esc_html__('Custom Scheme', 'myplugin'),
        // callable $callback,
        'myplugin_callback_field_select',
        // string   $page,
        'myplugin',
        //string   $section = 'default',
        'myplugin_section_admin',
        // array    $args = []
		[ 
            'id' => 'custom_scheme', 
            'label' => esc_html__('Default color scheme for new users', 'myplugin'), 
        ]
	);
    
}

//admin_init is a hook that only fires in the admin area
add_action('admin_init', 'myplugin_register_settings');
