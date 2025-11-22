<?php
/**
 * Admin Dashboard Template for Society Management
 */

if (!current_user_can('edit_posts')) {
    wp_die(__('You do not have permission to access this page.'));
}

// Get all societies
$societies = get_posts(array(
    'post_type' => 'society',
    'posts_per_page' => -1,
));

// Get selected society (default to first if not set)
$selected_society = isset($_GET['society_id']) ? intval($_GET['society_id']) : ($societies ? $societies[0]->ID : 0);

// Get statistics for selected society
$society_events = new WP_Query(array(
    'post_type' => 'event',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => '_event_society',
            'value' => $selected_society,
            'compare' => '='
        )
    )
));

$total_events = $society_events->found_posts;

// Get all registrations for society events
$all_registrations = new WP_Query(array(
    'post_type' => 'registration',
    'posts_per_page' => -1,
));

$society_registrations = 0;
$total_revenue = 0;
$pending_payments = 0;

while ($all_registrations->have_posts()) {
    $all_registrations->the_post();
    $event_id = get_post_meta(get_the_ID(), '_event_id', true);
    $event_society = get_post_meta($event_id, '_event_society', true);
    
    if ($event_society == $selected_society) {
        $society_registrations++;
        $event_fee = get_post_meta($event_id, '_event_fee', true);
        $payment_status = get_post_meta(get_the_ID(), '_payment_status', true);
        
        if ($payment_status === 'completed') {
            $total_revenue += floatval($event_fee);
        } else {
            $pending_payments += floatval($event_fee);
        }
    }
}
wp_reset_postdata();

?>

<div class="wrap">
    <h1><?php _e('Society Dashboard', 'synapse-mamc'); ?></h1>
    
    <div class="dashboard">
        <div class="dashboard-header">
            <h2><?php _e('Dashboard Overview', 'synapse-mamc'); ?></h2>
            <div>
                <label for="society-select"><?php _e('Select Society:', 'synapse-mamc'); ?></label>
                <select id="society-select" onchange="window.location.href='?page=society-dashboard&society_id=' + this.value">
                    <?php foreach ($societies as $society) : ?>
                        <option value="<?php echo $society->ID; ?>" <?php selected($selected_society, $society->ID); ?>>
                            <?php echo esc_html($society->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <h4><?php echo $total_events; ?></h4>
                <p><?php _e('Total Events', 'synapse-mamc'); ?></p>
            </div>
            <div class="stat-card">
                <h4><?php echo $society_registrations; ?></h4>
                <p><?php _e('Registrations', 'synapse-mamc'); ?></p>
            </div>
            <div class="stat-card">
                <h4>₹<?php echo number_format($total_revenue, 2); ?></h4>
                <p><?php _e('Total Revenue', 'synapse-mamc'); ?></p>
            </div>
            <div class="stat-card">
                <h4>₹<?php echo number_format($pending_payments, 2); ?></h4>
                <p><?php _e('Pending Payments', 'synapse-mamc'); ?></p>
            </div>
        </div>
        
        <h3><?php _e('Society Events', 'synapse-mamc'); ?></h3>
        <table class="data-table wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('Event Name', 'synapse-mamc'); ?></th>
                    <th><?php _e('Date', 'synapse-mamc'); ?></th>
                    <th><?php _e('Registrations', 'synapse-mamc'); ?></th>
                    <th><?php _e('Fee', 'synapse-mamc'); ?></th>
                    <th><?php _e('Actions', 'synapse-mamc'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $society_events->rewind_posts();
                while ($society_events->have_posts()) : $society_events->the_post();
                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                    $event_fee = get_post_meta(get_the_ID(), '_event_fee', true);
                    
                    // Count registrations for this event
                    $event_registrations = new WP_Query(array(
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
                    $reg_count = $event_registrations->found_posts;
                ?>
                    <tr>
                        <td><strong><?php the_title(); ?></strong></td>
                        <td><?php echo $event_date ? date('F j, Y', strtotime($event_date)) : 'N/A'; ?></td>
                        <td><?php echo $reg_count; ?></td>
                        <td>₹<?php echo $event_fee ? number_format($event_fee, 2) : '0.00'; ?></td>
                        <td>
                            <a href="<?php echo admin_url('post.php?post=' . get_the_ID() . '&action=edit'); ?>" class="button">Edit</a>
                            <a href="?page=society-dashboard&society_id=<?php echo $selected_society; ?>&event_id=<?php echo get_the_ID(); ?>" class="button">View Registrations</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <?php
        // If event_id is set, show registrations for that event
        if (isset($_GET['event_id'])) {
            $event_id = intval($_GET['event_id']);
            $event = get_post($event_id);
            ?>
            <h3 style="margin-top: 2rem;"><?php _e('Registrations for', 'synapse-mamc'); ?>: <?php echo esc_html($event->post_title); ?></h3>
            <table class="data-table wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('Participant Name', 'synapse-mamc'); ?></th>
                        <th><?php _e('Email', 'synapse-mamc'); ?></th>
                        <th><?php _e('Phone', 'synapse-mamc'); ?></th>
                        <th><?php _e('College', 'synapse-mamc'); ?></th>
                        <th><?php _e('Registration Date', 'synapse-mamc'); ?></th>
                        <th><?php _e('Payment Status', 'synapse-mamc'); ?></th>
                        <th><?php _e('Actions', 'synapse-mamc'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $event_regs = new WP_Query(array(
                        'post_type' => 'registration',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => '_event_id',
                                'value' => $event_id,
                                'compare' => '='
                            )
                        )
                    ));
                    
                    if ($event_regs->have_posts()) :
                        while ($event_regs->have_posts()) : $event_regs->the_post();
                            $participant_name = get_post_meta(get_the_ID(), '_participant_name', true);
                            $participant_email = get_post_meta(get_the_ID(), '_participant_email', true);
                            $participant_phone = get_post_meta(get_the_ID(), '_participant_phone', true);
                            $participant_college = get_post_meta(get_the_ID(), '_participant_college', true);
                            $registration_date = get_post_meta(get_the_ID(), '_registration_date', true);
                            $payment_status = get_post_meta(get_the_ID(), '_payment_status', true);
                    ?>
                        <tr>
                            <td><?php echo esc_html($participant_name); ?></td>
                            <td><?php echo esc_html($participant_email); ?></td>
                            <td><?php echo esc_html($participant_phone); ?></td>
                            <td><?php echo esc_html($participant_college); ?></td>
                            <td><?php echo date('F j, Y', strtotime($registration_date)); ?></td>
                            <td>
                                <span style="color: <?php echo $payment_status === 'completed' ? 'green' : 'orange'; ?>;">
                                    <?php echo ucfirst($payment_status); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo admin_url('post.php?post=' . get_the_ID() . '&action=edit'); ?>" class="button">View</a>
                            </td>
                        </tr>
                    <?php
                        endwhile;
                    else :
                    ?>
                        <tr>
                            <td colspan="7"><?php _e('No registrations yet.', 'synapse-mamc'); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php
            wp_reset_postdata();
        }
        ?>
        
        <div style="margin-top: 2rem;">
            <a href="<?php echo admin_url('post-new.php?post_type=event'); ?>" class="button button-primary"><?php _e('Add New Event', 'synapse-mamc'); ?></a>
            <a href="<?php echo admin_url('edit.php?post_type=registration'); ?>" class="button"><?php _e('View All Registrations', 'synapse-mamc'); ?></a>
        </div>
    </div>
</div>

<style>
.dashboard {
    background: white;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #673DE6;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
}

.stat-card h4 {
    font-size: 2rem;
    margin: 0 0 10px 0;
}

.stat-card p {
    margin: 0;
    font-size: 0.9rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.data-table th,
.data-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.data-table th {
    background: #673DE6;
    color: white;
    font-weight: 600;
}

.data-table tr:hover {
    background: #f8f9fa;
}

#society-select {
    padding: 5px 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
}
</style>
