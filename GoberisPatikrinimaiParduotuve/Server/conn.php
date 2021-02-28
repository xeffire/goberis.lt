<?php
    $host = 'localhost';
    $user = 'goislt';
    $pass = 'bhfjuHWfzG';
    $db = 'goislt_goislt';
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset('utf8mb4');
    
    if ($conn->connect_errno) {
        echo "error: " . $conn->connect_error;
    }
?>