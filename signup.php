<?php

include "Api.php";

if (isset($_POST["signup"])){

    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if(empty($fullname) || empty($username) || empty($password) || empty($password2)){

        ?>
            <div class='alert alert-warning'>A regisztrációhoz minden mezőt szükséges kitölteni!</div>
        <?php
        
    } elseif ($password==$password2) {
		
        $password=md5($password);

        $market = new Api();
        $result = $market->accountReg($fullname, $username, $password);
    } else {

        ?>
            <div class='alert alert-warning'>A megadott jelszavak nem egyeznek!</div>
        <?php

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
    <title>Regisztráció</title>
</head>
<body>

<script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
</script>

<div class="container">

    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="jumbotron">
            <h1 class="display-6">Regisztráció</h1>
            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="fullname1">Teljes név:</label>
                    <input type="text" id="fullname1" name="fullname" class="form-control col-lg-12" placeholder="fullname">
                </div>
                <div class="form-group">
                    <label for="username1">Felhasználónév:</label>
                    <input type="text" id="username1" name="username" class="form-control col-lg-12" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password1">Jelszó:</label>
                    <input type="password" id="password1" name="password" class="form-control col-lg-12" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="password2">Jelszó mégegyszer:</label>
                    <input type="password" id="password2" name="password2" class="form-control col-lg-12" placeholder="password again">
                </div>
                <input type="submit" class="btn btn-danger" name="signup" value="Regisztráció"> 
                <input type="button" onclick="location.href='login.php'" class="btn btn-info" value="Vissza"> 
                </form>
            </div>
        </div>
        <div class="col-lg-4">
        </div>
    </div>
</div>

</body>
</html>