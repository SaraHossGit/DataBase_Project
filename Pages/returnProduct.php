<?php include ("../header.php"); ?>

<?php
if(isset($_POST['invNum']) && isset($_POST['prodName']) && isset($_POST['quantity'])) {
    $message=returnProduct($CusID, $_POST['invNum'], $_POST['prodName'], $_POST['quantity']);
    $text = print_r($message, true);
    // echo "<script type='text/javascript'> alert(".json_encode($text).") </script>";
    echo "<br>
    <div class=\"alert\">
        <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
        <p class=\"text-center font-weight-semi-bold\" style=\"font-size:20px\">" .json_encode($text). "</p>
    </div>";
}
?>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">RETURN & REFUND</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Return Product</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Enter the Product Data</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form" style="padding: 70px 0;">
                    <div id="success"></div>
                    <form method="post" novalidate="novalidate" class="align-middle">
                        <div class="control-group">
                            <input name="invNum" type="text" class="form-control" placeholder="Invoice Number"
                                required="required" data-validation-required-message="Please enter your invoice number" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input name="prodName" type="text" class="form-control" placeholder="Product Name"
                                required="required" data-validation-required-message="Please enter your product name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input name="quantity" type="text" class="form-control" placeholder="Quantity"
                                required="required" data-validation-required-message="Please enter the quantity purshased" />
                            <p class="help-block text-danger"></p>
                        </div>

                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" >Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <img class="w-100 h-100" style="object-fit: contain; max-height:400px;" src="../assets/blog/return.jpg" alt="Image">   
            </div>
        </div>
    </div>
    <!-- Contact End -->

<?php include ("../footer.php"); ?>