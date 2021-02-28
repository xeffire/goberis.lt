<?php
$email = file("email.txt");
for($i = 0; $i < count($email); $i++){
    echo $email[$i]."<br>";
}
?>