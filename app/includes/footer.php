<?php include_once(ROOT_PATH . "/app/helpers/trackUser.php");?>
<?php include_once(ROOT_PATH . "/app/includes/mail.php");?>

<?php

    $errors_m = array();

    if (isset($_POST["email_submit"])) {
        $errors_m = v_mail($_POST);
    }
?>

<style>
.alert {
    padding: 10px;
    background-color: #f44336;
    color: white;
    margin-bottom: 5px;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>

<div class="footer" id="ft">
    <div class="footer-content">
        <div class="footer-section about">

            <h2 class="logo-text"><span>Live</span>Deets.com</h2>

            <p>
                You don't need lot of money, or a vehicle to make your traveling dream a reality.
                We support you to travel with what you have. "Not All Those Who Wander Are Lost" (J.R.R. Tolkien).
                Let's wander around.
            </p>

            <br>
            <div class="contact">
                <span><i class="fas fa fa-envelope"></i> &nbsp; info.livedeets@gmail.com</span>
            </div>

            <div class="socials">
                <a href="https://www.facebook.com/LiveDeets-109555180733965/"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/DeetsLive"><i class="fab fa-twitter"></i></a>
                <!-- <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-youtube"></i></a> -->
            </div>
        </div>

        <div class="footer-section links">
            <h3>Quick Links</h3>

            <ul>
                <a href="">
                    <li>Events</li>
                </a>
                <a href="">
                    <li>Gallery</li>
                </a>
                <a href="">
                    <li>Term and Conditions</li>
                </a>
            </ul>
        </div>

        <div class="footer-section contact-form">

            <h3>Contact Us</h3>

            <br>

            <?php if (count($errors_m) > 0): ?>

            <?php foreach ($errors_m as $error): ?>
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo $error; ?>
            </div>
            <?php endforeach;?>

            <?php endif;?>

            <form action="index.php#ft" method="post">

                <input type="email" name="email" class="text-input contact-input" placeholder="Your email address...">
                <textarea rows="4" name="message" class="text-input contact-input"
                    placeholder="Your message..."></textarea>
                <button name="email_submit" type="submit" class="btn btn-big contact-btn"> <i
                        class="fas fa fa-envelope"></i> Send</button>

            </form>
        </div>

    </div>

    <div class="footer-bottom">
        &copy; LiveDeets.com | Designed by RandikaJeewantha
    </div>

</div>