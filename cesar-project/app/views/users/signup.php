<?php require APPDIRECTION . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Sign Up</h2>
            <p>Please fill out this form to register</p>
            <form action="<?php echo URLDIRECTION; ?>/users/signup" method="post">
                <div class="form-group">
                    <label for="name">Username: <sup>*</sup></label>
                    <input type="text" name="username" class="form-control form-control-lg 
                        <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['username']; ?>">
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone: <sup>*</sup></label>
                    <input type="text" name="phone" class="form-control form-control-lg 
                        <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['phone']; ?>">
                    <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
                </div>
                <div class="form-group">

                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg 
                        <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="text" name="password" class="form-control form-control-lg 
                        <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="row">
                    <div class="col my-sm-4">
                    <input type="submit" value="Sign Up" class="btn btn-success btn-block">
                    </div>
                    <div class="col my-sm-4">
                    <a href="<?php echo URLDIRECTION; ?>/users/signin" class="btn btn-light btn-block">
                        Have an account? Sign In</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPDIRECTION . '/views/inc/footer.php'; ?>