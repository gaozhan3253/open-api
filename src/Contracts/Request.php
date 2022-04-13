<?php

namespace Eccang\OpenApi\Contracts;


use Eccang\OpenApi\Exception\ValidateRequestException;

abstract class Request
{
    /**
     * @var array 请求头
     */
    protected $headers = [];

    /**
     * @var array 请求体
     */
    protected $body = ['version' => 'V1.0.0'];

    /**
     * @var string 请求方式
     */
    protected $method = 'POST';

    /**
     * @var string 请求数据格式
     */
    protected $dataType = 'JSON';

    /**
     * @var string 接口地址
     */
    protected $apiUri = '';

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @return string
     */
    public function getApiUri()
    {
        return $this->apiUri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $fieldName
     * @param $field
     * @param null $val
     * @throws ValidateRequestException
     */
    public function validateRequired($fieldName, $field, $val = null)
    {
        if (true === $val && null === $field) {
            throw new ValidateRequestException($fieldName . ' is required');
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param null $val
     * @throws ValidateRequestException
     */
    public function validateMaxLength($fieldName, $field, $val = null)
    {
        if (null !== $field && \strlen($field) > (int)$val) {
            throw new ValidateRequestException($fieldName . ' is exceed max-length: ' . $val);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param null $val
     * @throws ValidateRequestException
     */
    public function validateMinLength($fieldName, $field, $val = null)
    {
        if (null !== $field && \strlen($field) < (int)$val) {
            throw new ValidateRequestException($fieldName . ' is less than min-length: ' . $val);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param string $regex
     * @throws ValidateRequestException
     */
    public function validatePattern($fieldName, $field, $regex = '')
    {
        if (null !== $field && '' !== $field && !preg_match("/^{$regex}$/", $field)) {
            throw new ValidateRequestException($fieldName . ' is not match ' . $regex);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     * @throws ValidateRequestException
     */
    public static function validateMaximum($fieldName, $field, $val)
    {
        if (null !== $field && $field > $val) {
            throw new ValidateRequestException($fieldName . ' cannot be greater than ' . $val);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     * @throws ValidateRequestException
     */
    public function validateMinimum($fieldName, $field, $val)
    {
        if (null !== $field && $field < $val) {
            throw new ValidateRequestException($fieldName . ' cannot be less than ' . $val);
        }
    }

    /**
     * @return mixed
     */
    abstract public function validate();
}
