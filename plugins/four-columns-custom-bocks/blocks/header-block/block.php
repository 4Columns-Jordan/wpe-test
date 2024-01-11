<?php

/**
 * Custom Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
// Detecting if block was rendered from function
$isRenderedFromFundtion = get_field('renderedFromFunction') ?: false;
// Create id attribute allowing for custom "anchor" value.
$id = 'custom-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.

$className = 'headerBlock';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
$title = get_field('title') ?: get_the_title(get_the_ID());
$excerpt = get_the_excerpt(get_the_ID());
$bgImage = get_the_post_thumbnail_url(get_the_ID(),'full') ?: '/wp-content/uploads/2023/10/timothy-eberly-DsdWpMU998U-unsplash-scaled.jpg';
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php if(isset($padding)){print $padding;} ?> overflow: hidden;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="headerBlock__pageTitle wp-block-heading has-text-align-center has-secondary-color-color">
                    <?php echo $title; ?>
                </h1>
                <?php if($excerpt): ?>
                <p class="headerBlock__pageExcerpt has-text-align-center has-large-font-size has-white-color">
                    <?php echo $excerpt; ?>
                </p>
                <?php endif; ?>
            </div>
        </div>    
    </div>
    <div class="headerBlock__bgWrapper">
        <img class="headerBlock__bg" src="<?php echo $bgImage; ?>" alt="">
    </div>
    <div class="headerBlock__bgOverlay"></div>
</section>