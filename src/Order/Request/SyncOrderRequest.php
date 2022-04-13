<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/12
 * Time: 16:01
 */

namespace Eccang\OpenApi\Order\Request;

use Eccang\OpenApi\System\Request\AppUnityRequest;

class SyncOrderRequest extends AppUnityRequest
{
    protected $apiUri = '/openApi/api/appUnity';

    protected $body = [
        'version' => 'V1.0.0',
        'interface_method' => 'syncOrder',
        'system_name' => 'ERP',
    ];

    /**
     * @param $actionType
     * @return $this
     */
    public function setActionType($actionType)
    {
        $this->setBiz('action_type', $actionType);
        return $this;
    }

    /**
     * @param $orderCode
     * @return $this
     */
    public function setOrderCode($orderCode)
    {
        $this->setBiz('order_code', $orderCode);
        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->setBiz('order', $order);
        return $this;
    }

    /**
     * @param $orderDetails
     * @return $this
     */
    public function setOrderDetail($orderDetails)
    {
        $this->setBiz('order_details', $orderDetails);
        return $this;
    }

    /**
     * @param $orderAddress
     * @return $this
     */
    public function setOrderAddress($orderAddress)
    {
        $this->setBiz('order_address', $orderAddress);
        return $this;
    }

    /**
     * @param $orderProperty
     * @return $this
     */
    public function setOrderProperty($orderProperty)
    {
        $this->setBiz('order_property', $orderProperty);
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function setForcedUpdateOrderStatus($bool = false)
    {
        $this->setBiz('is_update_order_status', $bool ? '1' : '0');
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function setOrderVerify($bool = false)
    {
        $this->setBiz('order_verify', $bool ? '1' : '0');
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function setIsUniqueReferenceNo($bool = false)
    {
        $this->setBiz('is_unique_reference_no', $bool ? '1' : '0');
        return $this;
    }
}
