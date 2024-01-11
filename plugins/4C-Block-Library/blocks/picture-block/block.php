<?php

/**
 * Custom Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
$customId = get_field('custom_id');

if ($customId) {
  $id = $customId;
}

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.

$className = 'customBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
$altText = get_field('alt_tag');
$fallBack = get_field('fallback_image');

?>

<picture id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<?php if( have_rows('sources') ):
    while( have_rows('sources') ) : the_row();
        $url = get_sub_field('image');
        $media = get_sub_field('media');
    ?>
  <source srcset="<?php echo $url; ?>" media="<?php echo $media; ?>">  
    <?php
    endwhile;
endif; ?>
  <img src="<?php echo $fallBack; ?>" alt="<?php echo $altText; ?>" style="max-width: 100%; height: auto; displa: block;">
</picture>