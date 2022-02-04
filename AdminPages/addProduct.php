<?php include ("../header.php"); ?>

<?php
if(isset($_POST['product']) &&isset($_POST['ProductName']) && isset($_POST['CategoryName']) && isset($_POST['ProductImageLink']) && isset( $_POST['ManufacturerName']) && isset($_POST['TechnicalSpecs']) && isset($_POST['Price']) && isset($_POST['QuantityAvalilableNew']) && isset($_POST['QuantityAvalilableRef']) && isset($_POST['Discount'])) {
    $message=addProduct($_POST['ProductName'], $_POST['CategoryName'], $_POST['ProductImageLink'], $_POST['ManufacturerName'], $_POST['TechnicalSpecs'], $_POST['Price'], $_POST['QuantityAvalilableNew'], $_POST['QuantityAvalilableRef'], $_POST['Discount']);
    
    $text = print_r($message, true);
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
    <!DOCTYPE html>
<html>
<body>
<h1>Products</h1>


<div>
<form> <b>

  <label for="fname">Product name:</label><br> <b>
  <input type="text" id="fname" name="ProductName" value="write here"><br> <br>
  
  <label for="fname">Category name:</label><br> <b>
  <input type="text" id="fname" name="CategoryName" value="write here"><br> <br>
  
  <label for="fname">Product image link:</label><br> <b>
  <input type="text" id="fname" name="ProductImageLink" value="write here"><br> <br>
 
  <label for="fname">Manufacturer name:</label><br> 
  <input type="text" id="fname" name="ManufacturerName" value="write here"><br> <br>
  
  <label for="fname">Technical spes:</label><br> 
  <input type="text" id="fname" name="TechnicalSpecs" value="write here"><br> <br>
 
  <label for="fname">Price double:</label><br> 
  <input type="text" id="fname" name="Price" value="write here"><br> <br>
  
  <label for="fname">Quantity Avalilable New INT:</label><br> 
  <input type="text" id="fname" name="QuantityAvalilableNew" value="write here"><br> <br>
  
  <label for="fname">Quantity Avalilable Ref INT:</label><br> 
  <input type="text" id="fname" name="QuantityAvalilableRef" value="write here"><br> <br>
  
  <label for="fname">Discount Double:</label><br> 
  <input type="text" id="fname" name="Discount" value="write here"><br> <br>


<label for="the form above">Select if the product is new or inserted before: </label>
<select id="=">
  <option value="">--Make a choice--</option>
  <option value="new">New Product</option>
  <option value="old">Old product</option>
</select>
<p></p>
 
 
<input type="submit" value="Submit" name="product"
       style="background-color:#008080; 
              border: solid 4px #000000;
              height: 45px; 
              font-size:25px; 
              vertical-align:20px" />
              

</form> 
</div>
</body>

</html>

<?php include ("../footer.php"); ?>