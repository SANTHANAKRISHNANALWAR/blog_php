<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

require_once "../controller/profile_file.php";

?>

<body>
    <header>
        <nav class="navbar bg-body-tertiary bg-success shadow-lg py-4">
            <div class="container">
                <a href="./profile.php" class="navbar-brand btn btn-success p-2 text-white">Home</a>
                <div class="d-flex gap-2">
                    <form class="d-flex" action="../controller/logout.php" method="POST">
                        <button class="btn btn-outline-danger" type="submit">LOG OUT</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="cardComp py-5">
            <div class="cardContainer container">
                <div class="cardBody row justify-content-center">
                    <div class="cardBlock col-12 col-lg-6">
                        <div class="card text-center shadow-lg">
                            <div class="card-header">
                                <h2>WELCOME</h2>
                                <h2><?php echo $name; ?></h2>
                            </div>
                            <div class="card-body">
                                <h2 class="card-title">Publish your passions, your way</h2>
                                <p class="card-text">Create a unique and beautiful blog easily.</p>
                                <a href="./posting.php" class="btn btn-primary">ADD POST</a>
                                <a href="./display.php" class="btn btn-primary">VIEW POSTS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>