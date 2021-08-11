<?php
//con esta funcion en donde recibimos dos parametros 
//ordemos cada unos de los items del array 
//configuramos la unicacion de la image, su descripcion y un link de detalles
    function get_item_html($id, $item){
        $output =  "<li>
        <a href='details.php?id='>
        <img src='".$item['img']."' alt='".$item['title']."' />"
        ."<p>View Details</p>"
        ."</a></li>";
        return $output;
    }

    function array_category($catalog, $category){
        //call all the catalog when our page are in general section
        /*if($category ==  null){
            return array_keys($catalog);
        }*/

        $output = [];

        foreach($catalog as $id => $item){
            //call the catalog if we have null to all the items 
            //or we only need items of one category
            if($category ==  null || strtolower($category) == strtolower($item["category"])){
                $sort = $item["title"];
                //eliminate the begginf of the string with
                $sort = ltrim($sort. "The ");
                $sort = ltrim($sort. "A ");
                $sort = ltrim($sort. "An ");
                $output[$id] = $sort;
            }
        }
        //sort in alphabethic order by the value
        asort($output);
        //return only the keys
        return array_keys($output);
    }
