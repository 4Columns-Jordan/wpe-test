<?php
/**
  * Copyright SinglePageHeader
  */

  require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';
  
  $page_header_type = get_theme_mod('custom_page_header_backgroud_type');
  $page_header_background_color = get_theme_mod('genesis_page_header_background_color');
  $page_header_background_image = get_theme_mod('custom_page_header_image');

  $page_Header_Overlay = get_theme_mod('custom_page_header_overlay');
  $page_Header_Overlay_Color = get_theme_mod('custom_page_header_overlay_color');
  $page_Header_Overlay_Opacity = get_theme_mod('custom_page_header_overlay_opacity');
  $page_Header_Overlay_Converted_Opacity_Hex = dechex(ceil(255 * ($page_Header_Overlay_Opacity/100)));


  $page_HeaderBGPaddingTop = get_theme_mod('page_header_padding_top');
  if(!$page_HeaderBGPaddingTop) {
    $page_HeaderBGPaddingTop = '30px';
  }  
  $page_HeaderBGPaddingRight = get_theme_mod('page_header_padding_right');
  if(!$page_HeaderBGPaddingRight) {
    $page_HeaderBGPaddingRight = '30px';
  }  
  $page_HeaderBGPaddingBottom = get_theme_mod('page_header_padding_bottom');
  if(!$page_HeaderBGPaddingBottom) {
    $page_HeaderBGPaddingBottom = '30px';
  }  
  $page_HeaderBGPaddingLeft = get_theme_mod('page_header_padding_left');
  if(!$page_HeaderBGPaddingLeft) {
    $page_HeaderBGPaddingLeft = '30px';
  }  
?>



<div id="single-post-header" class="BG_Container" style="<?php if($page_header_type == 'bg_color') { ?>background-color: <?php print $page_header_background_color; ?>;<?php } ?> <?php if($page_header_type == 'image') { ?>background-image: url('<?php print $page_header_background_image; ?>');<?php } ?> padding-top: <?php print $page_HeaderBGPaddingTop; ?>; padding-right: <?php print $page_HeaderBGPaddingRight; ?>; padding-bottom: <?php print $page_HeaderBGPaddingBottom; ?>; padding-left: <?php print $page_HeaderBGPaddingLeft; ?>;">

    <?php if($page_Header_Overlay == 'yes' && $page_header_type == 'image') { ?>
        <div class="BG_Overlay" style="background-color: <?php print $page_Header_Overlay_Color.$page_Header_Overlay_Converted_Opacity_Hex; ?>"></div>
    <?php } ?>

    <div class="BG_Inner ">

        <h1 class="" style="color: <?php print $CustomTitleColor; ?>; text-align: <?php print $CustomAlignment; ?>; <?php if($CustomTitleFontSize) { ?>font-size: <?php print $CustomTitleFontSize; ?>;<?php } ?>"><?php print the_title(); ?></h1>

    </div>

</div>