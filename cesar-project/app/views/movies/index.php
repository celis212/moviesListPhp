<?php require APPDIRECTION . '/views/inc/header.php'; ?>

    <h1>Welcome to API Movies</h1>
        <form action="<?php echo URLDIRECTION; ?>/movies/index" method="post">
            <div class="form-group">
                <label for="name">Movie search:</label>
                <input 
                    type="text" 
                    name="movie" 
                    class="form-control form-control-lg <?php echo (!empty($data['movie_err'])) ? 'is-invalid' : ''; ?>" 
                    value="<?php echo $data['movie']; ?>">
                <span class="invalid-feedback"><?php echo $data['movie_err']; ?></span>
            </div>
            <div class="row my-sm-2">
                <div class="col">
                    <input type="submit" value="Update movie list" class="btn btn-success btn-block">
                </div>
            </div>
        </form>
    <?php if(isset($data['api'])):?>

        <?php require APPDIRECTION . '/views/inc/navsearch.php'; ?>

        <table class="table my-sm-5">
            <thead>
                <tr>
                    <th class="col-md-2"  scope="col">#</th>
                    <th class="col-md-2" scope="col">Title</th>
                    <th class="col-md-2" scope="col">Year</th>
                    <th class="col-md-2" scope="col">Type</th>
                    <th class="col-md-2" scope="col">Poster</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($data['api'])): $i=0;?>
                    <?php foreach($data['api'] as $movie){ $i++; ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td class="col-md-2"><?php echo $movie['Title']?></td>
                            <td class="col-md-2"><?php echo $movie['Year']?></td>
                            <td class="col-md-2"><?php echo $movie['Type']?></td>
                            <td class="col-md-2">
                                <img 
                                    src=<?php echo $movie['Poster']?> 
                                    width="100" 
                                    class="rounded mx-auto d-block" 
                                    alt="Responsive image"
                                >
                            </td>
                        </tr>
                    <?php } ?>
                <?php endif; ?>
            </tbody>
        </table>    

    <?php endif; ?>

<?php require APPDIRECTION . '/views/inc/footer.php'; ?>