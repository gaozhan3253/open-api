<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:14
 */

namespace Eccang\OpenApi\System\Request;


use Eccang\OpenApi\Contracts\Request;
use Eccang\OpenApi\Exception\ValidateRequestException;

class TenantAccessTokenRequest extends Request
{
    protected $apiUri = '/openApi/api/getTenantAccessToken';

    /**
     * @return mixed
     */
    public function getSubjectCode()
    {
        return $this->body['subjectCode'];
    }

    /**
     * @param $subjectCode
     * @return $this
     */
    public function setSubjectCode($subjectCode)
    {
        $this->body['subjectCode'] = $subjectCode;
        return $this;
    }

    /**
     * @return mixed|void
     * @throws ValidateRequestException
     */
    public function validate()
    {
        if (!isset($this->body['subjectCode']) || empty($this->body['subjectCode']))
            throw new ValidateRequestException('租户主体code 不能为空');
    }
}
