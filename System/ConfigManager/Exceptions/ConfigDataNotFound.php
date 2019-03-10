<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 下午 12:51
 */

namespace System\ConfigManager\Exceptions;


use Throwable;

class ConfigDataNotFound extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}