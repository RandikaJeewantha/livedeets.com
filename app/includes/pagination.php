<?php

    global $conn;

    $limit = 5;
    
    if (isset($_GET["page"])) {
        $pn = $_GET["page"];
    } else {
        $pn = 1;
    }

    $start_from = ($pn - 1) * $limit;

    if (isset($_GET['t_id'])) {
        $name = $_GET['name'];
        $topic_id = $_GET['t_id'];

        $sql = "SELECT 
            p.*, u.username 
        FROM posts AS p 
        JOIN users AS u 
        ON p.user_id=u.id 
        WHERE p.published=?
        AND topic_id=?
        ORDER BY p.create_at DESC 
        LIMIT $start_from, $limit";

        $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
        $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $sql = "SELECT COUNT(*) FROM posts WHERE published=1 AND topic_id=$topic_id";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        $total_pages = ceil($total_records / $limit);

        $pagLink = "";

        if ($pn >= 2) {
            echo "<a href='index.php?page=1&t_id=" . $topic_id . "&name=" . $name . "'> &laquo; </a>";
            echo "<a href='index.php?page=" . ($pn - 1) . "&t_id=" . $topic_id . "&name=" . $name . "'> < </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $pn) {
                $pagLink .= "<a class='active' href='index.php?page=" . ($i) . "&t_id=" . $topic_id . "&name=" . $name . "'>" . ($i) . "</a>";
            } else {
                $pagLink .= "<a href='index.php?page=" . ($i) . "&t_id=" . $topic_id . "&name=" . $name . "'>" . ($i) . "</a>";
            }
        }

        echo $pagLink;

        if ($pn < $total_pages) {
            echo "<a href='index.php?page=" . ($pn + 1) . "&t_id=" . $topic_id . "&name=" . $name . "'> > </a>";
            echo "<a href='index.php?page=" . $total_pages . "&t_id=" . $topic_id . "&name=" . $name . "'> &raquo; </a>";
        }

        $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
    } elseif (isset($_GET['key'])) {
        $key = $_GET['key'];
        $match = '%' . $key . '%';

        $sql = "SELECT 
                p.*, u.username 
            FROM posts AS p 
            JOIN users AS u 
            ON p.user_id=u.id 
            WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ?
            ORDER BY p.title ASC, p.create_at DESC
            LIMIT $start_from, $limit";

        $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
        $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $sql = 'SELECT COUNT(*) FROM posts WHERE published=1 AND title LIKE "' . $match . '" OR body LIKE "' . $match .'"';
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        $total_pages = ceil($total_records / $limit);

        $pagLink = "";

        if ($pn >= 2) {
            echo "<a href='index.php?page=1&key=" . $key . "'> &laquo; </a>";
            echo "<a href='index.php?page=" . ($pn - 1) . "&key=" . $key . "'> < </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $pn) {
                $pagLink .= "<a class='active' href='index.php?page=" . ($i) . "&key=" . $key . "'>" . ($i) . "</a>";
            } else {
                $pagLink .= "<a href='index.php?page=" . ($i) . "&key=" . $key . "'>" . ($i) . "</a>";
            }
        }

        echo $pagLink;

        if ($pn < $total_pages) {
            echo "<a href='index.php?page=" . ($pn + 1) . "&key=" . $key . "'> > </a>";
            echo "<a href='index.php?page=" . $total_pages . "&key=" . $key . "'> &raquo; </a>";
        }
        
        $postsTitle = "You searched for '" . $key . "'";
    } else {
        $sql = "SELECT p.*, u.username
        FROM posts AS p JOIN users AS u
        ON p.user_id=u.id WHERE p.published=?
        ORDER BY p.create_at DESC 
        LIMIT $start_from, $limit";

        $stmt = executeQuery($sql, ['published' => 1]);
        $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $sql = "SELECT COUNT(*) FROM posts WHERE published=1";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        $total_pages = ceil($total_records / $limit);

        $pagLink = "";

        if ($pn >= 2) {
            echo "<a href='index.php?page=1'> &laquo; </a>";
            echo "<a href='index.php?page=" . ($pn - 1) . "'> < </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $pn) {
                $pagLink .= "<a class='active' href='index.php?page=" . ($i) . "'>" . ($i) . "</a>";
            } else {
                $pagLink .= "<a href='index.php?page=" . ($i) . "'>" . ($i) . "</a>";
            }
        }

        echo $pagLink;

        if ($pn < $total_pages) {
            echo "<a href='index.php?page=" . ($pn + 1) . "'> > </a>";
            echo "<a href='index.php?page=" . $total_pages . "'> &raquo; </a>";
        }
    }
