<?php

add_action('init', 'dnslider_type');

function dnslider_type() {

    $imagepath = get_stylesheet_directory_uri() . '/cpt/images/';

    $labels    = array(

        'name' => __('Day/night Attraction', 'lola'),

        'singular_name' => __('Day/night Attraction', 'lola'),

        'add_new' => __('Add New Day/night Attraction', 'lola'),

        'add_new_item' => __('Add New Day/night Attraction', 'lola'),

        'edit' => __('Edit', 'lola'),

        'edit_item' => __('Edit Day/night Attraction', 'lola'),

        'new_item' => __('New Day/night Attraction', 'lola'),

        'view' => __('View Day/night Attraction', 'lola'),

        'view_item' => __('View Day/night Attraction', 'lola'),

        'search_items' => __('Search Day/night Attraction', 'lola'),

        'not_found' => __('No Day/night Attraction found', 'lola'),

        'not_found_in_trash' => __('No Day/night Attraction found in Trash', 'lola'),

        'parent_item_colon' => ''

    );

    $args      = array(

        'labels' => $labels,

        'description' => 'This is the holding location for all Day/night Attraction',

        'public' => true,

        'publicly_queryable' => true,

        'exclude_from_search' => false,

        'show_ui' => true,

        'query_var' => true,

        'capability_type' => 'post',

        'rewrite' => true,

        'hierarchical' => false,

        'menu_position' => 5,

        'menu_icon' => $imagepath . 'dnslider.svg',
        'show_in_rest' => true,

        'supports' => array( 'title','editor','thumbnail','excerpt'),

    );

    register_post_type('local_attraction', $args);
    $labels = array(
    'name' => _x( 'Day/night Attraction Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Day/night Attraction Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Day/night Attraction Category' ),
    'all_items' => __( 'All Day/night Attraction Category' ),
    'parent_item' => __( 'Parent Day/night Attraction Category' ),
    'parent_item_colon' => __( 'Parent Day/night Attraction Category:' ),
    'edit_item' => __( 'Edit Day/night Attraction Category' ), 
    'update_item' => __( 'Update Day/night Attraction Category' ),
    'add_new_item' => __( 'Add New Day/night Attraction Category' ),
    'new_item_name' => __( 'New Day/night Attraction Category Name' ),
    'menu_name' => __( 'Day/night Attraction Category' ),
  );    
 
    // Now register the taxonomy
      register_taxonomy('local_attraction_category',array('local_attraction'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'local_attraction_category' ),
      ));

}

?>