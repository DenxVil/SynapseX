<?php
/**
 * Template for displaying single event
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); 
    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
    $event_time = get_post_meta(get_the_ID(), '_event_time', true);
    $event_venue = get_post_meta(get_the_ID(), '_event_venue', true);
    $event_fee = get_post_meta(get_the_ID(), '_event_fee', true);
    $event_society_id = get_post_meta(get_the_ID(), '_event_society', true);
    $max_participants = get_post_meta(get_the_ID(), '_max_participants', true);
    
    // Count current registrations
    $registrations = new WP_Query(array(
        'post_type' => 'registration',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_event_id',
                'value' => get_the_ID(),
                'compare' => '='
            )
        )
    ));
    $registered_count = $registrations->found_posts;
    $spots_left = $max_participants ? ($max_participants - $registered_count) : 'Unlimited';
?>

<main class="site-main">
    <section class="society-header">
        <div class="container">
            <h1><?php the_title(); ?></h1>
            <?php if ($event_society_id) : 
                $society = get_post($event_society_id);
            ?>
                <p>Organized by <?php echo esc_html($society->post_title); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <div class="grid" style="grid-template-columns: 2fr 1fr;">
                <div class="society-info">
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: 2rem;">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h2>Event Details</h2>
                    <?php the_content(); ?>
                </div>

                <div>
                    <div class="card" style="position: sticky; top: 100px;">
                        <h3>Event Information</h3>
                        <?php if ($event_date) : ?>
                            <p><strong>📅 Date:</strong><br><?php echo date('F j, Y', strtotime($event_date)); ?></p>
                        <?php endif; ?>
                        <?php if ($event_time) : ?>
                            <p><strong>🕐 Time:</strong><br><?php echo date('g:i A', strtotime($event_time)); ?></p>
                        <?php endif; ?>
                        <?php if ($event_venue) : ?>
                            <p><strong>📍 Venue:</strong><br><?php echo esc_html($event_venue); ?></p>
                        <?php endif; ?>
                        <?php if ($event_fee) : ?>
                            <p><strong>💰 Fee:</strong><br>₹<?php echo esc_html($event_fee); ?></p>
                        <?php else : ?>
                            <p><strong>💰 Fee:</strong><br>Free</p>
                        <?php endif; ?>
                        <?php if ($max_participants) : ?>
                            <p><strong>👥 Spots Left:</strong><br><?php echo esc_html($spots_left); ?></p>
                        <?php endif; ?>
                        
                        <?php if (is_numeric($spots_left) && $spots_left <= 0) : ?>
                            <p style="color: red; font-weight: bold;">Registration Full</p>
                        <?php else : ?>
                            <a href="#register" class="btn" style="display: block; text-align: center; margin-top: 1rem;">Register Now</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!is_numeric($spots_left) || $spots_left > 0) : ?>
    <section id="register" class="content-section" style="background: white;">
        <div class="container">
            <div class="society-info">
                <h2>Register for <?php the_title(); ?></h2>
                <form id="event-registration-form" class="registration-form">
                    <input type="hidden" name="event_id" value="<?php echo get_the_ID(); ?>">
                    
                    <div class="form-group">
                        <label for="participant_name">Full Name *</label>
                        <input type="text" id="participant_name" name="participant_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="participant_email">Email Address *</label>
                        <input type="email" id="participant_email" name="participant_email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="participant_phone">Phone Number *</label>
                        <input type="tel" id="participant_phone" name="participant_phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="participant_college">College/Institution *</label>
                        <input type="text" id="participant_college" name="participant_college" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn">Submit Registration</button>
                    </div>
                    
                    <div id="form-message" style="margin-top: 1rem;"></div>
                </form>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php endwhile; ?>

<?php get_footer(); ?>
