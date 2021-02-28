<?php
    session_start();
    include_once "connect.php";

    $login = $_POST['login'];
    $pass = md5($_POST['pass']);

    $res = mysqli_query($connect, "SELECT * FROM users WHERE login='$login' AND password='$pass'");
    if (mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['user'] = [
            "id"=>$user['id'],
            "name"=>$user['name'],
            "avatar"=>$user['avatar'],
            "email"=>$user['email']
        ];
        header("Location: ../profile.php");
    } else {
        $_SESSION['message'] = 'Prisijungti nepavyko';
        header('Location: ../index.php');
    }

    echo "<pre>";

    print_r($res);
    print_r($user);

    echo "<pre>";
?>
