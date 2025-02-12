<?php

session_start();

require_once "./error_handling.php";

try {
    $admin_name = $_SESSION['admin_name'];

    require_once "../model/config.php";

    $users_sql = "SELECT COUNT(*) FROM  blog_users";
    $users_stmt = $conn->prepare($users_sql);
    $users_stmt->execute();
    $users_result = $users_stmt->get_result();
    $users_rows = $users_result->num_rows;
    $users_stmt->close();

    $each_sql = "SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'blog_php_db'";
    $each_stmt = $conn->prepare($each_sql);
    $each_stmt->execute();
    $each_result = $each_stmt->get_result();

    if ($each_result->num_rows > 0) {
        while ($row = $each_result->fetch_object()) {
            $table_name = $row->TABLE_NAME;
            $table_sql = "SELECT COUNT(*) AS row_count FROM `$table_name`";
            $table_stmt = $conn->prepare($table_sql);
            $table_stmt->execute();
            $table_result = $table_stmt->get_result()->fetch_object();
            $table_row[$table_name] = $table_result->row_count;
        }
        // print_r($table_row);
        // echo count($table_row);
        $table_count = count($table_row) - 2;
        $res = 0;
        $table_row['admin_table'] = 0;
        $table_row['blog_users'] = 0;
        foreach ($table_row as $row_count) {
            $res += $row_count;
        }
    }
} catch (Exception $e) {
    require_once "../view/admin_errror_card.php";
    restore_error_handler();
    exit();
}

?>