<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['deluid']) {
    require_once "../model/config.php";
    $uniqueid = $_POST['deluid'];
    $post_table = $_SESSION['logged_table'];
    $del_sql = "DELETE FROM `$post_table` WHERE id = ?";
    $del_file_stmt = "SELECT image_path FROM `$post_table` WHERE id = ?";
    $del_file = $conn->prepare($del_file_stmt);
    $del_file->bind_param("i", $uniqueid);
    $del_file->execute();
    $del_file->bind_result($file_path);
    $del_file->fetch();
    $del_file->close();
    $del_stmt = $conn->prepare($del_sql);
    $del_stmt->bind_param("i", $uniqueid);
    if ($del_stmt->execute()) {
        unlink($file_path);
        $del_stmt->close();
        $conn->close();
        header('location: ../view/edit.php');
        exit();
    } else {
        echo "<script>alert('error in deletion');</script>";
        header('location: ../view/edit.php');
        exit();
    }
}
