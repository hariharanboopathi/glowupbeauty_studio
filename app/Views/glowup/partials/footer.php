<?php
/**
 * Dynamic CMS-Managed Footer Partial for Glowup Frontend
 */
if (!isset($footerSettings) || !isset($footerQuickLinks) || !isset($footerTreatments)) {
    try {
        $footerCms = (new \App\Models\FooterModel())->getFooterData();
        $footerSettings   = $footerCms['settings'] ?? [];
        $footerQuickLinks = $footerCms['quick_links'] ?? [];
        $footerTreatments = $footerCms['popular_treatments'] ?? [];
    } catch (\Throwable $e) {
        $footerSettings = [
            'brand_name'          => 'Glowup',
            'brand_subtitle'      => 'Beauty Studio & Academy',
            'brand_description'   => 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.',
            'newsletter_title'    => 'Private Journal',
            'newsletter_desc'     => 'Receive curated beauty journals and bespoke privileges.',
            'newsletter_btn_text' => 'Join',
            'concierge_title'     => 'Academy Concierge',
            'concierge_address'   => "Flagship Academy:\n12 Madurai, Tamil Nadu",
            'concierge_phone'     => '+91 98200 12345',
            'concierge_whatsapp'  => '+91 98200 12345',
            'concierge_email'     => 'glowup@gmail.com',
            'concierge_hours'     => 'Tue – Sun: 10:00 AM – 8:00 PM',
            'social_instagram'    => '#',
            'social_pinterest'    => '#',
            'social_facebook'     => '#',
            'social_youtube'      => '#',
            'social_location'     => '#',
            'copyright_text'      => '© 2025 Glowup Beauty Studio & Academy. All rights reserved.',
            'additional_text'     => 'Price varies based on hair length & texture.',
        ];
        $footerQuickLinks = [];
        $footerTreatments = [];
    }
}
?>

<!-- ==================== FOOTER ==================== -->
<footer>
    <div class="container" style="max-width: 1420px;">

        <div class="row g-5">

            <!-- Brand + Newsletter -->
            <div class="col-lg-4">
                <div class="footer-brand mb-3">
                    <?php if (!empty($footerSettings['brand_logo']) && file_exists(FCPATH . $footerSettings['brand_logo'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url($footerSettings['brand_logo']) ?>" alt="<?= esc($footerSettings['brand_name'] ?? 'Glowup') ?>" class="footer-brand-logo" style="max-height: 48px; max-width: 190px; object-fit: contain;">
                        </div>
                    <?php endif; ?>
                    <strong><?= esc($footerSettings['brand_name'] ?? 'Glowup') ?></strong>
                    <small><?= esc($footerSettings['brand_subtitle'] ?? 'Beauty Studio & Academy') ?></small>
                </div>
                <p style="font-size:13.5px;color:var(--text-dim);line-height:1.75;max-width:340px;">
                    <?= nl2br(esc($footerSettings['brand_description'] ?? 'An academy of mindful beauty, bespoke haircare, and transformative aesthetic therapies crafted for your natural radiance.')) ?>
                </p>

                <h6 class="mt-4"><?= esc($footerSettings['newsletter_title'] ?? 'Private Journal') ?></h6>
                <p style="font-size:13px;color:var(--text-dim);">
                    <?= esc($footerSettings['newsletter_desc'] ?? 'Receive curated beauty journals and bespoke privileges.') ?>
                </p>

                <div class="input-group mt-3" style="max-width: 320px;">
                    <input type="email" class="form-control newsletter-input"
                        placeholder="Enter your email address" />
                    <button class="btn btn-newsletter" type="button"><?= esc($footerSettings['newsletter_btn_text'] ?? 'Join') ?></button>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-6 col-lg-2">
                <h6>Quick Links</h6>
                <?php if (!empty($footerQuickLinks)): ?>
                    <?php foreach ($footerQuickLinks as $qLink): ?>
                        <?php 
                            $url = $qLink['url'];
                            if (!preg_match('#^https?://#i', $url) && !str_starts_with($url, '/')) {
                                $url = base_url($url);
                            } elseif (str_starts_with($url, '/')) {
                                $url = base_url(ltrim($url, '/'));
                            }
                        ?>
                        <a href="<?= esc($url) ?>"><?= esc($qLink['title']) ?></a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a href="<?= base_url('/') ?>">Home</a>
                    <a href="<?= base_url('services') ?>">Services</a>
                    <a href="<?= base_url('about') ?>">About Us</a>
                    <a href="<?= base_url('academy') ?>">Academy</a>
                    <a href="<?= base_url('gallery') ?>">Gallery</a>
                    <a href="<?= base_url('contact') ?>">Contact</a>
                    <a href="<?= base_url('review') ?>">Reviews</a>
                    <a href="<?= base_url('booking') ?>">Book Online</a>
                <?php endif; ?>
            </div>

            <!-- Popular Treatments -->
            <div class="col-6 col-lg-3">
                <h6>Popular Treatments</h6>
                <?php if (!empty($footerTreatments)): ?>
                    <?php foreach ($footerTreatments as $tLink): ?>
                        <?php 
                            $url = $tLink['url'];
                            if (!preg_match('#^https?://#i', $url) && !str_starts_with($url, '/')) {
                                $url = base_url($url);
                            } elseif (str_starts_with($url, '/')) {
                                $url = base_url(ltrim($url, '/'));
                            }
                        ?>
                        <a href="<?= esc($url) ?>"><?= esc($tLink['title']) ?></a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a href="<?= base_url('services') ?>">Hydra Facial Ritual</a>
                    <a href="<?= base_url('services') ?>">Keratin Infusion Therapy</a>
                    <a href="<?= base_url('services') ?>">Aesthetic Botox Treatment</a>
                    <a href="<?= base_url('services') ?>">Couture Hair Straightening</a>
                    <a href="<?= base_url('services') ?>">Silk Hair Smoothing</a>
                    <a href="<?= base_url('academy') ?>">Bridal Diploma Course</a>
                <?php endif; ?>
            </div>

            <!-- Concierge -->
            <div class="col-lg-3">
                <h6><?= esc($footerSettings['concierge_title'] ?? 'Academy Concierge') ?></h6>
                <?php if (!empty($footerSettings['concierge_address'])): ?>
                    <p style="font-size:13px;color:var(--text-dim);line-height:1.7;">
                        <?= nl2br(esc($footerSettings['concierge_address'])) ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($footerSettings['concierge_phone'])): ?>
                    <a href="<?= business_phone_url($footerSettings['concierge_phone']) ?>" class="d-flex align-items-center gap-2 mb-1" aria-label="Call Concierge: <?= esc($footerSettings['concierge_phone']) ?>" title="Call Concierge">
                        <span class="material-symbols-outlined" style="font-size:16px;color:var(--accent);">call</span>
                        <span><?= esc($footerSettings['concierge_phone']) ?></span>
                    </a>
                <?php endif; ?>

                <?php 
                $waNum = !empty($footerSettings['concierge_whatsapp']) ? $footerSettings['concierge_whatsapp'] : ($footerSettings['concierge_phone'] ?? '');
                if (!empty($waNum)): 
                ?>
                    <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.', $waNum) ?>" target="_blank" rel="noopener noreferrer" class="d-flex align-items-center gap-2 mb-1" style="color: #a7f3d0;" aria-label="Chat with Glowup Studio on WhatsApp: <?= esc($waNum) ?>" title="Chat on WhatsApp">
                        <?= glowup_whatsapp_icon('', 16) ?>
                        <span>WhatsApp Chat</span>
                    </a>
                <?php endif; ?>

                <?php if (!empty($footerSettings['concierge_email'])): ?>
                    <a href="mailto:<?= esc($footerSettings['concierge_email']) ?>" class="d-flex align-items-center gap-2 mb-1" aria-label="Email Concierge: <?= esc($footerSettings['concierge_email']) ?>">
                        <span class="material-symbols-outlined" style="font-size:16px;color:var(--accent);">mail</span>
                        <span><?= esc($footerSettings['concierge_email']) ?></span>
                    </a>
                <?php endif; ?>
                <?php if (!empty($footerSettings['concierge_hours'])): ?>
                    <p style="font-size:10px;letter-spacing:0.14em;text-transform:uppercase;color:var(--accent-2);margin-top:0.75rem;">
                        <?= esc($footerSettings['concierge_hours']) ?>
                    </p>
                <?php endif; ?>

                <div class="mt-3">
                    <?php if (!empty($footerSettings['social_instagram']) && $footerSettings['social_instagram'] !== '#'): ?>
                        <a href="<?= esc($footerSettings['social_instagram']) ?>" class="social-circle" title="Instagram" target="_blank" rel="noopener noreferrer">
                            <?= glowup_instagram_icon('', 18) ?>
                        </a>
                    <?php else: ?>
                        <a href="#" class="social-circle" title="Instagram">
                            <?= glowup_instagram_icon('', 18) ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($footerSettings['social_pinterest']) && $footerSettings['social_pinterest'] !== '#'): ?>
                        <a href="<?= esc($footerSettings['social_pinterest']) ?>" class="social-circle" title="Pinterest" target="_blank" rel="noopener noreferrer">
                            <?= glowup_pinterest_icon('', 18) ?>
                        </a>
                    <?php else: ?>
                        <a href="#" class="social-circle" title="Pinterest">
                            <?= glowup_pinterest_icon('', 18) ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($footerSettings['social_facebook']) && $footerSettings['social_facebook'] !== '#'): ?>
                        <a href="<?= esc($footerSettings['social_facebook']) ?>" class="social-circle" title="Facebook" target="_blank" rel="noopener noreferrer">
                            <?= glowup_facebook_icon('', 18) ?>
                        </a>
                    <?php else: ?>
                        <a href="#" class="social-circle" title="Facebook">
                            <?= glowup_facebook_icon('', 18) ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($footerSettings['social_youtube']) && $footerSettings['social_youtube'] !== '#'): ?>
                        <a href="<?= esc($footerSettings['social_youtube']) ?>" class="social-circle" title="YouTube" target="_blank" rel="noopener noreferrer">
                            <?= glowup_youtube_icon('', 18) ?>
                        </a>
                    <?php else: ?>
                        <a href="#" class="social-circle" title="YouTube">
                            <?= glowup_youtube_icon('', 18) ?>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($footerSettings['social_location']) && $footerSettings['social_location'] !== '#'): ?>
                        <a href="<?= esc($footerSettings['social_location']) ?>" class="social-circle" title="Location" target="_blank" rel="noopener noreferrer">
                            <span class="material-symbols-outlined">public</span>
                        </a>
                    <?php else: ?>
                        <a href="#" class="social-circle" title="Location">
                            <span class="material-symbols-outlined">public</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Footer bottom -->
        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between gap-2">
            <span><?= esc($footerSettings['copyright_text'] ?? '© 2025 Glowup Beauty Studio & Academy. All rights reserved.') ?></span>
            <span><?= esc($footerSettings['additional_text'] ?? 'Price varies based on hair length & texture.') ?></span>
        </div>

    </div>
</footer>

<!-- Site-wide Luxury Floating Contact Actions -->
<?= view('glowup/partials/floating_contact') ?>

<!-- Universal Booking Popup Modal (active on all frontend pages except standalone /booking) -->
<?php 
$currentUriPath = trim(service('request')->getUri()->getPath(), '/');
$isBookingPage = ($currentUriPath === 'booking' || str_starts_with($currentUriPath, 'booking/'));
?>
<?php if (!$isBookingPage): ?>
    <?= view('glowup/partials/booking_modal') ?>
<?php endif; ?>
