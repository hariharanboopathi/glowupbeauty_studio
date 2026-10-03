<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */
if (!function_exists('clean_phone_number')) {
    /**
     * Normalize a phone number for dialer tel: links.
     * Preserves leading +, strips spaces, hyphens, and parentheses.
     * E.g. "+91 98200 12345" -> "+919820012345"
     */
    function clean_phone_number(?string $phone): string
    {
        if (empty($phone)) {
            return '+919820012345';
        }
        $phone = trim($phone);
        $hasPlus = str_starts_with($phone, '+');
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if ($hasPlus) {
            return '+' . $digits;
        }

        // Default to India +91 if 10 digits
        if (strlen($digits) === 10) {
            return '+91' . $digits;
        }

        return '+' . $digits;
    }
}

if (!function_exists('clean_whatsapp_number')) {
    /**
     * Normalize phone number to strict international digits-only format for WhatsApp (https://wa.me/<number>).
     * No +, no spaces, no parentheses, no dashes.
     * E.g. "+91 98200 12345" -> "919820012345"
     * E.g. "9820012345" -> "919820012345"
     */
    function clean_whatsapp_number(?string $number): string
    {
        if (empty($number)) {
            return '919820012345';
        }
        $digits = preg_replace('/[^0-9]/', '', $number);

        // Prepend India country code 91 if only 10 digits provided
        if (strlen($digits) === 10) {
            $digits = '91' . $digits;
        }

        return $digits;
    }
}

if (!function_exists('business_contact')) {
    /**
     * Retrieve the centralized business contact & footer settings singleton.
     * Cached statically in memory to prevent duplicate DB queries during request.
     */
    function business_contact(bool $forceRefresh = false): array
    {
        static $cachedSettings = null;

        if ($cachedSettings !== null && !$forceRefresh) {
            return $cachedSettings;
        }

        try {
            $model = new \App\Models\FooterSettingsModel();
            $cachedSettings = $model->getSettings();
        } catch (\Throwable $e) {
            $cachedSettings = [
                'concierge_phone'    => '+91 98200 12345',
                'concierge_whatsapp' => '+91 98200 12345',
                'concierge_email'    => 'glowup@gmail.com',
                'concierge_address'  => "Flagship Academy:\n12 Madurai, Tamil Nadu",
                'concierge_hours'    => 'Tue – Sun: 10:00 AM – 8:00 PM',
            ];
        }

        return $cachedSettings;
    }
}

if (!function_exists('business_phone')) {
    /**
     * Get the business phone number string (from Database/CMS).
     */
    function business_phone(): string
    {
        $contact = business_contact();
        return !empty($contact['concierge_phone']) ? $contact['concierge_phone'] : '+91 98200 12345';
    }
}

if (!function_exists('business_whatsapp')) {
    /**
     * Get the business WhatsApp number string (from Database/CMS).
     * Falls back to concierge_phone if not distinct.
     */
    function business_whatsapp(): string
    {
        $contact = business_contact();
        if (!empty($contact['concierge_whatsapp'])) {
            return $contact['concierge_whatsapp'];
        }
        return business_phone();
    }
}

if (!function_exists('business_phone_url')) {
    /**
     * Generate clickable tel: link for phone dialers.
     * E.g. "tel:+919820012345"
     */
    function business_phone_url(?string $phone = null): string
    {
        return 'tel:' . clean_phone_number($phone ?: business_phone());
    }
}

if (!function_exists('business_whatsapp_url')) {
    /**
     * Generate clickable WhatsApp link using official click-to-chat format:
     * https://wa.me/{business_number}?text={encoded_message}
     */
    function business_whatsapp_url(?string $message = null, ?string $number = null): string
    {
        $cleanNumber = clean_whatsapp_number($number ?: business_whatsapp());
        $url = 'https://wa.me/' . $cleanNumber;

        if ($message !== null && trim($message) !== '') {
            $url .= '?text=' . rawurlencode(trim($message));
        }

        return $url;
    }
}

if (!function_exists('glowup_whatsapp_icon')) {
    /**
     * Render an accessible, crisp inline SVG WhatsApp icon.
     */
    function glowup_whatsapp_icon(string $class = '', int $size = 18): string
    {
        return '<svg class="' . esc($class, 'attr') . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M12.031 2C6.511 2 2.016 6.496 2.016 12.015c0 1.988.583 3.843 1.594 5.409L2 22l4.742-1.57a9.98 9.98 0 0 0 5.289 1.586c5.52 0 10.015-4.496 10.015-10.015C22.046 6.496 17.551 2 12.031 2zm0 18.25c-1.636 0-3.177-.45-4.512-1.233l-.324-.189-3.359 1.111 1.117-3.267-.209-.344a8.212 8.212 0 0 1-1.272-4.313c0-4.549 3.702-8.25 8.259-8.25 4.557 0 8.258 3.701 8.258 8.25 0 4.549-3.701 8.25-8.258 8.25zm4.526-6.177c-.248-.124-1.467-.724-1.695-.807-.228-.083-.394-.124-.56.124-.166.248-.642.807-.787.973-.145.166-.29.187-.539.062-.248-.124-1.047-.386-1.996-1.232-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.112.249-.29.373-.435.124-.145.166-.248.249-.414.083-.166.041-.311-.021-.435-.062-.124-.56-1.349-.767-1.847-.202-.485-.407-.419-.56-.427-.145-.008-.311-.01-.477-.01s-.435.062-.663.311c-.228.248-.871.851-.871 2.074s.892 2.404 1.016 2.57c.124.166 1.753 2.678 4.248 3.756.594.257 1.058.41 1.42.525.597.189 1.14.163 1.569.098.479-.072 1.467-.6 1.674-1.179.207-.579.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"/></svg>';
    }
}

if (!function_exists('glowup_instagram_icon')) {
    /**
     * Render an accessible, crisp inline SVG Instagram icon.
     */
    function glowup_instagram_icon(string $class = '', int $size = 18): string
    {
        return '<svg class="' . esc($class, 'attr') . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>';
    }
}

if (!function_exists('glowup_facebook_icon')) {
    /**
     * Render an accessible, crisp inline SVG Facebook icon.
     */
    function glowup_facebook_icon(string $class = '', int $size = 18): string
    {
        return '<svg class="' . esc($class, 'attr') . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>';
    }
}

if (!function_exists('glowup_youtube_icon')) {
    /**
     * Render an accessible, crisp inline SVG YouTube icon.
     */
    function glowup_youtube_icon(string $class = '', int $size = 18): string
    {
        return '<svg class="' . esc($class, 'attr') . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>';
    }
}

if (!function_exists('glowup_pinterest_icon')) {
    /**
     * Render an accessible, crisp inline SVG Pinterest icon.
     */
    function glowup_pinterest_icon(string $class = '', int $size = 18): string
    {
        return '<svg class="' . esc($class, 'attr') . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12.004-5.378 12.004-12.004C24.021 5.367 18.644 0 12.017 0z"/></svg>';
    }
}
