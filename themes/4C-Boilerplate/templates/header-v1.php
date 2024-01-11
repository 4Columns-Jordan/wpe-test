<?php
/**
 * Header Template
 */

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';

$facebook_link = get_theme_mod('social_links_facebook', 'https://facebook.com');
$twitter_link = get_theme_mod('social_links_twitter', 'https://twitter.com');
$instagram_link = get_theme_mod(
  'social_links_instagram',
  'https://instagram.com'
);
$linkedin_link = get_theme_mod('social_links_linkedin', 'https://linkedin.com');

$sticky_navigation_option = get_theme_mod('genesis_header_sticky_option', 'no');

$navArgs = [
  // 'menu' => '', // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
  'menu_class' => "navbar-nav header__topNav", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
  'menu_id' => "", // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
  'container' => "div", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
  'container_class' => "navbar-collapse flex-row-reverse", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
  'container_id' => "navbarNavDropdown", // (string) The ID that is applied to the container.
  'add_li_class' => 'nav-item',
  // 'fallback_cb'       => "", // (callable|bool) If the menu doesn't exists, a callback function will fire. Default is 'wp_page_menu'. Set to false for no fallback.
  // 'before'            => "", // (string) Text before the link markup.
  // 'after'             => "", // (string) Text after the link markup.
  // 'link_before'       => "", // (string) Text before the link text.
  // 'link_after'        => "", // (string) Text after the link text.
  // 'echo'              => "", // (bool) Whether to echo the menu or return it. Default true.
  // 'depth'             => "", // (int) How many levels of the hierarchy are to be included. 0 means all. Default 0.
  'walker' => new WP_Bootstrap_Navwalker(), // (object) Instance of a custom walker class.
  'theme_location'    => "topNav", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
  // 'items_wrap'        => "", // (string) How the list items should be wrapped. Default is a ul with an id and class. Uses printf() format with numbered placeholders.
  // 'item_spacing'      => "", // (string) Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
];
$navArgsDD = [
  // 'menu' => '', // (int|string|WP_Term) Desired menu. Accepts a menu ID, slug, name, or object.
  'menu_class' => "navbar-nav header__topNav", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
  'menu_id' => "", // (string) The ID that is applied to the ul element which forms the menu. Default is the menu slug, incremented.
  'container' => "div", // (string) Whether to wrap the ul, and what to wrap it with. Default 'div'.
  'container_class' => "navbar-collapse flex-row-reverse", // (string) Class that is applied to the container. Default 'menu-{menu slug}-container'.
  'container_id' => "navbarNavDropdown", // (string) The ID that is applied to the container.
  'add_li_class' => 'nav-item',
  // 'fallback_cb'       => "", // (callable|bool) If the menu doesn't exists, a callback function will fire. Default is 'wp_page_menu'. Set to false for no fallback.
  // 'before'            => "", // (string) Text before the link markup.
  // 'after'             => "", // (string) Text after the link markup.
  // 'link_before'       => "", // (string) Text before the link text.
  // 'link_after'        => "", // (string) Text after the link text.
  // 'echo'              => "", // (bool) Whether to echo the menu or return it. Default true.
  // 'depth'             => "", // (int) How many levels of the hierarchy are to be included. 0 means all. Default 0.
  'walker' => new WP_Bootstrap_Navwalker(), // (object) Instance of a custom walker class.
  'theme_location'    => "topNav", // (string) Theme location to be used. Must be registered with register_nav_menu() in order to be selectable by the user.
  // 'items_wrap'        => "", // (string) How the list items should be wrapped. Default is a ul with an id and class. Uses printf() format with numbered placeholders.
  // 'item_spacing'      => "", // (string) Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
];
$custom_text = get_option( 'custom_text' );
$banner_link = get_option( 'banner_link' );
?>
<?php if(isset($custom_text)): ?>
<a class="header__top" target="_blank" href="<?php echo $banner_link?>">
  <p class="text_align_center no__margin_bottom color__nearWhite">
    <?php echo str_replace('\\', '',$custom_text) ?>
  </p>
</a>
<?php endif; ?>
<nav class="navbar navbar-expand-xxl sticky-top bg-light activeBanner" >
  <div class="container">
    <a class="navbar-brand" href="<?php echo home_url(); ?>">
      <?php FCBP__build_logo_svg(); ?>
    </a>
    <a role="button" class="header__menuToggler">
      <span class="menuToggler__icon">
        <lottie-player src="/wp-content/themes/4C-Boilerplate/images/hamburger_black.json" class="header__lottie mobileToggle" id="" background="transparent" speed="2"></lottie-player>
      </span>
    </a>
    <div class="header__menuWrapper">
      <?php wp_nav_menu($navArgs); ?>
    </div>
  </div>
</nav>
<div class="header__navContainer">
  <div class="header__navInner">
    <div class="header__navWrapper">
      <div class="header__mainNav">
        <?php wp_nav_menu($navArgsDD); ?>
      </div>
    </div>
  </div>
</div>