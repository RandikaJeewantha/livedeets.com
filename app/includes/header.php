<header>

    <a href="index.php" class="logo">
        <h1 class="logo-text"><span>Live</span>Deets</h1>
    </a>

    <i class="fa fa-bars menu-toggle"></i>

    <ul class="nav">

        <li><a href="index.php">Home</a></li>

        <li><a href="#ft">About</a></li>

        <li><a href="#ft">Services</a></li>

        <?php if(isset($_SESSION['id'])): ?>
        <li> 
            <a href="#">
                <i class="fa fa-user"></i>
                &nbsp;&nbsp;<?php echo $_SESSION['username']; ?>
                <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
            </a>

            <ul>
                <?php if($_SESSION['admin']): ?>
                <li>
                    <a href="admin/dashboard.php">
                        <i class="fas fa-columns"></i>
                        &nbsp;&nbsp;Dashboad
                    </a>
                </li>
                <?php endif; ?>

                <li>
                    <a href="logout.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        &nbsp;&nbsp;Logout
                    </a>
                </li>
            </ul>
        </li>

        <?php else: ?>

        <!-- <li><a href="<?php //echo BASE_URL . '/register.php'; ?>">Sign Up</a></li>

        <li><a href="<?php //echo BASE_URL . '/login.php'; ?>">Sign In</a></li> -->

        <?php endif; ?>

    </ul>

</header>