<?php

    function returnProduct($CusID, $invNumber, $ProdName, $Quantity){
        // require MySQL Connection
        require ('connection.php');

        $query = " SELECT ProductReturn ( $CusID, $invNumber , '$ProdName' , $Quantity ) ; ";

        $result =mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }
