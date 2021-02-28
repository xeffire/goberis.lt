
    <?php 
    session_start();
    require_once("connect.php");
    if(!isset($_SESSION['user'])) {
        $_SESSION['authMsg'] = "Pirma prisijunkite!";
    }
    $id = $_GET['id'];
    $userId = $_SESSION['user']['id'];

    $sql = "DELETE FROM carts WHERE cartId='$userId' AND itemId='$id'";
    $res = mysqli_query($connect, $sql);

    header("Location: ../cart.php");

?>