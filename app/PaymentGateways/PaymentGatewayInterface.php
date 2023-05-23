<?php
namespace App\PaymentGateways;

interface PaymentGatewayInterface
{
    public function processPayment($amount);
    
    public function verifyPayment($response);
}