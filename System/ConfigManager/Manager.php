<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 上午 01:17
 */

namespace System\ConfigManager;


use System\ConfigManager\Exceptions\ConfigDataNotFound;
use System\ConfigManager\Exceptions\ConfigFileNotFound;

class Manager
{
    /**
     * @var \ArrayObject
     */
    private $config;

    public function __construct()
    {
        $this->config = new \ArrayObject();
    }


    /**
     * 讀取設定檔案
     * @param $configName
     * @param $filepath
     * @throws ConfigFileNotFound
     * @return $this
     */
    public function loadConfig($configName , $filepath ) {
        $path = ( is_file($filepath) ) ? $filepath : APPLICATION_CONFIG_ROOT . '/' . ucfirst($filepath) . '.php';
        if (!file_exists($path)){
            throw new ConfigFileNotFound('config file: '. $path . 'not found');
        }
        $this->config->{$configName} = include $path;
        return $this;
    }


    /**
     * 取得設定檔案
     * @param $configName
     * @return array
     * @throws ConfigDataNotFound
     */
    public function getConfig($configName){
        if ( !is_array($this->config->{$configName}) ){
            throw new ConfigDataNotFound('config data: ' . $configName . 'not found');
        }
        return $this->config->{$configName};
    }

    /**
     * 取得所有的 Configs
     * @return \ArrayObject
     */
    public function getAllConfigs(){
        return $this->config;
    }
    
}