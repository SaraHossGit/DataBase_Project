<?php include ("../header.php"); ?>

    <!-- Table Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php 
                        $cartItem = getSubData('favourits', 'CusID', $CusID);
                        foreach ($cartItem as $item1){
                        $id = $item1['ProdID'];
                        $product = getSubData('product', 'ProdID', $id);
                        foreach ($product as $item) { ?>
                        <tr>
                            <td class="align-middle"> <a href="detail.php? id=<?php echo $id ?>" class= "nav-link" > <img src="<?php echo $item['ProdImageLink']?>" alt="" style="width: 50px;"> <?php echo $item['ProdName']?> </a> </td>
                            <td class="align-middle"> $ <?php echo $item['ProdPrice']?> </td>
                            <td class="align-middle">
                                <?php
                                    if(isset($_POST['fav'])) {
                                        removeFromFav($CusID, $id);
                                    }
                                ?>
                                <form method="post">
                                    <button type="submit" name="fav" 
                                    class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php }} // closing foreach function ?>
                        
                    </tbody>
                </table>
        </div>
    </div>
    <!-- Table End -->

<?php include ("../footer.php"); ?>