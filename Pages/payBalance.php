<?php include ("../header.php"); ?>
<?php
    
    if(isset($_POST['balance'])) {
        $amount = $_POST['balance'];
        PayBalance($CusID, $amount);
        // $text = print_r($message, true);
        // echo "<br>
        // <div class=\"alert\">
        //     <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
        //     <p class=\"text-center font-weight-semi-bold\" style=\"font-size:20px\">" .json_encode($text). "</p>
        // </div>";
    }
    ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">BALANCE PAGE</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="../index.php">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Balance Page</p>
                </div>
            </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Detail Start -->
    <div style="width:600px; margin-left: auto; margin-right: auto;">
        <div class="card border-secondary" >
        <div class="card-header bg-secondary border-0">
            <h4 class="font-weight-semi-bold m-0">My Balance</h4>
        </div>
        <form method="post">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Due Amount</h6>
                    <h6 class="font-weight-medium">$ <?php print_r(checkBalance($CusID)); ?></h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Amount to Pay</h6>
                    <input type="text" name="balance" class="border-0 bg-secondary text-center" placeholder="Enter Desired Amount" style= "height:45px; width:200px;">
                </div>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <button type="submit" class="btn btn-block btn-primary my-3 py-3">Pay Now</button>
            </div>
        </form>    
        </div>
    </div>
    <!-- Shop Detail End -->


<?php include ("../footer.php"); ?>