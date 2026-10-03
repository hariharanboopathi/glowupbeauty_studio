<?php
/**
 * Glowup Dynamic SEO Meta Partial
 * Automatically loads database-managed SEO metadata for the current public page.
 * Provides safe fallback if record or fields are not set.
 */

$pageKey = $pageKey ?? 'home';

try {
    $seoModel = new \App\Models\SeoModel();
    $seoData  = $seoModel->getByPageKey($pageKey);
} catch (\Throwable $e) {
    $seoData = null;
}

// 1. Title Resolution
$title = !empty($seoData['seo_title']) 
    ? $seoData['seo_title'] 
    : (!empty($fallbackTitle) ? $fallbackTitle : 'Glowup Beauty Studio & Academy | Luxury Wellness & Haircare');

// 2. Meta Description Resolution
$description = !empty($seoData['meta_description']) 
    ? $seoData['meta_description'] 
    : (!empty($fallbackDesc) ? $fallbackDesc : 'Premium beauty treatments, clinical facials, and transformative hair alchemy curated within an architectural academy of stillness in Madurai.');

// 3. Meta Keywords Resolution
$keywords = !empty($seoData['meta_keywords']) ? trim($seoData['meta_keywords']) : null;

// 4. Canonical URL Resolution
$canonical = !empty($seoData['canonical_url']) 
    ? $seoData['canonical_url'] 
    : current_url();

// 5. Robots Directive Resolution
$robots = !empty($seoData['robots']) ? trim($seoData['robots']) : 'index, follow';

// 6. Open Graph & Twitter Cards Resolution
$ogTitle = !empty($seoData['og_title']) ? $seoData['og_title'] : $title;
$ogDesc  = !empty($seoData['og_description']) ? $seoData['og_description'] : $description;

$rawOgImage = !empty($seoData['og_image']) ? $seoData['og_image'] : 'assets/images/Glowup_Logo_Black_White.png';
$ogImage = (str_starts_with($rawOgImage, 'http://') || str_starts_with($rawOgImage, 'https://'))
    ? $rawOgImage
    : base_url(ltrim($rawOgImage, '/'));
?>
<title><?= esc($title) ?></title>
<meta name="description" content="<?= esc($description) ?>" />
<?php if (!empty($keywords)): ?>
<meta name="keywords" content="<?= esc($keywords) ?>" />
<?php endif; ?>
<link rel="canonical" href="<?= esc($canonical) ?>" />
<meta name="robots" content="<?= esc($robots) ?>" />

<!-- Favicon (Absolute Path / High-Performance / Cache-Friendly) -->
<link rel="icon" type="image/png" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>" />
<link rel="apple-touch-icon" href="<?= base_url('assets/images/Glowup_Favicon_512.png') ?>" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= esc(current_url()) ?>" />
<meta property="og:title" content="<?= esc($ogTitle) ?>" />
<meta property="og:description" content="<?= esc($ogDesc) ?>" />
<meta property="og:image" content="<?= esc($ogImage) ?>" />

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="<?= esc(current_url()) ?>" />
<meta name="twitter:title" content="<?= esc($ogTitle) ?>" />
<meta name="twitter:description" content="<?= esc($ogDesc) ?>" />
<meta name="twitter:image" content="<?= esc($ogImage) ?>" />
