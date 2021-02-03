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

function myplugin_display_settings_page() {

    //Check if the user is allowed access
    if (!current_user_can('manage_options')) return;
?>
    <section class="wrap">
        <h1><?php echo esc_html( get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
        
            <?php 
            //output security fields
            settings_fields('myplugin_options');

            //output setting sections
            do_settings_sections('myplugin');

            //Submit button
            submit_button();
            
            ?>

        </form>
    </section>
<?php

}

