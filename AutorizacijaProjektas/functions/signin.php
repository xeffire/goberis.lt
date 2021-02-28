<?php
    session_start();
    include_once "connect.php";

    $name = $_POST['login'];
    $pass = md5($_POST['pass']);

    $res = mysqli_query($connect, "SELECT * FROM shopUsers WHERE name='$name' AND pass='$pass'");
    if (mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['user'] = [
            "id"=>$user['id'],
            "name"=>$user['name'],
            "cartId"=>$user['cartId']
        ];
    } else {
        $_SESSION['authMsg'] = 'Prisijungti nepavyko';
    }
    header("Location: ../index.php");

?>