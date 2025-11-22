# Synapse MAMC 2026 Theme

A custom WordPress theme for Synapse - the Annual Cultural & Medical Festival of Maulana Azad Medical College (MAMC).

## Features

### Core Functionality
- **Custom Post Types**: Societies, Events, and Registrations
- **Dynamic Homepage**: Showcases festival information, societies, and upcoming events
- **Society Pages**: Individual pages for each MAMC society with their events
- **Event Pages**: Detailed event information with online registration forms
- **Admin Dashboard**: Society-specific dashboard for managing events and participants
- **Registration System**: Online event registration with participant management
- **Payment Tracking**: Monitor payment status for all registrations

### Design Features
- Modern, responsive design
- Gradient color scheme with purple/blue theme
- Mobile-friendly navigation
- Smooth scroll animations
- Card-based layout for content
- Professional typography

### Custom Post Types

#### 1. Societies
Represents different societies/groups within MAMC (Cultural, Medical, Sports, etc.)
- **Fields**: Title, Description, Featured Image
- **Archive**: `/societies`
- **Single**: `/societies/[society-name]`

#### 2. Events
Individual events and competitions organized by societies
- **Fields**: 
  - Title, Description, Featured Image
  - Event Date, Time, Venue
  - Registration Fee
  - Associated Society
  - Maximum Participants
- **Archive**: `/events`
- **Single**: `/events/[event-name]`

#### 3. Registrations
Participant registrations for events
- **Fields**:
  - Participant Name, Email, Phone
  - College/Institution
  - Associated Event
  - Registration Date
  - Payment Status (Pending/Completed)
- **Admin Only**: Visible only in WordPress admin

## Installation

1. Upload the `synapse-mamc` folder to `/wp-content/themes/`
2. Activate the theme through WordPress admin
3. Navigate to Settings > Permalinks and click "Save Changes" to flush rewrite rules
4. Create your first Society from the admin panel
5. Add Events and associate them with societies

## Admin Dashboard

The theme includes a custom Society Dashboard accessible via:
- WordPress Admin > Society Dashboard

Features:
- View statistics (events, registrations, revenue)
- Manage events for each society
- View participant registrations
- Track payment status
- Export data

## Shortcodes

### Event Registration Form
```
[event_registration_form event_id="123"]
```
Display a registration form for a specific event.

## Theme Structure

```
synapse-mamc/
├── css/
│   └── custom.css          # Additional custom styles
├── js/
│   └── main.js            # JavaScript functionality
├── templates/
│   └── admin-dashboard.php # Admin dashboard template
├── inc/                   # Additional PHP includes (future use)
├── images/                # Theme images
├── style.css              # Main stylesheet
├── functions.php          # Theme functions and setup
├── index.php              # Main homepage template
├── header.php             # Header template
├── footer.php             # Footer template
├── single-society.php     # Single society template
├── single-event.php       # Single event template
├── archive-society.php    # Societies archive
├── archive-event.php      # Events archive
└── README.md             # This file
```

## Customization

### Colors
Edit the CSS variables in `style.css`:
```css
:root {
    --primary-color: #673DE6;
    --secondary-color: #FF6B6B;
    --accent-color: #4ECDC4;
}
```

### Adding New Societies
1. Go to WordPress Admin > Societies > Add New
2. Add society name, description, and featured image
3. Publish

### Creating Events
1. Go to WordPress Admin > Events > Add New
2. Fill in event details
3. Select associated society
4. Set registration fee and max participants
5. Publish

## AJAX Registration

The theme uses AJAX for seamless event registration without page reloads.

## Payment Integration

The theme tracks payment status for registrations. To integrate with a payment gateway:

1. Modify `functions.php` to add payment gateway hooks
2. Update the AJAX handler to process payments
3. Add payment gateway credentials in WordPress settings

Recommended gateways:
- Razorpay (India)
- PayPal
- Stripe

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Credits

**Theme Developer**: MAMC Web Team
**Version**: 1.0.0
**License**: GPL v2 or later

## Support

For theme support and customization:
- Email: synapse@mamc.edu.in
- Website: https://synapsemamc.com

## Changelog

### Version 1.0.0
- Initial release
- Custom post types for Societies, Events, and Registrations
- Admin dashboard for society management
- Event registration system
- Responsive design
- AJAX form submissions
