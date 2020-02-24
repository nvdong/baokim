<?php
    require_once('src/BaoKim.php');
    $bksdk = new BaoKim('a18ff78e7a9e44f38de372e093d87ca1', '9623ac03057e433f95d86cf4f3bef5cc');
//  echo BaoKim::getApiKey();
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

    $res = $bksdk->create($data);
    echo '<pre>';
    var_dump($res);
    echo '</pre>';
    die();
?>
