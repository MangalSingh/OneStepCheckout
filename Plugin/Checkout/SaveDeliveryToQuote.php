<?php
namespace Octocub\OneStepCheckout\Plugin\Checkout;

use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Quote\Api\CartRepositoryInterface;

class SaveDeliveryToQuote
{
    public function __construct(private CartRepositoryInterface $quoteRepository) {}

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $ext = $addressInformation->getExtensionAttributes();
        if (!$ext) return;

        $quote = $this->quoteRepository->getActive($cartId);

        $date = method_exists($ext, 'getOctocubDeliveryDate') ? $ext->getOctocubDeliveryDate() : null;
        $time = method_exists($ext, 'getOctocubDeliveryTime') ? $ext->getOctocubDeliveryTime() : null;

        if ($date) $quote->setData('octocub_delivery_date', $date);
        if ($time) $quote->setData('octocub_delivery_time', $time);

        if ($date || $time) {
            $this->quoteRepository->save($quote);
        }
    }
}
