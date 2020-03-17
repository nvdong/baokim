<?php
use BaoKimSDK\Exceptions\BaoKimException;
    $trans = [
        BaoKimException::ERR_VALIDATE =>    'Dữ liệu gửi lên không hợp lệ',
        BaoKimException::ERR_SYSTEM =>    'Lỗi hệ thống',
        BaoKimException::ERR_ITEM_INVALID =>    'Dữ liệu item không hợp lệ',
        BaoKimException::ERR_SESSION_EXIST =>    'Phiên thanh toán đã tồn tại',
        BaoKimException::ERR_ACCOUNT_LOCKED =>    'Tài khoản bị khoá',
        BaoKimException::ERR_USER_NOT_VERIFIED =>    'Tài khoản chưa xác thực',
        BaoKimException::ERR_UNAUTHORIZED =>    'Lỗi chưa được cấp phép hoặc không xác thực được user',
    ];
?>
