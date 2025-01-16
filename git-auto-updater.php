<?php
// Automatic theme updates from the GitHub repository
add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1);
function automatic_GitHub_updates($data) {
  // Theme information
  $theme_dtls = array(
    'theme_parent'      => get_option('template'),
    'theme_parent_uri'  => get_template_directory_uri(),
    'theme_name'        => get_option('stylesheet'),
    'theme_template'    => get_stylesheet_directory(), // Folder name of the current theme
    'theme_uri'         => get_stylesheet_directory_uri(), // URL of the current theme folder
    'theme_slug'        => 'brindle-lola-2',
    'theme_dir'         => get_theme_root(), // Folder name of the theme root
  );
  $theme       = $theme_dtls['theme_name'];

  error_log('Theme dtls: ' . print_r( $theme_dtls , true ));

  if ($theme != $theme_dtls['theme_slug']) {
    $theme = $theme_dtls['theme_slug'];
  } 

  error_log('Theme: ' . $theme);

  $current = wp_get_theme()->get('Version'); // Get the version of the current theme
  // GitHub information - you might want to call this from an environment variable or something similar
  $git        = array(
    "user" => "BrindleDigital",
    "repo" => "brindle-lola-2"
  );
  $user       = $git['user']; // The GitHub username hosting the repository
  $repo       = $git['repo']; // Repository name as it appears in the URL

  $url = "https://api.github.com/repos/$user/$repo/releases/latest";

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'User-Agent: ' . $user,
    'Accept: application/json'
  ]);

  $response = curl_exec($curl);

  if (curl_errno($curl)) {
    error_log('cURL Error: ' . curl_error($curl));
  } 
  
  curl_close($curl);

  $file = json_decode($response);

  if ($file) {
    $update = preg_replace('/[^0-9.]/', '', $file->tag_name);

    //error_log('Automatic GitHub updates: ' . print_r($file, true));

    // Only return a response if the new version number is higher than the current version
    if ($update > $current) {
      $data->response[$theme] = array(
        'theme'       => $theme,
        'new_version' => $update,
        'url'         => 'https://github.com/'.$user.'/'.$repo,
        'package'     => $file->zipball_url,
        'slug'        => $theme,
      );
      //error_log('Theme data: ' . print_r($data->response[$theme], true));
    } else {
      //error_log('No update available');
    }
    //error_log('Latest version: ' . $update);
    //error_log('Current version: ' . $current);
  }

  //error_log('Automatic GitHub updates Check: ' . print_r($data->checked, true));
  //error_log('Automatic GitHub updates Response: ' . print_r($data->response, true));

  // Rename the theme folder back to its original name
  if ($theme != $theme_dtls['theme_name']) {
    //Rename theme folder back to its original name: ' . $theme_dtls['theme_name'] . ' to ' . $theme

   // error_log('Theme dtls after: ' . print_r( $theme_dtls , true ));
    if ($theme_dtls['theme_name'] != $theme_dtls['theme_slug']) {

      $new_dir = $theme_dtls['theme_dir'] . '/' . $theme_dtls['theme_slug'];

      rename(get_stylesheet_directory(), $new_dir);
      //error_log('Theme renamed: ' . $theme_dtls['theme_name'] . ' to ' . get_stylesheet_directory());
      //error_log('After Theme dtls: ' . print_r( $theme_dtls , true ));
    } else {
      //error_log('Theme not renamed: ' . $theme_dtls['theme_template'] . ' to ' . get_stylesheet_directory());
      //error_log('After Theme dtls: ' . print_r( $theme_dtls , true ));
    }
    //rename(get_stylesheet_directory(), $theme);
    update_option('template', $theme_dtls['theme_parent']);
    update_option('stylesheet', $theme);
    update_option('current_theme', $theme);

    //$data->response[$theme_dtls['theme_name']] = $data->response[$theme];

    //unset($data->response[$theme]);

  }

  return $data;
}