<?php

namespace App\Models;

class FooterModel
{
    protected FooterSettingsModel $settingsModel;
    protected FooterLinkModel $linkModel;

    public function __construct()
    {
        $this->settingsModel = new FooterSettingsModel();
        $this->linkModel     = new FooterLinkModel();
    }

    /**
     * Get complete footer data structure for frontend rendering.
     */
    public function getFooterData(): array
    {
        return [
            'settings'           => $this->settingsModel->getSettings(),
            'quick_links'        => $this->linkModel->getActiveByGroup('quick_links'),
            'popular_treatments' => $this->linkModel->getActiveByGroup('popular_treatments'),
        ];
    }

    /**
     * Get complete footer data structure for admin management.
     */
    public function getAdminFooterData(): array
    {
        return [
            'settings'           => $this->settingsModel->getSettings(),
            'quick_links'        => $this->linkModel->getAllByGroup('quick_links'),
            'popular_treatments' => $this->linkModel->getAllByGroup('popular_treatments'),
        ];
    }
}
