<?php
/**
 * Created by PhpStorm.
 * User: dale
 * Date: 10/26/18
 * Time: 9:49 AM
 */

namespace Exceptions;

use Exception;

class AbstractException extends Exception
{
	protected $code;
	protected $message = [];

	public function __construct($code = Response::HTTP_INTERNAL_SERVER_ERROR, $message = null)
	{
		$this->code = $code;
		$this->message = $message ?: 'Server Exception';

        parent::__construct($message, $code);
    }

	public function render()
	{
//		$json = [
//			'code' => $this->code,
//			'message' => [$this->message],
//			'data' => null,
//		];

		return "Khong ton tai";
	}

	public function report()
	{
		Log::debug($this->getMessage());
	}
}
