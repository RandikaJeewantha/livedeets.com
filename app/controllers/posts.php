<?php include_once("../database/db.php");?>
<?php include_once("../helpers/middleware.php");?>
<?php include_once("../helpers/validatePost.php");?>

<?php

    $table = 'posts';
    $errors = array();
    $id = "";
    $title = "";
    $body = "";
    $topic_id = "";
    $published = "";

    $topics = selectAll('topics');
    $posts = selectAll($table);

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $post = selectOne($table, ['id' => $id]);
        $id = $post['id'];
        $title = $post['title'];
        $body = $post['body'];
        $topic_id = $post['topic_id'];
        $published = $post['published'];
    }

    if (isset($_GET['delete_id'])) {
        
        adminOnly();
        $count = delete($table, $_GET['delete_id']);
        $_SESSION['message'] = "Post delete successfully";
        $_SESSION['type'] = "success";
        header('location: ../../admin/posts/index.php');
        exit();
    }

    if(isset($_GET['published']) && isset($_GET['p_id'])) {

        adminOnly();
        $published = $_GET['published'];
        $p_id = $_GET['p_id'];

        $count = update($table, $p_id, ['published' => $published]);
        
        $_SESSION['message'] = "Post published state changed !";
        $_SESSION['type'] = "success";
        header('location: ../../admin/posts/index.php');
        exit();
    }

    if (isset($_POST['add-post'])) {

        adminOnly();
        $errors = validatePost($_POST);

        if (!empty($_FILES['image']['name'])) {
            
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = "../../assets/images/" . $image_name;
            
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST['image'] = $image_name;
            }

            else {
                array_push($errors, "Failed to upload image");
            }
        }

        else {
            array_push($errors, "Post image required");
        }

        if (count($errors) == 0) {
            unset($_POST['add-post']);

            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['body'] = htmlentities($_POST['body']);

            $post_id = create($table, $_POST);
            $_SESSION['message'] = "Post create successfully";
            $_SESSION['type'] = "success";
            header('location: ../../admin/posts/index.php');
            exit();

        } else {
            
            $title = $_POST['title'];
            $body = $_POST['body'];
            $topic_id = $_POST['topic_id'];
            $published = isset($_POST['published']) ? 1 : 0;
        }
        
    }

    if (isset($_POST['update-post'])) {

        adminOnly();
        $errors = validatePost($_POST);

        if (!empty($_FILES['image']['name'])) {
            
            $image_name = time() . '_' . $_FILES['image']['name'];
            $destination = "../../assets/images/" . $image_name;
            
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if ($result) {
                $_POST['image'] = $image_name;
            }

            else {
                array_push($errors, "Failed to upload image");
            }
        }

        else {
            array_push($errors, "Post image required");
        }

        if (count($errors) == 0) {

            $id = $_POST['id'];

            unset($_POST['update-post'], $_POST['id']);

            $_POST['user_id'] = $_SESSION['id'];
            $_POST['published'] = isset($_POST['published']) ? 1 : 0;
            $_POST['body'] = htmlentities($_POST['body']);

            $post_id = update($table, $id, $_POST);
            $_SESSION['message'] = "Post update successfully";
            $_SESSION['type'] = "success";
            header('location: ../../admin/posts/index.php');
            exit();

        } else {
            
            $title = $_POST['title'];
            $body = $_POST['body'];
            $topic_id = $_POST['topic_id'];
            $published = isset($_POST['published']) ? 1 : 0;
        }

    }
?>