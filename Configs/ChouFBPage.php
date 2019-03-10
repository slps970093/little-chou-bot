<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 下午 11:20
 */

return array(
    'facebook' => [
        'token' => getenv('CHOUPG_FACEBOOK_TOKEN'),
        'app_secret' => getenv('CHOUPG_FACEBOOK_APP_SECRET'),
        'verification' => getenv('CHOUPG_FACEBOOK_TOKEN')
    ]
);