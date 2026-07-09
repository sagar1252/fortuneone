# Fortune One Ecosystem 🏢

A comprehensive, enterprise-grade architecture housing the Fortune One Corporate Website, the Fortune One CRM, an AI-powered conversational bot, and a highly advanced Google Analytics 4 (GA4) Executive Dashboard.

This repository serves as a monorepo for the complete Fortune One digital infrastructure, built on **CodeIgniter 4 (PHP)**, enhanced with **Tailwind CSS**, **Vanilla JavaScript**, and **Chart.js**.

---

## 🏗 System Architecture & Workflows

### 1. Fortune One Website (Public Facing)
The public-facing corporate website is designed to convert visitors and showcase the brand.
- **Routing & Views:** Managed through CodeIgniter 4 controllers (e.g., `app/Controllers/Website`).
- **Dynamic Content:** Partials (like the hero slider, navigation, and footers) are componentized in `app/Views/Website/Partials/` for high reusability.
- **Section Tracking:** A custom, vanilla JS IntersectionObserver tracker (`section-tracker.js`) monitors exactly how long users linger on specific website sections (e.g., `#hero`, `#process`) and fires custom GA4 events (`section_engagement`) for deep behavioral analytics.

### 2. Fortune One CRM (Internal Platform)
The backbone of operations, providing administrative tools and client management.
- **Backend:** CodeIgniter 4 MVC pattern handling secure routing, database interactions, and API endpoints (`app/Controllers/FortuneOneCRM/`).
- **Security:** Session-based authentication and secure directory structures. 

### 3. AI Bot & Integrations
- **AI Synthesis Engine:** The CRM features automated AI insights (e.g., "AI Automated Fact & Analytical Brief") that synthesize raw data into readable executive summaries.
- **Node.js/API Hooks:** Test and integration layers (`test_node.js`, `test_api.php`) allow for seamless server-to-server communication with external AI providers and tracking microservices.

### 4. Executive GA4 Analytics Dashboard (Core Feature)
A premium, highly interactive dashboard built to visualize Google Analytics 4 (GA4) metrics directly within the CRM, without needing to log into the Google Cloud Console.

**Backend Flow (`AdminController.php`):**
- Authenticates securely via `credentials.json` with the Google Analytics Data API (Beta).
- Dispatches complex `RunReportRequest` queries to pull:
  - Global metrics (Users, Views, Retention, Bounce Rate).
  - Geographic Heatmaps (Top Countries & Cities).
  - Hardware & Device Category Share.
  - Granular Page Matrices (Time-on-page, Exit rates).
  - Custom Inbound Referrals (Google, Facebook, Instagram, LinkedIn, ChatGPT/AI).

**Frontend Flow (`dashboard.php`):**
- **UI/UX:** Built with a dark-mode glassmorphism aesthetic using Tailwind CSS.
- **Visualization:** Utilizes Chart.js for real-time, responsive rendering of Traffic Chronologies, Doughnut Charts, and Polar Area Acquisition matrices.
- **Interactivity:** Features dynamic date filtering (Today, 7-Day, 30-Day, Custom) that re-fetches GA4 data seamlessly.
- **PDF Export:** Integrated with `html2pdf.js` to allow executives to instantly download pixel-perfect A3 landscape reports of the active dashboard state.

---

## 🚀 Setup & Installation

### Prerequisites
- PHP 7.4+ (or 8.x) & Composer
- XAMPP / MAMP or any local Apache/Nginx server
- Node.js (Optional, for running specific microservices/trackers)

### 1. Environment Configuration
- Clone the repository into your local web server environment (e.g., `c:\xampp\htdocs\fortune`).
- Copy `env` to `.env` and configure your CodeIgniter `app.baseURL` and database credentials.
- Run `composer install` to fetch dependencies (including `google/apiclient`).

### 2. Google Analytics API (GA4) Setup
- Navigate to the Google Cloud Console and enable the **Google Analytics Data API**.
- Create a Service Account and download the JSON key.
- Save this key to `public/assets/credentials.json`.
- Give the Service Account email `Viewer` access in your GA4 Property settings.
- Update your GA4 `Property ID` in `AdminController.php`.

### 3. Launch
- Start your Apache server.
- Navigate to `http://localhost/fortune/public/` to view the main website.
- Navigate to `http://localhost/fortune/public/admin/analytics` to view the GA4 Executive Dashboard.

---

## 🔒 Security Notes
- Sensitive directories (like `node_modules`, `vendor`, and `.env`) are ignored via `.gitignore`.
- The `credentials.json` key is strictly excluded from version control to protect Google Cloud billing and access. 

---
*Fortune One Ecosystem — Engineered for Growth, Insights, and Automation.*
