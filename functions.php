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



// Automatic theme updates from the GitHub repository
add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1);
function automatic_GitHub_updates($data) {
  // Theme information
  $theme   = get_stylesheet(); // Folder name of the current theme
  $current = wp_get_theme()->get('Version'); // Get the version of the current theme
  // GitHub information
  $user = 'BrindleDigital'; // The GitHub username hosting the repository
  $repo = 'brindle-lola-2'; // Repository name as it appears in the URL
  // Get the latest release tag from the repository. The User-Agent header must be sent, as per
  // GitHub's API documentation: https://developer.github.com/v3/#user-agent-required
  $file = @json_decode(@file_get_contents('https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false,
      stream_context_create(['http' => ['header' => "User-Agent: ".$user."\r\n"]])
  ));
  if($file) {
      $update = filter_var($file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    // Only return a response if the new version number is higher than the current version
    if($update > $current) {
        $data->response[$theme] = array(
            'theme'       => $theme,
            // Strip the version number of any non-alpha characters (excluding the period)
            // This way you can still use tags like v1.1 or ver1.1 if desired
            'new_version' => $update,
            'url'         => 'https://github.com/'.$user.'/'.$repo,
            'package'     => $file->assets[0]->browser_download_url,
      );
    }
  }
  return $data;
}