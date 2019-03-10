<?php
/**
 * Bot Framework
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 上午 01:32
 */

require_once 'global_config.php';
require_once 'vendor/autoload.php';

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Facebook\FacebookDriver;
use BotMan\BotMan\BotManFactory;

DriverManager::loadDriver(FacebookDriver::class);

$config = [
    'facebook' => [
        'token' => getenv('CHOUPG_FACEBOOK_TOKEN'),
        'app_secret' => getenv('CHOUPG_FACEBOOK_APP_SECRET'),
        'verification' => getenv('CHOUPG_FACEBOOK_TOKEN')
    ]
];

var_dump($config);

$botMan=BotManFactory::create($config);
// Give the bot something to listen for.
$botMan->hears('hello', function (BotMan $bot) {
    $bot->reply('你是不是推坑王？');
});

$botMan->hears('Miles', function (BotMan $bot) {
    $bot->reply('你是不是推坑王？');
});

$botMan->hears('options test' , function ( BotMan $botMan ) {
    $botMan->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
        ->addButton(ElementButton::create('Tell me more')
            ->type('postback')
            ->payload('tellmemore')
        )
        ->addButton(ElementButton::create('Show me the docs')
            ->url('http://botman.io/')
        )
    );
});

$botMan->listen();