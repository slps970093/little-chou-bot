<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 下午 12:11
 */

namespace App\Controllers;

use BotMan\BotMan\BotMan;
use System\Controller\BaseController;

class FacebookController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->setDriverName('Facebook');
    }

    public function action()
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