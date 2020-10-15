<?php


namespace App\Helpers;


class EncodeHelper
{
    //relpace + with -. / with _ and delete =
    //return base64_encoded string
    public function base64UrlEncode($string)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($string)
        );
    }
}
