<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 11:00
 */

namespace Eccang\OpenApi\Contracts;


use Eccang\OpenApi\Exception\InvalidResponseException;
use Eccang\OpenApi\Utils\Http;

abstract class Client
{
    /**
     * @var Config 配置
     */
    protected $config;

    /**
     * Client constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {

        $this->config = $config;
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getRequestUrl($uri)
    {
        return $this->config->getBaseUri() . $uri;
    }

    /**
     * @param Request $request
     * @return array|mixed
     * @throws InvalidResponseException
     */
    protected function doRequest(Request $request)
    {
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        $dataType = $request->getDataType();
        $body = array_merge($this->config->getConfig(), $request->getBody());
        $url = $this->getRequestUrl($request->getApiUri());

        if (strtolower($method) == 'get' && !empty($body)) {
            $url .= (stripos($url, '?') !== false ? '&' : '?') . http_build_query($body);
        }
        $headers = $dataType == 'JSON' ?
            array_merge($headers, ['Content-Type: application/json;charset=UTF-8']) :
            array_merge($headers, ['Content-Type: application/x-www-form-urlencoded;charset=UTF-8']
            );
        $body = $dataType == 'JSON' ? json_encode($body) : $body;

        try {
            return Http::request($method, $url, $body, $headers);
        } catch (\Exception $e) {
            throw new InvalidResponseException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
