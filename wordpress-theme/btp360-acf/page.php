<?php
get_header();
?>
<section class="container section">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="card">
                <h1><?php the_title(); ?></h1>
                <div class="prose-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</section>
<?php
get_footer();
