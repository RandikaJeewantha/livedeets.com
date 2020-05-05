<?php include_once("/app/helpers/trackUser.php");?>

<?php

    $sql_count = 'SELECT COUNT(*) FROM visitor' ;
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_row($result_count);
    $records_count = $row_count[0];

    $visitors_online = CountVisitors();

    $sql_c = "SELECT * FROM likes WHERE is_like=1";
    $results_c = mysqli_query($conn, $sql_c);
    $counter_c = mysqli_num_rows($results_c);

?>

<div class="counter">
    <div class="row">
        <div class="column">
            <div class="card">
                <p><i class="fa fa-user">&nbsp;<?php echo $visitors_online; ?>+</i></p>
                <p>Online</p>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <p><i class="fa fa-users">&nbsp;<?php echo $records_count; ?>+</i></p>
                <p>Views</p>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <p><i class="fa fa-thumbs-up">&nbsp;<?php echo $counter_c; ?>+</i></p>
                <p>Likes</p>
            </div>
        </div>

        <div class="column">
            <div class="card">
                <p><i class="fa fa-share-alt">&nbsp;<?php echo $n_share; ?>+</i></p>
                <p>Shares</p>
            </div>
        </div>
    </div>
</div>