<?php

if (!defined('ABSPATH')) {
    exit;
}

function btp360_set_field_value($post_id, $field_name, $value)
{
    if (function_exists('update_field')) {
        update_field($field_name, $value, $post_id);
    } else {
        update_post_meta($post_id, $field_name, $value);
    }
}

function btp360_upsert_page($title, $slug, $template = 'default', $content = '')
{
    $existing = get_page_by_path($slug);

    $page_args = array(
        'post_title' => $title,
        'post_name' => $slug,
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_content' => $content,
    );

    if ($existing) {
        $page_args['ID'] = $existing->ID;
        $page_id = wp_update_post($page_args);
    } else {
        $page_id = wp_insert_post($page_args);
    }

    if (!is_wp_error($page_id)) {
        update_post_meta($page_id, '_wp_page_template', $template);
    }

    return $page_id;
}

function btp360_seed_terms()
{
    $structure = array(
        'Materiels TP' => array('Pelle', 'Tractopelle', 'Chargeuse', 'Bulldozer'),
        'Manutention' => array('Chariot elevateur', 'Chariot telescopique', 'Gerbeur', 'Nacelle'),
        'Poids Lourds' => array('Tracteur routier', 'Camion', 'Ensemble routier', 'Semi remorque'),
        'Agricole' => array('Tracteur agricole', 'Moisson', 'Outils du sol', 'Fenaison'),
    );

    foreach ($structure as $parent_name => $children) {
        $parent = term_exists($parent_name, 'listing_category');
        if (!$parent) {
            $parent = wp_insert_term($parent_name, 'listing_category');
        }

        $parent_id = is_array($parent) ? (int) $parent['term_id'] : (int) $parent;

        foreach ($children as $child_name) {
            if (!term_exists($child_name, 'listing_category')) {
                wp_insert_term($child_name, 'listing_category', array(
                    'parent' => $parent_id,
                ));
            }
        }
    }
}

function btp360_seed_listings()
{
    $listings = array(
        array(
            'title' => 'TRACTEUR ROUTIER DAF XF460 EURO 6 ANNEE 2017',
            'slug' => 'tracteur-routier-daf-xf460-2017',
            'content' => 'Daf xf 460, modele 2017, diwana 2022, km 500000. Taman 65. Telephone: 0773-183755.',
            'category' => 'Poids Lourds',
            'sub_category' => 'Tracteur routier',
            'reference' => 'DAF-XF460-2017',
            'views' => 112,
            'price_mad' => 650000,
            'transaction_type' => 'vente',
            'brand' => 'DAF',
            'model' => 'XF460',
            'year_built' => 2017,
            'customs_year' => 2022,
            'mileage' => 500000,
            'city' => 'Casablanca',
            'phone' => '0773183755',
            'whatsapp' => '2120773183755',
            'main_image_url' => 'svg/svg_00010.svg',
            'gallery_urls' => "svg/svg_00010.svg\nsvg/svg_00011.svg\nsvg/svg_00013.svg\nhero.webp",
            'card_image_url' => 'svg/svg_00010.svg',
            'short_description' => 'Tracteur DAF XF460, modele 2017, euro 6.',
        ),
        array(
            'title' => 'BULLDOZER KOMATSU D75S',
            'slug' => 'bulldozer-komatsu-d75s',
            'content' => 'Annonce bulldozer Komatsu D75S.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_mad' => 140000,
            'brand' => 'Komatsu',
            'year_built' => 1998,
            'city' => 'Ben Slimane',
            'card_image_url' => 'svg/svg_00005.svg',
            'short_description' => 'Bulldozer Komatsu D75S en bon etat.',
        ),
        array(
            'title' => 'BULLDOZER CATERPILLAR D6H ANNEE 1994',
            'slug' => 'bulldozer-caterpillar-d6h-1994',
            'content' => 'Bulldozer Caterpillar D6H annee 1994.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_mad' => 360000,
            'brand' => 'Caterpillar',
            'year_built' => 1994,
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'BULDOZER CATERPILLAR D8L ANNEE 1995',
            'slug' => 'buldozer-caterpillar-d8l-1995',
            'content' => 'Buldozer Caterpillar D8L annee 1995.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_label' => 'Prix sur demande',
            'brand' => 'Caterpillar',
            'year_built' => 1995,
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'BULLDOZER CATERPILLAR D8L',
            'slug' => 'bulldozer-caterpillar-d8l',
            'content' => 'Bulldozer Caterpillar D8L.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_label' => 'Prix sur demande',
            'brand' => 'Caterpillar',
            'year_built' => 2000,
            'city' => 'Tanger',
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'BULLDOZER CATERPILLAR D8H',
            'slug' => 'bulldozer-caterpillar-d8h',
            'content' => 'Bulldozer Caterpillar D8H.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_label' => 'Prix sur demande',
            'brand' => 'Caterpillar',
            'year_built' => 1999,
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'BULLDOZER CATERPILLAR D8R',
            'slug' => 'bulldozer-caterpillar-d8r',
            'content' => 'Bulldozer Caterpillar D8R.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_label' => 'Prix sur demande',
            'brand' => 'Caterpillar',
            'year_built' => 2004,
            'phone' => '0642955626',
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'BULLDOZER CATERPILLAR D6R ANNEE 2006',
            'slug' => 'bulldozer-caterpillar-d6r-2006',
            'content' => 'Bulldozer Caterpillar D6R annee 2006.',
            'category' => 'Materiels TP',
            'sub_category' => 'Bulldozer',
            'price_mad' => 540000,
            'brand' => 'Caterpillar',
            'year_built' => 2006,
            'card_image_url' => 'svg/svg_00005.svg',
        ),
        array(
            'title' => 'Tracteur routier Iveco 2018',
            'slug' => 'tracteur-routier-iveco-2018',
            'content' => 'Annonce homepage: tracteur routier Iveco 2018.',
            'category' => 'Poids Lourds',
            'sub_category' => 'Tracteur routier',
            'price_mad' => 480000,
            'brand' => 'Iveco',
            'year_built' => 2018,
            'card_image_url' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=900&q=80',
        ),
        array(
            'title' => 'Tractopelle JCB 3CX 1999',
            'slug' => 'tractopelle-jcb-3cx-1999',
            'content' => 'Annonce homepage: Tractopelle JCB 3CX 1999.',
            'category' => 'Materiels TP',
            'sub_category' => 'Tractopelle',
            'price_mad' => 190000,
            'brand' => 'JCB',
            'year_built' => 1999,
            'card_image_url' => 'https://images.unsplash.com/photo-1599707254554-027aeb4deacd?auto=format&fit=crop&w=900&q=80',
        ),
        array(
            'title' => 'Chariot telescopique JCB 2006',
            'slug' => 'chariot-telescopique-jcb-2006',
            'content' => 'Annonce homepage: Chariot telescopique JCB 2006.',
            'category' => 'Manutention',
            'sub_category' => 'Chariot telescopique',
            'price_mad' => 460000,
            'brand' => 'JCB',
            'year_built' => 2006,
            'card_image_url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=900&q=80',
        ),
    );

    foreach ($listings as $item) {
        $existing = get_page_by_path($item['slug'], OBJECT, 'listing');

        $post_args = array(
            'post_title' => $item['title'],
            'post_name' => $item['slug'],
            'post_type' => 'listing',
            'post_status' => 'publish',
            'post_content' => $item['content'],
        );

        if ($existing) {
            $post_args['ID'] = $existing->ID;
            $post_id = wp_update_post($post_args);
        } else {
            $post_id = wp_insert_post($post_args);
        }

        if (is_wp_error($post_id)) {
            continue;
        }

        $category_term = get_term_by('name', $item['category'], 'listing_category');
        $sub_term = get_term_by('name', $item['sub_category'], 'listing_category');
        $term_ids = array();

        if ($category_term) {
            $term_ids[] = (int) $category_term->term_id;
        }
        if ($sub_term) {
            $term_ids[] = (int) $sub_term->term_id;
        }

        if (!empty($term_ids)) {
            wp_set_object_terms($post_id, $term_ids, 'listing_category');
        }

        foreach ($item as $key => $value) {
            if (in_array($key, array('title', 'slug', 'content', 'category', 'sub_category'), true)) {
                continue;
            }
            btp360_set_field_value($post_id, $key, $value);
        }
    }
}

function btp360_seed_news_posts()
{
    $posts = array(
        array(
            'title' => 'Tombereau',
            'slug' => 'actualite-tombereau-1',
            'content' => 'Un engin de carrieres et grands chantiers. Resume court avec lien vers detail.',
            'excerpt' => 'Un engin de carrieres et grands chantiers.',
        ),
        array(
            'title' => 'Tombereau',
            'slug' => 'actualite-tombereau-2',
            'content' => 'Un engin de carrieres et grands chantiers. Resume court avec lien vers detail.',
            'excerpt' => 'Un engin de carrieres et grands chantiers.',
        ),
        array(
            'title' => 'Grue mobile',
            'slug' => 'actualite-grue-mobile',
            'content' => 'Equipement de levage imposant. Resume article format blog industriel.',
            'excerpt' => 'Equipement de levage imposant.',
        ),
    );

    foreach ($posts as $item) {
        $existing = get_page_by_path($item['slug'], OBJECT, 'post');

        $args = array(
            'post_title' => $item['title'],
            'post_name' => $item['slug'],
            'post_type' => 'post',
            'post_status' => 'publish',
            'post_content' => $item['content'],
            'post_excerpt' => $item['excerpt'],
        );

        if ($existing) {
            $args['ID'] = $existing->ID;
            wp_update_post($args);
        } else {
            wp_insert_post($args);
        }
    }
}

function btp360_seed_pages_and_options()
{
    $home_id = btp360_upsert_page('Accueil', 'accueil', 'default');
    $login_id = btp360_upsert_page('Connexion / Inscription', 'login-register', 'page-login-register.php');
    $dashboard_id = btp360_upsert_page('Dashboard Client', 'dashboard-client', 'page-dashboard-client.php');
    $depose_id = btp360_upsert_page('Deposer une annonce', 'depose-annonce', 'page-depose-annonce.php');
    $bulldozer_id = btp360_upsert_page('Bulldozer', 'bulldozer', 'page-bulldozer.php');

    if (!is_wp_error($home_id)) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', (int) $home_id);

        btp360_set_field_value($home_id, 'hero_badge', 'Marche BTP Maroc');
        btp360_set_field_value($home_id, 'hero_title', 'Portail de vente de vehicules industriels d\'occasion');
        btp360_set_field_value($home_id, 'hero_description', 'Maquette homepage inspiree de btp360: categories claires, annonces recentes et section actualites.');
        btp360_set_field_value($home_id, 'hero_image_url', 'hero.webp');
        btp360_set_field_value($home_id, 'stat_annonces', '2,450+');
        btp360_set_field_value($home_id, 'stat_sellers', '980+');
    }

    $menu_name = 'Primary Menu';
    $menu = wp_get_nav_menu_object($menu_name);
    if (!$menu) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = (int) $menu->term_id;
    }

    $locations = get_theme_mod('nav_menu_locations', array());
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    $menu_pages = array($home_id, $bulldozer_id, $depose_id, $login_id, $dashboard_id);
    foreach ($menu_pages as $page_id) {
        if (is_wp_error($page_id) || !$page_id) {
            continue;
        }

        $already_in_menu = false;
        $menu_items = wp_get_nav_menu_items($menu_id);
        if (!empty($menu_items)) {
            foreach ($menu_items as $menu_item) {
                if ((int) $menu_item->object_id === (int) $page_id) {
                    $already_in_menu = true;
                    break;
                }
            }
        }

        if ($already_in_menu) {
            continue;
        }

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-object-id' => $page_id,
            'menu-item-object' => 'page',
            'menu-item-type' => 'post_type',
            'menu-item-status' => 'publish',
        ));
    }
}

function btp360_run_static_seeders()
{
    btp360_seed_terms();
    btp360_seed_listings();
    btp360_seed_news_posts();
    btp360_seed_pages_and_options();
}

function btp360_register_seed_admin_page()
{
    add_management_page(
        __('BTP360 Seeder', 'btp360-acf'),
        __('BTP360 Seeder', 'btp360-acf'),
        'manage_options',
        'btp360-seeder',
        'btp360_render_seed_admin_page'
    );
}
add_action('admin_menu', 'btp360_register_seed_admin_page');

function btp360_render_seed_admin_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['btp360_seed_now'])) {
        check_admin_referer('btp360_seed_action', 'btp360_seed_nonce');
        btp360_run_static_seeders();
        echo '<div class="notice notice-success"><p>Seeder executed successfully.</p></div>';
    }

    echo '<div class="wrap">';
    echo '<h1>BTP360 Static Data Seeder</h1>';
    echo '<p>This imports categories, listings, blog posts, and all required pages/templates from your static mockup.</p>';
    echo '<form method="post">';
    wp_nonce_field('btp360_seed_action', 'btp360_seed_nonce');
    submit_button('Run Seeder Now', 'primary', 'btp360_seed_now');
    echo '</form>';
    echo '</div>';
}
