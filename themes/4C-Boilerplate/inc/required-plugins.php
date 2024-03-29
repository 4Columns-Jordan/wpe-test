<?php
/**
 * Adding Required Plugins
 */
require_once (get_stylesheet_directory() . '/lib/class-tgm-plugin-activation.php');

// =============================================================================
// Adding Required Plugins =====================================================
/**
* Register the required plugins for this theme.
*
* In this example, we register two plugins – one included with the TGMPA library
* and one from the .org repo.
*
* The variable passed to tgmpa_register_plugins() should be an array of plugin
* arrays.
*
* This function is hooked into tgmpa_init, which is fired within the
* TGM_Plugin_Activation class constructor.

* Array of plugin arrays. Required keys are name and slug.
* If the source is NOT from the .org repo, then source is also required.
*/
function FCBP__register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'Gravity Forms',
            'slug'               => 'gravityforms',
            'source'             => get_stylesheet_directory() . '/config/import/plugins/gravityforms_2.6.zip',
            'required'           => false,
            'version'            => "",
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => "",
        ),
        array(
            'name'               => 'Advanced Custom Fields Pro',
            'slug'               => 'advanced-custom-fields-pro',
            'source'             => get_stylesheet_directory() . '/config/import/plugins/advanced-custom-fields-pro.zip',
            'required'           => false,
            'version'            => "",
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => "",
        ),
        array(
            'name'               => 'Theme Custom Blocks',
            'slug'               => 'four-columns-custom-bocks',
            'source'             => get_stylesheet_directory() . '/config/import/plugins/four-columns-custom-bocks.zip',
            'required'           => false,
            'version'            => "",
            'force_activation'   => false, 
            'force_deactivation' => false,
            'external_url'       => "",
        ),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'             => 'Yoast SEO',
            'slug'             => 'wordpress-seo',
            'required'         => false,
            'force_activation' => false,
        ),
        array(
            'name'             => 'EWWW Image Optimizer',
            'slug'             => 'ewww-image-optimizer',
            'required'         => false,
            'force_activation' => false,
        ),
        array(
            'name'             => 'Genesis Visual Hook Guide',
            'slug'             => 'genesis-visual-hook-guide',
            'required'         => false,
            'force_activation' => false,
        ),
    );
    /**
    * Array of configuration settings. Amend each line as needed.
    * If you want the default strings to be available under your own theme domain,
    * leave the strings uncommented.
    * Some of the strings are added into a sprintf, so see the comments at the
    * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => "",                        // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',   // Menu slug.
        'has_notices'  => true,                      // Show admin notices or not.
        'dismissable'  => true,                      // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => "",                        // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                     // Automatically activate plugins after installation or not.
        'message'      => "",                        // Message to output right before the plugins table.
        'strings'      => array(
            'page_title' => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title' => __( 'Install Plugins', 'tgmpa' ),
            'installing' => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops' => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return' => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated' => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete' => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type – can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'FCBP__register_required_plugins' );