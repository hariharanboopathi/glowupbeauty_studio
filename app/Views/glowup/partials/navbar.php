<?php
/**
 * Glowup Frontend Unified Navbar
 * Matches exact reference styling, alignment, typography, and layout.
 */
if (!isset($activePage) || empty($activePage)) {
    $requestUri = trim(service('request')->getPath(), '/');
    if ($requestUri === '') {
        $activePage = 'home';
    } elseif (str_starts_with($requestUri, 'services')) {
        $activePage = 'services';
    } elseif (str_starts_with($requestUri, 'about')) {
        $activePage = 'about';
    } elseif (str_starts_with($requestUri, 'academy')) {
        $activePage = 'academy';
    } elseif (str_starts_with($requestUri, 'gallery')) {
        $activePage = 'gallery';
    } elseif (str_starts_with($requestUri, 'contact')) {
        $activePage = 'contact';
    } elseif (str_starts_with($requestUri, 'review')) {
        $activePage = 'review';
    } elseif (str_starts_with($requestUri, 'booking')) {
        $activePage = 'booking';
    } elseif (str_starts_with($requestUri, 'profile')) {
        $activePage = 'profile';
    } else {
        $activePage = '';
    }
}
?>
<!-- ==================== NAVBAR ==================== -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container" style="max-width: 1320px;">

        <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" alt="Glowup" class="navbar-brand-logo" />
            <span class="d-flex flex-column">
                <strong>Glowup</strong>
                <small>Beauty Studio &amp; Academy</small>
            </span>
        </a>

        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'home') ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'services') ? 'active' : '' ?>" href="<?= base_url('services') ?>">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'about') ? 'active' : '' ?>" href="<?= base_url('about') ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'academy') ? 'active' : '' ?>" href="<?= base_url('academy') ?>">Academy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'gallery') ? 'active' : '' ?>" href="<?= base_url('gallery') ?>">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'contact') ? 'active' : '' ?>" href="<?= base_url('contact') ?>">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($activePage === 'review') ? 'active' : '' ?>" href="<?= base_url('review') ?>">Review</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2 gap-xl-3">
                <a href="<?= business_phone_url() ?>" class="d-none d-lg-flex align-items-center gap-1 text-decoration-none nav-phone-link" aria-label="Call Glowup Studio Concierge at <?= esc(business_phone()) ?>" title="Call Concierge">
                    <span class="material-symbols-outlined" style="font-size:18px;color:var(--accent);">call</span>
                    <span class="d-none d-xl-inline"><?= esc(business_phone()) ?></span>
                </a>
                <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn-nav-wa" 
                   aria-label="Chat with Glowup Studio on WhatsApp" 
                   title="Chat with Glowup Studio on WhatsApp">
                    <?= glowup_whatsapp_icon('', 18) ?>
                </a>
                <a href="<?= base_url('booking') ?>" class="btn btn-violet">BOOK NOW</a>
                <a href="<?= base_url('profile') ?>" class="btn-person <?= ($activePage === 'profile') ? 'active' : '' ?> d-none d-md-flex" title="Patron Profile &amp; Account" aria-label="Patron Profile">
                    <span class="material-symbols-outlined" style="font-size:19px;">person</span>
                </a>
            </div>

            <!-- Mobile Contact Quick Actions -->
            <div class="d-lg-none mt-3 pt-3 border-top border-subtle d-flex flex-column gap-2">
                <a href="<?= business_phone_url() ?>" class="btn btn-outline-light btn-sm d-flex align-items-center justify-content-center gap-2" aria-label="Call Glowup Studio Concierge">
                    <span class="material-symbols-outlined" style="font-size:17px;color:var(--accent);">call</span>
                    <span>Call Concierge: <?= esc(business_phone()) ?></span>
                </a>
                <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm d-flex align-items-center justify-content-center gap-2" style="background: rgba(37,211,102,0.15); border: 1px solid rgba(37,211,102,0.35); color: #4ade80;" aria-label="Chat with Glowup Studio on WhatsApp">
                    <?= glowup_whatsapp_icon('', 17) ?>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
</nav>
