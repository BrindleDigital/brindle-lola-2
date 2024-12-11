<?php 
// Starts the engine.
add_action( 'wp_enqueue_scripts', 'brindle_enqueue_styles' );
function brindle_enqueue_styles() {
      wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
} 

function brindle_enqueue_scripts() {        
        wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'brindle_enqueue_scripts' );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'dashicons' );
} );
add_theme_support('editor-styles');
//Meta support
add_theme_support( 'title-tag' );

// Register Menus
function register_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'full-screen-menu' => __('Full Screen Menu'),
            'footer-menu' => __('Footer Menu'),
            'link-menu' => __('Link Menu'),
            'landing-page-menu' => __('Landing Page Menu')
        )
    );
}
add_action('init', 'register_menus');

// Create pretty names for acf-json files
function custom_acf_json_filename($filename, $post, $load_path) {
    $filename = str_replace(
        array(
            ' ',
            '_',
        ),
        array(
            '-',
            '-'
        ),
        $post['title']
    );

    $filename = strtolower($filename) . '.json';

    return $filename;
}
add_filter('acf/json/save_file_name', 'custom_acf_json_filename', 10, 3);