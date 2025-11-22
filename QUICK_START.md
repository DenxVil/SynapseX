# Synapse MAMC 2026 - Quick Start Guide

Get your Synapse website up and running in 15 minutes!

## Prerequisites ✅

- WordPress installed on your server
- Admin access to WordPress dashboard
- Internet connection

## Installation Steps (5 minutes)

### Step 1: Activate Theme
```
1. Login to WordPress Admin (yoursite.com/wp-admin)
2. Go to: Appearance > Themes
3. Find "Synapse MAMC 2026"
4. Click "Activate"
```

### Step 2: Configure Permalinks (REQUIRED)
```
1. Go to: Settings > Permalinks
2. Select: "Post name"
3. Click: "Save Changes"
```
⚠️ **This step is CRUCIAL for societies and events to work!**

### Step 3: Create Menu
```
1. Go to: Appearance > Menus
2. Create new menu: "Primary Menu"
3. Add custom links:
   - Home → /
   - Societies → /societies
   - Events → /events
4. Assign to "Primary Menu" location
5. Save menu
```

## Add Sample Content (10 minutes)

### Quick Add Societies

Go to **Societies > Add New** and create these:

**1. Cultural Society**
```
Title: Kalakriti - Cultural Society
Content: Promoting performing arts through dance, music, and drama at MAMC.
```

**2. Medical Society**
```
Title: Medicus - Medical Society
Content: Enhancing medical knowledge through quizzes, symposiums, and workshops.
```

**3. Sports Society**
```
Title: Athletix - Sports Society
Content: Managing all sports activities and promoting physical fitness.
```

**4. Literary Society**
```
Title: Literati - Literary Society
Content: Nurturing literary talents through debates, writing, and creative expression.
```

**5. Arts Society**
```
Title: Artistica - Arts Society
Content: Showcasing visual arts through paintings, photography, and exhibitions.
```

### Quick Add Events

Go to **Events > Add New** and create these sample events:

**Event 1: Medical Quiz**
```
Title: MedQuest - Medical Quiz Competition
Content: Test your medical knowledge in this intense quiz competition.
Date: March 14, 2026
Time: 09:00 AM
Venue: Conference Hall
Fee: 200
Society: Medical Society
Max Participants: 40
```

**Event 2: Dance Competition**
```
Title: Nritya Sangam - Classical Dance
Content: Showcase your mastery in classical dance forms.
Date: March 14, 2026
Time: 10:00 AM
Venue: Main Auditorium
Fee: 300
Society: Cultural Society
Max Participants: 30
```

**Event 3: Football Tournament**
```
Title: Football Championship
Content: 5-a-side football tournament with professional referees.
Date: March 14, 2026
Time: 08:00 AM
Venue: Football Ground
Fee: 700
Society: Sports Society
Max Participants: 16
```

**Event 4: Debate Competition**
```
Title: Parliamentary Debate
Content: Oxford-style parliamentary debate on contemporary issues.
Date: March 14, 2026
Time: 02:00 PM
Venue: Debate Hall
Fee: 150
Society: Literary Society
Max Participants: 16
```

**Event 5: Painting Contest**
```
Title: Canvas - Painting Competition
Content: Create your masterpiece on the spot!
Date: March 15, 2026
Time: 09:00 AM
Venue: Art Room
Fee: 200
Society: Arts Society
Max Participants: 50
```

## Test Your Website ✨

### 1. View Homepage
Visit: `yoursite.com`

You should see:
- ✅ Hero section with Synapse info
- ✅ About Synapse section
- ✅ Societies grid (5 societies)
- ✅ Events list (5 events)
- ✅ Contact section

### 2. Test Society Pages
Click on any society → Should show:
- ✅ Society information
- ✅ Events by that society
- ✅ Registration buttons

### 3. Test Event Pages
Click on any event → Should show:
- ✅ Event details (date, time, venue, fee)
- ✅ Event description
- ✅ Registration form
- ✅ Spots remaining

### 4. Test Registration
Fill the form and submit:
- ✅ Success message appears
- ✅ Form resets after submission

### 5. Test Admin Dashboard
```
1. Go to WordPress Admin
2. Click: "Society Dashboard"
3. Select a society from dropdown
4. View statistics and events
```

## Customize Your Site 🎨

### Change Colors
Edit: `wp-content/themes/synapse-mamc/style.css`
```css
:root {
    --primary-color: #673DE6;  /* Change this */
    --secondary-color: #FF6B6B; /* Change this */
    --accent-color: #4ECDC4;    /* Change this */
}
```

### Update Contact Info
Edit: `wp-content/themes/synapse-mamc/footer.php`
- Update address, email, phone
- Update social media links

### Add Logo
```
1. Go to: Appearance > Customize
2. Click: Site Identity
3. Upload your logo
4. Publish changes
```

## Next Steps 🚀

### Essential Tasks
- [ ] Add featured images to societies and events
- [ ] Write detailed content about Synapse
- [ ] Add more events (aim for 20-30 events)
- [ ] Test registration on mobile devices
- [ ] Set up email notifications

### Optional Enhancements
- [ ] Install security plugin (Wordfence)
- [ ] Install caching plugin (WP Super Cache)
- [ ] Set up payment gateway (Razorpay/PayPal)
- [ ] Install SEO plugin (Yoast SEO)
- [ ] Add Google Analytics
- [ ] Connect social media accounts
- [ ] Create email templates

### Payment Integration
To accept payments:
```
1. Choose gateway: Razorpay (India) or PayPal/Stripe
2. Install plugin: Plugins > Add New
3. Configure with API keys
4. Test with sample payment
5. Update functions.php to integrate
```

## Troubleshooting 🔧

### Problem: "Page not found" on societies/events
**Solution:**
```
Go to: Settings > Permalinks
Click: "Save Changes" (don't change anything)
```

### Problem: Theme not showing in list
**Solution:**
```
Check theme files are in:
/wp-content/themes/synapse-mamc/
Verify style.css exists with theme header
```

### Problem: Registration form not working
**Solution:**
```
1. Check browser console for errors (F12)
2. Verify jQuery is loaded
3. Clear browser cache
4. Check if AJAX URL is correct
```

### Problem: Images not displaying
**Solution:**
```
1. Upload default images to theme/images/
2. Add featured images to societies/events
3. Check file permissions (755 for folders, 644 for files)
```

## Support Resources 📚

- **Full Documentation:** Read `SYNAPSE_SETUP_GUIDE.md`
- **Sample Content:** Read `SAMPLE_CONTENT.md`
- **Theme Documentation:** Read `wp-content/themes/synapse-mamc/README.md`

## Success Checklist ✅

After completing this guide, you should have:

- ✅ Active Synapse MAMC theme
- ✅ Working permalinks
- ✅ 5 societies created
- ✅ 5 events created
- ✅ Navigation menu set up
- ✅ Registration forms working
- ✅ Admin dashboard accessible
- ✅ Mobile-responsive design

## What You Built 🎉

Your website now has:

1. **Homepage** with complete Synapse information
2. **Society Pages** showing each society's profile
3. **Event Pages** with online registration
4. **Admin Dashboard** for managing everything
5. **Registration System** with payment tracking
6. **Responsive Design** works on all devices
7. **Modern UI** with professional look

## Time to Launch! 🚀

You're ready to:
- Promote your website on social media
- Accept registrations
- Manage participants
- Track payments
- Organize Synapse 2026!

**Need Help?**
- Review full documentation
- Check WordPress forums
- Contact: synapse@mamc.edu.in

---

## Quick Commands Reference

### Add Society (WP-CLI)
```bash
wp post create --post_type=society --post_title="Society Name" --post_content="Description" --post_status=publish
```

### Add Event (WP-CLI)
```bash
wp post create --post_type=event --post_title="Event Name" --post_content="Description" --post_status=publish
```

### Flush Rewrite Rules (WP-CLI)
```bash
wp rewrite flush
```

### Check Theme Status (WP-CLI)
```bash
wp theme list
wp theme activate synapse-mamc
```

---

**Congratulations! Your Synapse MAMC 2026 website is ready! 🎊**

For detailed instructions, refer to `SYNAPSE_SETUP_GUIDE.md`
For content ideas, refer to `SAMPLE_CONTENT.md`
