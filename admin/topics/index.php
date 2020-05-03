<?php include_once("../../path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/topics.php");?>
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
    <title>Topics</title>
</head>
<body>

    <?php include_once( ROOT_PATH . "/app/includes/adminHeader.php" );?>

    <!-- start page wrapper -->
    <div class="admin-wrapper">

    <?php include_once( ROOT_PATH . "/app/includes/adminSidebar.php" );?>

    <!-- admin content start -->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add Topics</a>
            <a href="index.php" class="btn btn-big">Manage Topics</a>
        </div>

        <div class="content">
            <h2 class="page-title">Manage Topics</h2>

            <?php include_once( ROOT_PATH . "/app/includes/messages.php" );?>

            <table>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th colspan="3">Action</th>
                </thead>
                <tbody>

                    <?php foreach($topics as $key => $topic): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $topic['name']; ?></td>
                        <td><a href="edit.php?id=<?php echo $topic['id']; ?>" class="edit">Edit</a></td>
                        <td><a href="index.php?del_id=<?php echo $topic['id']; ?>" class="delete">Delete</a></td>
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
