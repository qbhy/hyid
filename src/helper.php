<?php
/**
 * User: qbhy
 * Date: 2018/10/13
 * Time: 下午5:46
 */


if (!function_exists('hyid')) {
    /**
     * @param int|null $id
     *
     * @return \Qbhy\Hyid\Hyid|string
     * @throws Exception
     */
    function hyid($id = null)
    {
        /** @var \Qbhy\Hyid\Hyid $hyid */
        $hyid = app('hyid');

        if (is_null($id)) {
            return $hyid;
        }

        return $hyid->encode((int) $id);
    }
}

