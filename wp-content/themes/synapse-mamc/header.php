<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Synapse 2026 - Annual Cultural & Medical Festival of MAMC">
    <meta name="keywords" content="Synapse, MAMC, Medical College, Festival, Cultural Events, Medical Symposium">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <div class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <h1><a href="<?php echo esc_url(home_url('/')); ?>" style="color: white; text-decoration: none;">
                    Synapse 2026
                </a></h1>
                <span>MAMC Annual Festival</span>
            <?php endif; ?>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'fallback_cb' => 'synapse_default_menu',
            ));
            ?>
        </nav>
    </div>
</header>

<?php
// Default menu fallback
function synapse_default_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
        <li><a href="<?php echo esc_url(home_url('/societies')); ?>">Societies</a></li>
        <li><a href="<?php echo esc_url(home_url('/events')); ?>">Events</a></li>
        <li><a href="<?php echo esc_url(home_url('/#about')); ?>">About</a></li>
        <li><a href="<?php echo esc_url(home_url('/#contact')); ?>">Contact</a></li>
    </ul>
    <?php
}
?>
