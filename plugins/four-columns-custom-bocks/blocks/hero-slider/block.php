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

$className = 'heroSlider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="--HS-title-color: ; --HS-text-color">
    <div class="heroSlider__container">
        <!-- Slider main container -->
        <div class="swiper-container heroSliderSwiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php                 
                if( have_rows('slides') ):
                    while( have_rows('slides') ) : the_row();
                        $title = get_sub_field('slide_title');
                        $content = get_sub_field('slide_copy');
                        $button = get_sub_field('button');
                        $bgImage = get_sub_field('slide_background');
                        $bgUrl = $bgImage ? $bgImage['url'] : 'https://images.unsplash.com/photo-1624125278758-c0572f6ebc55?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80';
                        $bgAlt = $bgImage ? $bgImage['alt'] : $title . ' Slide Background Image';
                ?>
                <div class="swiper-slide">
                    <div class="heroSlide">
                        <img class="heroSlide__backgroundImage" src="<?php echo $bgUrl; ?>" alt="<?php echo $bgAlt; ?>">
                        <div class="heroSlide__bgOverlay"></div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-10">
                                    <div class="heroSlide__textWrapper">
                                        <h2 class="heroSlide__title text" ><?php echo $title; ?></h2>
                                    </div>
                                    <div class="heroSlide__textWrapper">
                                        <div class="heroSlide__text text">
                                            <?php echo $content; ?>
                                        </div>
                                    </div>
                                    <?php if(!empty($button['button_text']) && !empty($button['button_url'])): ?>
                                    <div class="heroSlide__textWrapper">
                                        <div class="d-flex justify-content-center text">
                                            <div class="wp-block-button"><a href="<?php echo $button['button_url']; ?>" class="wp-block-button__link wp-element-button"><?php echo $button['button_text']; ?></a></div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                endif;                
                ?>
            </div>
            <!-- If we need pagination -->
            
        </div>
    </div>
    <div class="heroSlider__navWrapper">
        <div class="container">
            <div class="heroSliderPagination custom__pagination"></div>
        </div>
    </div>
    <div class="heroSlider__mobileArrow">
        <i class="fas fa-angle-double-down"></i>
    </div>
</section>