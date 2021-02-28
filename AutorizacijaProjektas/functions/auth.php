<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function login() {
        if(!isset($_SESSION['user'])) {
                echo
            "<form action='functions/signin.php' method='POST' class='d-flex flex-row'>
                <input type='text' name='login' placeholder='Login' class='form-control-sm'>
                <input type='password' name='pass' placeholder='Slaptažodis' class='form-control-sm'>
                <button class='btn btn-sm btn-outline-light'>Prisijungti</button>
                <a href='register.php' class='mx-1'>Registracija</a>
                </form>
            ";
        } else {
            echo "<span class='mx-3'>Sveiki, ".$_SESSION['user']['name']."!</span><a href='cart.php' class='mx-3'><i class='bi bi-cart text-light'></a></i><a href='functions/logout.php' class='mx-3'>Atsijungti</a>";
        }
    
    }
?>