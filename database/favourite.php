<?php

    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function addToFav($CusID , $ProdID){
        // require MySQL Connection
        require ('connection.php');
                
        $query = "
            INSERT INTO favourits (CusID, ProdID) values ({$CusID}, {$ProdID})
            ON DUPLICATE KEY UPDATE CusID={$CusID} , ProdID={$ProdID};                
        ";

        mysqli_query($conn, $query);
        echo "Added to Favourites Successfully";
        die;
    }

    function removeFromFav($CusID = 1, $ProdID){
        // require MySQL Connection
        require ('connection.php');
                
        $query = "DELETE FROM favourits WHERE CusID={$CusID} AND ProdID={$ProdID};";
        mysqli_query($conn, $query);
        echo "Removed from Favourites Successfully";
        die;
    }
?>