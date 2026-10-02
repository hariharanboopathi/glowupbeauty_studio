<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\AdminAuth;

class PageController extends BaseController
{
    protected AdminAuth $auth;

    public function __construct()
    {
        $this->auth = new AdminAuth();
    }

    protected function getAdminData(): array
    {
        return $this->auth->user() ?? [
            'name'   => 'Alex Vance',
            'role'   => 'Super Administrator',
            'avatar' => 'AV',
            'email'  => 'admin@glowup.com',
        ];
    }

    /* =========================================================================
     * MAIN SECTION
     * ========================================================================= */

    /**
     * Main -> Bookings
     */
    public function bookings()
    {
        return view('admin/pages/bookings', [
            'pageTitle'         => 'Bookings | Glowup Admin',
            'pageHeading'       => 'Bookings',
            'pageIcon'          => 'calendar_month',
            'breadcrumbSection' => 'Main',
            'breadcrumbTitle'   => 'Bookings',
            'activeMenu'        => 'bookings',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Main -> Clients
     */
    public function clients()
    {
        return view('admin/pages/clients', [
            'pageTitle'         => 'Clients | Glowup Admin',
            'pageHeading'       => 'Clients',
            'pageIcon'          => 'group',
            'breadcrumbSection' => 'Main',
            'breadcrumbTitle'   => 'Clients',
            'activeMenu'        => 'clients',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Main -> Services
     */
    public function services()
    {
        return view('admin/pages/services', [
            'pageTitle'         => 'Services | Glowup Admin',
            'pageHeading'       => 'Services',
            'pageIcon'          => 'spa',
            'breadcrumbSection' => 'Main',
            'breadcrumbTitle'   => 'Services',
            'activeMenu'        => 'services',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /* =========================================================================
     * WEBSITE CONNECT SECTION
     * ========================================================================= */

    /**
     * Website Connect -> Services
     */
    public function websiteServices()
    {
        return view('admin/pages/website_services', [
            'pageTitle'         => 'Website Services | Glowup Admin',
            'pageHeading'       => 'Website Services',
            'pageIcon'          => 'design_services',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Services',
            'activeMenu'        => 'website_services',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> About Us
     */
    public function websiteAbout()
    {
        return view('admin/pages/website_aboutus', [
            'pageTitle'         => 'About Us | Glowup Admin',
            'pageHeading'       => 'About Us',
            'pageIcon'          => 'info',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'About Us',
            'activeMenu'        => 'website_aboutus',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> Academy
     */
    public function websiteAcademy()
    {
        return view('admin/pages/website_academy', [
            'pageTitle'         => 'Academy Web Portal | Glowup Admin',
            'pageHeading'       => 'Academy',
            'pageIcon'          => 'school',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Academy',
            'activeMenu'        => 'website_academy',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> Gallery
     */
    public function websiteGallery()
    {
        return view('admin/pages/website_gallery', [
            'pageTitle'         => 'Gallery | Glowup Admin',
            'pageHeading'       => 'Gallery',
            'pageIcon'          => 'photo_library',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Gallery',
            'activeMenu'        => 'website_gallery',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> Contact
     */
    public function websiteContact()
    {
        return view('admin/pages/website_contact', [
            'pageTitle'         => 'Contact | Glowup Admin',
            'pageHeading'       => 'Contact',
            'pageIcon'          => 'contact_phone',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Contact',
            'activeMenu'        => 'website_contact',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> Reviews
     */
    public function websiteReviews()
    {
        return view('admin/pages/website_reviews', [
            'pageTitle'         => 'Reviews | Glowup Admin',
            'pageHeading'       => 'Reviews',
            'pageIcon'          => 'rate_review',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Reviews',
            'activeMenu'        => 'website_reviews',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Website Connect -> Customer
     */
    public function websiteCustomer()
    {
        return (new CustomerController())->index();
    }

    /**
     * Website Connect -> Invoice
     */
    public function websiteInvoice()
    {
        return view('admin/pages/website_invoice', [
            'pageTitle'         => 'Invoice | Glowup Admin',
            'pageHeading'       => 'Invoice',
            'pageIcon'          => 'receipt_long',
            'breadcrumbSection' => 'Website Connect',
            'breadcrumbTitle'   => 'Invoice',
            'activeMenu'        => 'website_invoice',
            'admin'             => $this->getAdminData(),
        ]);
    }

    public function invoice()
    {
        return $this->websiteInvoice();
    }

    /**
     * Website Connect -> Footer
     */
    public function websiteFooter()
    {
        return (new FooterController())->index();
    }

    public function footer()
    {
        return $this->websiteFooter();
    }

    /* =========================================================================
     * ACADEMY SECTION
     * ========================================================================= */

    /**
     * Academy -> Courses
     */
    public function courses()
    {
        return view('admin/pages/courses', [
            'pageTitle'         => 'Courses | Glowup Admin',
            'pageHeading'       => 'Courses',
            'pageIcon'          => 'school',
            'breadcrumbSection' => 'Academy',
            'breadcrumbTitle'   => 'Courses',
            'activeMenu'        => 'courses',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Academy -> Students
     */
    public function students()
    {
        return view('admin/pages/students', [
            'pageTitle'         => 'Students | Glowup Admin',
            'pageHeading'       => 'Students',
            'pageIcon'          => 'person_book',
            'breadcrumbSection' => 'Academy',
            'breadcrumbTitle'   => 'Students',
            'activeMenu'        => 'students',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /* =========================================================================
     * SYSTEM SECTION
     * ========================================================================= */

    /**
     * System -> Reviews
     */
    public function systemReviews()
    {
        return view('admin/pages/system_reviews', [
            'pageTitle'         => 'System Reviews | Glowup Admin',
            'pageHeading'       => 'Reviews',
            'pageIcon'          => 'reviews',
            'breadcrumbSection' => 'System',
            'breadcrumbTitle'   => 'Reviews',
            'activeMenu'        => 'system_reviews',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * System -> Reports
     */
    public function reports()
    {
        return view('admin/pages/reports', [
            'pageTitle'         => 'Reports | Glowup Admin',
            'pageHeading'       => 'Reports',
            'pageIcon'          => 'analytics',
            'breadcrumbSection' => 'System',
            'breadcrumbTitle'   => 'Reports',
            'activeMenu'        => 'reports',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * System -> Settings
     */
    public function settings()
    {
        return view('admin/pages/settings', [
            'pageTitle'         => 'General Settings | Glowup Admin',
            'pageHeading'       => 'General Settings',
            'pageIcon'          => 'settings',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'General Settings',
            'activeMenu'        => 'settings',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Business -> Bridal Packages
     */
    public function bridal()
    {
        return view('admin/pages/bridal', [
            'pageTitle'         => 'Bridal Packages | Glowup Admin',
            'pageHeading'       => 'Bridal Packages',
            'pageIcon'          => 'diamond',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Bridal Packages',
            'activeMenu'        => 'bridal',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Business -> Rentals & Jewellery
     */
    public function rentals()
    {
        return view('admin/pages/rentals', [
            'pageTitle'         => 'Rentals & Jewellery | Glowup Admin',
            'pageHeading'       => 'Rentals & Jewellery',
            'pageIcon'          => 'styler',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Rentals & Jewellery',
            'activeMenu'        => 'rentals',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Business -> Photoshoot
     */
    public function photoshoot()
    {
        return view('admin/pages/photoshoot', [
            'pageTitle'         => 'Photoshoot Bookings | Glowup Admin',
            'pageHeading'       => 'Photoshoot',
            'pageIcon'          => 'photo_camera',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Photoshoot',
            'activeMenu'        => 'photoshoot',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Business -> Events
     */
    public function events()
    {
        return view('admin/pages/events', [
            'pageTitle'         => 'Events & Masterclasses | Glowup Admin',
            'pageHeading'       => 'Events',
            'pageIcon'          => 'event',
            'breadcrumbSection' => 'Business',
            'breadcrumbTitle'   => 'Events',
            'activeMenu'        => 'events',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Media -> Portfolio
     */
    public function portfolio()
    {
        return view('admin/pages/portfolio', [
            'pageTitle'         => 'Portfolio Showcase | Glowup Admin',
            'pageHeading'       => 'Portfolio',
            'pageIcon'          => 'auto_awesome_mosaic',
            'breadcrumbSection' => 'Media',
            'breadcrumbTitle'   => 'Portfolio',
            'activeMenu'        => 'portfolio',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Customer Relations -> Enquiries
     */
    public function enquiries()
    {
        return view('admin/pages/enquiries', [
            'pageTitle'         => 'Customer Enquiries | Glowup Admin',
            'pageHeading'       => 'Enquiries',
            'pageIcon'          => 'mail',
            'breadcrumbSection' => 'Customer Relations',
            'breadcrumbTitle'   => 'Enquiries',
            'activeMenu'        => 'enquiry',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Blog -> Blog Posts
     */
    public function blog()
    {
        return view('admin/pages/blog', [
            'pageTitle'         => 'Blog Posts | Glowup Admin',
            'pageHeading'       => 'Blog Posts',
            'pageIcon'          => 'article',
            'breadcrumbSection' => 'Blog',
            'breadcrumbTitle'   => 'Blog Posts',
            'activeMenu'        => 'blog',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Blog -> Categories
     */
    public function blogCategories()
    {
        return view('admin/pages/blog_categories', [
            'pageTitle'         => 'Blog Categories | Glowup Admin',
            'pageHeading'       => 'Categories',
            'pageIcon'          => 'category',
            'breadcrumbSection' => 'Blog',
            'breadcrumbTitle'   => 'Categories',
            'activeMenu'        => 'blog_categories',
            'admin'             => $this->getAdminData(),
        ]);
    }

    /**
     * Settings -> Admin Profile
     */
    public function profile()
    {
        return view('admin/pages/profile', [
            'pageTitle'         => 'Admin Profile & Security | Glowup Admin',
            'pageHeading'       => 'Admin Profile',
            'pageIcon'          => 'manage_accounts',
            'breadcrumbSection' => 'Settings',
            'breadcrumbTitle'   => 'Admin Profile',
            'activeMenu'        => 'profile',
            'admin'             => $this->getAdminData(),
        ]);
    }
}
