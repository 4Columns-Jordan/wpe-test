<?php
/**
 * Default Page Template
 */
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );


//* Remove navigation
remove_theme_support( 'genesis-menus' );

// Removes site header elements.
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_footer', 'genesis_post_meta', 10);
add_action('genesis_entry_footer', 'genesis_post_info', 10);
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);


add_action('genesis_header', 'add_header');
function add_header()
{
  $headerTemplate = 'templates/header-v1';
  get_template_part($headerTemplate);
}

add_action('genesis_footer', 'FCBP__add_footer');
function FCBP__add_footer()
{
  get_template_part('templates/footer', 'FCBP__add_footer');
}

// Runs the Genesis loop.
genesis();
