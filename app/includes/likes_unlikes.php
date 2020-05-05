<?php include_once("/app/helpers/trackUser.php");?>

<?php

    $vis_ip = getVisIPAddr();

    function likesAndDislikes($condition)
    {
        global $conn;
        global $vis_ip;

        if ($condition == 'y') {
            $postid = $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=" . $postid);
            $row = mysqli_fetch_array($result);
            $nl = $row['likes'];
            $nu = $row['unlikes'];
    
            $result_ip = mysqli_query($conn, "SELECT * FROM likes WHERE ip='" . $vis_ip . "'");
            $count = mysqli_num_rows($result_ip);
            $results = mysqli_fetch_assoc($result_ip);
    
            if ($count > 0 && ($postid == $results['post_id']) && $results['is_like'] == 0) {
                $sql_p = "UPDATE posts SET unlikes=" . ($nu-1) . ", likes=" . ($nl+1) . " WHERE id=" . $postid;
                mysqli_query($conn, $sql_p);

                $sql_l = "UPDATE likes SET is_like=1 WHERE id=" . $results['id'];
                mysqli_query($conn, $sql_l);
            } elseif ($count > 0 && ($postid == $results['post_id']) && $results['is_like'] == 1) {
                $sql_p = "UPDATE posts SET likes=" . ($nl-1) . " WHERE id=" . $postid;
                mysqli_query($conn, $sql_p);

                $sql_l = "DELETE FROM likes WHERE id=". $results['id'];
                mysqli_query($conn, $sql_l);
            } else {
                $sql_p = "UPDATE posts SET likes=" . ($nl + 1) . " WHERE id=" . $postid;
                mysqli_query($conn, $sql_p);

                $sql_l = "INSERT INTO likes (ip, post_id, is_like) VALUES ('" . $vis_ip . "', $postid, 1)";
                mysqli_query($conn, $sql_l);
            }
        }

        if ($condition == 'n') {
            $postid = $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=" . $postid);
            $row = mysqli_fetch_array($result);
            $nl = $row['likes'];
            $nu = $row['unlikes'];
    
            $result_ip = mysqli_query($conn, "SELECT * FROM likes WHERE ip='" . $vis_ip ."'");
            $count = mysqli_num_rows($result_ip);
            $results = mysqli_fetch_assoc($result_ip);
    
            if ($count > 0 && ($postid == $results['post_id']) && $results['is_like'] == 0) {
                $sql_p = "UPDATE posts SET unlikes=" . ($nu-1) . " WHERE id=" .$postid;
                mysqli_query($conn, $sql_p);

                $sql_l = "DELETE FROM likes WHERE id=" . $results['id'];
                mysqli_query($conn, $sql_l);
            } elseif ($count > 0 && ($postid == $results['post_id']) && $results['is_like'] == 1) {
                $sql_p = "UPDATE posts SET unlikes=" . ($nu+1) .", likes=" . ($nl-1) . " WHERE id=" . $postid;
                mysqli_query($conn, $sql_p);

                $sql_l = "UPDATE likes SET is_like=0 WHERE id=" . $results['id'];
                mysqli_query($conn, $sql_l);
            } else {
                $sql_l = "INSERT INTO likes (ip, post_id, is_like) VALUES ('" . $vis_ip . "', $postid, 0)";
                mysqli_query($conn, $sql_l);

                $sql_p = "UPDATE posts SET unlikes=" . ($nu+1) . " WHERE id=" . $postid;
                mysqli_query($conn, $sql_p);
            }
        }

        visitorDefaultLikeDis();
    }
    
?>
 
<?php
        function visitorDefaultLikeDis()
        {
            global $conn;
            global $vis_ip;
            $postid = $_GET['id'];

            $sql = "SELECT * FROM likes WHERE ip='" . $vis_ip . "' AND post_id=" . $postid;
            $results = mysqli_query($conn, $sql);
            $counter = mysqli_num_rows($results);

            if ($counter > 0) {
                $resultsar = mysqli_fetch_assoc($results);
                $islike = $resultsar['is_like'];

                if ($islike == 1) {
                    return "liked";
                } elseif ($islike == 0) {
                    return "Disliked";
                }
            } else {
                return "nutral";
            }
        }
    
    ?>

</div>