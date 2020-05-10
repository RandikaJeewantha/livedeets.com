<?php include_once("path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/users.php");?>
<?php guestsOnly(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>SignIn</title>
</head>

<body>

    <?php include_once(ROOT_PATH . "/app/includes/header.php");?>

    <div class="auth-content">

        <form action="login.php" method="post">
            <h2 class="form-title">Login</h2>

            <?php include_once(ROOT_PATH . "/app/helpers/formErrors.php");?>

            <div>
                <label for="">Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
            </div>

            <div>
                <label for="">Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
            </div>

            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Sign In</button>
            </div>

            <p>Or <a href="register.php">Sign Up</a></p>
        </form>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

</body>

</html>