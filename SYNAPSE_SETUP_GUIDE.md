# Synapse MAMC 2026 - Complete Setup Guide

This guide will help you set up and configure the Synapse MAMC 2026 website.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Installation](#installation)
3. [Theme Activation](#theme-activation)
4. [Initial Configuration](#initial-configuration)
5. [Adding Content](#adding-content)
6. [Payment Integration](#payment-integration)
7. [Admin Dashboard Usage](#admin-dashboard-usage)
8. [Troubleshooting](#troubleshooting)

## Prerequisites

- Web server with PHP 7.2.24 or higher
- MySQL 5.5.5 or higher (MySQL 8.0+ recommended)
- WordPress 5.0 or higher installed
- FTP/SFTP access or file manager access

## Installation

### Step 1: WordPress Installation

If WordPress is not yet installed:

1. Upload WordPress files to your web server
2. Create a MySQL database
3. Visit your domain in a browser
4. Follow the WordPress installation wizard
5. Complete the installation with your details

### Step 2: Theme Installation

The Synapse MAMC theme is already in place at:
```
/wp-content/themes/synapse-mamc/
```

## Theme Activation

1. Log in to WordPress Admin (yoursite.com/wp-admin)
2. Go to **Appearance > Themes**
3. Find "Synapse MAMC 2026" theme
4. Click **Activate**
5. Go to **Settings > Permalinks**
6. Select "Post name" as your permalink structure
7. Click **Save Changes** (this is crucial for custom post types)

## Initial Configuration

### 1. Create Navigation Menu

1. Go to **Appearance > Menus**
2. Create a new menu called "Primary Menu"
3. Add pages/links:
   - Home
   - Societies
   - Events
   - About
   - Contact
4. Assign to "Primary Menu" location
5. Save menu

### 2. Configure Site Identity

1. Go to **Appearance > Customize**
2. Click **Site Identity**
3. Add site title: "Synapse 2026"
4. Add tagline: "MAMC Annual Festival"
5. Upload a logo (optional)
6. Publish changes

### 3. Set Homepage

1. Go to **Settings > Reading**
2. Select "Your homepage displays" > "A static page"
3. Choose "Home" for Homepage (or create a new page)
4. Save changes

## Adding Content

### Adding Societies

1. Go to **Societies > Add New**
2. Enter society details:
   - **Title**: Name of the society (e.g., "Cultural Society")
   - **Content**: Detailed description of the society
   - **Featured Image**: Upload society logo or image
3. Click **Publish**

**Sample Societies to Add:**
- Cultural Society
- Medical Society
- Sports Society
- Literary Society
- Arts Society
- Music Society
- Dance Society

### Adding Events

1. Go to **Events > Add New**
2. Fill in event information:
   - **Title**: Event name (e.g., "Medical Quiz Competition")
   - **Content**: Detailed event description
   - **Featured Image**: Event poster or relevant image
3. Scroll to "Event Details" meta box:
   - **Event Date**: Select date
   - **Event Time**: Set time
   - **Venue**: Enter location
   - **Registration Fee**: Enter amount (₹)
   - **Society**: Select organizing society
   - **Max Participants**: Set limit (optional)
4. Click **Publish**

**Sample Events to Add:**
- Medical Quiz
- Dance Competition
- Music Concert
- Drama Performance
- Sports Tournament
- Art Exhibition
- Cultural Night
- Case Presentation
- Research Symposium

### Example Event Data

```
Title: Medical Quiz Competition 2026
Date: March 15, 2026
Time: 10:00 AM
Venue: Lecture Hall 1, MAMC
Fee: ₹200
Society: Medical Society
Max Participants: 50
Description: Test your medical knowledge in this exciting quiz competition...
```

## About Synapse (MAMC) - Content to Add

Based on internet information about Synapse MAMC, here's content to include:

### Homepage Content

**About Synapse:**
Synapse is the annual cultural and medical festival of Maulana Azad Medical College (MAMC), one of India's most prestigious medical institutions. The festival brings together students from medical colleges across the nation for a celebration of talent, knowledge, and creativity.

**About MAMC:**
- Established: 1958
- Location: 2, Bahadur Shah Zafar Marg, New Delhi - 110002
- Affiliation: University of Delhi
- Recognition: Premier medical college known for excellence in medical education and research
- Courses: MBBS, MD, MS, DM, MCh, and various super-specialty programs

**Festival Highlights:**
- Cultural performances (dance, music, drama)
- Medical competitions (quiz, case presentations, paper presentations)
- Sports events
- Workshops and seminars
- Guest lectures by renowned medical professionals
- Inter-college competitions
- Celebrity performances
- Social initiatives

**Previous Year Statistics (Example):**
- 50+ participating colleges
- 100+ events
- 5000+ participants
- 3-day festival

## Payment Integration

### Razorpay Integration (Recommended for India)

1. Create a Razorpay account at https://razorpay.com
2. Get your API keys from Dashboard
3. Install Razorpay WordPress plugin:
   ```
   Plugins > Add New > Search "Razorpay"
   ```
4. Configure with your API keys
5. Modify theme functions to integrate payment

**Add to functions.php:**
```php
// Add payment gateway integration
function synapse_process_payment($registration_id) {
    // Add Razorpay payment processing code
    // Update payment status after successful payment
}
```

### Alternative Payment Gateways
- PayPal
- Stripe
- Paytm
- Instamojo

## Admin Dashboard Usage

### Accessing Society Dashboard

1. Log in to WordPress Admin
2. Click **Society Dashboard** in the left menu
3. Select society from dropdown
4. View statistics and registrations

### Dashboard Features

**Statistics:**
- Total Events
- Total Registrations
- Total Revenue
- Pending Payments

**Managing Events:**
- View all events for selected society
- Edit event details
- View registrations per event

**Managing Registrations:**
- View participant details
- Track payment status
- Export data (future feature)

### Viewing Registrations

1. From Society Dashboard, click "View Registrations" for any event
2. See list of participants with:
   - Name, Email, Phone
   - College
   - Registration date
   - Payment status
3. Click "View" to see full details
4. Update payment status if needed

## User Roles

### Administrator
- Full access to all features
- Can manage all societies and events
- Access to all registrations

### Society Coordinator (Custom Role - Future)
- Access to specific society dashboard
- Manage events for their society
- View registrations for their events

## Troubleshooting

### Issue: Custom post types not showing

**Solution:**
1. Go to Settings > Permalinks
2. Click "Save Changes" without changing anything
3. This flushes the rewrite rules

### Issue: 404 error on society/event pages

**Solution:**
- Same as above - flush permalinks

### Issue: Registration form not submitting

**Solution:**
1. Check if jQuery is loaded (View > Developer Tools > Console)
2. Verify AJAX URL is correct
3. Check nonce validation

### Issue: Payment not processing

**Solution:**
1. Verify payment gateway credentials
2. Check if payment gateway plugin is activated
3. Review error logs in wp-content/debug.log

### Issue: Images not showing

**Solution:**
1. Add placeholder images to /wp-content/themes/synapse-mamc/images/
2. Upload featured images for societies and events
3. Check file permissions

## Security Best Practices

1. **Keep WordPress Updated**: Always update to latest version
2. **Use Strong Passwords**: For all admin accounts
3. **Install Security Plugin**: WordFence or Sucuri
4. **Enable SSL**: Use HTTPS for secure transactions
5. **Backup Regularly**: Use UpdraftPlus or similar plugins
6. **Limit Login Attempts**: Install login limiter plugin
7. **Hide WordPress Version**: Add to functions.php

## Performance Optimization

1. **Caching Plugin**: Install WP Super Cache or W3 Total Cache
2. **Image Optimization**: Use Smush or ShortPixel
3. **CDN**: Consider using Cloudflare
4. **Database Optimization**: Use WP-Optimize plugin
5. **Minify CSS/JS**: Use Autoptimize plugin

## Mobile Responsiveness

The theme is mobile-responsive by default. Test on:
- iPhone (Safari)
- Android (Chrome)
- iPad (Safari)
- Desktop browsers (Chrome, Firefox, Edge)

## SEO Configuration

1. Install Yoast SEO or Rank Math plugin
2. Configure meta titles and descriptions
3. Set up XML sitemap
4. Add Google Analytics
5. Submit sitemap to Google Search Console

## Social Media Integration

Add social media links:
1. Footer has placeholder links
2. Update footer.php with actual social media URLs
3. Consider adding social sharing buttons to events

## Contact Information

Update contact details in footer.php:
```php
<p>Maulana Azad Medical College<br>
2, Bahadur Shah Zafar Marg<br>
New Delhi - 110002<br>
Email: synapse@mamc.edu.in<br>
Phone: +91-11-23231496</p>
```

## Email Configuration

For registration confirmations:
1. Install WP Mail SMTP plugin
2. Configure with Gmail/SMTP details
3. Send test email to verify

## Next Steps

1. ✅ Activate theme
2. ✅ Configure permalinks
3. ✅ Add societies (5-10 societies)
4. ✅ Add events (20-30 events)
5. ✅ Upload images for all content
6. ✅ Test registration process
7. ✅ Set up payment gateway
8. ✅ Configure email notifications
9. ✅ Test on mobile devices
10. ✅ Launch website

## Support Resources

- WordPress Documentation: https://wordpress.org/documentation/
- MAMC Official Website: https://mamc.edu.in/
- Theme Documentation: See README.md in theme folder
- Support Email: synapse@mamc.edu.in

## Conclusion

Your Synapse MAMC 2026 website is now ready! The theme provides all necessary features for managing the festival, including:

✅ Information display about Synapse and MAMC
✅ Society pages with individual profiles
✅ Event pages with registration forms
✅ Payment tracking system
✅ Admin dashboard for society management
✅ Participant management
✅ Mobile-responsive design
✅ Modern, professional appearance

For any questions or customization needs, refer to this guide or contact the development team.

**Good luck with Synapse 2026! 🎉**
