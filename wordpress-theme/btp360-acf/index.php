<?php
get_header();
?>
<section class="container section">
    <h1>Actualites</h1>
    <div class="grid cols-3">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="card">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucun contenu.</p>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
