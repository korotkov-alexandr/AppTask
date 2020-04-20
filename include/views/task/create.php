<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <form action="/task/create" method="post">
                <?php $display = (!empty($creatTaskResult["errors"])) ? "block" : "none"; ?>
                <div class="alert alert-danger" role="alert" id="error-alert" style="display: <?=$display?>">
                    <?=$creatTaskResult["errors"];?>
                </div>

                <?php if (!empty($creatTaskResult["success"])) {
                    $display = "block";
                    unset($_POST);
                } else {
                    $display = "none";
                }
                $display = (!empty($creatTaskResult["success"])) ? "block" : "none"; ?>
                <div class="alert alert-success" role="alert" id="success-alert" style="display: <?=$display?>">
                    <?=$creatTaskResult["success"];?>
                </div>

                <?php
                if (!empty($userParams['login'])) {
                    $disabled = "disabled";
                    $user = $userParams['login'];
                } elseif (!empty($_POST["NAME"])) {
                    $user = $_POST["NAME"];
                } ?>
                <div class="form-group">
                    <label for="exampleInputPassword1">Имя</label>
                    <input type="text" name="NAME" class="form-control" id="exampleInputPassword1" value="<?=$user;?>" <?=$disabled?> placeholder="Имя">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="EMAIL" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$_POST["EMAIL"]?>" placeholder="Еmail">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Текст задачи</label>
                    <textarea class="form-control" name="TEXT" id="exampleFormControlTextarea1" rows="3"><?=$_POST["TEXT"]?></textarea>
                </div>
                <a href="/" class="btn btn-dark">Отмена</a>
                <button type="submit" class="btn btn-dark" name="CREATE" value="Y">Создать</button>
            </form>
        </div>
    </div>
</div>