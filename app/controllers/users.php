<?php include_once ROOT_PATH . "/app/database/db.php";?>
<?php include_once ROOT_PATH . "/app/helpers/middleware.php";?>
<?php include_once ROOT_PATH . "/app/helpers/validateUser.php";?>

<?php

$errors = array();

$id = '';
$admin = '';
$username = '';
$email = '';
$password = '';
$passwordConf = '';
$table = 'users';

$admin_users = selectAll($table);

function loginUser($user) {

    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['message'] = "You are now signed in";
    $_SESSION['type'] = "success";

    if ($_SESSION['admin']) {
        header('location: ' . BASE_URL . '/admin/dashboard.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }

    exit();
}

if (isset($_POST['register-btn'])) {

    $errors = validateUser($_POST);

    if (count($errors) === 0) {

        unset($_POST['register-btn'], $_POST['passwordConf']);

        $_POST['admin'] = 0;

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user_id = create($table, $_POST);

        $user = selectOne($table, ['id' => $user_id]);

        loginUser($user);

    } else {
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }

}
?>

<?php
if (isset($_POST['login-btn'])) {

    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            
            loginUser($user);

        } else {
            array_push($errors, "Wrong credentials");
        }

    }

    else {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
}

?>

<?php 

if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {

    $errors = validateUser($_POST);

    if (count($errors) === 0) {

        unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (isset($_POST['admin'])) {
            $_POST['admin'] = 1;
            $user_id = create($table, $_POST);

            $_SESSION['message'] = "Admin user created successfully";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . '/admin/users/index.php');
            exit();
        }

        else {
            $_POST['admin'] = 0;
            $user_id = create($table, $_POST);
            $user = selectOne($table, ['id' => $user_id]);
            
            loginUser($user);
        }

    } else {

        $admin = isset($_POST['admin']) ? 1 : 0;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }

}

?>

<?php 

    if(isset($_GET['delete_id'])) {
        
        adminOnly();
        $id = $_GET['delete_id'];
        $count = delete($table, $id);
        $_SESSION['message'] = 'Admin user deleted successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/users/index.php');
        exit();
    }
?>

<?php 

    if (isset($_GET['id'])) {
        $user = selectOne($table, ['id' => $_GET['id']]);
        
        $admin = $user['admin'];
        $username = $user['username'];
        $email = $user['email'];
        $id = $user['id'];
    }

?>

<?php 

    if (isset($_POST['update-user'])) {

        adminOnly();
        $errors = validateUser($_POST);
        $id = $_POST['id'];

        if (count($errors) === 0) {

            unset($_POST['passwordConf'], $_POST['update-user'] , $_POST['id']);

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

           
            $_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
            $count = update($table, $id, $_POST);

            $_SESSION['message'] = "Admin user updaded successfully";
            $_SESSION['type'] = "success";
            header('location: ' . BASE_URL . '/admin/users/index.php');
            
            exit();
   
        } else {

            $admin = isset($_POST['admin']) ? 1 : 0;
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConf = $_POST['passwordConf'];
        }
    }

?>