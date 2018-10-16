<?php
/**
 * User: qbhy
 * Date: 2018/10/13
 * Time: 下午6:01
 */

namespace Qbhy\Hyid;

use Qbhy\Hyid\Exceptions\HyidException;

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

    /**
     * @var Base64UrlSafeEncoder
     */
    protected $encoder;

    public function __construct(string $secret, int $offset)
    {
        $this->secret  = $secret;
        $this->offset  = $offset;
        $this->encoder = new Base64UrlSafeEncoder();
    }

    /**
     * @param   int  $id
     * @param string $prefix
     *
     * @return string
     * @throws \Exception
     */
    public function encode($id, string $prefix = '')
    {
        $offsetId        = $id + $this->offset;
        $rand            = random_int(1000, 9999);
        $signatureString = $prefix . $rand . $offsetId;
        $signature       = $this->signature($signatureString);
        $header          = substr($signature, $this->offset % 2, strlen($rand . $offsetId));

        return $this->encoder->encode($header . '.' . $signatureString);
    }

    /**
     * @param string $encodedId
     * @param string $prefix
     *
     * @return int
     * @throws HyidException
     */
    public function decode(string $encodedId, string $prefix = '')
    {
        $raw = $this->encoder->decode($encodedId);

        $attrs = explode('.', $raw);

        if (count($attrs) !== 2) {
            throw new HyidException('hyid exception!');
        }

        list($header, $signatureString) = $attrs;

        $offsetId = substr($signatureString, strlen($prefix) + 4);

        $this->checkHeader($header, $signatureString, strlen($offsetId));

        return $offsetId - $this->offset;
    }

    protected function signature($signatureString)
    {
        return hash_hmac('SHA256', $signatureString, $this->secret, true);
    }

    protected function checkHeader($header, $signatureString, $offsetLen)
    {
        $signature = $this->signature($signatureString);
        if ($header !== substr($signature, $this->offset % 2, 4 + $offsetLen)) {
            throw new HyidException('hyid header exception');
        }
    }

    /**
     * @return Base64UrlSafeEncoder
     */
    public function getEncoder(): Base64UrlSafeEncoder
    {
        return $this->encoder;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}