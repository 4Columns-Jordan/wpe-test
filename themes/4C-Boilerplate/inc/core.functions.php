<?php
/**
 * Core functions for the Four Columns Boilerplate.
 * @version 1.0
 */

// =============================================================================
// Create 4C Custom Block Category =============================================
function FCBP__custom_block_category($categories, $post)
{
  return array_merge($categories, [
    [
      'slug' => '4c-blocks',
      'title' => __('4C Blocks', '4c-blocks'),
    ],
  ]);
}
add_filter('block_categories_all', 'FCBP__custom_block_category', 10, 2);

// =============================================================================
// Custom Menu Location ========================================================
add_action( 'after_setup_theme', 'FCBP__register_custom_menues' );
function FCBP__register_custom_menues() {
  register_nav_menu( 'topNav', __( 'Top Navigation') );
  register_nav_menu( 'footerNav', __( 'Footer Navigation') );
}

// =============================================================================
// Removing Nav Link Class =====================================================
function FCBP__remove_nav_replace() {
  remove_filter( 'genesis_attr_nav-link', 'genesis_attributes_nav_link' );
}
add_action( 'after_setup_theme', 'FCBP__remove_nav_replace' );

// =============================================================================
// Removing Footer Widget Area =================================================
function FCBP__remove_genesis_footer_widgets() {
  remove_filter('genesis_before_footer', 'genesis_footer_widget_areas');
}
add_action( 'after_setup_theme', 'FCBP__remove_genesis_footer_widgets' );

// =============================================================================
// Register Nav Walker ========================================================== 
function FCBP__register_navwalker(){
	require_once get_stylesheet_directory() . '/lib/bootstrap-nav-walker.php';
}
add_action( 'after_setup_theme', 'FCBP__register_navwalker' );

// =============================================================================
// Get Custom Author ===========================================================
/**
 * This function will return the author or guest author.
 * All it needs is the ID of the post.
 * Use this instead of get_the_author_meta.
 */
function FCBP__get_custom_author($postID){
    $authorID = get_post_field('post_author', $postID);
    $author = '';
    if(isset($authorID)){
        $author = get_the_author_meta('display_name', $authorID);
    }
    if (function_exists('get_field')){
        $hasGuestAuthor = get_field('use_guest_author', $postID);
        if ($hasGuestAuthor != 'false' && !is_null($hasGuestAuthor)){
        $author = get_field('guest_author_name', $postID);
        }
    }
    return $author;
}
  
// =============================================================================
// Build Logo Svg ==============================================================
/**
 * This function builds the logo svg code. There are two options: object and inline
 * Inline will inline the svg code. This lets you animate easily with css and js
 * object treats the svg closer to a traditional image. but allows for a fallback
 * image if the svg cannot be loaded properly.
 * 
 * The path paramater lets you specify a different path should you want to do
 * that
 * 
 * Defaults to object loading and /images/logo.svg
 */
function FCBP__build_logo_svg($type = 'object', $path = ''){
    $logoUrl = '';
    if ($type === 'object') {
        if($path === ''){
        $logoUrl = get_stylesheet_directory_uri() . '/images/logo.svg';
        } else {
        $logoUrl = $path;
        }
        $finalLogo = '<object id="navbar-logo" data="' . $logoUrl . '" type="image/svg+xml"><span class="fallback_logo"></span></object>';
    } else {
        if($path === ''){
        $logoUrl = get_stylesheet_directory() . '/images/logo.svg';
        } else {
        $logoUrl = $path;
        }
        $encodedUrl = urldecode($logoUrl);
        $finalLogo = file_get_contents($encodedUrl);
    }
    echo $finalLogo;
}

// =============================================================================
// Manually rendering acf blocks ===============================================
/**
 * This function Renders acf blocks
 * example usage: FCBP__render_acf_block('acf/pagehead', ['subtitle_text' => $subTitle]);
 * @param $block_name: String - Acf Block Name
 * @param $attrs: array - array of acf fields and their values
 * @param $content: string - String of inner content if applicable
 * @param $className: string - Custom class for the block
 */
function FCBP__render_acf_block( $block_name = '', $attrs = [], $content = '', $className = '' ) {
    // This code runs if the blockname field is left empty.
    // It will output all available blocks
    if( $block_name === '') {
        if (!is_user_logged_in() && !current_user_can('administrator')) return;
        // Returns an array of block names to use
        var_dump(array_keys(acf_get_store('block-types')->data));
        return;
    }
    $block = acf_get_store( 'block-types' )->data[$block_name];
    $is_preview = false;
    foreach( $attrs as $attr => $val) {
        $block['data'][$attr] = $val;
    }
    // Setting the renderedFromFunction field to True
    $block['data']['renderedFromFunction'] = true;
    // Passing string of classes
    $block['className'] = $className;
    // var_dump($block);
    echo acf_rendered_block( $block, $content, $is_preview );
  }

// =============================================================================
// Styles ======================================================================
function FCBP__registerAdminStyles(){
    $styleLink = get_stylesheet_directory_uri() . '/css/admin.css';
    $fileTime = filemtime(get_stylesheet_directory() . '/css/admin.css');
    wp_enqueue_style('FCBP__adminStyle', $styleLink , array(), $fileTime , 'all');
}
add_action('admin_head', 'FCBP__registerAdminStyles', 1, null);
  
// =============================================================================
// Register Single Widget area =================================================
function FCBP__registerSingleWidgetArea(){
    $args = array(
        'name' => 'Single Page Sidebar',
        'id' => 'fcbp__single_sidebar',
        'before_widget' => '<div class="single__widgetArea">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="single__widgetTitle">',
            'after_title'   => '</h2>',
    );
    register_sidebar($args);
}
add_action('widgets_init', 'FCBP__registerSingleWidgetArea', 1, null);
  
// =============================================================================
// Setting the default private category ========================================
function FCBP__createPrivateCat() {
    $privateId  = wp_create_category('Private');
}
add_action('admin_init', "FCBP__createPrivateCat");
  
// =============================================================================
// Removing Private From All loops =============================================
function FCBP__hidePrivateCategory( $query ) {
    if ( !is_admin() ) {
        $catID = get_cat_ID('private');
        $query->set( 'cat', '-' . $catID );
    }
    return $query;
}
add_action( 'pre_get_posts', 'FCBP__hidePrivateCategory' );

// =============================================================================
// Addding the Wp-head Include =================================================
function FCBP__registerWpHead(){
    get_template_part('templates/wp', 'head');
}
add_action('wp_head', 'FCBP__registerWpHead', 99);

// =============================================================================
// Google Fonts ================================================================
function FCBP__echoPreconnects() {
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>'. PHP_EOL;
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
}
add_action('wp_head', 'FCBP__echoPreconnects', 5);
  
// =============================================================================
// Theme Options Page ==========================================================
function FCBP__addOptionsPages() {
    if( function_exists('acf_add_options_page') ) {
    // Register FCBP options page.
    $mainPage = acf_add_options_page(array(
        'page_title'    => __('Boilerplate General Settings'),
        'menu_title'    => __('FCBP Settings'),
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => true
    ));
    $fontsPage = acf_add_options_page(array(
        'page_title'  => __('Font Settings'),
        'menu_title'  => __('Fonts'),
        'parent_slug' => $mainPage['menu_slug'],
    ));
    $hiddenPage = acf_add_options_page(array(
        'page_title'  => __('Deep Settings'),
        'menu_title'  => __('Deep Settings'),
        'parent_slug' => $mainPage['menu_slug'],
    ));
    }
}
add_action('acf/init', 'FCBP__addOptionsPages');

// =============================================================================
// Fetch google fonts ==========================================================
// this only runs on the fonts page load...
function FCBP__fetchGoogleFonts( $field ) {
    // Fetching google fonts
    $f = curl_init();
    curl_setopt($f, CURLOPT_URL, "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCbtNSRlEHCYAo0m9-ZkWnxaFCXXvl6yOs");
    curl_setopt($f, CURLOPT_RETURNTRANSFER, 1);
    $result = json_decode(curl_exec($f), true);
    curl_close($f);

    //Setting Field Options
    $field['choices'] = array();
    if( is_array($result['items']) ) {
        foreach ($result['items'] as $item) {
        $name = $item['family'];
        $field['choices'][$name] = $name;
        }   
    }
    return $field;
}
add_filter('acf/load_field/name=fonts', 'FCBP__fetchGoogleFonts');

// =============================================================================
// Generate Stylesheet link ====================================================
function FCBP__generateStylesheetLink($value) {
    $styleStringOpen   = 'https://fonts.googleapis.com/css2?';
    $styleStringFamily = 'family=';
    $styleStringVars   = ':ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
    $styleStringClose  = '';
    $styleStringFinal  = '';
    if ($value){
        foreach ($value as $font) {
        $font = explode(' ', $font);
            if(is_array($font)) {
            $tempFont = '';
            foreach($font as $w) {
                $tempFont = $tempFont . $w . '+';
            }
            $font = substr($tempFont, 0 , -1);
            }
            $styleStringFinal = $styleStringFinal . '&' . $styleStringFamily . $font . $styleStringVars;
        }
    }

    $styleStringFinal = $styleStringOpen . $styleStringFinal . $styleStringClose;
    update_field('style_string', $styleStringFinal , 'options');
    return $value;
}
add_filter('acf/update_value/name=fonts', 'FCBP__generateStylesheetLink');

// =============================================================================
// Enqueue fonts ===============================================================
function FCBP__enqueueFonts() {
    if (!function_exists('get_field')):
        return;
    endif;
    $fontsString = get_field('style_string', 'options');
    wp_enqueue_style('FCBP-google-fonts', $fontsString, array(), null);
}
add_action('init', 'FCBP__enqueueFonts' , 6, null);

// =============================================================================
// Trim to words ===============================================================
//Trims the input string to the nearest word rather than cutting off in the mid
function FCBP__trim_to_words($text, $maxchar, $end='...') {
    if (strlen($text) > $maxchar || $text == '') {
        $words = preg_split('/\s/', $text);      
        $output = '';
        $i      = 0;
        while (1) {
            $length = strlen($output)+strlen($words[$i]);
            if ($length > $maxchar) {
                break;
            } 
            else {
                $output .= " " . $words[$i];
                ++$i;
            }
        }
        $output .= $end;
    } 
    else {
        $output = $text;
    }
    return $output;
}

// =============================================================================
// Landing Page functions ======================================================
include_once 'landing_page.functions.php';

/** ============================================================================
 *  Getting template file names by directory ===================================
 *
 * This function scans a given directory for PHP files whose names start with a 
 * provided template slug and extracts template names from these files.
 *
 * @param string $templatePath - The directory to search for template files.
 * @param string $templateSlug - (Optional) The prefix that template file names 
 *                               should start with.
 * @return array               - An associative array where keys are template 
 *                               file names (without '.php') and values are 
 *                               formatted template names.
 * 
 * Ex: $array = FCBP__getTemplateNames('templates/landing_page/', 'landing-');
 */
function FCBP__getTemplateNames($templatePath = '', $templateSlug = '') {
    // Initialize an empty array to store the result.
    $result = array();
    // Getting the length of the template slug
    $nameLength = strlen($templateSlug);
    // Open the directory.
    if ($handle = opendir($templatePath)) {
        while (false !== ($entry = readdir($handle))) {
            // Check if the entry is a file and its name starts with the template starter.
            if (is_file($templatePath . '/' . $entry) && strpos($entry, $templateSlug) === 0) {
                // Extract the template name from the file name.
                $formattedName = str_replace('-', ' ', substr($entry, $nameLength, -4));
                $formattedName = ucwords($formattedName); // Convert to sentence case.
                // Add the formatted name to the result array.
                // Removing .php from file name
                $result[substr($entry, 0, -4)] = $formattedName;
            }
        }
        closedir($handle);
    }
    // Return the resulting array of template names.
    return $result;
}