<?php
    require_once(__DIR__ . '/src/BaoKim.php');
    require_once(__DIR__ . '/src/Session.php');
    require_once(__DIR__ . '/src/exceptions/BaoKimException.php');
    use BaoKimSDK\BaoKim;
    use BaoKimSDK\Session;
    try {
        BaoKim::setUrl('https://dev-api.baokim.vn');
        BaoKim::setKey('a18ff78e7a9e44f38de372e093d87ca1', '9623ac03057e433f95d86cf4f3bef5cc');
        $data = [
            'payment_method_types' => [1, 2, 3],
            'mrc_order_id' => 'mrcOrderId_' . time(),
            'line_items' => [
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
            'success_url' => 'https://example.com/success-url',
            'cancel_url' => 'https://example.com/cancel-url',
            'webhook_url' => 'https://example.com/webhook-url',
            'customer_email' => 'haumv174@gmail.com',
            'customer_phone' => '0397471667',
        ];

        var_dump(Session::create($data));
    } catch (Exceptions\BaoKimException $bke) {
        die($bke->getMessage());
    }
?>
