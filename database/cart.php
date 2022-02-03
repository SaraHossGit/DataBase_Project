<?php

    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    function addToCart($CusID , $ProdID, $Quantity=1){
        // require MySQL Connection
        require ('connection.php');
                
        $query = " SELECT AddToCart ( $CusID, $ProdID , $Quantity ) ; ";

        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        return $row[0];
        
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