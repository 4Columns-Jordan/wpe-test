<?php
// For copy paste
// === Global Settings
//include __DIR__ . ('/../globalSettings.php');
global $blockType;
// Block Width
$customSiteWidth = get_theme_mod('custom_site_width');
if ( isset($customSiteWidth) ) {
  $contentWidth = $customSiteWidth . 'px';
} else {
  $contentWidth = '1360px';
}

$blockWidth = get_field('block_width');
if (empty($blockWidth)) {
  $blockWidth = 'container';
}

// Padding
$paddingTop = get_field('padding_top') ?: 0;
$paddingRight = get_field('padding_right') ?: 0;
$paddingBottom = get_field('padding_bottom') ?: 0;
$paddingLeft = get_field('padding_left') ?: 0;
$padding = '';
$padding =
  'padding: ' .
  $paddingTop .
  'px ' .
  $paddingRight .
  'px ' .
  $paddingBottom .
  'px ' .
  $paddingLeft .
  'px; ';

// Margin
$marginTop = get_field('margin_top') ?: 0;
$marginBottom = get_field('margin_bottom') ?: 0;
$margin = '';
// $margin = 'margin: '.($marginGroup['top'] ?: 0).'px '.($marginGroup['right'] ?: 0). 'px '. ($marginGroup['bottom'] ?: 0 ).'px '.($marginGroup['left'] ?: 0). 'px; ';
if (isset($blockType)) {
  if ($marginTop <= 1 && $blockType == 'row') {
    $margin = 'top: ' . $marginTop . 'px; margin-bottom: ' . $marginBottom . 'px;';
  } else if ($marginBottom <= 1 && $blockType == 'row') {
    $margin = 'margin-top: ' . $marginTop . 'px; bottom: ' . $marginBottom . 'px;';
  } else {
    $margin = 'margin-top: ' . $marginTop . 'px; margin-bottom: ' . $marginBottom . 'px;';
  }
} else {
  $margin = 'margin-top: ' . $marginTop . 'px; margin-bottom: ' . $marginBottom . 'px;';
}


// Background Color

// Button Type
$globalButtonType = get_theme_mod('genesis_button_type');
$buttonOverride = get_field('button_type');
$localButtonType = $globalButtonType;
switch ($buttonOverride) {
  case 'square':
    $localButtonType = 'button__square';
    break;

  case 'round':
    $localButtonType = 'button__round';
    break;

  case 'link':
    $localButtonType = '';
    break;

  default:
    $localButtonType = $globalButtonType;
    break;
}

$useCustomColors = get_field('button_colors');
$buttonColorGroup = get_field('custom_colors');
if ($useCustomColors != 'default') {
  if (isset($buttonColorGroup)) {
    $customButtonColors =
      'background-color:' .
      $buttonColorGroup['background_color'] .
      ' !important;';
    $customButtonColors .=
      'border-color: ' . $buttonColorGroup['border_color'] . ' !important;';
    $customButtonColors .=
      'color: ' . $buttonColorGroup['text_color'] . ' !important;';

    $customButtonColorsHover =
      'background-color:' .
      $buttonColorGroup['background_color_hover'] .
      ' !important;';
    $customButtonColorsHover .=
      'border-color: ' .
      $buttonColorGroup['border_color_hover'] .
      ' !important;';
    $customButtonColorsHover .=
      'color: ' . $buttonColorGroup['text_color_hover'] . ' !important;';
  }
}

// Background Settings
$backgroundType = get_field('background_type');
$backgroundColor = get_field('background_color');
$backgroundImage = get_field('background_image');
$backgroundPosition = get_field('background_position');
$backgroundVideo = get_field('background_video');
$backgroundVideo_YouTubeID = get_field('youtube_video_id');
$backgroundVideo_VimeoID = get_field('vimeo_video_id');
$backgroundVideo_WistiaID = get_field('wistia_video_id');
$backgroundOverLay = get_field('background_overlay');
$backgroundOverlayColor = get_field('background_overlay_color');
$backgroundOverlayOpacity = (int)get_field('background_overlay_opacity');
if (isset($backgroundOverlayOpacity)) {
  $backgroundOverlayOpacityHex = dechex(
    ceil(255 * ($backgroundOverlayOpacity / 100))
  );
} else {
  $backgroundOverlayOpacityHex = dechex(
    ceil(255 * (0 / 100))
  );
}

$containerBackgroundColor = get_field('container_background_color');

$background;
$containerBackground;
$containerBackgroundCustom;
$backgroundVideoSource;
if ($backgroundType == 'bg_color') {
  $background = 'background-color: ' . $backgroundColor . ' !important;';
} elseif ($backgroundType == 'bg_image') {
  if(isset($backgroundImage) && gettype($backgroundImage) === 'array'){
    $background = 'background-image: url(' . $backgroundImage['url'] . ') !important; background-position: ' . $backgroundPosition . ' !important;';
  }
} elseif ($backgroundType == "bg_video") {
  $backgroundVideoSource = '<div class="block__background--video">';
  if ($backgroundVideo == 'youtube') {
    $backgroundVideoSource .=
      '<iframe title="" width="500" height="281" src="https://www.youtube.com/embed/' .
      $backgroundVideo_YouTubeID .
      '?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>';
  } elseif ($backgroundVideo == 'vimeo') {
    $backgroundVideoSource .=
      '<iframe src="https://player.vimeo.com/video/' .
      $backgroundVideo_VimeoID .
      '?autoplay=1&muted=1&loop=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
  } elseif ($backgroundVideo == 'wistia') {
    $backgroundVideoSource .=
      '<iframe src="https://fast.wistia.net/embed/iframe/' .
      $backgroundVideo_WistiaID .
      '?autoplay=1&muted=1" title="" allow="autoplay; fullscreen" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen msallowfullscreen width="640" height="360"></iframe>
      <script src="https://fast.wistia.net/assets/external/E-v1.js" async></script>';
  }
  $backgroundVideoSource .= '</div>';
}

if ($backgroundOverLay == 'yes') {
  $backgroundOverLaySource =
    '<div class="block__background--overlay" style="background-color:' .
    $backgroundOverlayColor .
    $backgroundOverlayOpacityHex .
    '"></div>';
}

if ($containerBackgroundColor == 'custom' ) {
  $containerBackground = '';
  $containerBackgroundCustom = 'background-color:' . get_field('custom_container_background_color');
} elseif ($containerBackgroundColor == 'none') {
  $containerBackground = '';
} else {
  $containerBackground = $containerBackgroundColor;
}

// Column Functions
$columnWidth = get_field('column_width');
$bsBreakpoint = get_field('breakpoint_size');
$bsClassList = 'col';

// 
if( !empty($block['className']) ) {
  $customBlockClassName = $block['className'];
  $classNameTuUse = esc_attr($customBlockClassName);
  $bsClassList = $block['className'] . ' ' . 'col';
}
// If the block has a custom class
if(!$bsBreakpoint && !empty($block['className'])){
  $bsClassList = $bsClassList . '-md';
}
// Default State
if(!$bsBreakpoint && empty($block['className'])){
  $bsClassList = 'col-md';
}
// If block has custom class and breakpoint
if($bsBreakpoint && !empty($block['className'])){
  $bsClassList = $bsClassList . '-' . $bsBreakpoint;
  if(isset($columnWidth) && $columnWidth != 0 ){
    $bsClassList .= '-' . $columnWidth;
  } 
}
// If block has breakpoint
if($bsBreakpoint && empty($block['className'])){
  $bsClassList = 'col-' . $bsBreakpoint;
  if(isset($columnWidth) && $columnWidth != 0 ){
    $bsClassList .= '-' . $columnWidth;
  } 
}

if( have_rows('order') ):
  while( have_rows('order') ) : the_row();
    $breakPoints = get_sub_field('breakpoints');
    $breakPoint = $breakPoints['breakpoint'] . '-order-' . $breakPoints['order'];
    $bsClassList .= ' ' . $breakPoint;
  endwhile;
endif;

?>
