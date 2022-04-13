<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:13
 */

namespace Eccang\OpenApi\System\Request;


use Eccang\OpenApi\Contracts\Request;
use Eccang\OpenApi\Exception\ValidateRequestException;

class BaseUserInfoRequest extends Request
{
    protected $apiUri = '/openApi/api/getBaseUserInfo';

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->body['token'];
    }

    /**
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->body['token'] = $token;
        return $this;
    }

    /**
     * @return mixed|void
     * @throws ValidateRequestException
     */
    public function validate()
    {
        if (!isset($this->body['token']) || empty($this->body['token']))
            throw new ValidateRequestException('token 不能为空');
    }
}
