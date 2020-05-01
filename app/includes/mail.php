<?php

    function v_mail($data)
    {
        global $errors_m;
        $errors_m = array();

        if (empty($_POST["message"])) {
            array_push($errors_m, "Text is blank..");
        }

        if (empty($_POST["email"])) {
            array_push($errors_m, "Email is blank..");
        }

        if (empty($errors_m)) {

            $from=$_POST["email"];

            $to      = 'livedeet@livedeets.com';
            $subject = 'Visitor-Mail';
            $message = $_POST["message"];
            $headers = 'From: $from' . "\r\n" .
                'Reply-To: $from' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $mail = mail($to, $subject, $message, $headers);

        }

        return $errors_m;
    }

?>