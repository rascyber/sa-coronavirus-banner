<?php
/**
 * Initialises the plugin requriements.
 *
 */

namespace BW\Covid19;

require_once 'admin/script.php';
require_once 'admin/settings.php';
require_once 'banner.php';

/**
 * Initialises the app.
 */
function bw_covid_19() {

	add_action( 'admin_enqueue_scripts', 'BW\Covid19\Script\add_color_picker' );

	add_action( 'wp_enqueue_scripts', 	 'BW\Covid19\Script\banner_height' );

	add_action( 'admin_init', 					 'BW\Covid19\SettingsPage\settings' );

 	add_action( 'admin_menu', 					 'BW\Covid19\SettingsPage\options' );

	add_action( 'wp_footer', 						 'BW\Covid19\BannerDisplay\banner' );

	add_action( 'wp_footer', 						 'BW\Covid19\BannerDisplay\banner_css' );

}

function activation_hook() {
    set_transient( 'notice-transient', true, 5 );
}


function notice(){
	$current_user = wp_get_current_user();
    /* Check transient, if available display notice */
    if( get_transient( 'notice-transient' ) ){
        ?>
        <div class="updated notice is-dismissible">
            <p>Thank you for showing the support Botswana needs to fight COVID19! <strong>You are awesome</strong>!</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'fx-admin-notice-example' );
    }
}
