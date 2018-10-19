<?php
/**
 * User: qbhy
 * Date: 2018/10/16
 * Time: 上午11:12
 */

return [
    'secret'       => env('HYID_SECRET'),
    'offset'       => env('HYID_OFFSET'),
    'randomLength' => env('HYID_RANDOM_LENGTH', 4),
];