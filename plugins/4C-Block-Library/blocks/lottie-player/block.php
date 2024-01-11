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

// === Defining Attributes
$attribute_string = '';
$attributes = get_field('attributes');
foreach ($attributes as $attr ) {
    $attribute_string .= $attr . ' ';
}
// === Defining the source
$src = get_field('src') ?: 'https://assets3.lottiefiles.com/packages/lf20_UJNc2t.json';
$background = get_field('background');
$count = get_field('count');
$mode = get_field('mode');
$asprectRatio = get_field('preserveAspectRatio');
$renderer = get_field('renderer');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <lottie-player
        <?php echo $attribute_string; ?>
        src=<?php echo $src; ?>
        style=""
        speed="<?php echo get_field('speed'); ?>"
        <?php if($background): ?>
        background="<?php echo $background ?>"
        <?php endif; ?>
        direction="<?php echo get_field('direction'); ?>"
        <?php if($count): ?>
        count="<?php echo $count ?>"
        <?php endif; ?>
        <?php if($mode): ?>
        mode="<?php echo $mode ?>"
        <?php endif; ?>
        <?php if($asprectRatio): ?>
        preserveAspectRatio="<?php echo $asprectRatio ?>"
        <?php endif; ?>
        <?php if($renderer): ?>
        renderer="<?php echo $renderer ?>"
        <?php endif; ?>
    >
    </lottie-player>
</div>