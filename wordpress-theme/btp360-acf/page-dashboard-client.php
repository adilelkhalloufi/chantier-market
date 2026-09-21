<?php
/*
Template Name: Dashboard Client Page
*/

get_header();

$current_user = wp_get_current_user();
$display_name = $current_user && $current_user->exists() ? $current_user->display_name : 'Ahmed';
?>
<section class="container section">
    <article class="dark-panel">
        <p class="chip">Dashboard client</p>
        <h1>Bienvenue, <?php echo esc_html($display_name); ?></h1>
        <p>Gere ton compte, tes annonces et les parametres de securite.</p>
    </article>
</section>

<section class="container section grid cols-12 gap-md">
    <aside class="col-span-3">
        <article class="card">
            <p class="small-title">Navigation</p>
            <div class="stack">
                <button data-tab="profil" class="dash-tab btn btn-brand">Mon profil</button>
                <button data-tab="annonces" class="dash-tab btn btn-outline">Mes annonces</button>
                <button data-tab="parametres" class="dash-tab btn btn-outline">Parametres</button>
            </div>
        </article>
    </aside>

    <section class="col-span-9">
        <article id="panelProfil" class="card panel">
            <h2>Mon profil</h2>
            <p>Met a jour vos informations personnelles.</p>
            <div class="grid cols-2 gap-md top-space">
                <div class="form-group"><label>Nom complet</label><input type="text" value="<?php echo esc_attr($display_name); ?>" /></div>
                <div class="form-group"><label>Email</label><input type="email" value="<?php echo esc_attr($current_user->user_email ?? 'ahmed@btp360.ma'); ?>" /></div>
                <div class="form-group"><label>Telephone</label><input type="text" value="06 55 55 55 55" /></div>
                <div class="form-group"><label>Ville</label><input type="text" value="Casablanca" /></div>
            </div>
        </article>

        <article id="panelAnnonces" class="card panel hidden">
            <h2>Mes annonces</h2>
            <p>Liste de vos produits publies.</p>
            <?php
            $my_posts = new WP_Query(array(
                'post_type' => 'listing',
                'posts_per_page' => 4,
                'author' => get_current_user_id() ?: 1,
            ));
            ?>
            <div class="grid cols-2 gap-md top-space">
                <?php if ($my_posts->have_posts()) : ?>
                    <?php while ($my_posts->have_posts()) : $my_posts->the_post(); ?>
                        <article class="card subtle">
                            <h3><?php the_title(); ?></h3>
                            <p class="price"><?php echo esc_html(get_post_meta(get_the_ID(), 'price_label', true) ?: (get_post_meta(get_the_ID(), 'price_mad', true) ? number_format_i18n((int) get_post_meta(get_the_ID(), 'price_mad', true)) . ' MAD' : 'Prix sur demande')); ?></p>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>Aucune annonce pour cet utilisateur.</p>
                <?php endif; ?>
            </div>
        </article>

        <article id="panelParametres" class="card panel hidden">
            <h2>Parametres</h2>
            <p>Options de securite et notifications.</p>
            <div class="stack top-space">
                <label><input type="checkbox" checked /> Notifications email</label>
                <label><input type="checkbox" /> Recevoir messages WhatsApp</label>
                <label><input type="checkbox" checked /> Double verification du compte</label>
            </div>
        </article>
    </section>
</section>
<?php
get_footer();
