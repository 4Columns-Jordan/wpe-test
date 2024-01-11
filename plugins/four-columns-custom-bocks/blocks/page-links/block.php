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

$className = 'pageLinks';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="<?php if(!empty($padding)){print($padding);} if(!empty($paddingBottom)){print '--PL-row-margin: ' . $paddingBottom . 'px;'; } if(!empty($backgroundColor)){print 'background-color: ' . $backgroundColor . ';'; } ?>">
    <?php if(!empty($backgroundImage) && $backgroundType == 'bg_image'): ?>
    <div class="pageLinks__bgWrapper">
        <img src="<?php echo $backgroundImage['url']; ?>" alt="" class="pageLinks__bg">
    </div>
    <?php endif ?>
    <div class="container">
        <div class="row">
            <div class="col pageLinks__content">
                <InnerBlocks/>
            </div>
        </div>
        <div class="row pageLinks__linkRow">
            <?php if( have_rows('page_links') ):
                while( have_rows('page_links') ) : the_row();
                    $isPage = get_sub_field('link_type');
                    if($isPage === 'Page') {
                        $page = get_sub_field('page');
                        if(empty($page)){continue;}
                        $title = $page->post_title;
                        $excerpt = $page->post_excerpt;
                        $image = get_the_post_thumbnail_url($page->ID);
                        $imageUrl = $image ? $image : '/wp-content/uploads/2023/10/cm-map-block-bg.jpg';
                        $link = get_the_permalink($page->ID);
                    } else {
                        $title = get_sub_field('title');
                        $excerpt = get_sub_field('excerpt');
                        $image = get_sub_field('image');
                        $imageUrl = $image ? $image['url'] : '/wp-content/uploads/2023/10/cm-map-block-bg.jpg';
                        $link = get_sub_field('link');
                    }
                    ?>
            <div class="col-lg col-6 gy-lg-0 gy-4">
                <a href="<?php echo $link; ?>" class="pageLinks__link">
                    <div class="link__imageWapper">
                        <img class="link__image" src="<?php echo $imageUrl; ?>" alt="">
                    </div>
                    <div class="link__meta">
                        <h3 class="link__title"><?php echo $title; ?> <i class="fas fa-angle-right"></i></h3>
                        <p class="link__excerpt">
                            <?php echo $excerpt; ?>
                        </p>
                    </div>
                </a>
            </div>
                    <?php
                endwhile;
            endif; ?>
        </div>
    </div>
</section>