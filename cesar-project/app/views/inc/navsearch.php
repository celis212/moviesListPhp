<div class="row">
    <div class="col">
        <form action="<?php echo URLDIRECTION; ?>/movies/search" method="post">
            <div class="row">
                <div class="col">
                    <label for="name">Search by title</label>
                    <input type="text" placeholder="title" name="titleSearch" class="form-control form-control-lg 
                        <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo (
                            !empty($data['titleSearch'])) ? $data['titleSearch'] : ''; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                </div>
                <div class="col">
                    <label for="name">Date range:</label>
                    <div class="row">
                        <div class="col">
                            <input type="number" placeholder="start date" name="dateStart" class="form-control form-control-lg 
                                <?php echo (!empty($data['start_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo (
                                    !empty($data['dateStart'])) ? $data['dateStart'] : ''; ?>">
                            <span class="invalid-feedback"><?php echo $data['start_err']; ?></span>
                        </div>
                        <div class="col">
                            <input type="number" placeholder="end date" name="dateEnd" class="form-control form-control-lg 
                                <?php echo (!empty($data['end_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo (
                                    !empty($data['dateEnd'])) ? $data['dateEnd'] : ''; ?>">
                            <span class="invalid-feedback"><?php echo $data['end_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label for="name">Sort by:</label>
                    <select class="form-control form-control-lg" name='sortBy' aria-label="Default select example">
                        <option value="Title" <?php  if(!empty($data['sortBy']) && $data['sortBy'] === 'Title') echo "selected"; ?>>Title</option>
                        <option value="Date"  <?php  if(!empty($data['sortBy']) && $data['sortBy'] === 'Date') echo "selected"; ?>>Date</option>
                    </select>
                    <p>
                    <label for="name">Sort by:</label>
                        <input type="radio" name="when" value="asc" <?php  if(!empty($data['when']) && $data['when'] === 'asc') echo "checked"; ?>>Asc
                        <input type="radio" name="when" value="desc" <?php if(!empty($data['when']) && $data['when'] === 'desc') echo "checked";  ?>>Desc
                    </p>
                </div>


            </div>
            <div class="row  my-sm-2">
                <div class="col">
                    <input type="submit" value="Search" class="btn btn-primary btn-block">
                </div>
            </div>
        </form>
    </div>

 
</div> 