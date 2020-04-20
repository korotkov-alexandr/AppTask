<?php
namespace AppTasks\Models;

use AppTasks\Core\Model;
use RedBeanPHP\R;

/**
 * Class Task
 * @package AppTasks\Models
 */
class Task extends Model
{
    /**
     * @param $taskId
     * @param $text
     * @param $complited
     * @param $redactor
     * @param bool $changed
     * @return mixed
     */
    public function changeTask($taskId, $text, $complited, $redactor, $changed = false) {
        if ($this->auth->getStatus() != "VALID") {
            header('Location: /account/login');
        }

        if ($changed) {
            $rez = R::exec('UPDATE `Tasks` SET `text` = ?, `status` = ?, `redactor` = ?  WHERE taskid = ?', [$text, $complited, $redactor, $taskId]);
        } else {
            $rez = R::exec('UPDATE `Tasks` SET `status` = ?  WHERE taskid = ?', [$complited, $taskId]);
        }

        if ($rez) {
            $arrResult["success"] = "<p class='mb-0'>Задача изменена, вернуться <a href='/'>на главную?</a></p>";
            return $arrResult;
        }
    }

    /**
     * @param $taskId
     * @return array
     */
    public function getTextTask($taskId) {
        $userObj = R::findOne('Tasks', 'taskid = ?', [$taskId]);
        $arrTaskProperties = $userObj->getProperties();
        return $arrTaskProperties;
    }

    /**
     * @param $login
     * @param $email
     * @param $text
     * @return array
     */
    public function createTask($login, $email, $text)
    {
        $curUser = $this->auth->getUserName();
        $arResult = [];

        if (empty($curUser) and $login == "") {
            $arResult["errors"] .= "<p class='mb-0'>Введите Имя</p>";
        }
        if ($email == "") {
            $arResult["errors"] .= "<p class='mb-0'>Введите Email</p>";
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {$arResult["errors"] .= "<p class='mb-0'>Email введен неверно</p>";}
        }
        if ($text == "") {
            $arResult["errors"] .= "<p class='mb-0'>Введите Текст</p>";
        }

        if (count($arResult["errors"]) > 0) {
            return $arResult;
        }

        //Если пользователь не авторизован, тогда ищем его в БД
        if (empty($curUser)) {
            $userObj = $this->findUser($login);
            //Если пользователь не нашелся, тогда создаем его
            if (empty($userObj)) {
                $rez = R::exec('INSERT INTO `Users` (login, email) VALUES (?, ?);', [$login, $email]);
                if ($rez) {
                    $userObj = $this->findUser($login);
                    $arrUser = $userObj->getProperties();
                    $userId = $arrUser['id'];
                }
            } else {
                //Если нашелся, то получим его Id для привзке к задаче
                $arrUser = $userObj->getProperties();
                $userId = $arrUser['id'];
            }

            $arResult["success"] = $this->insertTask($userId, $text, $login);

            return $arResult;
        }
    }

    /**
     * @param $userId
     * @param $text
     * @return string
     */
    private function insertTask($userId, $text) {
        $rez = R::exec('INSERT INTO `Tasks` (user_id, text) VALUES (?, ?);', [$userId, $text]);
        if ($rez) {
            $success = "<p class='mb-0'>Задача успешно создана вернуться <a href='/'>на главную?</a></p>";

            return $success;
        }
    }

    /**
     * @param $login
     * @return NULL|\RedBeanPHP\OODBBean
     */
    private function findUser($login) {
        $userObj = R::findOne('Users', 'login = ?', [$login]);
        if (!empty($userObj)) {
            return $userObj;
        }
    }
}