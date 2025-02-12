<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

session_start();

require_once "./error_handling.php";

try {
    $admin_name = $_SESSION['admin_name'];

    require_once "config.php";

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
    require_once "./admin_errror_card.php";
    restore_error_handler();
    exit();
}
?>


<body>

    <header>
        <nav class="navbar bg-body-tertiary bg-success shadow-lg py-4">
            <div class="container">
                <a href="./admin_dashboard.php" class="navbar-brand btn btn-success p-2 text-white">Admin Home</a>
                <div class="d-flex gap-2">
                    <form class="d-flex" action="./admin_logout.php" method="POST">
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