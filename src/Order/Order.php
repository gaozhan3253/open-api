<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 10:52
 */

namespace Eccang\OpenApi\Order;


use Eccang\OpenApi\Contracts\Client;
use Eccang\OpenApi\Order\Request\OrderListRequest;
use Eccang\OpenApi\Order\Request\SyncOrderRequest;
use Eccang\OpenApi\Order\Response\OrderListResponse;
use Eccang\OpenApi\Order\Response\SyncOrderResponse;

class Order extends Client
{
    /**
     * @param OrderListRequest $request
     * @return OrderListResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function orderList(OrderListRequest $request): OrderListResponse
    {
        $request->validate();
        return OrderListResponse::format($this->doRequest($request));
    }


    /**
     * @param SyncOrderRequest $request
     * @return SyncOrderResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function syncOrder(SyncOrderRequest $request): SyncOrderResponse
    {
        $request->validate();
        return SyncOrderResponse::format($this->doRequest($request));
    }
}
