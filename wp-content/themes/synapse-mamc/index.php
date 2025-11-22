<?php
/**
 * Main template file
 */

get_header(); ?>

<main class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h2 class="fade-in">Welcome to Synapse 2026</h2>
            <p class="fade-in">The Annual Cultural & Medical Festival of MAMC</p>
            <p class="fade-in">Join us for an unforgettable experience filled with cultural events, medical symposiums, and competitions</p>
            <a href="#about" class="btn">Learn More</a>
        </div>
    </section>

    <!-- About Synapse Section -->
    <section id="about" class="content-section">
        <div class="container">
            <h2>About Synapse MAMC</h2>
            <div class="society-info">
                <p>
                    <strong>Synapse</strong> is the annual cultural and medical festival of Maulana Azad Medical College (MAMC), 
                    one of India's premier medical institutions. This prestigious event brings together students from medical 
                    colleges across the nation to showcase their talents, share knowledge, and celebrate the spirit of unity 
                    and excellence.
                </p>
                <p>
                    Scheduled for <strong>2026</strong>, Synapse promises to be an extraordinary blend of cultural performances, 
                    medical symposiums, competitive events, and social activities. The festival serves as a platform for 
                    aspiring medical professionals to network, learn, and express their creativity beyond academics.
                </p>
                <p>
                    <strong>MAMC (Maulana Azad Medical College)</strong> is affiliated with the University of Delhi and is 
                    renowned for its academic excellence, cutting-edge research, and commitment to healthcare education. 
                    Located in New Delhi, MAMC has been shaping the future of medicine since 1958.
                </p>
            </div>
        </div>
    </section>

    <!-- Societies Section -->
    <section class="content-section" style="background: white;">
        <div class="container">
            <h2>Our Societies</h2>
            <div class="grid">
                <?php
                $societies_query = new WP_Query(array(
                    'post_type' => 'society',
                    'posts_per_page' => -1,
                ));
                
                if ($societies_query->have_posts()) :
                    while ($societies_query->have_posts()) : $societies_query->the_post();
                ?>
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
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="card">
                        <h3>Cultural Society</h3>
                        <p>Organizing dance, music, and drama events to celebrate artistic expression.</p>
                    </div>
                    <div class="card">
                        <h3>Medical Society</h3>
                        <p>Conducting medical quizzes, case presentations, and symposiums.</p>
                    </div>
                    <div class="card">
                        <h3>Sports Society</h3>
                        <p>Managing various sports competitions and athletic events.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="content-section">
        <div class="container">
            <h2>Upcoming Events</h2>
            <div class="event-list">
                <?php
                $events_query = new WP_Query(array(
                    'post_type' => 'event',
                    'posts_per_page' => 6,
                    'meta_key' => '_event_date',
                    'orderby' => 'meta_value',
                    'order' => 'ASC',
                ));
                
                if ($events_query->have_posts()) :
                    while ($events_query->have_posts()) : $events_query->the_post();
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                        $event_venue = get_post_meta(get_the_ID(), '_event_venue', true);
                        $event_fee = get_post_meta(get_the_ID(), '_event_fee', true);
                ?>
                    <div class="event-item fade-in">
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
                    <div class="event-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-event.jpg" alt="Sample Event">
                        <div class="event-details">
                            <h3>Sample Event</h3>
                            <p>Details about events will be added soon. Stay tuned for exciting competitions and performances!</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 2rem;">
                <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn">View All Events</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="content-section" style="background: white;">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="society-info">
                <p><strong>Maulana Azad Medical College</strong></p>
                <p>2, Bahadur Shah Zafar Marg, New Delhi - 110002</p>
                <p>Email: synapse@mamc.edu.in</p>
                <p>Phone: +91-11-23231496</p>
                <p>Follow us on social media for updates and announcements!</p>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
