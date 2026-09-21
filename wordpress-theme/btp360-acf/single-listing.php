<?php
get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();

        $post_id = get_the_ID();
        $price = (int) btp360_get_field('price_mad', $post_id, 0);
        $price_label = btp360_get_field('price_label', $post_id, 'Prix sur demande');
        $main_image = btp360_get_field('main_image_url', $post_id, btp360_get_field('card_image_url', $post_id, 'hero.webp'));
        $gallery = btp360_get_field('gallery_urls', $post_id, '');
        $gallery_items = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $gallery)));

        $reference = btp360_get_field('reference', $post_id, '');
        $views = (int) btp360_get_field('views', $post_id, 0);
        $brand = btp360_get_field('brand', $post_id, '');
        $model = btp360_get_field('model', $post_id, '');
        $year_built = btp360_get_field('year_built', $post_id, '');
        $customs_year = btp360_get_field('customs_year', $post_id, '');
        $mileage = btp360_get_field('mileage', $post_id, '');
        $phone = btp360_get_field('phone', $post_id, '');
        $whatsapp = btp360_get_field('whatsapp', $post_id, '');
        $short_description = btp360_get_field('short_description', $post_id, get_the_excerpt());

        $similar = new WP_Query(array(
            'post_type' => 'listing',
            'posts_per_page' => 3,
            'post__not_in' => array($post_id),
        ));
        ?>
        <section class="container section">
            <p class="muted-text">Accueil / Annonces / <?php the_title(); ?></p>
            <h1><?php the_title(); ?></h1>
            <div class="row wrap gap-sm muted-text">
                <span class="chip"><?php echo esc_html($views); ?> vues</span>
                <?php if ($reference) : ?>
                    <span>Ref: <?php echo esc_html($reference); ?></span>
                <?php endif; ?>
            </div>
        </section>

        <section class="container section grid cols-12 gap-md">
            <div class="col-span-7">
                <article class="card">
                    <img src="<?php echo esc_url($main_image); ?>" alt="<?php the_title_attribute(); ?>" class="single-main-image" />
                    <?php if (!empty($gallery_items)) : ?>
                        <div class="grid cols-4 gap-sm gallery-strip">
                            <?php foreach ($gallery_items as $url) : ?>
                                <img src="<?php echo esc_url($url); ?>" alt="Gallery image" class="gallery-thumb" />
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
            <aside class="col-span-5">
                <article class="card">
                    <p class="price-large">
                        <?php
                        if ($price > 0) {
                            echo esc_html(number_format_i18n($price)) . ' MAD';
                        } else {
                            echo esc_html($price_label);
                        }
                        ?>
                    </p>
                    <div class="grid cols-2 gap-sm detail-grid">
                        <div><p>Constructeur</p><strong><?php echo esc_html($brand ?: '-'); ?></strong></div>
                        <div><p>Modele</p><strong><?php echo esc_html($model ?: '-'); ?></strong></div>
                        <div><p>Annee</p><strong><?php echo esc_html($year_built ?: '-'); ?></strong></div>
                        <div><p>Dedouanement</p><strong><?php echo esc_html($customs_year ?: '-'); ?></strong></div>
                        <div><p>Kilometrage</p><strong><?php echo esc_html($mileage ? number_format_i18n((int) $mileage) . ' km' : '-'); ?></strong></div>
                    </div>
                    <div class="row wrap gap-sm top-space">
                        <?php if ($phone) : ?>
                            <a class="btn btn-brand" href="tel:<?php echo esc_attr($phone); ?>">Numero de telephone</a>
                        <?php endif; ?>
                        <?php if ($whatsapp) : ?>
                            <a class="btn btn-outline" href="https://wa.me/<?php echo esc_attr(preg_replace('/\D+/', '', (string) $whatsapp)); ?>" target="_blank" rel="noopener">Whatsapp</a>
                        <?php endif; ?>
                    </div>
                    <?php if ($short_description) : ?>
                        <p class="top-space"><?php echo esc_html($short_description); ?></p>
                    <?php endif; ?>
                </article>
            </aside>
        </section>

        <?php if ($similar->have_posts()) : ?>
            <section class="container section">
                <h2>Annonces similaires</h2>
                <div class="grid cols-3 gap-md">
                    <?php while ($similar->have_posts()) : $similar->the_post(); ?>
                        <?php $img = btp360_get_field('card_image_url', get_the_ID(), 'hero.webp'); ?>
                        <article class="card">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" /></a>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p class="price"><?php echo esc_html(get_post_meta(get_the_ID(), 'price_label', true) ?: (get_post_meta(get_the_ID(), 'price_mad', true) ? number_format_i18n((int) get_post_meta(get_the_ID(), 'price_mad', true)) . ' MAD' : 'Prix sur demande')); ?></p>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </section>
        <?php endif; ?>
        <?php
    endwhile;
endif;

get_footer();
