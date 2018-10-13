<?php
/**
 * User: qbhy
 * Date: 2018/10/13
 * Time: 下午6:01
 */

namespace Qbhy\Hyid\Hyid;

class Hyid
{
    /**
     * @var string
     */
    protected $secret;

    /**
     * @var int
     */
    protected $offset;

    public function __construct(string $secret, int $offset)
    {
        $this->secret = $secret;
        $this->offset = $offset;
    }

    public function encode($id)
    {
        $offsetId = $id + $this->offset;
        $rand     = random_int(1000, 9999);



    }

    public function decode($encodedId)
    {

    }

    protected function signature($id)
    {
        return $id;
    }
}