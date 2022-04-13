<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/12
 * Time: 15:01
 */

namespace Eccang\OpenApi\Order\Request;


use Eccang\OpenApi\System\Request\AppUnityRequest;

class OrderListRequest extends AppUnityRequest
{
    protected $apiUri = '/openApi/api/appUnity';

    protected $body = [
        'version' => 'V1.0.0',
        'interface_method' => 'getOrderList',
        'system_name' => 'ERP',
    ];
}
