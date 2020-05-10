<?php include_once("../../path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/posts.php");?>
<?php adminOnly(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <title>Posts</title>
</head>

<body>

    <?php include_once(ROOT_PATH . "/app/includes/adminHeader.php");?>

    <!-- start page wrapper -->
    <div class="admin-wrapper">

        <?php include_once(ROOT_PATH . "/app/includes/adminSidebar.php");?>

        <!-- admin content start -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add Post</a>
                <a href="index.php" class="btn btn-big">Manage Posts</a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Posts</h2>

                <?php include_once(ROOT_PATH . "/app/includes/messages.php");?>

                <table>
                    <thead>
                        <tr>
                            <th>&#35;</th>
                            <th>title</th>
                            <th>Author</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $key => $post): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $post['title']; ?></td>
                            <td>Randika</td>
                            <td><a href="edit.php?id=<?php echo $post['id']; ?>" class="edit">Edit</a></td>
                            <td><a href="index.php?delete_id=<?php echo $post['id']; ?>" class="delete">Delete</a></td>

                            <?php if ($post['published']): ?>
                            <td><a href="edit.php?published=0&p_id=<?php echo $post['id']; ?>"
                                    class="unpublish">Unpublish</a></td>
                            <?php else: ?>
                            <td><a href="edit.php?published=1&p_id=<?php echo $post['id']; ?>"
                                    class="publish">Publish</a></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- admin content end -->

    </div>
    <!-- end page wrapper -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

</body>

</html>