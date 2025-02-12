<?php

session_start();

require_once "../controller/error_handling.php";

try {

    $post = (object) $_POST;
    $server = (object) $_SERVER;

    if ($server->REQUEST_METHOD == 'POST' && isset($_POST['submit'])) {
        $post_table_name = $_SESSION['logged_table'];

        $post_title = $post->post_title;
        $post_description = $post->post_description;
        $post_status = $post->status;
        $post_created_date = $post->created_date;
        $post_author_name = $post->author_name;


        if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] == 0) {
            $files = $_FILES['post_image'];
            $upload_dir = "../uploads/";
            $file_name = basename($files['name']);
            $target_file = $upload_dir . $file_name;
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($files['type'], $allowed_types)) {
                $encoded_image = base64_encode(file_get_contents($files["tmp_name"]));
                if (!is_dir("../uploads")) {
                    mkdir("../blog_php/uploads");
                }
                $status = move_uploaded_file($files['tmp_name'], $target_file);
                if ($status) {
                    $id = NULL;
                    require_once "../model/config.php";
                    $db_query = $conn->prepare("INSERT INTO `" . $post_table_name . "` VALUES (?,?,?,?,?,?,?,?)");
                    $db_query->bind_param("ssssssss", $id, $post_title, $post_description, $post_status, $post_author_name, $encoded_image, $target_file, $post_created_date);
                    if ($db_query->execute()) {
                        $db_query->close();
                        $conn->close();
                        header("location: ../view/display.php");
                        exit();
                    }
                }
            } else {
                echo "upload only jpeg,png,gif images <a href= '../view/posting.php' class='btn btn-primary'>CREATE POST</a>";
            }
        } else {
            echo "Image must be uploaded <a href= '../view/posting.php' class='btn btn-primary'>CREATE POST</a>";
        }
    }
} catch (Exception $e) {
    require_once "../view/error_card.php";
    restore_error_handler();
    exit();
}

?>