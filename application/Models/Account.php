<?php
namespace AppTasks\Models;

use AppTasks\Core\Model;
use RedBeanPHP\R;

/**
 * Class Account
 * @package AppTasks\Models
 */
class Account extends Model
{
    /**
     * @param $user
     * @param $password
     * @return string
     */
    public function signin($user, $password)
    {
        $userObj = R::findOne('Users', 'login = ?', [$user]);
        if (!empty($userObj)) {
            //Если пользователь нашелся проверим его пароль
            $arrUser = $userObj->getProperties();
            if (password_verify($password, $arrUser['pass_hash'])) {
                //Если пользователь нашелся проверим его пароль
                $arrUser = $userObj->getProperties();
                // use the service to force $auth to a logged-in state
                $username = $arrUser['login'];
                $userdata = [
                    'email' => $arrUser['email'],
                ];

                $this->loginService->forceLogin($this->auth, $username, $userdata);

                $backurl = "/";
                if (!empty($_GET["backurl"])) {
                    $backurl = htmlspecialchars($_GET["backurl"]);
                }
                header('Location: ' . $backurl);
            } else {
                return "Неправильный пароль";
            }
        } else {
            return "Логин в системе не найден";
        }
    }
}