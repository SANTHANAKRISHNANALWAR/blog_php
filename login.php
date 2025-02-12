<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<?php

session_start();

require_once "./error_handling.php";

try {

$post = (object) $_POST;
$server = (object) $_SERVER;

if ($server->REQUEST_METHOD == 'POST' && !empty($post->name) && !empty($post->password)) {
    $name = $post->name;
    $pass = $post->password;


    require_once "config.php";

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
            header("location: ./profile.php");
            exit();
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Entered password is wrong</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Entered Email ID is wrong or not Registered User</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    $pass_stmt->close();
    $conn->close();
}
}catch(Exception $e){
    require_once "./error_card.php";
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
                                <h4 class="formheadingh4 fs-3">Enter Your Login credentials
                                </h4>
                            </div>

                            <div class="col-12">
                                <!-- <label for="mailId" class="form-label">E-mail</label> -->
                                <input type="email" name="name" class="form-control" id="mailId"
                                    placeholder="Enter Your E-mail">
                            </div>

                            <div class="col-12">
                                <!-- <label for="password" class="form-label">Password</label> -->
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter the Password">
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-success">Log in</button>
                            </div>

                            <div class="formText col-12 text-center">
                                <p>Don't have an account?<button type="button" class="btn btn-sm btn-outline-warning mx-2" onclick="window.open('./register.php')">Register</button></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>