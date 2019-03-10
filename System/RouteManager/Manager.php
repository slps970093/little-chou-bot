<?php
/**
 * Created by PhpStorm.
 * User: Yu-Hsien Chou
 * Date: 2019/3/10
 * Time: 上午 01:34
 */

namespace System\RouteManager;


class Manager
{
    private $routeFilePath;
    private $routes;

    public function __construct()
    {
        $this->routeFilePath = APPLICATION_CONFIG_ROOT . '/Routes.php';
    }

    /***
     * 從路由設定檔案取得控制器名稱
     *
     */
    public function getControllerNameFromRoute() {
        if (!is_array($this->routes)){
            self::loadConfig();
        }
        if ( self::searchCustomUriGetController() != false) {
            return self::searchCustomUriGetController();
        }
        return false;
    }


    private function loadConfig() {
        $this->routes = include $this->routeFilePath;
    }

    /**
     * 搜尋自定義的 uri 規則 並傳回物件名稱
     * @return bool|false|int|string
     */
    private function searchCustomUriGetController() {
        $uriArr = self::conventUriStringtoArray();
        return ( array_key_exists($uriArr[0],$this->routes) ) ? $this->routes[$uriArr[0]] : false;
    }


    private function conventUriStringtoArray() {
        $uri = self::getUri();
        $uriArr = explode("/",$uri);
        $portalIndex  = array_search("index.php", self::getPHPSelf(true));
        // 避免 未使用 rewrite 規則
        if ( in_array("index.php",$uriArr) ) {
            $index = array_search("index.php",$uriArr);
            unset($uriArr[$index]);
            $uriArr = array_values($uriArr);
        }
        // 預處理 入口點 有 folder
        if ( $portalIndex >= 1) {
            for ($i = ($portalIndex - 1); $i >= 0 ; $i--) {
                unset($uriArr[$i]);
            }
        }
        $uriArr = array_values($uriArr);
        return $uriArr;
    }

    public function getControllerName() {
        $uri = self::conventUriStringtoArray();
        return $uri[0];
    }
    /**
     * 取得 uri
     * @return string
     */
    private function getUri(){
        return mb_substr($_SERVER['REQUEST_URI'],1,mb_strlen($_SERVER['REQUEST_URI']));
    }

    private function getPHPSelf($conventToArray = false ) {
        if ( $conventToArray ){
            return explode("/", mb_substr($_SERVER['PHP_SELF'],1,mb_strlen($_SERVER['PHP_SELF'])));
        }
        return $_SERVER['PHP_SELF'];
    }

}