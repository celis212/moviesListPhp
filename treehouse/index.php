<?php 
//incluimos los archivos de data y functions 
    include('inc/data.php');
    include('inc/functions.php');
//configuramos el titulo de la pagina 
    $pageTitle = 'Personal Media Library';
    $section = null;
//incluimos la parte del header de la pagina 
    include("inc/header.php");
?>

<div class="section catalog random">
    <div class="wrapper">
        <h2>May we suggest something?</h2>
        <ul class="items">
        <?php
        //llamamos cada uno de elementos almacenados en el array de data.php
        //donde el $id es el key y $item es el value
            //escogemos 4 items al azar con esta funcion  
            $random = array_rand($catalog,4);
            foreach($random as $id){
                echo get_item_html($id,$catalog[$id]);
            } 
            /**
             * 
             * configuracion para todo los items
             * foreach($catalog as $id => $item){
             * echo get_item_html($id, $item);
             * }
             * */
        ?>							
        </ul>
    </div>
</div>

<?php 
//incluimos el footer de la pagina 
include("inc/footer.php");  
?>