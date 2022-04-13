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

class AppUnityRequest extends Request
{
    protected $apiUri = '/openApi/api/appUnity';

    public function __construct()
    {
        $this->body['timestamp'] = time() * 1000;
    }

    /**
     * @return mixed
     */
    public function getInterfaceMethod()
    {
        return $this->body['interface_method'] ?? '';
    }

    /**
     * @param $interfaceMethod
     * @return $this
     */
    public function setInterfaceMethod($interfaceMethod)
    {
        $this->body['interface_method'] = $interfaceMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->body['code'] ?? '';
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
     * @return mixed
     */
    public function getToken()
    {
        return $this->body['token'] ?? '';
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
     * @return mixed
     */
    public function getSubjectCode()
    {
        return $this->body['subject_code'] ?? '';
    }

    /**
     * @param $subjectCode
     * @return $this
     */
    public function setSubjectCode($subjectCode)
    {
        $this->body['subject_code'] = $subjectCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSystemName()
    {
        return $this->body['system_name'] ?? '';
    }

    /**
     * @param $systemName
     * @return $this
     */
    public function setSystemName($systemName)
    {
        $this->body['system_name'] = $systemName;
        return $this;
    }


    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->body['version'] ?? '';
    }

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->body['version'] = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBizContent()
    {
        return isset($this->body['biz_content']) && $this->body['biz_content'] ? json_decode($this->body['biz_content'], true) : [];
    }

    /**
     * @param $bizContent
     * @return $this
     */
    public function setBizContent(array $bizContent = [])
    {
        $this->body['biz_content'] = json_encode($bizContent);
        return $this;
    }

    /**
     * @param $params
     * @param null $paramsVal
     * @return $this
     */
    public function setBiz($params, $paramsVal = null)
    {
        $bizContent = $this->getBizContent();
        if (is_array($params) && !empty($params)) {
            $bizContent[] = $params;
        } else {
            $bizContent[$params] = $paramsVal;
        }
        $this->setBizContent($bizContent);
        return $this;
    }

    /**
     * @param string $params
     * @return mixed|null
     */
    public function getBiz($params = '')
    {
        $bizContent = $this->getBizContent();
        return $params ? ($bizContent[$params] ?? null) : $bizContent;
    }

    /**
     * @param string $condition
     * @return array|null
     */
    public function getBizCondition($condition = '')
    {
        $bizContent = $this->getBizContent();
        return $condition ? ($bizContent['condition'][$condition] ?? null) : ($bizContent['condition'] ?? []);
    }

    /**
     * @param $condition
     * @param null $conditionVal
     */
    public function setBizCondition($condition, $conditionVal = null)
    {
        $bizContent = $this->getBizContent();
        if (is_array($condition) && !empty($condition)) {
            $bizContent['condition'][] = $condition;
        } else {
            $bizContent['condition'][$condition] = $conditionVal;
        }
        $this->setBizContent($bizContent);
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

        if (!isset($this->body['token']) || empty($this->body['token']))
            throw new ValidateRequestException('token 不能为空');

        if (!isset($this->body['interface_method']) || empty($this->body['interface_method']))
            throw new ValidateRequestException('接口 不能为空');

        if (!isset($this->body['subject_code']) || empty($this->body['subject_code']))
            throw new ValidateRequestException('租户主体code 不能为空');
    }
}
