<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-md-3">
            <?php
            if(!empty($_GET["backurl"])) {
                $backurl = "?backurl=" . htmlspecialchars($_GET["backurl"]);
            }
            ?>
            <form action="/account/login<?=$backurl?>" method="post" class="form-signin">
                <div class="mb-1">
                    <div class="text-center mb-3">
                        <img src="../../public/img/auth.png" style="width: 50%;">
                    </div>
                    <?php $display = (!empty($authResult)) ? "block" : "none"; ?>
                    <div class="alert alert-danger" role="alert" id="error-alert" style="display: <?=$display?>">
                        <?=$authResult;?>
                    </div>
                    <h1 class="h3 mb-3 font-weight-normal">Пожалуйста авторизуйтесь</h1>
                    <label for="inputLogin" class="sr-only">Логин</label>
                    <input type="text" id="inputLogin" class="form-control" placeholder="Логин" name="LOGIN" required="" autofocus="" value="<?=$_POST["LOGIN"]?>">
                    <label for="inputPassword" class="sr-only">Пароль</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" name="PASSWORD" required="">
                </div>
                <button class="btn btn-lg btn-dark btn-block" type="submit">Войти</button>
                <a class="btn btn-lg btn-dark btn-block" href="/">Отмена</a>
            </form>
        </div>
    </div>
</div>