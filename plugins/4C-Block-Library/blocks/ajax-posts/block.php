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
$id = 'ajax-posts-' . $block['id'];
$customId = get_field('custom_id');

if ($customId) {
  $id = $customId;
}

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.

$className = 'ajaxPosts';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className = ' align' . $block['align'] . ' ' . $className;
}
// === Global Settings
include __DIR__ . ('/../globalSettings.php');

/* === Generating category and slug === */
$cat = get_field('category');
$slug = $cat ? $cat[0]->slug : '';

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="ajax__title"><?php echo get_field('block_title'); ?></h2>
            </div>
        </div>
        <div class="row ajax__postWrapper">
            <div class="ajax__loading">
                <i class="fas fa-spinner"></i>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="ajax__loadWrapper">
                    <p class="ajaxLoad more-link">Load More Posts</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        FCBL__ajaxPosts.push({
            ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
            id: '<?php echo esc_attr($id) ?>',
            postsPerPage: '<?php echo get_field('posts_per_page') ?>',
            postType: '<?php echo get_field('ajax_post_type') ?: 'post' ?>',
            category: '<?php echo $slug ?>',
        });
    </script>
</section>