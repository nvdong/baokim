<?php

namespace BaoKimSDK;

require_once(__DIR__ . './../vendor/autoload.php');
require_once(__DIR__ . './../config/config.php');

use Firebase\JWT\JWT;

class BaoKim {
    public $key;
    public $secret;
    public $_jwt;
    const TOKEN_EXPIRE = 86400; //token expire time in seconds
    const ENCODE_ALG = 'HS256';
    const ERR_NONE = 0;

    public function __construct($key, $sec)
    {
        $this->key = $key;
        $this->secret = $sec;
        return (self::getToken());
    }

    public function create($data) {
        $client = new GuzzleHttp\Client(['timeout' => 20.0]);
        $options['query']['jwt'] = $this->_jwt;

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

        header("Location: " . $body->data->payment_url);
    }

    public function refreshToken($key, $sec){

		$tokenId    = base64_encode(random_bytes(32));
		$issuedAt   = time();
		$notBefore  = $issuedAt;
		$expire     = $notBefore + self::TOKEN_EXPIRE;

		/*
		 * Payload data of the token
		 */
		$data = [
			'iat'  => $issuedAt,         // Issued at: time when the token was generated
			'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
			'iss'  => $key,     // Issuer
			'nbf'  => $notBefore,        // Not before
			'exp'  => $expire,           // Expire
			'form_params' => [
			]
		];

		/*
		 * Encode the array to a JWT string.
		 * Second parameter is the key to encode the token.
		 *
		 * The output string can be validated at http://jwt.io/
		 */
		$this->_jwt = JWT::encode(
			$data,      //Data to be encoded in the JWT
			$sec, // The signing key
			'HS256'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
		);

		return $this->_jwt;
	}

	/**
	 * Get JWT
	 */
	public function getToken(){
		if(!$this->_jwt)
			self::refreshToken($this->key, $this->secret);

		try {
			JWT::decode($this->_jwt, $this->secret, array('HS256'));
		}catch(Exception $e){
			self::refreshToken($this->key, $this->secret);
		}

		return $this->_jwt;
	}
}
?>
