<?php
namespace BaoKimSDK;
class Webhook {
    public $sec;

    public function __construct($sec)
    {
        $this->sec = $sec;
    }

    public function verify($jsonWebhookData)
    {
        $webhookData = json_decode($jsonWebhookData, true);

        $baokimSign = $webhookData['sign'];
        unset($webhookData['sign']);

        $signData = json_encode($webhookData);

        $secret = $this->sec;
        $mySign = hash_hmac('sha256', $signData, $secret);

        return $baokimSign == $mySign;
    }
}

?>