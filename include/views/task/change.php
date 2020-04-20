<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <form action="<?=$_SERVER["REQUEST_URI"]?>" method="post">
                <?php $display = (!empty($arrChangeTaskResult["errors"])) ? "block" : "none"; ?>
                <div class="alert alert-danger" role="alert" id="error-alert" style="display: <?=$display?>">
                    <?=$arrChangeTaskResult["errors"];?>
                </div>

                <?php if (!empty($arrChangeTaskResult["success"])) {
                    $display = "block";
                    unset($_POST);
                } else {
                    $display = "none";
                } ?>
                <div class="alert alert-success" role="alert" id="success-alert" style="display: <?=$display?>">
                    <?=$arrChangeTaskResult["success"];?>
                </div>

                <?php if (!empty($userParams['login'])) {
                    $disabled = "disabled";
                    $user = $userParams['login'];
                } elseif (!empty($_POST["NAME"])) {
                    $user = $_POST["NAME"];
                }

                if ($complited) {
                    $checked = "checked";
                }
                 ?>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Текст задачи</label>
                    <textarea class="form-control" name="TEXT" id="exampleFormControlTextarea1" rows="3"><?=$text?></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="checkcomplited" name="COMPLITED" <?=$checked?>>
                    <label class="form-check-label" for="checkcomplited">Выполнена</label>
                </div>

                <a href="/" class="btn btn-dark">Отмена</a>
                <button type="submit" class="btn btn-dark" name="CREATE" value="Y">Изменить</button>
            </form>
        </div>
    </div>
</div>