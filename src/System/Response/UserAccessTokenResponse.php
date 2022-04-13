<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:01
 */

namespace Eccang\OpenApi\System\Response;


use Eccang\OpenApi\Contracts\Response;
use Eccang\OpenApi\Exception\ValidateResponseException;

class UserAccessTokenResponse extends Response
{
    /**
     * @return string
     */
    public function getUserAccessToken()
    {
        return $this->getData()['accessToken'] ?? '';
    }

    /**
     * @return string
     */
    public function getExpires()
    {
        return $this->getData()['expires'] ?? '';
    }

    /**
     * @return string
     */
    public function getOpenid()
    {
        return $this->getData()['openid'] ?? '';
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        parent::validate();
        $data = $this->getData();
        if (!isset($data['accessToken']) || empty($data['accessToken']))
            throw new ValidateResponseException('accessToken 返回为空');

        if (!isset($data['openid']) || empty($data['openid']))
            throw new ValidateResponseException('openid 返回为空');
    }
}
