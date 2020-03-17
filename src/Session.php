<?php
namespace BaokimSDK;
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../config/config.php');
use BaokimSDK\BaoKim;
use BaoKimSDK\Exceptions\BaoKimException;
use \GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Session {
    const ERR_NONE = 0;

    /**
     * Create session checkout
     * @param $data["mrc_order_id"] string required
     * @param $data["payment_method_types"] array required [1,2,3]
     * @param $data["line_items"] array required
     * @param $data["success_url"] string|url required
     * @param $data["cancel_url"] string|url optional
     * @param $data["webhook_url"] string|url required
     * @param $data["customer_email"] string|email required
     * @param $data["customer_phone"] string required
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function create($data) {
        $client = new Client(['timeout' => 20.0]);
        $options['query']['jwt'] = BaoKim::$_jwt;
        $options['form_params'] = $data;
        try{
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
                throw new \BaoKimException($body->code, $msg);
            }

            return $body->data;
        } catch (\Exception $e) {
            throw new BaoKimException(BaoKimException::ERR_SYSTEM, $e->getMessage());
        }
    }
}
?>
