<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';

$hide_show_sidebar = get_theme_mod('custom_single_post_show_sidebar');
$sidebar_header_type = get_theme_mod('custom_single_post_header_backgroud_type');

// =============================================================================
// Remove Site Title ===========================================================
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// =============================================================================
// Remove Navigation ===========================================================
remove_theme_support( 'genesis-menus' );

// =============================================================================
// Removes Site Header ELements ================================================
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
// Comment this out to get the single post comments form back
remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );

// =============================================================================
// Remove Sidebar ==============================================================
if($hide_show_sidebar == 'hide' ) {
  remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
}

// =============================================================================
// Renders Header Template =====================================================
function FCBP__add_single_header()
{
  get_template_part('templates/header-v1');
}
add_action('genesis_header', 'FCBP__add_single_header');
// =============================================================================
// Add Custom Single Header ====================================================
if($sidebar_header_type == 'bg_color' || $sidebar_header_type == 'image') { 
  remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
  add_action('genesis_after_header', 'add_custom_header');
  function add_custom_header()
  {
    get_template_part('templates/single-post-header');
  }
}

// =============================================================================
// Adds Coopyright =============================================================
add_action('genesis_footer', 'FCBP__add_footer');
function FCBP__add_footer()
{
  get_template_part('templates/footer', 'FCBP__add_footer');
}
// =============================================================================
// Single Post Markup ==========================================================

function FCBP__singleHeaderMarkup(){
  $featuredImage = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $featuredId = get_post_thumbnail_id(get_the_ID());
  $featuredAlt = get_post_meta($featuredId, '_wp_attachment_image_alt', true) ?:get_the_title();
  echo '<section class="single__headerContainer">
          <img class="featuredImage featuredImage__centered" src="' . $featuredImage . '" alt="' . $featuredAlt .'"/>
          <div class="container">
            <div class="row">
              <div class="col">
                <h1>' . get_the_title() . '</h1>
              </div>
            </div>
          </div>
        </section>';
}

add_action('genesis_entry_header', 'FCBP__singleHeaderMarkup', 10, null);

function FCBP__beforeSingleBodyMarkup(){
  $sideBarId = 'fcbp__single_sidebar';
  $activeSidebar = is_active_sidebar($sideBarId);
  $contentWidth = 'col-lg-12';
  if ($activeSidebar){
    $contentWidth = 'col-lg-9';
  }
  echo '
  <section class="single__bodyContainer">
    <div class="container">
        <div class="row">';
  echo'
  <div class="' . $contentWidth . ' gx-0 single__entryContainer">
    <div class="single__entryContent">
      ';
}
add_action('genesis_before_entry_content', 'FCBP__beforeSingleBodyMarkup', 12, null);

function FCBP__singleBodyContent(){
  the_content();
}
add_action('genesis_entry_content', 'FCBP__singleBodyContent', 12, null);

function FCBP__afterSingleBodyMarkup(){
  $sideBarId = 'fcbp__single_sidebar';
  $activeSidebar = is_active_sidebar($sideBarId);
  echo ' </div>
  </div>';
  if($activeSidebar){
    echo '<div class="col-lg-3 gx-0">';
    dynamic_sidebar($sideBarId);
    echo '</div>';
  }
  echo '
      </div>
    </div>
  </section>';
}
add_action('genesis_after_entry_content', 'FCBP__afterSingleBodyMarkup', 1, null);

function FCBP__singleMetaMarkup(){
  $getCats = get_the_category();
  $postID = get_the_ID();
  $cats = '';
  foreach ($getCats as $cat) {
    $cats = $cats . $cat->name . ' ';
  }
  echo'
  <section class="single__metaContainer">
    <div class="container">
      <div class="row">
          <div class="col gx-0">
            <div class="single__metaInner">
              <span class="single__metaItem">
                  By: '. FCBP__get_custom_author($postID) .'
              </span>
              <span class="single__metaItem">
                  '. get_the_date('m/d/y') .'
              </span>
              <span class="single__metaItem">
                  Category: '.$cats.'
              </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  ';
}
add_action('genesis_after_entry_content', 'FCBP__singleMetaMarkup', 2, null);

function FCBP__openingCommentsMarkup(){
  echo'
  <section class="single__commentsContainer">
    <div class="container">
      <div class="row">
        <div class="col">
  ';
}
function FCBP__closingCommentsMarkup(){
  echo'
        </div>
      </div>
    </div>
  </section>
  ';
}

add_action('genesis_comments', 'FCBP__openingCommentsMarkup', 0, null);
add_action('genesis_comments', 'FCBP__closingCommentsMarkup', 15, null);
add_action('genesis_comment_form', 'FCBP__openingCommentsMarkup', 0, null);
add_action('genesis_comment_form', 'FCBP__closingCommentsMarkup', 15, null);

// =============================================================================
// Run Genesis Loop ============================================================
genesis();