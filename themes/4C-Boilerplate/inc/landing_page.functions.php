<?php
/**
 * Landing Page functions for the Four Columns Boilerplate.
 * @version 1.0
 */
// =============================================================================
// Registering Landing Page Post Type ==========================================
function FCBP__create_landing_page() {

    $labels = array(
        'name' => _x( 'Landing Pages', 'Post Type General Name', 'text_domain' ),
        'singular_name' => _x( 'Landing Page', 'Post Type Singular Name', 'text_domain' ),
        'menu_name' => __( 'Landing Pages', 'text_domain' ),
        'parent_item_colon' => __( 'Parent Item:', 'text_domain' ),
        'all_items' => __( 'All Landing Pages', 'text_domain' ),
        'view_item' => __( 'View Landing Pages', 'text_domain' ),
        'add_new_item' => __( 'Add New Landing Page', 'text_domain' ),
        'add_new' => __( 'Add New Landing Page', 'text_domain' ),
        'edit_item' => __( 'Edit Landing Page', 'text_domain' ),
        'update_item' => __( 'Update Landing Page', 'text_domain' ),
        'search_items' => __( 'Search Landing Pages', 'text_domain' ),
        'not_found' => __( 'Landing Page Not Found', 'text_domain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
        'label' => __( 'landing_page', 'text_domain' ),
        'description' => __( 'Landing Pages', 'text_domain' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'thumbnail', ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-analytics',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'template' => array(
            array( 'core/paragraph', array(
                'placeholder' => 'Add landing page content here...',
            ) ),
        ),
    );
    register_post_type( 'landing_page', $args );

}
add_action( 'init', 'FCBP__create_landing_page', 0 );

// =============================================================================
// Registering Header Settings Meta Box ========================================
function FCBP__add_meta_boxes() {
    add_meta_box(
        'FCBP-landingpage-header-settings',
        'Header Settings',
        'FCBP_render_header_settings_meta_box',
        'landing_page',
        'side',
        'high'
    );
    add_meta_box(
        'FCBP-landingpage-footer-settings',
        'Footer Settings',
        'FCBP_render_footer_settings_meta_box',
        'landing_page',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'FCBP__add_meta_boxes');

// =============================================================================
// Rendering the forms =========================================================
function FCBP_render_header_settings_meta_box($post) {
    $show_header = get_post_meta($post->ID, '_fcbp_show_header', true);
    ?>
    <label>
        <input type="radio" name="_fcbp_show_header" value="true" <?php checked($show_header, 'true'); ?>>
        Show Header
    </label>
    <br>
    <label>
        <input type="radio" name="_fcbp_show_header" value="false" <?php checked($show_header, 'false'); ?>>
        Hide Header
    </label>
    <?php
}
// Footer Form
function FCBP_render_footer_settings_meta_box($post) {
    $show_header = get_post_meta($post->ID, '_fcbp_show_footer', true);
    ?>
    <label>
        <input type="radio" name="_fcbp_show_footer" value="true" <?php checked($show_header, 'true'); ?>>
        Show Footer
    </label>
    <br>
    <label>
        <input type="radio" name="_fcbp_show_footer" value="false" <?php checked($show_header, 'false'); ?>>
        Hide Footer
    </label>
    <?php
}

// =============================================================================
// Saving the meta fields ======================================================
function FCBP__save_header_settings_meta_box($post_id) {
    if (get_post_type($post_id) == 'landing_page') {
        $show_header = isset($_POST['_fcbp_show_header']) ? $_POST['_fcbp_show_header'] : '';
        update_post_meta($post_id, '_fcbp_show_header', $show_header);
    }
}
add_action('save_post', 'FCBP__save_header_settings_meta_box');

function FCBP__save_footer_settings_meta_box($post_id) {
    if (get_post_type($post_id) == 'landing_page') {
        $show_header = isset($_POST['_fcbp_show_footer']) ? $_POST['_fcbp_show_footer'] : '';
        update_post_meta($post_id, '_fcbp_show_footer', $show_header);
    }
}
add_action('save_post', 'FCBP__save_footer_settings_meta_box');

// =============================================================================
// ACF Portfolio template logic ================================================
// https://www.advancedcustomfields.com/resources/custom-location-rules-v5-8/
function FCBP__addTemplateRuleChoice( $choices ) {
    // Adding the portfolio group and template name in the selection
    $choices['Landing Page']['landing_page_template'] = 'Template Name';
    return $choices;
}
add_filter('acf/location/rule_types', 'FCBP__addTemplateRuleChoice');
  
// Adding the template files to the choices
function FCBP__templateChoices( $choices ) {
// Getting template files
$templates = FCBP__getTemplateNames(get_stylesheet_directory() . '/templates/landing_page', 'landing_page-');
    if( $templates ) {
        // Setting no template choice
        $choices['notemplate'] = 'No Template';
        foreach( $templates as $file => $template ) {
            $choices[ $file ] = $template ;
        }
    }
    return $choices;
}
add_filter('acf/location/rule_values/landing_page_template', 'FCBP__templateChoices');

// Checking against the new conditions
function FCBP__templateNameRuleMatch( $match, $rule, $options, $field_group ) {
    // Setting notemplate as the default if the field is unset for some reason
    $current_template = get_field('landing_page_template_type', get_the_ID()) ?: 'notemplate';
    // If use template is false return false. This removes the field group even though the
    // template type field is still "technically" set
    if(!get_field('landing_page_use_template', get_the_ID())) return false;
    $selected_template = (string) $rule['value'];
    if($rule['operator'] == "==") {
        $match = ( $current_template == $selected_template );
    }
    elseif($rule['operator'] == "!=") {
        $match = ( $current_template != $selected_template );
    }
    return $match;
}
add_filter('acf/location/rule_match/landing_page_template', 'FCBP__templateNameRuleMatch', 10, 4);

function FCBP__load_landing_page_template_field_choices( $field ) {
    // Reset choices
    $field['choices'] = array();
    // Check to see if Repeater has rows of data to loop over
    $templates = FCBP__getTemplateNames(get_stylesheet_directory() . '/templates/landing_page', 'landing_page-');
    $field['choices']['notemplate'] = 'No Template';
    if( $templates ) {
        foreach( $templates as $file => $template ) {
            $field['choices'][ $file ] = $template;
        }   
    }
    // Return the field
    return $field;
}
add_filter('acf/load_field/name=landing_page_template_type', 'FCBP__load_landing_page_template_field_choices');

// =============================================================================
// Checking if the portfolio is using the editor or a template ================
add_action( 'admin_init', 'FCBP__hide_landing_page_editor' );
function FCBP__hide_landing_page_editor() {
  $post_id;
  if(isset($_GET['post'])) {
    $post_id = $_GET['post'];
  }
  elseif(isset($_POST['post_ID'])){
    $post_id = $_POST['post_ID'];
  }
  if( !isset( $post_id ) ) return;
  $hideEditor = get_field('landing_page_use_template', $post_id);
  if($hideEditor){ 
    remove_post_type_support('landing_page', 'editor');
  }
}