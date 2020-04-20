<?php
namespace AppTasks\Controllers;

use AppTasks\Core\Controller;

/**
 * Class Account
 * @package AppTasks\Controllers
 */
class Account extends Controller
{
    public function Login()
    {
        if ($this->auth->getStatus() == "VALID") {
            header('Location: /');
        }

        if (!empty($_POST)) {
            $user = htmlspecialchars($_POST["LOGIN"]);
            $password = htmlspecialchars($_POST["PASSWORD"]);

            $authError = $this->model->signin($user, $password);
        }

        $this->view->render('', ['authResult' => $authError], true);
    }

    public function Logout()
    {
        $backurl = '/';
        if (!empty($_GET['backurl'])) {
            $backurl = $_GET['backurl'];
        }

        $this->logoutService->forceLogout($this->auth);

        header('Location: ' . $backurl);
    }
}