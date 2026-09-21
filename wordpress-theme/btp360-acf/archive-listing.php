<?php
get_header();
?>
<section class="container section">
    <h1>Toutes les annonces</h1>
    <div class="grid cols-3 gap-md">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $post_id = get_the_ID();
                $image = btp360_get_field('card_image_url', $post_id, 'hero.webp');
                $price = (int) btp360_get_field('price_mad', $post_id, 0);
                $price_label = btp360_get_field('price_label', $post_id, 'Prix sur demande');
                ?>
                <article class="card">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" class="card-image" /></a>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="price"><?php echo $price > 0 ? esc_html(number_format_i18n($price) . ' MAD') : esc_html($price_label); ?></p>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucune annonce disponible.</p>
        <?php endif; ?>
    </div>

    <div class="top-space">
        <?php the_posts_pagination(); ?>
    </div>
</section>
<?php
get_footer();
