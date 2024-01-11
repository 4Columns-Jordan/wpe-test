<?php
/**
 * Genesis Sample child theme.
 *
 * Theme supports.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis-sample/
 */

require_once rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';

$num_footer_widgets = get_theme_mod('custom_num_widgets', '2');

if ($num_footer_widgets != '') {
	$num_footer_widgets = $num_footer_widgets;
}
else {
	$num_footer_widgets = 4;
}

return [
	'genesis-custom-logo'             => [
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	],
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'navigation-widgets',
		'search-form',
		'script',
		'style',
	],
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => $num_footer_widgets,

];
