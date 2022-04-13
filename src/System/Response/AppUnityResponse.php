<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:00
 */

namespace Eccang\OpenApi\System\Response;


use Eccang\OpenApi\Contracts\Response;
use Eccang\OpenApi\Exception\ValidateResponseException;

class AppUnityResponse extends Response
{
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->body['version'] ?? '';
    }

    /**
     * @return array|mixed
     */
    public function getData()
    {
        return $this->body['biz_content']['data'] ?? [];
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->body['biz_content']['total'] ?? 0;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->body['biz_content']['page'] ?? 1;
    }

    /**
     * @return string
     */
    public function getPageSize()
    {
        return $this->body['biz_content']['page_size'] ?? '';
    }

    /**
     * @param $body
     * @return $this|Response
     */
    public function setBody($body)
    {
        $this->body = $body;
        $this->body['biz_content'] = $this->body['biz_content'] ? json_decode($this->body['biz_content'], true) : [];
        return $this;
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        parent::validate();
        if (empty($this->body['biz_content']))
            throw new ValidateResponseException('biz_content 返回为空');
    }
}
