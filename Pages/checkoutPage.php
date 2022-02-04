<?php include ("../header.php"); ?>
<?php
if(isset($_POST['checkout']) && isset($_POST['payment']) ) {
// if(isset($_POST['checkout'])) {    //&& isset($_POST['invComments'])
    // $message=invoiceIssuance($CusID, $_POST['$ProdName'], $_POST['invComments'],  $_POST['Quantity'], $_POST['method'], $_POST['ProdState']);
    $message=InvoiceIssuance( $CusID, null, $_POST['payment']);
    // addAddress($CusID , $address);
    
    if (!empty($message)){
        foreach ($message as $item){
            $text = print_r($item, true);
            echo "<br>
            <div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                <p class=\"text-center font-weight-semi-bold\" style=\"font-size:20px\">" .json_encode($text). "</p>
            </div>";
        }
    }
    else{
        echo "<br>
            <div class=\"alert\">
                <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>
                <p class=\"text-center font-weight-semi-bold\" style=\"font-size:20px\"> Your invoice has been created </p>
            </div>";
    }

}
?>
        <!-- Page Header Start -->
        <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">CHECKOUT</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="../index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <?php $data= getSubData('customer','CusID', $CusID); ?>
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <h6>First Name</h6>
                            <p><?php echo $data[0]['CusFirstName']?></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6>Last Name</h6>
                            <p><?php echo $data[0]['CusLastName']?></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <h6>E-mail</h6>
                            <p><?php echo $data[0]['CusEmailAddress']?></p>
                        </div>
                        <div class="col-md-6 form-group">

                        <form method="post">
                            <label>Shipping Address</label>
                            <input class="form-control" type="text" placeholder="Enter Shipping Address" name="address">
                        </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                    <form method="post">
                    <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="font-weight-medium mb-3">Products</h5>
                                <?php
                                $cartItem = getSubData('cart', 'CusID', $CusID);
                                foreach ($cartItem as $item1){
                                    $id = $item1['ProdID'];
                                    $Quantity=$item1['Quantity'];
                                    $product = getSubData('product', 'ProdID', $id);
                                    foreach ($product as $item) { ?>
                                        <div class="d-flex justify-content-between">
                                            <p><?php echo $item['ProdName']?></p>
                                            <?php $total=$item['ProdPrice']*$Quantity;?>
                                            <p> $ <?php echo $total ?> </p>
                                        </div>
                                        <?php 
                                        $subtotal+=$total;
                                }} // closing foreach function ?>

                                <hr class="mt-0">
                                <div class="d-flex justify-content-between mb-3 pt-1">
                                    <h6 class="font-weight-medium">Subtotal</h6>
                                    <h6 class="font-weight-medium">$ <?php echo $subtotal ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="font-weight-medium">Shipping</h6>
                                    <h6 class="font-weight-medium">$10</h6>
                                </div>
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <div class="d-flex justify-content-between mt-2">
                                    <h5 class="font-weight-bold">Total</h5>
                                    <h5 class="font-weight-bold">$ <?php echo $subtotal+10 ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card border-secondary mb-5">
                            <div class="card-header bg-secondary border-0">
                                <h4 class="font-weight-semi-bold m-0">Payment</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="payment" id="paypal" value="cash">
                                        <label class="custom-control-label" for="paypal">Cash on Delivery</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="installment">
                                        <label class="custom-control-label" for="directcheck">Installment</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer border-secondary bg-transparent">
                                    <button type="submit" name="checkout" 
                                    class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
    </div>
    <!-- Checkout End -->

<?php include ("../footer.php"); ?>