<nav class="navbar navbar-expand-lg mb-3" style="background-color: #691f74; color: #ffffff;">
    <div class="container container-fluid" >
        <a class="navbar-brand" href="<?php echo URLDIRECTION; ?>" style="color: #ffffff;">
        <?php echo NAMEOFSITE; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" 
            style="background-color: #ffffff;">
            <span class=".navbar-dark .navbar-toggler-icon" style="color: #ffffff;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLDIRECTION; ?>" style="color: #ffffff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLDIRECTION; ?>/pages/about" style="color: #ffffff;">
                        About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <?php if(isset($_SESSION['user_email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLDIRECTION; ?>/users/logout" style="color: #ffffff;">
                            Sign Out</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLDIRECTION; ?>/users/signup" style="color: #ffffff;">
                            Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URLDIRECTION; ?>/users/signin" style="color: #ffffff;">
                            Sign In</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>