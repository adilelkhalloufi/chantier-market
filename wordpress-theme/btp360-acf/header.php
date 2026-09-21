<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header glass">
    <div class="container row between center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-link">
            <span class="brand-mark">B</span>
            <span class="brand-text"><?php bloginfo('name'); ?></span>
        </a>

        <nav class="primary-nav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'fallback_cb' => false,
                'menu_class' => 'menu-list',
            ));
            ?>
        </nav>

        <div class="header-cta">
            <a class="btn btn-outline" href="<?php echo esc_url(home_url('/login-register/')); ?>">Connexion / Inscription</a>
            <a class="btn btn-brand" href="<?php echo esc_url(home_url('/depose-annonce/')); ?>">Deposer une annonce</a>
        </div>
    </div>
</header>
<main class="site-main">
