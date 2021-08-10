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
    </div>
</div>