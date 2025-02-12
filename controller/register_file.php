<?php

session_start();

require_once "../controller/error_handling.php";

try {

    if (isset($_POST['submit'])) {
        $post = (object) $_POST;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($post->fullName)) {
            $fullname = $post->fullName;
            $email = $post->email;
            $pass = password_hash($post->password, PASSWORD_BCRYPT);
            require_once "../model/config.php";

            $verify_sql = "SELECT COUNT(*) FROM blog_users WHERE email = ?";
            $verify_stmt = $conn->prepare($verify_sql);
            $verify_stmt->bind_param("s", $email);
            $verify_stmt->execute();
            $verify_stmt->bind_result($verify_result);
            $verify_stmt->fetch();
            $verify_stmt->close();

            if ($verify_result == 0) {
                $stmt = $conn->prepare("INSERT INTO blog_users (email,username,password) VALUES (?,?,?)");
                $stmt->bind_param("sss", $email, $fullname, $pass);
                $result = $stmt->execute();
                $stmt->close();
                if ($result) {
                    $tablename = preg_replace('/[^a-zA-Z0-9_]/', '', $email);
                    if (!empty($tablename)) {
                        $quer = "CREATE TABLE IF NOT EXISTS `" . $tablename . "` (id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(255) NOT NULL,description VARCHAR(10000) NOT NULL,status VARCHAR(255) NOT NULL, author_name VARCHAR(255) NOT NULL, image_data LONGBLOB NOT NULL,image_path VARCHAR(255) NOT NULL, upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";
                        $stmt1 = $conn->prepare($quer);
                        if ($stmt1->execute()) {
                            $stmt1->close();
                            header("location: ../view/login.php");
                            exit();
                        } else {
                            echo "Unexpected error";
                        }
                        $stmt1->close();
                    }
                } else {
?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error while Registering</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <a href="../index.php" class="btn btn-outline-primary">Home Page</a>;
                <?php
                }
            } else {
                $conn->close();
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Already a registered member. Kindly Login from Home Page.</strong>
                    <a href="../index.php" class="btn btn-primary">Home Page</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
<?php
                die();
            }
            $conn->close();
        } else {
            echo "Server error <a href= '../index.php' class='btn btn-primary'>HOME PAGE</a>";
        }
    }
    session_unset();
    session_destroy();
} catch (Exception $e) {
    require_once "../view/error_card.php";
    restore_error_handler();
    exit();
}

?>