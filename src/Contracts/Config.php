<?php

namespace Eccang\OpenApi\Contracts;


class Config implements \ArrayAccess
{
    /**
     * @var string uri地址
     */
    protected $baseUri = 'http://testnew-home.eccang.com';

    /**
     * 当前配置值
     *
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        if ($options) foreach ($options as $key => $option) {
            $this->config[$key] = $option;
        }
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param string $baseUri
     * @return Config
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->config['appId'];
    }

    /**
     * @param string $appId
     * @return Config
     */
    public function setAppId($appId)
    {
        $this->config['appId'] = $appId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->config['secret'];
    }

    /**
     * @param string $secret
     * @return Config
     */
    public function setSecret($secret)
    {
        $this->config['secret'] = $secret;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function set($offset, $value)
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * @param null $offset
     * @return array|mixed|null
     */
    public function get($offset = null)
    {
        return $this->offsetGet($offset);
    }

    /**
     * @param $data
     * @param bool $append
     * @return array
     */
    public function merge($data, $append = false)
    {
        if ($append) {
            return $this->config = array_merge($this->config, $data);
        }
        return array_merge($this->config, $data);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->config[] = $value;
        } else {
            $this->config[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->config[$offset]);
    }

    /**
     * @param null $offset
     */
    public function offsetUnset($offset = null)
    {
        if (is_null($offset)) {
            $this->config = [];
        } else {
            unset($this->config[$offset]);
        }
    }

    /**
     * @param null $offset
     * @return array|mixed|null
     */
    public function offsetGet($offset = null)
    {
        if (is_null($offset)) {
            return $this->config;
        }
        return isset($this->config[$offset]) ? $this->config[$offset] : null;
    }

}
