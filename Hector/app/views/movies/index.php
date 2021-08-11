<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/style.css">
    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <?php require APPROOT . '/views/inc/navbarMovies.php';?>
    <div class="container">

    <h1>Welcome to API Movies</h1>
    <form action="<?php echo URLROOT; ?>/movies/index" method="post">
        <div class="form-group">
            <label for="name">Movie search:</label>
            <input type="text" name="movie" class="form-control form-control-lg <?php echo (!empty($data['movie_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['movie']; ?>">
            <span class="invalid-feedback"><?php echo $data['movie_err']; ?></span>
        </div>
        <div class="row  my-sm-2">
            <div class="col">
                <input type="submit" value="Update movie list" class="btn btn-success btn-block">
            </div>
        </div>
    </form>

    <?php if(isset($data['api'])):?>
        <div class="row">
            <div class="col">
                <form action="<?php echo URLROOT; ?>/movies/search" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="name">Search by tile:</label>
                            <input type="text" placeholder="Title" name="titleSearch" class="form-control form-control-lg <?php echo (!empty($data['titleSearch_err'])) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?php echo $data['titleSearch_err']; ?></span>
                        </div>
                        <div class="col">
                            <label for="name">Date range:</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" placeholder="Year start" name="dateStart" class="form-control form-control-lg <?php echo (!empty($data['dateStart_err'])) ? 'is-invalid' : ''; ?>" value="">
                                    <span class="invalid-feedback"><?php echo $data['dateStart_err']; ?></span>
                                </div>
                                <div class="col">
                                    <input type="text" placeholder="Year end" name="dateEnd" class="form-control form-control-lg <?php echo (!empty($data['dateEnd_err'])) ? 'is-invalid' : ''; ?>" value="">
                                    <span class="invalid-feedback"><?php echo $data['dateEnd_err']; ?></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row  my-sm-2">
                        <div class="col">
                            <input type="submit" value="Search" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col">
                <form action="<?php echo URLROOT; ?>/movies/sort" method="post">
                        <div class="col">
                            <label for="name">Sort by:</label>
                            <select class="form-control form-control-lg" name='sortBy' aria-label="Default select example">
                                <option selected>Choose..</option>
                                <option value="1">Title/Asc</option>
                                <option value="2">Title/Desc</option>
                                <option value="3">Date/Asc</option>
                                <option value="4">Date/Desc</option>
                            </select>

                        </div>
                        <div class="col my-sm-2">
                            <input type="submit" value="Sort" class="btn btn-primary btn-block">
                        </div>
                    </div>
                </form>
            </div>
        
    <?php endif; ?>
    
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
                    <td class="col-md-2"><img src=<?php echo $movie['Poster']?> width="200" class="rounded mx-auto d-block" alt="Responsive image"></td>
                </tr>
                <?php } ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php require APPROOT . '/views/inc/footer.php';?>