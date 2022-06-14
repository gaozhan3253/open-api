<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:00
 */

namespace Eccang\OpenApi\Contracts;

use Eccang\OpenApi\Exception\ValidateResponseException;
use Eccang\OpenApi\Utils\Tool;

class Response
{
    /**
     * @var array
     */
    protected $body = [
        'code' => 0,
        'message' => '',
        'data' => null
    ];

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->body['code'] ?? 0;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->body['code'] = $code;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getMessage()
    {
        return $this->body['message'] ?? '';
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->body['message'] = $message;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getData()
    {
        return $this->body['data'] ?? [];
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->body['data'] = $data;
        return $this;
    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $responseBody
     * @return Response
     */
    public static function format(array $responseBody = [])
    {
        $response = new static();
        $response->setBody($responseBody);
        $response->validate();
        return $response;
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        if ($this->getCode() != 200) {
            if (isset($this->getBody()['biz_content'][0]['error_code']) && $this->getBody()['biz_content'][0]['error_code'] != '') {
                $this->setCode($this->getBody()['biz_content'][0]['error_code']);
                $this->setMessage($this->getBody()['biz_content'][0]['error_msg']);
            }
            if (isset($this->getBody()['biz_content'][0]['errorCode']) && $this->getBody()['biz_content'][0]['errorCode'] != '') {
                $this->setCode($this->getBody()['biz_content'][0]['errorCode']);
                $this->setMessage($this->getBody()['biz_content'][0]['errorMsg']);
            }
            $message = '【' . $this->getCode() . '】' . $this->getMessage();
            throw new ValidateResponseException($message);
        }
    }
}
