<?php
    require_once(__DIR__ . '/src/BaoKim.php');
    require_once(__DIR__ . '/src/Session.php');
    use BaoKimSDK\BaoKim;
    use BaoKimSDK\Session;

    BaoKim::setKey('a18*****', '962*****');
    $data = [
        'payment_method_types'    => [1, 2, 3],
        'mrc_order_id'   =>  'mrcOrderId_' . time(),
        'line_items'  =>  [
            [
              'name' => 'T-shirt',
              'description' => 'Comfortable cotton t-shirt',
              'images' => ['https://example.com/t-shirt.png'],
              'amount' => 500000,
              'currency' => 'vnd',
              'quantity' => 1,
            ],
            [
              'name' => 'T-shirt',
              'description' => 'Comfortable cotton t-shirt',
              'images' => ['https://example.com/t-shirt.png'],
              'amount' => 100000,
              'currency' => 'vnd',
              'quantity' => 1,
            ]
        ],
        'success_url' =>  'https://example.com/success-url',
        'cancel_url' =>  'https://example.com/cancel-url',
        'webhook_url' =>  'https://example.com/webhook-url',
        'customer_email' =>  'haumv174@gmail.com',
        'customer_phone' => '0397471667',
    ];

    Session::create($data);
?>
