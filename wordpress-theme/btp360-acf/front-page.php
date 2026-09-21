<?php
get_header();

$page_id = get_the_ID();
$hero_badge = btp360_get_field('hero_badge', $page_id, 'Marche BTP Maroc');
$hero_title = btp360_get_field('hero_title', $page_id, 'Portail de vente de vehicules industriels d\'occasion');
$hero_description = btp360_get_field('hero_description', $page_id, 'Maquette homepage inspiree de btp360: categories claires, annonces recentes et section actualites.');
$hero_image = btp360_get_field('hero_image_url', $page_id, 'hero.webp');
$stat_annonces = btp360_get_field('stat_annonces', $page_id, '2,450+');
$stat_sellers = btp360_get_field('stat_sellers', $page_id, '980+');

$parents = get_terms(array(
    'taxonomy' => 'listing_category',
    'hide_empty' => false,
    'parent' => 0,
));

$listings = new WP_Query(array(
    'post_type' => 'listing',
    'posts_per_page' => 6,
));

$news = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
));

function btp360_card_group($post_id)
{
    $terms = wp_get_post_terms($post_id, 'listing_category');
    if (empty($terms) || is_wp_error($terms)) {
        return 'all';
    }

    foreach ($terms as $term) {
        if ((int) $term->parent === 0) {
            $name = strtolower($term->name);
            if (strpos($name, 'poids') !== false) {
                return 'poids';
            }
            if (strpos($name, 'manutention') !== false) {
                return 'manutention';
            }
            if (strpos($name, 'materiels') !== false) {
                return 'tp';
            }
            return sanitize_title($name);
        }
    }

    return 'all';
}
?>

<section class="container hero-grid section">
    <div>
        <p class="chip"><?php echo esc_html($hero_badge); ?></p>
        <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
        <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
        <div class="row wrap gap-sm">
            <a class="btn btn-brand" href="<?php echo esc_url(home_url('/annonces/')); ?>">Voir les annonces</a>
            <a class="btn btn-outline" href="<?php echo esc_url(home_url('/bulldozer/')); ?>">Voir categorie Bulldozer</a>
        </div>
    </div>
    <div class="hero-panel">
        <img src="<?php echo esc_url($hero_image); ?>" alt="Camions industriels" class="hero-image" />
        <div class="grid cols-2 gap-sm stats-grid">
            <div class="stat-box">
                <p>Annonces actives</p>
                <strong><?php echo esc_html($stat_annonces); ?></strong>
            </div>
            <div class="stat-box">
                <p>Vendeurs verifies</p>
                <strong><?php echo esc_html($stat_sellers); ?></strong>
            </div>
        </div>
    </div>
</section>

<section class="container section">
    <div class="section-header">
        <h2>Categories principales</h2>
    </div>
    <div class="grid cols-4 gap-md">
        <?php if (!empty($parents) && !is_wp_error($parents)) : ?>
            <?php foreach ($parents as $parent) : ?>
                <article class="card">
                    <h3><?php echo esc_html($parent->name); ?></h3>
                    <?php
                    $children = get_terms(array(
                        'taxonomy' => 'listing_category',
                        'hide_empty' => false,
                        'parent' => $parent->term_id,
                    ));
                    ?>
                    <ul class="plain-list">
                        <?php foreach ($children as $child) : ?>
                            <li><?php echo esc_html($child->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<section class="container section">
    <div class="section-header row between center wrap">
        <h2>Dernieres annonces</h2>
        <div class="row wrap gap-sm">
            <button class="cat-filter btn btn-outline" data-cat="all">Tout</button>
            <button class="cat-filter btn btn-outline" data-cat="poids">Poids lourds</button>
            <button class="cat-filter btn btn-outline" data-cat="tp">TP</button>
            <button class="cat-filter btn btn-outline" data-cat="manutention">Manutention</button>
        </div>
    </div>

    <div id="homeListings" class="grid cols-3 gap-md">
        <?php if ($listings->have_posts()) : ?>
            <?php while ($listings->have_posts()) : $listings->the_post(); ?>
                <?php
                $post_id = get_the_ID();
                $price = (int) btp360_get_field('price_mad', $post_id, 0);
                $price_label = btp360_get_field('price_label', $post_id, '');
                $image = btp360_get_field('card_image_url', $post_id, 'hero.webp');
                $cat_group = btp360_card_group($post_id);
                ?>
                <article class="card listing" data-cat="<?php echo esc_attr($cat_group); ?>">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" />
                    </a>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p class="price">
                        <?php
                        if ($price > 0) {
                            echo esc_html(number_format_i18n($price)) . ' MAD';
                        } else {
                            echo esc_html($price_label ?: 'Prix sur demande');
                        }
                        ?>
                    </p>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>

<section class="container section">
    <h2>Actualites</h2>
    <div class="grid cols-3 gap-md">
        <?php if ($news->have_posts()) : ?>
            <?php while ($news->have_posts()) : $news->the_post(); ?>
                <article class="card">
                    <img src="hero.webp" alt="<?php the_title_attribute(); ?>" class="card-image" />
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
