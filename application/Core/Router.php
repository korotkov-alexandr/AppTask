<?php
namespace AppTasks\Core;

use AppTasks\Config;

/**
 * Class Router
 * @package AppTasks\Core
 */
class Router
{
    /**
     * @var array
     */
    protected $routes = [];
    /**
     * @var array
     */
    protected $params = [];

    /**
     * Router constructor.
     */
    public function  __construct()
    {
        $arrRoutes = Config::ROUTES;
        foreach ($arrRoutes as $key => $value) {
            $this->add($key, $value);
        }
    }

    /**
     * @param $route
     * @param $params
     */
    private function add($route, $params)
    {
        $route = '#^' . $route . '#';
        $this->routes[$route] = $params;
    }

    /**
     * @return bool
     */
    private function match()
    {
        $url = trim($_SERVER["REQUEST_URI"], "/");

        //Получаем все GET параметры
        $parts = parse_url($url);
        parse_str($parts['query'], $arrGetParams);

        if (count($arrGetParams) > 0) {
            if (!empty($parts["path"])) {
                $url = $parts["path"];
            } else {
                $url = "index";
            }
        }

        if ($url == "") $url = "index";
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $mathces)) {
                $urlParams = trim(str_replace($mathces[0], "", $url), "/");
                if ($urlParams != "") {
                    $params["url_params"] = $urlParams;
                }
                if (!empty($arrGetParams)) {
                    $params["get_params"] = $arrGetParams;
                }
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $classController = "AppTasks\Controllers\\" . ucfirst($this->params["controller"]);
            if (class_exists($classController)) {
                $actionMethod = $this->params['action'];
                if (method_exists($classController, $actionMethod)) {
                    $controller = new $classController($this->params);
                    $controller->$actionMethod();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}