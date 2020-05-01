<?php 
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<?php

    $sql_share = mysqli_query($conn, "SELECT * FROM shares");
    $row_share = mysqli_fetch_array($sql_share);
    $n_share = $row_share['count'];

    function indexShare($count)
    {
        global $conn;
        global $n_share;

        $sql_is = "UPDATE shares SET count=" . ($n_share + 1); 
        mysqli_query($conn, $sql_is);
    }

    function singleShare($count)
    {
        global $conn;
        global $n_share;
        global $post;

        $id = rtrim($_GET['id'], "? ");
        
        $sql_s = "UPDATE posts SET shares=" . ($post['shares'] + 1) . " WHERE id=" . $id;
        $t = mysqli_query($conn, $sql_s);
        mysqli_query($conn, "UPDATE shares SET count=$n_share+1");
    }
?>