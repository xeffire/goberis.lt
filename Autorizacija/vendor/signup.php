<?php
session_start();
require_once "connect.php";
$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['pass'];
$repeatPass = $_POST['repeatPass'];

if ($password === $repeatPass) {
    $path = "uploads/".time().$_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], "../".$path)) {
        $_SESSION['message'] = 'Klaida kraunant faila';
        header("Location: ../register.php");
    }

    $password = md5($password);
    mysqli_query($connect, "INSERT INTO users(name, login, email, password, avatar) VALUES ('$name', '$login', '$email', '$password', '$path')");
    $_SESSION['message'] = "Registracija sekminga";
    header("Location: ../index.php");
} else {
    $_SESSION['message'] = "Slaptazodziai nesutampa";
    header("Location: ../register.php");
}
?>
<pre>
<?php
    print_r($_FILES);
?>

</pre>