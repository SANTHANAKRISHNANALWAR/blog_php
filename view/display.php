<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

session_start();

require_once "../controller/error_handling.php";

try {

    require_once "../model/config.php";

    $db_sql = $conn->prepare("SELECT * FROM `" . $_SESSION['logged_table'] . "`");
    $db_sql->execute();
    $db_result = $db_sql->get_result();
    $db_sql->close();
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
            <section class="displayComp py-5">
                <div class="displayContainer container">
                    <div class="displayBody row mb-3">
                        <div class="displayBlock col">
                            <div class="display">
                                <h2 class="text-center">POST GALLERY</h2>
                                <a href="../view/edit.php" onclick="" class="btn btn-outline-primary px-4">Edit Post</a>
                            </div>
                        </div>
                    </div>

                    <div class="displayBody2 row">
                        <?php
                        if ($db_result->num_rows == 0) {
                            echo "<p class='text-muted text-center'>There is no posts to show.</p>
                              <a href='./posting.php' class='btn btn-success w-25 m-auto'>Add Post</a>";
                        }
                        if ($db_result->num_rows > 0) {
                            while ($row = $db_result->fetch_object()) {
                                $image_encoded = base64_encode($row->image_path)
                        ?>
                                <div class="displayBlock2 col-12 col-md-6 col-xl-4 h-100 ">
                                    <div class="displayposts card mb-3 h-100">
                                        <img src="data:image/png;base64,<?php echo $row->image_data ?>" class="card-img-top" height="200" alt="<?php echo basename($row->image_path, ".png") ?>">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate"><?php echo $row->title ?></h5>
                                            <p class="card-text text-truncate"><?php echo $row->description ?></p>
                                            <p class="card-text text-truncate"><?php echo $row->status ?></p>
                                            <p class="card-text"><small class="text-body-secondary"><?php echo $row->upload_date ?></small></p>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                            $db_result->close();
                            $conn->close();
                        }
                    } catch (Exception $e) {
                        require_once "./error_card.php";

                        restore_error_handler();
                        exit();
                    }

                    ?>

                    </div>
                </div>
            </section>
        </main>
    </body>

</html>