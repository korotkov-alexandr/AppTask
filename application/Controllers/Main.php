<?php
namespace AppTasks\Controllers;

use AppTasks\Core\Controller;

/**
 * Class Main
 * @package AppTasks\Controllers
 */
class Main extends Controller
{
    public function Index()
    {
        $vars = [
            'arrTasks' => $this->model->getTasks($this->route["get_params"])
        ];

        $this->view->render('Задачник', $vars);
    }
}