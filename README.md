# eccang erp open api sdk

[简体中文](README.md) 

> 易仓ERP对外API


## 环境要求

* PHP >= 7.2

## composer安装



安装使用
----
1.1 Composer 安装

``` base
$ composer require eccang/open-api 
```

1.2 下载代码引入
``` php
include "eccang/open-api/src/include.php";
```

## 使用

### getUserAccessToken

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\System\Request\UserAccessTokenRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec')
                ->setSecret('800b641078d2fa3f');
            
            $code = '8977c0d7e9daec428005cb2a750deedc';
            $request = new UserAccessTokenRequest();
            $request->setCode($code);
            
            $response = Eccang::system($config)->getUserAccessToken($request);
            $userAccessToken = $response->getUserAccessToken();
            var_dump('$userAccessToken: ' . $userAccessToken);
        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```

### getBaseUserInfo

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\System\Request\BaseUserInfoRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec')
                ->setSecret('800b641078d2fa3f');

            $request = new BaseUserInfoRequest();
            $request->setToken($userAccessToken);
            
            $response = Eccang::system($config)->getBaseUserInfo($request);
            $subjectCode = $response->getSubjectCode();
            var_dump('$subjectCode: ' . $subjectCode);
            
        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```


### getTenantAccessToken

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\System\Request\TenantAccessTokenRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec')
                ->setSecret('800b641078d2fa3f');
            
            $request = new TenantAccessTokenRequest();
            $request->setSubjectCode($subjectCode);
            
            $response = Eccang::system($config)->getTenantAccessToken($request);
            $tenantAccessToken = $response->getTenantAccessToken();
            var_dump('$tenantAccessToken: ' . $tenantAccessToken);

        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```


### 应用调用统一入口

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\System\Request\AppUnityRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec')
                ->setSecret('800b641078d2fa3f');
            
            $bizContent = [
                'page' => 1,
                'page_size' => 2,
            ];
            $request = new AppUnityRequest();
            $request->setSubjectCode($subjectCode)
                ->setCode($code)
                ->setToken($tenantAccessToken)
                ->setSystemName('ERP')
                ->setVersion('V1.0.0')
                ->setInterfaceMethod('getOrderList')
                ->setBizContent($bizContent);
                
            $response = Eccang::system($config)->appUnity($request);
            var_dump($response->getData());
            var_dump($response->getPage());
            var_dump($response->getPageSize());
            var_dump($response->getTotal());
        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```

### 订单列表

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\Order\Request\OrderListRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec');
            $config->setSecret('800b641078d2fa3f');
            
            $request = new OrderListRequest();
            $request->setSubjectCode($subjectCode)
                ->setCode($code)
                ->setToken($tenantAccessToken)
                ->setBiz('page', 1)
                ->setBiz('page_size', 1)
                ->setBizCondition('status', 3)
                ->setBizCondition('platform', 'm2c');

            $response = Eccang::order($config)->orderList($request);
            var_dump($response->getData());
            var_dump($response->getPage());
            var_dump($response->getPageSize());
            var_dump($response->getTotal());

        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```


### 订单修改

``` php
use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Eccang;
use Eccang\OpenApi\Order\Request\OrderListRequest;

        try {
            $config = new Config();
            $config->setAppId('526932f75d2f46ec');
            $config->setSecret('800b641078d2fa3f');
            
            $request = new SyncOrderRequest();
            $request->setSubjectCode($subjectCode)
                ->setCode($code)
                ->setToken($tenantAccessToken)
                ->setOrderCode('FX10-21020301-0001')
                ->setActionType('EDIT')
                ->setOrder(['order_status' => 1, 'buyer_mail' => '827951152@qq.com'])
                ->setForcedUpdateOrderStatus(true);
                
            $response = Eccang::order($config)->syncOrder($request);
            var_dump('改后：' . $response->getOrderStatus());
        } catch (\Exception $exception) {
            var_dump('error: ' . $exception->getMessage());
        }
```
