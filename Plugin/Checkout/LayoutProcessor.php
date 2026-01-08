<?php
namespace Octocub\OneStepCheckout\Plugin\Checkout;

use Octocub\OneStepCheckout\Model\Config;

class LayoutProcessor
{
    public function __construct(private Config $config) {}

    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, array $jsLayout): array
    {
        if (!$this->config->enabled()) {
            return $jsLayout;
        }

        $steps =& $jsLayout['components']['checkout']['children']['steps']['children'] ?? null;
        if (!$steps || !isset($steps['shipping-step'])) {
            return $jsLayout;
        }

        if (isset($steps['billing-step']['children']['payment'])) {
            $steps['shipping-step']['children']['payment'] = $steps['billing-step']['children']['payment'];
            unset($steps['billing-step']);
        }

        if ($this->config->enableDelivery()) {
            $fieldset =& $steps['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];
            if (is_array($fieldset) && !isset($fieldset['octocub_delivery_fields'])) {
                $fieldset['octocub_delivery_fields'] = [
                    'component' => 'Octocub_OneStepCheckout/js/view/delivery-fields',
                    'sortOrder' => 245,
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'Octocub_OneStepCheckout/delivery-fields',
                    ],
                ];
            }
        }

        return $jsLayout;
    }
}
