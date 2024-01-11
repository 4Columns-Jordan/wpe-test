<?php 

remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'genesis_404');

function genesis_404()
{
echo genesis_html5() ? '<article class="entry">' : '<div class="post hentry">';
echo '<div class="entry-content">';
?>

<div class="404" style="min-height: calc(100vh - 347px); display: flex; justify-content: center; align-items: center; flex-direction: column;">
<h1>404</h1>
<p style="text-align: center;">The page you are looking for has been moved or no longer exists.</p>
<img src="/wp-content/themes/4C-Boilerplate-master/images/404.png" alt="" class="error404Img">
</div>
</div>
</div>
<?php
}

add_action('genesis_header', 'add_header');
function add_header()
{
  $headerTemplate = 'templates/header-v1';
  get_template_part($headerTemplate);
}

remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
// Removes site header elements.
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_entry_header', 'genesis_post_info', 12);
remove_action('genesis_entry_footer', 'genesis_post_meta', 10);
// add_action('genesis_entry_footer', 'genesis_post_info', 10);
remove_action(
  'genesis_before_loop',
  'genesis_do_taxonomy_title_description',
  15
);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

add_action('genesis_footer', 'FCBP__add_footer');
function FCBP__add_footer()
{
  get_template_part('templates/footer', 'FCBP__add_footer');
}
genesis();