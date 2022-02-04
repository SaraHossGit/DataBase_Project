<?php

function addProduct($ProductName, $CategoryName, $ProductImageLink, $ManufacturerName, $TechnicalSpecs, $Price, $QuantityAvalilableNew, $QuantityAvalilableRef, $Discount){
    // require MySQL Connection
    require ('connection.php');

    $query = " SELECT Add_Product ({$ProductName}, {$CategoryName}, {$ProductImageLink}, {$ManufacturerName}, {$TechnicalSpecs}, {$Price}, {$QuantityAvalilableNew}, {$QuantityAvalilableRef}, {$Discount}) ; ";

    $result =mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    return $row[0];
}
