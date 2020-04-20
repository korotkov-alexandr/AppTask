<?php
namespace AppTasks\Core;

use AppTasks\Config;
use RedBeanPHP\R;

/**
 * Class Model
 * @package AppTasks\Core
 */
class Model
{
    /**
     * @var
     */
    public $auth;
    /**
     * @var
     */
    public $loginService;

    /**
     * Model constructor.
     * @param $auth
     * @param $loginService
     */
    public function __construct($auth, $loginService)
    {
        $dbParams = Config::DB_PARAMS;
        R::setup( 'mysql:host=' . $dbParams['host'] . ';dbname=' . $dbParams['dbname'],
            $dbParams['username'],
            $dbParams['password']
        );

        if(!R::testConnection()) die('Нет соединения с базой данных, проверьте параметры подключния.');

        $this->auth = $auth;
        $this->loginService = $loginService;
    }
}