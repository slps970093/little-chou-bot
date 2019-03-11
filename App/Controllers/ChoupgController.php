<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 下午 11:21
 */

namespace App\Controllers;


use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use System\Controller\BaseController;
use BotMan\BotMan\BotMan;

class ChoupgController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->setDriverName('Facebook');
        $this->setCustomConfigPath(APPLICATION_CONFIG_ROOT . '/' . 'ChouFBPage.php');
    }

    function action()
    {
        // TODO: Implement action() method.
        self::sendHelperMessage();
    }

    public function sendHelperMessage() {
        $this->botMan->hears('get help' , function ( BotMan $botMan ) {
            ButtonTemplate::create("冒險者你好，歡迎使用機器人服務！！！ 更多功能正在開發中～～")
                ->addButton(ElementButton::create('如何預約外拍')
                ->type('postback')
                ->payload('如何預約外拍'))
                ->addButton(
                    ElementButton::create("我要聽小周開軟體講座")->type('postback')->payload("我要聽小周開軟體講座!!!")
                );
        })
    }
}