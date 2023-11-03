<?php
/*
Plugin Name: Public API Block
Description: A Gutenberg block to display content from a public API.
Author: Britt McCormick
*/

// Register the block script
function public_api_block_register_script() {
    wp_register_script(
        'public-api-block',
        plugin_dir_url( __FILE__ ) . 'public-api-block.js',
        array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'public-api-block.js' )
    );
}
add_action( 'init', 'public_api_block_register_script' );

// Enqueue the block script
function public_api_block_enqueue_script() {
    wp_enqueue_script( 'public-api-block' );
}
add_action( 'enqueue_block_editor_assets', 'public_api_block_enqueue_script' );

// Register the block
function public_api_block_register_block() {
    register_block_type(
        'public-api-block/public-api',
        array(
            'editor_script' => 'public-api-block',
        )
    );
}
add_action( 'init', 'public_api_block_register_block' );

// Register the block attributes
function public_api_block_register_attributes() {
    register_block_type(
        'public-api-block/public-api',
        array(
            'attributes' => array(
                'apiEndpoint' => array(
                    'type' => 'string',
                    'default' => '',
                ),
            ),
            'render_callback' => 'public_api_block_render_callback',
        )
    );
}
add_action( 'init', 'public_api_block_register_attributes' );

// Block render callback
function public_api_block_render_callback( $attributes ) {
    $api_endpoint = $attributes['apiEndpoint'];
}
    // Fetch data from the API endpoint
    $response = wp_remote_get( $api_endpoint );
    
    if ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) ) {
        $data = wp_remote_retrieve_body( $response );
        
        // Process and display the data
        $content = '<pre>' . $data . '</pre>';
        
        return $content;
    }
    
    return 'Error fetching data from the API.';
