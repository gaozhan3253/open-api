<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:14
 */

namespace Eccang\OpenApi\System\Response;


use Eccang\OpenApi\Contracts\Response;
use Eccang\OpenApi\Exception\ValidateResponseException;

class TenantAccessTokenResponse extends Response
{
    /**
     * @return string
     */
    public function getTenantAccessToken()
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
    public function getScope()
    {
        return $this->getData()['scope'] ?? '';
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
    }
}
