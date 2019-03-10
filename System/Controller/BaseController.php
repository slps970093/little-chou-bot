<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 上午 11:51
 */

namespace System\Controller;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use System\ConfigManager\Manager;
use BotMan\BotMan\Drivers\DriverManager;

abstract class BaseController{

    private $configManager;

    private $botManDrivers;

    private $driverName;

    private $customConfigPath;

    /**
     * @var BotMan
     */
    public $botMan;



    public function __construct()
    {
        $this->configManager = new Manager();
    }

    /**
     * BotMan Driver Name
     * @param $name
     */
    public function setDriverName ( $name ) {
        $this->driverName = $name;
    }

    /**
     * 自定義設定檔案路徑
     * @param $path
     */
    public function setCustomConfigPath( $path ) {
        $this->customConfigPath = $path;
    }



    /**
     * 初始化 Bot
     */
    public function init(){
        $this->loadDriver();
        DriverManager::loadDriver($this->botManDrivers[$this->driverName]);
        $apiConfig = $this->configManager->loadConfig($this->driverName,  empty($this->customConfigPath) ? $this->driverName : $this->customConfigPath  )
            ->getConfig($this->driverName);
        $this->botMan = BotManFactory::create($apiConfig);
        return $this;
    }


    abstract function action();

    public function run(){
        $this->action();
        $this->botMan->listen();
    }

    /**
     * 載入 BotMan Driver
     */
    public function loadDriver() {
        $this->botManDrivers = $this->configManager->loadConfig('BotMan','BotMan')->getConfig('BotMan');
    }
}