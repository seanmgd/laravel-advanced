<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class OrderDetails
{
    private $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function completeOrder()
    {
        $this->paymentGateway->setDiscount(500);

        return [
            'order_infos' => 'foo',
            'address_shipping' => 'bar',
        ];
    }
}
