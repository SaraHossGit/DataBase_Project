<?php
ob_start();
session_start();
function update_role_number($CusID, $NewRole){
    require ('../database/connection.php');
    //header("Location: /DataBase_Project/index.php");
    $query ="
        UPDATE customer 
    SET 
        CusRole = $NewRole
    WHERE
        CusID = $CusID";

    $result =mysqli_query($conn, $query);
}
?>

<?php include ("../header.php"); ?>
        <!-- Page Header Start -->
        <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">MANAGE ADMINS</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php 
                        $subtotal=0;
                        $CusID = $_SESSION['CusID'];
                        $query = " SELECT * FROM Customer";
                        $query_run = mysqli_query($conn, $query);
                        foreach ($query_run as $item){ ?>
                        <tr>
                            <td class="align-middle"> <a alt="" style="width: 50px;"> <?php echo $item['CusFirstName']?> </a> </td>
                            <td class="align-middle">  <?php echo $item['CusLastName']?> </td>
                            <td class="align-middle">  <?php echo $item['CusEmailAddress']?> </td>
                            <td class="align-middle">
                                <?php 
                                $array = [
                                    "0" => "User",
                                    "1" => "Manager",
                                    "2" => "Admin",
                                    "3" => "Call Center Representitive",
                                ];
                                ?>
                                <?php
                                    if(isset($_POST['Manger'])) {
                                        //header("Location: /DataBase_Project/index.php");
                                        update_role_number($item['CusID'], $_POST['Manger']);
                                        unset($_POST['Manger']);
                                        header("Refresh:0");
                                    }
                                ?>
                                   
                                <div class="dropdown ml-4">
                              
                                <form method="post">
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $array[$item['CusRole']] ?></a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                        <button type="submit" name="Manger" value="0" class="dropdown-item">User</button>
                                        <button type="submit" name="Manger" value="1" class="dropdown-item">Manager</button>
                                        <button type="submit" name="Manger" value="2" class="dropdown-item">Admin</button>
                                        <button type="submit" name="Manger" value="3" class="dropdown-item">Call Center Representitive</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                                    
                        </tr>
                    <?php 
                    } // closing foreach function ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    <?php include ("../footer.php"); ?>