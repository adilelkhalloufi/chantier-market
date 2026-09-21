<?php

if (!defined('ABSPATH')) {
    exit;
}

define('BTP360_THEME_VERSION', '1.0.0');

require get_template_directory() . '/inc/cpt.php';
require get_template_directory() . '/inc/acf-fields.php';
require get_template_directory() . '/inc/seeders.php';

function btp360_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'btp360-acf'),
    ));
}
add_action('after_setup_theme', 'btp360_theme_setup');

function btp360_enqueue_assets()
{
    wp_enqueue_style('btp360-google-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap', array(), null);
    wp_enqueue_style('btp360-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), BTP360_THEME_VERSION);

    wp_enqueue_script('btp360-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), BTP360_THEME_VERSION, true);
    wp_localize_script('btp360-theme', 'btp360Data', array(
        'dashboardUrl' => home_url('/dashboard-client/'),
    ));
}
add_action('wp_enqueue_scripts', 'btp360_enqueue_assets');

function btp360_body_classes($classes)
{
    $classes[] = 'btp360-body';
    return $classes;
}
add_filter('body_class', 'btp360_body_classes');

function btp360_get_field($name, $post_id = false, $default = '')
{
    if (function_exists('get_field')) {
        $value = get_field($name, $post_id);
        if ($value !== null && $value !== '' && $value !== false) {
            return $value;
        }
    }

    if ($post_id) {
        $value = get_post_meta($post_id, $name, true);
        if ($value !== '') {
            return $value;
        }
    }

    return $default;
}
