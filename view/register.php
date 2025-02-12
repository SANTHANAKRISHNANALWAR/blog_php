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

require_once "../controller/register_file.php";

?>

<body>
    <section class="registercomponent py-5">
        <div class="registercontainer container">
            <div class="registerBody row">
                <div class="registerBlock d-flex justify-content-center align-items-center">
                    <form action="../controller/register_file.php" class="row m-auto g-3 p-3 text-dark col-12 col-lg-6 shadow-lg" method="POST" id="signUpForm">
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