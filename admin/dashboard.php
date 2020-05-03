<?php include_once("../path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/posts.php");?>
<?php adminOnly(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Dashboard</title>
</head>
<body>

    <?php include_once( ROOT_PATH . "/app/includes/adminHeader.php" );?>

    <!-- start page wrapper -->
    <div class="admin-wrapper">

    <?php include_once( ROOT_PATH . "/app/includes/adminSidebar.php" );?>

    <!-- admin content start -->
    <div class="admin-content">

        <div class="content">
            <h2 class="page-title">Dashboard</h2>

            <?php include_once(ROOT_PATH . "/app/includes/messages.php");?>

        </div>
    </div>
    <!-- admin content end -->

    </div>
    <!-- end page wrapper -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    
</body>
</html>
