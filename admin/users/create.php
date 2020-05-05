<?php include_once("../../app/controllers/users.php");?>
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
    <title>Create Users</title>
</head>

<body>

    <?php include_once("../../app/includes/adminHeader.php");?>

    <!-- start page wrapper -->
    <div class="admin-wrapper">

        <?php include_once("../../app/includes/adminSidebar.php");?>

        <!-- admin content start -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.php" class="btn btn-big">Add Users</a>
                <a href="index.php" class="btn btn-big">Manage Users</a>
            </div>

            <div class="content">
                <h2 class="page-title">Create Users</h2>

                <?php include_once("../../app/helpers/formErrors.php");?>

                <form action="create.php" method="post">
                    <div>
                        <label for="">Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
                    </div>

                    <div>
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                    </div>

                    <div>
                        <label for="">Password</label>
                        <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
                    </div>

                    <div>
                        <label for="">Password Confirmation</label>
                        <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>"
                            class="text-input">
                    </div>

                    <div>
                        <?php if (isset($admin) && $admin == 1): ?>
                        <label for="">
                            <input type="checkbox" name="admin" checked>
                            Admin
                        </label>

                        <?php else: ?>
                        <label for="">
                            <input type="checkbox" name="admin">
                            Admin
                        </label>

                        <?php endif; ?>

                    </div>

                    <div>
                        <button type="submit" name="create-admin" class="btn btn-big">Add User</button>
                    </div>

                </form>
            </div>
        </div>
        <!-- admin content end -->

    </div>
    <!-- end page wrapper -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

</body>

</html>