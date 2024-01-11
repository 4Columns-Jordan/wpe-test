<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

/* INCLUDED PHP FILE TO TEST FOR MOBILE */
if(!is_admin()) {
  require_once "lib/Mobile_Detect.php";
}
// =============================================================================
// Genesis Functions ===========================================================
require_once get_stylesheet_directory() . '/inc/genesis.functions.php';

// =============================================================================
// Removing Genesis Seettings ==================================================
// Remove Genesis SEO settings from post/page editor
remove_action('admin_menu', 'genesis_add_inpost_seo_box');
// Remove Genesis SEO settings option page
remove_theme_support('genesis-seo-settings-menu');
// Remove Genesis SEO settings from taxonomy editor
remove_action('admin_init', 'genesis_add_taxonomy_seo_options');

// =============================================================================
// Custom Styles ===============================================================
function remove_global_styles_and_svg_filters() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
	remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
}
add_action('init', 'remove_global_styles_and_svg_filters');

function FCBP_register_styles() {
  /* = Theme Styles = */
  wp_enqueue_style('bootstrap',get_stylesheet_directory_uri() . '/css/bootstrap.css',[],filemtime(get_stylesheet_directory() . '/css/bootstrap.css'),'all');
  /* = Font Awesome Styles = */
  wp_enqueue_style('font-awesome',get_stylesheet_directory_uri() . '/font-awesome/css/all.css',[],filemtime(get_stylesheet_directory() . '/font-awesome/css/all.css'),'all');
  /* = Developer Styles = */
  wp_enqueue_style('FCBP-general-style',get_stylesheet_directory_uri() . '/css/general.css',[],filemtime(get_stylesheet_directory() . '/css/general.css'),'all');
  wp_enqueue_style('FCBP-colton-style',get_stylesheet_directory_uri() . '/css/colton.css',[],filemtime(get_stylesheet_directory() . '/css/colton.css'),'all');
  wp_enqueue_style('FCBP-matt-style',get_stylesheet_directory_uri() . '/css/matt.css',[],filemtime(get_stylesheet_directory() . '/css/matt.css'),'all');
  wp_enqueue_style('FCBP-jordan-style',get_stylesheet_directory_uri() . '/css/jordan.css',[],filemtime(get_stylesheet_directory() . '/css/jordan.css'),'all');
  /* = Register for later use = */
  wp_register_style('swiper-style', get_stylesheet_directory_uri() . '/css/swiper.7.4.1.css', array(), 'all');
  /* = Adding Theme Editor Colors to Front End = */
	wp_add_inline_style( 'FCBP-general-style', FCBP__generateColorPalleteCss() );
}
add_action('wp_enqueue_scripts', 'FCBP_register_styles');
// =============================================================================
// Adding Custom JavaScript ====================================================
function FCBP__register_scripts() {
  /* = Theme Scripts = */
  wp_enqueue_script('bootstrap',get_stylesheet_directory_uri() . '/js/bootstrap.min.js',['jquery'],filemtime(get_stylesheet_directory() . '/js/bootstrap.min.js'),true);
  wp_enqueue_script('FCBP-lottie',get_stylesheet_directory_uri() . '/lib/lottie/lottie.js',['jquery'],filemtime(get_stylesheet_directory() . '/lib/lottie/lottie.js'),false);
  wp_enqueue_script('FCBP-lottie-interactivity',get_stylesheet_directory_uri() . '/lib/lottie/lottie-interactivity.js',['jquery'],filemtime(get_stylesheet_directory() . '/lib/lottie/lottie-interactivity.js'),false);
  wp_enqueue_script('FCBP-custom-js',get_stylesheet_directory_uri() . '/js/custom.js',['jquery'],filemtime(get_stylesheet_directory() . '/js/custom.js'),true);
  /* = Developer Scripts = */
  wp_enqueue_script('FCBP-jordan-js',get_stylesheet_directory_uri() . '/js/jordan.js',['jquery'],filemtime(get_stylesheet_directory() . '/js/jordan.js'),true);
  wp_enqueue_script('FCBP-matt-js',get_stylesheet_directory_uri() . '/js/matt.js',['jquery'],filemtime(get_stylesheet_directory() . '/js/matt.js'),true);
  wp_enqueue_script('FCBP-colton-js',get_stylesheet_directory_uri() . '/js/colton.js',['jquery'],filemtime(get_stylesheet_directory() . '/js/colton.js'),true);
  wp_register_script('swiper-script', get_stylesheet_directory_uri() . '/js/swiper.7.4.1.min.js', array('jquery'), true);
  wp_register_script('FCBP-modal',get_stylesheet_directory_uri() . '/js/modal.js', array('jquery'), true);
  wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDR3nHtRqxi5JvEaPD2VliefcdH4BaB5O8&callback=initMap', array('jquery'), true);

}
add_action('wp_enqueue_scripts', 'FCBP__register_scripts');

// =============================================================================
// Adding Admin JavaScript ====================================================
function FCBP__admin_scripts() {
  wp_enqueue_script( 'fcbp-admin', get_stylesheet_directory_uri() . '/js/admin.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_style('fcbp-admin', get_stylesheet_directory_uri() . '/css/admin.css');
}
add_action( 'admin_enqueue_scripts', 'FCBP__admin_scripts' );

// =============================================================================
// Required Plugins ============================================================
require_once get_stylesheet_directory() . '/inc/required-plugins.php';

// =============================================================================
// Core Functions ==============================================================
require_once get_stylesheet_directory() . '/inc/core.functions.php';

// =============================================================================
// Editor Functions ============================================================
require_once get_stylesheet_directory() . '/inc/editor.functions.php';

/** ============================================================================
 * Get posts ajax ==============================================================
 * To use this with a block, fill out the postType, privateCat, postsPerPage, 
 * and args variables. Then Fill out the tempArray variable with the information
 * needed from the post. Remember you can get fields here as well, but you need
 * to pass the post ID as the second paramater. Lastly uncomment the actions
 * after the function and you can start using the endpoint!
 * 
 * Check out the ajax posts block for more in-depth usage.
 */
function FCBL__get_posts_ajax() {
// Set your args here
  $postType     = 'post';
  $privateCat   = get_cat_ID('private');
  $postsPerPage = 8;
  $args = array(
    'post_type'        => array($postType),
    'post_status'      => array('publish'),
    'posts_per_page'   => $postsPerPage,
    'nopaging'         => false,
    'order'            => 'DESC',
    'orderby'          => 'date',
    'category__not_in' => array($privateCat),
  );

  $args['paged'] = $_POST['page']?:1;

  $ajaxposts = new WP_Query( $args );
  $postArr = array();
  foreach ($ajaxposts->posts as $ajaxpost) {

    $tempArr = array(
      'id'          => $ajaxpost->ID,
      'title'       => FCBP__trim_to_words(get_the_title($ajaxpost->ID,), 45),
      'url'         => get_permalink($ajaxpost->ID),
      'thumb'       => get_the_post_thumbnail_url($ajaxpost->ID, 'preview-thummb'),
      'excerpt'     => FCBP__trim_to_words(get_the_excerpt($ajaxpost->ID), 150, '...'),
      'date'        => get_the_time('F j, Y', $ajaxpost->ID),
      'author'      => get_the_author_meta( 'display_name' , $ajaxpost->post_author ),
      'temp'        => $ajaxpost,
      'mobileThumb' => get_the_post_thumbnail_url($ajaxpost->ID, 'mobile-thumb'),
    );
    array_push($postArr, $tempArr);
  }
  echo json_encode( $postArr );

  exit;
}
//Adding the above function to the ajax endpoint
// add_action('wp_ajax_get_posts_ajax', 'FCBL__get_posts_ajax');
// add_action('wp_ajax_nopriv_get_posts_ajax', 'FCBL__get_posts_ajax');

// =============================================================================
// Localize ajax url ===========================================================

function FCBP__localize_ajax_url() {
  global $wp_query;
  /**
   * INSTRUCTIONS:
   * This function will localize the ajax script so that the js stays in scope.
   * To use fill out variable names below and uncomment the add_action beneath
   * the function. Duplicate as necessary (Dont forget to change the function 
   * names)
   * 
   * pathToJs: The path to the ajax script for the block
   * blockName: Name of block AND JS object that contnains the ajax post URL
   * blockSlug: The registered block slug. All lowercase, ACF blocks start with acf/
   * 
   * If you need an example this has been used on many sites in the past, 
   * like Rockstep.
   * 
   */
  $pathToJs  = '';
  $blockName = '';
  $blockSlug = ''; // EX: acf/ajaxposts
  if(has_block( $blockSlug )) {
    wp_enqueue_script($blockName . '_ajax', plugins_url($pathToJs, __FILE__), array('jquery'), '3', true);
    wp_localize_script($blockName . '_ajax', $blockName . '_ajax', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
    ));
  }
}
// add_action('wp_enqueue_scripts', 'FCBP__localize_ajax_url');

// =============================================================================
// Begin Custom Functions ======================================================
// =============================================================================
// Adding Excerpts to pages ===================================================
add_post_type_support( 'page', 'excerpt' );
// =============================================================================
// Removing genesis menus ======================================================
remove_theme_support( 'genesis-menus' );

// =============================================================================
// Changing the GF submit button ================================================
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    // There has to be a better way?? This is way more complicated than it used to be
    $dom = new DOMDocument();
    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
    $div = $dom->createElement( 'div' );
    $div->setAttribute('class', 'wp-block-button');
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $classes = $input->getAttribute( 'class' );
    $classes .= " wp-block-button__link";
    $new_button->setAttribute( 'class', $classes );
    $input->parentNode->replaceChild( $new_button, $input );
    $div->appendChild($new_button);
    return $dom->saveHtml( $div );
}
// =============================================================================
// Registering Footer widget area ==============================================
function FCBP__registerFooterCopy() {
  register_sidebar(array(
      'name'          => 'Footer Copy',
      'id'            => 'footer-copy',
      'description'   => 'Add widgets here for the footer copy area.',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'FCBP__registerFooterCopy');

// =============================================================================
// Adding the Dashboard widget for the footer verse =============================
// Register custom dashboard widget
add_action( 'wp_dashboard_setup', 'FCBP__bannerTextidget' );
function FCBP__bannerTextidget() {
    wp_add_dashboard_widget(
        'fcbp__bannerTextWidget',
        'Banner Text',
        'FCBP__bannerTextCallback'
    );
}

// Custom dashboard widget callback function
function FCBP__bannerTextCallback() {
    ?>
    <style>
      .banner_text_wrapper{
        display: flex;
        flex-direction: column;
      }
      .banner_text_wrapper input{
        margin-top: 8px;
        margin-bottom: 24px;
      }
      .banner_text_btn_wrapper{
        display: flex;
        gap: 16px;
      }
      .banner_text_spinner {
        display: inline-block;
        opacity: 0;
        transition: all ease-in .155s;
      }
      .banner_text_spinner.active{
        opacity: 1;
      }
      .banner_text_spinner.active i{
        animation: spin 1s linear infinite;
      }
      .banner_text_spinner.check i{
        animation: none;
      }
      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
    <div class="banner_text_wrapper">
        <label for="custom_text">Enter banner text:</label>
        <input type="text" id="custom_text" name="custom_text" value="<?php echo str_replace('\\', '',get_option( 'custom_text' )); ?>" />
        <label for="banner_link">Enter banner link:</label>
        <input type="text" id="banner_link" name="banner_link" value="<?php echo str_replace('\\', '',get_option( 'banner_link' )); ?>" />
        <div class="banner_text_btn_wrapper">
        <button id="banner_text_clear" class="button button-secondary">Clear</button>
          <button id="custom_save_button" class="button button-primary">Save</button>
          <div class="banner_text_spinner">
          <i class="fas fa-spinner"></i>
          </div>
        </div>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#banner_text_clear').on('click', function(){
          $('#custom_text').val('');
        });
        $('#custom_save_button').on('click', function() {
            var custom_text = $('#custom_text').val();
            var banner_link = $('#banner_link').val();
            $('.banner_text_spinner i').removeClass('fa-check');
            $('.banner_text_spinner i').addClass('fa-spinner');
            $('.banner_text_spinner').removeClass('active check');
            $('.banner_text_spinner').addClass('active');
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'banner_text_save_text',
                    custom_text: custom_text,
                    banner_link: banner_link,
                },
                success: function(data) {
                    console.log(data);
                    $('.banner_text_spinner').addClass('check');
                    $('.banner_text_spinner i').removeClass('fa-spinner');
                    $('.banner_text_spinner i').addClass('fa-check');
                }
            });
        });
    });
    </script>
    <?php
}

// Save custom text using AJAX
add_action( 'wp_ajax_banner_text_save_text', 'FCBP__savebannerText' );
function FCBP__savebannerText() {
    $custom_text = esc_attr($_POST['custom_text']);
    update_option( 'custom_text', $custom_text );
    $banner_link = esc_attr($_POST['banner_link']);
    update_option( 'banner_link', $banner_link );
    echo str_replace('\\', '',$custom_text);
    wp_die();
}
