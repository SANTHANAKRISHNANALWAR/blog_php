<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

session_start();

require_once "./error_handling.php";

try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adminid'], $_POST['adminpass'])) {
        $adminid = htmlspecialchars(trim($_POST['adminid']));
        $adminpass = htmlspecialchars(trim($_POST['adminpass']));

        require_once "./config.php";

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
            header("location: ./admin_dashboard.php");
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

<body>
    <main>
        <section class="loginComp py-5">
            <div class="loginContainer container">
                <div class="loginBody row">
                    <div class="loginBlock col">
                        <form class="row g-3 p-3 col-12 col-lg-6 mx-auto shadow-lg" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="loginForm">

                            <div class="formHeading text-center">
                                <h4 class="formheadingh4 fs-3">Admin Login
                                </h4>
                            </div>

                            <div class="col-12">
                                <!-- <label for="adminid" class="form-label"Admin ID</label> -->
                                <input type="text" name="adminid" class="form-control" id="adminid"
                                    placeholder="Admin ID">
                            </div>

                            <div class="col-12">
                                <!-- <label for="adminpass" class="form-label">Password</label> -->
                                <input type="password" name="adminpass" class="form-control" id="adminpass"
                                    placeholder="Enter the Password">
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-success">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>