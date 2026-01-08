<?php
namespace Octocub\OneStepCheckout\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public function __construct(private ScopeConfigInterface $scopeConfig) {}

    private function get(string $path): string
    {
        return (string)$this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    public function enabled(): bool { return $this->get('octocub_osc/general/enabled') === '1'; }
    public function enableDelivery(): bool { return $this->get('octocub_osc/general/enable_delivery') === '1'; }
    public function enableSecurityBadges(): bool { return $this->get('octocub_osc/general/enable_security_badges') === '1'; }
    public function badgesHtml(): string { return $this->get('octocub_osc/general/badges_html'); }
    public function thankyouEnabled(): bool { return $this->get('octocub_osc/general/thankyou_enable_blocks') === '1'; }
}
