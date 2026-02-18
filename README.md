# Census App – Ejigbo Local Government Lagos

A secure, mobile-ready PHP & MySQL census management system for ward-level population data collection in Ejigbo, Oshodi-Isolo LGA, Lagos.

The application is designed for **field operators using mobile devices** to capture validated census records with GPS location and accuracy data. Administrators access centralized dashboards with metrics and interactive demographic visualizations for planning and decision support.

Built with **Core PHP, MySQL, Bootstrap, and Chart.js**.

##  Project Overview

This system supports real-time census data collection in the field using smartphones and tablets. It focuses on:

* Mobile usability
* Accurate geolocation capture
* Secure data submission
* Role-based access control
* Visual demographic analytics

It demonstrates backend security practices, structured validation, prepared SQL statements, session control, and real-time statistical visualization.

---

##  Mobile Field Data Collection

The application is optimized for **mobile device usage** by field operators:

* Responsive Bootstrap interface
* Works on smartphones and tablets
* Designed for on-site household registration
* Uses browser geolocation API
* Captures:

  * Latitude
  * Longitude
  * GPS accuracy (meters)
* Accuracy checks enforced before submission
* Location verification flags stored in database

Mobile GPS capture improves reliability and helps validate where each census record was collected.

##  User Roles & Access Control

### Administrator

* Create field oprators  
* View all census records
* Access global dashboards and charts
* View full demographic summaries
* System-wide metrics

### Field Operator

* Register census records in the field
* Capture GPS location data
* View only their submitted records
* View personal census summaries
* Restricted from global admin data

---

## Features

* Secure authentication & session management
* Role-based access control (Admin / Operator)
* CSRF-protected form submission
* Route guarding
* Strong server-side validation
* Duplicate record detection
* Mobile GPS geolocation capture
* GPS accuracy validation threshold
* Ward-based classification
* Operator-specific summaries
* Admin global dashboard
* MySQL relational schema with foreign keys
* Responsive Bootstrap UI
* Interactive demographic charts using Chart.js

### 📊 Demographic Visualizations

* Gender distribution (pie chart)
* Age group distribution (bar chart)
* Occupation distribution
* Disability status chart
* Ward population distribution

This project demonstrates:

* Secure multi-role system design
* Mobile field data collection workflows
* GPS-based record verification
* Data validation architecture
* Dashboard analytics
* Chart-based demographic visualization
* Framework-free backend engineering (Core PHP)
