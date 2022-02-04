
<?php
function getSearchData(){
	require ('connection.php');

    if(isset($_GET['search']))
    {
        $filtervalues = $_GET['search'];
        $query = " SELECT * FROM product WHERE CONCAT(ProdName) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($conn, $query);

        return $query_run;
    }
}
?>