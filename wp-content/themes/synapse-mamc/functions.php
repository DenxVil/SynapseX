<?php
/**
 * Synapse MAMC 2026 Theme Functions
 */

// Theme Setup
function synapse_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'synapse-mamc'),
        'footer' => __('Footer Menu', 'synapse-mamc'),
    ));
}
add_action('after_setup_theme', 'synapse_theme_setup');

// Enqueue styles and scripts
function synapse_enqueue_scripts() {
    wp_enqueue_style('synapse-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('synapse-custom', get_template_directory_uri() . '/css/custom.css', array(), '1.0.0');
    wp_enqueue_script('synapse-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('synapse-script', 'synapseAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('synapse_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'synapse_enqueue_scripts');

// Register Custom Post Type: Societies
function synapse_register_societies_cpt() {
    $labels = array(
        'name'                  => _x('Societies', 'Post Type General Name', 'synapse-mamc'),
        'singular_name'         => _x('Society', 'Post Type Singular Name', 'synapse-mamc'),
        'menu_name'             => __('Societies', 'synapse-mamc'),
        'all_items'             => __('All Societies', 'synapse-mamc'),
        'add_new_item'          => __('Add New Society', 'synapse-mamc'),
        'add_new'               => __('Add New', 'synapse-mamc'),
        'edit_item'             => __('Edit Society', 'synapse-mamc'),
        'update_item'           => __('Update Society', 'synapse-mamc'),
        'view_item'             => __('View Society', 'synapse-mamc'),
        'search_items'          => __('Search Society', 'synapse-mamc'),
    );
    
    $args = array(
        'label'                 => __('Society', 'synapse-mamc'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'societies'),
        'capability_type'       => 'post',
    );
    
    register_post_type('society', $args);
}
add_action('init', 'synapse_register_societies_cpt', 0);

// Register Custom Post Type: Events
function synapse_register_events_cpt() {
    $labels = array(
        'name'                  => _x('Events', 'Post Type General Name', 'synapse-mamc'),
        'singular_name'         => _x('Event', 'Post Type Singular Name', 'synapse-mamc'),
        'menu_name'             => __('Events', 'synapse-mamc'),
        'all_items'             => __('All Events', 'synapse-mamc'),
        'add_new_item'          => __('Add New Event', 'synapse-mamc'),
        'add_new'               => __('Add New', 'synapse-mamc'),
        'edit_item'             => __('Edit Event', 'synapse-mamc'),
        'update_item'           => __('Update Event', 'synapse-mamc'),
        'view_item'             => __('View Event', 'synapse-mamc'),
        'search_items'          => __('Search Event', 'synapse-mamc'),
    );
    
    $args = array(
        'label'                 => __('Event', 'synapse-mamc'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'events'),
        'capability_type'       => 'post',
    );
    
    register_post_type('event', $args);
}
add_action('init', 'synapse_register_events_cpt', 0);

// Register Custom Post Type: Registrations
function synapse_register_registrations_cpt() {
    $labels = array(
        'name'                  => _x('Registrations', 'Post Type General Name', 'synapse-mamc'),
        'singular_name'         => _x('Registration', 'Post Type Singular Name', 'synapse-mamc'),
        'menu_name'             => __('Registrations', 'synapse-mamc'),
        'all_items'             => __('All Registrations', 'synapse-mamc'),
        'view_item'             => __('View Registration', 'synapse-mamc'),
        'search_items'          => __('Search Registration', 'synapse-mamc'),
    );
    
    $args = array(
        'label'                 => __('Registration', 'synapse-mamc'),
        'labels'                => $labels,
        'supports'              => array('title', 'custom-fields'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-clipboard',
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'capabilities'          => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap'          => true,
    );
    
    register_post_type('registration', $args);
}
add_action('init', 'synapse_register_registrations_cpt', 0);

// Add custom meta boxes for events
function synapse_add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        __('Event Details', 'synapse-mamc'),
        'synapse_event_details_callback',
        'event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'synapse_add_event_meta_boxes');

function synapse_event_details_callback($post) {
    wp_nonce_field('synapse_event_meta_box', 'synapse_event_meta_box_nonce');
    
    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_venue = get_post_meta($post->ID, '_event_venue', true);
    $event_fee = get_post_meta($post->ID, '_event_fee', true);
    $event_society = get_post_meta($post->ID, '_event_society', true);
    $max_participants = get_post_meta($post->ID, '_max_participants', true);
    
    ?>
    <p>
        <label for="event_date"><?php _e('Event Date:', 'synapse-mamc'); ?></label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="event_time"><?php _e('Event Time:', 'synapse-mamc'); ?></label><br>
        <input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="event_venue"><?php _e('Venue:', 'synapse-mamc'); ?></label><br>
        <input type="text" id="event_venue" name="event_venue" value="<?php echo esc_attr($event_venue); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="event_fee"><?php _e('Registration Fee (₹):', 'synapse-mamc'); ?></label><br>
        <input type="number" id="event_fee" name="event_fee" value="<?php echo esc_attr($event_fee); ?>" style="width: 100%;" min="0">
    </p>
    <p>
        <label for="event_society"><?php _e('Society:', 'synapse-mamc'); ?></label><br>
        <select id="event_society" name="event_society" style="width: 100%;">
            <option value="">Select Society</option>
            <?php
            $societies = get_posts(array('post_type' => 'society', 'posts_per_page' => -1));
            foreach ($societies as $society) {
                $selected = ($event_society == $society->ID) ? 'selected' : '';
                echo '<option value="' . $society->ID . '" ' . $selected . '>' . $society->post_title . '</option>';
            }
            ?>
        </select>
    </p>
    <p>
        <label for="max_participants"><?php _e('Max Participants:', 'synapse-mamc'); ?></label><br>
        <input type="number" id="max_participants" name="max_participants" value="<?php echo esc_attr($max_participants); ?>" style="width: 100%;" min="1">
    </p>
    <?php
}

// Save event meta box data
function synapse_save_event_meta_box_data($post_id) {
    if (!isset($_POST['synapse_event_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['synapse_event_meta_box_nonce'], 'synapse_event_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('event_date', 'event_time', 'event_venue', 'event_fee', 'event_society', 'max_participants');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'synapse_save_event_meta_box_data');

// AJAX handler for event registration
function synapse_handle_event_registration() {
    check_ajax_referer('synapse_nonce', 'nonce');
    
    $event_id = intval($_POST['event_id']);
    $participant_name = sanitize_text_field($_POST['participant_name']);
    $participant_email = sanitize_email($_POST['participant_email']);
    $participant_phone = sanitize_text_field($_POST['participant_phone']);
    $participant_college = sanitize_text_field($_POST['participant_college']);
    
    // Create registration post
    $registration_data = array(
        'post_title'    => $participant_name . ' - ' . get_the_title($event_id),
        'post_status'   => 'publish',
        'post_type'     => 'registration',
    );
    
    $registration_id = wp_insert_post($registration_data);
    
    if ($registration_id) {
        // Save registration meta data
        update_post_meta($registration_id, '_event_id', $event_id);
        update_post_meta($registration_id, '_participant_name', $participant_name);
        update_post_meta($registration_id, '_participant_email', $participant_email);
        update_post_meta($registration_id, '_participant_phone', $participant_phone);
        update_post_meta($registration_id, '_participant_college', $participant_college);
        update_post_meta($registration_id, '_registration_date', current_time('mysql'));
        update_post_meta($registration_id, '_payment_status', 'pending');
        
        wp_send_json_success(array(
            'message' => 'Registration successful! Payment link will be sent to your email.',
            'registration_id' => $registration_id
        ));
    } else {
        wp_send_json_error(array('message' => 'Registration failed. Please try again.'));
    }
}
add_action('wp_ajax_event_registration', 'synapse_handle_event_registration');
add_action('wp_ajax_nopriv_event_registration', 'synapse_handle_event_registration');

// Add admin menu for society dashboard
function synapse_add_admin_menu() {
    add_menu_page(
        'Society Dashboard',
        'Society Dashboard',
        'edit_posts',
        'society-dashboard',
        'synapse_society_dashboard_page',
        'dashicons-chart-line',
        3
    );
}
add_action('admin_menu', 'synapse_add_admin_menu');

function synapse_society_dashboard_page() {
    include get_template_directory() . '/templates/admin-dashboard.php';
}

// Widget areas
function synapse_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'synapse-mamc'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'synapse-mamc'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'synapse-mamc'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'synapse-mamc'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'synapse_widgets_init');

// Custom shortcode for event registration form
function synapse_event_registration_form($atts) {
    $atts = shortcode_atts(array(
        'event_id' => get_the_ID(),
    ), $atts);
    
    ob_start();
    include get_template_directory() . '/templates/registration-form.php';
    return ob_get_clean();
}
add_shortcode('event_registration_form', 'synapse_event_registration_form');
