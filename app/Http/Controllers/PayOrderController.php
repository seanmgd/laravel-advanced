<?php

namespace App\Http\Controllers;

use App\Services\OrderDetails;
use App\Interfaces\PaymentGatewayInterface;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGatewayInterface $paymentGateway)
    {
        $orderDetails->completeOrder(); // actually it just used to add discount but it must send all order infos
        dd($paymentGateway->charge(1000));
    }
}
