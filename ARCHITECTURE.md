# Synapse MAMC 2026 - System Architecture

## 📊 Architecture Overview

This document explains how all components of the Synapse website work together.

## 🏗️ System Components

```
┌─────────────────────────────────────────────────────────────┐
│                     SYNAPSE MAMC WEBSITE                     │
│                    (WordPress Platform)                      │
└─────────────────────────────────────────────────────────────┘
                              │
                              │
        ┌─────────────────────┴─────────────────────┐
        │                                           │
        ▼                                           ▼
┌───────────────┐                          ┌───────────────┐
│   FRONTEND    │                          │    BACKEND    │
│   (Users)     │                          │   (Admin)     │
└───────────────┘                          └───────────────┘
        │                                           │
        │                                           │
        ▼                                           ▼
```

## 🎯 Frontend Flow (User Journey)

```
Homepage (index.php)
    │
    ├─► About Synapse Section
    │   └─► MAMC Information
    │
    ├─► Societies Section
    │   │
    │   ├─► Cultural Society ──► Society Page (single-society.php)
    │   ├─► Medical Society       │
    │   ├─► Sports Society        ├─► Society Events List
    │   ├─► Literary Society      └─► Event Registration Links
    │   └─► Arts Society
    │
    ├─► Events Section
    │   │
    │   ├─► Event 1 ──► Event Page (single-event.php)
    │   ├─► Event 2       │
    │   ├─► Event 3       ├─► Event Details
    │   └─► Event 4       │   (Date, Time, Venue, Fee)
    │                     │
    │                     └─► Registration Form
    │                         │
    │                         └─► AJAX Submission
    │                             │
    │                             ├─► Validation
    │                             ├─► Save to Database
    │                             ├─► Send Confirmation
    │                             └─► Payment Redirect
    │
    └─► Contact Section
```

## 🔄 Registration Process Flow

```
User Visits Event Page
        │
        ▼
Views Event Details
        │
        ▼
Fills Registration Form
    • Name
    • Email
    • Phone
    • College
        │
        ▼
Clicks Submit
        │
        ▼
JavaScript Validation
        │
        ├─► Invalid ──► Show Errors
        │                    │
        │                    └─► User Corrects
        │
        ▼ Valid
AJAX Request to Server
        │
        ▼
PHP Processing (functions.php)
    • Verify Nonce
    • Sanitize Data
    • Check Capacity
        │
        ├─► Error ──► Return Error Message
        │
        ▼ Success
Create Registration Post
    • Save participant info
    • Link to event
    • Set payment status: pending
        │
        ▼
Return Success Response
        │
        ▼
Show Success Message
        │
        ▼
[Optional] Redirect to Payment
        │
        ▼
Payment Gateway
        │
        ├─► Success ──► Update status: completed
        │
        └─► Failed ──► Update status: failed
```

## 🎛️ Admin Dashboard Flow

```
Admin Logs In
        │
        ▼
Clicks "Society Dashboard"
        │
        ▼
Dashboard Page (admin-dashboard.php)
        │
        ├─► Select Society
        │   │
        │   └─► Load Society Data
        │       │
        │       ├─► Count Events
        │       ├─► Count Registrations
        │       ├─► Calculate Revenue
        │       └─► Calculate Pending Payments
        │
        ├─► View Events List
        │   │
        │   └─► For Each Event:
        │       • Show event details
        │       • Show registration count
        │       • Edit event link
        │       • View registrations link
        │
        └─► View Registrations
            │
            └─► For Each Registration:
                • Participant details
                • Event name
                • Registration date
                • Payment status
                • Action buttons
```

## 🗄️ Database Structure

### Custom Post Types

```
┌──────────────────────────────────────────────────┐
│                   SOCIETIES                      │
├──────────────────────────────────────────────────┤
│ ID | Title | Content | Featured_Image | Status  │
│ 1  | Cultural | Desc... | image.jpg | publish  │
│ 2  | Medical  | Desc... | image.jpg | publish  │
│ 3  | Sports   | Desc... | image.jpg | publish  │
└──────────────────────────────────────────────────┘
                    │
                    │ Referenced by
                    ▼
┌──────────────────────────────────────────────────┐
│                    EVENTS                        │
├──────────────────────────────────────────────────┤
│ ID | Title | Content | Featured_Image | Status  │
│ 1  | Quiz  | Desc... | poster.jpg | publish    │
│ 2  | Dance | Desc... | poster.jpg | publish    │
├──────────────────────────────────────────────────┤
│              Event Meta Data                     │
├──────────────────────────────────────────────────┤
│ _event_date        | 2026-03-14                 │
│ _event_time        | 10:00:00                   │
│ _event_venue       | Main Auditorium            │
│ _event_fee         | 300                        │
│ _event_society     | 1 (Society ID)             │
│ _max_participants  | 50                         │
└──────────────────────────────────────────────────┘
                    │
                    │ Referenced by
                    ▼
┌──────────────────────────────────────────────────┐
│                REGISTRATIONS                     │
├──────────────────────────────────────────────────┤
│ ID | Title (Name-Event) | Status                │
│ 1  | John-Quiz | publish                        │
│ 2  | Sarah-Dance | publish                      │
├──────────────────────────────────────────────────┤
│           Registration Meta Data                 │
├──────────────────────────────────────────────────┤
│ _event_id           | 1 (Event ID)              │
│ _participant_name   | John Doe                  │
│ _participant_email  | john@email.com            │
│ _participant_phone  | 9876543210                │
│ _participant_college| ABC Medical College       │
│ _registration_date  | 2026-01-15 10:30:00       │
│ _payment_status     | pending/completed         │
└──────────────────────────────────────────────────┘
```

## 📁 File Organization

```
synapse-mamc/
│
├── 🎨 STYLING
│   ├── style.css           (Main theme styles + CSS variables)
│   └── css/custom.css      (Additional styles, animations)
│
├── 💻 FUNCTIONALITY
│   ├── functions.php       (Custom post types, AJAX handlers)
│   └── js/main.js         (AJAX forms, animations, interactions)
│
├── 📄 TEMPLATES
│   ├── index.php          (Homepage - shows all info)
│   ├── header.php         (Site header + navigation)
│   ├── footer.php         (Site footer + contact)
│   ├── single-society.php (Individual society page)
│   ├── single-event.php   (Individual event page + form)
│   ├── archive-society.php(All societies listing)
│   ├── archive-event.php  (All events listing)
│   └── templates/
│       └── admin-dashboard.php (Admin interface)
│
└── 📚 DOCUMENTATION
    ├── README.md          (Theme documentation)
    └── images/           (Theme images)
```

## 🔐 Security Layers

```
User Input
    │
    ▼
JavaScript Validation
    • Required fields
    • Email format
    • Phone format
    │
    ▼
AJAX Request
    • Nonce included
    │
    ▼
Server-Side Validation
    • Verify nonce
    • Check capabilities
    • Sanitize inputs
    • Validate data types
    │
    ▼
Database Operations
    • Prepared statements
    • Escaped queries
    │
    ▼
Response
    • Safe output
    • No sensitive data exposed
```

## 🔌 Integration Points

### Payment Gateway Integration

```
Registration Completed
        │
        ▼
Payment Status: Pending
        │
        ▼
[Payment Gateway Plugin]
        │
        ├─► Razorpay (India)
        ├─► PayPal (International)
        ├─► Stripe (International)
        └─► Paytm (India)
        │
        ▼
Payment Callback
        │
        ├─► Success
        │   └─► Update: payment_status = completed
        │
        └─► Failed
            └─► Update: payment_status = failed
```

### Email Notification Flow

```
Registration Created
        │
        ▼
WordPress Email System
        │
        ├─► To Participant
        │   • Registration confirmation
        │   • Event details
        │   • Payment link
        │
        └─► To Admin/Society
            • New registration alert
            • Participant details
```

## 📊 Data Flow Diagram

```
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│   VISITOR   │────────▶│   THEME     │────────▶│  DATABASE   │
│   (Browser) │         │   (PHP)     │         │  (MySQL)    │
└─────────────┘         └─────────────┘         └─────────────┘
       │                       │                        │
       │ 1. Request Page       │                        │
       │──────────────────────▶│                        │
       │                       │ 2. Query Data          │
       │                       │───────────────────────▶│
       │                       │ 3. Return Results      │
       │                       │◀───────────────────────│
       │ 4. Render HTML        │                        │
       │◀──────────────────────│                        │
       │ 5. Submit Form (AJAX) │                        │
       │──────────────────────▶│                        │
       │                       │ 6. Process & Save      │
       │                       │───────────────────────▶│
       │                       │ 7. Confirm             │
       │                       │◀───────────────────────│
       │ 8. Show Success       │                        │
       │◀──────────────────────│                        │
```

## 🎯 Key Components Interaction

```
┌──────────────────────────────────────────────────────┐
│                   WORDPRESS CORE                     │
└──────────────────────────────────────────────────────┘
                        │
        ┌───────────────┼───────────────┐
        │               │               │
        ▼               ▼               ▼
┌─────────────┐  ┌─────────────┐  ┌─────────────┐
│   THEME     │  │   PLUGINS   │  │  DATABASE   │
│  Synapse    │  │  (Future)   │  │   MySQL     │
└─────────────┘  └─────────────┘  └─────────────┘
        │               │               │
        └───────────────┼───────────────┘
                        │
        ┌───────────────┼───────────────┐
        │               │               │
        ▼               ▼               ▼
┌─────────────┐  ┌─────────────┐  ┌─────────────┐
│  Societies  │  │   Events    │  │Registration │
│  Post Type  │  │  Post Type  │  │  Post Type  │
└─────────────┘  └─────────────┘  └─────────────┘
```

## 🚀 Request Lifecycle

### 1. Homepage Request

```
User → WordPress → Theme → index.php
                            │
                            ├─► Get Societies (WP_Query)
                            ├─► Get Events (WP_Query)
                            ├─► Render HTML
                            └─► Return to User
```

### 2. Event Page Request

```
User → WordPress → Theme → single-event.php
                            │
                            ├─► Get Event Data
                            ├─► Get Event Meta
                            ├─► Count Registrations
                            ├─► Calculate Spots Left
                            ├─► Render Event Details
                            ├─► Render Registration Form
                            └─► Return to User
```

### 3. AJAX Registration

```
User → JavaScript → AJAX → WordPress → functions.php
                                        │
                                        ├─► Verify Nonce
                                        ├─► Sanitize Data
                                        ├─► Create Post
                                        ├─► Save Meta
                                        └─► Return JSON
                                                │
User ◀── JavaScript ◀── Response ◀──────────────┘
```

## 💡 Performance Considerations

```
┌─────────────────────────────────────────────────┐
│              OPTIMIZATION LAYERS                │
├─────────────────────────────────────────────────┤
│ 1. Browser Cache (Static files)                │
│ 2. WordPress Object Cache                      │
│ 3. Database Query Cache                        │
│ 4. CDN (Future: Images, CSS, JS)              │
│ 5. Lazy Loading (Images)                       │
│ 6. Minified CSS/JS (Future)                    │
└─────────────────────────────────────────────────┘
```

## 🔍 Monitoring & Analytics

```
┌──────────────────────────────────────────┐
│         TRACKING POINTS                  │
├──────────────────────────────────────────┤
│ • Page Views (Homepage, Events)         │
│ • Registration Submissions              │
│ • Payment Completions                   │
│ • Society Dashboard Access              │
│ • Form Abandonment Rate                 │
│ • Popular Events                        │
│ • Mobile vs Desktop Usage               │
└──────────────────────────────────────────┘
```

## 🎓 Learning Resources

To understand this system better:

1. **WordPress Basics**
   - Custom Post Types
   - Custom Fields
   - Template Hierarchy
   - The Loop

2. **AJAX in WordPress**
   - wp_ajax hooks
   - Nonce verification
   - JSON responses

3. **Theme Development**
   - Template files
   - Theme functions
   - Enqueuing scripts

4. **Security**
   - Input sanitization
   - Output escaping
   - Capability checks

## 📝 Summary

The Synapse MAMC 2026 website is built as a **custom WordPress theme** that:

1. ✅ Displays comprehensive festival information
2. ✅ Manages multiple societies and their events
3. ✅ Handles online registrations via AJAX
4. ✅ Tracks payments and participants
5. ✅ Provides admin dashboard for management
6. ✅ Works seamlessly on all devices
7. ✅ Follows WordPress best practices
8. ✅ Maintains security standards

**Architecture Type:** Monolithic WordPress Theme
**Design Pattern:** MVC (Model-View-Controller) via WordPress
**Frontend:** PHP Templates + JavaScript (AJAX)
**Backend:** WordPress Core + Custom Functions
**Database:** MySQL (via WordPress API)

---

**For more details, see:**
- Technical: `wp-content/themes/synapse-mamc/README.md`
- Setup: `SYNAPSE_SETUP_GUIDE.md`
- Quick Start: `QUICK_START.md`
