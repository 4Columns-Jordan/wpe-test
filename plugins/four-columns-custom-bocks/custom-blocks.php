<?php
/*
Plugin Name: Theme Custom Blocks
Plugin URI: https://github.com/FourColumnsMarketing/4C-Block-Library
Description: This is a dump of all custom blocks specific to this site.
Version: 0.0.1
Author: The Four Columns Team
Author URI: https://fourcolumns.net
License: GPLv2
*/

add_action('acf/init', 'init_custom_blocks');
function init_custom_blocks()
{
  // Check function exists.
  if (function_exists('acf_register_block_type')) {
    /*
    Example Function for ease of copy paste
	  acf_register_block_type([
		'name'        => 'contentblock',
		'title'       => __('Content Block'),
		'description' => __('The original content block. '),
    Use plugin_dir_path(__FILE__) to get relative path to plugin
		'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/content-block/block.php',
		'icon'            => 'editor-alignleft',
		'keywords'        => ['content', 'image'],
    ]);
    */
    acf_register_block_type([
      'name'        => 'heroSlider',
      'title'       => __('Hero Slider'),
      'description' => __('A heroic slider'),
      'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/hero-slider/block.php',
      'enqueue_assets' => function(){
        wp_enqueue_script('swiper-script');
        wp_enqueue_style('swiper-style');
        FCBL__genBlockStyle('heroSlider', '/blocks/hero-slider/index.css');
        FCBL__genBlockScript('heroSlider', '/blocks/hero-slider/index.js');
      },
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
      'category' => '4c-blocks'
    ]);
    acf_register_block_type([
      'name'        => 'mapContainer',
      'title'       => __('Map Container'),
      'description' => __('A block with a map on one side and content on the other.'),
      'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/map-container/block.php',
      'enqueue_assets' => function(){
        FCBL__genBlockScript('mapContainer', '/blocks/map-container/index.js');
        FCBL__genBlockStyle('mapContainer', '/blocks/map-container/index.css');
        wp_enqueue_script('google-maps');
      },
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
      'category' => '4c-blocks',
      'supports'        => array(
        'jsx'   => true,
      )
    ]);
    acf_register_block_type([
      'name'        => 'imageSlider',
      'title'       => __('Image Slider'),
      'description' => __('A vertical image slider.'),
      'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/image-slider/block.php',
      'enqueue_assets' => function(){
        wp_enqueue_script('swiper-script');
        wp_enqueue_style('swiper-style');
        FCBL__genBlockStyle('imageSlider', '/blocks/image-slider/index.css');
        FCBL__genBlockScript('imageSlider', '/blocks/image-slider/index.js');
      },
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
      'category' => '4c-blocks',
    ]);
    acf_register_block_type([
      'name'        => 'pageLinks',
      'title'       => __('Page Link Container'),
      'description' => __('A container with optional page links.'),
      'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/page-links/block.php',
      'enqueue_assets' => function(){
        FCBL__genBlockStyle('pageLinks', '/blocks/page-links/index.css');
        FCBL__genBlockScript('pageLinks', '/blocks/page-links/index.js');
      },
      'supports'        => array(
        'jsx'   => true,
      ),
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
      'category' => '4c-blocks',
    ]);
    acf_register_block_type([
      'name'        => 'headerBlock',
      'title'       => __('Header Block'),
      'description' => __('The header block for second level pages (automatically added with the second level template)'),
      'render_template' => plugin_dir_path( __FILE__ ) . 'blocks/header-block/block.php',
      'enqueue_assets' => function(){
        FCBL__genBlockStyle('headerBlock', '/blocks/header-block/index.css');
        FCBL__genBlockScript('headerBlock', '/blocks/header-block/index.js');
      },
      'icon'            => 'editor-alignleft',
      'keywords'        => ['content', 'image'],
      'category' => '4c-blocks',
    ]);
  }
}

// =============================================================================
// Generating properly versioned block files ===================================
function FCBL__genBlockStyle($handle, $path) {
  wp_enqueue_style($handle . '-style', plugins_url($path, __FILE__), array(), filemtime(plugin_dir_path(__FILE__) . $path), 'all');
}

function FCBL__genBlockScript($handle, $path, $deps = '') {
  if($deps === '') {
    $deps = array('jquery');
  }
  wp_enqueue_script($handle . '-style', plugins_url($path, __FILE__), $deps, filemtime(plugin_dir_path(__FILE__) . $path), true);
}