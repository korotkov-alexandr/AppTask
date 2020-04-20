<?php
namespace AppTasks\Core;

use AppTasks\Core\View;
use Aura\Auth;

/**
 * Class Controller
 * @package AppTasks\Core
 */
class Controller
{
    /**
     * @var
     */
    public $route;
    /**
     * @var \AppTasks\Core\View
     */
    public $view;
    /**
     * @var mixed
     */
    public $model;
    /**
     * @var Auth\Auth
     */
    public $auth;
    /**
     * @var Auth\Service\LoginService
     */
    public $loginService;
    /**
     * @var Auth\Service\LogoutService
     */
    public $logoutService;

    /**
     * Controller constructor.
     * @param $route
     */
    public function __construct($route)
    {
        // create the login service
        $authFactory = new Auth\AuthFactory($_COOKIE);
        $this->auth = $authFactory->newInstance();
        $this->loginService = $authFactory->newLoginService();
        $this->logoutService = $authFactory->newLogoutService();
        $arrUserParams['status'] = $this->auth->getStatus();
        $arrUserParams['login'] = $this->auth->getUserName();

        $this->route = $route;
        $this->view = new View($this->route, $arrUserParams);
        $this->model = $this->loadModel($route['controller']);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function loadModel($name)
    {
        $classModel = 'AppTasks\Models\\' . $name;

        if (class_exists($classModel)) {
            return new $classModel($this->auth, $this->loginService);
        } else {
            View::errorCode("model_not_found");
        }
    }
}