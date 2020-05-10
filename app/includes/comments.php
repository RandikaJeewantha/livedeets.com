<?php include_once("../../path.php");?>
<?php require_once(ROOT_PATH . "/app/database/connect.php");?>

<?php
    
    if (!empty($_SESSION['page_id'])) {
        $p_id = $_SESSION['page_id'];
    }
    
    if (!empty($p_id)) {
        
        $ql = "SELECT * FROM comments WHERE post_id = " . $p_id . " ORDER BY comment_id DESC";
        $re = mysqli_query($conn, $ql);
        
        if (mysqli_num_rows($re)>0) {
            while ($row = mysqli_fetch_object($re)) {
                ?>
            <div class="c_container">
                <div class="c_li_name">
                    <?php echo $row->comment_sender_name; ?>
                </div>

                <div class="c_li_coment">
                    <i class="fas fa-comments"></i>
                    &nbsp;<i><?php echo $row->comment; ?></i>
                </div>

                <div class="c_li_date">
                    <i><?php echo $row->date; ?></i>
                </div>
            </div>
<?php
            }
        }
    }
    

    if (!empty($_POST['name'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);

        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        $q = "INSERT INTO comments (comment_sender_name, comment, post_id) VALUES ('"
        . $name."', '".$comment."', '.$p_id.')";

        mysqli_query($conn, $q);
    }
     
?>