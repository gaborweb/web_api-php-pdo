<?php

include "Api.php";

if (isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $password=md5($password);

    if (empty($username) || empty($password)) {

        ?>
            <div class='alert alert-warning col-lg-12'>Belépéshez mindenképp kell felhasználónév és jelszó</div>
        <?php

    } else {

        $market = new Api();
        $market->accountCheck($username, $password);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Bejelentkezés</title>
</head>
<body>

<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>

<div class="container">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="jumbotron">
            <h1 class="display-6">Belépés</h1>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username1">Felhasználónév:</label>
                    <input type="text" id="username1" name="username" class="form-control col-lg-12" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password1">Jelszó:</label>
                    <input type="password" id="password1" name="password" class="form-control col-lg-12" placeholder="password">
                </div>
                <input type="submit" class="btn btn-dark" name="login" value="Bejelentkezés"> 
                <input type="button" onclick="location.href='signup.php'" class="btn btn-info" value="Regisztráció">
             </form>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

</body>
</html>