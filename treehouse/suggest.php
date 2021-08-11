<?php 
    $pageTitle = "Suggest a Media Item";
    $section = "suggest";
    include("inc/header.php");
    include('inc/data.php');
    include('inc/functions.php');
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

<?php include("inc/footer.php");  ?>