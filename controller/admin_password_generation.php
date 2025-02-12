<?php

require_once "./config.php";

$sql = "Admin@123";

$hashed = password_hash($sql, PASSWORD_BCRYPT);

$result = $conn->query("UPDATE admin_table  SET admin_pass = '$hashed'  WHERE admin_id = 'BLOG100220250001';");

if (!empty($result)) {
    echo "success";
}

$conn->close();

?>