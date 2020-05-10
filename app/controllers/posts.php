<?php include_once(ROOT_PATH . "/app/database/db.php");?>
<?php include_once(ROOT_PATH . "/app/helpers/middleware.php");?>
<?php include_once(ROOT_PATH . "/app/helpers/validatePost.php");?>

<?php

    $table = 'posts';
    $errors = array();
    $id = "";
    $title = "";
    $body = "";
    $topic_id = "";
    $published = "";
    $first_page_image = "";
    $within_post_image_01 = "";
    $within_post_image_02 = "";
    $within_post_image_03 = "";
    $within_post_image_04 = "";

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
        $first_page_image = $post['first_page_image'];
        $within_post_image_01 = $post['within_post_image_01'];
        $within_post_image_02 = $post['within_post_image_02'];
        $within_post_image_03 = $post['within_post_image_03'];
        $within_post_image_04 = $post['within_post_image_04'];
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
            $first_page_image = $_POST['first_page_image'];
            $within_post_image_01 = $_POST['within_post_image_01'];
            $within_post_image_02 = $_POST['within_post_image_02'];
            $within_post_image_03 = $_POST['within_post_image_03'];
            $within_post_image_04 = $_POST['within_post_image_04'];
        }
        
    }

    if (isset($_POST['update-post'])) {

        adminOnly();
        $errors = validatePost($_POST);

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
            $first_page_image = $_POST['first_page_image'];
            $within_post_image_01 = $_POST['within_post_image_01'];
            $within_post_image_02 = $_POST['within_post_image_02'];
            $within_post_image_03 = $_POST['within_post_image_03'];
            $within_post_image_04 = $_POST['within_post_image_04'];
        }

    }
?>