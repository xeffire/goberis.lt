<?php
    $conn = new PDO('mysql:dbname=goislt_goislt;host=jautis.serveriai.lt;charset=utf8', 'goislt', 'bhfjuHWfzG');

    header('Content-Type: application/json');

    $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
    $title = isset($_REQUEST['title'])?$_REQUEST['title']:'';
    $author = isset($_REQUEST['author'])?$_REQUEST['author']:'';
    $pgs = isset($_REQUEST['pgs'])?$_REQUEST['pgs']:0;
    $pgsDone = isset($_REQUEST['pgsDone'])?$_REQUEST['pgsDone']:0;
    $rating = isset($_REQUEST['rating'])?$_REQUEST['rating']:0;
    $method = isset($_REQUEST['method'])?$_REQUEST['method']:null;

    function get($conn){
        $select = $conn->query("SELECT * FROM booklist");
        $res = $select->fetchAll(PDO::FETCH_ASSOC);
        echo(json_encode($res));
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $method != 'delete') {
        get($conn);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $method != 'update') {
        $insert = $conn->prepare("INSERT INTO booklist (title, author, pgs, pgsDone, rating) VALUES (?,?,?,?,?)");
        $insert->execute([$title, $author, $pgs, $pgsDone, $rating]);
        get($conn);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $method === 'update') {
        $update = $conn->prepare("UPDATE booklist SET title=?, author=?, pgsDone=?, rating=? WHERE id=?");
        $update->execute([$title, $author, $pgsDone, $rating, $id]);
        get($conn);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $method === 'delete') {
        $delete = $conn->prepare("DELETE FROM booklist WHERE id=$id");
        $delete->execute([$id]);
        get($conn);
    }
    die();
?>