<?php
namespace Octocub\OneStepCheckout\Block\Success;

use Magento\Checkout\Block\Onepage\Success as CoreSuccess;
use Octocub\OneStepCheckout\Model\Config;

class ThankYou extends CoreSuccess
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Sales\Model\Order\Config $orderConfig,
        \Magento\Framework\App\Http\Context $httpContext,
        private Config $config,
        array $data = []
    ) {
        parent::__construct($context, $checkoutSession, $orderConfig, $httpContext, $data);
    }

    public function enabled(): bool
    {
        return $this->config->enabled() && $this->config->thankyouEnabled();
    }
}
