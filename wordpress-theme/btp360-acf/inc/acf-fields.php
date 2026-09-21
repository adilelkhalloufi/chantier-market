<?php

if (!defined('ABSPATH')) {
    exit;
}

function btp360_register_acf_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_btp360_listing_fields',
        'title' => 'Listing Details',
        'fields' => array(
            array(
                'key' => 'field_btp360_reference',
                'label' => 'Reference',
                'name' => 'reference',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_views',
                'label' => 'Views',
                'name' => 'views',
                'type' => 'number',
                'default_value' => 0,
            ),
            array(
                'key' => 'field_btp360_price',
                'label' => 'Price (MAD)',
                'name' => 'price_mad',
                'type' => 'number',
            ),
            array(
                'key' => 'field_btp360_price_label',
                'label' => 'Price Label',
                'name' => 'price_label',
                'type' => 'text',
                'instructions' => 'Use when there is no numeric price, for example: Prix sur demande.',
            ),
            array(
                'key' => 'field_btp360_transaction_type',
                'label' => 'Transaction Type',
                'name' => 'transaction_type',
                'type' => 'select',
                'choices' => array(
                    'vente' => 'Vente',
                    'location' => 'Location',
                ),
                'default_value' => 'vente',
                'return_format' => 'value',
            ),
            array(
                'key' => 'field_btp360_brand',
                'label' => 'Brand',
                'name' => 'brand',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_model',
                'label' => 'Model',
                'name' => 'model',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_year_built',
                'label' => 'Year Built',
                'name' => 'year_built',
                'type' => 'number',
            ),
            array(
                'key' => 'field_btp360_customs_year',
                'label' => 'Customs Year',
                'name' => 'customs_year',
                'type' => 'number',
            ),
            array(
                'key' => 'field_btp360_mileage',
                'label' => 'Mileage (km)',
                'name' => 'mileage',
                'type' => 'number',
            ),
            array(
                'key' => 'field_btp360_city',
                'label' => 'City',
                'name' => 'city',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_whatsapp',
                'label' => 'WhatsApp',
                'name' => 'whatsapp',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_main_image',
                'label' => 'Main Image URL',
                'name' => 'main_image_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_btp360_gallery',
                'label' => 'Gallery Image URLs',
                'name' => 'gallery_urls',
                'type' => 'textarea',
                'instructions' => 'One URL per line.',
            ),
            array(
                'key' => 'field_btp360_card_image',
                'label' => 'Card Image URL',
                'name' => 'card_image_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_btp360_short_description',
                'label' => 'Short Description',
                'name' => 'short_description',
                'type' => 'textarea',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'listing',
                ),
            ),
        ),
    ));

    acf_add_local_field_group(array(
        'key' => 'group_btp360_home_fields',
        'title' => 'Homepage Blocks',
        'fields' => array(
            array(
                'key' => 'field_btp360_hero_badge',
                'label' => 'Hero Badge',
                'name' => 'hero_badge',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_hero_description',
                'label' => 'Hero Description',
                'name' => 'hero_description',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_btp360_hero_image_url',
                'label' => 'Hero Image URL',
                'name' => 'hero_image_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_btp360_stat_annonces',
                'label' => 'Annonces Count Label',
                'name' => 'stat_annonces',
                'type' => 'text',
            ),
            array(
                'key' => 'field_btp360_stat_sellers',
                'label' => 'Sellers Count Label',
                'name' => 'stat_sellers',
                'type' => 'text',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'btp360_register_acf_fields');
