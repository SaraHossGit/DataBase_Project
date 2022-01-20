<?php

// require MySQL Connection
require ('database/connection.php');

// require Product Class
require ('database/Product.php');


// DBController object
$db = new connection();

// Product object
$product = new Product($db);
// print_r($product->getSubData('Manufcaturer', 'ManID', $product->getData()['ManID'] ) ['ManName']);


