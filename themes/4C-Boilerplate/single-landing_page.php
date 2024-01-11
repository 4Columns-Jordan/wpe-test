<?php
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
remove_action('genesis_entry_footer', 'genesis_entry_footer_markup', 5);
remove_action ('genesis_loop', 'genesis_do_loop');

// =============================================================================
// Adding the header if neccicary ==============================================
function FCBP__add_single_header()
{
  $showHeader = get_post_meta(get_the_ID(), '_fcbp_show_header');
  if($showHeader[0] === 'true') {
    get_template_part('templates/header-v1');
  }
}
add_action('genesis_header', 'FCBP__add_single_header');


add_action('genesis_after_loop', 'FCBP__add_landingpage_content');
function FCBP__add_landingpage_content() {
  $useTemplate = get_field('landing_page_use_template', get_the_ID());
  $templateName = get_field('landing_page_template_type', get_the_ID());
  if($useTemplate && $templateName) {
    $templateUrl = 'templates/landing_page/' . $templateName;
    get_template_part($templateUrl);
  } else {
    the_content();
  }
}

// =============================================================================
// Adding Footer if neccicary ==================================================
add_action('genesis_footer', 'FCBP__add_footer');
function FCBP__add_footer()
{
  $showFooter = get_post_meta(get_the_ID(), '_fcbp_show_footer');
  if($showFooter[0] === 'true') {
    get_template_part('templates/footer', 'FCBP__add_footer');
  }
}

// Runs the Genesis loop.
genesis();