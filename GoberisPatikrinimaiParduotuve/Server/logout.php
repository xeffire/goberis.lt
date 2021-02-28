<?php
setcookie('id', '', time() -1, '/');
setcookie('vardas', '', time() -1, '/');
setcookie('pavarde', '', time() -1, '/');
setcookie('slaptazodis', '', time() -1, '/');
session_destroy();
header('Location: ../index.php');
?>