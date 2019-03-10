<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 下午 11:21
 */

namespace App\Controllers;


use System\Controller\BaseController;

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
        $this->botMan->hears('Miles' , function (BotMan $botMan) {
            $botMan->reply("你是不是推坑王？？");
        });
        $this->botMan->hears('Hello world' , function (BotMan $botMan ) {
            $botMan->reply("hello world");
        });
    }

}