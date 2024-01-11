<?php
/**
 * Adds front-end inline styles for the custom Gutenberg color palette.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */


add_action( 'enqueue_block_editor_assets', 'genesis_sample_custom_gutenberg_admin_css' );
/**
 * Outputs back-end inline styles based on colors declared in config/appearance.php.
 *
 * Note this will appear before the style-editor.css injected by JavaScript,
 * so overrides will need to have higher specificity.
 *
 * @since 2.9.0
 */
function genesis_sample_custom_gutenberg_admin_css() {

	$appearance = genesis_get_config( 'appearance' );

	$css = <<<CSS
	.ab-block-post-grid .ab-post-grid-items h2 a:hover,
	.block-editor__container .editor-styles-wrapper a {
		color: {$appearance['link-color']};
	}

	.editor-styles-wrapper .editor-rich-text .button,
	.editor-styles-wrapper .wp-block-button .wp-block-button__link:not(.has-background) {
		background-color: {$appearance['button-bg']};
		color: {$appearance['button-color']};
	}

	.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link {
		color: {$appearance['button-bg']};
	}

	.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link:focus,
	.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link:hover {
		color: {$appearance['button-outline-hover']};
	}
	CSS;

	$css .= genesis_sample_editor_inline_color_palette();

	wp_add_inline_style( genesis_get_theme_handle() . '-gutenberg-fonts', $css );

}

/**
 * Generate CSS for editor colors based on theme color palette support.
 *
 * @since 3.3.0
 *
 * @return string The editor colors CSS if `editor-color-palette` theme support was declared.
 */
function genesis_sample_editor_inline_color_palette() {

	$css                  = '';
	$appearance           = genesis_get_config( 'appearance' );
	$editor_color_palette = $appearance['editor-color-palette'];

	foreach ( $editor_color_palette as $color_info ) {
		$css .= <<<CSS
		.has-{$color_info['slug']}-color {
			color: {$color_info['color']};
		}
		CSS;
	}

	return $css;

}
