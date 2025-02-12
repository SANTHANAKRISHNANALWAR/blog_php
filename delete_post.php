<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['deluid']){
    require_once "config.php";
    $uniqueid = $_POST['deluid'];
    $post_table = $_SESSION['logged_table'];
    $del_sql = "DELETE FROM `$post_table` WHERE id = ?";
    $del_stmt = $conn->prepare($del_sql);
    $del_stmt->bind_param("i",$uniqueid);
    if($del_stmt->execute()){
        $del_stmt->close();
        $conn->close();
        header('location: ./edit.php');
        exit();
    }
    else{
        echo "error in deletion";
        header('location: ./edit.php');
        exit();
    }
}

?>