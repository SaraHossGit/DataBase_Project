<?php
    // fetch data using getData Method
    function getData($table = 'product'){
        // require MySQL Connection
        require ('connection.php');

        $sql = "SELECT * FROM {$table}";
        $result = $conn->query($sql);

        $resultArray = array();

        if ($result->num_rows > 0) {
            // output data of each row
            while($item = $result->fetch_assoc()) {
                $resultArray[] = $item;
            }
        } else {
            //  echo "0 results";
            return null;
        }

        $conn->close();
        return $resultArray;
    }

    // fetch data by ID using getSubData Method
    function getSubData($table, $table_item_id, $item_id){
        // require MySQL Connection
        require ('connection.php');


        $sql = "SELECT * FROM {$table} where {$table_item_id} = {$item_id}";
        $result = $conn->query($sql);

        $resultArray = array();

        if ($result->num_rows > 0) {
            // output data of each row
            while($item = $result->fetch_assoc()) {
                $resultArray[] = $item;
            }
        } else {
            //  echo "0 results";
            return null;
        }
        $conn->close();
        return $resultArray;
    }
