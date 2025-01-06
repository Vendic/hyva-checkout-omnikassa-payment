<?php

/**
 * @copyright   Copyright (c) Vendic B.V https://vendic.nl/
 */

declare(strict_types=1);

namespace Vendic\HyvaCheckoutOmnikassapayment\Service;

use Hyva\Checkout\Model\Magewire\Payment\AbstractOrderData;
use Hyva\Checkout\Model\Magewire\Payment\AbstractPlaceOrderService;
use Magento\Framework\UrlInterface;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Model\Quote;

class PlaceOrderService extends AbstractPlaceOrderService
{
    public function __construct(
        private UrlInterface $url,
        CartManagementInterface $cartManagement,
        AbstractOrderData $orderData = null
    ) {
        parent::__construct($cartManagement, $orderData);
    }

    public function getRedirectUrl(Quote $quote, ?int $orderId = null): string
    {
        return $this->url->getUrl('omnikassa/checkout/start', [
            '_query' => [
                'timestamp' => time(),
            ]
        ]);
    }
}
