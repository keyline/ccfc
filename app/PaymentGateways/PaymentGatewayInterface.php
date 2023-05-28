<?php
namespace App\PaymentGateways;

interface PaymentGatewayInterface
{
    public function processPayment($amount,$user);
    
    public function verifyPayment($response);
}