<?php
namespace BaokimSDK;
require_once(__DIR__ . './../vendor/autoload.php');
require_once(__DIR__ . './../config/config.php');
use BaokimSDK\BaoKim;
use \GuzzleHttp\Client;

class Session {
    const ERR_NONE = 0;

    public static function create($data) {
        $client = new Client(['timeout' => 20.0]);
        $options['query']['jwt'] = BaoKim::$_jwt;

        $options['form_params'] = [
            'mrc_order_id'  =>  $data['mrc_order_id'],
            'payment_method_types'  =>  $data['payment_method_types'],
            'line_items'    =>  $data['line_items'],
            'success_url'   =>  $data['success_url'],
            'cancel_url'    =>  $data['cancel_url'],
            'webhook_url'   =>  $data['webhook_url'],
            'customer_email'    =>  $data['customer_email'],
            'customer_phone'    =>  $data['customer_phone'],
        ];
        $response = $client->request("POST", API_URL . BASE_URI, $options);
        $body = json_decode($response->getBody()->getContents());

        if(!isset($body->code) || $body->code != self::ERR_NONE){
            $body->message=(array)$body->message;
            $msg = '';
            $err_data=[];
            foreach($body->message as $row){
                if(is_array($row))
                    $msg.=implode(', ', $row);
                else
                    $err_data[]=$row;
            }
            $msg .=implode(', ', $err_data);
            throw new Exception($msg);
        }

        var_dump($body->data); die;
        return $body->data;
    }
}
?>
