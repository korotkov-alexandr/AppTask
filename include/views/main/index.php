<table class="table">
    <thead class="thead-dark ">
        <tr>
            <?php
            $url = $_SERVER["REQUEST_URI"];

            if (!empty($_GET["sort"])) {
                if ($_GET["sort"] == "asc") {
                    $orientation = "desc";
                } else {
                    $orientation = "asc";
                }
            } else {
                $orientation = "asc";
            }

            if (!empty($_GET["sort_field"])) {
                $urlSortName = str_replace("sort_field=" . $_GET["sort_field"], "sort_field=name", $url);
                $urlSortName = str_replace("sort=" . $_GET["sort"], "sort=" . $orientation, $urlSortName);

                $urlSortEmail = str_replace("sort_field=" . $_GET["sort_field"], "sort_field=email", $url);
                $urlSortEmail = str_replace("sort=" . $_GET["sort"], "sort=" . $orientation, $urlSortEmail);

                $urlSortStatus = str_replace("sort_field=" . $_GET["sort_field"], "sort_field=status", $url);
                $urlSortStatus = str_replace("sort=" . $_GET["sort"], "sort=" . $orientation, $urlSortStatus);
            } else {
                if ($_SERVER["QUERY_STRING"] == "") {
                    $ampersnada = "?";
                } else {
                    $ampersnada = "&";
                }
                $urlSortName = $url . $ampersnada . "sort_field=name&sort=" . $orientation;
                $urlSortEmail = $url . $ampersnada . "sort_field=email&sort=" . $orientation;
                $urlSortStatus = $url . $ampersnada . "sort_field=status&sort=" . $orientation;
            }

            $arrowName = "&#11014;";
            $arrowEmail = "&#11014;";
            $arrowStatus = "&#11014;";
            switch ($_GET["sort_field"]) {
                case "name":
                    if ($_GET["sort"] == "desc") {
                        $arrowName = "&#11015;";
                    }
                    break;
                case "email":
                    if ($_GET["sort"] == "desc") {
                        $arrowEmail = "&#11015;";
                    }
                    break;
                case "status":
                    if ($_GET["sort"] == "desc") {
                        $arrowStatus = "&#11015;";
                    }
                    break;
            } ?>
            <th scope="col"><a href="<?=$urlSortName?>">Имя <?=$arrowName?></a></th>
            <th scope="col"><a href="<?=$urlSortEmail?>">E-mail <?=$arrowEmail?></a></th>
            <th scope="col">Текст задачи</th>
            <th scope="col"><a href="<?=$urlSortStatus?>">Статус <?=$arrowStatus?></a></th>
            <?php if ($userParams['status'] == "VALID") { ?>
                <th></th>
            <?php }?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($arrTasks["ITEMS"] as $task) {?>
            <tr>
                <th><?=$task["login"];?></th>
                <td><?=$task["email"];?></td>
                <td><?=$task["text"];?></td>
                <td>
                    <?php if ($task["status"] == 1) {?>
                        <dl class="badge badge-success mb-0">Выполнено</dl>
                    <?php }

                    if ($task["redactor"] != "") {?>
                        <dl class="badge badge-warning mb-0">Отредактировано <?=$task["redactor"]?></dl>
                    <?php }?>
                </td>
                <?php if ($userParams['status'] == "VALID") { ?>
                    <td>
                        <a href="/task/change/<?=$task["taskid"]?>">Изменить</a>
                    </td>
                <?php }?>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (!empty($arrTasks["PAGES"])) {?>
    <div class="container">
        <div class="row justify-content-md-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $i = 0;
                    while ($i < $arrTasks["PAGES"]) {
                        if ($_GET["page"] == $i+1) {
                            $active = "active";
                        } elseif(empty($_GET["page"]) and $i < 1) {
                            $active = "active";
                        } else {
                            $active = "";
                        }

                        //TODO Составить реуглярное выражение для змены $_GET перменной
                        if (!empty($_GET["page"])) {
                            $pageNumber = $i+1;
                            $paging = str_replace("page=" . $_GET["page"], "page=" . $pageNumber, $_SERVER["REQUEST_URI"]);
                        } else {
                            if ($_SERVER["QUERY_STRING"] == "") {
                                $ampersnada = "?";
                            } else {
                                $ampersnada = "&";
                            }

                            $pageNumber = $i+1;
                            $paging = $_SERVER["REQUEST_URI"] . $ampersnada . "page=" . $pageNumber;
                        }
                        ?>
                        <li class="page-item <?=$active?>"><a class="page-link" href="<?=$paging?>"><?=$i+1?></a></li>
                    <?php
                        $i++;
                    }?>
                </ul>
            </nav>
        </div>
    </div>
<?php }?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col align-self-end d-flex flex-row-reverse mb-1">
            <a href="/task/create" class="btn btn-dark">Создать</a>
        </div>
    </div>
</div>
