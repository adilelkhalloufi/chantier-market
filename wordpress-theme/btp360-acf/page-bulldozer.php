<?php
/*
Template Name: Bulldozer Page
*/

get_header();

$bulldozer_query = new WP_Query(array(
    'post_type' => 'listing',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'listing_category',
            'field' => 'name',
            'terms' => array('Bulldozer'),
        ),
    ),
));
?>
<section class="container section">
    <p class="muted-text">Accueil / Materiels TP / Bulldozer</p>
    <div class="row between center wrap">
        <h1>BULLDOZER</h1>
        <span id="resultCount" class="chip"><?php echo esc_html((string) $bulldozer_query->post_count); ?> resultats</span>
    </div>
</section>

<section class="container section grid cols-12 gap-md">
    <aside class="col-span-4">
        <article class="card sticky-card">
            <h2>Recherche avancee</h2>
            <div class="form-group">
                <label for="searchInput">Mot cle</label>
                <input id="searchInput" type="text" placeholder="ex: D8R, Komatsu..." />
            </div>
            <div class="form-group">
                <label for="brandFilter">Marque</label>
                <select id="brandFilter">
                    <option value="all">Toutes</option>
                    <option value="Caterpillar">Caterpillar</option>
                    <option value="Komatsu">Komatsu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="yearMin">Annee min</label>
                <input id="yearMin" type="number" value="1994" />
            </div>
            <div class="form-group">
                <label for="yearMax">Annee max</label>
                <input id="yearMax" type="number" value="2006" />
            </div>
            <div class="form-group">
                <label for="priceMax">Prix max (MAD)</label>
                <input id="priceMax" type="range" min="140000" max="600000" value="600000" step="10000" />
                <p>Jusqu'a <strong id="priceLabel">600000</strong> MAD</p>
            </div>
            <div class="row gap-sm">
                <button id="applyBtn" class="btn btn-brand">Filtrer</button>
                <button id="resetBtn" class="btn btn-outline">Reset</button>
            </div>
        </article>
    </aside>

    <section class="col-span-8">
        <div class="row between center wrap">
            <p class="muted-text">Showing all <?php echo esc_html((string) $bulldozer_query->post_count); ?> results</p>
            <select id="sortSelect">
                <option value="latest">Sort by latest</option>
                <option value="priceAsc">Price: Low to High</option>
                <option value="priceDesc">Price: High to Low</option>
                <option value="yearDesc">Year: Newest first</option>
            </select>
        </div>

        <div id="cardsGrid" class="grid cols-3 gap-md top-space">
            <?php if ($bulldozer_query->have_posts()) : ?>
                <?php while ($bulldozer_query->have_posts()) : $bulldozer_query->the_post(); ?>
                    <?php
                    $id = get_the_ID();
                    $brand = btp360_get_field('brand', $id, '');
                    $year = (int) btp360_get_field('year_built', $id, 0);
                    $price = (int) btp360_get_field('price_mad', $id, 0);
                    $price_label = btp360_get_field('price_label', $id, 'Prix sur demande');
                    $image = btp360_get_field('card_image_url', $id, 'svg/svg_00005.svg');
                    ?>
                    <article class="card listing" data-name="<?php echo esc_attr(strtolower(get_the_title())); ?>" data-brand="<?php echo esc_attr($brand); ?>" data-year="<?php echo esc_attr((string) $year); ?>" data-price="<?php echo esc_attr((string) $price); ?>">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" /></a>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="price"><?php echo $price > 0 ? esc_html(number_format_i18n($price) . ' MAD') : esc_html($price_label); ?></p>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </section>
</section>
<?php
wp_enqueue_script('btp360-bulldozer-page', get_template_directory_uri() . '/assets/js/page-bulldozer.js', array(), BTP360_THEME_VERSION, true);
get_footer();
