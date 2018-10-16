<?php
/**
 * User: qbhy
 * Date: 2018/10/16
 * Time: 下午10:26
 */

namespace Qbhy\Hyid;


class Base64UrlSafeEncoder
{
    public function encode(string $string): string
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    public function decode(string $string): string
    {
        return base64_decode(strtr($string, '-_', '+/'));
    }
}
