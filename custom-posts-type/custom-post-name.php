<?php
add_action( 'init', 'Example' );
function Example() {
    $labels = array( 
        'name' => _x( 'Example', 'example' ),
        'singular_name' => _x( 'Example', 'example' ),
        'add_new' => _x( 'Add', 'example' ),
        'add_new_item' => _x( 'Add', 'example' ),
        'edit_item' => _x( 'Edit', 'example' ),
        'new_item' => _x( 'New', 'example' ),
        'view_item' => _x( 'Show', 'example' ),
        'search_items' => _x( 'Search', 'example' ),
        'not_found' => _x( 'Nothing found', 'example' ),
        'not_found_in_trash' => _x( 'Nothing post in trash', 'example' ),
        'menu_name' => _x( 'Example', 'example' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'menu_position' => 100,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        "rewrite" => array('slug' => 'example' ),
        'capability_type' => 'post'
    );

    register_post_type( 'example', $args );

    register_taxonomy("cat_example", array("example"), 
      array(
        "hierarchical" => true, 
        "label" => "Categories", 
        "singular_label" => "Category", 
        "rewrite" => array('slug' => 'cat-example' ),
        "query_var" => true,
        'show_in_nav_menus' => false,
        "all_items" => __('All'), 
        "add_new_item" => __('Add New')
        )
    );
}