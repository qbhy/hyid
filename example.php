<?php
/**
 * User: qbhy
 * Date: 2018/10/16
 * Time: 下午2:34
 */

require 'vendor/autoload.php';

$hyid    = new \Qbhy\Hyid\Hyid('qbhy', 1996, 6);
$encoder = new \Qbhy\Hyid\Base64UrlSafeEncoder();
$n       = 100;
while ($n--) {
    try {
        ($encoded = $hyid->encode(10086));
        var_dump($id = $hyid->decode($encoded));
    } catch (\Qbhy\Hyid\Exceptions\HyidException $exception) {
        var_dump($encoder->decode($encoded));
    }
}

