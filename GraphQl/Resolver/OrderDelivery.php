<?php
namespace Octocub\OneStepCheckout\GraphQl\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class OrderDelivery implements ResolverInterface
{
    public function resolve($field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $order = $value['model'] ?? null;
        if (!$order) return null;

        return [
            'delivery_date' => $order->getData('octocub_delivery_date'),
            'delivery_time' => $order->getData('octocub_delivery_time'),
        ];
    }
}
