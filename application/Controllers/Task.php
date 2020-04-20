<?php
namespace AppTasks\Controllers;

use AppTasks\Core\Controller;

/**
 * Class Task
 * @package AppTasks\Controllers
 */
class Task extends Controller
{
    public function Create()
    {
        if (!empty($_POST)) {
            $login = htmlspecialchars($_POST['NAME']);
            $email = htmlspecialchars($_POST['EMAIL']);
            $text = htmlspecialchars($_POST['TEXT']);

            $creatTaskResult = $this->model->createTask($login, $email, $text);
        }

        $this->view->render('Создание новой задачи', ['creatTaskResult' => $creatTaskResult]);
    }

    public function Change()
    {
        if ($this->auth->getStatus() != "VALID") {
            header('Location: /');
        }

        $taskId = $this->route["url_params"];

        //Полычем текст задачи
        $taskParams = $this->model->getTextTask($taskId);

        //Меняем текст задачи
        if (!empty($_POST)) {
            $textPost = htmlspecialchars($_POST["TEXT"]);
            $complited = htmlspecialchars($_POST["COMPLITED"]);
            $redactor = $this->auth->getUserName();
            if ($textPost != $taskParams["text"]) {
                $changed = true;
            }
            if ($complited == "on") {$complited = 1;}

            $arrChangeTaskResult = $this->model->changeTask($taskId, $textPost, $complited, $redactor, $changed);

            $this->view->render('Изменение задачи', ["text" => $textPost, "arrChangeTaskResult" => $arrChangeTaskResult, "complited" => $complited]);
        } else {
            $this->view->render('Изменение задачи', ["text" => $taskParams["text"], "complited" => $taskParams["status"]]);
        }
    }
}