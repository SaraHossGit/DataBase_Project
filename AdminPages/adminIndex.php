<?php 

session_start();

if (isset($_SESSION['CusRole']) && $_SESSION['CusRole'] == 0) {
    header("Location: /DataBase_Project/index.php");

    // print_r("here");
}
else{
?>
<?php include ("../header.php"); ?>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">MANAGER DASHBOARD</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Manager Dashboard</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Search Start -->
    
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
                <table class="table table-bordered mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Function</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <td> <a href="cusReport.php" class= "nav-link text-center" > Customer Report</a> </td>
                            <td> Search customer by ID to check payments, balance and fees</td>
                        </tr>
                        <tr>
                            <td> <a href="" class= "nav-link text-center" > Manage Products </a> </td>
                            <td> Add, Delete, or Update product info</td>
                        </tr>
                        <tr>
                            <td> <a href="" class= "nav-link text-center" > Manage Inventory </a> </td>
                            <td> Update quanitity of new/ referbished products in inventory</td>
                        </tr>
                        <tr>
                            <td> <a href="UpdateRoles.php" class= "nav-link text-center" > Manage Admins </a> </td>
                            <td> Add, Remove, or Update Admins info</td>
                        </tr>
                        <tr>
                            <td> <a href="" class= "nav-link text-center" > Manage Call Center Representitives </a> </td>
                            <td> Add, Remove, or Update Call Center Representitives info and their assignments</td>
                        </tr>
                        <tr>
                            <td> <a href="" class= "nav-link text-center" > Call Center Archive </a> </td>
                            <td> View Call Center history</td>
                        </tr>
                        <!-- <tr>
                            <td> <a href="" class= "nav-link text-center" > Function2 </a> </td>
                            <td> desc2</td>
                        </tr> -->

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Search End -->
    
<?php include ("../footer.php"); } ?>