<?php

session_start();

require_once "../controller/error_handling.php";

try {

$post = (object) $_POST;
$server = (object) $_SERVER;

if ($server->REQUEST_METHOD == 'POST' && !empty($post->name) && !empty($post->password)) {
    $name = $post->name;
    $pass = $post->password;


    require_once "../model/config.php";

    $pass_stmt = $conn->prepare("SELECT email, username, password FROM blog_users WHERE email=?");
    $pass_stmt->bind_param("s", $name);
    $pass_stmt->execute();
    $pass_stmt->bind_result($emailid, $logged_name, $hashed_password);
    if ($pass_stmt->fetch()) {

        if (!empty($hashed_password) && password_verify($pass, $hashed_password)) {
            $_SESSION['logged_table'] = preg_replace('/[^a-zA-Z0-9_]/', '', $emailid);
            $_SESSION['logged_name'] = $logged_name;
            $pass_stmt->close();
            $conn->close();
            header("location: ../view/profile.php");
            exit();
        } else {
            // echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            // <strong>Entered password is wrong</strong> 
            // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            // </div>';

            require_once "../view/password_wrong.php";
            require_once "../view/login.php";
        }
    } else {
        // echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        // <strong>Entered Email ID is wrong or not Registered User</strong> 
        // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        // </div>';
        require_once "../view/mail_id_wrong.php";
        require_once "../view/login.php";
    }
    $pass_stmt->close();
    $conn->close();
}
}catch(Exception $e){
    require_once "../view/error_card.php";
    restore_error_handler();
    exit();
}

?>