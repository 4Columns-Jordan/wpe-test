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

$className = 'mapContainer';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="mapContainer__bgContainer">
        <div class="container-fluid">
            <div class="col-md-5 mapContainer__bgWrapper">
                <?php if(!empty($backgroundImage)): ?>
                <img src="<?php echo $backgroundImage['url']; ?>" alt="" class="mapContainer__bg">
                <?php endif; ?>
                <?php if(!empty($containerBackgroundCustom)): ?>
                <div class="mapContainer__bgColor" style="<?php echo $containerBackgroundCustom; ?>"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-md">
        <div class="row">
            <div class="col-md-4 g-4">
                <div class="mapContainer__contentWrapper" style="<?php if(isset($padding)){echo $padding;}?>">
                    <div class="container">
                        <div class="row">
                            <div class="col g-0"><InnerBlocks/></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 md__no_padding">
                <div class="mapContainer__mapWrapper">
                    <div class="mapContainer__map"></div>
                </div>
            </div>
        </div>
    </div>
</section>