<?php require APPDIRECTION . '/views/inc/header.php'; ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php flash('signup_success');?>
                <h2>Sign In</h2>
                <p>Please fill in your credentials to log in</p>
                <form action="<?php echo URLDIRECTION; ?>/users/signin" method="post">
                    <div class="form-group">
                        <label for="username">Username: <sup>*</sup></label>
                        <input type="text" name="username" class="form-control form-control-lg <?php 
                            echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" 
                            value="<?php echo $data['username']; ?>">
                        <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php 
                            echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php 
                            echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col my-sm-4">
                            <input type="submit" value="Sign In" class="btn btn-success btn-block">
                        </div>
                        <div class="col my-sm-4">
                            <a href="<?php echo URLDIRECTION; ?>/users/signup" class="btn btn-light btn-block">
                                No account? Sign Up</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPDIRECTION . '/views/inc/footer.php'; ?>