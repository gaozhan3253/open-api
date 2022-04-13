<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:13
 */

namespace Eccang\OpenApi\System\Response;


use Eccang\OpenApi\Contracts\Response;
use Eccang\OpenApi\Exception\ValidateResponseException;

class BaseUserInfoResponse extends Response
{

    /**
     * @return string
     */
    public function getRealName()
    {
        return $this->getData()['realName'] ?? '';
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->getData()['sex'] ?? '';
    }

    /**
     * @return string
     */
    public function getHeadUrl()
    {
        return $this->getData()['headUrl'] ?? '';
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->getData()['phone'] ?? '';
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->getData()['email'] ?? '';
    }

    /**
     * @return string
     */
    public function getSubjectCode()
    {
        return $this->getData()['subjectCode'] ?? '';
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        parent::validate();
        $data = $this->getData();
        if (!isset($data['subjectCode']) || empty($data['subjectCode']))
            throw new ValidateResponseException('subjectCode 返回为空');
    }
}
