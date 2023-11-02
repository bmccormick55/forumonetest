<?php
/*
Plugin Name: Public API Block
Description: A Gutenberg block to display content from a public API.
Version: 1.0
Author: Britt McCormick
*/

// Enqueue the block's JavaScript and CSS
function public_api_block_enqueue_assets() {
    wp_enqueue_script(
        'public-api-block',
        plugins_url('block.js', __FILE__),
        array('wp-blocks', 'wp-element'),
        filemtime(plugin_dir_path(__FILE__) . 'block.js')
    );

    wp_enqueue_style(
        'public-api-block',
        plugins_url('block.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'block.css')
    );
}
add_action('enqueue_block_editor_assets', 'public_api_block_enqueue_assets');

// Register the block
function public_api_block_register_block() {
    register_block_type('public-api-block/block', array(
        'editor_script' => 'public-api-block',
    ));
}
add_action('init', 'public_api_block_register_block');
