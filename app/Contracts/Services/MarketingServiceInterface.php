<?php

namespace App\Contracts\Services;

interface MarketingServiceInterface
{
    public function sendNewsletter(int $campaignId);

    public function trackCampaignOpen(int $campaignId, int $subscriberId);

    public function trackCampaignClick(int $campaignId, int $subscriberId);

    public function getCampaignStats(int $campaignId);

    public function getSubscriberAnalytics();
}
