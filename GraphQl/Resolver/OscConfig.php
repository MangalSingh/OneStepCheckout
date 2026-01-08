<?php
namespace Octocub\OneStepCheckout\GraphQl\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Octocub\OneStepCheckout\Model\Config;

class OscConfig implements ResolverInterface
{
    public function __construct(private Config $config) {}

    public function resolve($field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return [
            'enabled' => $this->config->enabled(),
            'enable_delivery' => $this->config->enableDelivery(),
            'enable_security_badges' => $this->config->enableSecurityBadges(),
            'thankyou_enabled' => $this->config->thankyouEnabled(),
        ];
    }
}
