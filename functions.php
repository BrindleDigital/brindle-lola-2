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

// Register ACF global options pages
if(function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings'
    ));
    acf_add_options_sub_page(array(
        'page_title'    => 'Site Setting',
        'menu_title'    => 'Site Setting',
        'parent_slug'   => 'theme-general-settings'
    )); 
    acf_add_options_sub_page(array(
        'page_title'    => 'Home Amenities Manager',
        'menu_title'    => 'Amenities Manager',
        'parent_slug'   => 'theme-general-settings'
    )); 
    acf_add_options_sub_page(array(
        'page_title'    => 'Amenities Page Manager',
        'menu_title'    => 'Amenities Page Manager',
        'parent_slug'   => 'theme-general-settings'
    ));    
}







function register_shortcodes()
{
  add_shortcode("local-day-night-slider", "show_local_day_night_slider");  
  add_shortcode("amenities-tab", "show_amenities_tab"); 
  add_shortcode("search-form", "show_form"); 
  add_shortcode("show-price-and-address", "show_price_address"); 
  add_shortcode("amenities-list", "show_amenities_list"); 
  add_shortcode("show-menu", "show_menu_list");  
}
add_action("init", "register_shortcodes");


include_once get_stylesheet_directory() . "/cpt/dnslider.php";
function show_local_day_night_slider(){
    ob_start();
    include_once get_stylesheet_directory() . "/cpt/show-dnslider.php";
    $content = ob_get_clean();
    return $content;
}
function show_amenities_tab(){
    ob_start();
    include_once get_stylesheet_directory() . "/cpt/show-amenities-tab.php";
    $content = ob_get_clean();
    return $content;
}
function show_form(){
    ob_start();
    include_once get_stylesheet_directory() . "/cpt/show-form.php";
    $content = ob_get_clean();
    return $content;
}
function show_price_address(){
    ob_start();
    include_once get_stylesheet_directory() . "/cpt/show-price-address.php";
    $content = ob_get_clean();
    return $content;
}
function show_amenities_list(){
    ob_start();
    include_once get_stylesheet_directory() . "/cpt/show-amenities-list.php";
    $content = ob_get_clean();
    return $content;
}
function show_menu_list($attr){
    ob_start();
    $menu = '';
    if(isset($attr['menu'])){
        $menu = $attr['menu']; 
    } 
    if($menu !=''){
        ?>
        <div class="widget widget_nav_menu"><?php echo wp_nav_menu( array( 'menu' => $menu ) );?></div>
        <?php

    }
    $output = ob_get_clean();
    return $output;
}


// Automatic theme updates from the GitHub repository
//include_once('git-auto-updater.php');