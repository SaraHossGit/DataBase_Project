<?php

    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function addToCart($CusID , $ProdID, $Quantity=1){
        // require MySQL Connection
        require ('connection.php');
                
        $query = "
            INSERT INTO cart (CusID, ProdID, Quantity) values ({$CusID}, {$ProdID}, {$Quantity})
            ON DUPLICATE KEY UPDATE CusID={$CusID} , ProdID={$ProdID} , Quantity = {$Quantity};                
        ";

        mysqli_query($conn, $query);
        echo "Added to cart Successfully";
        
    }

    function removeFromCart($CusID = 1, $ProdID){
        // require MySQL Connection
        $CusID = $_SESSION['CusID'];
        require ('connection.php');
                
        $query = "DELETE FROM cart WHERE CusID={$CusID} AND ProdID={$ProdID};";
        mysqli_query($conn, $query);
        echo "Removed from cart Successfully";
        
    }
?>