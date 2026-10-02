<?php
/**
 * Glowup Luxury Floating Contact Dock
 * Real customer communication actions: Click-to-Dial Phone & Click-to-Chat WhatsApp
 * Positioned cleanly without obstructing content.
 */
?>
<!-- FLOATING CONTACT DOCK -->
<aside class="glowup-floating-dock" aria-label="Quick Concierge Contact Actions">
    <!-- Call Action -->
    <a href="<?= business_phone_url() ?>" 
       class="dock-action-btn dock-btn-call" 
       aria-label="Call Glowup Studio Concierge at <?= esc(business_phone()) ?>" 
       title="Call Concierge: <?= esc(business_phone()) ?>">
        <span class="material-symbols-outlined" style="font-size: 17px; color: var(--accent);">call</span>
        <span class="dock-text">Call</span>
    </a>

    <!-- WhatsApp Action -->
    <a href="<?= business_whatsapp_url('Hello Glowup Studio, I would like to enquire about your services.') ?>" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="dock-action-btn dock-btn-wa" 
       aria-label="Chat with Glowup Studio on WhatsApp" 
       title="Chat with Glowup Studio on WhatsApp">
        <?= glowup_whatsapp_icon('', 17) ?>
        <span class="dock-text">WhatsApp</span>
    </a>
</aside>
