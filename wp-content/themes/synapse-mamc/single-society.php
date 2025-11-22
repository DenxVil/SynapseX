<?php
/**
 * Template for displaying single society
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

<main class="site-main">
    <section class="society-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <p>Explore our events and activities</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="society-info">
                <?php if (has_post_thumbnail()) : ?>
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="society-description">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Society Events -->
    <section class="content-section" style="background: white;">
        <div class="container">
            <h2>Events by <?php the_title(); ?></h2>
            <div class="event-list">
                <?php
                $society_events = new WP_Query(array(
                    'post_type' => 'event',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => '_event_society',
                            'value' => get_the_ID(),
                            'compare' => '='
                        )
                    ),
                    'meta_key' => '_event_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                ));
                
                if ($society_events->have_posts()) :
                    while ($society_events->have_posts()) : $society_events->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $event_venue = get_post_meta(get_the_ID(), '_event_venue', true);
                        $event_fee = get_post_meta(get_the_ID(), '_event_fee', true);
                ?>
                    <div class="event-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-event.jpg" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="event-details">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                            <?php if ($event_date) : ?>
                                <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event_date)); ?></p>
                            <?php endif; ?>
                            <?php if ($event_time) : ?>
                                <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($event_time)); ?></p>
                            <?php endif; ?>
                            <?php if ($event_venue) : ?>
                                <p><strong>Venue:</strong> <?php echo esc_html($event_venue); ?></p>
                            <?php endif; ?>
                            <?php if ($event_fee) : ?>
                                <p><strong>Fee:</strong> ₹<?php echo esc_html($event_fee); ?></p>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn">Register Now</a>
                        </div>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p>No events scheduled yet. Check back soon!</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php endwhile; ?>

<?php get_footer(); ?>
