<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Frontend Pages Routes
$routes->match(['get', 'head'], '/', 'Home::index');
$routes->match(['get', 'head'], 'index.html', 'Home::index');
$routes->match(['get', 'head'], 'home', 'Home::index');

$routes->match(['get', 'head'], 'services', 'Home::services');
$routes->match(['get', 'head'], 'services.html', 'Home::services');

$routes->match(['get', 'head'], 'about', 'Home::about');
$routes->match(['get', 'head'], 'about.html', 'Home::about');
$routes->match(['get', 'head'], 'about-us', 'Home::about');
$routes->match(['get', 'head'], 'aboutus', 'Home::about');

$routes->match(['get', 'head'], 'academy', 'Home::academy');
$routes->match(['get', 'head'], 'academy.html', 'Home::academy');
$routes->post('academy/enroll', 'Home::submitAcademyEnroll');

$routes->match(['get', 'head'], 'gallery', 'Home::gallery');
$routes->match(['get', 'head'], 'gallery.html', 'Home::gallery');

$routes->match(['get', 'head'], 'contact', 'Home::contact');
$routes->match(['get', 'head'], 'contact.html', 'Home::contact');
$routes->post('contact/submit', 'Home::submitContact');

$routes->match(['get', 'head'], 'review', 'Home::review');
$routes->match(['get', 'head'], 'review.html', 'Home::review');
$routes->post('review/submit', 'Home::submitReview');

$routes->match(['get', 'head'], 'booking', 'Home::booking');
$routes->match(['get', 'head'], 'booking.html', static function() {
    $queryString = service('request')->getUri()->getQuery();
    $targetUrl = base_url('booking') . ($queryString ? ('?' . $queryString) : '');
    return redirect()->to($targetUrl, 301);
});
$routes->get('booking/check-slots', 'Home::checkSlots');
$routes->post('booking/submit', 'Home::submitBooking');

$routes->match(['get', 'head'], 'profile', 'Home::profile');
$routes->match(['get', 'head'], 'profile.html', 'Home::profile');
$routes->post('profile/update', 'CustomerAuthController::updateProfile');
$routes->post('profile/change-password', 'CustomerAuthController::changePassword');
$routes->get('profile/invoice/(:num)', 'CustomerAuthController::viewInvoice/$1');

// Frontend Customer Authentication Routes
$routes->get('register', 'CustomerAuthController::showRegister');
$routes->get('user_register.html', 'CustomerAuthController::showRegister');
$routes->get('useruser_register.html', 'CustomerAuthController::showRegister');
$routes->post('register', 'CustomerAuthController::register');

$routes->get('login', 'CustomerAuthController::showLogin');
$routes->get('login.html', 'CustomerAuthController::showLogin');
$routes->post('login', 'CustomerAuthController::login');
$routes->get('logout', 'CustomerAuthController::logout');

// Google OAuth Customer Routes
$routes->get('auth/google', 'CustomerAuthController::googleLogin');
$routes->get('auth/google/callback', 'CustomerAuthController::googleCallback');
$routes->get('auth/google/demo', 'CustomerAuthController::googleDemo');


// Admin Public Auth Routes
$routes->group('admin', static function ($routes) {
    $routes->get('/', 'Admin\AuthController::login');
    $routes->post('/', 'Admin\AuthController::attemptLogin');
    $routes->get('login', 'Admin\AuthController::login');
    $routes->post('login', 'Admin\AuthController::attemptLogin');
    $routes->post('login/submit', 'Admin\AuthController::attemptLogin');
    $routes->get('logout', 'Admin\AuthController::logout');
});

// Admin Protected Routes
$routes->group('admin', ['filter' => 'adminAuth'], static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Homepage Content Management CRUD
    $routes->get('homepage', 'Admin\HomepageController::index');
    $routes->post('homepage/update-hero', 'Admin\HomepageController::updateHero');
    $routes->post('homepage/update-philosophy', 'Admin\HomepageController::updatePhilosophy');
    $routes->post('homepage/slide/save', 'Admin\HomepageController::saveSlide');
    $routes->match(['get', 'post'], 'homepage/slide/delete/(:num)', 'Admin\HomepageController::deleteSlide/$1');
    $routes->post('homepage/slide/toggle/(:num)', 'Admin\HomepageController::toggleSlide/$1');
    $routes->post('homepage/service/save', 'Admin\HomepageController::saveService');
    $routes->match(['get', 'post'], 'homepage/service/delete/(:num)', 'Admin\HomepageController::deleteService/$1');
    $routes->post('homepage/service/toggle/(:num)', 'Admin\HomepageController::toggleService/$1');

    // Business Management & Scheduling Routes
    $routes->get('bookings', 'Admin\BookingController::index');
    $routes->post('bookings/save', 'Admin\BookingController::save');
    $routes->post('bookings/update-status/(:num)', 'Admin\BookingController::updateStatus/$1');
    $routes->get('bookings/complete/(:num)', 'Admin\BookingController::completeService/$1');
    $routes->match(['get', 'post'], 'bookings/delete/(:num)', 'Admin\BookingController::delete/$1');

    // Invoices & Billing Routes
    $routes->get('invoices', 'Admin\InvoiceController::index');
    $routes->post('invoices/save', 'Admin\InvoiceController::save');
    $routes->get('invoices/view/(:num)', 'Admin\InvoiceController::viewInvoice/$1');
    $routes->post('invoices/record-payment/(:num)', 'Admin\InvoiceController::recordPayment/$1');
    $routes->get('invoices/mark-paid/(:num)', 'Admin\InvoiceController::markPaid/$1');
    $routes->get('invoices/cancel/(:num)', 'Admin\InvoiceController::cancelInvoice/$1');
    $routes->match(['get', 'post'], 'invoices/delete/(:num)', 'Admin\InvoiceController::delete/$1');

    // CRM Leads & Follow-up Routes
    $routes->get('crm/leads', 'Admin\CrmController::leads');
    $routes->post('crm/leads/save', 'Admin\CrmController::saveLead');
    $routes->post('crm/leads/update-status/(:num)', 'Admin\CrmController::updateLeadStatus/$1');
    $routes->get('crm/leads/convert/(:num)', 'Admin\CrmController::convertLead/$1');
    $routes->match(['get', 'post'], 'crm/leads/delete/(:num)', 'Admin\CrmController::deleteLead/$1');
    $routes->get('crm/followups', 'Admin\CrmController::followUps');
    $routes->post('crm/followups/save', 'Admin\CrmController::saveFollowUp');
    $routes->get('crm/followups/complete/(:num)', 'Admin\CrmController::completeFollowUp/$1');
    $routes->match(['get', 'post'], 'crm/followups/delete/(:num)', 'Admin\CrmController::deleteFollowUp/$1');

    // Marketing & Communication Routes
    $routes->get('marketing/offers', 'Admin\MarketingController::offers');
    $routes->post('marketing/offers/save', 'Admin\MarketingController::saveOffer');
    $routes->get('marketing/offers/toggle/(:num)', 'Admin\MarketingController::toggleOffer/$1');
    $routes->match(['get', 'post'], 'marketing/offers/delete/(:num)', 'Admin\MarketingController::deleteOffer/$1');
    $routes->get('marketing/communication-center', 'Admin\MarketingController::communicationCenter');
    $routes->post('marketing/communication-center/send', 'Admin\MarketingController::sendMessage');

    // Email Templates Routes
    $routes->get('settings/email-templates', 'Admin\EmailTemplateController::index');
    $routes->post('settings/email-templates/save', 'Admin\EmailTemplateController::save');
    $routes->get('settings/email-templates/preview/(:num)', 'Admin\EmailTemplateController::preview/$1');

    // API Keys & Integrations Routes
    $routes->get('settings/integrations', 'Admin\IntegrationController::index');
    $routes->post('settings/integrations/save/(:any)', 'Admin\IntegrationController::save/$1');
    $routes->get('settings/integrations/test/(:any)', 'Admin\IntegrationController::testConnection/$1');
    $routes->post('settings/integrations/send-test/(:any)', 'Admin\IntegrationController::sendTestMessage/$1');

    // Main Side Menu Routes
    $routes->get('clients', 'Admin\CustomerController::index');
    $routes->get('services', 'Admin\ServiceController::index');
    $routes->post('services/save', 'Admin\ServiceController::save');
    $routes->match(['get', 'post'], 'services/delete/(:num)', 'Admin\ServiceController::delete/$1');
    $routes->post('services/toggle-status/(:num)', 'Admin\ServiceController::toggleStatus/$1');
    $routes->post('services/toggle-featured/(:num)', 'Admin\ServiceController::toggleFeatured/$1');
    $routes->post('services/category/save', 'Admin\ServiceController::saveCategory');
    $routes->match(['get', 'post'], 'services/category/delete/(:num)', 'Admin\ServiceController::deleteCategory/$1');

    // Website Connect Side Menu Routes
    $routes->get('website/homepage', 'Admin\HomepageController::index');
    $routes->get('website/services', 'Admin\ServiceController::index');
    $routes->get('website/aboutus', 'Admin\AboutController::index');
    $routes->post('website/aboutus/update-content', 'Admin\AboutController::updateContent');
    $routes->post('website/aboutus/member/save', 'Admin\AboutController::saveMember');
    $routes->match(['get', 'post'], 'website/aboutus/member/delete/(:num)', 'Admin\AboutController::deleteMember/$1');
    $routes->post('website/aboutus/member/toggle/(:num)', 'Admin\AboutController::toggleMember/$1');
    $routes->get('website/academy', 'Admin\PageController::websiteAcademy');
    $routes->get('website/gallery', 'Admin\MediaController::gallery');
    $routes->get('gallery', 'Admin\MediaController::gallery');
    $routes->post('website/gallery/save', 'Admin\MediaController::saveGallery');
    $routes->match(['get', 'post'], 'website/gallery/delete/(:num)', 'Admin\MediaController::deleteGallery/$1');
    $routes->post('website/gallery/toggle/(:num)', 'Admin\MediaController::toggleGalleryStatus/$1');
    $routes->post('website/gallery/toggle-featured/(:num)', 'Admin\MediaController::toggleGalleryFeatured/$1');
    $routes->get('website/reviews', 'Admin\ReviewController::index');
    $routes->get('website/reviews/details/(:num)', 'Admin\ReviewController::details/$1');
    $routes->post('website/reviews/save', 'Admin\ReviewController::save');
    $routes->match(['get', 'post'], 'website/reviews/toggle-status/(:num)', 'Admin\ReviewController::toggleStatus/$1');
    $routes->match(['get', 'post'], 'website/reviews/approve/(:num)', 'Admin\ReviewController::approve/$1');
    $routes->match(['get', 'post'], 'website/reviews/delete/(:num)', 'Admin\ReviewController::delete/$1');
    $routes->post('website/reviews/reorder', 'Admin\ReviewController::reorder');
    $routes->get('website/customer', 'Admin\CustomerController::index');
    $routes->get('website/customer/details/(:num)', 'Admin\CustomerController::details/$1');
    $routes->post('website/customer/save', 'Admin\CustomerController::save');
    $routes->match(['get', 'post'], 'website/customer/toggle-status/(:num)', 'Admin\CustomerController::toggleStatus/$1');
    $routes->match(['get', 'post'], 'website/customer/delete/(:num)', 'Admin\CustomerController::delete/$1');
    $routes->get('customers/(:num)', 'Admin\CustomerController::viewProfile/$1');
    $routes->post('customers/add-note/(:num)', 'Admin\CustomerController::addNote/$1');
    $routes->post('customers/update-crm/(:num)', 'Admin\CustomerController::updateCrm/$1');
    $routes->get('clients', 'Admin\CustomerController::index');
    $routes->get('website/invoice', 'Admin\PageController::websiteInvoice');
    $routes->get('website/footer', 'Admin\FooterController::index');
    $routes->get('website/footer/brand', 'Admin\FooterController::brand');
    $routes->get('website/footer/quick-links', 'Admin\FooterController::quickLinks');
    $routes->get('website/footer/treatments', 'Admin\FooterController::treatments');
    $routes->get('website/footer/concierge', 'Admin\FooterController::concierge');
    $routes->get('website/footer/social', 'Admin\FooterController::social');
    $routes->get('website/footer/bottom', 'Admin\FooterController::bottom');
    $routes->post('website/footer/update-brand', 'Admin\FooterController::updateBrand');
    $routes->post('website/footer/update-concierge', 'Admin\FooterController::updateConcierge');
    $routes->post('website/footer/update-social', 'Admin\FooterController::updateSocial');
    $routes->post('website/footer/update-bottom', 'Admin\FooterController::updateBottom');
    $routes->post('website/footer/link/save', 'Admin\FooterController::saveLink');
    $routes->match(['get', 'post'], 'website/footer/link/delete/(:num)', 'Admin\FooterController::deleteLink/$1');
    $routes->post('website/footer/link/reorder', 'Admin\FooterController::reorderLinks');
    $routes->match(['get', 'post'], 'website/footer/link/move/(:num)/(:any)', 'Admin\FooterController::moveLink/$1/$2');

    // Business Routes
    $routes->get('courses', 'Admin\BusinessController::courses');
    $routes->post('courses/save', 'Admin\BusinessController::saveCourse');
    $routes->match(['get', 'post'], 'courses/delete/(:num)', 'Admin\BusinessController::deleteCourse/$1');
    $routes->post('courses/toggle/(:num)', 'Admin\BusinessController::toggleCourse/$1');

    $routes->get('students', 'Admin\BusinessController::students');
    $routes->post('students/save', 'Admin\BusinessController::saveStudent');
    $routes->match(['get', 'post'], 'students/delete/(:num)', 'Admin\BusinessController::deleteStudent/$1');

    $routes->get('business/bridal', 'Admin\BusinessController::bridal');
    $routes->post('business/bridal/save', 'Admin\BusinessController::saveBridal');
    $routes->match(['get', 'post'], 'business/bridal/delete/(:num)', 'Admin\BusinessController::deleteBridal/$1');
    $routes->post('business/bridal/toggle/(:num)', 'Admin\BusinessController::toggleBridal/$1');

    $routes->get('business/rentals', 'Admin\BusinessController::rentals');
    $routes->post('business/rentals/save', 'Admin\BusinessController::saveRental');
    $routes->match(['get', 'post'], 'business/rentals/delete/(:num)', 'Admin\BusinessController::deleteRental/$1');
    $routes->post('business/rentals/toggle/(:num)', 'Admin\BusinessController::toggleRental/$1');

    $routes->get('business/photoshoot', 'Admin\BusinessController::photoshoot');
    $routes->post('business/photoshoot/save', 'Admin\BusinessController::savePhotoshoot');
    $routes->match(['get', 'post'], 'business/photoshoot/delete/(:num)', 'Admin\BusinessController::deletePhotoshoot/$1');
    $routes->post('business/photoshoot/toggle/(:num)', 'Admin\BusinessController::togglePhotoshoot/$1');

    $routes->get('business/events', 'Admin\BusinessController::events');
    $routes->post('business/events/save', 'Admin\BusinessController::saveEvent');
    $routes->match(['get', 'post'], 'business/events/delete/(:num)', 'Admin\BusinessController::deleteEvent/$1');
    $routes->post('business/events/toggle/(:num)', 'Admin\BusinessController::toggleEvent/$1');

    // Media Routes
    $routes->get('media/portfolio', 'Admin\MediaController::portfolio');

    // Customer Relations & Inquiries
    $routes->get('enquiry', 'Admin\EnquiryController::index');
    $routes->get('enquiry/convert/(:num)', 'Admin\EnquiryController::convertToLead/$1');
    $routes->post('enquiry/update-status/(:num)', 'Admin\EnquiryController::updateStatus/$1');
    $routes->match(['get', 'post'], 'enquiry/delete/(:num)', 'Admin\EnquiryController::delete/$1');
    $routes->get('enquiry/details/(:num)', 'Admin\EnquiryController::details/$1');

    // Blog Routes
    $routes->get('blog', 'Admin\BlogController::index');
    $routes->post('blog/save', 'Admin\BlogController::savePost');
    $routes->match(['get', 'post'], 'blog/delete/(:num)', 'Admin\BlogController::deletePost/$1');
    $routes->post('blog/toggle/(:num)', 'Admin\BlogController::togglePublish/$1');
    $routes->post('blog/toggle-featured/(:num)', 'Admin\BlogController::toggleFeatured/$1');

    $routes->get('blog/categories', 'Admin\BlogController::categories');
    $routes->post('blog/category/save', 'Admin\BlogController::saveCategory');
    $routes->match(['get', 'post'], 'blog/category/delete/(:num)', 'Admin\BlogController::deleteCategory/$1');

    // System & Settings Routes
    $routes->get('system/reviews', 'Admin\PageController::systemReviews');
    $routes->get('reviews', 'Admin\PageController::systemReviews');
    $routes->get('reports', 'Admin\PageController::reports');

    // SEO Management Routes
    $routes->get('seo', 'Admin\SeoController::index');
    $routes->get('seo/(:segment)', 'Admin\SeoController::index/$1');
    $routes->post('seo/save', 'Admin\SeoController::save');

    // Settings & Profile
    $routes->get('settings', 'Admin\SettingController::index');
    $routes->post('settings/save', 'Admin\SettingController::saveSettings');
    $routes->get('settings/profile', 'Admin\SettingController::profile');
    $routes->post('settings/profile/update', 'Admin\SettingController::updateProfile');
    $routes->post('settings/profile/password', 'Admin\SettingController::changePassword');
});

/**
 * --------------------------------------------------------------------
 * Custom 404 Override Handler
 * --------------------------------------------------------------------
 * Renders the custom Glowup Beauty Studio & Academy branded 404 page
 * with HTTP 404 Not Found status, zero debug/path exposure, and full
 * resilience across all frontend and admin routes.
 */
$routes->set404Override(static function () {
    $request = service('request');
    if ($request->isAJAX() || (!str_contains($request->getHeaderLine('accept'), 'text/html') && str_contains($request->getHeaderLine('accept'), 'application/json'))) {
        service('response')->setContentType('application/json');
        return json_encode([
            'status'  => 404,
            'error'   => 'Not Found',
            'message' => 'The requested resource was not found.',
        ]);
    }

    return view('errors/html/error_404');
});

