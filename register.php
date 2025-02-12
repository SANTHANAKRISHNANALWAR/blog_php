<!-- registration page -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

session_start();

require_once "./error_handling.php";

try {

    if (isset($_POST['submit'])) {
        $post = (object) $_POST;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($post->fullName)) {
            $fullname = $post->fullName;
            $email = $post->email;
            $pass = password_hash($post->password, PASSWORD_BCRYPT);
            require_once "config.php";

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
                            header("location: ./login.php");
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
                    <a href="./index.php" class="btn btn-outline-primary">Home Page</a>;
                <?php
                }
            } else {
                $conn->close();
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Already a registered member. Kindly Login from Home Page.</strong>
                    <a href="./index.php" class="btn btn-primary">Home Page</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
    <?php
                die();
            }
            $conn->close();
        } else {
            echo "Server error <a href= './index.php' class='btn btn-primary'>HOME PAGE</a>";
        }
    }
    session_unset();
    session_destroy();
} catch (Exception $e) {
    require_once "./error_card.php";
    restore_error_handler();
    exit();
}

?>

<body>
    <section class="registercomponent py-5">
        <div class="registercontainer container">
            <div class="registerBody row">
                <div class="registerBlock d-flex justify-content-center align-items-center">
                    <form action="" class="row m-auto g-3 p-3 text-dark col-12 col-lg-6 shadow-lg" method="POST" id="signUpForm">
                        <div class="formHeading text-center col-12">
                            <h4 class="formheadingh4 fs-3">Registration</h4>
                        </div>

                        <div class="col-12">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Full Name">
                        </div>

                        <div class="col-12">
                            <label for="mailId" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" id="mailId" placeholder="Enter Your E-mail">
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Enter the Password">
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input border-dark" type="checkbox" id="gridCheck" required>
                                <label class="form-check-label" for="gridCheck">
                                    I agree to the T&C and Privacy Policy
                                </label>
                            </div>
                        </div>
                        <div class="col-12 d-grid">
                            <button type="submit" name="submit" class="btn btn-warning">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>