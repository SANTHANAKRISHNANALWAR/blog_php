<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

require_once "../controller/login_file.php";

?>


<body>
    <main>
        <section class="loginComp py-5">
            <div class="loginContainer container">
                <div class="loginBody row">
                    <div class="loginBlock col">
                        <form class="row g-3 p-3 col-12 col-lg-6 mx-auto shadow-lg" action="../controller/login_file.php" method="POST" id="loginForm">

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