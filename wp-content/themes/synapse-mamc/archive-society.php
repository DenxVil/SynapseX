<?php
/**
 * Template for displaying societies archive
 */

get_header(); ?>

<main class="site-main">
    <section class="society-header">
        <div class="container">
            <h1>Our Societies</h1>
            <p>Discover the diverse groups that make Synapse possible</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="grid">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="card fade-in">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/default-society.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn">View Details</a>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No societies found.</p>
                <?php endif; ?>
            </div>
            
            <?php the_posts_pagination(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
