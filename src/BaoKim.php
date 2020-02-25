<?php

namespace BaoKimSDK;

require_once(__DIR__ . '/../vendor/autoload.php');

use Firebase\JWT\JWT;

class BaoKim {
    public static $key;
    public static $secret;
    public static $_jwt;
    const TOKEN_EXPIRE = 86400; //token expire time in seconds
    const ENCODE_ALG = 'HS256';

    public static function setKey($key, $secret)
    {
        self::$key = $key;
        self::$secret = $secret;
        self::getToken();
    }

    public static function getKey()
    {
        return self::$_jwt;
    }

    public static function refreshToken($key, $sec){

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
		self::$_jwt = JWT::encode(
			$data,      //Data to be encoded in the JWT
			$sec, // The signing key
			'HS256'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
		);

		return self::$_jwt;
	}

	/**
	 * Get JWT
	 */
	public static function getToken(){
		if(!self::$_jwt)
			self::refreshToken(self::$key, self::$secret);

		try {
			JWT::decode(self::$_jwt, self::$secret, array('HS256'));
		}catch(Exception $e){
			self::refreshToken(self::$key, self::$$secret);
		}

		return self::$_jwt;
	}
}
?>
