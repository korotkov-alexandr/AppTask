<?php
namespace AppTasks\Models;

use AppTasks\Core\Model;
use RedBeanPHP\R;

/**
 * Class Main
 * @package AppTasks\Models
 */
class Main extends Model
{
    /**
     * @param $getParams
     * @return mixed
     */
    public function getTasks($getParams)
    {
        //Постраничная навигация
        $query = 'SELECT count(*) FROM Tasks';
        $rez = R::getAll( $query );
        $count = $rez[0]["count(*)"];

        $integer = intdiv($count, 3);
        if ($count - $integer != 0) {
            $pages = $integer + 1;
        } else {
            $pages = $integer;
        }

        if (!empty($getParams["page"])) {
            $curPage = htmlspecialchars($getParams["page"]);
        } else {
            $curPage = 1;
        }

        $endElem = ($curPage-1) * 3;

        //Сортировка
        switch ($_GET["sort_field"]) {
            case "email":
                $tableName = "c.email";
                break;
            case "status":
                $tableName = "a.status";
                break;
            default:
                $tableName = "c.login";
                break;
        }
        if ($_GET["sort"] == "desc") {
            $orientation = "DESC";
        }  else {
            $orientation = "ASC";
        }

        $query = 'SELECT * FROM Tasks a LEFT JOIN Users c ON a.user_id = c.id ORDER BY ' . $tableName . ' ' . $orientation . ' LIMIT 3 OFFSET ?';

        $arrResult["GET_PARAMS"] = $getParams;

        $arrResult["ITEMS"] = R::getAll($query, [$endElem]);
        if ($pages > 1) {
            $arrResult["PAGES"] = $pages;
        }
        return $arrResult;
    }
}