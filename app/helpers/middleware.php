<?php 

    function usersOnly($redirect = 'index.php') {

        if (empty($_SESSION['id'])) {
            $_SESSION['message'] = 'you need to login first !';
            $_SESSION['type'] = 'error';
            header('location: ' . $redirect);
            exit();
        }
    }

    function adminOnly($redirect = 'index.php') {
        
        if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
            $_SESSION['message'] = 'you are not authorized !';
            $_SESSION['type'] = 'error';
            header('location: ' . $redirect);
            exit();
        }
    }

    function guestsOnly($redirect = 'index.php') {
        
        if (isset($_SESSION['id'])) {
            header('location: ' . $redirect);
            exit();
        }
    }

?>