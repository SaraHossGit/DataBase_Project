<?php

    function checkBalance($CusID){
        // require MySQL Connection
        require ('connection.php');

        $query = "SELECT ROUND( CusBalance, 3) FROM CUSTOMER WHERE CusID = {$CusID};";

        $result =mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }

    function PayBalance($CusID, $amount){
        // require MySQL Connection
        require ('connection.php');

        $query = "UPDATE CUSTOMER SET CusBalance= CusBalance- {$amount} WHERE CusID = {$CusID};";

        $result =mysqli_query($conn, $query);
        // $row = mysqli_fetch_row($result);
        // return $row[0];
    }