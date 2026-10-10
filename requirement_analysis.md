# Requirements Analysis: Glowup Beauty Studio & Academy

This document provides a comprehensive, requirement-by-requirement audit and comparison between the specification document **`GlowUp_Admin_Customer_Requirements.docx`** and the existing **CodeIgniter 4** codebase (`glowupbeauty_studio`).

---

## 1. Executive Summary

| Category | Total Specifications | Fully Implemented | Partially Implemented | Missing / Not Built |
| :--- | :---: | :---: | :---: | :---: |
| **Customer Website Features** | 7 | 5 | 2 | 0 |
| **Admin Panel Features** | 9 | 5 | 3 | 1 |
| **System Rules & Workflows** | 6 | 4 | 2 | 0 |
| **Overall Project Alignment** | **22** | **14 (64%)** | **7 (32%)** | **1 (4%)** |

### Key Strengths of Current Codebase:
1. **Robust CI4 MVC Foundation**: Built on CodeIgniter 4 with standard namespaces, models, database migrations, clean architecture, and CSRF protection.
2. **Customer Authentication & CRM Integration**: Fully implemented customer registration, session login, Google OAuth fallback, and 360° customer profile management in the admin dashboard (`CustomerController` & `CustomerModel`).
3. **Billing & Invoicing Engine**: Advanced tax invoice generation, balance tracking, line items (`invoice_items`), payment logging (`payments`), printable invoice rendering (`admin/pages/invoice_view` and `glowup/invoice_view`), and customer receipt downloads.
4. **Monthly Offers Logic**: Full offer scheduling with start/end date validation, automatic frontend filtering (`getActiveFrontendOffers()`), coupon codes, and percentage/fixed discount types.
5. **WhatsApp Pre-Filled Direct Contact**: Standardized helper functions (`business_whatsapp_url()`, `clean_whatsapp_number()`) integrated in the navbar, services cards, floating dock, and booking folio.

### Critical Gaps & Areas Requiring Attention:
1. **Excel/CSV Customer Export**: Not implemented in `Admin\CustomerController`. (Requirement 3.3).
2. **Category Selection Step in Booking Flow**: Requirement states that clicking "Book Now" should show all service categories in one clear place first, allowing the customer to pick a category and then choose a service. The current `/booking` page immediately displays all services in a flat list without a category-first grouping or filter.
3. **Dynamic Slot Management by Admin**: The admin can view and filter bookings by date/slot, but slot times (`10:00 AM`, `11:00 AM`, etc.) are hard-coded in views (`booking.php`, `booking_modal.php`) rather than being managed dynamically through an admin slot availability table.
4. **Automated WhatsApp Booking Reminders**: Manual 1-click WhatsApp reminders via `https://wa.me/` and API dispatch via `MarketingController` exist, but automated pre-appointment triggers (cron/scheduled job, configured timing window, and template customization) are not wired up into an automatic background scheduler.
5. **Meta (Instagram & Facebook) Publishing**: Integration settings and credentials exist in `IntegrationController`, but direct feed publishing and website feed display require Meta App review/permissions or an approved manual fallback workflow.

---

## 2. Requirement-by-Requirement Analysis

### 2.1 Customer Website Features

---

#### REQ-C1: Customer Registration and Login
- **Specification**: Customers can create an account, log in securely, and view their own booking details.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `CustomerAuthController::showRegister()` & `register()`: Full customer registration with password hashing (`PASSWORD_DEFAULT`), input validation (`is_unique[customers.email]`), and flash message feedbacks.
  - `CustomerAuthController::showLogin()` & `login()`: Multi-credential login (supports email or mobile phone), return URL redirection, and secure session handling.
  - `CustomerAuthController::googleLogin()` & `googleCallback()`: Google OAuth 2.0 integration for seamless login.
  - `Home::profile()`: Customer portal displaying personal dossier, active sanctuary pass, booking counts, and total spend.
- **Affected Files**:
  - `app/Controllers/CustomerAuthController.php`
  - `app/Libraries/CustomerAuth.php`
  - `app/Models/CustomerModel.php`
  - `app/Views/glowup/user_register.php`
  - `app/Views/glowup/user_login.php`
  - `app/Views/glowup/profile.php`
- **Gaps / Bugs**: None. Working as intended.
- **Risks**: None.

---

#### REQ-C2: View All Services
- **Specification**: Show all available beauty services with service name, description, price, duration, and image where available.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Home::services()` queries `ServiceModel::getFilteredServices(null, null, '1', 100, 0)` fetching active services with names, categories, prices, durations, descriptions, and images.
  - Dynamic Category mapping via `CategoryModel::getCategoryMap()`.
  - Frontend view (`services.php`) displays category filter pills, responsive card grid, image placeholders with fallback handlers, price badge, duration badge, and direct WhatsApp / "Book Now" buttons.
- **Affected Files**:
  - `app/Controllers/Home.php`
  - `app/Models/ServiceModel.php`
  - `app/Views/glowup/services.php`
- **Gaps / Bugs**: None.
- **Risks**: Low.

---

#### REQ-C3: Book a Service
- **Specification**: Customers can select a service, choose an available date and time slot, enter the required details, and submit a booking.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - Multi-step interactive booking wizard (`/booking`) and universal modal popup (`#glowupBookingModal`).
  - Step 1: Service selection with auto-preselection via URL query param (`?service=...`).
  - Step 2: Date picker (with past date protection) & time slot pills (`10:00 AM`, `11:00 AM`, etc.).
  - Step 3: Customer contact details (pre-fills logged-in customer info automatically).
  - Backend validation in `Home::submitBooking()` checks service existence, active status, past dates, time slots, and creates/links CRM customer records automatically.
- **Affected Files**:
  - `app/Controllers/Home.php`
  - `app/Views/glowup/booking.php`
  - `app/Views/glowup/partials/booking_modal.php`
  - `public/js/main.js`
- **Gaps / Bugs**: None in core booking flow.
- **Risks**: Time slots are statically listed in the frontend view rather than fetched dynamically from admin-managed slots (see REQ-A5).

---

#### REQ-C4: Booking Categories (Category-First Flow)
- **Specification**: When a customer clicks “Book Now”, show all service categories in one clear place. The customer can select a category and then choose a service.
- **Current Status**: **Partially Implemented**
- **Existing Implementation**:
  - In `services.php`, category filter buttons exist at the top (`All Rituals`, `Aesthetic Facials`, `Hair Alchemy`, etc.) which filter service cards via JavaScript.
  - However, on the dedicated `/booking` page, Step 1 displays all services in a flat 2-column card list without category groupings or category tabs.
  - The universal booking modal (`booking_modal.php`) also displays a flat service list without category filtering.
- **Affected Files**:
  - `app/Controllers/Home.php` (line 183)
  - `app/Views/glowup/booking.php` (line 233)
  - `app/Views/glowup/partials/booking_modal.php` (line 61)
- **Gaps / Bugs**:
  - Clicking "Book Now" in navbar/hero links directly to `/booking` where categories are not presented first.
  - Needs Category cards/pills on Step 1 of the booking wizard so customers select a category first, filtering or revealing the corresponding services.
- **Risks**: Low; requires passing categories into `Home::booking()` and updating Step 1 markup and JS filter in `booking.php` and `booking_modal.php`.

---

#### REQ-C5: Offers and Promotions
- **Specification**: Display current offers on the website. Admins should be able to create offers, set start and end dates, and show offers for the relevant month. Expired offers should not appear as active.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `OfferModel::getActiveFrontendOffers()` automatically queries `is_active = 1 AND start_date <= CURDATE() AND end_date >= CURDATE()`, ensuring expired offers never appear.
  - Active offers strip rendered dynamically on Homepage (`glowup/index.php`) and Services page (`glowup/services.php`).
  - Offers include title, discount type (percentage vs flat ₹), coupon code, and a "Claim" button directing to booking.
- **Affected Files**:
  - `app/Models/OfferModel.php`
  - `app/Controllers/Home.php`
  - `app/Views/glowup/index.php`
  - `app/Views/glowup/services.php`
- **Gaps / Bugs**: None.
- **Risks**: Low.

---

#### REQ-C6: WhatsApp Direct Contact
- **Specification**: Provide a WhatsApp button so customers can message the studio directly. Use the configured studio WhatsApp number and a helpful pre-filled message.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Common.php` defines `business_whatsapp()` and `business_whatsapp_url($message, $number)` with strict international phone number cleaning (`clean_whatsapp_number()`).
  - Pre-filled WhatsApp button present in:
    1. Fixed Navigation Bar (`navbar.php`)
    2. Floating Mobile & Desktop Dock (`floating_contact.php`)
    3. Individual Service Cards on Services page (`services.php`)
    4. Post-booking confirmation modal with reference number (`booking.php`)
    5. Footer Concierge section (`footer.php`)
- **Affected Files**:
  - `app/Common.php`
  - `app/Views/glowup/partials/navbar.php`
  - `app/Views/glowup/partials/floating_contact.php`
  - `app/Views/glowup/booking.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-C7: Customer Booking History
- **Specification**: Customers can view their upcoming bookings and previous bookings after logging in.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - Authenticated customer portal at `/profile` (`Home::profile()`).
  - Dedicated "My Bookings" tab displaying upcoming, pending, and confirmed appointments with booking codes, dates, times, and prices.
  - Dedicated "Service History" tab displaying completed treatments with option to submit a patron review.
  - Direct WhatsApp concierge query link for each booking item.
- **Affected Files**:
  - `app/Controllers/Home.php`
  - `app/Views/glowup/profile.php`
  - `app/Models/CustomerModel.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

### 2.2 Admin Panel Features

---

#### REQ-A1: Create and Manage Invoices
- **Specification**: Admin can create an invoice for a customer, add the booked service and charges, record payment status, and download or print the invoice.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Admin\InvoiceController`: Complete CRUD for invoices.
  - Automatic invoice generation upon completing an appointment (`BookingController::completeService()`).
  - Manual invoice builder with multi-item breakdown (`invoice_items`), custom discount types, and 18% GST calculation.
  - Payment tracking via `recordPayment()` and instant `markPaid()` with receipts generated in `payments` table.
  - Print/Save PDF support via `window.print()` formatted stylesheet in `admin/pages/invoice_view.php`.
  - Customer viewable and printable version in `glowup/invoice_view.php` accessible from patron profile.
- **Affected Files**:
  - `app/Controllers/Admin/InvoiceController.php`
  - `app/Models/InvoiceModel.php`
  - `app/Models/InvoiceItemModel.php`
  - `app/Models/PaymentModel.php`
  - `app/Views/admin/pages/invoices.php`
  - `app/Views/admin/pages/invoice_view.php`
  - `app/Views/glowup/invoice_view.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-A2: Manage Customers
- **Specification**: Admin can view customer details and booking history. Only authorised admins should be able to access customer information.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - Route protection: Enforced via `adminAuth` filter on `admin/*` route group.
  - `Admin\CustomerController::index()`: Customer directory with search, status filtering, and pagination.
  - `Admin\CustomerController::viewProfile($id)`: Full 360° Patron CRM dossier showing customer contact info, booking history, lifetime spend, invoices, notes, and preferences.
  - Adding confidential staff notes (`addNote()`) and CRM tags (`updateCrm()`).
- **Affected Files**:
  - `app/Config/Routes.php`
  - `app/Controllers/Admin/CustomerController.php`
  - `app/Views/admin/pages/website_customer.php`
  - `app/Views/admin/pages/customer_profile.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-A3: Export Customer Data to Excel
- **Specification**: Admin can export customer records to an Excel-compatible file (.xlsx or .csv). Include only necessary fields and protect the download with admin permissions.
- **Current Status**: **Missing / Not Built**
- **Existing Implementation**:
  - In `Admin\CustomerController`, methods exist for `index`, `details`, `save`, `toggleStatus`, `delete`, `viewProfile`, `addNote`, and `updateCrm`.
  - There is NO export method (e.g. `exportExcel()` or `exportCsv()`) in `CustomerController`.
  - In `website_customer.php`, the header toolbar only has an "Add Customer" button and lacks an "Export" action button.
- **Affected Files**:
  - `app/Controllers/Admin/CustomerController.php`
  - `app/Config/Routes.php`
  - `app/Views/admin/pages/website_customer.php`
- **Gaps / Bugs**:
  - Missing route `$routes->get('website/customer/export', 'Admin\CustomerController::export');`.
  - Missing controller action to stream standard `.csv` or `.xlsx` containing sanitized fields (ID, Name, Email, Phone, Status, Created Date, Lifetime Spend).
  - Missing "Export to Excel/CSV" button in admin customer view.
- **Risks**: Medium (Must ensure password hashes and internal tokens are excluded from export).

---

#### REQ-A4: Manage Services and Categories
- **Specification**: Admin can add, edit, activate/deactivate, and update service categories, service details, prices, and duration.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Admin\ServiceController::save()`: Add and edit treatment services with name, category, price, duration, image upload (`uploads/services`), and sorting.
  - `Admin\ServiceController::toggleStatus()`: Toggle active/inactive.
  - `Admin\ServiceController::toggleFeatured()`: Toggle featured status.
  - `Admin\ServiceController::saveCategory()`: Add and edit categories with auto-slug generation and automatic slug synchronization across existing services.
  - `Admin\ServiceController::deleteCategory()`: Safely checks for linked services and prevents deletion if rituals are assigned.
- **Affected Files**:
  - `app/Controllers/Admin/ServiceController.php`
  - `app/Models/ServiceModel.php`
  - `app/Models/CategoryModel.php`
  - `app/Views/admin/pages/website_services.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-A5: Manage Booking Slots
- **Specification**: Admin can set available dates and time slots, manage staff availability if applicable, and prevent double-booking of the same slot.
- **Current Status**: **Partially Implemented**
- **Existing Implementation**:
  - Double-booking prevention exists in `Home::submitBooking()`: Checks for matching `booking_date`, `time_slot`, and `specialist` with `status IN ('pending', 'confirmed')`.
  - In `Admin\BookingController`, admin can view appointments by date (`today`, `upcoming`, `past`) and update dates/slots during edit.
- **Gaps / Bugs**:
  - There is no dynamic "Booking Slot" management UI where an admin can configure open days, working hours, slot intervals (e.g. 30/60 mins), blocked holidays, or active slot times.
  - Slot times are hard-coded in HTML views (`10:00 AM`, `11:00 AM`, `12:30 PM`, `02:00 PM`, `03:30 PM`, `05:00 PM`, `06:30 PM`, `07:30 PM`).
  - If a slot is booked by one customer, the frontend slot pills still show the slot as selectable until form submission, rather than visually disabling already-booked slots for that selected date.
- **Affected Files**:
  - `app/Controllers/Home.php` (line 460)
  - `app/Controllers/Admin/BookingController.php`
  - `app/Views/glowup/booking.php` (line 295)
  - `app/Views/glowup/partials/booking_modal.php` (line 128)
  - `public/js/main.js`
- **Risks**: Double bookings could be attempted if frontend doesn't dynamically fetch available slots for a given date.

---

#### REQ-A6: Manage Offers
- **Specification**: Admin can create, edit, schedule, and expire monthly offers. The website should automatically show only offers that are currently active.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Admin\MarketingController::offers()` & `saveOffer()`: Comprehensive offer management.
  - Fields supported: Name, Title, Description, Discount Type (percentage vs flat), Discount Value, Coupon Code, Target Service, Target Segment, Start Date, End Date, Banner Image upload, Active toggle, and Frontend Spotlight toggle.
  - `Admin\MarketingController::toggleOffer()` & `deleteOffer()`: Instant toggle and removal.
  - Dynamic expiration: Expired offers are automatically excluded on the website through date conditions in `OfferModel::getActiveFrontendOffers()`.
- **Affected Files**:
  - `app/Controllers/Admin/MarketingController.php`
  - `app/Models/OfferModel.php`
  - `app/Views/admin/pages/offers.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-A7: Manage Booking Status
- **Specification**: Admin can view bookings and update status, for example Pending, Confirmed, Completed, or Cancelled.
- **Current Status**: **Fully Implemented**
- **Existing Implementation**:
  - `Admin\BookingController::index()`: Full list with tabbed status filters (`all`, `today`, `pending`, `confirmed`, `in_progress`, `completed`).
  - `Admin\BookingController::updateStatus($id)`: Updates status with validation across `['pending', 'confirmed', 'in_progress', 'completed', 'cancelled', 'no_show']`.
  - Workflow Integration: Changing status to `completed` triggers automatic customer tax invoice generation (`completeService($id)`).
- **Affected Files**:
  - `app/Controllers/Admin/BookingController.php`
  - `app/Models/BookingModel.php`
  - `app/Views/admin/pages/bookings.php`
- **Gaps / Bugs**: None.
- **Risks**: None.

---

#### REQ-A8: Manage Social Media Posts
- **Specification**: Admin should be able to prepare or publish Instagram posts and display relevant posts on the website. Facebook publishing or sharing should be supported only if the connected Meta account and API permissions allow it.
- **Current Status**: **Partially Implemented**
- **Existing Implementation**:
  - `Admin\IntegrationController`: Contains Meta Graph API connection tests for `facebook_meta` and `instagram` (testing App ID, App Secret, and Access Tokens).
  - `Admin\FooterController`: Admin can configure Instagram and Facebook profile URLs displayed in website footer.
  - `glowup/gallery.php`: Displays an Instagram Feed showcase strip with link to Instagram profile.
- **Gaps / Bugs**:
  - There is currently no UI in the admin panel to create or schedule draft posts for Instagram or Facebook.
  - The gallery Instagram strip uses curated gallery images rather than pulling live posts from the Instagram Graph API.
  - Requirement specifically notes: *"Facebook publishing or sharing should be supported only if the connected Meta account and API permissions allow it. If direct publishing is not available, provide a safe manual posting workflow."*
- **Affected Files**:
  - `app/Controllers/Admin/IntegrationController.php`
  - `app/Views/admin/pages/integrations.php`
  - `app/Views/glowup/gallery.php`
- **Risks**: Direct Meta API publishing requires verified Meta Business Manager App Review and extended permissions (`pages_manage_posts`, `instagram_content_publish`). A safe manual posting / preparation workflow is recommended.

---

#### REQ-A9: WhatsApp Booking Reminders
- **Specification**: Send customers a WhatsApp reminder before their appointment, including the service, date, time, and studio contact details. Admin should be able to configure reminder timing and message template.
- **Current Status**: **Partially Implemented**
- **Existing Implementation**:
  - Manual 1-click WhatsApp reminder button in `admin/pages/bookings.php`: Generates pre-filled `https://wa.me/` message with customer name, service name, formatted date, time slot, and specialist.
  - Cloud API sender exists: `WhatsAppService::sendMessage()` and `MarketingController::sendMessage()` support dispatching template/text messages to patrons.
  - Template manager exists: `Admin\EmailTemplateController` manages template content (`email_templates` table includes triggers like `booking_reminder_24h`).
- **Gaps / Bugs**:
  - Automated reminder cron/job is not currently scheduled to automatically send reminders X hours before an appointment.
  - In `admin/pages/bookings.php`, reminders are triggered manually per-row by staff clicking the WhatsApp button.
  - Configuration of reminder timing (e.g. 24h prior, 2h prior) is not exposed in a simple settings UI for appointments.
- **Affected Files**:
  - `app/Libraries/WhatsAppService.php`
  - `app/Controllers/Admin/BookingController.php`
  - `app/Views/admin/pages/bookings.php`
  - `app/Models/CommunicationLogModel.php`
- **Risks**: Medium. Automated WhatsApp messages via Meta Cloud API require approved Meta WhatsApp Message Templates; unapproved custom text messages to non-24h active sessions fail unless initiated by customer or using an approved template.

---

## 3. System Rules & Architectural Compliance

| Rule from Document | Current Implementation Status | Evaluation |
| :--- | :--- | :--- |
| **1. Prevent Double-Booking** | Implemented in `Home::submitBooking()` | Checks date, time, specialist. **Enhancement needed**: Dynamic frontend slot availability checking to disable booked slots in real-time. |
| **2. Validate Input & Secure Endpoints** | Implemented | Uses CI4 `$this->validate()` across all forms, CSRF tokens, `password_hash()`, customer ID authorization check on invoices (`CustomerAuthController::viewInvoice`), and `adminAuth` filter on admin routes. |
| **3. Success & Error Messages** | Implemented | System uses branded luxury floating toasts on frontend (`showBookingToast`) and session flash alerts on admin screens. |
| **4. Do Not Show Expired Offers** | Implemented | Handled at DB query level in `OfferModel::getActiveFrontendOffers()`. |
| **5. WhatsApp Provider & Consent** | Partial | Meta Graph API client implemented in `WhatsAppService`, fallback `wa.me` links implemented. Webhook receiving & template sync not yet built. |
| **6. Keep Existing Design & Features** | Compliant | All additions integrate with existing CodeIgniter 4 architecture and luxury purple/gold theme. |

---

## 4. Open Questions & Items to Confirm with User

Based on Section 8 of `GlowUp_Admin_Customer_Requirements.docx`:

1. **Excel/CSV Customer Export Fields**:
   - Should the export file format be `.csv` (lightweight, zero external libraries required) or `.xlsx`?
   - Confirm which fields to export: e.g. Customer ID, Full Name, Email, Mobile Phone, WhatsApp Number, Membership Status, Total Bookings, Lifetime Revenue, Registration Date. (Passwords, tokens, and internal hashes will strictly be omitted).
2. **Booking Flow & Category Display**:
   - For Requirement 2.4 / 4.3 ("show all service categories in one clear place when clicking Book Now"):
     - Would you like Step 1 of `/booking` to show Category Cards first, and clicking a category reveals its services? Or Category Filter Tabs above the services grid?
3. **Slot Availability Management**:
   - Should time slots be managed through an Admin Settings table (e.g., standard daily opening hours, slot durations, holidays), or should we maintain standard salon slots (e.g. 10:00 AM – 7:30 PM) and dynamically disable slots booked on a given date?
4. **WhatsApp Booking Reminders**:
   - What reminder interval is preferred (e.g., 24 hours before appointment, morning of appointment, or 2 hours before)?
   - Should reminders be triggered via the existing 1-click WhatsApp concierge button, an automated background cron command, or both?
5. **Social Media Workflow**:
   - Does the studio have an active Meta App with `pages_manage_posts` / `instagram_content_publish` permissions, or should we implement a safe **Social Media Planner / Manual Posting Workflow** (allowing admin to draft caption, upload photo/reel asset, copy caption, and open Instagram/Facebook)?

---

## 5. Recommended Implementation Priority & Roadmap

Based on Section 7 of the requirements document, here is the recommended execution order:

### Phase 1: High Priority (Core Customer & Billing Flow)
1. **Booking Category Navigation (REQ-C4)**:
   - Pass dynamic categories from `CategoryModel` into `Home::booking()`.
   - Update Step 1 in `glowup/booking.php` and `glowup/partials/booking_modal.php` to present category selection before service selection.
2. **Real-Time Time Slot Availability & Conflict Guard (REQ-A5)**:
   - Add an AJAX endpoint `/booking/available-slots` that returns unavailable/booked time slots for a chosen date and specialist.
   - Visually mark booked slots as "Unavailable" in the booking wizard to avoid customer frustration.
3. **Admin Customer Data Export (REQ-A3)**:
   - Implement `export()` in `Admin\CustomerController` streaming a clean, secure `.csv` file.
   - Add the "Export to CSV" button to `admin/pages/website_customer.php`.

### Phase 2: Medium Priority (Engagement & Reminders)
4. **WhatsApp Appointment Reminder Enhancements (REQ-A9)**:
   - Add reminder template configuration in `Admin\SettingController`.
   - Implement a CLI command (`spark reminders:send`) for automated appointment reminders via `WhatsAppService`.
   - Enhance the 1-click WhatsApp button in `admin/pages/bookings.php` to use the configured reminder template.
5. **Slot Schedule Configuration (REQ-A5 Admin Controls)**:
   - Add admin controls to manage working days, daily time slot lists, and blackout dates.

### Phase 3: Later / Integration-Dependent (Social Media)
6. **Social Media Management & Manual Posting Workflow (REQ-A8)**:
   - Build a social post planner in the admin panel with prepared captions, hashtags, media assets, and 1-click links to publish on Instagram/Facebook.
