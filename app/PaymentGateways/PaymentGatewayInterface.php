<?php
interface PaymentGatewayInterface
{
    public function processPayment($amount);	
}