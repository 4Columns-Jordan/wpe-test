<?php
/*
Plugin Name: Four Columns Blocks
Plugin URI: https: //github.com/4Columns-Jordan/4C-Block-Library
Description: The Official Block Plugin for Four Columns.
Version: 1.6.0
Author: The Four Columns Team
Author URI: https: //fourcolumns.net
License: GPLv2
*/

define( 'MY_PLUGIN_DIR_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
// =============================================================================
// Registers the save and load locations for ACF ===============================

function FCBL__check_load_point($paths){
  $paths[] = plugin_dir_path(__FILE__) . 'acf-json-blocks';
  return $paths;
}

function FCBL__check_save_point($path){
  $path = plugin_dir_path(__FILE__) . 'acf-json-blocks';
  return $path;
}

function FCBL__checkSaveLocation() {
  if (!function_exists('get_field')):
    return;
  endif;
  add_filter('acf/settings/save_json', 'FCBL__check_save_point');
  add_filter('acf/settings/load_json', 'FCBL__check_load_point');
}
add_action('init', 'FCBL__checkSaveLocation' , 0, null);

// =============================================================================
// Adding default theme blocks =================================================

add_action('acf/init', 'FCBL__register_blocks');
function FCBL__register_blocks()
{
  // Check function exists.
  if (function_exists('acf_register_block_type')) {
    // Register Container Block
    acf_register_block_type([
      'name'            => 'container-block',
      'title'           => __('Container'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/container/index.php',
      'category'        => '4c-blocks',
      'icon'            => file_get_contents( plugin_dir_path(__FILE__) . '/assets/img/container.svg' ),
      'keywords'        => ['tab', 'content'],
      'enqueue_script'  => 'https://kit.fontawesome.com/e03145e654.js',
      'supports'        => array(
        'align' => false,
        'jsx' => true,
      ),
    ]);
    // Register Row Block
    acf_register_block_type([
      'name'            => 'row-block',
      'title'           => __('Row'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/row/index.php',
      'category'        => '4c-blocks',
      'icon'            => file_get_contents( plugin_dir_path(__FILE__) . '/assets/img/row.svg' ),
      'keywords'        => ['tab', 'content'],
      'enqueue_script'  => 'https://kit.fontawesome.com/e03145e654.js',
      'supports'        => array(
        'align' => false,
        'jsx' => true,
      ),
    ]);
    // Register Column Block
    acf_register_block_type([
      'name'            => 'column-block',
      'title'           => __('Column'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/column/index.php',
      'category'        => '4c-blocks',
      'icon'            => file_get_contents( plugin_dir_path(__FILE__) . '/assets/img/column.svg' ),
      'keywords'        => ['tab', 'content'],
      'enqueue_script'  => 'https://kit.fontawesome.com/e03145e654.js',
      'supports'        => array(
        'align' => false,
        'jsx'   => true,
      ),
    ]);
    // Register Basic Slider Block <-Matt-> 
    acf_register_block_type([
      'name'            => 'basic-slider',
      'title'           => __('Basic Slider'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/basic-slider/index.php',
      'category'        => '4c-blocks',
      'icon'            => 'slides',
      'keywords'        => ['slider'],
      'enqueue_style'   => plugins_url('/blocks/basic-slider/style.css', __FILE__),
    ]);
    // Register Lottie Player 
    acf_register_block_type([
      'name'            => 'lottie-player',
      'title'           => __('Lotie Player'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/lottie-player/block.php',
      'category'        => '4c-blocks',
      'icon'            => file_get_contents( plugin_dir_path(__FILE__) . '/assets/img/lottie.svg' ),
      'keywords'        => ['player', 'animation'],
      'enqueue_script'  => 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js',
    ]);
    // Register Picture Block
    acf_register_block_type([
      'name'            => 'picture-block',
      'title'           => __('Picture Block'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/picture-block/block.php',
      'category'        => '4c-blocks',
      'icon'            => file_get_contents( plugin_dir_path(__FILE__) . '/assets/img/picture-block.svg' ),
      'keywords'        => ['player', 'animation'],
    ]);
    // Register Ajax Posts Block
    acf_register_block_type([
      'name'        => 'ajaxPosts',
      'title'       => __('Ajax Posts'),
      'description' => __('A block that loads posts via ajax'),
      'render_template' => plugin_dir_path(__FILE__) . 'blocks/ajax-posts/block.php',
      'enqueue_style' => plugins_url('/blocks/ajax-posts/index.css', __FILE__),
      'enqueue_assets' => function(){
        wp_enqueue_script('FCBL-ajax-posts');
      },
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
    ]);
  }
}

// =============================================================================
// Registering default styles ==================================================

function FCBL__enqueue_styles() {
  $pluginUrl = plugin_dir_url(__FILE__);
  wp_enqueue_style('4CBlocks',plugins_url('/style.css',__FILE__), array(), 1, 'all');
}
add_action('admin_enqueue_scripts', 'FCBL__enqueue_styles');

// =============================================================================
// Register custom image sizes =================================================

function FCBL__registerCustomImageSizes() {
  if(!has_image_size('grid-gallery-square')){
    add_image_size('grid-gallery-square', 500, 500, true);
  }
  if(!has_image_size('grid-gallery-rect')){
    add_image_size('grid-gallery-rect', 600, 450, true);
  }
  if(!has_image_size('team-member-image')){
    add_image_size('team-member-image', 450, 450, true);
  }
}
add_action('init', 'FCBL__registerCustomImageSizes');

// =============================================================================
// Conditionally register team post type  ======================================
// set the && false to && true to register post type;
function FCBL__register_team_post_type () {
  if(!post_type_exists('FCBL_team') && false){
    register_post_type('FCBL_team',
        array(
          'labels' => array(
              'name'          => __('Team Members'),
              'singular_name' => __('Team member')
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array( 'title', 'editor' ),
        )
    );
  }
}
add_action('init', 'FCBL__register_team_post_type');

// =============================================================================
// Removes white space from the content? =======================================
//TODO: I'm not sure what this filter is actually doing, need to figure it out 

function FCBL__remove_white_space( $content ) {
  return preg_replace( '/[\r\n]+/', "\n", $content );
}

add_filter( 'the_content', 'FCBL__remove_white_space' );

// =============================================================================
// Register Plugin Scripts =====================================================
function FCBL__register_scripts() {
  $pluginUrl = plugin_dir_url(__FILE__);
  /** Checking if the page has the ajaxPost block. We have to
   * do it this way because acf can only register scripts in
   * the footer and this one needs to be in the header.
   */
  if(has_block( 'acf/ajaxposts' )) {
    wp_enqueue_script('FCBL-ajax-posts', $pluginUrl . 'assets/js/ajax.js', array('jquery'), '', false);
  }
}
add_action('wp_enqueue_scripts', 'FCBL__register_scripts');

// =============================================================================
// Adding Ajax Endpoint ========================================================

function FCBL__register_ajax_block_endpoint() {
    // Setting the plugin url if we need it later
    $pluginUrl = plugin_dir_url(__FILE__);
    // Get the post type from the AJAX request
    $postType     = $_POST['postType'];
    // Get the category ID for 'private'
    $privateCat   = get_cat_ID('private');
    // Get the post per page (default is 6)
    $postsPerPage = $_POST['postsPerPage'] ?: 6;
    // Get the category name from the AJAX request
    $catToUse = $_POST['cat'];
    // Define WP_Query args
    $args = array(
      'post_type'        => array($postType),
      'post_status'      => array('publish'),
      'posts_per_page'   => $postsPerPage,
      'nopaging'         => false,
      'order'            => 'DESC',
      'orderby'          => 'date',
      'category__not_in' => array($privateCat),
      'category_name' => $catToUse,
    );
    // Set the current page number from the AJAX request (default is 1)
    $args['paged'] = $_POST['page']?:1;
    // Get the total number of posts of the specified post type
    $postLength = wp_count_posts($postType);
    $totalPosts = $postLength ? $postLength->publish : 0;
    // Initialize the return array
    $postArr = array(
      'totalPosts' => $totalPosts,
      'posts' => [],
    );
    // Perform the WP_Query to retrieve posts
    $ajaxposts = new WP_Query( $args );
    // Loop through the retrieved posts
    foreach ($ajaxposts->posts as $ajaxpost) {
      // Setting the post ID as a variable
      $ID = $ajaxpost->ID;
      // Setting the placehilder image (Please change this)
      $placeholderUrl = $pluginUrl . 'assets/img/FC-no-image-found.png';
      // Getting the thumb url OR placeholder url
      $thumb = get_the_post_thumbnail_url($ID, 'preview-thummb') ?: $placeholderUrl;
      // Defining the post meta array
      $tempArr = array(
      'id'          => $ID,
      'title'       => FCBP__trim_to_words(get_the_title($ID,), 45),
      'url'         => get_permalink($ID),
      'thumb'       => $thumb,
      'excerpt'     => FCBP__trim_to_words(get_the_excerpt($ajaxpost->ID), 150, '...'),
      'date'        => get_the_time('F j, Y', $ID) . ' By ' . get_the_author_meta( 'display_name' , $ajaxpost->post_author ),
      'totalPosts' => $totalPosts,
      );
      /** == #PROTIP ==========================================
      * You can use an if statement here to check the post type
      * if the post types need different data.
      **/
      // Add the post data to the return array
      array_push($postArr['posts'], $tempArr);
    }
    // Encodeing and sending the return array
    echo json_encode( $postArr );
    // Killing the endpoint
    exit;
  }

add_action('wp_ajax_get_posts_ajax', 'FCBL__register_ajax_block_endpoint');
add_action('wp_ajax_nopriv_get_posts_ajax', 'FCBL__register_ajax_block_endpoint');

// =============================================================================
// Populating post type field ==================================================
function FCBP__populate_ajax_post_types( $field ) {
  // Reset choices to start with an empty array
  $field['choices'] = array();
  // Define arguments to retrieve all public post types
  $args = array(
    'public'   => true,
  );
  // Specify the output type as 'names'
  $output = 'names';
  // Specify the operator as 'and'
  $operator = 'and';
  // Get a list of public post types
  $post_types = get_post_types( $args, $output, $operator );
  // Loop through the array and add to field 'choices'
  if( is_array($post_types) ) {
      foreach( $post_types as $post_type ) {
          // Skipping the attachment post type
          if($post_type === 'attachment') continue;
          // Populating the option with the post type name
          $field['choices'][ $post_type ] = $post_type;   
      }
  }
  // Return the modified field options
  return $field;
}

add_filter('acf/load_field/name=ajax_post_type', 'FCBP__populate_ajax_post_types');