<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/12
 * Time: 16:01
 */

namespace Eccang\OpenApi\Order\Response;

use Eccang\OpenApi\System\Response\AppUnityResponse;
use Eccang\OpenApi\Exception\ValidateResponseException;

class SyncOrderResponse extends AppUnityResponse
{
    /**
     * @return string
     */
    public function getOrderCode()
    {
        return $this->getData()['order_code'] ?? '';
    }

    /**
     * @return string
     */
    public function getWarehouseOrderCode()
    {
        return $this->getData()['warehouse_order_code'] ?? '';
    }

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getData()['status'] ?? '';
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        parent::validate();
        if (!isset($this->getData()['order_code']) || empty($this->getData()['order_code']))
            throw new ValidateResponseException('order_code 返回为空');

        if (!isset($this->getData()['status']) || empty($this->getData()['status']))
            throw new ValidateResponseException('status 返回为空');
    }
}
