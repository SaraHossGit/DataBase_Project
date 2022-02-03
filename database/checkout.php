<?php

    function invoiceIssuance($CusID, $invComments, $method){
        // require MySQL Connection
        require ('connection.php');
        // require ('data.php');

        $cartItems= getSubData('cart', 'CusID', $CusID);
        $InvState=0;
        $a=array();
        foreach ($cartItems as $item){
            $product= getSubData('product', 'ProdID', $item['ProdID']);
            $ProdName= $product[0]['ProdName'];
            $Quantity= $item['Quantity'];
            $ProdState=$item['prodStatus'];
            
            $query = " SELECT InvoiceIssuance( {$CusID}, '{$ProdName}', '{$invComments}', {$Quantity}, '{$method}', {$InvState}, {$ProdState}); ";
            $result =mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            
            if ($row[0]=="You can't place any new order untill your balance become zero"){
                // return $row[0];   
                $message= $row[0];    
                array_push($a,$message);
            }
            else if ($row[0]=="there isn't enough quantity"){
                $message= "Sorry ".$row[0]." of product ".$ProdName;   
                array_push($a,$message);
            }
            else{
                $query2 = " DELETE from cart where CusID={$CusID} and ProdID={$item['ProdID']}; ";
                mysqli_query($conn, $query2);
            }
            
            $InvState=1;
        }
        return $a;
    }
