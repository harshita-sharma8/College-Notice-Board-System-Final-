# College Notice Board System

An interactive, full-stack web application designed to digitize, organize, and streamline the distribution of official announcements, circulars, and notices for educational institutions.

---

## 📌 Project Overview

The **College Notice Board System** connects college administration with students in real time. It features a dual-interface architecture:
1. **Public Landing Page (`welcome.php`):** A public-facing portal where students and visitors can browse published notices filtered by department and year without logging in.
2. **Admin Dashboard (`admin_dashboard.php`):** A secure portal where authorized staff can perform complete CRUD operations on notices.
3. **Student Dashboard (`index.php`):** A secure portal where students can see latest notices via category.
---

## ✨ Key Features

* **Real-Time Notice Stream:** Asynchronous updates using JavaScript `fetch` API.
* **Full CRUD Operations:**
  * **Create:** Add new notices with titles, detailed content, and categories.
  * **Read:** View organized listings of active notices.
  * **Update:** Pre-fill and edit existing notice details directly from the dashboard.
  * **Delete:** Remove outdated or incorrect notices instantly.
* **RESTful JSON API Endpoint:** Decoupled backend architecture serving data via `api/get_notices.php`.
* **Responsive UI:** Clean and modern interface built using Tailwind CSS / Custom CSS.
* **User Navigation:** Easy cross-navigation including back-links from the login page to the public board.

---

## 🛠️ Tech Stack

* **Front-End:** HTML5, CSS3 / Tailwind CSS, JavaScript (ES6+, Fetch API)
* **Back-End:** Object-Oriented PHP (OOP)
* **Database:** MySQL
* **Local Server Environment:** XAMPP 

---

## 📁 Directory Structure
```text
task4/
├── api/
│   └── get_notices.php        # JSON API Endpoint for Async Requests
├── classes/
│   ├── CategoryNotice.php     # Extended Class for Category Logic
│   ├── Notice.php             # Core Base Class for Notice CRUD
│   └── Notification.php       # Class for Student Notification Tracking
├── config/
│   └── Database.php           # PDO Database Connection
├── security/
│   ├── login.php              # Login page for Admin and Student Portal
│   ├── logout.php             # Logout handler and session destruction
│   └── register.php           # Registration page for Student Portal
├── admin_dashboard.php        # Administrative Control Panel (Notice CRUD)
├── index.php                  # Student Portal & Dynamic Notice View
├── noticeboard.sql     # Complete database schema (`users` & `notices`)
├── welcome.php          #Website main landing page 
└── README.md                  # Project Documentation
