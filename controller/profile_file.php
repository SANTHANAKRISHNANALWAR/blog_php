<?php
session_start();

require_once "../controller/error_handling.php";
try {
    $name = $_SESSION['logged_name'];
} catch (Exception $e) {
    require_once "../view/error_card.php";
    restore_error_handler();
    exit();
}

?>