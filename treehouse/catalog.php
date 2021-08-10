<?php 
    include('inc/data.php');
    include('inc/functions.php');

    $pageTitle = "Full Catalog";
    $section = null;
    //segun la respuesta recibida del GET se configura el titulo y la variable $section
    if(isset($_GET["cat"])){
        if($_GET["cat"] == "books"){
            $pageTitle = "Books";
            $section = "books";
        }else if($_GET["cat"] == "movies"){
            $pageTitle = "Movies";
            $section = "movies";
        }else if($_GET["cat"] == "music"){
            $pageTitle = "Music";
            $section = "music";
        }
    }

    include("inc/header.php");
?>

<div class="section catalog page">
    <div class="wrapper">
        <h1><?php 
            //this show us the line of search on the title of page 
            //and give us the link to return to the full catalog 
            if($section != null){
                //&gt is grater than ">"
                echo "<a href='catalog.php'>Full Catalog</a> &gt ";
            }

            echo $pageTitle; 
        ?></h1> 
        <ul class="items">
            <?php
                //call the info relative to the category
                $category = array_category($catalog,$section);
                foreach($category as $id){
                    echo get_item_html($id,$catalog[$id]);
                } 

                //call catalog array and bring all the items
                /*foreach($catalog as $id => $item){
                    echo get_item_html($id, $item);
                } */
            ?>
        </ul>
    </div>
</div>

<?php include("inc/footer.php");  ?>