<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?=$title?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/style.css" />
</head>
<body>
    <div class="container-fluid">
        <div class="row mb-2 mt-2">
            <div class="col align-self-end"><h1><?=$title?></h1></div>
            <?php if (!$isLoginPanel) {?>
                <div class="col align-self-end d-flex flex-row-reverse mb-1">
                    <?php if ($userParams['status'] == "VALID") {?>
                        <a href="/account/logout?backurl=<?=$_SERVER["REQUEST_URI"]?>" class="ml-3">Выйти</a>
                        <span><b><?=$userParams['login']?></b></span>
                    <?php } else {?>
                        <a href="/account/login?backurl=<?=$_SERVER["REQUEST_URI"]?>" class="btn btn-dark">Авторизация</a>
                    <?php }?>
                </div>
            <?php }?>
        </div>
    </div>

    <?php echo $content?>

    <footer>
        <script src="../../public/js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </footer>
</body>
</html>