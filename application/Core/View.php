<?php
namespace AppTasks\Core;

/**
 * Class View
 * @package AppTasks\Core
 */
class View
{
    /**
     * @var string
     */
    public $path;
    /**
     * @var
     */
    public $route;
    /**
     * @var string
     */
    public $layout = 'default';
    /**
     * @var
     */
    public $userParams;

    /**
     * View constructor.
     * @param $route
     * @param $userParams
     */
    public function __construct($route, $userParams)
    {
        $this->route = $route;
        $this->path = mb_strtolower($route['controller'] . '/' . $route['action']);
        $this->userParams = $userParams;
    }

    /**
     * @param $title
     * @param array $vars
     * @param bool $isLoginPanel
     */
    public function render($title, $vars = [], $isLoginPanel = false)
    {
        $userParams = $this->userParams;
        extract($vars);
        $path = 'include/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();

            $path = 'include/views/layout/' . $this->layout . '.php';
            if (file_exists($path)) {
                require $path;
            } else {
                View::errorCode("layout_not_found");
            }
        } else {
            View::errorCode("view_not_found");
        }
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header('Location: ' . $url);

        exit;
    }

    /**
     * @param $code
     */
    public static function errorCode($code)
    {
        switch ($code) {
            case "model_not_found":
            case "layout_not_found":
            case "view_not_found":
                break;
            default:
                http_response_code($code);
        }

        $path = 'include/views/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }

        exit;
    }
}