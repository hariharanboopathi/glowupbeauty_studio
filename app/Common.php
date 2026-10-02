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
        return '<svg class="' . esc($class) . '" width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align: middle; display: inline-block;"><path d="M12.031 2C6.511 2 2.016 6.496 2.016 12.015c0 1.988.583 3.843 1.594 5.409L2 22l4.742-1.57a9.98 9.98 0 0 0 5.289 1.586c5.52 0 10.015-4.496 10.015-10.015C22.046 6.496 17.551 2 12.031 2zm0 18.25c-1.636 0-3.177-.45-4.512-1.233l-.324-.189-3.359 1.111 1.117-3.267-.209-.344a8.212 8.212 0 0 1-1.272-4.313c0-4.549 3.702-8.25 8.259-8.25 4.557 0 8.258 3.701 8.258 8.25 0 4.549-3.701 8.25-8.258 8.25zm4.526-6.177c-.248-.124-1.467-.724-1.695-.807-.228-.083-.394-.124-.56.124-.166.248-.642.807-.787.973-.145.166-.29.187-.539.062-.248-.124-1.047-.386-1.996-1.232-.738-.658-1.236-1.472-1.381-1.72-.145-.248-.016-.382.108-.506.112-.112.249-.29.373-.435.124-.145.166-.248.249-.414.083-.166.041-.311-.021-.435-.062-.124-.56-1.349-.767-1.847-.202-.485-.407-.419-.56-.427-.145-.008-.311-.01-.477-.01s-.435.062-.663.311c-.228.248-.871.851-.871 2.074s.892 2.404 1.016 2.57c.124.166 1.753 2.678 4.248 3.756.594.257 1.058.41 1.42.525.597.189 1.14.163 1.569.098.479-.072 1.467-.6 1.674-1.179.207-.579.207-1.077.145-1.179-.062-.102-.228-.166-.476-.29z"/></svg>';
    }
}
