<?php
namespace Octocub\OneStepCheckout\Block\Checkout;

use Magento\Framework\View\Element\Template;
use Octocub\OneStepCheckout\Model\Config;

class SecurityBadges extends Template
{
    public function __construct(
        Template\Context $context,
        private Config $config,
        array $data = []
    ) { parent::__construct($context, $data); }

    public function canShow(): bool
    {
        return $this->config->enabled() && $this->config->enableSecurityBadges();
    }

    public function getBadgesHtml(): string
    {
        return $this->config->badgesHtml();
    }
}
