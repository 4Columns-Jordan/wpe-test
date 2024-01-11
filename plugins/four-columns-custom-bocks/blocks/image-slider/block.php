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

$className = 'imageSlider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
$slides = get_field('images');
if(!empty($slides)):
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="imageSlider__container">
        <div class="imageSlider__wrapper">
            <!-- Slider main container -->
            <div class="swiper-container imageSliderSwiper">
            <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach( $slides as $slide ): ?>
                    <div class="swiper-slide">
                        <div class="imageSlider__slide"><img src="<?php echo $slide['url']; ?>" alt="<?php echo $slide['alt']; ?>" class="imageSlide__image"></div>
                    </div>
                    <?php endforeach; ?>
                </div> 
                <div class="imageSliderPagination custom__pagination small"></div>              
            </div>
        </div>
    </div>
</section>
<?php endif; ?>