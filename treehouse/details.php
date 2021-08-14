<?php 
    include('inc/data.php');
    include('inc/functions.php');

    //verificamos que tengamos la variacle id de la URL
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //si la tenemos vamos a guardarla en $item 
        if(isset($catalog[$id])){
            $item = $catalog[$id];
        }
    }
    // si no esta configurado Itemm vamos a redirigir 
    if(!isset($item)){
        // protocol HTTP how the server and the browser comunicate
        header("location:catalog.php");
        //nothing else happen when redirects, stop all 
        exit;
    }    
    
    $pageTitle = $item["title"];
    $section = null;

    include("inc/header.php");
?>

<div class="section page">
    <div class="wrapper">
        <div class="media-picture">
            <span>  
                <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['title']; ?>" />
            </span>  
        </div>  

        <div class="media-details">
            <h1><?php echo $item['title']; ?></h1>
            <table>
                <tr>
                    <th>Category</th>
                    <td><?php echo $item['category']; ?></td>
                </tr>
                <tr>
                    <th>Genre</th>
                    <td><?php echo $item['genre']; ?></td>
                </tr>
                <tr>
                    <th>Format</th>
                    <td><?php echo $item['format']; ?></td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td><?php echo $item['year']; ?></td>
                </tr>
                <?php
                    if(strtolower($item['category'] == 'Books')){
                ?>
                    <tr>
                        <th>Authors</th>
                        <td><?php echo implode(', ', $item['authors']); ?></td>
                    </tr>
                    <tr>
                        <th>Publisher</th>
                        <td><?php echo $item['publisher']; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><?php echo $item['isbn']; ?></td>
                    </tr>
                <?php 
                    } else if(strtolower($item['category'] == 'Movies')){
                ?>
                    <tr>
                        <th>Director</th>
                        <td><?php echo $item['director']; ?></td>
                    </tr>
                    <tr>
                        <th>Writers</th>
                        <td><?php echo implode(', ', $item['writers']); ?></td>
                    </tr>
                    <tr>
                        <th>Stars</th>
                        <td><?php echo implode(', ', $item['stars']); ?></td>
                    </tr>
                <?php 
                    } else if(strtolower($item['category'] == 'Music')){
                ?>
                    <tr>
                        <th>Artist</th>
                        <td><?php echo $item['artist']; ?></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</div>