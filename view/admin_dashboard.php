<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

require_once "../controller/admin_dashboard_file.php";

?>


<body>

    <header>
        <nav class="navbar bg-body-tertiary bg-success shadow-lg py-4">
            <div class="container">
                <a href="./admin_dashboard.php" class="navbar-brand btn btn-success p-2 text-white">Admin Home</a>
                <div class="d-flex gap-2">
                    <form class="d-flex" action="../controller/admin_logout.php" method="POST">
                        <button class="btn btn-outline-danger" type="submit">LOG OUT</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="usersComponent py-5">
            <div class="users container">
                <div class="row mb-4">
                    <div class="col">
                        <div class="col text-center">
                            <h2>WELCOME <?php echo $admin_name ?></h2>
                        </div>
                    </div>
                </div>


                <div class="usersbody row">
                    <div class="usersBlock1 col-12 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Users</h5>
                                <h2 class='card-text'><?php echo $table_count; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="usersBlock2 col-12 col-md-6">
                        <div class="card shadow-lg">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Number of Posts</h5>
                                <h2 class='card-text'><?php echo $res; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>

</html>