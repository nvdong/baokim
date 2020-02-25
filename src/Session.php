<?php
namespace BaokimSDK;
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../config/config.php');
use BaokimSDK\BaoKim;
use \GuzzleHttp\Client;

class Session {
    const ERR_NONE = 0;

    public static function create($data) {
        $client = new Client(['timeout' => 20.0]);
        $options['query']['jwt'] = BaoKim::$_jwt;
        $response = $client->request("POST", API_URL . BASE_URI, ['form_params' => $data]);
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

        return $body->data;
    }
}
?>
