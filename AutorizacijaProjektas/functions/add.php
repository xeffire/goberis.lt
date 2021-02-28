<?php 
    session_start();
    require_once("connect.php");
    if(!isset($_SESSION['user'])) {
        $_SESSION['authMsg'] = "Pirma prisijunkite!";
    }
    $id = $_GET['id'];
    $userId = $_SESSION['user']['id'];

    $sql = "SELECT * FROM carts WHERE cartId='$userId' AND itemId='$id'";
    $res = mysqli_query($connect, $sql);

    if(mysqli_fetch_assoc($res)) {
        $_SESSION['authMsg'] = "Prekė jau krepšelyje!";
        header("Location: ../index.php");
    }

    $sql = "INSERT INTO carts (cartId, itemId) VALUES ($userId, $id)";
    mysqli_query($connect, $sql);
    if (mysqli_errno()) {
        $_SESSION['authMsg'] = "Klaida su duombaze";
    }
    
    header("Location: ../index.php");

?>