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
        self::hiddenFeatues();
    }

    private function sendHelperMessage() {
        $this->botMan->hears('get help' , function ( BotMan $botMan ) {
            $botMan->reply(
                ButtonTemplate::create("冒險者你好，歡迎使用機器人服務！！！ 更多功能正在開發中～～")
                    ->addButton(
                        ElementButton::create('如何預約外拍')
                            ->type('postback')
                            ->payload('如何預約外拍')
                    )
                    ->addButton(
                        ElementButton::create("我要聽小周開軟體講座")
                            ->type('postback')
                            ->payload("我要聽小周開軟體講座!!!")
                    )
            );
        });
        $this->botMan->hears("我要聽小周開軟體講座!!!", function ( BotMan $botMan ) {
           $botMan->reply("這位施主\n你應該叫 Miles 那些 Laravel 固定班底多講一點");
        });
        $this->botMan->hears("如何預約外拍", function ( BotMan $botMan) {
            $botMan->reply("預約外拍功能開發中....請稍後");
        });
    }

    private function hiddenFeatues () {
        // 暗黑搜尋功能
        $this->botMan->hears("hidden featues av search {keywords}", function( BotMan $botMan , $keywords) {
           $botMan->reply("你要搜尋的車號 ".$keywords ." 很抱歉，功能開發中！ 無法使用搜尋功能");
        });
        $this->botMan->hears("hidden featues acg torrent search {keywords}", function( BotMan $botMan , $keywords) {
            $botMan->reply("你要搜尋的目標 ".$keywords ." 很抱歉，功能開發中！ 無法使用搜尋功能");
        });
    }

}