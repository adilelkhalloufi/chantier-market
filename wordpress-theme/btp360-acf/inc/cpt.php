<?php

if (!defined('ABSPATH')) {
    exit;
}

function btp360_register_post_types()
{
    register_post_type('listing', array(
        'labels' => array(
            'name' => __('Listings', 'btp360-acf'),
            'singular_name' => __('Listing', 'btp360-acf'),
            'add_new_item' => __('Add New Listing', 'btp360-acf'),
            'edit_item' => __('Edit Listing', 'btp360-acf'),
        ),
        'public' => true,
        'menu_icon' => 'dashicons-hammer',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'annonces'),
        'show_in_rest' => true,
    ));

    register_taxonomy('listing_category', 'listing', array(
        'labels' => array(
            'name' => __('Listing Categories', 'btp360-acf'),
            'singular_name' => __('Listing Category', 'btp360-acf'),
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'categorie-annonce'),
    ));
}
add_action('init', 'btp360_register_post_types');

function btp360_register_sidebar()
{
    register_sidebar(array(
        'name' => __('Footer Column 1', 'btp360-acf'),
        'id' => 'footer-1',
        'description' => __('Footer widget area 1', 'btp360-acf'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'btp360_register_sidebar');
