<?php 
/* 
The security_direct_file_call() function checks if the WordPress constant ABSPATH is defined. If it is not, that means the file is being called directly outside the WordPress and so, in that case, we abort by exiting the script. This technique prevents foul play and helps keep the plugin secure.
*/
function security_direct_file_call() {
    //Exit if file is called directly
    if (!defined ('ABSPATH')) {
        exit;
    }
}
