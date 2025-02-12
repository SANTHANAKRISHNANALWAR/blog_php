<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<?php

session_start();

require_once "../controller/error_handling.php";

try {

    require_once "../model/config.php";

    $db_sql = $conn->prepare("SELECT * FROM `" . $_SESSION['logged_table'] . "`");
    $db_sql->execute();
    $db_result = $db_sql->get_result();

?>

    <body>

        <header>
            <nav class="navbar bg-body-tertiary bg-success shadow-lg py-4">
                <div class="container">
                    <a href="./profile.php" class="navbar-brand btn btn-success p-2 text-white">Home</a>
                    <div class="d-flex gap-2">
                        <form class="d-flex" action="../controller/logout_file.php" method="POST">
                            <button class="btn btn-outline-danger" type="submit">LOG OUT</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="displayComp py-5">
                <div class="displayContainer container rounded py-2 bg-secondary">
                    <div class="displayBody row mb-3">
                        <div class="displayBlock col">
                            <div class="display">
                                <h2 class="text-center text-white py-3">POST DETAILS</h2>
                                <div class="d-flex justify-content-between">
                                    <a href="./posting.php" onclick="" class="btn btn-warning px-4">Add New Post</a>
                                    <a href="./display.php" class="btn btn-success px-4">Post Gallery</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="displayBody2 row">
                        <div class="displayBlock2 col-12 table-responsive">
                            <?php
                            if ($db_result->num_rows == 0) {
                                echo "<p class='text-white text-center'>There is no posts to show.</p>
                            
                            <p class='text-center'><a href='./posting.php' class='btn btn-success w-25 text-center'>Add Post</a></p>";
                            }
                            if ($db_result->num_rows > 0) {
                            ?>
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr class="table-success">
                                            <th scope="col">Sl No</th>
                                            <th scope="col">Post Title</th>
                                            <th scope="col">Post Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Author Name</th>
                                            <th scope="col">Banner</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $slno = 1;
                                        while ($row = $db_result->fetch_object()) {
                                            $image_encoded = base64_encode($row->image_path);
                                            $_SESSION['uid'][$slno] = $row->id;
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $slno ?></th>
                                                <td><?php echo htmlspecialchars($row->title); ?></td>
                                                <td><?php echo htmlspecialchars($row->description) ?></td>
                                                <td><?php echo htmlspecialchars($row->status) ?></td>
                                                <td><?php echo htmlspecialchars($row->upload_date) ?></td>
                                                <td><?php echo htmlspecialchars($row->author_name) ?></td>
                                                <td><?php echo htmlspecialchars($row->image_path) ?></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <form action="../view/post_edit.php" method="POST">
                                                            <input type="hidden" name="uid" value="<?php echo $_SESSION['uid'][$slno]; ?>">
                                                            <button type="submit" name="<?php echo $_SESSION['uid'][$slno] ?>" class="btn btn-outline-success editbtn"><i class="bi bi-pencil-square"></i></button>
                                                        </form>
                                                        <form action="../controller/delete_post.php" method="POST">
                                                            <input type="hidden" name="deluid" value="<?php echo $_SESSION['uid'][$slno]; ?>">
                                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')" name="<?php echo $_SESSION['uid'][$slno] ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>

                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                            $slno++;
                                        }
                                        $db_result->close();
                                        $db_sql->close();
                                        $conn->close();
                                    }
                                } catch (Exception $e) {
                                    require_once "./error_card.php";
                                    restore_error_handler();
                                    exit();
                                }
                                ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>

</html>