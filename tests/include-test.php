<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/12
 * Time: 18:11
 */

try {
    $path = dirname(dirname(__FILE__));

    include $path . '/src/include.php';

    $config = new \Eccang\OpenApi\Contracts\Config();

    $config->setAppId('526932f75d2f46ec')->setSecret('800b641078d2fa3f');

    $code = '8977c0d7e9daec428005cb2a750deedc';
    $request = new \Eccang\OpenApi\System\Request\UserAccessTokenRequest();
    $request->setCode($code);

    $response = \Eccang\OpenApi\Eccang::system($config)->getUserAccessToken($request);
    $userAccessToken = $response->getUserAccessToken();
    var_dump('$userAccessToken: ' . $userAccessToken);


    $request = new \Eccang\OpenApi\System\Request\BaseUserInfoRequest();
    $request->setToken($userAccessToken);
    $response = \Eccang\OpenApi\Eccang::system($config)->getBaseUserInfo($request);
    $subjectCode = $response->getSubjectCode();
    var_dump('$subjectCode: ' . $subjectCode);

    $request = new \Eccang\OpenApi\System\Request\TenantAccessTokenRequest();
    $request->setSubjectCode($subjectCode);
    $response = \Eccang\OpenApi\Eccang::system($config)->getTenantAccessToken($request);
    $tenantAccessToken = $response->getTenantAccessToken();
    var_dump('$tenantAccessToken: ' . $tenantAccessToken);

    $bizContent = [
        'page' => 1,
        'page_size' => 2,
    ];
    $request = new \Eccang\OpenApi\System\Request\AppUnityRequest();
    $request->setSubjectCode($subjectCode)
        ->setCode($code)
        ->setToken($tenantAccessToken)
        ->setSystemName('ERP')
        ->setVersion('V1.0.0')
        ->setInterfaceMethod('getOrderList')
        ->setBizContent($bizContent);

    $response = \Eccang\OpenApi\Eccang::system($config)->appUnity($request);
    var_dump($response->getData());
    var_dump($response->getPage());
    var_dump($response->getPageSize());
    var_dump($response->getTotal());

} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
