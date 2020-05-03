<?php include_once("path.php");?>
<?php include_once(ROOT_PATH . "/app/controllers/posts.php");?>
<?php include_once(ROOT_PATH . "/app/includes/social_share.php");?>
<?php include_once(ROOT_PATH . "/app/includes/likes_unlikes.php");?>

<?php

    if (isset($_GET['id'])) {
        $post = selectOne('posts', ['id' => $_GET['id']]);
        $_SESSION['page_id'] = $_GET['id'];
    }

    $topics = selectAll('topics');

    $posts = popular_posts();

    if (!empty($_GET['s'])) {
        singleShare($_GET['s']);
    }

    if (!empty($_GET['l'])) {
        likesAndDislikes($_GET['l']);
    }
    
    $likeOrNot = visitorDefaultLikeDis();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo $post['title']; ?> | LiveDeets</title>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v6.0">
    </script>

    <?php include_once(ROOT_PATH . "/app/includes/header.php");?>

    <!-- start page wrapper -->
    <div class="page-wrapper">

        <!-- Content start-->
        <div class="content clearfix">

            <!-- Main Content wrapper start -->
            <div class="main-content-wrapper">
                <div class="main-content single">
                    <h2 class="post-title"><?php echo $post['title']; ?></h2>

                    <div class="post-content">
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>

                    <div class="like-btn">

                        <?php if($likeOrNot == "nutral"): ?>

                        <button class="fa fa-thumbs-o-up"
                            onclick="likeDislikefunc('like', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-thumbs-o-down"
                            onclick="likeDislikefunc('dislike', '<?php echo $actual_link; ?>')"></button>

                        <?php elseif($likeOrNot == "liked"): ?>

                        <button class="fa fa-thumbs-up"
                            onclick="likeDislikefunc('like', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-thumbs-o-down"
                            onclick="likeDislikefunc('dislike', '<?php echo $actual_link; ?>')"></button>

                        <?php elseif($likeOrNot == "Disliked"): ?>

                        <button class="fa fa-thumbs-o-up"
                            onclick="likeDislikefunc('like', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-thumbs-down"
                            onclick="likeDislikefunc('dislike', '<?php echo $actual_link; ?>')"></button>

                        <?php endif; ?>

                    </div>

                    <div class="social">

                        <h6>Share With</h6>

                        <button class="fa fa-facebook"
                            onclick="shareFunction('facebook', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-twitter"
                            onclick="shareFunction('twitter', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-google"
                            onclick="shareFunction('google', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-linkedin"
                            onclick="shareFunction('linkedin', '<?php echo $actual_link; ?>')"></button>
                        <button class="fa fa-instagram"
                            onclick="shareFunction('instagram', '<?php echo $actual_link; ?>')"></button>

                    </div>

                    <br>

                    <div class="commments">
                        <div>
                            <input type="text" class="name text-input" placeholder="name" id=""><br>
                            <textarea rows="4" name="message" class="text-input contact-input comment"
                                placeholder="Your comment..."></textarea><br>
                            <a class="submit text-input" href="javascript:void(0)">submit</a>
                        </div>

                        <div class="comment_listing"></div>

                    </div>

                </div>

            </div>
            <!-- Main Content start -->

            <div class="sidebar single">

                <div class="fb-page" data-href="https://www.facebook.com/LiveDeets-109555180733965/" data-tabs=""
                    data-width="" data-height="" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/LiveDeets-109555180733965/"
                        class="fb-xfbml-parse-ignore"><a
                            href="https://www.facebook.com/LiveDeets-109555180733965/">LiveDeets</a></blockquote>
                </div>

                <div class="section popular">
                    <h3 class="section-title">Popular</h3>

                    <?php foreach ($posts as $p): ?>
                    <div class="post clearfix">
                        <img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>">
                        <a href="<?php echo BASE_URL . '/single.php?id=' . $p['id']; ?>"
                            class="title"><?php echo $p['title']; ?></a>
                    </div>
                    <?php endforeach; ?>

                </div>

                <div class="section topics">
                    <h3 class="section-title">Topics</h3>
                    <ul>
                        <?php foreach($topics as $key => $topic): ?>
                        <li><a
                                href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name']; ?>"><?php echo $topic['name']; ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Content end-->

    </div>
    <!-- end page wrapper -->

    <?php include_once(ROOT_PATH . "/app/includes/footer.php");?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    
</body>

</html>

<script type="text/javascript">

function shareFunction(name, link) {

    if (name == "facebook") {
        window.open("https://facebook.com/sharer.php?u=" + link,
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
    }

    if (name == "twitter") {
        window.open("https://twitter.com/intent/tweet?text=" + link,
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
    }

    if (name == "google") {
        window.open("https://plus.google.com/share?url=" + link,
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
    }

    if (name == "linkedin") {
        window.open("https://www.linkedin.com/shareArticle?mini=true&url=" + link,
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
    }

    if (name == "instagram") {
        window.open("https://www.instagram.com/",
            "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=50,width=400,height=400");
    }

    window.location.href = "" + link + "?&s=1";

}

function likeDislikefunc(name, link) {

    console.log(name,link);

    if (name == "like") {
        window.location.href = "" + link + "&l=y";
    }

    if (name == "dislike") {
        window.location.href = "" + link + "&l=n";
    }

}

function list() {
    $.ajax({
        url: 'app/includes/comments.php',
        success: function(res) {
            $('.comment_listing').html(res);
        }
    })
}

list();
$(function() {
    setInterval(function() {
        list();
    }, 5000);
    $('.submit').click(function() {
        var name = $('.name').val();
        var comment = $('.comment').val();
        $.ajax({
            url: 'app/includes/comments.php',
            data: 'name=' + name + '&comment=' + comment,
            type: 'post',
            success: function() {
                alert('Your comment has been posted successfully !')
                list();
            }
        })
    })
});
</script>