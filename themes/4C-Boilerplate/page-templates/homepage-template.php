<?php
/**
 * Template Name: Homepage
 */


require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';

$hide_show_sidebar = get_theme_mod('custom_single_post_show_sidebar');

// Remove Site Title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// Remove navigation
remove_theme_support( 'genesis-menus' );

// Removes site header elements.
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);


if($hide_show_sidebar == 'hide' ) {
  // Remove Sidebar
  remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
}


add_action('genesis_header', 'add_header');
function add_header()
{
  $headerTemplate = 'templates/header-v1';
  get_template_part($headerTemplate);
}


remove_action( 'genesis_entry_header', 'genesis_do_post_title' );


add_action('genesis_footer', 'FCBP__add_footer');
function FCBP__add_footer()
{
  get_template_part('templates/footer', 'FCBP__add_footer');
}

// Runs the Genesis loop.
genesis();