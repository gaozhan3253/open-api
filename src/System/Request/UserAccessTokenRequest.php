<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:00
 */

namespace Eccang\OpenApi\System\Request;


use Eccang\OpenApi\Contracts\Request;
use Eccang\OpenApi\Exception\ValidateRequestException;

class UserAccessTokenRequest extends Request
{
    protected $apiUri = '/openApi/api/getUserAccessToken';

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->body['code'];
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
     * @return mixed|void
     * @throws ValidateRequestException
     */
    public function validate()
    {
        if (!isset($this->body['code']) || empty($this->body['code']))
            throw new ValidateRequestException('code 不能为空');
    }
}
