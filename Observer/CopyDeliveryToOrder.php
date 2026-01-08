<?php
namespace Octocub\OneStepCheckout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CopyDeliveryToOrder implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $order = $observer->getEvent()->getOrder();

        $date = (string)$quote->getData('octocub_delivery_date');
        $time = (string)$quote->getData('octocub_delivery_time');

        if ($date) $order->setData('octocub_delivery_date', $date);
        if ($time) $order->setData('octocub_delivery_time', $time);
    }
}
