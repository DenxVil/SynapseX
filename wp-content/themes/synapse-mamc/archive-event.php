<?php
/**
 * Template for displaying events archive
 */

get_header(); ?>

<main class="site-main">
    <section class="society-header">
        <div class="container">
            <h1>All Events</h1>
            <p>Browse all upcoming events and competitions</p>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="event-list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); 
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $event_venue = get_post_meta(get_the_ID(), '_event_venue', true);
                        $event_fee = get_post_meta(get_the_ID(), '_event_fee', true);
                        $event_society_id = get_post_meta(get_the_ID(), '_event_society', true);
                    ?>
                        <div class="event-item fade-in">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/default-event.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <div class="event-details">
                                <h3><?php the_title(); ?></h3>
                                <?php if ($event_society_id) : 
                                    $society = get_post($event_society_id);
                                ?>
                                    <p><em>By <?php echo esc_html($society->post_title); ?></em></p>
                                <?php endif; ?>
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
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No events found.</p>
                <?php endif; ?>
            </div>
            
            <?php the_posts_pagination(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
