<?php 

    function validateUser($user) {
        
        global $errors;

        if (empty($user['username'])) {
            array_push($errors, "Username is required !");
        }

        if (empty($user['email'])) {
            array_push($errors, "Email is required !");
        }

        if (empty($user['password'])) {
            array_push($errors, "Password is required !");
        }

        if ($user['passwordConf'] !== $user['password']) {
            array_push($errors, "Password do not match !");
        }

        $exitingUser = selectOne('users', ['email' => $user['email']]);
        if($exitingUser) {

            if(isset($user["update-user"]) && $exitingUser['id'] != $user['id']) {
                array_push($errors, "Email already exists");
            }

            if (isset($user['create-admin'])) {
                array_push($errors, "Email already exists");
            }
            
        }

        return $errors;
    }

    function validateLogin($user) {
        
        global $errors;

        if (empty($user['username'])) {
            array_push($errors, "Username is required !");
        }

        if (empty($user['password'])) {
            array_push($errors, "Password is required !");
        }

        return $errors;
    }

?>