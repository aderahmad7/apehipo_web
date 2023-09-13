<?php

namespace App\Controllers;
use Midtrans\Config;

class Payment extends BaseController {
    public function index()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-0cy8q6NmjTgIpWcuHr8uqrUJ';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );

        $midtransToken= \Midtrans\Snap::getSnapToken($params);
        $data = [
            'midtransToken' => $midtransToken,
        ];
        return view('pay', $data);
    }
}