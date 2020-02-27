<?php
//namespace Exceptions;
//use Exceptions\AbstractException;
//
//class AppException extends AbstractException
//{
//	const ERR_NONE = 0;
//	const ERR_SYSTEM = 1;
//	const ERR_VALIDATION = 2;
//	const ERR_OBJECT_NOT_FOUND = 3;
//	const ERR_ACCOUNT_LOCKED = 4;
//	const ERR_UNAUTHORIZED = 5;
//	const ERR_INVALID_AMOUNT = 6;
//
//	public function __construct($code = null, $message = '', $data = [])
//	{
//		if (!$message) {
//			$message = trans('exception.'.$code, $data);
//		}
//
//		if (!$code) {
//			$code = Response::HTTP_NOT_FOUND;
//		}
//		parent::__construct($code, $message);
//	}
//}
