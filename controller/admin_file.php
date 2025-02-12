<?php

session_start();

require_once "../controller/error_handling.php";

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adminid'], $_POST['adminpass'])) {
        $adminid = htmlspecialchars(trim($_POST['adminid']));
        $adminpass = htmlspecialchars(trim($_POST['adminpass']));

        require_once "../model/config.php";

        $admin_sql = "SELECT admin_pass, admin_name FROM admin_table WHERE admin_id = ?";
        $admin_stmt = $conn->prepare($admin_sql);
        $admin_stmt->bind_param("s", $adminid);
        $admin_stmt->execute();
        $admin_stmt->bind_result($result_pass, $result_name);
        if ($admin_stmt->fetch() && isset($adminpass) && password_verify($adminpass, $result_pass)) {
            $_SESSION['admin_name'] = $result_name;
            $_SESSION['adminid'] = $adminid;
            $admin_stmt->close();
            $conn->close();
            header("location: ../view/admin_dashboard.php");
            exit();
        } else {
            $admin_stmt->close();
            $conn->close();
            throw new Exception("Entered Credentials wrong!");
        }
    }
} catch (Exception $e) {
    echo "$e";
    restore_error_handler();
    exit();
}

?>