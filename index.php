<?php include_once("app/controllers/topics.php");?>
<?php include_once("app/includes/social_share.php");?>

<?php

    $posts = array();
    $postsTitle = "Recent Posts";

    if (isset($_GET['t_id'])) {
        $posts = getPostsByTopicId($_GET['t_id']);
        $postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
    }

    if (isset($_GET['key'])) {
        $postsTitle = "You searched for '" . $_GET['key'] . "'";
        $posts = searchPosts($_GET['key']);
    } else {
        $posts = getPublishedPosts();
    }

    $tren_posts = trending_posts();

    if (!empty($_GET['s'])) {
        indexShare($_GET['s']);
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/19a961e060.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Home</title>
</head>

<body>

    <?php include_once("app/includes/header.php");?>

    <?php include_once("app/includes/messages.php");?>

    <!-- start page wrapper -->
    <div class="page-wrapper">

        <!-- page slider start -->
        <div class="post-slider">

            <h2 class="slider-title">Trending Posts</h2>

            <i class="fas fa-chevron-left prev"></i>
            <i class="fas fa-chevron-right next"></i>

            <div class="post-wrapper">

                <?php foreach ($tren_posts as $tren_post): ?>

                <div class="post">
                    <img src="<?php echo 'assets/images/' . $tren_post['image']; ?>" alt=""
                        class="slider-image">
                    <div class="post-info">
                        <h4>
                            <a href="single.php?id=<?php echo $tren_post['id']; ?>"><?php echo $tren_post['title']; ?></a>
                        </h4>
                    </div>
                </div>

                <?php endforeach; ?>

            </div>

        </div>
        <!-- page slider end -->

        <!-- Content start-->
        <div class="content clearfix">

            <!-- Main Content start -->
            <div class="main-content">

                <h2 class="recent-post-title"><?php echo $postsTitle; ?></h2>

                <?php foreach ($posts as $post): ?>
                <div class="post clearfix">
                    <img src="<?php echo '/assets/images/' . $post['image']; ?>" alt="" class="post-image">
                    <div class="post-preview">
                        <h3><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                        <i class="far fa-user">&nbsp;<?php echo $post['username']; ?></i> &nbsp;
                        <i
                            class="far fa-calendar">&nbsp;<?php echo date('F j, Y', strtotime($post['create_at'])); ?></i>
                        <p class="preview-text">
                            <?php echo html_entity_decode(substr($post['body'], 0, 300) . '...'); ?>
                        </p>

                        <a href="single.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>
                    </div>
                </div>
                <?php endforeach; ?>

                <div class="center">
                    <div class="pagination">
                        <?php include_once("/app/includes/pagination.php");?>
                    </div>
                </div>

            </div>
            <!-- Main Content end -->

            <div class="sidebar">

                <div class="social-div">

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

                </div>

                <div class="section search">
                    <h3 class="section-title">Search</h3>
                    <form action="index.php" method="get">
                        <input type="text" name="key" class="text-input" placeholder="Search...">
                    </form>
                </div>

                <div class="section topics">
                    <h3 class="section-title">Topics</h3>
                    <ul>

                        <?php foreach ($topics as $key => $topic): ?>
                        <li>
                            <a href="<?php echo '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name']; ?>"><?php echo $topic['name']; ?></a>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>

                <?php include_once("app/includes/counter.php");?>
            </div>

        </div>
        <!-- Content end-->

    </div>
    <!-- end page wrapper -->

    <?php include_once("app/includes/footer.php");?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js">
    </script>
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

$(document).ready(function() {

    $('.menu-toggle').on('click', function() {
        $('.nav').toggleClass('showing');
        $('.nav ul').toggleClass('showing');
    });

    $('.post-wrapper').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $('.next'),
        prevArrow: $('.prev'),
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

});
</script>