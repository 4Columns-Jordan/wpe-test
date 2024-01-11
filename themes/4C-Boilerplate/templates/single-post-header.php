<?php
/**
  * Copyright SinglePostHeader
  */

  require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';
  
  $sidebar_header_type = get_theme_mod('custom_single_post_header_backgroud_type');
  $single_post_header_background_color = get_theme_mod('genesis_header_background_color');
  $single_post_header_background_image = get_theme_mod('custom_single_post_header_image');

  $singlePost_Header_Overlay = get_theme_mod('custom_single_post_header_overlay');
  $singlePost_Header_Overlay_Color = get_theme_mod('custom_single_post_header_overlay_color');
  $singlePost_Header_Overlay_Opacity = get_theme_mod('custom_single_post_header_overlay_opacity');
  $singlePost_Header_Overlay_Converted_Opacity_Hex = dechex(ceil(255 * ($singlePost_Header_Overlay_Opacity/100)));


  $SinglePost_HeaderBGPaddingTop = get_theme_mod('single_post_header_padding_top');
  if(!$SinglePost_HeaderBGPaddingTop) {
    $SinglePost_HeaderBGPaddingTop = '30px';
  }
  $SinglePost_HeaderBGPaddingRight = get_theme_mod('single_post_header_padding_right');
  if(!$SinglePost_HeaderBGPaddingRight) {
    $SinglePost_HeaderBGPaddingRight = '0px';
  }
  $SinglePost_HeaderBGPaddingBottom = get_theme_mod('single_post_header_padding_bottom');
  if(!$SinglePost_HeaderBGPaddingBottom) {
    $SinglePost_HeaderBGPaddingBottom = '30px';
  }  
  $SinglePost_HeaderBGPaddingLeft = get_theme_mod('single_post_header_padding_left');
  if(!$SinglePost_HeaderBGPaddingLeft) {
    $SinglePost_HeaderBGPaddingLeft = '0px';
  }   
?>



<div id="single-post-header" class="BG_Container" style="<?php if($sidebar_header_type == 'bg_color') { ?>background-color: <?php print $single_post_header_background_color; ?>;<?php } ?> <?php if($sidebar_header_type == 'image') { ?>background-image: url('<?php print $single_post_header_background_image; ?>');<?php } ?> padding-top: <?php print $SinglePost_HeaderBGPaddingTop; ?>; padding-right: <?php print $SinglePost_HeaderBGPaddingRight; ?>; padding-bottom: <?php print $SinglePost_HeaderBGPaddingBottom; ?>; padding-left: <?php print $SinglePost_HeaderBGPaddingLeft; ?>;">

    <?php if($singlePost_Header_Overlay == 'yes' && $sidebar_header_type == 'image') { ?>
        <div class="BG_Overlay" style="background-color: <?php print $singlePost_Header_Overlay_Color.$singlePost_Header_Overlay_Converted_Opacity_Hex; ?>"></div>
    <?php } ?>

    <div class="BG_Inner ">

        <h1 class="" style="color: <?php print $CustomTitleColor; ?>; text-align: <?php print $CustomAlignment; ?>; <?php if($CustomTitleFontSize) { ?>font-size: <?php print $CustomTitleFontSize; ?>;<?php } ?>"><?php print the_title(); ?></h1>

    </div>

</div>