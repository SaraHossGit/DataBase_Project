<?php
    function addAddress($CusID , $address){
        // require MySQL Connection
        require ('connection.php');
                
        $query = " INSERT INTO customer (CusID, CusShippingAddress) values ({$CusID}, {$address})
    	ON DUPLICATE KEY UPDATE CusID={$CusID} , CusShippingAddress={$address};";

        $result=mysqli_query($conn, $query);
    }
?>        