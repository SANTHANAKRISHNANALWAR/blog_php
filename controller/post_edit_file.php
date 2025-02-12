<?php

session_start();

require_once "../controller/error_handling.php";

try {

    $post_table = $_SESSION['logged_table'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['uid'])) {
        $_SESSION['uniqueid'] = $_POST['uid'];
        require_once "../model/config.php";
        $edit_stmt = $conn->prepare("SELECT * FROM `" . $post_table . "` WHERE id = ?");
        $edit_stmt->bind_param("s", $_SESSION['uniqueid']);
        $edit_stmt->execute();
        $edit_result = $edit_stmt->get_result();


        if ($edit_result->num_rows > 0) {
            $edit_row = $edit_result->fetch_object();
            $edit_title = htmlspecialchars($edit_row->title);
            $edit_description = htmlspecialchars($edit_row->description);
            $edit_status = htmlspecialchars($edit_row->status);
            $edit_author = htmlspecialchars($edit_row->author_name);
            $edit_result->close();
        }
    }

    if (isset($_POST['submit'])) {
        $post = (object) $_POST;
        $server = (object) $_SERVER;
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
                    mkdir("../uploads");
                }
                $status = move_uploaded_file($files['tmp_name'], $target_file);
                if ($status) {
                    require_once "../model/config.php";
                    $sql = "UPDATE `$post_table` SET title = ?, description = ?, status = ?, author_name = ?, image_data = ?, image_path = ?, upload_date = ? WHERE id = ?";
                    $db_query = $conn->prepare($sql);
                    $db_query->bind_param("sssssssi", $post_title, $post_description, $post_status, $post_author_name, $encoded_image, $target_file, $post_created_date, $_SESSION['uniqueid']);
                    if ($db_query->execute()) {
                        $db_query->close();
                        $conn->close();
                        header("location: ../view/edit.php");
                        exit();
                    };
                }
            } else {
                require_once "../view/post_edit_error.php";
            }
        }
    }
} catch (Exception $e) {
    echo $e;
    require_once "../view/error_card.php";
    restore_error_handler();
    exit();
}
?>