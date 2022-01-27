<?php

    function addToCart($CusID = 1, $ProdID, $Quantity=1){
        // require MySQL Connection
        require ('connection.php');
                
        $query = "
            INSERT INTO cart (CusID, ProdID, Quantity) values ({$CusID}, {$ProdID}, {$Quantity})
            ON DUPLICATE KEY UPDATE CusID={$CusID} , ProdID={$ProdID} , Quantity = {$Quantity};                
        ";

        mysqli_query($conn, $query);
        echo "Added to cart Successfully";
        die;
    }

    function removeFromCart($CusID = 1, $ProdID){
        // require MySQL Connection
        require ('connection.php');
                
        $query = " DELETE FROM cart WHERE CusID={$CusID} AND ProdID={$ProdID};";

        mysqli_query($conn, $query);
        die;
    }
