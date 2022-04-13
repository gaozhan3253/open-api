<?php
/**
 * Created by PhpStorm.
 * User: gaozhan
 * Date: 2022/4/11
 * Time: 10:51
 */

namespace Eccang\OpenApi;


use Eccang\OpenApi\Contracts\Config;
use Eccang\OpenApi\Utils\Tool;

/**
 * Class Factory.
 *
 * @method static \Eccang\OpenApi\System\System  system($name, Config $config = null)
 * @method static \Eccang\OpenApi\Order\Order  order($name, Config $config = null)
 */
class Eccang
{
    /**
     * @param $name
     * @return mixed
     */
    public static function make($name, Config $config = null)
    {
        $client = sprintf('\\Eccang\\OpenApi\\%s\\%s', Tool::studly($name), Tool::studly($name));

        return new $client($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
