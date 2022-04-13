<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 10:51
 */

namespace Eccang\OpenApi\System;

use Eccang\OpenApi\Contracts\Client;
use Eccang\OpenApi\System\Request\AppUnityRequest;
use Eccang\OpenApi\System\Request\BaseUserInfoRequest;
use Eccang\OpenApi\System\Request\TenantAccessTokenRequest;
use Eccang\OpenApi\System\Request\UserAccessTokenRequest;
use Eccang\OpenApi\System\Response\AppUnityResponse;
use Eccang\OpenApi\System\Response\UserAccessTokenResponse;
use Eccang\OpenApi\System\Response\TenantAccessTokenResponse;
use Eccang\OpenApi\System\Response\BaseUserInfoResponse;


class System extends Client
{
    /**
     * @param UserAccessTokenRequest $userAccessTokenRequest
     * @return UserAccessTokenResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function getUserAccessToken(UserAccessTokenRequest $request): UserAccessTokenResponse
    {
        $request->validate();
        return UserAccessTokenResponse::format($this->doRequest($request));
    }

    /**
     * @param TenantAccessTokenRequest $request
     * @return TenantAccessTokenResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function getTenantAccessToken(TenantAccessTokenRequest $request): TenantAccessTokenResponse
    {
        $request->validate();
        return TenantAccessTokenResponse::format($this->doRequest($request));
    }

    /**
     * @param GetBaseUserInfoRequest $request
     * @return GetBaseUserInfoResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function getBaseUserInfo(BaseUserInfoRequest $request): BaseUserInfoResponse
    {
        $request->validate();
        return BaseUserInfoResponse::format($this->doRequest($request));
    }

    /**
     * @param AppUnityRequest $request
     * @return AppUnityResponse
     * @throws \Eccang\OpenApi\Exception\InvalidResponseException
     * @throws \Eccang\OpenApi\Exception\ValidateRequestException
     */
    public function appUnity(AppUnityRequest $request): AppUnityResponse
    {
        $request->validate();
        return AppUnityResponse::format($this->doRequest($request));
    }
}
