<?php

// return [
//     'USD' => 1.00,
//     'EUR' => 0.85,
//     'GBP' => 0.72,
//     'JPY' => 110.50,
//     'EGP' => 15.70,
//     'AUD' => 1.30,
//     'CAD' => 1.25,
//     'CHF' => 0.92,
//     'CNY' => 6.45,
//     'INR' => 74.00,
//     'MXN' => 20.00,
//     'BRL' => 5.00,
//     'RUB' => 73.50,
//     'ZAR' => 14.50,
//     'SGD' => 1.35,
//     'HKD' => 7.75,
//     'KRW' => 1150.00,
//     'TRY' => 8.60,
//     'AED' => 3.67,
//     'SAR' => 3.75,
// ];
return json_decode(file_get_contents(__DIR__ . '/exchange_rates.json'), true);


?>
