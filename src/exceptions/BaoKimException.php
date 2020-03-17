<?php
namespace BaoKimSDK\Exceptions;
require_once(__DIR__ . '/../../langs/exceptions.php');
use Exception;

class BaoKimException extends Exception
{
    const ERR_NONE = 0;
    const ERR_SYSTEM = 1;
    const ERR_VALIDATE = 2;
    const ERR_ACCOUNT_LOCKED = 4;
    const ERR_UNAUTHORIZED = 5;
    const ERR_USER_NOT_VERIFIED = 16;
    const ERR_SESSION_EXIST = 200;
    const ERR_ITEM_INVALID = 201;

    public function __construct($code, $message = null)
    {
        global $trans;
        parent::__construct($message ?? $trans[$code], $code);
    }
}
?>
