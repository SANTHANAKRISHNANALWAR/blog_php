<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php

// require_once "../controller/posting_file.php";

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
        <section class="component">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto p-5">
                        <div class="shadow-lg border border-1 rounded p-4">
                            <h1 class="text-white text-center py-2 bg-success mb-3 rounded">Create Post</h1>
                            <form action="../controller/posting_file.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Post Title</label>
                                    <input type="text" name="post_title" class="form-control"
                                        placeholder="Enter your post title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Post Description</label>
                                    <input type="text" name="post_description" class="form-control"
                                        placeholder="Enter your post description" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Status</label>
                                    <input type="text" name="status" class="form-control"
                                        placeholder="Enter your post status" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Date</label>
                                    <input type="date" name="created_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Author Name</label>
                                    <input type="text" name="author_name" class="form-control"
                                        placeholder="Enter your author name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Choose Banner</label>
                                    <input type="file" name="post_image" class="form-control" accept="image/*" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>